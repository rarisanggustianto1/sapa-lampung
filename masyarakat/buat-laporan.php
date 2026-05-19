<?php
session_start(); 
include '../config/koneksi.php';

$query_kat = mysqli_query($conn, "SELECT * FROM kategori");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Laporan - SAPA Lampung</title>
    <link rel="stylesheet" href="../assets/css/global.css">
    <link rel="stylesheet" href="../assets/css/masyarakat.css">
    <style>
        .text-danger { color: #dc2626; font-weight: bold; }
        .file-input-hidden { display: none; }
        
        .sidebar-public {
            background: linear-gradient(160deg, #c62828 0%, #7b0000 100%) !important;
        }
        .upload-box {
            cursor: pointer;
            transition: background 0.2s ease;
        }
        .upload-box:hover {
            background-color: #f8fafc;
            border-color: #c62828;
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
                <a href="buat-laporan.php" class="sidebar-item active">&ensp;Buat Laporan</a>
                <a href="riwayat.php" class="sidebar-item">&ensp;Riwayat Laporan</a>
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
                <h1 class="page-title">Buat Laporan Publik</h1>
                <p class="page-subtitle">Laporkan keluhan Anda secara langsung tanpa perlu masuk akun</p>
            </div>
            <div class="topbar-right">
                <a href="../login.php" class="btn-primary" style="padding: 8px 16px; font-size: 13px; text-decoration: none;">Masuk Sistem</a>
            </div>
        </div>

        <div class="content-body">
            <div class="form-card">
                <div class="form-header">
                    <h2>Form Laporan Pengaduan</h2>
                    <p>Isi data laporan dengan benar agar mudah diverifikasi oleh Admin.</p>
                    <div class="card-subtitle"><span class="text-danger">*</span> Keterangan: Kolom bertanda merah wajib diisi</div>
                </div>

                <form action="proses-lapor.php" method="POST" enctype="multipart/form-data">

                    <div class="form-group">
                        <label>Judul Laporan <span class="text-danger">* (Wajib diisi)</span></label>
                        <input type="text" name="judul_laporan" class="form-input" placeholder="Contoh: Jalan berlubang parah di daerah Sukarame" required>
                    </div>

                    <div class="form-group">
                        <label>Kategori Laporan <span class="text-danger">* (Wajib diisi)</span></label>
                        <select name="id_kategori" class="form-input" required>
                            <option value="">-- Pilih Kategori --</option>
                            <?php while($kat = mysqli_fetch_assoc($query_kat)) : ?>
                                <option value="<?= $kat['id_kategori']; ?>"><?= $kat['nama_kategori']; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Deskripsi Masalah <span class="text-danger">* (Wajib diisi)</span></label>
                        <textarea name="deskripsi" class="form-textarea" placeholder="Jelaskan kronologi atau detail masalah secara rinci..." required></textarea>
                    </div>

                    <div class="form-group">
                        <label>Alamat Kejadian <span class="text-danger">* (Wajib diisi)</span></label>
                        <input type="text" name="alamat_kejadian" class="form-input" placeholder="Contoh: Jl. Ryacudu No. 12, Sukarame, Bandar Lampung" required>
                    </div>

                    <div class="form-group">
                        <label>Upload Foto Bukti <span class="text-danger">* (Wajib diisi, Hanya Gambar)</span></label>
                        <div class="upload-box" onclick="document.getElementById('foto_bukti').click();">
                            <div class="upload-icon">📷</div>
                            <p id="file-label">Klik untuk memilih foto dari perangkat</p>
                            <span>Format: JPG / JPEG / PNG (Maksimal 5MB)</span>
                        </div>
                        <input type="file" id="foto_bukti" name="foto_bukti" class="file-input-hidden" accept="image/*" required onchange="updateFileName(this)">
                    </div>

                    <div class="form-group">
                        <label>Tingkat Urgensi <span class="text-danger">* (Wajib diisi)</span></label>
                        <div class="urgensi-group">
                            <label class="urgensi-item">
                                <input type="radio" name="urgensi" value="Rendah" required> Rendah
                            </label>
                            <label class="urgensi-item">
                                <input type="radio" name="urgensi" value="Sedang" checked required> Sedang
                            </label>
                            <label class="urgensi-item">
                                <input type="radio" name="urgensi" value="Tinggi" required> Tinggi
                            </label>
                        </div>
                    </div>

                    <div class="form-action">
                        <a href="../index.php" class="btn-secondary" style="text-decoration: none;">Batal</a>
                        <button type="submit" class="btn-primary">Kirim Laporan</button>
                    </div>

                </form>
            </div>
        </div>
    </main>
</div>

<script>
function updateFileName(input) {
    const label = document.getElementById('file-label');
    if (input.files && input.files[0]) {
        label.innerText = "Gambar siap diupload: " + input.files[0].name;
    } else {
        label.innerText = "Klik untuk memilih foto dari perangkat";
    }
}
</script>

</body>
</html>