<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit;
}

include '../config/koneksi.php'; // Koneksi database
$nama = $_SESSION['nama'];

// ==========================================
// 1. QUERY COUNTER STATISTIK BOX
// ==========================================
$q_total    = mysqli_query($conn, "SELECT COUNT(*) as total FROM laporan");
$total_lap  = mysqli_fetch_assoc($q_total)['total'];

$q_proses   = mysqli_query($conn, "SELECT COUNT(*) as total FROM laporan WHERE status='Diproses'");
$total_pros = mysqli_fetch_assoc($q_proses)['total'];

$q_selesai  = mysqli_query($conn, "SELECT COUNT(*) as total FROM laporan WHERE status='Selesai'");
$total_sel  = mysqli_fetch_assoc($q_selesai)['total'];

$q_pending  = mysqli_query($conn, "SELECT COUNT(*) as total FROM laporan WHERE status='Pending'");
$total_pend = mysqli_fetch_assoc($q_pending)['total'];

// Perhitungan persentase penyelesaian
$persen_resolved = ($total_lap > 0) ? round(($total_sel / $total_lap) * 100, 1) : 0;

// ==========================================
// 2. QUERY 3 LAPORAN TERBARU (JOIN KATEGORI)
// ==========================================
$query_laporan = mysqli_query($conn, "SELECT laporan.*, kategori.nama_kategori 
                                      FROM laporan 
                                      JOIN kategori ON laporan.id_kategori = kategori.id_kategori 
                                      ORDER BY laporan.tanggal_lapor DESC LIMIT 3");

// ==========================================
// 3. QUERY DAFTAR PETUGAS AKTIF & TOTAL BEBAN TUGAS
// ==========================================
$query_petugas = mysqli_query($conn, "SELECT users.nama, petugas.divisi, petugas.id_petugas,
                                      (SELECT COUNT(*) FROM laporan WHERE laporan.id_petugas = petugas.id_petugas AND laporan.status != 'Selesai') as beban_tugas
                                      FROM petugas
                                      JOIN users ON petugas.id_user = users.id_user 
                                      LIMIT 3");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - SAPA Lampung</title>
    <link rel="stylesheet" href="../assets/css/global.css">
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>

<body>

<div class="dashboard-layout">

    <aside class="sidebar">
        <div>
            <div class="sidebar-brand">
                <div class="sidebar-logo">A</div>
                <div>
                    <div class="sidebar-brand-name">SAPA Admin</div>
                    <div class="sidebar-brand-sub">Panel Administrator</div>
                </div>
            </div>

            <nav class="sidebar-nav">
                <a href="dashboard.php" class="sidebar-item active">Dashboard</a>
                <a href="laporan.php" class="sidebar-item">Laporan Masuk</a>
                <a href="tracking.php" class="sidebar-item">Tracking</a>
                <a href="statistik.php" class="sidebar-item">Statistik</a>
                <a href="petugas.php" class="sidebar-item">Manajemen Petugas</a>
                <a href="akun.php" class="sidebar-item">Kelola Akun</a>
            </nav>
        </div>

        <div class="sidebar-footer">
            <div class="sidebar-user">
                <div class="sidebar-avatar">
                    <?= strtoupper(substr($nama, 0, 1)); ?>
                </div>
                <div>
                    <div class="sidebar-user-name"><?= htmlspecialchars($nama); ?></div>
                    <div class="sidebar-user-role">Administrator</div>
                </div>
            </div>
            <a href="#" class="sidebar-logout" onclick="confirmLogout()">Keluar</a>
        </div>
    </aside>

    <main class="main-content">
        <div class="topbar">
            <div>
                <h1 class="page-title">Dashboard Admin</h1>
                <p class="page-subtitle">Selamat datang kembali, <?= htmlspecialchars($nama); ?></p>
            </div>
        </div>

        <div class="content-body">
            <div class="stats-row">
                <div class="stat-box">
                    <div class="stat-box-label">Total Laporan</div>
                    <div class="stat-box-num"><?= number_format($total_lap); ?></div>
                    <div class="stat-box-change up">Akumulasi sistem</div>
                </div>

                <div class="stat-box">
                    <div class="stat-box-label">Sedang Diproses</div>
                    <div class="stat-box-num"><?= number_format($total_pros); ?></div>
                    <div class="stat-box-change">+ Tugas lapangan</div>
                </div>

                <div class="stat-box">
                    <div class="stat-box-label">Laporan Selesai</div>
                    <div class="stat-box-num"><?= number_format($total_sel); ?></div>
                    <div class="stat-box-change up"><?= $persen_resolved; ?>% resolved</div>
                </div>

                <div class="stat-box">
                    <div class="stat-box-label">Laporan Pending</div>
                    <div class="stat-box-num"><?= number_format($total_pend); ?></div>
                    <div class="stat-box-change down">Perlu tindakan</div>
                </div>
            </div>

            <div class="grid-2">
                <div class="card">
                    <div class="card-header">
                        <div>
                            <div class="card-title">Laporan Terbaru</div>
                            <div class="card-subtitle">Perlu tindakan segera</div>
                        </div>
                        <a href="laporan.php" class="btn btn-outline" style="text-decoration:none;">Lihat Semua</a>
                    </div>

                    <div class="table-wrap">
                        <table>
                            <thead>
                                <tr>
                                    <th>ID Laporan</th>
                                    <th>Kategori</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(mysqli_num_rows($query_laporan) > 0) : ?>
                                    <?php while($lap = mysqli_fetch_assoc($query_laporan)) : ?>
                                    <tr>
                                        <td><span class="id-badge"><?= $lap['id_laporan']; ?></span></td>
                                        <td>
                                            <span class="cat-tag cat-<?= strtolower($lap['nama_kategori'] == 'Fasilitas Umum' ? 'fasilitas' : $lap['nama_kategori']); ?>">
                                                <?= $lap['nama_kategori']; ?>
                                            </span>
                                        </td>
                                        <td>
                                            <span class="pill pill-<?= strtolower($lap['status'] == 'Verifikasi' ? 'verifikasi' : ($lap['status'] == 'Diproses' ? 'diproses' : ($lap['status'] == 'Selesai' ? 'selesai' : 'pending'))); ?>">
                                                <?= $lap['status']; ?>
                                            </span>
                                        </td>
                                        <td>
                                            <a href="detail-laporan.php?id=<?= $lap['id_laporan']; ?>" class="action-btn" style="text-decoration:none;">Detail</a>
                                        </td>
                                    </tr>
                                    <?php endwhile; ?>
                                <?php else : ?>
                                    <tr><td colspan="4" style="text-align:center; padding:15px; color:#8a8a9a;">Belum ada data masuk.</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <div>
                            <div class="card-title">Petugas Aktif</div>
                            <div class="card-subtitle">Status beban tugas saat ini</div>
                        </div>
                        <a href="petugas.php" class="btn btn-outline" style="text-decoration:none;">Kelola</a>
                    </div>

                    <div class="petugas-list">
                        <?php while($ptg = mysqli_fetch_assoc($query_petugas)) : 
                            // Membuat inisial singkatan nama (contoh Ahmad Fauzi -> AF)
                            $words = explode(" ", $ptg['nama']);
                            $inisial = strtoupper(substr($words[0], 0, 1) . (isset($words[1]) ? substr($words[1], 0, 1) : ''));
                            
                            // Pewarnaan avatar acak berdasarkan divisi kerja
                            $color_class = ($ptg['divisi'] == 'Infrastruktur') ? 'green' : (($ptg['divisi'] == 'Kebersihan') ? 'amber' : 'blue');
                        ?>
                        <div class="petugas-item">
                            <div class="petugas-left">
                                <div class="mini-avatar <?= $color_class; ?>"><?= $inisial; ?></div>
                                <div>
                                    <div class="petugas-name"><?= htmlspecialchars($ptg['nama']); ?></div>
                                    <div class="petugas-role"><?= $ptg['divisi']; ?></div>
                                </div>
                            </div>
                            <span class="pill pill-<?= ($ptg['beban_tugas'] > 0) ? 'diproses' : 'selesai'; ?>">
                                <?= $ptg['beban_tugas']; ?> Tugas
                            </span>
                        </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<script>
function confirmLogout() {
    if (confirm("Yakin mau keluar dari panel administrator?")) {
        window.location.href = "../logout.php";
    }
}
</script>
</body>
</html>