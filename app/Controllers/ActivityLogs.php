<?php

namespace App\Controllers;

use Config\Database;

class ActivityLogs extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Log Aktivitas Sistem'
        ];
        return view('activity_logs/index', $data);
    }

    /**
     * Endpoint lokal untuk mengambil data log aktivitas langsung dari MySQL
     * GET /activity_logs/data
     */
    public function getData()
    {
        try {
            $db = Database::connect();

            if (!$db->tableExists('activity_logs')) {
                return $this->response->setJSON([
                    'success' => true,
                    'data' => [],
                    'total' => 0,
                    'page' => 1,
                    'totalPages' => 0
                ]);
            }

            $villageId = $this->request->getGet('villageId');
            $action = $this->request->getGet('action');
            $search = $this->request->getGet('search');
            $page = max((int)($this->request->getGet('page') ?? 1), 1);
            $limit = min(max((int)($this->request->getGet('limit') ?? 50), 1), 200);
            $offset = ($page - 1) * $limit;

            $builder = $db->table('activity_logs as al')
                ->select('al.*, v.name as villageName, v.uniqueCode as villageUniqueCode')
                ->join('villages as v', 'al.villageId = v.id', 'left');

            if (!empty($villageId) && $villageId !== 'ALL') {
                $builder->where('al.villageId', $villageId);
            }

            if (!empty($action) && $action !== 'ALL') {
                $builder->where('al.action', $action);
            }

            if (!empty($search)) {
                $builder->groupStart()
                    ->like('al.userName', $search)
                    ->orLike('al.userEmail', $search)
                    ->orLike('al.targetName', $search)
                    ->orLike('al.description', $search)
                    ->orLike('al.action', $search)
                    ->orLike('al.ipAddress', $search)
                    ->groupEnd();
            }

            $countBuilder = clone $builder;
            $total = $countBuilder->countAllResults(false);

            $rows = $builder->orderBy('al.createdAt', 'DESC')
                ->limit($limit, $offset)
                ->get()
                ->getResultArray();

            foreach ($rows as &$row) {
                if (!empty($row['details']) && is_string($row['details'])) {
                    $decoded = json_decode($row['details'], true);
                    $row['details'] = $decoded !== null ? $decoded : $row['details'];
                }
                if (!empty($row['villageName'])) {
                    $row['Village'] = [
                        'id' => $row['villageId'],
                        'name' => $row['villageName'],
                        'uniqueCode' => $row['villageUniqueCode']
                    ];
                }
            }

            return $this->response->setJSON([
                'success' => true,
                'data' => $rows,
                'total' => $total,
                'page' => $page,
                'limit' => $limit,
                'totalPages' => ceil($total / $limit)
            ]);
        } catch (\Exception $e) {
            return $this->response->setStatusCode(500)->setJSON([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
}
