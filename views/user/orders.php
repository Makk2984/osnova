<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="container my-5">
    <div class="row">
        <div class="col-md-3">
            <div class="list-group">
                <a href="<?= baseUrl('user/profile') ?>" class="list-group-item list-group-item-action">
                    <i class="fas fa-user me-2"></i> Профіль
                </a>
                <a href="<?= baseUrl('user/orders') ?>" class="list-group-item list-group-item-action active">
                    <i class="fas fa-shopping-bag me-2"></i> Мої замовлення
                </a>
                <a href="<?= baseUrl('user/settings') ?>" class="list-group-item list-group-item-action">
                    <i class="fas fa-cog me-2"></i> Налаштування
                </a>
                <a href="<?= baseUrl('logout') ?>" class="list-group-item list-group-item-action text-danger">
                    <i class="fas fa-sign-out-alt me-2"></i> Вийти
                </a>
            </div>
        </div>
        
        <div class="col-md-9">
            <h2 class="mb-4">Мої замовлення</h2>
            
            <?php if (isset($_SESSION['success'])): ?>
                <div class="alert alert-success alert-dismissible fade show">
                    <?= htmlspecialchars($_SESSION['success']) ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                <?php unset($_SESSION['success']); ?>
            <?php endif; ?>
            
            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-danger alert-dismissible fade show">
                    <?= htmlspecialchars($_SESSION['error']) ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                <?php unset($_SESSION['error']); ?>
            <?php endif; ?>
            
            <?php if (empty($orders)): ?>
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i>
                    У вас поки немає замовлень. <a href="<?= baseUrl('products') ?>" class="alert-link">Почати покупки</a>
                </div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>№ Замовлення</th>
                                <th>Дата</th>
                                <th>Статус</th>
                                <th>Сума</th>
                                <th>Дії</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($orders as $order): ?>
                                <tr>
                                    <td>
                                        <strong><?= htmlspecialchars($order['order_number']) ?></strong>
                                    </td>
                                    <td>
                                        <?= date('d.m.Y H:i', strtotime($order['created_at'])) ?>
                                    </td>
                                    <td>
                                        <?php
                                        $statusClasses = [
                                            'pending' => 'badge bg-warning',
                                            'processing' => 'badge bg-info',
                                            'shipped' => 'badge bg-primary',
                                            'delivered' => 'badge bg-success',
                                            'cancelled' => 'badge bg-danger'
                                        ];
                                        $statusLabels = [
                                            'pending' => 'В обробці',
                                            'processing' => 'Обробляється',
                                            'shipped' => 'Відправлено',
                                            'delivered' => 'Доставлено',
                                            'cancelled' => 'Скасовано'
                                        ];
                                        $status = $order['status'] ?? 'pending';
                                        $class = $statusClasses[$status] ?? 'badge bg-secondary';
                                        $label = $statusLabels[$status] ?? 'Невідомо';
                                        ?>
                                        <span class="<?= $class ?>"><?= $label ?></span>
                                    </td>
                                    <td>
                                        <strong><?= number_format($order['total_amount'], 2) ?> ₴</strong>
                                    </td>
                                    <td>
                                        <a href="<?= baseUrl('user/orders/' . $order['id']) ?>" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-eye me-1"></i> Переглянути
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                
                <?php if ($totalPages > 1): ?>
                    <nav aria-label="Pagination">
                        <ul class="pagination justify-content-center">
                            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                <li class="page-item <?= $i === $page ? 'active' : '' ?>">
                                    <a class="page-link" href="<?= baseUrl('user/orders?page=' . $i) ?>">
                                        <?= $i ?>
                                    </a>
                                </li>
                            <?php endfor; ?>
                        </ul>
                    </nav>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
