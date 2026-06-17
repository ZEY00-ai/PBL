<?php

namespace App\Controllers\Controlpanel\admin;

use App\Controllers\BaseController;
use App\Models\SekolahModel;
use Dompdf\Dompdf;
use Dompdf\Options;

class LaporanController extends BaseController
{
    protected SekolahModel $sekolahModel;

    public function __construct()
    {
        $this->sekolahModel = new SekolahModel();
    }

    public function index()
    {
        $kecamatan = $this->sekolahModel
            ->select('kecamatan')
            ->distinct()
            ->orderBy('kecamatan', 'ASC')
            ->findAll();

        $sekolah = $this->sekolahModel
            ->orderBy('nama_sekolah', 'ASC')
            ->findAll();

        $totalGeoJson = (new \App\Models\GeoJsonModel())->countAllResults();

        return view('control-panel/admin/laporan/v_index', [
            'kecamatan'    => $kecamatan,
            'sekolah'      => $sekolah,
            'totalGeoJson' => $totalGeoJson,
        ]);
    }

    public function export()
    {
        $filter = $this->request->getGet('filter');
        $nilai  = $this->request->getGet('nilai');

        if ($filter === 'kecamatan' && $nilai) {
            $data  = $this->sekolahModel->where('kecamatan', $nilai)->orderBy('nama_sekolah', 'ASC')->findAll();
            $judul = 'Laporan Sekolah Kecamatan ' . $nilai;
        } elseif ($filter === 'sekolah' && $nilai) {
            $data  = $this->sekolahModel->where('id', $nilai)->findAll();
            $judul = 'Laporan Sekolah ' . ($data[0]['nama_sekolah'] ?? '');
        } elseif ($filter === 'tingkatan' && $nilai) {
            $data  = $this->sekolahModel->where('tingkatan', $nilai)->orderBy('nama_sekolah', 'ASC')->findAll();
            $judul = 'Laporan Sekolah Tingkat ' . $nilai;
        } elseif ($filter === 'akreditasi' && $nilai) {
            $data  = $this->sekolahModel->where('akreditasi', $nilai)->orderBy('nama_sekolah', 'ASC')->findAll();
            $judul = 'Laporan Sekolah Akreditasi ' . $nilai;
        } else {
            $data  = $this->sekolahModel->orderBy('nama_sekolah', 'ASC')->findAll();
            $judul = 'Laporan Semua Sekolah';
        }

        // Buat HTML untuk PDF
        $html = '
        <html>
        <head>
            <meta charset="UTF-8">
            <style>
                body { font-family: Arial, sans-serif; font-size: 11px; }
                h2 { text-align: center; margin-bottom: 4px; }
                p.sub { text-align: center; color: #666; margin-bottom: 16px; font-size: 10px; }
                table { width: 100%; border-collapse: collapse; margin-top: 10px; }
                th { background: #4272d7; color: #fff; padding: 7px 6px; text-align: center; font-size: 10px; }
                td { padding: 6px; border: 1px solid #ddd; font-size: 10px; vertical-align: top; }
                tr:nth-child(even) { background: #f4f6fa; }
                .text-center { text-align: center; }
                .footer { margin-top: 20px; font-size: 10px; color: #888; text-align: right; }
            </style>
        </head>
        <body>
            <h2>' . $judul . '</h2>
            <p class="sub">Tanggal: ' . date('d F Y') . ' | Kabupaten Tanah Datar</p>
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Sekolah</th>
                        <th>NPSN</th>
                        <th>Tingkatan</th>
                        <th>Akreditasi</th>
                        <th>Kecamatan</th>
                        <th>Alamat</th>
                        <th>Tahun Berdiri</th>
                        <th>Website</th>
                        <th>Latitude</th>
                        <th>Longitude</th>
                    </tr>
                </thead>
                <tbody>';

        foreach ($data as $i => $s) {
            $html .= '<tr>
                <td class="text-center">' . ($i + 1) . '</td>
                <td>' . htmlspecialchars($s['nama_sekolah']) . '</td>
                <td class="text-center">' . ($s['npsn'] ?? '-') . '</td>
                <td class="text-center">' . ($s['tingkatan'] ?? '-') . '</td>
                <td class="text-center">' . ($s['akreditasi'] ?? '-') . '</td>
                <td>' . htmlspecialchars($s['kecamatan']) . '</td>
                <td>' . htmlspecialchars($s['alamat']) . '</td>
                <td class="text-center">' . ($s['tahun_berdiri'] ?? '-') . '</td>
                <td>' . ($s['website'] ? htmlspecialchars($s['website']) : '-') . '</td>
                <td class="text-center">' . $s['latitude'] . '</td>
                <td class="text-center">' . $s['longitude'] . '</td>
            </tr>';
        }

        $html .= '
                </tbody>
            </table>
            <div class="footer">Total: ' . count($data) . ' sekolah</div>
        </body>
        </html>';

        // Generate PDF
        $options = new Options();
        $options->set('defaultFont', 'Arial');
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        $filename = 'laporan_sekolah_' . date('Ymd_His') . '.pdf';
        $dompdf->stream($filename, ['Attachment' => true]);
        exit;
    }
}
