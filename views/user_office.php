<?php include_once __DIR__ .'/templates/header.php'; ?>

<!-- Main Content -->
<div class="wrapper d-flex flex-column min-vh-100">
    <main class="flex-grow-1">
        <div class="container mt-4">
            <div class="row">
                <div class="col-md-3">
                    <div class="card text-center border-0 shadow-sm mb-4">
                        <div class="card-body">
                            <a href="/Himchistcka/settings_profile" class="btn btn-outline-secondary btn-sm">Настройка</a>
                            <a href="/Himchistcka/logout" class="btn btn-outline-danger btn-sm ms-2">Выйти</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h3>Заказы</h3>
                        <a href="/Himchistcka/order_create" class="btn btn-outline-secondary">+ Новый заказ</a>
                    </div>
                    <ul class="nav nav-tabs mb-3">
                        <li class="nav-item">
                            <a class="nav-link <?= $activeTab == 'active' ? 'active' : '' ?>" href="#active-orders" data-bs-toggle="tab">Активные</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= $activeTab == 'completed' ? 'active' : '' ?>" href="#completed-orders" data-bs-toggle="tab">Выданные</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <!-- Активные заказы -->
                        <div class="tab-pane fade <?= $activeTab == 'active' ? 'show active' : '' ?>" id="active-orders">
                            <h2>Активные заказы</h2>
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Номер заказа</th>
                                    <th>Клиент</th>
                                    <th>Дата приема</th>
                                    <th>Дата выдачи</th>
                                    <th>Количество изделий</th>
                                    <th>Стоимость (₽)</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if (!empty($activeOrders)): ?>
                                    <?php foreach ($activeOrders as $order): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($order['order_id']) ?></td>
                                            <td><?= htmlspecialchars($order['user_name']) ?></td>
                                            <td><?= htmlspecialchars($order['date_received']) ?></td>
                                            <td><?= htmlspecialchars($order['date_issued']) ?></td>
                                            <td><?= htmlspecialchars($order['item_count']) ?></td>
                                            <td><?= htmlspecialchars(number_format($order['total_cost'], 2)) ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="6" class="text-center">Нет активных заказов</td>
                                    </tr>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>

                        <!-- Завершенные заказы -->
                        <div class="tab-pane fade <?= $activeTab == 'completed' ? 'show active' : '' ?>" id="completed-orders">
                            <h2>Выданные заказы</h2>
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Номер заказа</th>
                                    <th>Клиент</th>
                                    <th>Дата приема</th>
                                    <th>Дата выдачи</th>
                                    <th>Количество изделий</th>
                                    <th>Стоимость (₽)</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if (!empty($completedOrders)): ?>
                                    <?php foreach ($completedOrders as $order): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($order['order_id']) ?></td>
                                            <td><?= htmlspecialchars($order['user_name']) ?></td>
                                            <td><?= htmlspecialchars($order['date_received']) ?></td>
                                            <td><?= htmlspecialchars($order['date_issued']) ?></td>
                                            <td><?= htmlspecialchars($order['item_count']) ?></td>
                                            <td><?= htmlspecialchars(number_format($order['total_cost'], 2)) ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="6" class="text-center">Нет завершенных заказов</td>
                                    </tr>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- Footer -->
    <?php include_once __DIR__ .'/templates/footer.php'; ?>
</div>
<!-- Bootstrap Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

