<?php

namespace App\Controllers;

use Config\Database;

class Settings extends BaseController
{
    private function ensureSettingsTable()
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
        } catch (\Exception $e) {
            // Silently catch
        }
    }

    public function index()
    {
        $data = [
            'title' => 'Pengaturan Sistem & Integrasi'
        ];
        return view('settings/index', $data);
    }

    /**
     * GET /settings/wa_group
     * Mengambil konfigurasi WhatsApp Group dari tabel system_settings
     */
    public function getWaGroupSettings()
    {
        $this->ensureSettingsTable();

        try {
            $db = Database::connect();
            $settings = $db->table('system_settings')->whereIn('key', [
                'WA_GROUP_TARGET_NUMBER',
                'WA_API_URL',
                'WA_API_KEY',
                'WA_SESSION_ID',
                'WA_GROUP_VILLAGE_ID',
                'WA_GROUP_NOTIFICATION_ENABLED'
            ])->get()->getResultArray();

            $map = [];
            foreach ($settings as $s) {
                $map[$s['key']] = $s['value'];
            }

            // Ambil daftar desa aktif untuk opsi dropdown
            $villages = [];
            try {
                $villages = $db->table('villages')->select('id, name, uniqueCode')->orderBy('name', 'ASC')->get()->getResultArray();
            } catch (\Exception $ex) {}

            return $this->response->setJSON([
                'success' => true,
                'data'    => [
                    'targetNumber'  => $map['WA_GROUP_TARGET_NUMBER'] ?? '6285729705810-1505093181@g.us',
                    'appsbeeUrl'    => $map['WA_API_URL'] ?? 'https://wa-ab.appsbee.my.id/api/send-message',
                    'appsbeeApiKey' => $map['WA_API_KEY'] ?? 'wa-69aa3dbf930020c93f34b83add6374e8',
                    'sessionId'     => $map['WA_SESSION_ID'] ?? 'appsbee',
                    'villageId'     => $map['WA_GROUP_VILLAGE_ID'] ?? 'village_001',
                    'isEnabled'     => isset($map['WA_GROUP_NOTIFICATION_ENABLED']) ? ($map['WA_GROUP_NOTIFICATION_ENABLED'] === '1' || $map['WA_GROUP_NOTIFICATION_ENABLED'] === 'true') : true,
                    'villages'      => $villages
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
     * POST|PUT /settings/wa_group
     * Menyimpan konfigurasi WhatsApp Group ke tabel system_settings
     */
    public function saveWaGroupSettings()
    {
        $this->ensureSettingsTable();

        try {
            $raw = $this->request->getJSON(true) ?? $this->request->getPost();

            $targetNumber  = trim((string)($raw['targetNumber'] ?? '6285729705810-1505093181@g.us'));
            $appsbeeUrl    = trim((string)($raw['appsbeeUrl'] ?? 'https://wa-ab.appsbee.my.id/api/send-message'));
            $appsbeeApiKey = trim((string)($raw['appsbeeApiKey'] ?? 'wa-69aa3dbf930020c93f34b83add6374e8'));
            $sessionId     = trim((string)($raw['sessionId'] ?? 'appsbee'));
            $villageId     = trim((string)($raw['villageId'] ?? 'village_001'));
            $isEnabled     = (!empty($raw['isEnabled']) && ($raw['isEnabled'] === true || $raw['isEnabled'] === '1' || $raw['isEnabled'] === 1)) ? '1' : '0';

            $db = Database::connect();

            $pairs = [
                'WA_GROUP_TARGET_NUMBER' => [
                    'value' => $targetNumber,
                    'desc'  => 'Nomor / JID WhatsApp Group Tujuan Notifikasi Auto Jimpitan'
                ],
                'WA_API_URL' => [
                    'value' => $appsbeeUrl,
                    'desc'  => 'URL Endpoint Gateway Appsbee WhatsApp'
                ],
                'WA_API_KEY' => [
                    'value' => $appsbeeApiKey,
                    'desc'  => 'API Key Gateway Appsbee WhatsApp'
                ],
                'WA_SESSION_ID' => [
                    'value' => $sessionId,
                    'desc'  => 'Session ID / Device Pengirim WhatsApp'
                ],
                'WA_GROUP_VILLAGE_ID' => [
                    'value' => $villageId,
                    'desc'  => 'ID Desa untuk Chat Group Aplikasi Jimpitan'
                ],
                'WA_GROUP_NOTIFICATION_ENABLED' => [
                    'value' => $isEnabled,
                    'desc'  => 'Status Aktif Notifikasi Otomatis ke WA Group (1: Aktif, 0: Nonaktif)'
                ],
            ];

            foreach ($pairs as $key => $item) {
                $existing = $db->table('system_settings')->where('key', $key)->get()->getRowArray();
                if ($existing) {
                    $db->table('system_settings')->where('key', $key)->update([
                        'value'     => $item['value'],
                        'updatedAt' => date('Y-m-d H:i:s')
                    ]);
                } else {
                    $db->table('system_settings')->insert([
                        'key'         => $key,
                        'value'       => $item['value'],
                        'description' => $item['desc'],
                        'createdAt'   => date('Y-m-d H:i:s'),
                        'updatedAt'   => date('Y-m-d H:i:s')
                    ]);
                }
            }

            return $this->response->setJSON([
                'success' => true,
                'message' => 'Pengaturan notifikasi WhatsApp Group berhasil disimpan ke database system_settings'
            ]);
        } catch (\Exception $e) {
            return $this->response->setStatusCode(500)->setJSON([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
}
