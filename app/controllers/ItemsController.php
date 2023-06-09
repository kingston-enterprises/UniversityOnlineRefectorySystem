<?php

namespace kingstonenterprises\app\controllers;

use kingston\icarus\helpers\Collection;
use kingston\icarus\helpers\File;
use kingston\icarus\Application;
use kingston\icarus\Controller;
use kingston\icarus\Request;
use kingstonenterprises\app\models\Item;
use kingstonenterprises\app\models\ItemCatergory;

class ItemsController extends Controller
{

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

    public function create(Request $request)
    {

        if (Application::isGuest()) {
            Application::$app->session->setFlash('warning', 'You need To Login first');
            Application::$app->response->redirect('/auth/login');
        }

        $itemsModel = new Item;
        $catergoryModel = new ItemCatergory;

        if ($request->getMethod() === 'post') {
            // \var_dump($_FILES);exit();
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

            if (isset($request->getBody()['availability'])) {
                $itemsModel->available = 1;
            }else {
                $itemsModel->available = 0;

            }
                // var_dump($itemsModel->available);exit();


            $catergoryModel = new ItemCatergory;

            $catergory = $catergoryModel->findOne(['title' => $request->getBody()['catergory']]);
            $itemsModel->catergory_id = $catergory->id;

            $img_src = new File($request->getFiles('img_src'));

            if (!empty($img_src->name) && $img_src->name != $itemsModel->img_src) {
                $itemsModel->img_src = $img_src->getProp('name');
                if (move_uploaded_file($img_src->getProp('tmp_name'), './img/' . $img_src->getProp('name'))) {
                    echo 'falure';
                }
            } 



            if ($itemsModel->update($itemsModel->id)) {

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
        
        $itemsModel = new Item;
        // FIXME:HY000 - SQLSTATE[HY000]: General error: could not call class constructor 
        $itemsModel->loadData(
            $itemsModel->findAll(
                ['id' => $request->getRouteParam('id')]
            )[0]
        );

        if ($request->getMethod() === 'post') {

            if ($itemsModel->delete($itemsModel->id)) {

                Application::$app->session->setFlash('success', 'item deleted');
                Application::$app->response->redirect('/items');
                return 'Show success page';
            }
        }

        $itemModel = new Item;

        $items = new Collection($itemModel->getAll());

        return $this->render('items/index', [
            'title' => 'Items Dashboard',
            'items' => $items
        ]);
    }
}
