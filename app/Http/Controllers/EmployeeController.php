<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Customer;
use App\Models\Followup;
use App\Models\Lead;
use App\Models\Product;
use App\Models\Billing;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Hash;

class EmployeeController extends Controller
{
    public function index()
    {
        $today = Carbon::now()->format('Y-m-d');
        $data = Employee::where('soft_delete', '!=', 1)->orderBy('id', 'DESC')->get();

        return view('page.backend.employee.index', compact('data', 'today'));
    }


    public function store(Request $request)
    {
        $randomkey = Str::random(5);

        $data = new Employee();

        $data->unique_key = $randomkey;
        $data->name = $request->get('name');
        $data->phonenumber = $request->get('phonenumber');
        $data->alter_phonenumber = $request->get('alter_phonenumber');
        $data->email_id = $request->get('email_id');
        $data->address = $request->get('address');
        $data->role = $request->get('role');
        $data->password = $request->get('password');

        $data->save();
        
        $password = $request->get('password');
        $hashedPassword = Hash::make($password);

        $Userdata = new User();
        $Userdata->name = $request->get('name');
        $Userdata->email = $request->get('email_id');
        $Userdata->emp_id = $data->id;
        $Userdata->role = $request->get('role');
        $Userdata->password = $hashedPassword;
        $Userdata->save();

        return redirect()->route('employee.index')->with('message', 'Added !');
    }


    public function edit(Request $request, $unique_key)
    {
        $EmployeeData = Employee::where('unique_key', '=', $unique_key)->first();

        $EmployeeData->name = $request->get('name');
        $EmployeeData->phonenumber = $request->get('phonenumber');
        $EmployeeData->alter_phonenumber = $request->get('alter_phonenumber');
        $EmployeeData->email_id = $request->get('email_id');
        $EmployeeData->address = $request->get('address');
        $EmployeeData->update();

        return redirect()->route('employee.index')->with('info', 'Updated !');
    }


