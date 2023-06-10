<?php


namespace kingstonenterprises\app\controllers;

use kingston\icarus\Application;
use kingston\icarus\Controller;
use kingston\icarus\Request;
use kingston\icarus\helpers\Collection;
use kingstonenterprises\app\models\ItemCatergory;
use kingstonenterprises\app\models\Item;
use kingstonenterprises\app\models\User;
use kingstonenterprises\app\models\Visitor;
use kingstonenterprises\app\models\Role;
use kingstonenterprises\app\models\Permission;


/**
 * controls the the sites dashboard views
 *
 * @extends \kingston\icarus\Controller
 */
class DashboardController extends Controller
{

    /**
     * collect stats and render dashboard
     * 
     * @return string
     */
    public function index()
    {

        if (Application::isGuest()) {
            Application::$app->session->setFlash('warning', 'You need To Login first');
            Application::$app->response->redirect('/auth/login');
        }

        $visitorModel = new Visitor;
        $userModel = new User;
        $roleModel = new Role;
        $permissionModel = new Permission;
        $catergoriesModel = new ItemCatergory;
        $itemsModel = new Item;

        $visitors = new Collection($visitorModel->getAll());


        $user = $userModel->findOne(['id' => Application::$app->session->get('user')]);
        $user->joined = date_create($user->joined)->format("D M j Y");

        $perm = $permissionModel->findOne(['user_id' => Application::$app->session->get('user')]);
        $user->role = $roleModel->findOne(['id' => $perm->role_id]);

        $catergories = $catergoriesModel->getAll();
        $items = $itemsModel->getAll();

        return $this->render('dashboard/index', [
            'title' => 'Dashboard',
            'visitors' => $visitors->count(),
            'user' => $user,
            'catergories' => count($catergories),
            'items' => count($items)
        ]);
    }

}
