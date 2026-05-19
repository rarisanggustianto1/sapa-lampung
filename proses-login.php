<?php
session_start();
include 'config/koneksi.php';

$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

$query = mysqli_query($conn, "SELECT * FROM users WHERE email='$email' AND password='$password' AND status='aktif'");
$data = mysqli_fetch_assoc($query);

if($data){
    $_SESSION['login'] = true;
    $_SESSION['id_user'] = $data['id_user'];
    $_SESSION['nama'] = $data['nama'];
    $_SESSION['role'] = $data['role'];

    if($data['role'] == 'admin'){
        header("Location: admin/dashboard.php");
        exit;
    }
    elseif($data['role'] == 'petugas'){
        // Ambil data detail petugas secara spesifik dari tabel petugas
        $query_ptg = mysqli_query($conn, "SELECT * FROM petugas WHERE id_user='" . $data['id_user'] . "'");
        $data_ptg = mysqli_fetch_assoc($query_ptg);
        
        if($data_ptg){
            $_SESSION['id_petugas'] = $data_ptg['id_petugas'];
            $_SESSION['kode_petugas'] = $data_ptg['kode_petugas'];
            $_SESSION['divisi'] = $data_ptg['divisi'];
            $_SESSION['wilayah'] = $data_ptg['wilayah'];
            $_SESSION['rating'] = $data_ptg['rating'];
        } else {
            // Backup jika data di tabel petugas belum dibuat oleh admin
            $_SESSION['id_petugas'] = 0;
            $_SESSION['kode_petugas'] = 'PTG-TEMP';
            $_SESSION['divisi'] = 'Umum';
            $_SESSION['wilayah'] = 'Bandar Lampung';
            $_SESSION['rating'] = 0.0;
        }
        header("Location: petugas/petugas.php");
        exit;
    }
} else {
    echo "
    <script>
    alert('Email atau password salah!');
    window.location='login.php';
    </script>
    ";
}
?>