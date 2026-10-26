<?php

namespace App\Controllers;

class Tutorial extends BaseController
{
    /**
     * Halaman Publik Tutorial & Panduan Lengkap Jimpitan APK
     * Dapat diakses oleh semua pengguna tanpa perlu login admin
     */
    public function index()
    {
        $data = [
            'title'       => 'Panduan Lengkap Penggunaan Aplikasi Jimpitan Mobile',
            'version'     => '1.10.x',
            'lastUpdated' => 'Oktober 2026',
        ];

        return view('tutorial/index', $data);
    }

    /**
     * Download langsung Template CSV Data Warga
     */
    public function downloadTemplate()
    {
        $filePath = FCPATH . 'tutorial_assets/template_warga_jimpitan.csv';
        if (file_exists($filePath)) {
            return $this->response->download($filePath, null)->setFileName('template_warga_jimpitan.csv');
        }

        // Fallback jika file belum ada di disk
        $csvHeader = "No KK,NIK,Nama Lengkap,Status Hubungan,Status Perkawinan,Jenis Kelamin,Tempat Lahir,Tanggal Lahir,Alamat,Agama,Pekerjaan,Status Hidup,Email,No HP,Jabatan,Kode Rumah\n";
        $csvSample = "3273010101900001,3273010101900001,Bambang Sudarmono,Kepala Keluarga,Kawin,Laki-laki,Bandung,1985-05-12,Jl. Mawar No. 12 RT 04 RW 02,Islam,Wiraswasta,Aktif,bambang@example.com,081234567890,WARGA,A-12\n"
                   . "3273010101900001,3273010101920002,Siti Aminah,Istri,Kawin,Perempuan,Bandung,1988-08-20,Jl. Mawar No. 12 RT 04 RW 02,Islam,Mengurus Rumah Tangga,Aktif,siti@example.com,081234567891,WARGA,A-12\n"
                   . "3273010101900001,3273010101150003,Rizky Pratama,Anak,Belum Kawin,Laki-laki,Bandung,2015-02-14,Jl. Mawar No. 12 RT 04 RW 02,Islam,Pelajar/Mahasiswa,Aktif,,081234567892,WARGA,A-12\n";

        return $this->response
            ->setContentType('text/csv')
            ->setHeader('Content-Disposition', 'attachment; filename="template_warga_jimpitan.csv"')
            ->setBody($csvHeader . $csvSample);
    }
}
