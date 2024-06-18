<?php
include "koneksi.php";

$npm_mhs = $_GET['id'];
$proses = mysqli_query($koneksi, "DELETE FROM mahasiswa WHERE id = $npm_mhs") or die (mysqli_error($koneksi));


if($proses){
    echo "<script>
         alert('Data Berhasil dihapus');
         window.location.href='uas.php';
    </script>";
}
else{
    echo "<script>alert('Data gagal dihapus')
    window.location.href='uas.php';</script>";
}
?>