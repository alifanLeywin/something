<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<title>
    Mochammad Alifan
</title>
<body>
    <nav class="navbar navbar-dark bg-dark">
        <span class="navbar-brand mb-0 h1">Orang Yang Lancelot Nya Gagal Maniac</span>
    </nav>
    <div class="container">
        <br>
        <h4><center>DAFTAR PESERTA PELATIHAN</center></h4>
        
        <?php
        include "koneksi.php";

        // Cek apakah ada kiriman form dari method post
        if (isset($_GET['id_peserta'])) {
            $id_peserta = htmlspecialchars($_GET["id_peserta"]);

            $sql = "DELETE FROM peserta WHERE id_peserta='$id_peserta'";
            $hasil = mysqli_query($kon, $sql);

            // Kondisi apakah berhasil atau tidak
            if ($hasil) {
                header("Location:index.php");
            } else {
                echo "<div class='alert alert-danger'> Data Gagal dihapus.</div>";
            }
        }
        ?>

        <table class="my-3 table table-bordered">
            <thead>
                <tr class="table-primary">           
                    <th>No</th>
                    <th>Nama</th>
                    <th>Sekolah</th>
                    <th>Jurusan</th>
                    <th>No Hp</th>
                    <th>Alamat</th>
                    <th colspan='2'>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $sql = "SELECT * FROM peserta ORDER BY id_peserta DESC";
            $hasil = mysqli_query($kon, $sql);
            $no = 0;
            while ($data = mysqli_fetch_array($hasil)) {
                $no++;
            ?>
                <tr>
                    <td><?php echo $no;?></td>
                    <td><?php echo $data["nama"]; ?></td>
                    <td><?php echo $data["sekolah"]; ?></td>
                    <td><?php echo $data["jurusan"]; ?></td>
                    <td><?php echo $data["no_hp"]; ?></td>
                    <td><?php echo $data["alamat"]; ?></td>
                    <td>
                        <button class="btn btn-warning" onclick="confirmUpdate('<?php echo htmlspecialchars($data['id_peserta']); ?>')">Update</button>
                        <button class="btn btn-danger" onclick="confirmDelete('<?php echo $data['id_peserta']; ?>')">Delete</button>
                    </td>
                </tr>
            <?php
            }
            ?>
            </tbody>
        </table>
        <a href="create.php" class="btn btn-primary" role="button">Tambah Data</a>
    </div>

    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data ini akan dihapus!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>?id_peserta=" + id;
                }
            });
        }

        function confirmUpdate(id) {
            Swal.fire({
                title: 'Apakah Anda yakin ingin mengupdate?',
                text: "Anda akan diarahkan ke halaman update.",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, lanjutkan!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "update.php?id_peserta=" + id;
                }
            });
        }
    </script>
</body>
</html>
