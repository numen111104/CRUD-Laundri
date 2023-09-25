<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "laundri";
$table = "januari";
$connect = mysqli_connect($host, $user, $pass, $db);

if (!$connect) {
    die('YOUR CONNECTION IS NOT ACTIVE');
}

$NKL = '';
$NAMA = '';
$ASRAMA = '';
$error = '';
$sukses = '';

$op = (isset($_GET['op'])) ? $_GET['op'] : '';

//CREATE and UPDATE
if (isset($_POST['submit'])) {
    $NKL = $_POST['NKL'];
    $NAMA = $_POST['NAMA'];
    $ASRAMA = $_POST['ASRAMA'];
    if ($NKL && $NAMA && $ASRAMA) {
        if ($op == 'edit') {
            $sql1 = "UPDATE $table SET NKL = '$NKL', NAMA = '$NAMA', ASRAMA = '$ASRAMA' WHERE ID = '$id'";
            $q1 = mysqli_query($connect, $sql1);
            if ($q1) {
                $sukses = "Data berhasil diperbarui";
            } else {
                $error = "Data gagal diperbarui";
            }
        } else {
            $sqlcek = "SELECT * FROM $table WHERE NKL = '$NKL'";
            $q_cek = mysqli_query($connect, $sqlcek);

            if (mysqli_num_rows($q_cek) > 0) {
                $error = "NKL sudah ada di dalam database!";
            } else {
                $sql1 = "INSERT INTO $table(NKL, NAMA, ASRAMA) VALUES ('$NKL', '$NAMA', '$ASRAMA')";
                $q1 = mysqli_query($connect, $sql1);
                if ($q1) {
                    $sukses = "DATA BERHASIL DIMASUKKAN";
                } else {
                    $error = "DATA GAGAL DIMASUKKAN";
                }
            }
        }
    } else {
        $error = "Tolong masukkan semua data anda!";
    }
}

//READ/EDIT
if ($op == 'edit') {
    $id = $_GET['id'];
    $sql1 = "SELECT * FROM $table where ID = '$id'";
    $q1 = mysqli_query($connect, $sql1);
    $r1 = mysqli_fetch_array($q1);
    $NKL = $r1['NKL'];
    $NAMA = $r1['NAMA'];
    $ASRAMA = $r1['ASRAMA'];

    if ($NKL == '') {
        $error = 'DATA TIDAK DITEMUKAN!';
    }
}

//DELETE
if ($op == 'delete') {
    $id = $_GET['id'];
    $sql_delete = "DELETE FROM $table WHERE ID = '$id'";
    $q_delete = mysqli_query($connect, $sql_delete);
    if ($q_delete) {
        $sukses = "DATA BERHASIL DIHAPUS";
    } else {
        $error = "GAGAL MENGHAPUS DATA";
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Laundri</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>

<body class="w-100">
    <div class="container-md w-auto mx-auto">
        <div class="card mt-3">
            <div class="card-header">
                CREATE/EDIT Data
            </div>
            <div class="card-body">
                <?php
                if ($error) {
                    ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error ?>
                    </div>
                    <?php
                    header("refresh:3;url=index.php");
                }
                ?>
                <?php
                if ($sukses) {
                    ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $sukses ?>
                    </div>
                    <?php
                    header("refresh:3;url=index.php");
                }
                ?>
                <form action="" method="post">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="NKL" name="NKL" placeholder="Input your NKL"
                            value="<?php echo $NKL ?>">
                        <label for="NKL">NKL</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="NAMA" name="NAMA" placeholder="Input your NAMA"
                            value="<?php echo $NAMA ?>">
                        <label for="NAMA">NAMA</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="ASRAMA" name="ASRAMA"
                            placeholder="Input your ASRAMA" value="<?php echo $ASRAMA ?>">
                        <label for="ASRAMA">ASRAMA</label>
                    </div>
                    <div>
                        <input type="submit" name="submit" value="Submit" class="btn btn-outline-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- MEMBACA DATA DARI DATABASE -->
    <div class="container-md w-auto mx-auto">
        <div class="card mt-3">
            <div class="card-header text-center h4 text-white bg-info">
                DATA LAUNDRI
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped text-center">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">NKL</th>
                                <th scope="col">NAMA</th>
                                <th scope="col">ASRAMA</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql2 = "SELECT * FROM $table ORDER BY ID DESC";
                            $q2 = mysqli_query($connect, $sql2);
                            $count = 1;
                            while ($r2 = mysqli_fetch_array($q2)) {
                                $id = $r2['ID'];
                                $NKL = $r2['NKL'];
                                $NAMA = $r2['NAMA'];
                                $ASRAMA = $r2['ASRAMA'];
                                ?>
                                <tr>
                                    <th scope="row">
                                        <?php echo $count++ ?>
                                    </th>
                                    <td>
                                        <?php echo $NKL ?>
                                    </td>
                                    <td>
                                        <?php echo $NAMA ?>
                                    </td>
                                    <td>
                                        <?php echo $ASRAMA ?>
                                    </td>
                                    <td>
                                        <a href="index.php?op=edit&id=<?php echo $id ?>"><button
                                                class="btn btn-warning">EDIT</button></a>
                                        <a href="index.php?op=delete&id=<?php echo $id ?>"><button class="btn btn-danger"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">DELETE</button></a>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
        crossorigin="anonymous"></script>
</body>

</html>