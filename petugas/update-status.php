<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'petugas') {
    header("Location: ../login.php");
    exit;
}

$nama = $_SESSION['nama'];
?>

<!DOCTYPE html>
<html lang="id">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Update Progress - SAPA Lampung</title>

    <link rel="stylesheet" href="../assets/css/global.css">
    <link rel="stylesheet" href="../assets/css/petugas.css">

</head>

<body>

<div class="dashboard-layout">

    <aside class="sidebar">

        <div>

            <div class="sidebar-brand">

                <div class="sidebar-logo">
                    P
                </div>

                <div>
                    <div class="sidebar-brand-name">
                        SAPA Petugas
                    </div>

                    <div class="sidebar-brand-sub">
                        Panel Petugas
                    </div>
                </div>

            </div>

            <nav class="sidebar-nav">

                <a href="petugas.php" class="sidebar-item">
                    Dashboard
                </a>

                <a href="daftar-tugas.php" class="sidebar-item">
                    Daftar Tugas
                </a>

                <a href="update-status.php" class="sidebar-item active">
                    Update Progress
                </a>

                <a href="riwayat.php" class="sidebar-item">
                    Riwayat Tugas
                </a>

            </nav>

        </div>

        <div class="sidebar-footer">

            <div class="sidebar-user">

                <div class="sidebar-avatar">
                    <?= strtoupper(substr($nama, 0, 1)); ?>
                </div>

                <div>
                    <div class="sidebar-user-name">
                        <?= htmlspecialchars($nama); ?>
                    </div>

                    <div class="sidebar-user-role">
                        Petugas Lapangan
                    </div>
                </div>

            </div>

            <a href="#" class="sidebar-logout" onclick="confirmLogout()">
                Keluar
            </a>

        </div>

    </aside>

    <main class="main-content">

        <div class="topbar">

            <div>

                <h1 class="page-title">
                    Update Progress
                </h1>

                <p class="page-subtitle">
                    Perbarui status dan dokumentasi tugas lapangan
                </p>

            </div>

        </div>

        <div class="content-body">

            <div class="card mb-24">

                <div class="card-header">

                    <div>
                        <div class="card-title">
                            Informasi Laporan
                        </div>

                        <div class="card-subtitle">
                            RPT-2024-0842
                        </div>
                    </div>

                    <span class="pill pill-diproses">
                        Dalam Perjalanan
                    </span>

                </div>

                <div class="card-body">

                    <div class="detail-row">
                        <strong>Judul:</strong>
                        Jalan Berlubang di SDN 1 Palapa
                    </div>

                    <div class="detail-row">
                        <strong>Lokasi:</strong>
                        Jl. Raden Intan, Bandar Lampung
                    </div>

                    <div class="detail-row">
                        <strong>Deadline:</strong>
                        <span class="text-danger">
                            14 Nov 2024
                        </span>
                    </div>

                    <div class="progress-info">

                        <div class="progress-text">
                            <span>Progress</span>
                            <strong>75%</strong>
                        </div>

                        <div class="prog-bar">
                            <div class="prog-fill" style="width:75%"></div>
                        </div>

                    </div>

                </div>

            </div>

            <div class="card mb-24">

                <div class="card-header">
                    <div class="card-title">
                        Timeline Progress
                    </div>
                </div>

                <div class="card-body">

                    <div class="timeline">

                        <div class="timeline-item">

                            <div class="timeline-dot"></div>

                            <div>
                                <div class="timeline-title">
                                    Tugas Diterima
                                </div>

                                <div class="timeline-time">
                                    12 Nov 2024 · 14:00
                                </div>

                                <div class="timeline-desc">
                                    Penugasan diterima dari admin.
                                </div>
                            </div>

                        </div>

                        <div class="timeline-item">

                            <div class="timeline-dot"></div>

                            <div>
                                <div class="timeline-title">
                                    Dalam Perjalanan
                                </div>

                                <div class="timeline-time">
                                    Saat ini
                                </div>

                                <div class="timeline-desc">
                                    Menuju lokasi laporan.
                                </div>
                            </div>

                        </div>

                        <div class="timeline-item">

                            <div class="timeline-dot pending"></div>

                            <div>
                                <div class="timeline-title pending-text">
                                    Pengerjaan
                                </div>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <div class="card mb-24">

                <div class="card-header">
                    <div class="card-title">
                        Form Update
                    </div>
                </div>

                <div class="card-body">

                    <div class="form-group">

                        <label class="form-label">
                            Status Baru
                        </label>

                        <div class="step-select">

                            <div class="step-opt">
                                <div class="step-num">1</div>

                                <div>
                                    <div class="step-title">
                                        Diterima
                                    </div>

                                    <div class="step-desc">
                                        Tugas diterima
                                    </div>
                                </div>
                            </div>

                            <div class="step-opt active">
                                <div class="step-num">2</div>

                                <div>
                                    <div class="step-title">
                                        Dalam Perjalanan
                                    </div>

                                    <div class="step-desc">
                                        Menuju lokasi
                                    </div>
                                </div>
                            </div>

                            <div class="step-opt">
                                <div class="step-num">3</div>

                                <div>
                                    <div class="step-title">
                                        Pengerjaan
                                    </div>

                                    <div class="step-desc">
                                        Sedang melakukan perbaikan
                                    </div>
                                </div>
                            </div>

                            <div class="step-opt">
                                <div class="step-num">4</div>

                                <div>
                                    <div class="step-title">
                                        Selesai
                                    </div>

                                    <div class="step-desc">
                                        Tugas selesai
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="form-group">

                        <label class="form-label">
                            Keterangan
                        </label>

                        <textarea class="form-textarea" rows="5"></textarea>

                    </div>

                    <div class="form-group">

                        <label class="form-label">
                            Estimasi Selesai
                        </label>

                        <input type="datetime-local" class="form-input">

                    </div>

                </div>

            </div>

            <div class="card mb-24">

                <div class="card-header">
                    <div class="card-title">
                        Upload Dokumentasi
                    </div>
                </div>

                <div class="card-body">

                    <div class="upload-box">

                        <div class="upload-icon">
                            📷
                        </div>

                        <div class="upload-title">
                            Upload Foto Progress
                        </div>

                        <div class="upload-sub">
                            JPG / PNG maksimal 10MB
                        </div>

                    </div>

                    <div class="upload-grid">

                        <div class="upload-item">
                            📷
                            <div class="upload-name">
                                sebelum.jpg
                            </div>
                        </div>

                        <div class="upload-item">
                            📷
                            <div class="upload-name">
                                lokasi.jpg
                            </div>
                        </div>

                        <div class="upload-item add-item">
                            +
                        </div>

                    </div>

                </div>

            </div>

            <div class="card mb-24">

                <div class="card-header">
                    <div class="card-title">
                        Checklist Keselamatan
                    </div>
                </div>

                <div class="card-body">

                    <ul class="check-list">

                        <li>
                            <div class="check-icon">✓</div>
                            APD lengkap digunakan
                        </li>

                        <li>
                            <div class="check-icon">✓</div>
                            Area kerja diberi tanda
                        </li>

                        <li>
                            <div class="check-icon">✓</div>
                            Sudah koordinasi dengan warga
                        </li>

                    </ul>

                </div>

            </div>

            <div class="action-row">

                <a href="daftar_tugas.php" class="btn btn-outline">
                    Kembali
                </a>

                <button class="btn btn-outline">
                    Simpan Draft
                </button>

                <button class="btn btn-primary">
                    Kirim Update
                </button>

            </div>

        </div>

    </main>

</div>

<script>

function confirmLogout() {

    const yakin = confirm("Yakin ingin keluar?");

    if (yakin) {
        window.location.href = "../logout.php";
    }

}

</script>

</body>
</html>