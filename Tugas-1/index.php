<!-- koneksi database -->
<?php
$host  = "localhost";
$user  = "root";
$pass = "";
$db  = "akademik";

$koneksi = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) {
    die("Gagal Koneksi");
}
// deklarasi variabel
$nim = "";
$nama = "";
$alamat = "";
$jurusan = "";
$sukses = "";
$error = "";

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}
// proses hapus data
if ($op == 'delete') {
    $id  =  $_GET['id'];
    $sql1 = "delete from mahasiswa where id = '$id'";
    $q1 = mysqli_query($koneksi, $sql1);
    if ($q1) {
        $sukses = "Berhasil Hapus Data";
    } else {
        $error = "Gagal Delete Data";
    }
}
// proses edit data
if ($op == 'edit') {
    $id         = $_GET['id'];
    $sql1       = "SELECT * from mahasiswa where id= '$id'";
    $q1         = mysqli_query($koneksi, $sql1);
    $r1         = mysqli_fetch_array($q1);
    $nim        = $r1['nim'];
    $nama       = $r1['nama'];
    $alamat     = $r1['alamat'];
    $jurusan    = $r1['jurusan'];

    if ($nim == '') {
        $error = "Data Tidak Ditemukan";
    }
}
// menyimpan dan menambah data
if (isset($_POST['simpan'])) {
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $jurusan = $_POST['jurusan'];

    if ($nim && $nama && $alamat && $jurusan) {
        if ($op == 'edit') { //update
            $sql1 = "UPDATE mahasiswa set nim = '$nim', nama = '$nama',alamat='$alamat',jurusan= '$jurusan' where id = '$id'";
            $q1 = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses = "Berhasil Update";
            } else {
                $error = "Gagal Update";
            }
        } else { //insert
            $sql1 = "update mahasiswa set nim = '$nim', nama = '$nama',alamat='$alamat',jurusan= '$jurusan' where id = '$id'";
            $q1 = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses = "Berhasil Update";
            } else {
                $error = "Gagal Update";
            }
        }
        $sql1 = "INSERT into mahasiswa(nim,nama,alamat,jurusan) value ('$nim','$nama','$alamat','$jurusan')";
        $q1 = mysqli_query($koneksi, $sql1);
        if ($q1) {
            $sukses = "Berhasil Input Data ";
        } else {
            $error = "Gagal Memasukkan Data ";
        }
    } else {
        $error = "Harap Input Data yang Benar";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
        .mx-auto {
            width: 800px;
        }

        .card {
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <!---input data--->
    <div class="mx-auto">
        <div class="card">
            <div class="card-header">
                Create / Edit Data
            </div>
            <div class="card-body">
                <?php
                if ($error) {
                ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error ?>
                    </div>
                <?php
                }
                ?>
                <?php

                if ($sukses) {
                ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $sukses ?>
                    </div>
                <?php

                }
                ?>
                <form action="" method="POST">
                    <div class="mb-3 row">
                        <label for="nim" class="col-sm-2 col-form-label">NIM</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nim" name="nim" value="<?php echo $nim ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $nama ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="alamat" name="alamat" value="<?php echo $alamat ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="jurusan" class="col-sm-2 col-form-label">Jurusan</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="jurusan" id="jurusan">
                                <option value="">-. Pilih Jurusan .-</option>
                                <option value="Teknik Informatika" <?php if ($jurusan == "Teknik Informatika") echo "selected" ?>>Teknik Informatika</option>
                                <option value="Sistem Informasi" <?php if ($jurusan == "Sistem Informasi") echo "selected" ?>>Sistem Informasi</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <input type="submit" name="simpan" value="SImpan Data" class="btn btn-primary" />
                    </div>
                </form>
            </div>
        </div>
        <!---output data--->
        <div class="card">
            <div class="card-header text-white bg-secondary">
                Data Mahasiswa
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">NIM</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Jurusan</th>
                            <th scope="col">Action</th>
                        </tr>
                    <tbody>
                        <?php
                        $r2 = "";
                        $sql2 = "SELECT * from mahasiswa order by id desc";
                        $q2 = mysqli_query($koneksi, $sql2);
                        $urut = 1;
                        while ($r2 = mysqli_fetch_array($q2)) {
                            $id = $r2['id'];
                            $nim = $r2['nim'];
                            $nama = $r2['nama'];
                            $alamat = $r2['alamat'];
                            $jurusan = $r2['jurusan'];

                        ?>
                            <tr>
                                <th scope="row"><?php echo $urut++ ?></th>
                                <th scope="row"><?php echo $nim ?></th>
                                <th scope="row"><?php echo $nama ?></th>
                                <th scope="row"><?php echo $alamat ?></th>
                                <th scope="row"><?php echo $jurusan ?></th>
                                <td scope="row">
                                    <a href="index.php?op=edit&id=<?php echo $id ?>"><button type="button" class="btn btn-danger">Edit</button></a>

                                    <a href="index.php?op=delete&id=<?php echo $id ?>" onclick="return confirm('Hapus Data?')"><button type="button" class="btn btn-warning">Hapus</button></a>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    
</body>

</html>