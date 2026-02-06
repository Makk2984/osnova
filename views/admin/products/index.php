<?php include __DIR__ . '/../../layouts/header.php'; ?>

<div class="container py-4">
    <div class="row mb-4">
        <div class="col-md-6">
            <h1 class="mb-0">Управління товарами</h1>
        </div>
        <div class="col-md-6 text-end">
            <a href="<?= baseUrl('admin/products/create') ?>" class="btn btn-primary">
                <i class="fas fa-plus"></i> Додати товар
            </a>
        </div>
    </div>

    <!-- Search Form -->
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" class="row g-3">
                <div class="col-md-8">
                    <input type="text" class="form-control" name="search" placeholder="Пошук товарів..." value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-outline-primary w-100">Пошук</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Products Table -->
    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Назва</th>
                        <th>Категорія</th>
                        <th>Ціна</th>
                        <th>На складі</th>
                        <th>Статус</th>
                        <th>Дії</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($products)): ?>
                        <?php foreach ($products as $product): ?>
                            <tr>
                                <td><?= (int)$product['id'] ?></td>
                                <td>
                                    <strong><?= htmlspecialchars($product['name']) ?></strong>
                                </td>
                                <td><?= htmlspecialchars($product['category_name'] ?? 'N/A') ?></td>
                                <td><?= number_format($product['price'], 2) ?> грн</td>
                                <td><?= (int)$product['stock_quantity'] ?></td>
                                <td>
                                    <span class="badge <?= $product['is_active'] ? 'bg-success' : 'bg-secondary' ?>">
                                        <?= $product['is_active'] ? 'Активний' : 'Неактивний' ?>
                                    </span>
                                </td>
                                <td>
                                    <a href="<?= baseUrl('admin/products/' . $product['id'] . '/edit') ?>" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i> Редагувати
                                    </a>
                                    <form method="POST" action="<?= baseUrl('admin/products/' . $product['id'] . '/delete') ?>" style="display:inline;" onsubmit="return confirm('Ви впевнені?');">
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i> Видалити
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">Товари не знайдені</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <?php if ($totalPages > 1): ?>
        <nav aria-label="Page navigation" class="mt-4">
            <ul class="pagination justify-content-center">
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <li class="page-item <?= $i == $_GET['page'] ?? 1 ? 'active' : '' ?>">
                        <a class="page-link" href="<?= baseUrl('admin/products?page=' . $i . '&search=' . urlencode($_GET['search'] ?? '')) ?>">
                            <?= $i ?>
                        </a>
                    </li>
                <?php endfor; ?>
            </ul>
        </nav>
    <?php endif; ?>
</div>

<?php include __DIR__ . '/../../layouts/footer.php'; ?>
