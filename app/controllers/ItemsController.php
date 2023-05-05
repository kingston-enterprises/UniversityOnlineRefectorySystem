<?php

/**
 * @category controllers
 * @author kingston-5 <qhawe@kingston-enterprises.net>
 * @license For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace kingstonenterprises\app\controllers;

use kingston\icarus\helpers\Collection;
use kingston\icarus\helpers\File;



use kingston\icarus\Application;
use kingston\icarus\Controller;
use kingston\icarus\Request;
use kingstonenterprises\app\models\Item;
use kingstonenterprises\app\models\ItemCatergory;



/**
 * controls the the sites items CRUD operations
 *
 * @extends \kingston\icarus\Controller
 */
class ItemsController extends Controller
{

    /**
     * collect items and render index view
     * 
     * @return string
     */
    public function index()
    {

        if (Application::isGuest()) {
            Application::$app->session->setFlash('warning', 'You need To Login first');
            Application::$app->response->redirect('/auth/login');
        }

        $itemModel = new Item;

        $items = new Collection($itemModel->getAll());

        return $this->render('items/index', [
            'title' => 'Items Dashboard',
            'items' => $items
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

        $itemsModel = new Item;
        $catergoryModel = new ItemCatergory;

        if ($request->getMethod() === 'post') {
            $itemsModel->loadData($request->getBody());

            $itemsModel->available = 0;

            $catergory = $catergoryModel->findOne(['title' => $request->getBody()['catergory']]);
            $itemsModel->catergory_id = $catergory->id;

            $img_src = new File($request->getFiles('img_src'));
            $itemsModel->img_src = $img_src->getProp('name');

            // var_dump($itemsModel);exit();

            if (move_uploaded_file($img_src->getProp('tmp_name'), './img/' . $img_src->getProp('name'))) {
                if ($itemsModel->validate() && $itemsModel->save()) {

                    Application::$app->session->setFlash('success', 'New catergory created');
                    Application::$app->response->redirect('/items');
                    return 'Show success page';
                }
            } else {
                echo 'falure';
            }
        }

        $catergoriesModel = new ItemCatergory;
        $catergories = new Collection($catergoriesModel->getAll());


        return $this->render('items/new', [
            'title' => 'Creatae new item',
            'model' => $itemsModel,
            'catergories' => $catergories
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

        $itemsModel = new Item;
        // FIXME:HY000 - SQLSTATE[HY000]: General error: could not call class constructor 
        $itemsModel->loadData(
            $itemsModel->findAll(
                ['id' => $request->getRouteParam('id')]
            )[0]
        );
        if ($request->getMethod() === 'post') {
            $itemsModel->loadData($request->getBody());

            if (isset($request->getBody()['available'])) {
                $itemsModel->available = 1;
                var_dump($itemsModel);
            }

        $catergoryModel = new ItemCatergory;

                $catergory = $catergoryModel->findOne(['title' => $request->getBody()['catergory']]);
                $itemsModel->catergory_id = $catergory->id;

                $img_src = new File($request->getFiles('img_src'));
                if($img_src != $itemsModel->img_src){
                $itemsModel->img_src = $img_src->getProp('name');
                if(move_uploaded_file($img_src->getProp('tmp_name'), './img/'.$img_src->getProp('name'))){
                echo 'falure';
                }
                }

            //     // var_dump($itemsModel);exit();

               
                if ($itemsModel->validate() && $itemsModel->save()) {

                    Application::$app->session->setFlash('success', 'New catergory created');
                    Application::$app->response->redirect('/items');
                    return 'Show success page';
                }

            if ($item->validate() && $item->update($item->id)) {

                Application::$app->session->setFlash('success', 'New catergory created');
                Application::$app->response->redirect('/items');
                return 'Show success page';
            }
        }
        $catergoriesModel = new ItemCatergory;
        $catergories = new Collection($catergoriesModel->getAll());

        return $this->render('items/edit', [
            'title' => 'Catergories Dashboard',
            'item' => $itemsModel,
            'catergories' => $catergories,
            'model' => $itemsModel
        ]);
    }

    // /**
    //  * delete a new catergory
    //  * 
    //  * @param Request
    //  * @return string
    //  */
    // public function delete(Request $request)
    // {

    //     if (Application::isGuest()) {
    //         Application::$app->session->setFlash('warning', 'You need To Login first');
    //         Application::$app->response->redirect('/auth/login');
    //     }

    //     $catergoriesModel = new ItemCatergory;
    //     $catergory = $catergoriesModel->findOne(['id' => $request->getRouteParam('id')]);

    //     if ($request->getMethod() === 'post') {

    //         if ($catergory->delete($catergory->id)) {

    //             Application::$app->session->setFlash('success', 'catergory deleted');
    //             Application::$app->response->redirect('/catergories');
    //             return 'Show success page';
    //         }
    //     }

    //     $catergories = new Collection($catergoriesModel->getAll());

    //     return $this->render('catergories/index', [
    //         'title' => 'Catergories Dashboard',
    //         'catergories' => $catergories
    //     ]);
    // }
}
