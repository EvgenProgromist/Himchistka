<?php
require_once "./vendor/autoload.php";

$collection = new RoutCollection();
$collection->add(new Route("/Himchistcka/", "GET", IndexController::class, 'home'));
$collection->add(new Route("/Himchistcka/home", "GET", IndexController::class, 'home'));
$collection->add(new Route("/Himchistcka/user_office", "GET", IndexController::class, 'user_office'));
$collection->add(new Route("/Himchistcka/user_office", "POST", IndexController::class, 'user_office'));
$collection->add(new Route("/Himchistcka/login", "GET", IndexController::class, 'login'));
$collection->add(new Route("/Himchistcka/login", "POST", IndexController::class, 'login'));
$collection->add(new Route("/Himchistcka/register", "GET", IndexController::class, 'register'));
$collection->add(new Route("/Himchistcka/register", "POST", IndexController::class, 'register'));
$collection->add(new Route("/Himchistcka/logout", "GET", IndexController::class, 'logout'));
$collection->add(new Route("/Himchistcka/settings_profile", "GET", SettingsController::class, 'settings'));
$collection->add(new Route("/Himchistcka/settings_update", "POST", SettingsController::class, 'updateSettings'));
$collection->add(new Route("/Himchistcka/order_create", "GET", OrderController::class, 'create')); // Рендеринг формы
$collection->add(new Route("/Himchistcka/order_store", "POST", OrderController::class, 'store')); // Обработка формы
/*$collection->add(new Route("/Himchistcka/delete_user", "POST", PortfolioController::class, 'deleteUser'));*/

$routMatcher = new RoutMatcher($collection);
$rout = $routMatcher->match($_SERVER['REQUEST_URI']);

$class_name = $rout->getClass();
$method = $rout->getClassMethod();
$controller = new $class_name();
$controller->$method();


