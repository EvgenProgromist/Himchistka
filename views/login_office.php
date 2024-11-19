
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Вход</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
<header>
    <?php include_once __DIR__ .'/templates/header.php'; ?>
</header>
<main class="flex-grow-1">
    <section class="hero-section d-flex align-items-center bg-light" style="padding: 80px 0;">
        <div class="container mt-5 mb-5">
            <div class="col-md-6 mx-auto">
                <h2>Вход</h2>
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger"><?= $error ?></div>
                <?php endif; ?>
                <form method="POST" action="/Himchistcka/login">
                    <div class="form-group">
                        <label>Ваше ФИО</label>
                        <!-- Поле с подсказкой -->
                        <input type="text" name="username" class="form-control" required
                               data-toggle="tooltip" title="Введите ваше полное имя (например, Иванов Иван Иванович)">
                    </div>
                    <div class="form-group">
                        <label>Номер телефона</label>
                        <!-- Поле с подсказкой -->
                        <input type="text" name="number" class="form-control" required
                               data-toggle="tooltip" title="Введите номер телефона в формате +7XXXXXXXXXX">
                    </div>
                    <button type="submit" class="btn btn-outline-secondary btn-lg">Войти</button>
                    <p class="mt-3">Еще нет аккаунта ? <a href="/Himchistcka/register">Зарегистрироваться здесь</a>.</p>
                </form>
            </div>
        </div>
    </section>
</main>

<?php include_once __DIR__ .'/templates/footer.php'; ?>

<!-- Инициализация подсказок -->
<script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>

</body>
</html>
