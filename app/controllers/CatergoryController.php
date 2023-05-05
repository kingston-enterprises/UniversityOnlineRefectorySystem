<?php

/**
 * @category controllers
 * @author kingston-5 <qhawe@kingston-enterprises.net>
 * @license For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace kingstonenterprises\app\controllers;

use kingston\icarus\helpers\Collection;


use kingston\icarus\Application;
use kingston\icarus\Controller;
use kingston\icarus\Request;
use kingstonenterprises\app\models\ItemCatergory;


/**
 * controls the the sites  category CRUD operations
 *
 * @extends \kingston\icarus\Controller
 */
class CatergoryController extends Controller
{

    /**
     * collect catergories and render index view
     * 
     * @return string
     */
    public function index()
    {

        if (Application::isGuest()) {
            Application::$app->session->setFlash('warning', 'You need To Login first');
            Application::$app->response->redirect('/auth/login');
        }

        $catergoriesModel = new ItemCatergory;

        $catergories = new Collection($catergoriesModel->getAll());

        return $this->render('catergories/index', [
            'title' => 'Catergories Dashboard',
            'catergories' => $catergories
        ]);
    }

    /**
     * create a new catergory or render the creation form
     * 
     * @param Request
     * @return string
     */
    public function create(Request $request)
    {

        if (Application::isGuest()) {
            Application::$app->session->setFlash('warning', 'You need To Login first');
            Application::$app->response->redirect('/auth/login');
        }

        $catergoriesModel = new ItemCatergory;

        if ($request->getMethod() === 'post') {
            $catergoriesModel->loadData($request->getBody());

            if ($catergoriesModel->validate() && $catergoriesModel->save()) {

                Application::$app->session->setFlash('success', 'New catergory created');
                Application::$app->response->redirect('/catergories');
                return 'Show success page';
            }
        }

        return $this->render('catergories/new', [
            'title' => 'Catergories Dashboard',
            'model' => $catergoriesModel
        ]);
    }

    /**
     * update an existing catergory or render the update form
     * 
     * @param Request
     * @return string
     */
    public function update(Request $request)
    {

        if (Application::isGuest()) {
            Application::$app->session->setFlash('warning', 'You need To Login first');
            Application::$app->response->redirect('/auth/login');
        }

        $catergory = new ItemCatergory;
        $catergory = $catergory->findOne(['id' => $request->getRouteParam('id')]);

        if ($request->getMethod() === 'post') {
            $catergory->loadData($request->getBody());

            if ($catergory->validate() && $catergory->update($catergory->id)) {

                Application::$app->session->setFlash('success', 'New catergory created');
                Application::$app->response->redirect('/catergories');
                return 'Show success page';
            }
        }

        return $this->render('catergories/editCatergory', [
            'title' => 'Catergories Dashboard',
            'catergory' => $catergory,
            'model' => $catergory
        ]);
    }

    /**
     * delete a new catergory
     * 
     * @param Request
     * @return string
     */
    public function delete(Request $request)
    {

        if (Application::isGuest()) {
            Application::$app->session->setFlash('warning', 'You need To Login first');
            Application::$app->response->redirect('/auth/login');
        }

        $catergoriesModel = new ItemCatergory;
        $catergory = $catergoriesModel->findOne(['id' => $request->getRouteParam('id')]);

        if ($request->getMethod() === 'post') {

            if ($catergory->delete($catergory->id)) {

                Application::$app->session->setFlash('success', 'catergory deleted');
                Application::$app->response->redirect('/catergories');
                return 'Show success page';
            }
        }

        $catergories = new Collection($catergoriesModel->getAll());

        return $this->render('catergories/index', [
            'title' => 'Catergories Dashboard',
            'catergories' => $catergories
        ]);
    }
}
