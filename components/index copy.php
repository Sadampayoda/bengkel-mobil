<?php
include __DIR__ . '/../app/config/app.php';
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
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        ::-webkit-scrollbar {
            width: 1px;
        }
    </style>
</head>

<body class="flex [font-family:'DM_Sans',sans-serif]">
    <?php include __DIR__ . '/../layouts/sidebar.php' ?>
    <div class="w-330 bg-blue-50  p-4">
        <!-- Header atau Top Content -->
        <?php include __DIR__.'/../layouts/nav.php' ?>
        
        <!-- Isi konten utama -->
        <div>
            <h1 class="text-lg font-semibold text-gray-800">
                <?= $content ?? '' ?>
            </h1>
        </div>
    </div>
    <?php include __DIR__ . '/../components/js.php' ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</body>

</html>