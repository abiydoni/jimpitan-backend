<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Dashboard Utama'
        ];
        return view('dashboard/index', $data);
    }

    /**
     * Endpoint API lokal untuk dashboard summary & grafik registrasi desa per hari
     * GET /dashboard/summary?days=7
     */
    public function getSummary()
    {
        try {
            $db = \Config\Database::connect();

            // 1. Total Desa
            $totalVillages = 0;
            if ($db->tableExists('villages')) {
                $totalVillages = $db->table('villages')->countAllResults();
            }

            // 2. Total Warga
            $totalUsers = 0;
            if ($db->tableExists('users')) {
                $totalUsers = $db->table('users')->countAllResults();
            }

            // 3. Jimpitan Bulan Ini
            $totalJimpitan = 0;
            if ($db->tableExists('jimpitan_history')) {
                $firstDay = date('Y-m-01');
                $lastDay = date('Y-m-t');
                $row = $db->table('jimpitan_history')
                    ->selectSum('amountCollected', 'total')
                    ->where('date >=', $firstDay)
                    ->where('date <=', $lastDay)
                    ->get()->getRowArray();
                $totalJimpitan = (float)($row['total'] ?? 0);
            }

            // 4. Total Jurnal & Aktivitas Terbaru
            $pendingReports = 0;
            $recentActivities = [];
            if ($db->tableExists('dues_journals')) {
                $pendingReports = $db->table('dues_journals')->countAllResults();
                $recentActivities = $db->table('dues_journals')
                    ->select('id, amount, type, journalType, description, createdAt')
                    ->orderBy('createdAt', 'DESC')
                    ->limit(6)
                    ->get()->getResultArray();
            }

            // 5. Grafik Registrasi Desa per Hari
            $days = (int)($this->request->getGet('days') ?? 7);
            if ($days <= 0 || $days > 90) {
                $days = 7;
            }

            $dailyMap = [];
            if ($db->tableExists('villages')) {
                $fields = $db->getFieldNames('villages');
                $hasCreatedAt = in_array('createdAt', $fields);

                if ($hasCreatedAt) {
                    $villages = $db->table('villages')->select('id, name, createdAt')->get()->getResultArray();
                    foreach ($villages as $v) {
                        if (!empty($v['createdAt'])) {
                            $dateKey = date('Y-m-d', strtotime($v['createdAt']));
                            $dailyMap[$dateKey] = ($dailyMap[$dateKey] ?? 0) + 1;
                        }
                    }
                }
            }

            $dayNames = ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'];
            $monthNames = ['', 'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];

            $chartData = [];
            for ($i = $days - 1; $i >= 0; $i--) {
                $timestamp = strtotime("-{$i} days");
                $dateKey = date('Y-m-d', $timestamp);

                $dayOfWeek = (int)date('w', $timestamp);
                $dayNum = date('j', $timestamp);
                $monthNum = (int)date('n', $timestamp);

                $label = $dayNames[$dayOfWeek] . ', ' . $dayNum . ' ' . $monthNames[$monthNum];

                $chartData[] = [
                    'date'  => $dateKey,
                    'label' => $label,
                    'value' => $dailyMap[$dateKey] ?? 0
                ];
            }

            return $this->response->setJSON([
                'success' => true,
                'data' => [
                    'totalVillages'    => $totalVillages,
                    'totalUsers'       => $totalUsers,
                    'totalJimpitan'    => $totalJimpitan,
                    'pendingReports'   => $pendingReports,
                    'recentActivities' => $recentActivities,
                    'chartData'        => $chartData,
                    'villageChartData' => $chartData
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
