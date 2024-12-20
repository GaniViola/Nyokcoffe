<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['judul']; ?></title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body>
<div class="container my-5">
    <h1 class="mb-4 text-center">Orders</h1>

    <!-- Orders Cards -->
    <div class="row row-cols-1 row-cols-md-2 g-4">
        <?php foreach ($data['orders'] as $Orders) : ?>
            <div class="col">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Order ID: ORD<?= $Orders['id_order']; ?></h5>
                        <p class="card-text">Order Date: <?= $Orders['created_at']; ?></p>
                        <p class="card-text">Total: <strong>Rp <?= number_format($Orders['total'], 0, ',', '.'); ?></strong></p>
                        
                        <div class="d-flex justify-content-between align-items-center">
                            <?php if ($Orders['status'] === 'pending') : ?>
                            <span class="badge bg-warning">Pending</span>
                            <a href="<?= BASEURL; ?>/MidtransController/<?= $Orders['id_order']; ?>" class="btn btn-primary btn-sm">Pay</a>
                            <?php elseif ($Orders['status'] === 'completed') : ?>
                            <span class="badge bg-success">Completed</span>
                            <?php else : ?>
                            <span class="badge bg-secondary"><?= ucfirst($Orders['status']); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>


    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
