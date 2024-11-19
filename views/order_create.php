<?php include_once __DIR__ .'/templates/header.php'; ?>
<body>
<div class="container mt-5">
    <h1 class="text-center mb-4">Создать заказ</h1>
    <form method="POST" action="/Himchistcka/order_store">
        <div class="mb-3">
            <label class="form-label">Клиент</label>
            <input type="text" class="form-control" value="<?= htmlspecialchars($user->getFIO()) ?>" disabled>
        </div>
        <div class="mb-3">
            <label for="himchistka" class="form-label">Химчистка</label>
            <select id="himchistka" name="cod_himchistka" class="form-select" required>
                <option value="" selected>Выберите химчистку...</option>
                <?php foreach ($himchistkas as $himchistka): ?>
                    <option value="<?= $himchistka['cod_himchistka'] ?>"><?= htmlspecialchars($himchistka['name']) ?> (<?= htmlspecialchars($himchistka['addres']) ?>)</option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="items" class="form-label">Выберите вещи</label>
            <select id="items" name="items[]" class="form-select" multiple required>
                <?php foreach ($items as $item): ?>
                    <option value="<?= $item['cod_items'] ?>"><?= htmlspecialchars($item['name']) ?> (<?= number_format($item['cost'], 2, '.', ' ') ?> ₽)</option>
                <?php endforeach; ?>
            </select>
            <div class="form-text">Удерживайте Ctrl (или Cmd на Mac), чтобы выбрать несколько вещей.</div>
        </div>
        <div class="mb-3">
            <label for="date_admission" class="form-label">Дата приёма</label>
            <input type="date" id="date_admission" name="date_admission" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="date_end" class="form-label">Дата выдачи</label>
            <input type="date" id="date_end" name="date_end" class="form-control" required>
        </div>
        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">Сохранить</button>
            <a href="/Himchistcka/user_office" class="btn btn-secondary ms-2">Отмена</a>
        </div>
    </form>
</div>
<?php include_once __DIR__ .'/templates/footer.php'; ?>
