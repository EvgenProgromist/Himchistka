<?php include_once __DIR__ .'/templates/header.php'; ?>

<body>
<div class="wrapper d-flex flex-column min-vh-100">
    <main class="flex-grow-1">
        <div class="container mt-5">
            <h1 class="mb-4">Настройки профиля</h1>

            <!-- Сообщения об успехе или ошибке -->
            <?php if (!empty($_SESSION['success'])): ?>
                <div class="alert alert-success"><?= htmlspecialchars($_SESSION['success']); ?></div>
                <?php unset($_SESSION['success']); ?>
            <?php endif; ?>
            <?php if (!empty($_SESSION['error'])): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($_SESSION['error']); ?></div>
                <?php unset($_SESSION['error']); ?>
            <?php endif; ?>

            <!-- Форма редактирования профиля -->
            <form action="/Himchistcka/settings_update" method="POST">
                <div class="mb-3">
                    <label for="fio" class="form-label">ФИО</label>
                    <input type="text" name="fio" id="fio" class="form-control"
                           value="<?= htmlspecialchars($user->getFIO()); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Телефон</label>
                    <input type="text" name="phone" id="phone" class="form-control"
                           value="<?= htmlspecialchars($user->getNumber()); ?>" required>
                </div>
                <button type="submit" class="btn btn-primary">Сохранить изменения</button>
                <a href="/Himchistcka/user_office" class="btn btn-secondary">Отмена</a>
            </form>
        </div>
    </main>
<?php include_once __DIR__ .'/templates/footer.php'; ?>
</div>