    public function view($id)
    {
        $EmployeeData = Employee::findOrFail($id);
        $today = Carbon::now()->format('Y-m-d');

        $currentYear = date("Y");

        $from_date = '01 Jan '. $currentYear;
        $to_date = '31 Dec ' . $currentYear;

        $fromdate = $currentYear . '-01-01';
        $todate = $currentYear . '-12-31';

        $customers = [];

        $handled_customer = Followup::whereBetween('date', [$fromdate, $todate])->where('soft_delete', '!=', 1)->where('employee_id', '=', $id)->get();
        foreach ($handled_customer as $key => $handled_customers) {
            $customers[] = $handled_customers->customer_id;
        }
        $customerscount = array_unique($customers);
        $total_customer = count(collect($customerscount));
        

        $handled_lead = Lead::whereBetween('date', [$fromdate, $todate])->where('soft_delete', '!=', 1)->where('employee_id', '=', $id)->get();
        $total_lead = count(collect($handled_lead));


        $handled_leadtocustomer = Lead::whereBetween('moved_date', [$fromdate, $todate])->where('soft_delete', '!=', 1)->where('employee_id', '=', $id)->where('status', '=', 1)->get();
        $total_handled_leadtocustomer = count(collect($handled_leadtocustomer));



// Handled customer array

        $handled_followupdata = Followup::whereBetween('date', [$fromdate, $todate])->where('soft_delete', '!=', 1)->where('employee_id', '=', $id)->get();
        $followupdata = [];
        foreach ($handled_followupdata as $key => $handled_followupdatas) {
            $customer = Customer::findOrFail($handled_followupdatas->customer_id);
            $product = Product::findOrFail($handled_followupdatas->product_id);

            $Billingdate = Billing::where('customer_id', '=', $handled_followupdatas->customer_id)->where('product_id', '=', $handled_followupdatas->product_id)->first();

            $followupdata[] = array(
                'customer' => $customer->name,
                'product' => $product->name,
                'date' => $handled_followupdatas->date,
                'description' => $handled_followupdatas->description,
                'starting_date' => $Billingdate->starting_date,
                'ending_date' => $Billingdate->ending_date,
            );
        }

        usort($followupdata, function($a1, $a2) {
            $value1 = strtotime($a1['date']);
            $value2 = strtotime($a2['date']);
            return ($value1 < $value2) ? 1 : -1;
         });


// Handled Lead Array

        $handled_leaddata = Lead::whereBetween('date', [$fromdate, $todate])->where('soft_delete', '!=', 1)->where('employee_id', '=', $id)->get();
        $Lead_data = [];
        foreach ($handled_leaddata as $key => $handled_leaddatas) {

            $Lead_data[] = array(
                'name' => $handled_leaddatas->name,
                'phonenumber' => $handled_leaddatas->phonenumber,
                'source_from' => $handled_leaddatas->source_from,
                'date' => $handled_leaddatas->date,
            );
        }
        usort($Lead_data, function($a1, $a2) {
            $value1 = strtotime($a1['date']);
            $value2 = strtotime($a2['date']);
            return ($value1 < $value2) ? 1 : -1;
         });


// Handled Leadto Customer Array

        $handled_leadtocustomerdata = Lead::whereBetween('moved_date', [$fromdate, $todate])->where('soft_delete', '!=', 1)->where('status', '=', 1)->where('employee_id', '=', $id)->get();
        $Leadtocustomer_data = [];
        foreach ($handled_leadtocustomerdata as $key => $handled_leadtocustomerdatas) {

            $leadcustomer = Customer::where('lead_id', '=', $handled_leadtocustomerdatas->id)->first();
            $BILLING = Billing::where('customer_id', '=', $leadcustomer->id)->first();

            if($BILLING != ""){
                $product = Product::findOrFail($BILLING->product_id);
                $productname = $product->name;
                $starting_Date = date('d M Y', strtotime($BILLING->starting_date));
                $ending_Date = date('d M Y', strtotime($BILLING->ending_date));
                
            }else {
                $productname = '';
                $starting_Date = '';
                $ending_Date = '';
            }

            $Leadtocustomer_data[] = array(
                'name' => $handled_leadtocustomerdatas->name,
                'phonenumber' => $handled_leadtocustomerdatas->phonenumber,
                'source_from' => $handled_leadtocustomerdatas->source_from,
                'moved_date' => $handled_leadtocustomerdatas->moved_date,
                'productname' => $productname,
                'starting_Date' => $starting_Date,
                'ending_Date' => $ending_Date,
            );
        }
        usort($Leadtocustomer_data, function($a1, $a2) {
            $value1 = strtotime($a1['moved_date']);
            $value2 = strtotime($a2['moved_date']);
            return ($value1 < $value2) ? 1 : -1;
         });


        return view('page.backend.employee.view', compact('EmployeeData', 'today', 'from_date', 'to_date', 'total_customer', 'total_lead', 'total_handled_leadtocustomer', 'followupdata', 'Lead_data', 'Leadtocustomer_data'));
    }


