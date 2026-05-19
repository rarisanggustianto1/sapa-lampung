<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'petugas') {
    header("Location: ../login.php");
    exit;
}

include '../config/koneksi.php';

$nama = $_SESSION['nama'] ?? 'Petugas';
$id_ptg_log = $_SESSION['id_petugas'] ?? 0;
$kode_petugas = $_SESSION['kode_petugas'] ?? 'PTG-000';
$divisi_petugas = $_SESSION['divisi'] ?? 'Umum';

$arr_nama = explode(' ', $nama);
$inisial = strtoupper(substr($arr_nama[0], 0, 1) . (isset($arr_nama[1]) ? substr($arr_nama[1], 0, 1) : ''));

$query_riwayat = mysqli_query($conn, "SELECT laporan.*, kategori.nama_kategori, tracking_progress.keterangan as laporan_petugas, tracking_progress.foto_progres
                                      FROM laporan 
                                      JOIN kategori ON laporan.id_kategori = kategori.id_kategori 
                                      LEFT JOIN tracking_progress ON laporan.id_laporan = tracking_progress.id_laporan AND tracking_progress.persentase = 100
                                      WHERE laporan.id_petugas = '$id_ptg_log' AND laporan.status = 'Selesai'
                                      ORDER BY laporan.tanggal_lapor DESC");
$total_rows = mysqli_num_rows($query_riwayat);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Tugas Selesai — SAPA Petugas</title>
    <link rel="stylesheet" href="../assets/css/global.css">
    <link rel="stylesheet" href="../assets/css/petugas.css">
    <style>
        .modal { display: none; position: fixed; z-index: 9999; left: 0; top: 0; width: 100%; height: 100%; overflow: auto; background-color: rgba(0,0,0,0.5); backdrop-filter: blur(4px); }
        .modal-content { background-color: #fff; margin: 6% auto; padding: 24px; border-radius: 16px; width: 90%; max-width: 550px; box-shadow: 0 4px 24px rgba(0,0,0,0.2); position: relative; animation: animatetop 0.3s ease; }
        @keyframes animatetop { from {top: -100px; opacity: 0} to {top: 0; opacity: 1} }
        .close-btn { position: absolute; right: 20px; top: 15px; color: #aaa; font-size: 28px; font-weight: bold; cursor: pointer; }
        .close-btn:hover { color: #c62828; }
        .detail-item { border-bottom: 1px solid #f0f0f5; padding-bottom: 8px; margin-bottom: 8px; }
        .detail-item strong { display: block; font-size: 11px; color: #8a8a9a; text-transform: uppercase; }
        .detail-item span { font-size: 14px; color: #1a1a2e; font-weight: 600; }
        .modal-img { max-height: 160px; object-fit: contain; border-radius: 6px; border: 1px solid #eee; margin-top: 4px; display: block; }
    </style>
</head>
<body>

<div class="dashboard-layout">

    <aside class="sidebar">
        <div>
            <div class="sidebar-brand">
                <div class="sidebar-logo">P</div>
                <div>
                    <div class="sidebar-brand-name">SAPA Petugas</div>
                    <div class="sidebar-brand-sub">Panel Petugas Lapangan</div>
                </div>
            </div>
            <nav class="sidebar-nav">
                <a href="petugas.php" class="sidebar-item">&ensp;Dashboard</a>
                <a href="daftar-tugas.php" class="sidebar-item">&ensp;Daftar Tugas</a>
                <a href="riwayat.php" class="sidebar-item active">&ensp;Riwayat Kerja</a>
            </nav>
        </div>
        <div class="sidebar-footer">
            <div class="sidebar-user">
                <div class="sidebar-avatar"><?= $inisial; ?></div>
                <div>
                    <div class="sidebar-user-name"><?= htmlspecialchars($nama); ?></div>
                    <div class="sidebar-user-role"><?= htmlspecialchars($kode_petugas); ?></div>
                </div>
            </div>
            <a href="#" class="sidebar-logout" onclick="window.location.href='../logout.php'">Keluar</a>
        </div>
    </aside>

    <main class="main-content">
        <div class="topbar">
            <div>
                <h1 class="page-title">Riwayat Penugasan Selesai</h1>
                <p class="page-subtitle">Arsip seluruh lembar laporan pengaduan daerah yang telah Anda tuntaskan</p>
            </div>
        </div>

        <div class="content-body">
            <div class="card">
                <div class="card-header">
                    <div>
                        <div class="card-title">Arsip Pekerjaan Tuntas</div>
                        <div class="card-subtitle">Total: <?= $total_rows; ?> pekerjaan diselesaikan</div>
                    </div>
                </div>

                <div class="table-wrap">
                    <table>
                        <thead>
                            <tr>
                                <th>ID Laporan</th>
                                <th>Judul Kendala</th>
                                <th>Kategori</th>
                                <th>Tanggal Masuk</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($total_rows > 0) : ?>
                                <?php while($row = mysqli_fetch_assoc($query_riwayat)) : ?>
                                <tr>
                                    <td><span class="id-badge"><?= $row['id_laporan']; ?></span></td>
                                    <td><strong><?= htmlspecialchars($row['judul_laporan']); ?></strong></td>
                                    <td><span class="cat-tag"><?= $row['nama_kategori']; ?></span></td>
                                    <td><?= date('d M Y', strtotime($row['tanggal_lapor'])); ?></td>
                                    <td>
                                        <button class="table-btn" onclick='openDetailModal(<?= json_encode($row); ?>)'>Detail Pekerjaan</button>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            <?php else : ?>
                                <tr><td colspan="5" style="text-align:center; padding:20px; color:#64748b;">Belum ada arsip pekerjaan selesai.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</div>

<div id="detailModal" class="modal">
    <div class="modal-content">
        <span class="close-btn" onclick="document.getElementById('detailModal').style.display='none'">&times;</span>
        <h3 style="font-size: 18px; font-weight: 800; border-bottom: 2px solid #f0f0f5; padding-bottom: 8px; margin-bottom: 15px; color:#1a1a2e;">Detail Riwayat Tugas</h3>
        
        <div class="detail-item">
            <strong>ID Pengaduan</strong>
            <span id="m-id"></span>
        </div>
        <div class="detail-item">
            <strong>Judul Keluhan Warga</strong>
            <span id="m-judul"></span>
        </div>
        <div class="detail-item">
            <strong>Lokasi Kejadian</strong>
            <span id="m-alamat"></span>
        </div>
        <div class="detail-item">
            <strong>Laporan Kronologi Selesai</strong>
            <p id="m-laporan" style="font-size:13px; color:#475569; margin:4px 0 0 0; line-height:1.4;"></p>
        </div>
        <div class="detail-item" style="border:none;">
            <strong>Foto Hasil Akhir Lapangan</strong>
            <img id="m-img" src="" class="modal-img" alt="Foto Progres">
        </div>
    </div>
</div>

<script>
function openDetailModal(data) {
    document.getElementById('m-id').innerText = data.id_laporan;
    document.getElementById('m-judul').innerText = data.judul_laporan;
    document.getElementById('m-alamat').innerText = data.alamat_kejadian;
    document.getElementById('m-laporan').innerText = data.laporan_petugas ? data.laporan_petugas : "Pekerjaan dinyatakan rampung oleh administrasi.";
    
    if(data.foto_progres) {
        document.getElementById('m-img').src = "../assets/img/laporan/" + data.foto_progres;
        document.getElementById('m-img').style.display = "block";
    } else {
        document.getElementById('m-img').style.display = "none";
    }
    
    document.getElementById('detailModal').style.display = 'block';
}

window.onclick = function(event) {
    const m = document.getElementById('detailModal');
    if (event.target == m) { m.style.display = "none"; }
}
</script>

</body>
</html>