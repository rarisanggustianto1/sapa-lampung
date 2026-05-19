<?php
session_start();
include '../config/koneksi.php';

$query_riwayat = mysqli_query($conn, "SELECT laporan.*, kategori.nama_kategori 
                                      FROM laporan 
                                      JOIN kategori ON laporan.id_kategori = kategori.id_kategori 
                                      ORDER BY laporan.tanggal_lapor DESC");
$total_laporan = mysqli_num_rows($query_riwayat);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Laporan — SAPA Lampung</title>
    <link rel="stylesheet" href="../assets/css/global.css">
    <link rel="stylesheet" href="../assets/css/masyarakat.css">
    <style>
        .modal {
            display: none; 
            position: fixed; 
            z-index: 9999; 
            left: 0; top: 0;
            width: 100%; height: 100%;
            overflow: auto; 
            background-color: rgba(0,0,0,0.5);
            backdrop-filter: blur(4px);
        }
        .modal-content {
            background-color: #fff;
            margin: 8% auto; 
            padding: 24px;
            border-radius: 16px;
            width: 90%;
            max-width: 600px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.2);
            position: relative;
            animation: animatetop 0.3s ease;
        }
        @keyframes animatetop {
            from {top: -100px; opacity: 0}
            to {top: 0; opacity: 1}
        }
        .close-btn {
            position: absolute;
            right: 20px; top: 15px;
            color: #aaa;
            font-size: 28px; font-weight: bold;
            cursor: pointer;
        }
        .close-btn:hover { color: #c62828; }
        .modal-grid-detail {
            display: flex; flex-direction: column; gap: 12px; margin-top: 16px;
        }
        .detail-item {
            border-bottom: 1px solid #f0f0f5; padding-bottom: 8px;
        }
        .detail-item strong { display: block; font-size: 12px; color: #8a8a9a; text-transform: uppercase; }
        .detail-item span { font-size: 14px; color: #1a1a2e; font-weight: 600; }
        .modal-img { max-height: 200px; object-fit: contain; border-radius: 8px; border: 1px solid #eee; margin-top: 4px; }
        
        .sidebar-public {
            background: linear-gradient(160deg, #c62828 0%, #7b0000 100%) !important;
        }
    </style>
</head>

<body>
<div class="dashboard-layout">
    
    <aside class="sidebar sidebar-public">
        <div>
            <div class="sidebar-brand">
                <div class="sidebar-logo">S</div>
                <div>
                    <div class="sidebar-brand-name">SAPA</div>
                    <div class="sidebar-brand-sub">Portal Masyarakat</div>
                </div>
            </div>
            <nav class="sidebar-nav">
                <a href="../login.php" class="sidebar-item">&ensp;Dashboard</a>
                <a href="buat-laporan.php" class="sidebar-item">&ensp;Buat Laporan</a>
                <a href="riwayat.php" class="sidebar-item active">&ensp;Riwayat Laporan</a>
            </nav>
        </div>
        <div class="sidebar-footer">
            <div class="sidebar-user">
                <div class="sidebar-avatar">?</div>
                <div>
                    <div class="sidebar-user-name">Tamu / Umum</div>
                    <div class="sidebar-user-role">Masyarakat</div>
                </div>
            </div>
            <a href="../index.php" class="sidebar-logout">Kembali ke Beranda</a>
        </div>
    </aside>

    <main class="main-content">
        <div class="topbar">
            <div>
                <h1 class="page-title">Riwayat Laporan Publik</h1>
                <p class="page-subtitle">Seluruh daftar laporan pengaduan masyarakat Lampung</p>
            </div>
            <div class="topbar-right">
                <a href="../login.php" class="btn-primary" style="padding: 8px 16px; font-size: 13px;">Masuk Sistem</a>
            </div>
        </div>

        <div class="content-body">
            <div class="riwayat-card">
                <div class="riwayat-header">
                    <div>
                        <h3 class="riwayat-header-title">Semua Pengaduan</h3>
                        <p class="riwayat-header-sub"><?= $total_laporan; ?> laporan masuk</p>
                    </div>
                    <a href="buat-laporan.php" class="btn-primary-red">＋&ensp;Buat Laporan</a>
                </div>

                <div class="table-wrapper">
                    <table class="riwayat-table">
                        <thead>
                            <tr>
                                <th>ID Laporan</th>
                                <th>Judul</th>
                                <th>Kategori</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($total_laporan > 0) : ?>
                                <?php while($row = mysqli_fetch_assoc($query_riwayat)) : ?>
                                <tr>
                                    <td class="col-id"><?= $row['id_laporan']; ?></td>
                                    <td class="col-judul"><?= $row['judul_laporan']; ?></td>
                                    <td>
                                        <span class="kategori-badge <?= strtolower($row['nama_kategori'] == 'Fasilitas Umum' ? 'infrastruktur' : $row['nama_kategori']); ?>">
                                            <?= $row['nama_kategori']; ?>
                                        </span>
                                    </td>
                                    <td class="col-tanggal"><?= date('d M Y', strtotime($row['tanggal_lapor'])); ?></td>
                                    <td>
                                        <span class="status-pill <?= strtolower($row['status'] == 'Diproses' ? 'proses' : $row['status']); ?>">
                                            <?= $row['status']; ?>
                                        </span>
                                    </td>
                                    <td>
                                        <button class="detail-btn" onclick='openModalDetail(<?= json_encode($row, JSON_HEX_APOS | JSON_HEX_QUOT); ?>)'>Detail →</button>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="6" style="text-align: center; color: #8a8a9a; padding: 20px;">Belum ada data laporan pengaduan masuk di database.</td>
                                </tr>
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
        <span class="close-btn" onclick="closeModalDetail()">&times;</span>
        <h3 style="font-size: 20px; font-weight: 800; border-bottom: 2px solid #f0f0f5; padding-bottom: 10px; color:#1a1a2e;">
            Detail Pengaduan Masyarakat
        </h3>
        <div class="modal-grid-detail">
            <div class="detail-item">
                <strong>ID Laporan</strong>
                <span id="modal-id"></span>
            </div>
            <div class="detail-item">
                <strong>Judul Pengaduan</strong>
                <span id="modal-judul"></span>
            </div>
            <div class="detail-item">
                <strong>Kategori & Urgensi</strong>
                <span id="modal-kategori-urgensi"></span>
            </div>
            <div class="detail-item">
                <strong>Waktu Kejadian / Lapor</strong>
                <span id="modal-tanggal"></span>
            </div>
            <div class="detail-item">
                <strong>Alamat Lokasi Kejadian</strong>
                <span id="modal-alamat"></span>
            </div>
            <div class="detail-item">
                <strong>Isi Deskripsi Masalah</strong>
                <p id="modal-deskripsi" style="font-size: 14px; margin-top:4px; line-height: 1.5; color: #6b6b80;"></p>
            </div>
            <div class="detail-item">
                <strong>Foto Bukti Lampiran</strong>
                <img id="modal-img" src="" class="modal-img" alt="Foto Lampiran Bukti" style="max-width:100%;">
            </div>
            <div class="detail-item">
                <strong>Status Penanganan Saat Ini</strong>
                <span id="modal-status" style="padding: 4px 10px; border-radius: 20px; display:inline-block; font-size:12px; margin-top:4px;"></span>
            </div>
        </div>
    </div>
</div>

<script>
function openModalDetail(data) {
    document.getElementById('modal-id').innerText = data.id_laporan;
    document.getElementById('modal-judul').innerText = data.judul_laporan;
    document.getElementById('modal-kategori-urgensi').innerText = data.nama_kategori + " (Urgensi: " + data.urgensi + ")";
    document.getElementById('modal-tanggal').innerText = data.tanggal_lapor;
    document.getElementById('modal-alamat').innerText = data.alamat_kejadian;
    document.getElementById('modal-deskripsi').innerText = data.deskripsi;
    
    if(data.foto_bukti) {
        document.getElementById('modal-img').src = "../assets/img/laporan/" + data.foto_bukti;
        document.getElementById('modal-img').style.display = "block";
    } else {
        document.getElementById('modal-img').style.display = "none";
    }

    const statusLabel = document.getElementById('modal-status');
    statusLabel.innerText = data.status;
    statusLabel.className = ""; 
    if(data.status === 'Diproses') {
        statusLabel.style.backgroundColor = '#fff3e0'; statusLabel.style.color = '#e65100';
    } else if (data.status === 'Selesai') {
        statusLabel.style.backgroundColor = '#e8f5e9'; statusLabel.style.color = '#1b5e20';
    } else {
        statusLabel.style.backgroundColor = '#fce4ec'; statusLabel.style.color = '#880e4f';
    }

    document.getElementById('detailModal').style.display = "block";
}

function closeModalDetail() {
    document.getElementById('detailModal').style.display = "none";
}

window.onclick = function(event) {
    const modal = document.getElementById('detailModal');
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>

</body>
</html>