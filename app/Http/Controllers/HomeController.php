<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Billing;
use App\Models\Lead;
use App\Models\Followup;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $today = Carbon::now()->format('Y-m-d');

        $Employee = Employee::where('soft_delete', '!=', 1)->get();
        $total_Employee = count(collect($Employee));

        

        if(Auth::user()->role == 'Admin')
        {
            $Customer = Customer::where('soft_delete', '!=', 1)->where('employee_id', '=', Auth::user()->emp_id)->get();
            $total_Customer = count(collect($Customer));
        }else {
            $Customer = Customer::where('soft_delete', '!=', 1)->get();
            $total_Customer = count(collect($Customer));
        }

       
        
        

        $Product = Product::where('soft_delete', '!=', 1)->get();
        $total_Product = count(collect($Product));



        $data = Billing::where('soft_delete', '!=', 1)->where('date', '=', $today)->orderBy('id', 'DESC')->get();
        $Billingdata = [];
        foreach ($data as $key => $datas) {
            
            $customer = Customer::findOrFail($datas->customer_id);
            $product = Product::findOrFail($datas->product_id);
            $employee = Employee::findOrFail($datas->employee_id);

            $Billingdata[] = array(
                'unique_key' => $datas->unique_key,
                'customer_id' => $datas->customer_id,
                'customer' => $customer->name,
                'product_id' => $datas->product_id,
                'product' => $product->name,
                'date' => $datas->date,
                'employee_id' => $datas->employee_id,
                'employee' => $employee->name,
                'starting_date' => $datas->starting_date,
                'ending_date' => $datas->ending_date,
                'remainder_date' => $datas->remainder_date,
                'id' => $datas->id
            );
        }


        $followuyp = Followup::where('soft_delete', '!=', 1)->where('next_call_date', '=', $today)->where('status', '=', 0)->orderBy('id', 'DESC')->get();
        $followupdata = [];
        foreach ($followuyp as $key => $followuyps) {
            
            $followupemployee = Employee::findOrFail($followuyps->employee_id);
            $product = Product::findOrFail($followuyps->product_id);

            if($followuyps->customer_id != ""){
                $customer = Customer::findOrFail($followuyps->customer_id);
                $customername = $customer->name;
                $customer_id = $followuyps->customer_id;
                $customer_phonenumber = $customer->phonenumber;
            }else {
                $customername = '';
                $customer_id = '';
                $customer_phonenumber = '';
            }


            if($followuyps->lead_id != ""){
                $lead = Lead::findOrFail($followuyps->lead_id);
                $leadname = $lead->name;
                $lead_id = $followuyps->lead_id;
                $lead_phonenumber = $lead->phonenumber;
            }else {
                $leadname = '';
                $lead_id = '';
                $lead_phonenumber = '';
            }

            $followupdata[] = array(
                'unique_key' => $followuyps->unique_key,
                'customer_id' => $customer_id,
                'customer' => $customername,
                'lead_id' => $lead_id,
                'leadname' => $leadname,
                'customer_phonenumber' => $customer_phonenumber,
                'lead_phonenumber' => $lead_phonenumber,
                'date' => $followuyps->date,
                'employee_id' => $followuyps->employee_id,
                'product' => $product->name,
                'product_id' => $followuyps->product_id,
                'employee' => $followupemployee->name,
                'time' => $followuyps->time,
                'description' => $followuyps->description,
                'next_call_date' => $followuyps->next_call_date,
                'id' => $followuyps->id
            );
        }



        $currentdate = Carbon::now()->format('Y-m-d');
        $timenow = Carbon::now()->format('H:i');
        $employee = Employee::where('soft_delete', '!=', 1)->get();
        $customer = Customer::where('soft_delete', '!=', 1)->get();
        $product = Product::where('soft_delete', '!=', 1)->get();
        $lead = Lead::where('soft_delete', '!=', 1)->get();
            return view('home', compact('today', 'total_Employee', 'total_Customer', 'total_Product', 'Billingdata', 'followupdata', 'currentdate', 'employee', 'customer', 'product', 'timenow', 'lead'));
    }



    public function datefilter(Request $request) {

        $today = $request->get('from_date');

        

        $Employee = Employee::where('soft_delete', '!=', 1)->get();
        $total_Employee = count(collect($Employee));

        if(Auth::user()->role == 'Admin')
        {
            $Customer = Customer::where('soft_delete', '!=', 1)->where('employee_id', '=', Auth::user()->emp_id)->get();
            $total_Customer = count(collect($Customer));
        }else {
            $Customer = Customer::where('soft_delete', '!=', 1)->get();
            $total_Customer = count(collect($Customer));
        }


        $Product = Product::where('soft_delete', '!=', 1)->get();
        $total_Product = count(collect($Product));



        $data = Billing::where('soft_delete', '!=', 1)->where('date', '=', $today)->orderBy('id', 'DESC')->get();
        $Billingdata = [];
        foreach ($data as $key => $datas) {
            
            $customer = Customer::findOrFail($datas->customer_id);
            $product = Product::findOrFail($datas->product_id);
            $employee = Employee::findOrFail($datas->employee_id);

            $Billingdata[] = array(
                'unique_key' => $datas->unique_key,
                'customer_id' => $datas->customer_id,
                'customer' => $customer->name,
                'product_id' => $datas->product_id,
                'product' => $product->name,
                'date' => $datas->date,
                'employee_id' => $datas->employee_id,
                'employee' => $employee->name,
                'starting_date' => $datas->starting_date,
                'ending_date' => $datas->ending_date,
                'remainder_date' => $datas->remainder_date,
                'id' => $datas->id
            );
        }



        $followuyp = Followup::where('soft_delete', '!=', 1)->where('next_call_date', '=', $today)->where('status', '=', 0)->orderBy('id', 'DESC')->get();
        $followupdata = [];
        foreach ($followuyp as $key => $followuyps) {
            
            $followupemployee = Employee::findOrFail($followuyps->employee_id);
            $product = Product::findOrFail($followuyps->product_id);


            if($followuyps->customer_id != ""){
                $customer = Customer::findOrFail($followuyps->customer_id);
                $customername = $customer->name;
                $customer_id = $followuyps->customer_id;
                $customer_phonenumber = $customer->phonenumber;
            }else {
                $customername = '';
                $customer_id = '';
                $customer_phonenumber = '';
            }


            if($followuyps->lead_id != ""){
                $lead = Lead::findOrFail($followuyps->lead_id);
                $leadname = $lead->name;
                $lead_id = $followuyps->lead_id;
                $lead_phonenumber = $lead->phonenumber;
            }else {
                $leadname = '';
                $lead_id = '';
                $lead_phonenumber = '';
            }

            $followupdata[] = array(
                'unique_key' => $followuyps->unique_key,
                'customer_id' => $customer_id,
                'customer' => $customername,
                'lead_id' => $lead_id,
                'leadname' => $leadname,
                'customer_phonenumber' => $customer_phonenumber,
                'lead_phonenumber' => $lead_phonenumber,
                'date' => $followuyps->date,
                'employee_id' => $followuyps->employee_id,
                'product' => $product->name,
                'product_id' => $followuyps->product_id,
                'employee' => $followupemployee->name,
                'time' => $followuyps->time,
                'description' => $followuyps->description,
                'next_call_date' => $followuyps->next_call_date,
                'id' => $followuyps->id
            );
        }
        $currentdate = Carbon::now()->format('Y-m-d');
        $timenow = Carbon::now()->format('H:i');
        $employee = Employee::where('soft_delete', '!=', 1)->get();
        $customer = Customer::where('soft_delete', '!=', 1)->get();
        $product = Product::where('soft_delete', '!=', 1)->get();
        $lead = Lead::where('soft_delete', '!=', 1)->get();

            return view('home', compact('today', 'total_Employee', 'total_Customer', 'total_Product', 'Billingdata', 'followupdata', 'currentdate', 'employee', 'customer', 'product', 'timenow', 'lead'));
    }
}
