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

            // q. villages
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
}
