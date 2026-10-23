<?php

namespace App\Controllers;

use Config\Database;

class Villages extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Data Desa'
        ];
        return view('villages/index', $data);
    }

    /**
     * Hapus desa beserta seluruh data terkait di tabel lain yang berhubungan dengan desa / kode desa tersebut.
     * DELETE /villages/(:segment) atau POST /villages/delete/(:segment)
     */
    public function delete($id = null)
    {
        if (empty($id)) {
            return $this->response->setStatusCode(400)->setJSON([
                'success' => false,
                'message' => 'ID Desa tidak valid'
            ]);
        }

        try {
            $db = Database::connect();

            // 1. Ambil data desa terlebih dahulu untuk mengetahui uniqueCode
            $village = $db->table('villages')->where('id', $id)->get()->getRowArray();
            if (!$village) {
                // Coba cari berdasarkan uniqueCode jika ID yang dikirim berupa uniqueCode
                $village = $db->table('villages')->where('uniqueCode', $id)->get()->getRowArray();
            }

            if (!$village) {
                return $this->response->setStatusCode(404)->setJSON([
                    'success' => false,
                    'message' => 'Desa tidak ditemukan'
                ]);
            }

            $villageId = $village['id'];
            $uniqueCode = !empty($village['uniqueCode']) ? $village['uniqueCode'] : null;

            // 2. Ambil seluruh UID pengguna yang terikat ke desa ini (melalui villageId atau uniqueCode)
            $userBuilder = $db->table('users')->select('uid')->where('villageId', $villageId);
            if (!empty($uniqueCode)) {
                $userBuilder->orWhere('uniqueCode', $uniqueCode);
            }
            $users = $userBuilder->get()->getResultArray();
            $userUids = array_filter(array_column($users, 'uid'));

            $db->transStart();
            $db->query('SET FOREIGN_KEY_CHECKS = 0;');

            // a. group_read_states
            $grsBuilder = $db->table('group_read_states');
            $grsBuilder->where('roomId', 'GROUP_' . $villageId);
            if (!empty($userUids)) {
                $grsBuilder->orWhereIn('userId', $userUids);
            }
            $grsBuilder->delete();

            // b. chat_messages
            $chatBuilder = $db->table('chat_messages');
            $chatBuilder->where('villageId', $villageId)
                       ->orWhere('roomId', 'GROUP_' . $villageId);
            if (!empty($userUids)) {
                $chatBuilder->orWhereIn('senderUid', $userUids)
                            ->orWhereIn('receiverUid', $userUids);
            }
            $chatBuilder->delete();

            // c. jimpitan_history
            $db->table('jimpitan_history')->where('villageId', $villageId)->delete();

            // d. dues_journals
            $db->table('dues_journals')->where('villageId', $villageId)->delete();

            // e. inventory_loans
            $db->table('inventory_loans')->where('villageId', $villageId)->delete();

            // f. inventory_items
            $db->table('inventory_items')->where('villageId', $villageId)->delete();

            // g. exemptions
            $db->table('exemptions')->where('villageId', $villageId)->delete();

            // h. tariffs
            $db->table('tariffs')->where('villageId', $villageId)->delete();

            // i. schedules
            $db->table('schedules')->where('villageId', $villageId)->delete();

            // j. slides (banner desa)
            $db->table('slides')->where('villageId', $villageId)->delete();

            // k. menus (menu kustom desa)
            $db->table('menus')->where('villageId', $villageId)->delete();

            // l. roles (jabatan user desa)
            $roleBuilder = $db->table('roles')->where('villageId', $villageId);
            if (!empty($userUids)) {
                $roleBuilder->orWhereIn('userId', $userUids);
            }
            $roleBuilder->delete();

            // m. invoices
            $db->table('invoices')->where('villageId', $villageId)->delete();

            // n. village_subscriptions
            $db->table('village_subscriptions')->where('villageId', $villageId)->delete();

            // o. wa_blast_history
            $db->table('wa_blast_history')->where('villageId', $villageId)->delete();

            // p. users (semua warga/admin desa)
            $userDeleteBuilder = $db->table('users')->where('villageId', $villageId);
            if (!empty($uniqueCode)) {
                $userDeleteBuilder->orWhere('uniqueCode', $uniqueCode);
            }
            $userDeleteBuilder->delete();

            // q. activity_logs
            if ($db->tableExists('activity_logs')) {
                $db->table('activity_logs')->where('villageId', $villageId)->delete();
            }

            // r. villages
            $db->table('villages')->where('id', $villageId)->delete();

            $db->query('SET FOREIGN_KEY_CHECKS = 1;');
            $db->transComplete();

            if ($db->transStatus() === false) {
                return $this->response->setStatusCode(500)->setJSON([
                    'success' => false,
                    'message' => 'Gagal menghapus desa: Transaksi database gagal'
                ]);
            }

            return $this->response->setJSON([
                'success' => true,
                'message' => "Desa {$village['name']} dan semua data terkait berhasil dihapus"
            ]);
        } catch (\Exception $e) {
            return $this->response->setStatusCode(500)->setJSON([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Kirim notifikasi chat pendaftaran desa secara manual.
     * Mengirim pesan #1 dari SYSTEM ke Super Admin dan pesan #2 dari Super Admin ke Admin Desa.
     * POST /villages/notify/(:segment)
     */
    public function notifyChat($id = null)
    {
        if (empty($id)) {
            return $this->response->setStatusCode(400)->setJSON([
                'success' => false,
                'message' => 'ID Desa tidak valid'
            ]);
        }

        try {
            $db = Database::connect();

            // 1. Ambil data desa
            $village = $db->table('villages')->where('id', $id)->get()->getRowArray();
            if (!$village) {
                $village = $db->table('villages')->where('uniqueCode', $id)->get()->getRowArray();
            }

            if (!$village) {
                return $this->response->setStatusCode(404)->setJSON([
                    'success' => false,
                    'message' => 'Desa tidak ditemukan'
                ]);
            }

            $villageId = $village['id'];
            $villageName = $village['name'] ?? 'Desa Baru';
            $uniqueCode = $village['uniqueCode'] ?? '-';
            $address = $village['address'] ?? '-';

            // 2. Cari Super Admin
            $superadmin = $db->table('users')->where('email', 'appsbeem@gmail.com')->get()->getRowArray();
            if (!$superadmin) {
                $superadmin = $db->table('users')->where('uid', 'SUPER_ADMIN')->get()->getRowArray();
            }
            if (!$superadmin) {
                $roleSa = $db->table('roles')->where('name', 'SUPER_ADMIN')->where('userId IS NOT NULL')->get()->getRowArray();
                if ($roleSa) {
                    $superadmin = $db->table('users')->where('uid', $roleSa['userId'])->get()->getRowArray();
                }
            }
            $appsbeeUid = $superadmin['uid'] ?? 'SUPER_ADMIN';

            // 3. Pastikan user SYSTEM_BOT ada
            $systemBot = $db->table('users')->where('uid', 'SYSTEM_BOT')->get()->getRowArray();
            if (!$systemBot) {
                $db->table('users')->insert([
                    'uid' => 'SYSTEM_BOT',
                    'name' => 'Sistem Registrasi',
                    'foto' => 'https://cdn-icons-png.flaticon.com/512/4712/4712109.png',
                    'photoUrl' => 'https://cdn-icons-png.flaticon.com/512/4712/4712109.png',
                    'status' => 'ACTIVE'
                ]);
            }

            // 4. Cari Admin Desa terkait
            $adminRole = $db->table('roles')
                ->where('villageId', $villageId)
                ->where('name', 'ADMIN_DESA')
                ->where('userId IS NOT NULL')
                ->get()->getRowArray();

            $registrantUser = null;
            if ($adminRole && !empty($adminRole['userId'])) {
                $registrantUser = $db->table('users')->where('uid', $adminRole['userId'])->get()->getRowArray();
            }
            if (!$registrantUser) {
                $registrantUser = $db->table('users')->where('villageId', $villageId)->get()->getRowArray();
            }

            $targetRegistrantUid = $registrantUser['uid'] ?? null;
            $registrantName = $registrantUser['name'] ?? 'Admin Desa';
            $registrantPhone = $registrantUser['phoneNumber'] ?? ($registrantUser['phone'] ?? '-');
            $registrantEmail = $registrantUser['email'] ?? null;

            $now = date('Y-m-d H:i:s');
            $dateFormatted = date('d M Y');
            $timeFormatted = date('H:i');

            // --- PESAN 1: Notifikasi ke Super Admin dari SYSTEM ---
            $systemRoomId = 'PERSONAL_' . min($appsbeeUid, 'SYSTEM_BOT') . '_' . max($appsbeeUid, 'SYSTEM_BOT');
            $adminLines = [
                "🏛️ *PENDAFTARAN DESA BARU*",
                "",
                "Telah terdaftar desa baru di sistem Jimpitan:",
                "• *Nama Desa*: {$villageName}",
                "• *Kode Unik*: {$uniqueCode}",
                "• *Alamat*: {$address}",
                "• *Pendaftar*: {$registrantName}",
                "• *No. HP/WA*: {$registrantPhone}",
                $registrantEmail ? "• *Email*: {$registrantEmail}" : "",
                "• *Waktu*: {$dateFormatted}, {$timeFormatted} WIB",
                "",
                "Data registrasi telah berhasil disimpan dan siap dikelola."
            ];
            $adminMessageText = implode("\n", array_filter($adminLines));

            $db->table('chat_messages')->insert([
                'id' => 'msg_' . bin2hex(random_bytes(16)),
                'villageId' => $villageId,
                'senderUid' => 'SYSTEM_BOT',
                'senderName' => 'Sistem Registrasi',
                'receiverUid' => $appsbeeUid,
                'roomId' => $systemRoomId,
                'message' => $adminMessageText,
                'isRead' => 0,
                'isDeleted' => 0,
                'isEdited' => 0,
                'isForwarded' => 0,
                'createdAt' => $now,
                'updatedAt' => $now
            ]);

            // --- PESAN 2: Sambutan dari Super Admin ke Admin Desa Baru ---
            if ($targetRegistrantUid) {
                $adminDesaRoomId = 'PERSONAL_' . min($appsbeeUid, $targetRegistrantUid) . '_' . max($appsbeeUid, $targetRegistrantUid);
                $welcomeLines = [
                    "🎉 *SELAMAT DATANG DI JIMPITAN!*",
                    "",
                    "Halo *{$registrantName}*,",
                    "Selamat! Pendaftaran desa Anda telah berhasil diproses dan kini sudah aktif di sistem Jimpitan.",
                    "",
                    "🏛️ *Nama Desa*: {$villageName}",
                    "🔑 *Kode Unik Desa*: *{$uniqueCode}*",
                    "📍 *Alamat*: {$address}",
                    "⭐ *Status Layanan*: Aktif (Free Trial 1 Bulan)",
                    "",
                    "*Langkah Selanjutnya:*",
                    "1. Bagikan *Kode Unik Desa* (*{$uniqueCode}*) kepada para pengurus RT/RW dan warga agar dapat bergabung di aplikasi.",
                    "2. Atur tarif jimpitan, jadwal ronda, dan nomor rekening penampung di menu Pengaturan.",
                    "3. Tambahkan atau kelola data kartu keluarga (KK) serta warga desa Anda.",
                    "",
                    "Jika Anda memiliki pertanyaan atau membutuhkan bantuan teknis, Anda dapat langsung membalas pesan ini untuk terhubung dengan tim Appsbee Support.",
                    "",
                    "Salam hangat,",
                    "*Tim Appsbee Support*"
                ];
                $welcomeMessageText = implode("\n", $welcomeLines);

                $db->table('chat_messages')->insert([
                    'id' => 'msg_' . bin2hex(random_bytes(16)),
                    'villageId' => $villageId,
                    'senderUid' => $appsbeeUid,
                    'senderName' => 'Appsbee Support',
                    'receiverUid' => $targetRegistrantUid,
                    'roomId' => $adminDesaRoomId,
                    'message' => $welcomeMessageText,
                    'isRead' => 0,
                    'isDeleted' => 0,
                    'isEdited' => 0,
                    'isForwarded' => 0,
                    'createdAt' => $now,
                    'updatedAt' => $now
                ]);
            }

            return $this->response->setJSON([
                'success' => true,
                'message' => "Notifikasi chat pendaftaran desa \"{$villageName}\" berhasil dikirim!",
                'data' => [
                    'villageName' => $villageName,
                    'uniqueCode' => $uniqueCode,
                    'registrantName' => $registrantName
                ]
            ]);
        } catch (\Exception $e) {
            return $this->response->setStatusCode(500)->setJSON([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
}
