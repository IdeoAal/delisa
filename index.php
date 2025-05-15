<?php
// Cek apakah parameter error ada di URL
$notif = "";
if (isset($_GET['error'])) {
    switch ($_GET['error']) {
        case 1:
            $notif = "Username atau password salah.";
            break;
        case 2:
            $notif = "Anda berhasil logout.";
            break;
        case 3:
            $notif = "Anda belum login atau sesi telah berakhir.";
            break;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .bg-gradient-custom {
            /* background: linear-gradient(to right, #2193b0, #6dd5ed); */
            background: url('assets/bg-login.jpg') no-repeat center center fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            min-height: 100vh;
        }
    </style>

    <!-- Bootstrap CSS
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@400;700&family=Roboto:wght@400;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="siswa/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="coba.css" rel="stylesheet">

    <title>Dashboard Login</title>
</head>

<body class="bg-gradient-custom">

    <div class="d-flex justify-content-center align-items-center min-vh-100 ">
        <div class="card shadow p-4" style="width: 100%; max-width: 400px;">
            <h4 class="text-center">Delayota Layanan Inspirasi <br> Saran & Aspirasi</h4>


            <form action="proses_login.php" method="POST">
                <!-- logo sma -->
                <div class="text-center mb-2">
                    <img src="assets/logo_sma8.png" alt="Logo" class="img-fluid" style="width: 100px;">
                </div>
                <h3 class="text-center pb-2">Login</h3>
                <!-- Toggle button group -->
                <div class="btn-group w-100 mb-3" role="group">
                    <input type="radio" class="btn-check" name="role" id="admin" value="admin" autocomplete="off" checked onchange="updateLabel()" />
                    <label class="btn btn-outline-primary" for="admin">Admin</label>

                    <input type="radio" class="btn-check" name="role" id="siswa" value="siswa" autocomplete="off" onchange="updateLabel()" />
                    <label class="btn btn-outline-primary" for="siswa">Siswa</label>
                </div>

                <!-- Hidden input for role -->
                <input type="hidden" id="roleHidden" name="role" value="admin" />

                <div class="mb-3">
                    <label for="username" class="form-label" id="userLabel">Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Masukan Username/NIS" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Masukan Password" required>
                </div>

                <button type="submit" class="btn btn-primary w-100">Login</button>
            </form>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="notifModal" tabindex="-1" aria-labelledby="notifModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="notifModalLabel">Notifikasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <?= $notif ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Script: update label and hidden input -->
    <script>
        function updateLabel() {
            const isAdmin = document.getElementById("admin").checked;
            document.getElementById("userLabel").textContent = isAdmin ? "Username" : "NIS";
            document.getElementById("roleHidden").value = isAdmin ? "admin" : "siswa";
        }

        // Tampilkan modal jika ada notifikasi
        <?php if ($notif): ?>
            const modal = new bootstrap.Modal(document.getElementById('notifModal'));
            modal.show();
        <?php endif; ?>
    </script>

</body>

</html>