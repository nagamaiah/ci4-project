<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductModel;

class ProductController extends BaseController
{
    public function __construct()
    {

    }

    public function cart()
    {
        $productModel = new ProductModel();
        $data['products'] = $productModel->findAll();
        return view('cart', $data);
    }

    public function create()
    {
        return view('create');
    }

    public function show($id)
    {
        $productModel = new ProductModel();
        $data['product'] = $productModel->find($id);
        return view('show', $data);
    }

    public function store()
    {
        if ($this->request->is('post')) {

            $rules = [
                'product-name' => 'required|max_length[30]',
                'category' => 'required|max_length[30]',
                'image' => 'uploaded[image]|max_size[image,1024]|is_image[image]',
                'price' => 'required',
                'discription' => 'required'
            ];

            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }

            $taxable = $this->request->getPost('taxable');
            $deliveryCharge = $this->request->getPost('delivery-charge');
            $discount = $this->request->getPost('discount');
            $image = $this->request->getFile('image');
            $newImgName = $image->getRandomName();

            if ($image->move(ROOTPATH . 'public/images', $newImgName)) {
                $data = [
                    'product-name' => $this->request->getPost('product-name'),
                    'price' => $this->request->getPost('price'),
                    'category' => $this->request->getPost('category'),
                    'discription' => $this->request->getPost('discription'),
                    'image' => $newImgName,
                    'taxable' => isset($taxable) ? 1 : 0,
                    'delivery-charge' => isset($deliveryCharge) ? 1 : 0,
                    'discount' => isset($discount) ? 1 : 0
                ];

                $productModel = new ProductModel();
                $productModel->save($data);

                return redirect()->to(base_url('cart'))->with('success', 'Product added successfully');
            } else {
                return redirect()->back()->with('error', 'File upload failed.');
            }
        }

    }
}
