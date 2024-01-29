<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Billing;
use App\Models\Customer;
use App\Models\Employee;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class ProductController extends Controller
{
    public function index()
    {
        $today = Carbon::now()->format('Y-m-d');

        $data = Product::where('soft_delete', '!=', 1)->orderBy('id', 'DESC')->get();
        $product_data = [];
        foreach ($data as $key => $datas) {

            $total_products = Billing::where('soft_delete', '!=', 1)->where('product_id', '=', $datas->id)->get();
            $total_products_count = count(collect($total_products));

            $product_data[] = array(
                'unique_key' => $datas->unique_key,
                'name' => $datas->name,
                'description' => $datas->description,
                'image' => $datas->image,
                'id' => $datas->id,
                'total_products_count' => $total_products_count
            );
        }

        return view('page.backend.product.index', compact('product_data', 'today'));
    }

    public function store(Request $request)
    {
        $randomkey = Str::random(5);

        $data = new Product();
        $random_no =  rand(100,999);

        $data->unique_key = $randomkey;
        $data->name = $request->get('name');
        $data->description = $request->get('description');


        $product_image = $request->product_image;
        $filename_photo = $data->name . '_' . $random_no . '_' . 'Photo' . '.' . $product_image->getClientOriginalExtension();
        $request->product_image->move('assets/product_image', $filename_photo);
        $data->image = $filename_photo;
        $data->save();

        return redirect()->route('product.index')->with('message', 'Added !');
    }


    public function edit(Request $request, $unique_key)
    {
        $ProductData = Product::where('unique_key', '=', $unique_key)->first();

        $random_no =  rand(100,999);

        $ProductData->name = $request->get('name');
        $ProductData->description = $request->get('description');

        if ($request->file('product_image') != "") {
            $product_image = $request->product_image;
            $filename_photo = $ProductData->name . '_' . $random_no . '_' . 'Photo' . '.' . $product_image->getClientOriginalExtension();
            $request->product_image->move('assets/product_image', $filename_photo);
            $ProductData->image = $filename_photo;
         } else {
            $Insertedproof_photo = $ProductData->image;
            $ProductData->image = $Insertedproof_photo;
         }


        $ProductData->update();

        return redirect()->route('product.index')->with('info', 'Updated !');
    }



    public function delete($unique_key)
    {
        $data = Product::where('unique_key', '=', $unique_key)->first();

        $data->soft_delete = 1;

        $data->update();

        return redirect()->route('product.index')->with('warning', 'Deleted !');
    }


    public function view($id)
    {
        $total_products = Billing::where('soft_delete', '!=', 1)->where('product_id', '=', $id)->get();
        $customer_list = [];
        foreach ($total_products as $key => $total_product) {

            $product = Product::findOrFail($total_product->product_id);
            $customer = Customer::findOrFail($total_product->customer_id);
            $employee = Employee::findOrFail($total_product->employee_id);

            $customer_list[] = array(
                'customer' => $customer->name,
                'product' => $product->name,
                'date' => $total_product->date,
                'starting_date' => $total_product->starting_date,
                'ending_date' => $total_product->ending_date,
                'employee' => $employee->name
            );
        }

        $Getproduct = Product::findOrFail($id);
        $productcount = Billing::where('soft_delete', '!=', 1)->where('product_id', '=', $id)->get();
            $productcounts = count(collect($productcount));

        return view('page.backend.product.view', compact('customer_list', 'Getproduct', 'productcounts'));
    }


    public function getproductusedCustomers()
    {
        $followupcustomer_id = request()->get('followupcustomer_id');
        $followupemployee_id = request()->get('followupemployee_id');

        $GetProduct = Billing::where('employee_id', '=', $followupemployee_id)->where('customer_id', '=', $followupcustomer_id)->where('soft_delete', '!=', 1)->get();
        $product_lists = [];
        foreach ($GetProduct as $key => $GetProducts) {

            $products = Product::findOrFail($GetProducts->product_id);

            $product_lists[] = array(
                'name' => $products->name,
                'id' => $GetProducts->product_id,
            );
        }
        $userData['data'] = $product_lists;
        echo json_encode($userData);
    }
}
