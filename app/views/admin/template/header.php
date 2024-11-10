<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?= BASEURL; ?>/css/bootstrap.css" rel="stylesheet">
    <title><?= $data['judul']; ?></title>
</head>
<body>
    
    <?php var_dump($_SESSION); ?> <br>
    <h1><?= $_SESSION['EmailorUser']; ?></h1>
    <a href="<?= BASEURL; ?>/logout">Logout</a>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="<?= BASEURL; ?>/js/bootstrap.js"></script>
</body>
</html>
