<?php
$akun = [
  [
    "id" => "USR-001",
    "nama" => "Budi Waluyo",
    "email" => "budi@gmail.com",
    "telepon" => "0812-3344-5566",
    "role" => "Masyarakat",
    "status" => "Aktif",
    "avatar" => "BW"
  ],
  [
    "id" => "PTG-002",
    "nama" => "Hendra Saputra",
    "email" => "hendra@sapa.id",
    "telepon" => "0813-8877-1122",
    "role" => "Petugas",
    "status" => "Pending",
    "avatar" => "HS"
  ],
  [
    "id" => "ADM-001",
    "nama" => "Admin SAPA",
    "email" => "admin@sapa.id",
    "telepon" => "0811-0000-0001",
    "role" => "Admin",
    "status" => "Aktif",
    "avatar" => "AD"
  ],
  [
    "id" => "USR-008",
    "nama" => "Teguh Prasetya",
    "email" => "teguh@gmail.com",
    "telepon" => "0812-1122-3344",
    "role" => "Masyarakat",
    "status" => "Nonaktif",
    "avatar" => "TP"
  ]
];

$notif = "";

if(isset($_GET['aksi'])) {
  $aksi = $_GET['aksi'];
  $id   = $_GET['id'];

  if($aksi == "approve") {
    $notif = "✅ Akun $id berhasil disetujui";
  } elseif($aksi == "reject") {
    $notif = "❌ Akun $id ditolak";
  } elseif($aksi == "nonaktif") {
    $notif = "🚫 Akun $id dinonaktifkan";
  } elseif($aksi == "aktifkan") {
    $notif = "✅ Akun $id diaktifkan";
  } elseif($aksi == "hapus") {
    $notif = "🗑️ Akun $id dihapus";
  }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kelola Akun — SAPA Lampung</title>
  <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>

<div class="dashboard-layout">

  <!-- SIDEBAR -->
  <aside class="sidebar">
    <div>
      <div class="sidebar-brand">
        <div class="sidebar-logo">SA</div>
        <div>
          <div class="sidebar-brand-name">SAPA Lampung</div>
          <div class="sidebar-brand-sub">Admin Panel</div>
        </div>
      </div>
      <nav class="sidebar-nav">
        <a href="dashboard.php" class="sidebar-item">Dashboard</a>
        <a href="laporan.php" class="sidebar-item">Laporan Masuk</a>
        <a href="tracking.php" class="sidebar-item">Tracking</a>
        <a href="statistik.php" class="sidebar-item">Statistik</a>
        <a href="petugas.php" class="sidebar-item">Manajemen Petugas</a>
        <a href="akun.php" class="sidebar-item active">Kelola Akun</a>
      </nav>
    </div>
    <div class="sidebar-footer">
      <div class="sidebar-user">
        <div class="sidebar-avatar">A</div>
        <div>
          <div class="sidebar-user-name">Admin SAPA</div>
          <div class="sidebar-user-role">Administrator</div>
        </div>
      </div>
      <a href="#" class="sidebar-logout" onclick="confirmLogout()">Keluar</a>
    </div>
  </aside>

  <!-- MAIN CONTENT -->
  <main class="main-content">

    <!-- TOPBAR (sama seperti petugas.php) -->
    <div class="topbar">
      <div class="topbar-title">
        <h2>Kelola Akun</h2>
        <p>Manajemen akun pengguna sistem SAPA Lampung</p>
      </div>
      <div style="display:flex; align-items:center; gap:12px;">
        <button class="btn-primary">+ Tambah Akun</button>
        <div class="topbar-avatar">A</div>
        <span class="topbar-username">Admin SAPA</span>
      </div>
    </div>

    <!-- NOTIF -->
    <?php if($notif != ""): ?>
      <div class="notif-box"><?= $notif ?></div>
    <?php endif; ?>

    <!-- STATS -->
    <div class="stats-row">
      <div class="stat-card blue">
        <div class="stat-label">Total Akun</div>
        <div class="stat-value"><?= count($akun) ?></div>
      </div>
      <div class="stat-card yellow">
        <div class="stat-label">Pending</div>
        <div class="stat-value">1</div>
      </div>
      <div class="stat-card green">
        <div class="stat-label">Aktif</div>
        <div class="stat-value">2</div>
      </div>
      <div class="stat-card red">
        <div class="stat-label">Nonaktif</div>
        <div class="stat-value">1</div>
      </div>
    </div>

    <!-- CARD -->
    <div class="card">

      <div class="card-header">
        <div>
          <div class="card-title">Daftar Akun</div>
          <div class="card-subtitle"><?= count($akun) ?> akun terdaftar</div>
        </div>
      </div>

      <!-- FILTER -->
      <div class="ptg-filter-bar">
        <input type="text" placeholder="Cari nama atau email..." class="ptg-input ptg-search">
        <select class="ptg-input ptg-sel">
          <option>Semua Role</option>
          <option>Admin</option>
          <option>Petugas</option>
          <option>Masyarakat</option>
        </select>
        <select class="ptg-input ptg-sel">
          <option>Semua Status</option>
          <option>Aktif</option>
          <option>Pending</option>
          <option>Nonaktif</option>
        </select>
      </div>

      <!-- TABLE -->
      <div class="table-wrap">
        <table>
          <thead>
            <tr>
              <th>ID</th>
              <th>Pengguna</th>
              <th>Email</th>
              <th>Role</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>

          <?php foreach($akun as $a): ?>
            <tr>
              <td><span class="id-badge"><?= $a['id'] ?></span></td>
              <td>
                <div class="ptg-user">
                  <div class="ptg-av"><?= $a['avatar'] ?></div>
                  <div>
                    <div class="ptg-uname"><?= $a['nama'] ?></div>
                    <div class="ptg-contact"><span><?= $a['telepon'] ?></span></div>
                  </div>
                </div>
              </td>
              <td><?= $a['email'] ?></td>
              <td>
                <?php if($a['role'] == "Admin"): ?>
                  <span class="cat-tag" style="background:#ede9fe;color:#6d28d9">Admin</span>
                <?php elseif($a['role'] == "Petugas"): ?>
                  <span class="cat-tag" style="background:#fef3c7;color:#d97706">Petugas</span>
                <?php else: ?>
                  <span class="cat-tag" style="background:#dbeafe;color:#1d4ed8">Masyarakat</span>
                <?php endif; ?>
              </td>
              <td>
                <?php if($a['status'] == "Aktif"): ?>
                  <span class="pill pill-aktif">Aktif</span>
                <?php elseif($a['status'] == "Pending"): ?>
                  <span class="pill" style="background:#fef3c7;color:#d97706">Pending</span>
                <?php else: ?>
                  <span class="pill pill-nonaktif">Nonaktif</span>
                <?php endif; ?>
              </td>
              <td>
                <div class="ptg-act-wrap">
                  <?php if($a['status'] == "Pending"): ?>
                    <a href="?aksi=approve&id=<?= $a['id'] ?>" class="ptg-act-btn ptg-act-edit">Setujui</a>
                    <a href="?aksi=reject&id=<?= $a['id'] ?>" class="ptg-act-btn ptg-act-del">Tolak</a>
                  <?php endif; ?>
                  <?php if($a['status'] == "Aktif"): ?>
                    <button class="ptg-act-btn ptg-act-edit">Edit</button>
                    <a href="?aksi=nonaktif&id=<?= $a['id'] ?>" class="ptg-act-btn ptg-act-del">Nonaktifkan</a>
                  <?php endif; ?>
                  <?php if($a['status'] == "Nonaktif"): ?>
                    <a href="?aksi=aktifkan&id=<?= $a['id'] ?>" class="ptg-act-btn ptg-act-edit">Aktifkan</a>
                  <?php endif; ?>
                  <a href="?aksi=hapus&id=<?= $a['id'] ?>" class="ptg-act-btn ptg-act-del">Hapus</a>
                </div>
              </td>
            </tr>
          <?php endforeach; ?>

          </tbody>
        </table>
      </div>

    </div>

  </main>
</div>

<script>
function confirmLogout() {
  if (confirm("Yakin ingin keluar dari akun?")) {
    window.location.href = "../logout.php";
  }
}
</script>

</body>
</html>