<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
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
    <title>Manajemen Petugas — SAPA Admin</title>
    <link rel="stylesheet" href="../assets/css/global.css">
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>

<div class="dashboard-layout">

    <aside class="sidebar">
        <div>
            <div class="sidebar-brand">
                <div class="sidebar-logo">SA</div>
                <div>
                    <div class="sidebar-brand-name">SAPA Admin</div>
                    <div class="sidebar-brand-sub">Panel Administrator</div>
                </div>
            </div>
            <nav class="sidebar-nav">
                <a href="dashboard.php" class="sidebar-item">Dashboard</a>
                <a href="laporan.php" class="sidebar-item">Laporan Masuk</a>
                <a href="tracking.php" class="sidebar-item">Tracking</a>
                <a href="statistik.php" class="sidebar-item">Statistik</a>
                <a href="petugas.php" class="sidebar-item active">Manajemen Petugas</a>
                <a href="akun.php" class="sidebar-item">Kelola Akun</a>
            </nav>
        </div>
        <div class="sidebar-footer">
            <div class="sidebar-user">
                <div class="sidebar-avatar"><?= strtoupper(substr($nama, 0, 1)) ?></div>
                <div>
                    <div class="sidebar-user-name"><?= htmlspecialchars($nama) ?></div>
                    <div class="sidebar-user-role">Administrator</div>
                </div>
            </div>
            <a href="#" class="sidebar-logout" onclick="confirmLogout()">Keluar</a>
        </div>
    </aside>

    <main class="main-content">

        <div class="topbar">
            <div class="topbar-title">
                <h2>Manajemen Petugas</h2>
                <p>Kelola data petugas lapangan SAPA Lampung</p>
            </div>
            <div class="topbar-user">
                <div class="topbar-avatar"><?= strtoupper(substr($nama, 0, 1)) ?></div>
                <span class="topbar-username"><?= htmlspecialchars($nama) ?></span>
            </div>
        </div>

        <div class="content-body">

            <div class="ptg-stats mb-20">

                <div class="ptg-stat">
                    <div class="ptg-stat-left">
                        <div class="ptg-stat-icon" style="background:#f1f5f9;color:#64748b">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                        </div>
                        <div>
                            <div class="ptg-stat-val">52</div>
                            <div class="ptg-stat-lbl">Total Petugas</div>
                        </div>
                    </div>
                </div>

                <div class="ptg-stat">
                    <div class="ptg-stat-left">
                        <div class="ptg-stat-icon" style="background:#dcfce7;color:#16a34a">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                        </div>
                        <div>
                            <div class="ptg-stat-val" style="color:#16a34a">48</div>
                            <div class="ptg-stat-lbl">Aktif</div>
                        </div>
                    </div>
                    <span class="ptg-stat-badge" style="background:#dcfce7;color:#16a34a">92%</span>
                </div>

                <div class="ptg-stat">
                    <div class="ptg-stat-left">
                        <div class="ptg-stat-icon" style="background:#fee2e2;color:#dc2626">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
                        </div>
                        <div>
                            <div class="ptg-stat-val" style="color:#dc2626">4</div>
                            <div class="ptg-stat-lbl">Nonaktif</div>
                        </div>
                    </div>
                </div>

                <div class="ptg-stat">
                    <div class="ptg-stat-left">
                        <div class="ptg-stat-icon" style="background:#fef3c7;color:#d97706">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg>
                        </div>
                        <div>
                            <div class="ptg-stat-val" style="color:#d97706">127</div>
                            <div class="ptg-stat-lbl">Tugas Aktif</div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="grid-2 mb-20">

                <div class="card">
                    <div class="card-header">
                        <div>
                            <div class="card-title">Tambah Petugas Baru</div>
                            <div class="card-subtitle">Kolom bertanda * wajib diisi</div>
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="ptg-fg">
                            <label class="ptg-lbl">Nama Lengkap <span class="ptg-req">*</span></label>
                            <input type="text" class="ptg-input" placeholder="Nama sesuai KTP">
                        </div>

                        <div class="ptg-fg">
                            <label class="ptg-lbl">Email <span class="ptg-req">*</span></label>
                            <input type="email" class="ptg-input" placeholder="nama@sapa.go.id">
                        </div>

                        <div class="ptg-frow">
                            <div class="ptg-fg">
                                <label class="ptg-lbl">Nomor HP <span class="ptg-req">*</span></label>
                                <input type="text" class="ptg-input" placeholder="0812-xxxx-xxxx">
                            </div>
                            <div class="ptg-fg">
                                <label class="ptg-lbl">NIP</label>
                                <input type="text" class="ptg-input" placeholder="Opsional">
                            </div>
                        </div>

                        <div class="ptg-fg">
                            <label class="ptg-lbl">Divisi <span class="ptg-req">*</span></label>
                            <select class="ptg-input">
                                <option value="">Pilih Divisi</option>
                                <option>Infrastruktur</option>
                                <option>Fasilitas Umum</option>
                                <option>Keamanan</option>
                                <option>Kebersihan</option>
                                <option>Darurat</option>
                                <option>Umum</option>
                            </select>
                        </div>

                        <div class="ptg-fg">
                            <label class="ptg-lbl">Status</label>
                            <div class="ptg-radio-wrap">
                                <label class="ptg-radio-lbl">
                                    <input type="radio" name="sp" value="aktif" checked>
                                    <span>Aktif</span>
                                </label>
                                <label class="ptg-radio-lbl">
                                    <input type="radio" name="sp" value="nonaktif">
                                    <span>Nonaktif</span>
                                </label>
                            </div>
                        </div>

                        <hr class="ptg-hr">
                        <button class="ptg-submit">Tambah Petugas</button>

                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <div>
                            <div class="card-title">Sebaran per Divisi</div>
                            <div class="card-subtitle">52 petugas terdaftar</div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="ptg-divisi">

                            <?php
                            $divisi = [
                                ['Kebersihan',    14, 100, '#16a34a'],
                                ['Infrastruktur', 12, 86,  '#1a56e8'],
                                ['Fasilitas Umum', 9, 64,  '#7c3aed'],
                                ['Keamanan',       8, 57,  '#0e7490'],
                                ['Darurat',        5, 36,  '#dc2626'],
                                ['Umum',           4, 29,  '#9ca3af'],
                            ];
                            foreach ($divisi as $d): ?>
                            <div class="ptg-divisi-row">
                                <div class="ptg-divisi-meta">
                                    <span class="ptg-divisi-name"><?= $d[0] ?></span>
                                    <span class="ptg-divisi-num"><?= $d[1] ?> petugas</span>
                                </div>
                                <div class="ptg-divisi-track">
                                    <div class="ptg-divisi-fill" style="width:<?= $d[2] ?>%;background:<?= $d[3] ?>"></div>
                                </div>
                            </div>
                            <?php endforeach; ?>

                        </div>
                    </div>
                </div>

            </div>

            <div class="card">

                <div class="card-header">
                    <div>
                        <div class="card-title">Daftar Seluruh Petugas</div>
                        <div class="card-subtitle">52 petugas terdaftar</div>
                    </div>
                </div>

                <div class="ptg-filter-bar">
                    <input type="text" class="ptg-input ptg-search" placeholder="Cari nama atau email...">
                    <select class="ptg-input ptg-sel">
                        <option>Semua Divisi</option>
                        <option>Infrastruktur</option>
                        <option>Fasilitas Umum</option>
                        <option>Keamanan</option>
                        <option>Kebersihan</option>
                        <option>Darurat</option>
                        <option>Umum</option>
                    </select>
                    <select class="ptg-input ptg-sel">
                        <option>Semua Status</option>
                        <option>Aktif</option>
                        <option>Nonaktif</option>
                    </select>
                </div>

                <div class="table-wrap">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Petugas</th>
                                <th>Kontak</th>
                                <th>Divisi</th>
                                <th>Status</th>
                                <th>Tugas</th>
                                <th>Rating</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $petugas = [
                                ['PTG-001', 'Ahmad Fauzi',    'AF', '#dbeafe', '#1d4ed8', 'ahmad@sapa.go.id',   '0812-8823-9910', 'infrastruktur', 'Infrastruktur',  true,  3, '4,8'],
                                ['PTG-002', 'Siti Rahayu',    'SR', '#dcfce7', '#15803d', 'siti@sapa.go.id',    '0813-5544-2211', 'kebersihan',    'Kebersihan',     true,  2, '4,6'],
                                ['PTG-003', 'Bambang Wijaya', 'BW', '#ede9fe', '#6d28d9', 'bambang@sapa.go.id', '0811-7788-3344', 'fasilitas',     'Fasilitas Umum', true,  1, '4,9'],
                                ['PTG-007', 'Rizal Maulana',  'RM', '#dbeafe', '#1d4ed8', 'rizal@sapa.go.id',   '0814-6655-4433', 'infrastruktur', 'Infrastruktur',  true,  1, '4,7'],
                                ['PTG-015', 'Doni Pratama',   'DP', '#f3f4f6', '#9ca3af', 'doni@sapa.go.id',    '0812-1122-3344', 'keamanan',      'Keamanan',       false, 0, '—'],
                            ];
                            foreach ($petugas as $p):
                                $rowClass = $p[9] ? '' : 'ptg-nonaktif';
                                $pillClass = $p[9] ? 'pill-aktif' : 'pill-nonaktif';
                                $pillLabel = $p[9] ? 'Aktif' : 'Nonaktif';
                            ?>
                            <tr class="<?= $rowClass ?>">
                                <td><span class="id-badge"><?= $p[0] ?></span></td>
                                <td>
                                    <div class="ptg-user">
                                        <div class="ptg-av" style="background:<?= $p[3] ?>;color:<?= $p[4] ?>"><?= $p[2] ?></div>
                                        <span class="ptg-uname"><?= $p[1] ?></span>
                                    </div>
                                </td>
                                <td class="ptg-contact">
                                    <span><?= $p[5] ?></span>
                                    <span><?= $p[6] ?></span>
                                </td>
                                <td><span class="cat-tag cat-<?= $p[7] ?>"><?= $p[8] ?></span></td>
                                <td><span class="pill <?= $pillClass ?>"><?= $pillLabel ?></span></td>
                                <td><span class="ptg-count <?= $p[10] == 0 ? 'ptg-count-zero' : '' ?>"><?= $p[10] ?></span></td>
                                <td><span class="ptg-rate <?= $p[11] === '—' ? 'ptg-rate-none' : '' ?>"><?= $p[11] !== '—' ? '&#9733; ' . $p[11] : '—' ?></span></td>
                                <td>
                                    <div class="ptg-act-wrap">
                                        <button class="ptg-act-btn ptg-act-edit">Edit</button>
                                        <button class="ptg-act-btn ptg-act-del">Hapus</button>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>

                <div class="ptg-footer">
                    <span class="ptg-footer-txt">Menampilkan 1–5 dari 52 petugas</span>
                    <div class="ptg-pager">
                        <button class="ptg-pg">&#8592;</button>
                        <button class="ptg-pg ptg-pg-on">1</button>
                        <button class="ptg-pg">2</button>
                        <button class="ptg-pg">3</button>
                        <button class="ptg-pg">&#8594;</button>
                    </div>
                </div>

            </div>

        </div>
    </main>
</div>

<script>
function confirmLogout() {
    if (confirm("Yakin mau keluar dari akun?")) {
        window.location.href = "../logout.php";
    }
}
</script>

</body>
</html>