    public function datefilter(Request $request) {
        $fromdate = $request->get('from_date');
        $todate = $request->get('to_date');

        $employee_id = $request->get('employee_id');
        $EmployeeData = Employee::findOrFail($employee_id);

        $today = Carbon::now()->format('Y-m-d');

        $from_date = date('d M Y', strtotime($fromdate));
        $to_date = date('d M Y', strtotime($todate));


        $customers = [];

        $handled_customer = Followup::whereBetween('date', [$fromdate, $todate])->where('soft_delete', '!=', 1)->where('employee_id', '=', $employee_id)->get();
        foreach ($handled_customer as $key => $handled_customers) {
            $customers[] = $handled_customers->customer_id;
        }
        $customerscount = array_unique($customers);
        $total_customer = count(collect($customerscount));
        

        $handled_lead = Lead::whereBetween('date', [$fromdate, $todate])->where('soft_delete', '!=', 1)->where('employee_id', '=', $employee_id)->get();
        $total_lead = count(collect($handled_lead));


        $handled_leadtocustomer = Lead::whereBetween('moved_date', [$fromdate, $todate])->where('soft_delete', '!=', 1)->where('employee_id', '=', $employee_id)->where('status', '=', 1)->get();
        $total_handled_leadtocustomer = count(collect($handled_leadtocustomer));



// Handled customer array

        $handled_followupdata = Followup::whereBetween('date', [$fromdate, $todate])->where('soft_delete', '!=', 1)->where('employee_id', '=', $employee_id)->get();
        $followupdata = [];
        foreach ($handled_followupdata as $key => $handled_followupdatas) {
            $customer = Customer::findOrFail($handled_followupdatas->customer_id);
            $product = Product::findOrFail($handled_followupdatas->product_id);

            $Billingdate = Billing::where('customer_id', '=', $handled_followupdatas->customer_id)->where('product_id', '=', $handled_followupdatas->product_id)->first();

            $followupdata[] = array(
                'customer' => $customer->name,
                'product' => $product->name,
                'date' => $handled_followupdatas->date,
                'description' => $handled_followupdatas->description,
                'starting_date' => $Billingdate->starting_date,
                'ending_date' => $Billingdate->ending_date,
            );
        }

        usort($followupdata, function($a1, $a2) {
            $value1 = strtotime($a1['date']);
            $value2 = strtotime($a2['date']);
            return ($value1 < $value2) ? 1 : -1;
         });


// Handled Lead Array

        $handled_leaddata = Lead::whereBetween('date', [$fromdate, $todate])->where('soft_delete', '!=', 1)->where('employee_id', '=', $employee_id)->get();
        $Lead_data = [];
        foreach ($handled_leaddata as $key => $handled_leaddatas) {

            $Lead_data[] = array(
                'name' => $handled_leaddatas->name,
                'phonenumber' => $handled_leaddatas->phonenumber,
                'source_from' => $handled_leaddatas->source_from,
                'date' => $handled_leaddatas->date,
            );
        }
        usort($Lead_data, function($a1, $a2) {
            $value1 = strtotime($a1['date']);
            $value2 = strtotime($a2['date']);
            return ($value1 < $value2) ? 1 : -1;
         });


// Handled Leadto Customer Array

        $handled_leadtocustomerdata = Lead::whereBetween('moved_date', [$fromdate, $todate])->where('soft_delete', '!=', 1)->where('status', '=', 1)->where('employee_id', '=', $employee_id)->get();
        $Leadtocustomer_data = [];
        foreach ($handled_leadtocustomerdata as $key => $handled_leadtocustomerdatas) {

            $leadcustomer = Customer::where('lead_id', '=', $handled_leadtocustomerdatas->id)->first();
            $BILLING = Billing::where('customer_id', '=', $leadcustomer->id)->first();

            if($BILLING != ""){
                $product = Product::findOrFail($BILLING->product_id);
                $productname = $product->name;
                $starting_Date = date('d M Y', strtotime($BILLING->starting_date));
                $ending_Date = date('d M Y', strtotime($BILLING->ending_date));
                
            }else {
                $productname = '';
                $starting_Date = '';
                $ending_Date = '';
            }

            $Leadtocustomer_data[] = array(
                'name' => $handled_leadtocustomerdatas->name,
                'phonenumber' => $handled_leadtocustomerdatas->phonenumber,
                'source_from' => $handled_leadtocustomerdatas->source_from,
                'moved_date' => $handled_leadtocustomerdatas->moved_date,
                'productname' => $productname,
                'starting_Date' => $starting_Date,
                'ending_Date' => $ending_Date,
            );
        }
        usort($Leadtocustomer_data, function($a1, $a2) {
            $value1 = strtotime($a1['moved_date']);
            $value2 = strtotime($a2['moved_date']);
            return ($value1 < $value2) ? 1 : -1;
         });


        return view('page.backend.employee.view', compact('EmployeeData', 'today', 'from_date', 'to_date', 'total_customer', 'total_lead', 'total_handled_leadtocustomer', 'followupdata', 'Lead_data', 'Leadtocustomer_data'));

    }



    public function delete($unique_key)
    {
        $data = Employee::where('unique_key', '=', $unique_key)->first();

        $data->soft_delete = 1;

        $data->update();

        return redirect()->route('employee.index')->with('warning', 'Deleted !');
    }


    public function checkduplicate(Request $request)
    {
        if(request()->get('query'))
        {
            $query = request()->get('query');
            $customerdata = Customer::where('phonenumber', '=', $query)->first();

            $userData['data'] = $customerdata;
            echo json_encode($userData);
        }
    }
}
