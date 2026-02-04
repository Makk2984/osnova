<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 text-center">
            <div class="card shadow">
                <div class="card-body p-5">
                    <div class="mb-4">
                        <i class="fas fa-check-circle text-success" style="font-size: 5rem;"></i>
                    </div>
                    
                    <h1 class="mb-3">Дякуємо за замовлення!</h1>
                    
                    <p class="lead mb-4">
                        Ваше замовлення <strong><?= htmlspecialchars($orderNumber ?? '') ?></strong> успішно оформлено.
                    </p>
                    
                    <p class="text-muted mb-4">
                        Ми надіслали підтвердження на вашу електронну пошту. 
                        Ви можете відстежити статус замовлення в особистому кабінеті.
                    </p>
                    
                    <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                        <a href="<?= baseUrl('user/orders') ?>" class="btn btn-primary btn-lg">
                            <i class="fas fa-shopping-bag me-2"></i> Мої замовлення
                        </a>
                        <a href="<?= baseUrl('products') ?>" class="btn btn-outline-secondary btn-lg">
                            <i class="fas fa-arrow-left me-2"></i> Продовжити покупки
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
