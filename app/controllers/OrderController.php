<?php

namespace kingstonenterprises\app\controllers;

use kingston\icarus\helpers\Collection;
use kingston\icarus\helpers\File;
use kingston\icarus\Application;
use kingston\icarus\Controller;
use kingston\icarus\Request;
use kingstonenterprises\app\models\Order;
use kingstonenterprises\app\models\OrderItem;
use kingstonenterprises\app\models\Item;
use kingstonenterprises\app\models\ItemCatergory;

class OrderController extends Controller
{

    public function index()
    {

        if (Application::isGuest()) {
            Application::$app->session->setFlash('warning', 'You need To Login first');
            Application::$app->response->redirect('/auth/login');
        }

        $orderModel = new Order;
        $itemsModel = new Item;
        $orderItemModel = new OrderItem;
        $orderItems = 0;

        $orders = $orderModel->findAll(['user_id' => Application::$app->session->get('user')]);

        $orders = new Collection($orders);
        if(!empty($orders)){
            foreach ($orders->getIterator() as $order) {

                $orderItems = new Collection($orderItemModel->findAll(['user_id' => Application::$app->session->get('user')]));
                
                $order->total = 0;
                foreach ($orderItems->getIterator() as $orderItem) {
                    if ($order->id == $orderItem->order_id) {
                        $orderItem->item = $itemsModel->findOne(['id' => $orderItem->item_id]);
                        $order->total += $orderItem->item->price;
                    }
                }
    
            }
        }
        

        return $this->render('orders/index', [
            'title' => 'Your Cart',
            'orders' => $orders,
            'orderItems' => $orderItems
        ]);
    }

    public function insert(Request $request)
    {

        if (Application::isGuest()) {
            Application::$app->session->setFlash('warning', 'You need To Login first');
            Application::$app->response->redirect('/auth/login');
        }

        $itemsModel = new Item;
        $orderModel = new Order;
        $orderItem = new OrderItem;

        if ($request->getMethod() === 'post') {
            $item = $itemsModel->findOne(['id' => $request->getRouteParam('id')]);
            $order = $orderModel->findOne(['user_id' => Application::$app->session->get('user')]);
            if (!$order) {
                $order = $orderModel;
                $order->user_id = Application::$app->session->get('user');
                $order->date_created =  date("Y-m-d H:i:s");
                $order->save();
            } 

                $orderItem->item_id = $item->id;
                $orderItem->order_id = $order->id;
                $orderItem->user_id = Application::$app->session->get('user');
                $orderItem->date_added =  date("Y-m-d H:i:s");

                $orderItem->save();
            
        }

        $orders = $orderModel->findAll(['user_id' => Application::$app->session->get('user')]);
        $orders = new Collection($orders);
        $orderItemModel = new OrderItem;
        $orderItems = new Collection($orderItemModel->findAll(['user_id' => Application::$app->session->get('user')]));
        foreach ($orderItems->getIterator() as $orderItem) {
            $orderItem->item = $itemsModel->findOne(['id' => $orderItem->item_id]);
        }

        Application::$app->response->redirect('/orders');

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
        $orderModel = new Order;
        $orderItemModel = new OrderItem;

        $item = $orderItemModel->findOne(['item_id' => $request->getRouteParam('id')]);
        $cart = $orderModel->findOne(['user_id' => Application::$app->session->get('user')]);

    

            if ($item->delete($item->id)) {

                Application::$app->session->setFlash('success', 'catergory deleted');
                Application::$app->response->redirect('/');
                return 'Show success page';
            }

        return $this->render('orders/index', [
            'title' => 'Orders Dashboard'
        ]);
    }
}
