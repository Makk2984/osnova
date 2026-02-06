<?php include __DIR__ . '/../../layouts/header.php'; ?>

<div class="container py-4">
    <div class="row">
        <div class="col-md-6">
            <h1>Додати новий товар</h1>
        </div>
        <div class="col-md-6 text-end">
            <a href="<?= baseUrl('admin/products') ?>" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left"></i> Повернутися до товарів
            </a>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <?php if (!empty($errors ?? [])): ?>
                        <div class="alert alert-danger alert-dismissible fade show">
                            <ul class="mb-0">
                                <?php foreach ($errors as $error): ?>
                                    <li><?= htmlspecialchars($error) ?></li>
                                <?php endforeach; ?>
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>

                    <form method="POST">
                        <div class="mb-3">
                            <label for="name" class="form-label">Назва товару *</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars(old('name') ?? '') ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="category_id" class="form-label">Категорія *</label>
                            <select class="form-control" id="category_id" name="category_id" required>
                                <option value="">-- Оберіть категорію --</option>
                                <?php foreach ($categories as $category): ?>
                                    <option value="<?= (int)$category['id'] ?>"><?= htmlspecialchars($category['name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Опис</label>
                            <textarea class="form-control" id="description" name="description" rows="4"><?= htmlspecialchars(old('description') ?? '') ?></textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="price" class="form-label">Ціна (грн) *</label>
                                <input type="number" class="form-control" id="price" name="price" step="0.01" value="<?= htmlspecialchars(old('price') ?? '') ?>" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="stock_quantity" class="form-label">Кількість на складі *</label>
                                <input type="number" class="form-control" id="stock_quantity" name="stock_quantity" value="<?= htmlspecialchars(old('stock_quantity') ?? '') ?>" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="flavor" class="form-label">Смак</label>
                                <input type="text" class="form-control" id="flavor" name="flavor" value="<?= htmlspecialchars(old('flavor') ?? '') ?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="nicotine_content" class="form-label">Вміст нікотину</label>
                                <input type="number" class="form-control" id="nicotine_content" name="nicotine_content" step="0.1" value="<?= htmlspecialchars(old('nicotine_content') ?? '') ?>">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="image_url" class="form-label">URL зображення</label>
                            <input type="url" class="form-control" id="image_url" name="image_url" value="<?= htmlspecialchars(old('image_url') ?? '') ?>">
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" checked>
                                <label class="form-check-label" for="is_active">
                                    Активний товар
                                </label>
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Зберегти товар
                            </button>
                            <a href="<?= baseUrl('admin/products') ?>" class="btn btn-outline-secondary">Скасувати</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../../layouts/footer.php'; ?>
