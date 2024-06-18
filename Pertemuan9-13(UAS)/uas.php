<?php
include "koneksi.php";
include "tampilkan_data.php";

$ambil_data = [
    'nama_mahasiswa' => '',
    'prodi' => '',
    'npm' => '',
    'alamat' => '',
    'jk' => ''
];

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $proses_ambil = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE id = $id") or die (mysqli_error($koneksi));
    $ambil_data = mysqli_fetch_assoc($proses_ambil);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $prodi = $_POST['prodi'];
    $npm = $_POST['npm'];
    $alamat = $_POST['alamat'];
    $jk = $_POST['jk'];

    if ($id) {
        $query = mysqli_query($koneksi, "UPDATE mahasiswa SET nama_mahasiswa='$nama', prodi='$prodi', npm='$npm', alamat='$alamat', jk='$jk' WHERE id=$id") or die(mysqli_error($koneksi));
    } else {
        $query = mysqli_query($koneksi, "INSERT INTO mahasiswa (nama_mahasiswa, prodi, npm, alamat, jk) VALUES ('$nama', '$prodi', '$npm', '$alamat', '$jk')") or die(mysqli_error($koneksi));
    }

    if ($query) {
        echo "<script>alert('Data Berhasil disimpan'); window.location.href='uas.php';</script>";
    } else {
        echo "<script>alert('Data gagal disimpan');</script>";
    }
}
?>

<html>
<head>
    <link href="admin-bootstrap2/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="admin-bootstrap2/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
    <link href="admin-bootstrap2/assets/styles.css" rel="stylesheet" media="screen">
    <script src="admin-bootstrap2/vendors/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    <title>Document</title>
</head>
<body>
<div class="span9" id="content">
    <div class="row-fluid">
        <div class="block">
            <div class="navbar navbar-inner block-header">
                <div class="muted pull-left"> Input Data </div>
            </div>
            <div class="block-content collapse in">
                <div class="span12">
                    <form class="form-horizontal" action="uas.php" method="POST">
                        <fieldset>
                            <legend> Input Nilai Mahasiswa </legend>
                            <input type="hidden" name="id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>">

                            <div class="control-group">
                                <label class="control-label" for="nama"> Nama Mahasiswa </label>
                                <div class="controls">
                                    <input type="text" class="input-xlarge focused" id="nama" name="nama" value="<?php echo $ambil_data['nama_mahasiswa']; ?>"></input>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="prodi"> Program Studi </label>
                                <div class="controls">
                                    <input type="text" class="input-xlarge focused" id="prodi" name="prodi" value="<?php echo $ambil_data['prodi']; ?>"></input>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="npm"> NPM Mahasiswa </label>
                                <div class="controls">
                                    <input type="text" class="input-xlarge focused" id="npm" name="npm" value="<?php echo $ambil_data['npm']; ?>"></input>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="alamat"> Alamat </label>
                                <div class="controls">
                                    <input type="text" class="input-xlarge focused" id="alamat" name="alamat" value="<?php echo $ambil_data['alamat']; ?>"></input>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="alamat"> Jenis Kelamin </label>
                                <div class="controls">
                                  <input type="Radio" class="input-xlarge focused" id="jk" name="jk" value="Laki - Laki"> Laki - Laki </input>
                                  <input type="Radio" class="input-xlarge focused" id="jk" name="jk" value="Perempuan"> Perempuan </input>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="perulangan"> Ulangi </label>
                                <div class="controls">
                                    <input type="text" class="input-xlarge focused" id="ulangi" name="ulangi" value=""></input>
                                </div>
                            </div>

                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary">Simpan Perubahan </button>
                                <button type="reset" class="btn"> batal </button>
                            </div>

                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Display List of Students -->
    <div class="row-fluid">
        <div class="block">
            <div class="navbar navbar-inner block-header">
                <div class="muted pull-left"> Data Mahasiswa </div>
            </div>
            <div class="block-content collapse in">
                <div class="span12">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>ID Mahasiswa</th>
                            <th> Nama Mahasiswa </th>
                            <th> Program Studi </th>
                            <th> NPM </th>
                            <th> Alamat </th>
                            <th> Jenis Kelamin </th>
                            <th> Aksi </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        while ($data = mysqli_fetch_assoc($proses)) {
                            ?>
                            <tr>
                                <td><?php echo $data['id']; ?></td>
                                <td><?php echo $data['nama_mahasiswa'] ?></td>
                                <td><?php echo $data['prodi'] ?></td>
                                <td><?php echo $data['npm'] ?></td>
                                <td><?php echo $data['alamat'] ?></td>
                                <td><?php echo $data['jk'] ?></td>
                                <td>
                                    <a href="uas.php?id=<?php echo $data['id']; ?>">edit</a>
                                    | <a href="hapus_data.php?id=<?php echo $data['id']; ?>">hapus</a>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
