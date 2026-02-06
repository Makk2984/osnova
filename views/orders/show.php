<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="container py-5">
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="mb-3">Замовлення #<?= htmlspecialchars($order['id']) ?></h1>
            <a href="<?= baseUrl('user/orders') ?>" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left"></i> Повернутися до замовлень
            </a>
        </div>
    </div>

    <div class="row">
        <!-- Order Details -->
        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Інформація про замовлення</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h6 class="text-muted">Номер замовлення</h6>
                            <p>#<?= htmlspecialchars($order['id']) ?></p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-muted">Статус</h6>
                            <p>
                                <span class="badge <?= $order['status'] === 'completed' ? 'bg-success' : ($order['status'] === 'cancelled' ? 'bg-danger' : 'bg-warning') ?>">
                                    <?= ucfirst(htmlspecialchars($order['status'])) ?>
                                </span>
                            </p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h6 class="text-muted">Дата замовлення</h6>
                            <p><?= date('d.m.Y H:i', strtotime($order['created_at'])) ?></p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-muted">Загальна сума</h6>
                            <p><strong><?= number_format($order['total'], 2) ?> грн</strong></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Items -->
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Товари в замовленні</h5>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Товар</th>
                                <th>Ціна</th>
                                <th>Кількість</th>
                                <th>Сума</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($orderItems as $item): ?>
                                <tr>
                                    <td>
                                        <strong><?= htmlspecialchars($item['product_name']) ?></strong>
                                    </td>
                                    <td><?= number_format($item['price'], 2) ?> грн</td>
                                    <td><?= (int)$item['quantity'] ?></td>
                                    <td><?= number_format($item['total'], 2) ?> грн</td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Shipping Details -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0">Доставка</h5>
                </div>
                <div class="card-body">
                    <h6 class="text-muted">Адреса доставки</h6>
                    <p>
                        <?= htmlspecialchars($order['shipping_address']) ?><br>
                        <?= htmlspecialchars($order['shipping_city']) ?><br>
                        <?= htmlspecialchars($order['shipping_postal_code']) ?>
                    </p>
                    
                    <hr>
                    
                    <h6 class="text-muted">Контактна інформація</h6>
                    <p>
                        <?= htmlspecialchars($order['shipping_phone']) ?><br>
                        <?= htmlspecialchars($order['shipping_email']) ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
