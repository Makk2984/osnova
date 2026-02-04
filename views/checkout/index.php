<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="container my-5">
    <h2 class="mb-4">Оформлення замовлення</h2>
    
    <?php if (isset($_SESSION['errors']) && !empty($_SESSION['errors'])): ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php foreach ($_SESSION['errors'] as $error): ?>
                    <li><?= htmlspecialchars($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php unset($_SESSION['errors']); ?>
    <?php endif; ?>
    
    <div class="row">
        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Інформація про доставку</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="<?= baseUrl('checkout') ?>">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="first_name" class="form-label">Ім'я *</label>
                                <input type="text" class="form-control" id="first_name" name="first_name" 
                                       value="<?= htmlspecialchars($user['first_name'] ?? '') ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label for="last_name" class="form-label">Прізвище *</label>
                                <input type="text" class="form-control" id="last_name" name="last_name" 
                                       value="<?= htmlspecialchars($user['last_name'] ?? '') ?>" required>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="email" class="form-label">Email *</label>
                            <input type="email" class="form-control" id="email" name="email" 
                                   value="<?= htmlspecialchars($user['email'] ?? '') ?>" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="phone" class="form-label">Телефон *</label>
                            <input type="tel" class="form-control" id="phone" name="phone" 
                                   value="<?= htmlspecialchars($user['phone'] ?? '') ?>" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="delivery_address" class="form-label">Адреса доставки *</label>
                            <textarea class="form-control" id="delivery_address" name="delivery_address" 
                                      rows="3" required><?= htmlspecialchars($user['address'] ?? '') ?></textarea>
                        </div>
                        
                        <div class="mb-3">
                            <label for="payment_method" class="form-label">Спосіб оплати *</label>
                            <select class="form-select" id="payment_method" name="payment_method" required>
                                <option value="">Оберіть спосіб оплати</option>
                                <option value="cash_on_delivery">Готівка при отриманні</option>
                                <option value="card_online">Оплата карткою онлайн</option>
                                <option value="bank_transfer">Банківський переказ</option>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label for="notes" class="form-label">Примітки до замовлення</label>
                            <textarea class="form-control" id="notes" name="notes" rows="3" 
                                      placeholder="Додаткова інформація про замовлення..."></textarea>
                        </div>
                        
                        <button type="submit" class="btn btn-primary btn-lg w-100">
                            <i class="fas fa-check me-2"></i> Оформити замовлення
                        </button>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Ваше замовлення</h5>
                </div>
                <div class="card-body">
                    <?php if (!empty($cartItems)): ?>
                        <div class="order-summary">
                            <?php foreach ($cartItems as $item): ?>
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <strong><?= htmlspecialchars($item['name']) ?></strong>
                                        <br>
                                        <small class="text-muted">Кількість: <?= $item['quantity'] ?></small>
                                    </div>
                                    <div>
                                        <?= number_format($item['subtotal'], 2) ?> ₴
                                    </div>
                                </div>
                            <?php endforeach; ?>
                            
                            <hr>
                            
                            <div class="d-flex justify-content-between mb-2">
                                <span>Сума:</span>
                                <strong><?= number_format($cartTotal, 2) ?> ₴</strong>
                            </div>
                            
                            <div class="d-flex justify-content-between mb-2">
                                <span>Доставка:</span>
                                <span>Безкоштовно</span>
                            </div>
                            
                            <hr>
                            
                            <div class="d-flex justify-content-between">
                                <strong>Разом:</strong>
                                <strong class="text-primary h5 mb-0"><?= number_format($cartTotal, 2) ?> ₴</strong>
                            </div>
                        </div>
                    <?php else: ?>
                        <p class="text-center text-muted">Кошик порожній</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
