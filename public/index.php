<?php


use kingstonenterprises\app\controllers\SiteController;
use kingstonenterprises\app\controllers\AuthController;
use kingstonenterprises\app\controllers\DashboardController;
use kingstonenterprises\app\controllers\CatergoryController;
use kingstonenterprises\app\controllers\ItemsController;
use kingstonenterprises\app\models\Visitor;
use kingstonenterprises\app\controllers\OrderController;


use kingston\icarus\Application;

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = \Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();
$config = [
    'db' => [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD'],
    ],
    'migrations' => '/../migrations/'
];

$app = new Application(dirname(__DIR__), $config);


$app->on(Application::EVENT_BEFORE_REQUEST, function () {
    $visitor = new Visitor();

    if (!$visitor->findOne(['ip' => $visitor->ip])) {
        $visitor->ip = $visitor->ip;
        $visitor->save();
    }

    $visitor = $visitor->findOne(['ip' => $visitor->ip]);
    Application::$app->session->set('visitorId', $visitor->id);
});


$app->triggerEvent(Application::EVENT_AFTER_REQUEST);
// URL structure : /controller/method/{params}

// Site controller
$app->router->get('/', [SiteController::class, 'home']);
$app->router->post('/', [SiteController::class, 'home']);

// Auth controller
$app->router->get('/auth/register', [AuthController::class, 'register']);
$app->router->post('/auth/register', [AuthController::class, 'register']);
$app->router->get('/auth/login', [AuthController::class, 'login']);
$app->router->post('/auth/login', [AuthController::class, 'login']);
$app->router->get('/auth/logout', [AuthController::class, 'logout']);


// Dashboard controller
$app->router->get('/dashboard', [DashboardController::class, 'index']);

//Catergories controller
$app->router->get('/catergories', [CatergoryController::class, 'index']);
$app->router->get('/catergories/new/', [CatergoryController::class, 'create']);
$app->router->post('/catergories/new/', [CatergoryController::class, 'create']);
$app->router->get('/catergories/update/{id}', [CatergoryController::class, 'update']);
$app->router->post('/catergories/update/{id}', [CatergoryController::class, 'update']);
$app->router->post('/catergories/delete/{id}', [CatergoryController::class, 'delete']);

// Items Controller
$app->router->get('/items', [ItemsController::class, 'index']);
$app->router->get('/items/new/', [ItemsController::class, 'create']);
$app->router->post('/items/new/', [ItemsController::class, 'create']);
$app->router->get('/items/update/{id}', [ItemsController::class, 'update']);
$app->router->post('/items/update/{id}', [ItemsController::class, 'update']);
$app->router->get('/items/delete/{id}', [ItemsController::class, 'delete']);
$app->router->post('/items/delete/{id}', [ItemsController::class, 'delete']);

// Carts Controller
$app->router->get('/orders', [OrderController::class, 'index']);
$app->router->post('/orders/insert/{id}', [OrderController::class, 'insert']);
$app->router->get('/orders/delete/{id}', [OrderController::class, 'delete']);
$app->router->get('/orders/view', [OrderController::class, 'view']);
$app->router->get('/orders/pay/{id}', [OrderController::class, 'pay']);

$app->run();
