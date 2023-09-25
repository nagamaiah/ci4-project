<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\OrderModel;

class OrderController extends BaseController
{
    public function index()
    {
        $orderModel = new OrderModel();
        $data['orders'] = $orderModel->findAll();
        return view('order', $data);
    }

    public function store()
    {
        if ($this->request->isAJAX()) {
            $session = session();
            $orders = $this->request->getPost('data');
            $db = \Config\Database::connect();
            $builder = $db->table('orders');
            $builder->insertBatch($orders);
            $session->setFlashdata('success', 'Order placed successfully');
            return $this->response->setJSON(["success" => true]);
        }
    }
}
