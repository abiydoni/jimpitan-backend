<?php

namespace App\Controllers;

use Config\Database;

class WaBlast extends BaseController
{
    /**
     * Pastikan tabel pendukung di database server sudah terbuat otomatis
     */
    private function ensureTablesExist()
    {
        try {
            $db = Database::connect();
            $db->query("CREATE TABLE IF NOT EXISTS `system_settings` (
                `key` VARCHAR(100) NOT NULL,
                `value` LONGTEXT DEFAULT NULL,
                `description` VARCHAR(255) DEFAULT NULL,
                `createdAt` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                `updatedAt` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                PRIMARY KEY (`key`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;");

            $db->query("CREATE TABLE IF NOT EXISTS `wa_blast_history` (
                `id` VARCHAR(128) NOT NULL,
                `villageId` VARCHAR(128) DEFAULT NULL,
                `title` VARCHAR(255) NOT NULL,
                `message` TEXT NOT NULL,
                `targetFilter` VARCHAR(100) DEFAULT 'ALL_KK',
                `totalTarget` INT(11) DEFAULT 0,
                `successCount` INT(11) DEFAULT 0,
                `failedCount` INT(11) DEFAULT 0,
                `details` LONGTEXT DEFAULT NULL,
                `sentBy` VARCHAR(255) DEFAULT NULL,
                `createdAt` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                `updatedAt` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;");
        } catch (\Exception $e) {
            // Silently catch in case user has restricted DB permissions
        }
    }

    /**
     * Tampilan utama halaman WhatsApp Blasting KK
     */
    public function index()
    {
        $this->ensureTablesExist();
        $data = [
            'title' => 'WhatsApp Blasting KK'
        ];
        return view('wa_blast/index', $data);
    }

    /**
     * GET /wa_blast/villages
     * Daftar desa / wilayah dari database
     */
    public function getVillages()
    {
        try {
            $db = Database::connect();
            $villages = $db->table('villages')->get()->getResultArray();
            return $this->response->setJSON([
                'success' => true,
                'data'    => $villages
            ]);
        } catch (\Exception $e) {
            return $this->response->setStatusCode(500)->setJSON([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Normalisasi nomor telepon ke format internasional (628...)
     */
    private function normalizePhone($phone)
    {
        if (empty($phone)) return '';
        $trimmed = trim((string)$phone);

        // Pertahankan format JID WhatsApp Group
        if (strpos($trimmed, '@g.us') !== false || strpos($trimmed, '@s.whatsapp.net') !== false) {
            return $trimmed;
        }

        $cleaned = preg_replace('/[^\d+]/', '', $trimmed);
        if (strpos($cleaned, '+') === 0) {
            $cleaned = substr($cleaned, 1);
        }

        if (strpos($cleaned, '0') === 0) {
            $cleaned = '62' . substr($cleaned, 1);
        } elseif (strpos($cleaned, '8') === 0) {
            $cleaned = '62' . $cleaned;
        }

        return $cleaned;
    }

    /**
     * Cek apakah nomor WhatsApp valid
     */
    private function isValidPhone($phone)
    {
        if (empty($phone)) return false;
        $trimmed = trim((string)$phone);
        if (strpos($trimmed, '@g.us') !== false || strpos($trimmed, '@s.whatsapp.net') !== false) {
            return true;
        }
        $norm = $this->normalizePhone($trimmed);
        return (bool)preg_match('/^62\d{8,14}$/', $norm);
    }

    /**
     * Render template pesan dengan variabel dinamis
     */
    private function renderTemplate($template, $vars)
    {
        $rendered = $template;
        // Mencegah "WIB WIB" jika variabel jam sudah memiliki kata WIB dan template juga memiliki kata WIB
        if (!empty($vars['jam']) && stripos((string)$vars['jam'], 'WIB') !== false) {
            $rendered = preg_replace('/\{jam\}\s*WIB/i', '{jam}', $rendered);
        }
        foreach ($vars as $k => $v) {
            $rendered = str_ireplace('{' . $k . '}', (string)($v ?? ''), $rendered);
        }
        // Bersihkan jika masih ada WIB WIB berulang
        $rendered = preg_replace('/\bWIB\s+WIB\b/i', 'WIB', $rendered);
        return $rendered;
    }

    /**
     * Daftar template bawaan lengkap untuk Rapat & Acara Warga (Bahasa Nasional, Netral, Format Rapi)
     */
    private function getDefaultTemplates()
    {
        return [
            [
                'id'       => 'tpl_rapat_rutin',
                'title'    => 'Undangan Rapat Koordinasi Rutin RT/RW',
                'category' => 'RAPAT',
                'content'  => "*UNDANGAN RAPAT KOORDINASI WARGA*\n━━━━━━━━━━━━━━━━━━━━━\nKepada Yth.\nBpk/Ibu: *{nama}*\nNo. KK: {no_kk} - {desa}\n\nDengan hormat,\nMengharap kehadiran Bapak/Ibu Kepala Keluarga dalam pertemuan rapat rutin warga yang akan diselenggarakan pada:\n\n📅 Hari/Tgl : *{tanggal}*\n⏰ Waktu    : *{jam}*\n📍 Tempat   : *{tempat}*\n📝 Acara    : *{acara}*\n💬 Catatan  : _{catatan}_\n🔗 Lokasi   : {link}\n\nMengingat pentingnya agenda ini, kehadiran Bapak/Ibu sangat diharapkan tepat waktu.\n\nTerima kasih atas perhatian dan kerja samanya.\n\nHormat kami,\n*Pengurus RT/RW {desa}*"
            ],
            [
                'id'       => 'tpl_rapat_ronda',
                'title'    => 'Undangan Rapat Evaluasi & Jadwal Ronda Malam',
                'category' => 'RAPAT',
                'content'  => "*UNDANGAN RAPAT JADWAL RONDA & SISKAMLING*\n━━━━━━━━━━━━━━━━━━━━━\nKepada Yth.\nBpk/Ibu: *{nama}*\nKepala Keluarga - {alamat}\n\nDengan hormat,\nSehubungan dengan evaluasi keamanan lingkungan dan pembagian jadwal ronda malam siskamling, kami mengundang Bapak/Ibu untuk hadir pada:\n\n📅 Hari/Tgl : *{tanggal}*\n⏰ Waktu    : *{jam}*\n📍 Tempat   : *{tempat}*\n📝 Bahasan  : *{acara}*\nℹ️ Ket      : _{catatan}_\n🔗 Lokasi   : {link}\n\nKehadiran dan kepedulian Bapak/Ibu sangat diharapkan demi ketertiban lingkungan bersama.\n\nTerima kasih atas perhatian dan kerja samanya.\n\nHormat kami,\n*Seksi Keamanan & Ketertiban {desa}*"
            ],
            [
                'id'       => 'tpl_rapat_kas',
                'title'    => 'Undangan Rapat Laporan Kas & Jimpitan Warga',
                'category' => 'RAPAT',
                'content'  => "*MUSYAWARAH LAPORAN KAS & JIMPITAN WARGA*\n━━━━━━━━━━━━━━━━━━━━━\nKepada Yth.\nBpk/Ibu: *{nama}*\nNo. KK: {no_kk} - {desa}\n\nDengan hormat,\nDalam rangka transparansi dan laporan pertanggungjawaban pengelolaan dana kas serta jimpitan warga {desa}, kami mengundang Bapak/Ibu pada:\n\n📅 Hari/Tgl : *{tanggal}*\n⏰ Waktu    : *{jam}*\n📍 Tempat   : *{tempat}*\n📝 Agenda   : *{acara}*\n💬 Catatan  : _{catatan}_\n\nRekapitulasi kas dan saldo jimpitan juga dapat dipantau langsung melalui aplikasi Jimpitan.\n\nTerima kasih atas perhatian dan kehadirannya.\n\nHormat kami,\n*Pengurus Kas & Jimpitan {desa}*"
            ],
            [
                'id'       => 'tpl_kerja_bakti',
                'title'    => 'Undangan Kerja Bakti & Gotong Royong Lingkungan',
                'category' => 'ACARA',
                'content'  => "*PEMBERITAHUAN KERJA BAKTI & GOTONG ROYONG*\n━━━━━━━━━━━━━━━━━━━━━\nKepada Yth.\nBpk/Ibu: *{nama}*\nWarga Lingkungan: {alamat}\n\nDengan hormat,\nDemi menjaga kebersihan dan kenyamanan lingkungan {desa}, kami mengundang seluruh warga untuk mengikuti kerja bakti lingkungan pada:\n\n📅 Hari/Tgl : *{tanggal}*\n⏰ Waktu    : *{jam}*\n📍 Titik Kumpul : *{tempat}*\n🛠️ Kegiatan : *{acara}*\n🎒 Peralatan : _{catatan}_\n\nMari kita jaga kebersamaan demi lingkungan yang bersih dan nyaman.\n\nTerima kasih atas partisipasi seluruh warga.\n\nHormat kami,\n*Pengurus Lingkungan {desa}*"
            ],
            [
                'id'       => 'tpl_pertemuan_warga',
                'title'    => 'Undangan Pertemuan Rutin & Kerukunan Warga',
                'category' => 'ACARA',
                'content'  => "*UNDANGAN PERTEMUAN & KERUKUNAN WARGA*\n━━━━━━━━━━━━━━━━━━━━━\nKepada Yth.\nBpk/Ibu: *{nama}* Sekeluarga\nDi Tempat\n\nDengan hormat,\nKami mengundang Bapak/Ibu sekalian untuk menghadiri pertemuan rutin dan keakraban warga {desa} pada:\n\n📅 Hari/Tgl : *{tanggal}*\n⏰ Waktu    : *{jam}*\n📍 Tempat   : *{tempat}*\n📝 Acara    : *{acara}*\nℹ️ Ket      : _{catatan}_\n\nKehadiran Bapak/Ibu sangat berarti untuk mempererat tali persaudaraan dan kerukunan antar warga.\n\nTerima kasih atas perhatian dan kehadirannya.\n\nHormat kami,\n*Pengurus Lingkungan {desa}*"
            ],
            [
                'id'       => 'tpl_kustom',
                'title'    => 'Pengumuman Resmi / Agenda Khusus Warga',
                'category' => 'UMUM',
                'content'  => "*PENGUMUMAN RESMI WARGA*\n━━━━━━━━━━━━━━━━━━━━━\nKepada Yth.\nBpk/Ibu: *{nama}*\nNo. KK: {no_kk} - {desa}\n\nDengan hormat,\nBerikut kami sampaikan pemberitahuan penting terkait agenda lingkungan {desa}:\n\n📅 Pelaksanaan : *{tanggal}*\n⏰ Waktu       : *{jam}*\n📍 Lokasi      : *{tempat}*\n📝 Agenda      : *{acara}*\nℹ️ Keterangan  : _{catatan}_\n🔗 Info Tambahan : {link}\n\nDemikian pengumuman ini disampaikan untuk menjadi perhatian bersama.\n\nTerima kasih atas perhatian dan kerja samanya.\n\nHormat kami,\n*Pengurus Lingkungan {desa}*"
            ]
        ];
    }

    /**
     * GET /wa_blast/recipients
     * Ambil data Kepala Keluarga (KK) langsung dari database
     */
    public function getRecipients()
    {
        try {
            $villageId = $this->request->getGet('villageId');
            $db = Database::connect();

            // 1. Ambil daftar desa untuk pemetaan nama
            $villagesBuilder = $db->table('villages');
            $villages = $villagesBuilder->select('id, name')->get()->getResultArray();
            $villageMap = [];
            foreach ($villages as $v) {
                $villageMap[$v['id']] = $v['name'];
            }

            // 2. Ambil data warga dari tabel users
            $builder = $db->table('users');
            $builder->select('uid, name, phoneNumber, noKK, statusHubungan, alamat, villageId, familyId, nik');
            $builder->where('status !=', 'INACTIVE');

            if (!empty($villageId) && $villageId !== 'ALL') {
                $builder->where('villageId', $villageId);
            }

            $builder->orderBy('name', 'ASC');
            $rawUsers = $builder->get()->getResultArray();

            $targetType = strtoupper($this->request->getGet('targetType') ?? 'KK');

            // Hitung total KK dan total Warga
            $kkList = [];
            $allWargaList = [];

            foreach ($rawUsers as $u) {
                $allWargaList[] = $u;
                $sh = strtolower(trim((string)($u['statusHubungan'] ?? '')));
                if ($sh === 'kepala keluarga') {
                    $kkList[] = $u;
                }
            }

            // Tentukan daftar penerima berdasarkan pilihan target
            $recipients = ($targetType === 'WARGA') ? $allWargaList : $kkList;

            // 4. Format data dan hitung statistik
            $validWaCount = 0;
            $missingWaCount = 0;
            $formattedList = [];

            foreach ($recipients as $r) {
                $rawPhone = $r['phoneNumber'] ?? '';
                $formattedPhone = $this->normalizePhone($rawPhone);
                $isValid = $this->isValidPhone($formattedPhone);

                if ($isValid) {
                    $validWaCount++;
                } else {
                    $missingWaCount++;
                }

                $formattedList[] = [
                    'uid'            => $r['uid'],
                    'name'           => $r['name'] ?? 'Tanpa Nama',
                    'noKK'           => !empty($r['noKK']) ? $r['noKK'] : '-',
                    'phoneNumber'    => $rawPhone,
                    'formattedPhone' => $formattedPhone,
                    'isValidWa'      => $isValid,
                    'statusHubungan' => $r['statusHubungan'] ?? 'Kepala Keluarga',
                    'alamat'         => $r['alamat'] ?? '-',
                    'villageId'      => $r['villageId'] ?? '',
                    'villageName'    => $villageMap[$r['villageId'] ?? ''] ?? ($r['villageId'] ?? '-')
                ];
            }

            return $this->response->setJSON([
                'success'        => true,
                'targetType'     => $targetType,
                'totalKK'        => count($kkList),
                'totalWarga'     => count($allWargaList),
                'totalTarget'    => count($formattedList),
                'validWaCount'   => $validWaCount,
                'missingWaCount' => $missingWaCount,
                'data'           => $formattedList
            ]);
        } catch (\Exception $e) {
            return $this->response->setStatusCode(500)->setJSON([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * GET /wa_blast/settings
     * Ambil konfigurasi WhatsApp & template dari database
     */
    public function getSettings()
    {
        try {
            $this->ensureTablesExist();
            $db = Database::connect();
            $builder = $db->table('system_settings');
            $settings = $builder->whereIn('key', [
                'WA_GATEWAY_PROVIDER',
                'WA_API_KEY',
                'WA_API_URL',
                'WA_SENDER_NUMBER',
                'WA_DEFAULT_DELAY_SEC',
                'WA_TEMPLATES'
            ])->get()->getResultArray();

            $map = [];
            foreach ($settings as $s) {
                $map[$s['key']] = $s['value'];
            }

            $defaultTemplates = $this->getDefaultTemplates();
            $templates = $defaultTemplates;
            if (!empty($map['WA_TEMPLATES'])) {
                $parsed = json_decode($map['WA_TEMPLATES'], true);
                // Cek jika template lama masih mengandung salam, garis tengah, id pengajian, kata bernuansa keagamaan, atau format ganda {jam} WIB
                $needsUpgrade = false;
                if (!is_array($parsed) || count($parsed) === 0) {
                    $needsUpgrade = true;
                } else {
                    $jsonStr = json_encode($parsed);
                    if (strpos($jsonStr, 'Assalamu') !== false 
                        || strpos($jsonStr, '────') !== false 
                        || strpos($jsonStr, 'tpl_pengajian_doa') !== false 
                        || strpos($jsonStr, '{jam} WIB') !== false 
                        || strpos($jsonStr, 'Silaturahmi') !== false) {
                        $needsUpgrade = true;
                    }
                }

                if (!$needsUpgrade) {
                    $templates = $parsed;
                } else {
                    // Simpan pembaharuan template baru bersih (bahasa nasional, netral, waktu tanpa duplikasi WIB) ke database
                    $existing = $db->table('system_settings')->where('key', 'WA_TEMPLATES')->get()->getRowArray();
                    if ($existing) {
                        $db->table('system_settings')->where('key', 'WA_TEMPLATES')->update([
                            'value' => json_encode($defaultTemplates, JSON_UNESCAPED_UNICODE),
                            'updatedAt' => date('Y-m-d H:i:s')
                        ]);
                    } else {
                        $db->table('system_settings')->insert([
                            'key' => 'WA_TEMPLATES',
                            'value' => json_encode($defaultTemplates, JSON_UNESCAPED_UNICODE),
                            'description' => 'Template Pesan Undangan WhatsApp Blasting',
                            'createdAt' => date('Y-m-d H:i:s'),
                            'updatedAt' => date('Y-m-d H:i:s')
                        ]);
                    }
                    $templates = $defaultTemplates;
                }
            }

            return $this->response->setJSON([
                'success' => true,
                'data'    => [
                    'provider'     => !empty($map['WA_GATEWAY_PROVIDER']) ? strtolower($map['WA_GATEWAY_PROVIDER']) : 'appsbee',
                    'apiKey'       => $map['WA_API_KEY'] ?? 'wa-69aa3dbf930020c93f34b83add6374e8',
                    'apiUrl'       => $map['WA_API_URL'] ?? 'https://wa-ab.appsbee.my.id/api/send-message',
                    'senderNumber' => $map['WA_SENDER_NUMBER'] ?? 'appsbee',
                    'delaySec'     => !empty($map['WA_DEFAULT_DELAY_SEC']) ? (int)$map['WA_DEFAULT_DELAY_SEC'] : 2,
                    'templates'    => $templates
                ]
            ]);
        } catch (\Exception $e) {
            return $this->response->setStatusCode(500)->setJSON([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * POST /wa_blast/settings
     * Simpan konfigurasi WhatsApp & template ke database
     */
    public function saveSettings()
    {
        try {
            $json = $this->request->getJSON(true) ?? $this->request->getPost();
            $db = Database::connect();

            $provider     = strtolower($json['provider'] ?? 'appsbee');
            $apiKey       = trim((string)($json['apiKey'] ?? 'wa-69aa3dbf930020c93f34b83add6374e8'));
            $apiUrl       = trim((string)($json['apiUrl'] ?? 'https://wa-ab.appsbee.my.id/api/send-message'));
            $senderNumber = trim((string)($json['senderNumber'] ?? 'appsbee'));
            $delaySec     = (int)($json['delaySec'] ?? 2);
            $templates    = $json['templates'] ?? $this->getDefaultTemplates();

            $entries = [
                ['key' => 'WA_GATEWAY_PROVIDER', 'value' => $provider, 'description' => 'Provider WhatsApp Gateway'],
                ['key' => 'WA_API_KEY', 'value' => $apiKey, 'description' => 'API Key WhatsApp'],
                ['key' => 'WA_API_URL', 'value' => $apiUrl, 'description' => 'Endpoint URL WhatsApp Gateway'],
                ['key' => 'WA_SENDER_NUMBER', 'value' => $senderNumber, 'description' => 'Session ID / Device ID WhatsApp'],
                ['key' => 'WA_DEFAULT_DELAY_SEC', 'value' => (string)$delaySec, 'description' => 'Delay Kirim Detik'],
                ['key' => 'WA_TEMPLATES', 'value' => json_encode($templates, JSON_UNESCAPED_UNICODE), 'description' => 'Template Pesan WhatsApp']
            ];

            foreach ($entries as $e) {
                $check = $db->table('system_settings')->where('key', $e['key'])->get()->getRow();
                if ($check) {
                    $db->table('system_settings')->where('key', $e['key'])->update([
                        'value'       => $e['value'],
                        'description' => $e['description']
                    ]);
                } else {
                    $db->table('system_settings')->insert($e);
                }
            }

            return $this->response->setJSON([
                'success' => true,
                'message' => 'Pengaturan WhatsApp Gateway berhasil disimpan ke database.'
            ]);
        } catch (\Exception $e) {
            return $this->response->setStatusCode(500)->setJSON([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Helper kirim HTTP curl ke Gateway WhatsApp (Default Appsbee WA)
     */
    private function callGateway($phone, $message, $config)
    {
        $provider     = strtolower($config['provider'] ?? 'appsbee');
        $apiKey       = $config['apiKey'] ?? 'wa-69aa3dbf930020c93f34b83add6374e8';
        $apiUrl       = !empty($config['apiUrl']) ? $config['apiUrl'] : 'https://wa-ab.appsbee.my.id/api/send-message';
        $senderNumber = $config['senderNumber'] ?? 'appsbee';

        $headers = ['Content-Type: application/json'];
        $body = [];

        if ($provider === 'appsbee') {
            $headers[] = 'x-api-key: ' . $apiKey;
            $body = [
                'sessionId' => $senderNumber,
                'number'    => $phone,
                'message'   => $message
            ];
        } elseif ($provider === 'fonnte') {
            $headers[] = 'Authorization: ' . $apiKey;
            $body = [
                'target'      => $phone,
                'message'     => $message,
                'countryCode' => '62'
            ];
        } elseif ($provider === 'wablas') {
            $headers[] = 'Authorization: ' . $apiKey;
            $body = [
                'phone'   => $phone,
                'message' => $message
            ];
        } elseif ($provider === 'starsender') {
            $headers[] = 'apikey: ' . $apiKey;
            $body = [
                'to'      => $phone,
                'message' => $message
            ];
        } elseif ($provider === 'whacenter') {
            $body = [
                'device_id' => $senderNumber,
                'number'    => $phone,
                'message'   => $message
            ];
        } else {
            if (!empty($apiKey)) {
                $headers[] = 'Authorization: Bearer ' . $apiKey;
            }
            $body = [
                'to'      => $phone,
                'target'  => $phone,
                'message' => $message
            ];
        }

        $ch = curl_init($apiUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $res = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $err = curl_error($ch);
        curl_close($ch);

        if ($res === false) {
            return ['success' => false, 'error' => $err ?: 'Gagal terhubung ke WhatsApp Gateway'];
        }

        $json = json_decode($res, true);
        if ($httpCode >= 200 && $httpCode < 300) {
            if ($provider === 'appsbee' && isset($json['status']) && $json['status'] === false) {
                return ['success' => false, 'error' => $json['message'] ?? 'Appsbee WA menolak pengiriman'];
            }
            return [
                'success'   => true,
                'messageId' => $json['id'] ?? $json['jid'] ?? ('msg_' . time()),
                'raw'       => $json
            ];
        } else {
            return [
                'success' => false,
                'error'   => $json['message'] ?? $json['reason'] ?? ("HTTP $httpCode: $res")
            ];
        }
    }

    /**
     * POST /wa_blast/test
     * Uji coba pengiriman pesan ke nomor admin
     */
    public function testSend()
    {
        try {
            $json = $this->request->getJSON(true) ?? $this->request->getPost();
            $targetPhone = trim((string)($json['targetPhone'] ?? ''));
            $message = trim((string)($json['message'] ?? 'Pesan uji coba WhatsApp Jimpitan'));

            if (empty($targetPhone)) {
                return $this->response->setStatusCode(400)->setJSON([
                    'success' => false,
                    'message' => 'Nomor WhatsApp tujuan wajib diisi!'
                ]);
            }

            $phone = $this->normalizePhone($targetPhone);
            $customConfig = $json['customConfig'] ?? [
                'provider'     => 'appsbee',
                'apiKey'       => 'wa-69aa3dbf930020c93f34b83add6374e8',
                'apiUrl'       => 'https://wa-ab.appsbee.my.id/api/send-message',
                'senderNumber' => 'appsbee'
            ];

            $res = $this->callGateway($phone, $message, $customConfig);
            if ($res['success']) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Pesan uji coba berhasil terkirim ke ' . $phone,
                    'data'    => $res
                ]);
            } else {
                return $this->response->setStatusCode(400)->setJSON([
                    'success' => false,
                    'message' => 'Gagal mengirim pesan: ' . $res['error']
                ]);
            }
        } catch (\Exception $e) {
            return $this->response->setStatusCode(500)->setJSON([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * POST /wa_blast/send_single
     * Kirim pesan ke 1 nomor / grup (digunakan untuk live progress per KK secara real-time)
     */
    public function sendSingle()
    {
        try {
            $json = $this->request->getJSON(true) ?? $this->request->getPost();
            $targetPhone = trim((string)($json['targetPhone'] ?? ''));
            $message     = trim((string)($json['message'] ?? ''));
            $isGroup     = (bool)($json['isGroup'] ?? false);

            if (empty($targetPhone) || empty($message)) {
                return $this->response->setStatusCode(400)->setJSON([
                    'success' => false,
                    'error'   => 'Nomor tujuan dan pesan wajib diisi!'
                ]);
            }

            $phone = $isGroup ? $targetPhone : $this->normalizePhone($targetPhone);

            if (!$isGroup && !$this->isValidPhone($phone)) {
                return $this->response->setStatusCode(400)->setJSON([
                    'success' => false,
                    'error'   => 'Nomor WhatsApp tidak valid atau kosong'
                ]);
            }

            $db = Database::connect();
            $settingsRows = $db->table('system_settings')->whereIn('key', [
                'WA_GATEWAY_PROVIDER', 'WA_API_KEY', 'WA_API_URL', 'WA_SENDER_NUMBER'
            ])->get()->getResultArray();

            $cfg = [
                'provider'     => 'appsbee',
                'apiKey'       => 'wa-69aa3dbf930020c93f34b83add6374e8',
                'apiUrl'       => 'https://wa-ab.appsbee.my.id/api/send-message',
                'senderNumber' => 'appsbee'
            ];
            foreach ($settingsRows as $s) {
                if ($s['key'] === 'WA_GATEWAY_PROVIDER' && !empty($s['value'])) $cfg['provider'] = strtolower($s['value']);
                if ($s['key'] === 'WA_API_KEY' && !empty($s['value'])) $cfg['apiKey'] = $s['value'];
                if ($s['key'] === 'WA_API_URL' && !empty($s['value'])) $cfg['apiUrl'] = $s['value'];
                if ($s['key'] === 'WA_SENDER_NUMBER' && !empty($s['value'])) $cfg['senderNumber'] = $s['value'];
            }

            $res = $this->callGateway($phone, $message, $cfg);

            return $this->response->setJSON([
                'success'   => (bool)$res['success'],
                'phone'     => $phone,
                'messageId' => $res['messageId'] ?? null,
                'error'     => $res['error'] ?? null
            ]);
        } catch (\Exception $e) {
            return $this->response->setStatusCode(500)->setJSON([
                'success' => false,
                'error'   => $e->getMessage()
            ]);
        }
    }

    /**
     * POST /wa_blast/record_history
     * Simpan riwayat lengkap pengiriman setelah live progress blasting selesai
     */
    public function recordHistory()
    {
        try {
            $json = $this->request->getJSON(true) ?? $this->request->getPost();

            $villageId       = $json['villageId'] ?? null;
            $title           = trim((string)($json['title'] ?? 'Undangan Warga'));
            $messageTemplate = trim((string)($json['messageTemplate'] ?? ''));
            $targetFilter    = $json['targetFilter'] ?? 'KK';
            $totalTarget     = (int)($json['totalTarget'] ?? 0);
            $successCount    = (int)($json['successCount'] ?? 0);
            $failedCount     = (int)($json['failedCount'] ?? 0);
            $details         = $json['details'] ?? [];
            $sentBy          = $json['sentBy'] ?? 'Admin Desa';
            $copyToGroupChat = (bool)($json['copyToGroupChat'] ?? false);
            $eventDetails    = $json['eventDetails'] ?? [];

            $db = Database::connect();

            // Ambil nama desa jika ada
            $villageName = 'Warga';
            if (!empty($villageId) && $villageId !== 'ALL') {
                $vRow = $db->table('villages')->where('id', $villageId)->get()->getRowArray();
                if ($vRow) $villageName = $vRow['name'];
            }

            // Opsi: Kirim ke Chat Grup Aplikasi Jimpitan
            if ($copyToGroupChat && !empty($villageId) && $villageId !== 'ALL') {
                try {
                    $inAppTemplate = str_replace(
                        ['Bpk/Ibu: *{nama}*', 'Bpk: *{nama}*', 'No. KK: {no_kk} - {desa}', 'No. KK: {no_kk}', 'Kepala Keluarga - {alamat}', 'Warga Lingkungan: {alamat}'],
                        ['*{nama}*', '*{nama}*', 'Wilayah: {desa}', 'Wilayah: {desa}', 'Wilayah: {desa}', 'Wilayah: {desa}'],
                        $messageTemplate
                    );
                    $inAppMessage = $this->renderTemplate($inAppTemplate, [
                        'nama'    => 'Bapak/Ibu Seluruh Warga & Kepala Keluarga',
                        'no_kk'   => '-',
                        'alamat'  => '-',
                        'desa'    => $villageName,
                        'acara'   => $eventDetails['acara'] ?? $title,
                        'tanggal' => $eventDetails['tanggal'] ?? '-',
                        'jam'     => $eventDetails['jam'] ?? '-',
                        'tempat'  => $eventDetails['tempat'] ?? '-',
                        'catatan' => $eventDetails['catatan'] ?? '-',
                        'link'    => $eventDetails['link'] ?? ''
                    ]);

                    $msgId = 'msg_' . time() . '_' . substr(md5(uniqid()), 0, 6);
                    $db->table('chat_messages')->insert([
                        'id'          => $msgId,
                        'roomId'      => 'GROUP_' . $villageId,
                        'senderUid'   => 'SYSTEM',
                        'senderName'  => 'Pengurus RT / Desa',
                        'receiverUid' => null,
                        'message'     => $inAppMessage,
                        'isRead'      => 0,
                        'isDeleted'   => 0,
                        'isEdited'    => 0,
                        'villageId'   => $villageId,
                        'createdAt'   => date('Y-m-d H:i:s'),
                        'updatedAt'   => date('Y-m-d H:i:s')
                    ]);
                } catch (\Exception $e) {
                    error_log('Gagal menyimpan ke chat_messages: ' . $e->getMessage());
                }
            }

            // SIMPAN RIWAYAT KE DATABASE (wa_blast_history)
            $historyId = 'blast_' . time() . '_' . substr(md5(uniqid()), 0, 6);
            $db->table('wa_blast_history')->insert([
                'id'           => $historyId,
                'villageId'    => $villageId,
                'title'        => $title,
                'message'      => $messageTemplate,
                'targetFilter' => $targetFilter,
                'totalTarget'  => $totalTarget,
                'successCount' => $successCount,
                'failedCount'  => $failedCount,
                'details'      => json_encode($details, JSON_UNESCAPED_UNICODE),
                'sentBy'       => $sentBy,
                'createdAt'    => date('Y-m-d H:i:s'),
                'updatedAt'    => date('Y-m-d H:i:s')
            ]);

            return $this->response->setJSON([
                'success'   => true,
                'historyId' => $historyId,
                'message'   => 'Riwayat pengiriman berhasil dicatat ke database.'
            ]);
        } catch (\Exception $e) {
            return $this->response->setStatusCode(500)->setJSON([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * POST /wa_blast/send
     * Eksekusi pengiriman blasting massal ke seluruh KK & simpan riwayat di database
     */
    public function sendBlast()
    {
        @ini_set('max_execution_time', '600');
        @set_time_limit(600);

        try {
            $json = $this->request->getJSON(true) ?? $this->request->getPost();

            $villageId       = $json['villageId'] ?? null;
            $title           = trim((string)($json['title'] ?? ''));
            $messageTemplate = trim((string)($json['messageTemplate'] ?? ''));
            $recipientUids   = $json['recipientUids'] ?? [];
            $eventDetails    = $json['eventDetails'] ?? [];
            $targetGroupWa   = trim((string)($json['targetGroupWa'] ?? ''));
            $copyToGroupChat = (bool)($json['copyToGroupChat'] ?? true);
            $sentBy          = $json['sentBy'] ?? 'Admin Desa';

            if (empty($title) || empty($messageTemplate)) {
                return $this->response->setStatusCode(400)->setJSON([
                    'success' => false,
                    'message' => 'Judul acara dan template pesan tidak boleh kosong!'
                ]);
            }

            $db = Database::connect();

            // Ambil pengaturan gateway dari database
            $settingsRows = $db->table('system_settings')->whereIn('key', [
                'WA_GATEWAY_PROVIDER', 'WA_API_KEY', 'WA_API_URL', 'WA_SENDER_NUMBER', 'WA_DEFAULT_DELAY_SEC'
            ])->get()->getResultArray();

            $cfg = [
                'provider'     => 'appsbee',
                'apiKey'       => 'wa-69aa3dbf930020c93f34b83add6374e8',
                'apiUrl'       => 'https://wa-ab.appsbee.my.id/api/send-message',
                'senderNumber' => 'appsbee',
                'delaySec'     => 2
            ];
            foreach ($settingsRows as $s) {
                if ($s['key'] === 'WA_GATEWAY_PROVIDER' && !empty($s['value'])) $cfg['provider'] = strtolower($s['value']);
                if ($s['key'] === 'WA_API_KEY' && !empty($s['value'])) $cfg['apiKey'] = $s['value'];
                if ($s['key'] === 'WA_API_URL' && !empty($s['value'])) $cfg['apiUrl'] = $s['value'];
                if ($s['key'] === 'WA_SENDER_NUMBER' && !empty($s['value'])) $cfg['senderNumber'] = $s['value'];
                if ($s['key'] === 'WA_DEFAULT_DELAY_SEC' && !empty($s['value'])) $cfg['delaySec'] = (int)$s['value'];
            }

            // Ambil nama desa
            $villageName = 'Warga';
            if (!empty($villageId) && $villageId !== 'ALL') {
                $vRow = $db->table('villages')->where('id', $villageId)->get()->getRowArray();
                if ($vRow) $villageName = $vRow['name'];
            }

            // Query daftar penerima
            $userBuilder = $db->table('users');
            $userBuilder->select('uid, name, phoneNumber, noKK, statusHubungan, alamat, villageId');
            $userBuilder->where('status !=', 'INACTIVE');

            if (!empty($villageId) && $villageId !== 'ALL') {
                $userBuilder->where('villageId', $villageId);
            }
            if (!empty($recipientUids) && is_array($recipientUids)) {
                $userBuilder->whereIn('uid', $recipientUids);
            }

            $targetUsers = $userBuilder->get()->getResultArray();
            if (empty($targetUsers)) {
                return $this->response->setStatusCode(400)->setJSON([
                    'success' => false,
                    'message' => 'Tidak ada target penerima Kepala Keluarga yang ditemukan.'
                ]);
            }

            $delaySec = max(1, $cfg['delaySec']);
            $results = [];
            $successCount = 0;
            $failedCount = 0;

            // Eksekusi pengiriman berurutan
            foreach ($targetUsers as $idx => $user) {
                $rawPhone = $user['phoneNumber'] ?? '';
                $phone = $this->normalizePhone($rawPhone);

                if (!$this->isValidPhone($phone)) {
                    $failedCount++;
                    $results[] = [
                        'uid'    => $user['uid'],
                        'name'   => $user['name'] ?? 'Tanpa Nama',
                        'noKK'   => $user['noKK'] ?? '-',
                        'phone'  => $rawPhone ?: '-',
                        'status' => 'FAILED',
                        'error'  => 'Nomor WhatsApp tidak valid atau kosong'
                    ];
                    continue;
                }

                $msg = $this->renderTemplate($messageTemplate, [
                    'nama'    => $user['name'] ?? 'Warga',
                    'no_kk'   => $user['noKK'] ?? '-',
                    'alamat'  => $user['alamat'] ?? '-',
                    'desa'    => $villageName,
                    'acara'   => $eventDetails['acara'] ?? $title,
                    'tanggal' => $eventDetails['tanggal'] ?? '-',
                    'jam'     => $eventDetails['jam'] ?? '-',
                    'tempat'  => $eventDetails['tempat'] ?? '-',
                    'catatan' => $eventDetails['catatan'] ?? '-',
                    'link'    => $eventDetails['link'] ?? ''
                ]);

                $sendRes = $this->callGateway($phone, $msg, $cfg);

                if ($sendRes['success']) {
                    $successCount++;
                    $results[] = [
                        'uid'       => $user['uid'],
                        'name'      => $user['name'] ?? 'Tanpa Nama',
                        'noKK'      => $user['noKK'] ?? '-',
                        'phone'     => $phone,
                        'status'    => 'SUCCESS',
                        'messageId' => $sendRes['messageId'] ?? ''
                    ];
                } else {
                    $failedCount++;
                    $results[] = [
                        'uid'    => $user['uid'],
                        'name'   => $user['name'] ?? 'Tanpa Nama',
                        'noKK'   => $user['noKK'] ?? '-',
                        'phone'  => $phone,
                        'status' => 'FAILED',
                        'error'  => $sendRes['error'] ?? 'Gagal'
                    ];
                }

                if ($idx < count($targetUsers) - 1) {
                    sleep($delaySec);
                }
            }

            // Opsi: Kirim ke WhatsApp Group jika diisi (Hanya 1 kali pengiriman)
            if (!empty($targetGroupWa)) {
                $groupTemplate = str_replace(
                    ['Bpk/Ibu: *{nama}*', 'Bpk: *{nama}*', 'No. KK: {no_kk} - {desa}', 'No. KK: {no_kk}', 'Kepala Keluarga - {alamat}', 'Warga Lingkungan: {alamat}'],
                    ['*{nama}*', '*{nama}*', 'Wilayah: {desa}', 'Wilayah: {desa}', 'Wilayah: {desa}', 'Wilayah: {desa}'],
                    $messageTemplate
                );
                $groupMsg = $this->renderTemplate($groupTemplate, [
                    'nama'    => 'Bapak/Ibu Seluruh Warga & Kepala Keluarga',
                    'no_kk'   => '-',
                    'alamat'  => '-',
                    'desa'    => $villageName,
                    'acara'   => $eventDetails['acara'] ?? $title,
                    'tanggal' => $eventDetails['tanggal'] ?? '-',
                    'jam'     => $eventDetails['jam'] ?? '-',
                    'tempat'  => $eventDetails['tempat'] ?? '-',
                    'catatan' => $eventDetails['catatan'] ?? '-',
                    'link'    => $eventDetails['link'] ?? ''
                ]);
                $groupRes = $this->callGateway($targetGroupWa, $groupMsg, $cfg);
                $results[] = [
                    'uid'    => 'WA_GROUP',
                    'name'   => "Grup WhatsApp ($targetGroupWa)",
                    'noKK'   => '-',
                    'phone'  => $targetGroupWa,
                    'status' => $groupRes['success'] ? 'SUCCESS' : 'FAILED',
                    'error'  => $groupRes['success'] ? 'Terkirim ke Grup WA' : ($groupRes['error'] ?? 'Gagal')
                ];
            }

            // Opsi: Kirim ke Chat Grup Aplikasi Jimpitan
            if ($copyToGroupChat && !empty($villageId) && $villageId !== 'ALL') {
                try {
                    $inAppTemplate = str_replace(
                        ['Bpk/Ibu: *{nama}*', 'Bpk: *{nama}*', 'No. KK: {no_kk} - {desa}', 'No. KK: {no_kk}', 'Kepala Keluarga - {alamat}', 'Warga Lingkungan: {alamat}'],
                        ['*{nama}*', '*{nama}*', 'Wilayah: {desa}', 'Wilayah: {desa}', 'Wilayah: {desa}', 'Wilayah: {desa}'],
                        $messageTemplate
                    );
                    $inAppMessage = $this->renderTemplate($inAppTemplate, [
                        'nama'    => 'Bapak/Ibu Seluruh Warga & Kepala Keluarga',
                        'no_kk'   => '-',
                        'alamat'  => '-',
                        'desa'    => $villageName,
                        'acara'   => $eventDetails['acara'] ?? $title,
                        'tanggal' => $eventDetails['tanggal'] ?? '-',
                        'jam'     => $eventDetails['jam'] ?? '-',
                        'tempat'  => $eventDetails['tempat'] ?? '-',
                        'catatan' => $eventDetails['catatan'] ?? '-',
                        'link'    => $eventDetails['link'] ?? ''
                    ]);

                    $msgId = 'msg_' . time() . '_' . substr(md5(uniqid()), 0, 6);
                    $db->table('chat_messages')->insert([
                        'id'          => $msgId,
                        'roomId'      => 'GROUP_' . $villageId,
                        'senderUid'   => 'SYSTEM',
                        'senderName'  => 'Pengurus RT / Desa',
                        'receiverUid' => null,
                        'message'     => $inAppMessage,
                        'isRead'      => 0,
                        'isDeleted'   => 0,
                        'isEdited'    => 0,
                        'villageId'   => $villageId,
                        'createdAt'   => date('Y-m-d H:i:s'),
                        'updatedAt'   => date('Y-m-d H:i:s')
                    ]);
                } catch (\Exception $e) {
                    error_log('Gagal menyimpan ke chat_messages: ' . $e->getMessage());
                }
            }

            // SIMPAN RIWAYAT KE DATABASE (wa_blast_history)
            $historyId = 'blast_' . time() . '_' . substr(md5(uniqid()), 0, 6);
            $db->table('wa_blast_history')->insert([
                'id'           => $historyId,
                'villageId'    => $villageId,
                'title'        => $title,
                'message'      => $messageTemplate,
                'targetFilter' => $json['targetFilter'] ?? 'KK',
                'totalTarget'  => count($targetUsers),
                'successCount' => $successCount,
                'failedCount'  => $failedCount,
                'details'      => json_encode($results, JSON_UNESCAPED_UNICODE),
                'sentBy'       => $sentBy,
                'createdAt'    => date('Y-m-d H:i:s'),
                'updatedAt'    => date('Y-m-d H:i:s')
            ]);

            return $this->response->setJSON([
                'success' => true,
                'message' => "Blasting selesai! Berhasil: {$successCount}, Gagal: {$failedCount}",
                'data'    => [
                    'id'           => $historyId,
                    'total'        => count($targetUsers),
                    'successCount' => $successCount,
                    'failedCount'  => $failedCount,
                    'details'      => $results
                ]
            ]);
        } catch (\Exception $e) {
            return $this->response->setStatusCode(500)->setJSON([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * GET /wa_blast/history
     * Ambil riwayat pengiriman dari database
     */
    public function getHistory()
    {
        try {
            $db = Database::connect();
            $villageId = $this->request->getGet('villageId');
            $builder = $db->table('wa_blast_history');

            if (!empty($villageId) && $villageId !== 'ALL') {
                $builder->where('villageId', $villageId);
            }

            $builder->orderBy('createdAt', 'DESC')->limit(50);
            $history = $builder->get()->getResultArray();

            foreach ($history as &$h) {
                if (!empty($h['details'])) {
                    $h['details'] = json_decode($h['details'], true);
                }
            }

            return $this->response->setJSON([
                'success' => true,
                'data'    => $history
            ]);
        } catch (\Exception $e) {
            return $this->response->setStatusCode(500)->setJSON([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * DELETE /wa_blast/history/{id}
     * Hapus riwayat dari database
     */
    public function deleteHistory($id = null)
    {
        try {
            if (empty($id)) {
                return $this->response->setStatusCode(400)->setJSON(['success' => false, 'message' => 'ID riwayat tidak valid']);
            }
            $db = Database::connect();
            $db->table('wa_blast_history')->where('id', $id)->delete();

            return $this->response->setJSON([
                'success' => true,
                'message' => 'Riwayat berhasil dihapus dari database'
            ]);
        } catch (\Exception $e) {
            return $this->response->setStatusCode(500)->setJSON([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
}
