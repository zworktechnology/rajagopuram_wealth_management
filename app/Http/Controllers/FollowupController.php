<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Followup;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Lead;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class FollowupController extends Controller
{
    public function index()
    {
        $today = Carbon::now()->format('Y-m-d');
        $timenow = Carbon::now()->format('H:i');

        $customerdata = Followup::where('soft_delete', '!=', 1)->where('date', '=', $today)->where('customer_id', '!=', NULL)->orderBy('id', 'DESC')->get();
        $customerfollowupdata = [];
        foreach ($customerdata as $key => $datas) {
            
            
            $employee = Employee::findOrFail($datas->employee_id);
            $product = Product::findOrFail($datas->product_id);

            if($datas->customer_id != ""){
                $customer = Customer::findOrFail($datas->customer_id);
                $customername = $customer->name;
                $customer_id = $datas->customer_id;
                $customer_phonenumber = $customer->phonenumber;
            }else {
                $customername = '';
                $customer_id = '';
                $customer_phonenumber = '';
            }


            if($datas->lead_id != ""){
                $lead = Lead::findOrFail($datas->lead_id);
                $leadname = $lead->name;
                $lead_id = $datas->lead_id;
            }else {
                $leadname = '';
                $lead_id = '';
            }

            $customerfollowupdata[] = array(
                'unique_key' => $datas->unique_key,
                'customer_id' => $customer_id,
                'customer' => $customername,
                'lead_id' => $lead_id,
                'leadname' => $leadname,
                'date' => $datas->date,
                'employee_id' => $datas->employee_id,
                'product_id' => $datas->product_id,
                'product' => $product->name,
                'employee' => $employee->name,
                'time' => $datas->time,
                'description' => $datas->description,
                'next_call_date' => $datas->next_call_date,
                'id' => $datas->id
            );
        }

        $leaddata = Followup::where('soft_delete', '!=', 1)->where('date', '=', $today)->where('lead_id', '!=', NULL)->orderBy('id', 'DESC')->get();
        $leadfollowupdata = [];
        foreach ($leaddata as $key => $datas) {
            
            
            $employee = Employee::findOrFail($datas->employee_id);
            $product = Product::findOrFail($datas->product_id);

            if($datas->customer_id != ""){
                $customer = Customer::findOrFail($datas->customer_id);
                $customername = $customer->name;
                $customer_id = $datas->customer_id;
            }else {
                $customername = '';
                $customer_id = '';
            }


            if($datas->lead_id != ""){
                $lead = Lead::findOrFail($datas->lead_id);
                $leadname = $lead->name;
                $lead_id = $datas->lead_id;
            }else {
                $leadname = '';
                $lead_id = '';
            }

            $leadfollowupdata[] = array(
                'unique_key' => $datas->unique_key,
                'customer_id' => $customer_id,
                'customer' => $customername,
                'lead_id' => $lead_id,
                'leadname' => $leadname,
                'date' => $datas->date,
                'employee_id' => $datas->employee_id,
                'product_id' => $datas->product_id,
                'product' => $product->name,
                'employee' => $employee->name,
                'time' => $datas->time,
                'description' => $datas->description,
                'next_call_date' => $datas->next_call_date,
                'id' => $datas->id
            );
        }

        $employee = Employee::where('soft_delete', '!=', 1)->get();
        $customer = Customer::where('soft_delete', '!=', 1)->get();
        $product = Product::where('soft_delete', '!=', 1)->get();
        $lead = Lead::where('soft_delete', '!=', 1)->get();
        return view('page.backend.followup.index', compact('customerfollowupdata', 'today', 'employee', 'customer', 'timenow', 'product', 'lead', 'leadfollowupdata'));
    }




    public function datefilter(Request $request) {

        $today = $request->get('from_date');

        $timenow = Carbon::now()->format('H:i');
        $customerdata = Followup::where('soft_delete', '!=', 1)->where('date', '=', $today)->where('customer_id', '!=', NULL)->orderBy('id', 'DESC')->get();
        $customerfollowupdata = [];
        foreach ($customerdata as $key => $datas) {
            
            
            $employee = Employee::findOrFail($datas->employee_id);
            $product = Product::findOrFail($datas->product_id);

            if($datas->customer_id != ""){
                $customer = Customer::findOrFail($datas->customer_id);
                $customername = $customer->name;
                $customer_id = $datas->customer_id;
            }else {
                $customername = '';
                $customer_id = '';
            }


            if($datas->lead_id != ""){
                $lead = Lead::findOrFail($datas->lead_id);
                $leadname = $lead->name;
                $lead_id = $datas->lead_id;
            }else {
                $leadname = '';
                $lead_id = '';
            }

            $customerfollowupdata[] = array(
                'unique_key' => $datas->unique_key,
                'customer_id' => $customer_id,
                'customer' => $customername,
                'lead_id' => $lead_id,
                'leadname' => $leadname,
                'date' => $datas->date,
                'employee_id' => $datas->employee_id,
                'product_id' => $datas->product_id,
                'product' => $product->name,
                'employee' => $employee->name,
                'time' => $datas->time,
                'description' => $datas->description,
                'next_call_date' => $datas->next_call_date,
                'id' => $datas->id
            );
        }

        $leaddata = Followup::where('soft_delete', '!=', 1)->where('date', '=', $today)->where('lead_id', '!=', NULL)->orderBy('id', 'DESC')->get();
        $leadfollowupdata = [];
        foreach ($leaddata as $key => $datas) {
            
            
            $employee = Employee::findOrFail($datas->employee_id);
            $product = Product::findOrFail($datas->product_id);

            if($datas->customer_id != ""){
                $customer = Customer::findOrFail($datas->customer_id);
                $customername = $customer->name;
                $customer_id = $datas->customer_id;
            }else {
                $customername = '';
                $customer_id = '';
            }


            if($datas->lead_id != ""){
                $lead = Lead::findOrFail($datas->lead_id);
                $leadname = $lead->name;
                $lead_id = $datas->lead_id;
            }else {
                $leadname = '';
                $lead_id = '';
            }

            $leadfollowupdata[] = array(
                'unique_key' => $datas->unique_key,
                'customer_id' => $customer_id,
                'customer' => $customername,
                'lead_id' => $lead_id,
                'leadname' => $leadname,
                'date' => $datas->date,
                'employee_id' => $datas->employee_id,
                'product_id' => $datas->product_id,
                'product' => $product->name,
                'employee' => $employee->name,
                'time' => $datas->time,
                'description' => $datas->description,
                'next_call_date' => $datas->next_call_date,
                'id' => $datas->id
            );
        }

        $employee = Employee::where('soft_delete', '!=', 1)->get();
        $customer = Customer::where('soft_delete', '!=', 1)->get();
        $product = Product::where('soft_delete', '!=', 1)->get();
        $lead = Lead::where('soft_delete', '!=', 1)->get();
        return view('page.backend.followup.index', compact('customerfollowupdata', 'today', 'employee', 'customer', 'timenow', 'product', 'lead', 'leadfollowupdata'));

    }


    public function store(Request $request)
    {
        $randomkey = Str::random(5);

        $data = new Followup();

        $data->unique_key = $randomkey;
        $data->customer_id = $request->get('customer_id');
        $data->product_id = $request->get('product_id');
        $data->date = $request->get('date');
        $data->employee_id = $request->get('employee_id');
        $data->time = $request->get('time');
        $data->description = $request->get('description');
        $data->next_call_date = $request->get('next_call_date');
        $data->save();

      
        return redirect()->route('followup.index')->with('message', 'Added !');
    }


    public function leadfollowup_store(Request $request)
    {
        $randomkey = Str::random(5);

        $data = new Followup();

        $data->unique_key = $randomkey;
        $data->lead_id = $request->get('lead_id');
        $data->product_id = $request->get('product_id');
        $data->date = $request->get('date');
        $data->employee_id = $request->get('employee_id');
        $data->time = $request->get('time');
        $data->description = $request->get('description');
        $data->next_call_date = $request->get('next_call_date');
        $data->save();

      
        return redirect()->route('followup.index')->with('message', 'Added !');
    }


    public function edit(Request $request, $unique_key)
    {

        $FollowupData = Followup::where('unique_key', '=', $unique_key)->first();

        if($request->get('customer_id') != ""){
            $customer_id = $request->get('customer_id');
            $FollowupData->customer_id = $customer_id;
        }else if($request->get('lead_id') != ""){
            $lead_id = $request->get('lead_id');
            $FollowupData->lead_id = $lead_id;
        }
        
        $FollowupData->product_id = $request->get('product_id');
        $FollowupData->date = $request->get('date');
        $FollowupData->employee_id = $request->get('employee_id');
        $FollowupData->time = $request->get('time');
        $FollowupData->description = $request->get('description');
        $FollowupData->next_call_date = $request->get('next_call_date');
        $FollowupData->update();

        return redirect()->route('followup.index')->with('info', 'Updated !');
    }


    public function updatestatus(Request $request, $unique_key)
    {
        $FollowupDatas = Followup::where('unique_key', '=', $unique_key)->first();

        $FollowupDatas->status = 1;
        $FollowupDatas->update();


        $randomkey = Str::random(5);

        $data = new Followup();

        $data->unique_key = $randomkey;

        if($FollowupDatas->customer_id != ""){
            $customer_id = $FollowupDatas->customer_id;
            $data->customer_id = $customer_id;
        }else if($FollowupDatas->lead_id != ""){
            $lead_id = $FollowupDatas->lead_id;
            $data->lead_id = $lead_id;
        }


        $data->product_id = $FollowupDatas->product_id;
        $data->date = $request->get('date');
        $data->employee_id = $FollowupDatas->employee_id;
        $data->time = $request->get('time');
        $data->description = $request->get('description');
        $data->next_call_date = $request->get('next_call_date');
        $data->save();

        return redirect()->route('home')->with('info', 'Updated !');
    }


    public function leadupdatestatus(Request $request, $id)
    {
        $FollowupDatas = Followup::findOrFail($id);

        $FollowupDatas->status = 1;
        $FollowupDatas->update();


        $randomkey = Str::random(5);

        $data = new Followup();

        $data->unique_key = $randomkey;

        if($FollowupDatas->customer_id != ""){
            $customer_id = $FollowupDatas->customer_id;
            $data->customer_id = $customer_id;
        }else if($FollowupDatas->lead_id != ""){
            $lead_id = $FollowupDatas->lead_id;
            $data->lead_id = $lead_id;
        }


        $data->product_id = $request->get('product_id');
        $data->date = $request->get('date');
        $data->employee_id = $FollowupDatas->employee_id;
        $data->time = $request->get('time');
        $data->description = $request->get('description');
        $data->next_call_date = $request->get('next_call_date');
        $data->save();

        return redirect()->route('lead.index')->with('info', 'Updated !');
    }


    public function delete($unique_key)
    {
        $data = Followup::where('unique_key', '=', $unique_key)->first();

        $data->soft_delete = 1;

        $data->update();

        return redirect()->route('followup.index')->with('warning', 'Deleted !');
    }

}
