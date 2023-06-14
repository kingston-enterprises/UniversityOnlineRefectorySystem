<?php


namespace kingstonenterprises\app\controllers;

use kingston\icarus\Application;
use kingston\icarus\Controller;
use kingston\icarus\Request;
use kingston\icarus\helpers\Collection;
use kingstonenterprises\app\models\ItemCatergory;
use kingstonenterprises\app\models\Item;
use kingstonenterprises\app\models\Order;
use kingstonenterprises\app\models\User;
use kingstonenterprises\app\models\Role;
use kingstonenterprises\app\models\Permission;


class DashboardController extends Controller
{

    public function index()
    {

        if (Application::isGuest()) {
            Application::$app->session->setFlash('warning', 'You need To Login first');
            Application::$app->response->redirect('/auth/login');
        }

        $userModel = new User;
        $roleModel = new Role;
        $permissionModel = new Permission;
        $catergoriesModel = new ItemCatergory;
        $itemsModel = new Item;
        $ordersModel = new Order;

        $orders = new Collection($ordersModel->getAll());


        $user = $userModel->findOne(['id' => Application::$app->session->get('user')]);
        $user->joined = date_create($user->joined)->format("D M j Y");

        $perm = $permissionModel->findOne(['user_id' => Application::$app->session->get('user')]);
        $user->role = $roleModel->findOne(['id' => $perm->role_id]);

        $catergories = $catergoriesModel->getAll();
        $items = $itemsModel->getAll();

        return $this->render('dashboard/index', [
            'title' => 'Dashboard',
            'user' => $user,
            'catergories' => count($catergories),
            'items' => count($items),
            'orders' => $orders->count()
        ]);
    }

}
