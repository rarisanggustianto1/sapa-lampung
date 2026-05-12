<?php

session_start();

include 'config/koneksi.php';

$email = $_POST['email'];
$password = $_POST['password'];

$query = mysqli_query(
    $conn,
    "SELECT * FROM users
     WHERE email='$email'
     AND password='$password'"
);

$data = mysqli_fetch_assoc($query);

if($data){

    $_SESSION['nama'] = $data['nama'];
    $_SESSION['role'] = $data['role'];



    if($data['role'] == 'admin'){

        header("Location: admin/dashboard.php");

    }

    elseif($data['role'] == 'masyarakat'){

        header("Location: masyarakat/dashboard.php");

    }

    elseif($data['role'] == 'petugas'){

        header("Location: petugas/dashboard.php");

    }

}else{

    echo "
    <script>

    alert('Login gagal');

    window.location='login.php';

    </script>
    ";

}

?>