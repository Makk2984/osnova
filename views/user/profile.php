<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="container my-5">
    <div class="row">
        <div class="col-md-3">
            <div class="list-group">
                <a href="<?= baseUrl('user/profile') ?>" class="list-group-item list-group-item-action active">
                    <i class="fas fa-user me-2"></i> Профіль
                </a>
                <a href="<?= baseUrl('user/orders') ?>" class="list-group-item list-group-item-action">
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
            <h2 class="mb-4">Мій профіль</h2>
            
            <div class="card">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-sm-4"><strong>Ім'я:</strong></div>
                        <div class="col-sm-8"><?= htmlspecialchars($user['first_name'] ?? '') ?></div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-sm-4"><strong>Прізвище:</strong></div>
                        <div class="col-sm-8"><?= htmlspecialchars($user['last_name'] ?? '') ?></div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-sm-4"><strong>Email:</strong></div>
                        <div class="col-sm-8"><?= htmlspecialchars($user['email'] ?? '') ?></div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-sm-4"><strong>Телефон:</strong></div>
                        <div class="col-sm-8"><?= htmlspecialchars($user['phone'] ?? 'Не вказано') ?></div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-sm-4"><strong>Адреса:</strong></div>
                        <div class="col-sm-8"><?= htmlspecialchars($user['address'] ?? 'Не вказано') ?></div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-4"><strong>Роль:</strong></div>
                        <div class="col-sm-8">
                            <?php
                            $roles = [
                                'customer' => 'Покупець',
                                'seller' => 'Продавець',
                                'admin' => 'Адміністратор'
                            ];
                            echo $roles[$user['role']] ?? 'Користувач';
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            
            <h3 class="mt-5 mb-3">Останні замовлення</h3>
            
            <?php if (empty($recentOrders)): ?>
                <div class="alert alert-info">
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
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($recentOrders as $order): ?>
                                <tr>
                                    <td><?= htmlspecialchars($order['order_number']) ?></td>
                                    <td><?= date('d.m.Y', strtotime($order['created_at'])) ?></td>
                                    <td>
                                        <?php
                                        $statusLabels = [
                                            'pending' => 'В обробці',
                                            'processing' => 'Обробляється',
                                            'shipped' => 'Відправлено',
                                            'delivered' => 'Доставлено',
                                            'cancelled' => 'Скасовано'
                                        ];
                                        echo $statusLabels[$order['status']] ?? 'Невідомо';
                                        ?>
                                    </td>
                                    <td><?= number_format($order['total_amount'], 2) ?> ₴</td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                
                <a href="<?= baseUrl('user/orders') ?>" class="btn btn-primary">Переглянути всі замовлення</a>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
