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

    <title>Daftar Tugas - SAPA Lampung</title>

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
                        Panel Petugas Lapangan
                    </div>

                </div>

            </div>

            <nav class="sidebar-nav">

                <a href="petugas.php" class="sidebar-item">
                    Dashboard
                </a>

                <a href="daftar-tugas.php" class="sidebar-item active">
                    Daftar Tugas
                </a>

                <a href="update-status.php" class="sidebar-item">
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
                        Petugas Infrastruktur
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
                    Daftar Tugas Saya
                </h1>

                <p class="page-subtitle">
                    Semua tugas aktif yang diberikan admin
                </p>

            </div>

            <div class="topbar-right">

                <span class="status-online">
                    Sedang Bertugas
                </span>

            </div>

        </div>

        <div class="content-body">

            <div class="card mb-24">

                <div class="filter-bar">

                    <input type="text" class="form-input" placeholder="Cari laporan...">

                    <select class="form-select">

                        <option>Semua Status</option>
                        <option>Baru</option>
                        <option>Diproses</option>
                        <option>Selesai</option>

                    </select>

                    <select class="form-select">

                        <option>Semua Urgensi</option>
                        <option>Tinggi</option>
                        <option>Sedang</option>
                        <option>Rendah</option>

                    </select>

                    <button class="btn btn-primary">
                        Filter
                    </button>

                </div>

            </div>

            <div class="card">

                <div class="card-header">

                    <div>

                        <div class="card-title">
                            Tugas Aktif
                        </div>

                        <div class="card-subtitle">
                            Total 3 tugas aktif
                        </div>

                    </div>

                </div>

                <div class="table-wrap">

                    <table>

                        <thead>

                            <tr>

                                <th>ID</th>
                                <th>Judul</th>
                                <th>Deadline</th>
                                <th>Urgensi</th>
                                <th>Status</th>
                                <th>Aksi</th>

                            </tr>

                        </thead>

                        <tbody>

                            <tr>

                                <td>
                                    <span class="id-badge">
                                        RPT-2024-0855
                                    </span>
                                </td>

                                <td>

                                    <div class="fw-bold">
                                        Jembatan Retak Membahayakan
                                    </div>

                                    <div class="text-small text-muted">
                                        Bandar Lampung
                                    </div>

                                </td>

                                <td class="deadline-red">
                                    15 Nov 2024
                                </td>

                                <td>
                                    <span class="urgensi tinggi">
                                        Tinggi
                                    </span>
                                </td>

                                <td>
                                    <span class="pill pill-verifikasi">
                                        Baru
                                    </span>
                                </td>

                                <td>

                                    <a href="update-status.php" class="action-btn">
                                        Update
                                    </a>

                                </td>

                            </tr>

                            <tr>

                                <td>
                                    <span class="id-badge">
                                        RPT-2024-0842
                                    </span>
                                </td>

                                <td>

                                    <div class="fw-bold">
                                        Jalan Berlubang di SDN 1
                                    </div>

                                    <div class="text-small text-muted">
                                        Tanjung Karang
                                    </div>

                                </td>

                                <td class="deadline-orange">
                                    14 Nov 2024
                                </td>

                                <td>
                                    <span class="urgensi sedang">
                                        Sedang
                                    </span>
                                </td>

                                <td>
                                    <span class="pill pill-diproses">
                                        Diproses
                                    </span>
                                </td>

                                <td>

                                    <a href="update-status.php" class="action-btn">
                                        Update
                                    </a>

                                </td>

                            </tr>

                            <tr>

                                <td>
                                    <span class="id-badge">
                                        RPT-2024-0847
                                    </span>
                                </td>

                                <td>

                                    <div class="fw-bold">
                                        Trotoar Rusak
                                    </div>

                                    <div class="text-small text-muted">
                                        Kedamaian
                                    </div>

                                </td>

                                <td class="deadline-green">
                                    16 Nov 2024
                                </td>

                                <td>
                                    <span class="urgensi rendah">
                                        Rendah
                                    </span>
                                </td>

                                <td>
                                    <span class="pill pill-selesai">
                                        Diproses
                                    </span>
                                </td>

                                <td>

                                    <a href="update-status.php" class="action-btn">
                                        Update
                                    </a>

                                </td>

                            </tr>

                        </tbody>

                    </table>

                </div>

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