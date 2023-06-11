<?php

namespace kingstonenterprises\app\controllers;

use kingston\icarus\helpers\Collection;
use kingston\icarus\helpers\File;
use kingston\icarus\Application;
use kingston\icarus\Controller;
use kingston\icarus\Request;
use kingstonenterprises\app\models\Cart;
use kingstonenterprises\app\models\CartItem;
use kingstonenterprises\app\models\Item;
use kingstonenterprises\app\models\ItemCatergory;

class CartController extends Controller
{

    public function index()
    {

        if (Application::isGuest()) {
            Application::$app->session->setFlash('warning', 'You need To Login first');
            Application::$app->response->redirect('/auth/login');
        }

        $cartModel = new Cart;
        $itemsModel = new Item;

        $total = 0;

        $carts = $cartModel->findAll(['user_id' => Application::$app->session->get('user')]);
        $carts = new Collection($carts);

        foreach ($carts->getIterator() as $key => $cart) {

            $cartItemModel = new CartItem;
            $cartItems = new Collection($cartItemModel->findAll(['user_id' => Application::$app->session->get('user')]));
            $cart->total = 0;
            foreach ($cartItems->getIterator() as $key => $cartItem) {
                if ($cart->id == $cartItem->cart_id) {
                    $cartItem->item = $itemsModel->findOne(['id' => $cartItem->item_id]);
                    $cart->total += $cartItem->item->price;
                }
            }
            // \var_dump($cart->total);exit();
        }

        return $this->render('cart/index', [
            'title' => 'Your Cart',
            'carts' => $carts,
            'cartItems' => $cartItems
        ]);
    }

    public function insert(Request $request)
    {

        if (Application::isGuest()) {
            Application::$app->session->setFlash('warning', 'You need To Login first');
            Application::$app->response->redirect('/auth/login');
        }

        $itemsModel = new Item;
        $catergoryModel = new ItemCatergory;
        $cartModel = new Cart;

        if ($request->getMethod() === 'post') {
            $item = $itemsModel->findOne(['id' => $request->getRouteParam('id')]);
            $cart = $cartModel->findOne(['user_id' => Application::$app->session->get('user')]);

            if (!$cart) {
                $cart = $cartModel;
                $cart->user_id = Application::$app->session->get('user');
                $cart->date_created =  date("Y-m-d H:i:s");
                $cart->save();
            } else {
                $cartItem = new CartItem;
                $cartItem->item_id = $item->id;
                $cartItem->cart_id = $cart->id;
                $cartItem->user_id = Application::$app->session->get('user');
                $cartItem->date_added =  date("Y-m-d H:i:s");
                $cartItem->save();
            }
        }

        $carts = $cartModel->findAll(['user_id' => Application::$app->session->get('user')]);
        $carts = new Collection($carts);

        $cartItemModel = new CartItem;
        $cartItems = new Collection($cartItemModel->findAll(['user_id' => Application::$app->session->get('user')]));
        foreach ($cartItems->getIterator() as $key => $cartItem) {
            $cartItem->item = $itemsModel->findOne(['id' => $cartItem->item_id]);
        }

        return $this->render('cart/index', [
            'title' => 'Your Cart',
            'carts' => $carts,
            'cartItems' => $cartItems
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
            } else {
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

        $itemsModel = new Item;
        $cartModel = new Cart;
        $cartItemModel = new CartItem;

        $item = $cartItemModel->findOne(['item_id' => $request->getRouteParam('id')]);
        $cart = $cartModel->findOne(['user_id' => Application::$app->session->get('user')]);

        \var_dump($item->delete($item->id));
        exit();



        return $this->render('items/index', [
            'title' => 'Items Dashboard'
        ]);
    }
}
