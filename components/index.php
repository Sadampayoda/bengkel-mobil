<?php
include __DIR__ . '/../app/config/app.php';
include __DIR__ . '/../app/config/session.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bengkel Motor</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/style/index.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <script src="<?= BASE_URL ?>/js/jquery-3.7.1.min.js"></script>
    <script src="<?= BASE_URL ?>/js/plugin/webfont/webfont.min.js"></script>
    <script>
        WebFont.load({
            google: {
                families: ["Public Sans:300,400,500,600,700"]
            },
            custom: {
                families: [
                    "Font Awesome 5 Solid",
                    "Font Awesome 5 Regular",
                    "Font Awesome 5 Brands",
                    "simple-line-icons",
                ],
                urls: ["assets/css/fonts.min.css"],
            },
            active: function() {
                sessionStorage.fonts = true;
            },
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="<?= BASE_URL ?>/style/bootstrap.min.css" />
    <link rel="stylesheet" href="<?= BASE_URL ?>/style/plugins.min.css" />
    <link rel="stylesheet" href="<?= BASE_URL ?>/style/kaiadmin.min.css" />

    <link rel="stylesheet" href="<?= BASE_URL ?>/style/demo.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.4.3/dist/css/tom-select.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.4.3/dist/js/tom-select.complete.min.js"></script>
    <style>
        ::-webkit-scrollbar {
            width: 1px;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <?php include __DIR__ . '/../layouts/sidebar.php' ?>
        <div class="main-panel">
            <?php include __DIR__ . '/../layouts/nav.php' ?>
            <div class="container p-3">
                <?= $content ?? '' ?>
            </div>
        </div>
    </div>

    <?php include __DIR__ . '/../components/js.php' ?>
    <script src="<?= BASE_URL ?>/js/core/jquery-3.7.1.min.js">
        < /> <
        script src = "<?= BASE_URL ?>/js/core/popper.min.js" >
    </script>
    <script src="<?= BASE_URL ?>/js/core/bootstrap.min.js"></script>

    <!-- jQuery Scrollbar -->
    <script src="<?= BASE_URL ?>/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

    <!-- Chart JS -->
    <script src="<?= BASE_URL ?>/js/plugin/chart.js/chart.min.js"></script>

    <!-- jQuery Sparkline -->
    <script src="<?= BASE_URL ?>/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

    <!-- Chart Circle -->
    <script src="<?= BASE_URL ?>/js/plugin/chart-circle/circles.min.js"></script>

    <!-- Datatables -->
    <script src="<?= BASE_URL ?>/js/plugin/datatables/datatables.min.js"></script>

    <!-- Bootstrap Notify -->
    <script src="<?= BASE_URL ?>/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

    <!-- jQuery Vector Maps -->
    <script src="<?= BASE_URL ?>/js/plugin/jsvectormap/jsvectormap.min.js"></script>
    <script src="<?= BASE_URL ?>/js/plugin/jsvectormap/world.js"></script>

    <!-- Sweet Alert -->
    <script src="<?= BASE_URL ?>/js/plugin/sweetalert/sweetalert.min.js"></script>

    <!-- Kaiadmin JS -->
    <script src="<?= BASE_URL ?>/js/kaiadmin.min.js"></script>

    <!-- Kaiadmin DEMO methods, don't include it in your project! -->
    <script src="<?= BASE_URL ?>/js/setting-demo.js"></script>
    <script src="<?= BASE_URL ?>/js/demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</body>

</html>