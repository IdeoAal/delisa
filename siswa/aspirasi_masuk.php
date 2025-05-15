<?php
session_start();

// Cek apakah sudah login
if (!isset($_SESSION['login'])) {
    header("Location: ../index.php?error=3");
    exit;
}

// Tambahan: cek role (khusus untuk dashboard admin/siswa)
if ($_SESSION['role'] !== 'siswa') {
    header("Location: ../index.php?error=3");
    exit;
}

$user_login = $_SESSION['nama'];
$user_role = $_SESSION['role'];
$user_nis = $_SESSION['nis'];


include '../koneksi.php';

// Ambil data kritik_saran, join dengan nama siswa & admin
$sql = "
    SELECT ks.*, s.nama AS nama_siswa, a.username AS username_admin
    FROM kritik_saran ks
    LEFT JOIN siswa s ON ks.id_siswa = s.id_siswa
    LEFT JOIN admin a ON ks.id_admin = a.id_admin
    ORDER BY ks.tgl_kritik DESC
    ";
$result = $konek->query($sql);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


</head>

<body>


    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Dashboard Siswa</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

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
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">


</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid bg-primary d-none d-lg-block">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-lg-start mb-2 mb-lg-0">
                    <div class="d-inline-flex align-items-center">
                        <a class="text-dark py-2 pe-3 border-end border-white" href=""><i class="bi bi-telephone text-dark me-2"></i>(0274) 513493</a>
                        <a class="text-dark py-2 px-3" href=""><i class="bi bi-envelope text-dark me-2"></i>sman8yogyakarta@yahoo.co.id</a>
                    </div>
                </div>
                <div class="col-md-6 text-center text-lg-end">
                    <div class="d-inline-flex align-items-center">
                        <a class="text-body py-2 px-3 border-end border-white" href="https://www.facebook.com/delayota" target="_blank" title="www.facebook.com/delayota">
                            <i class="fab fa-facebook-f text-info"></i>
                        </a>
                        <a class="text-body py-2 px-3 border-end border-white" href="https://x.com/delayota" target="_blank" title="x.com/delayota">
                            <i class="fab fa-twitter text-info"></i>
                        </a>
                        <a class="text-body py-2 px-3 border-end border-white" href="https://id.linkedin.com/company/sman8yogyakarta" target="_blank" title="id.linkedin.com/company/sman8yogyakarta">
                            <i class="fab fa-linkedin-in text-info"></i>
                        </a>
                        <a class="text-body py-2 px-3 border-end border-white" href="https://www.instagram.com/sman8yogyakarta" target="_blank" title="www.instagram.com/sman8yogyakarta">
                            <i class="fab fa-instagram text-danger"></i>
                        </a>
                        <a class="text-body py-2 ps-3" href="https://www.youtube.com/channel/UCl7VOd2ZYuvwgVopVq48i4Q" target="_blank" title="www.youtube.com/delayota">
                            <i class="fab fa-youtube text-danger"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-dark navbar-dark shadow-sm px-5 py-3 py-lg-0">
        <a href="index.php" class="navbar-brand p-0">
            <h1 class="m-0 text-uppercase text-primary pb-1 d-flex align-items-center">
                <img class="mx-3" src="../assets/logo_sma8.png" alt="logo" width="70 px">
                <div>
                    <div style="line-height: 1.1;">DELISA</div>
                    <div class="fs-5 text-capitalize text-light" style="margin-top: -4px;">
                        Delayota Layanan Inspirasi Saran & Aspirasi
                    </div>
                </div>
            </h1>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto py-0 pe-4 border-end border-5 border-primary">

                <a href="index.php" class="nav-item nav-link">Home</a>

                <a href="form_aspirasi.php" class="nav-item nav-link">Ketik Aspirasi</a>

                <a href="#" class="nav-item nav-link active">Aspirasi Masuk</a>

                <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" id="dropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Profil
                            </a>
                            <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuLink">
                                <li><a class="dropdown-item" href="#"><i class="bi bi-card-text"></i> | <?= $user_nis; ?></a></li>
                                <li><a class="dropdown-item" href="#"><i class="bi bi-person-circle"></i> | <?= $user_login; ?></a></li>
                            </ul>
                        </li>
                    </ul>
                </div>


            </div>
            <div class="d-none d-lg-flex align-items-center ps-4">
                <div>
                    <h5 class="text-primary mb-1"><small><a href="../logout.php" class="nav-item nav-link">Logout</a></small></h5>
                </div>
                <i class="bi bi-box-arrow-right text-light me-3"></i>
            </div>
        </div>
    </nav>
    <!-- Navbar End -->


    <!-- Hero Start -->
    <div class="container-fluid bg-primary py-5 text-white">
        <div class="container py-5">
            <div class="row gx-4 gy-4">
                <?php if ($result->num_rows): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <div class="col-12 col-md-6 col-lg-4 d-flex">
                            <div class="card shadow h-100 w-100">
                                <div class="card-body d-flex flex-column">
                                    <h6 class="text-muted mb-1"><?= htmlspecialchars($row['nama_siswa'] ?? 'Anonim') ?></h6>
                                    <small class="text-secondary"><?= date('d M Y', strtotime($row['tgl_kritik'])) ?></small>
                                    <p class="mt-2 text-dark flex-grow-1"><?= substr(strip_tags($row['isi']), 0, 100) ?>...</p>
                                    <button class="btn btn-primary btn-sm mt-auto" data-bs-toggle="modal" data-bs-target="#modal<?= $row['id_kritik'] ?>">
                                        Lihat Detail
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Detail Aspirasi -->
                        <div class="modal fade" id="modal<?= $row['id_kritik'] ?>" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Detail Aspirasi</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                    </div>
                                    <div class="modal-body text-dark">
                                        <p><strong>Pengirim:</strong> <?= htmlspecialchars($row['nama_siswa'] ?? 'Anonim') ?></p>
                                        <p><strong>Tanggal:</strong> <?= date('d M Y', strtotime($row['tgl_kritik'])) ?></p>
                                        <hr>
                                        <p><strong>Aspirasi:</strong><br><?= nl2br(htmlspecialchars($row['isi'])) ?></p>
                                        <hr>
                                        <?php if (!empty($row['respon'])): ?>
                                            <p><strong>Respon Admin:</strong><br><?= nl2br(htmlspecialchars($row['respon'])) ?></p>
                                        <?php else: ?>
                                            <p class="text-danger">Belum ada respon dari admin.</p>
                                        <?php endif; ?>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                    </div>
                                </div>
                            </div>
                        </div>



                    <?php endwhile; ?>
                <?php else: ?>
                    <div class="col-12">
                        <div class="alert alert-light text-center text-danger">
                            Belum ada aspirasi masuk.
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Hero End -->


    <!-- Footer Start -->
    <div class="container-fluid bg-dark bg-footer text-light py-5">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-5 col-md-6">
                    <h4 class="text-primary">Get In Touch</h4>
                    <hr class="w-25 text-secondary mb-4" style="opacity: 1;">
                    <p class="mb-4">SMA Negeri 8 Yogyakarta</p>
                    <p class="mb-2"><i class="fa fa-map-marker-alt text-primary me-3"></i>Jl. Sidobali No.1, Muja Muju, Kec. Umbulharjo, Kota Yogyakarta, Daerah Istimewa Yogyakarta 55165</p>
                    <p class="mb-2"><i class="fa fa-envelope text-primary me-3"></i>sman8yogyakarta@yahoo.co.id</p>
                    <p class="mb-0"><i class="fa fa-phone-alt text-primary me-3"></i>(0274) 513493</p>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-primary">Quick Links</h4>
                    <hr class="w-25 text-secondary mb-4" style="opacity: 1;">
                    <div class="d-flex flex-column justify-content-start">
                        <a class="text-light mb-2" href="index.php"><i class="fa fa-angle-right me-2"></i>Home</a>
                        <a class="text-light mb-2" href="form_aspirasi.php"><i class="fa fa-angle-right me-2"></i>Ketik Aspirasi</a>
                        <a class="text-light mb-2" href="#"><i class="fa fa-angle-right me-2"></i>Aspirasi Masuk</a>
                        <a class="text-light mb-2" href="#"><i class="fa fa-angle-right me-2"></i>Profil</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-primary">Follow Us</h4>
                    <hr class="w-25 text-secondary mb-4" style="opacity: 1;">
                    <div class="d-flex">
                        <a class="btn btn-lg btn-primary btn-lg-square rounded-circle me-2" href="https://x.com/delayota"><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-lg btn-primary btn-lg-square rounded-circle me-2" href="https://www.facebook.com/delayota" target="_blank"><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-lg btn-primary btn-lg-square rounded-circle me-2" href="https://id.linkedin.com/company/sman8yogyakarta"><i class="fab fa-linkedin-in"></i></a>
                        <a class="btn btn-lg btn-primary btn-lg-square rounded-circle me-2" href="https://www.instagram.com/sman8yogyakarta"><i class="fab fa-instagram"></i></a>
                        <a class="btn btn-lg btn-primary btn-lg-square rounded-circle" href="https://www.youtube.com/channel/UCl7VOd2ZYuvwgVopVq48i4Q"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid bg-primary text-dark py-4">
        <div class="container">
            <div class="row g-0">
                <div class="col-md-6 text-center text-md-start">
                    <p class="mb-md-0">Copyright &copy; <a class="text-dark fw-bold" href="#">DELISA</a> Ideo Prayitno XI-F1/14.</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <p class="mb-0">Designed by <a class="text-dark fw-bold" href="https://htmlcodex.com">HTML Codex</a></p>
                    <p><br>Distributed By: <a class="border-bottom" href="https://themewagon.com" target="_blank">ThemeWagon</a></p>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-secondary btn-lg-square rounded-circle back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
    <!-- Bootstrap JS (wajib untuk dropdown bekerja) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


</body>

</html>