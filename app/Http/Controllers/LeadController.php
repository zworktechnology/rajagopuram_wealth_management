<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Employee;
use App\Models\Lead;
use App\Models\Customer;
use App\Models\CustomerFamily;
use App\Models\CustomerProof;
use Illuminate\Support\Str;
use App\Imports\ImportLead;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class LeadController extends Controller
{
    public function index()
    {
        $data = Lead::where('soft_delete', '!=', 1)->orderBy('id', 'DESC')->get();

        $Lead_data = [];
        foreach ($data as $key => $datas) {

            $employee = Employee::findOrFail($datas->employee_id);

            $Lead_data[] = array(
                'name' => $datas->name,
                'phonenumber' => $datas->phonenumber,
                'source_from' => $datas->source_from,
                'id' => $datas->id,
                'date' => $datas->date,
                'employee_id' => $datas->employee_id,
                'status' => $datas->status,
                'employee' => $employee->name,
            );

        }
        $today = Carbon::now()->format('Y-m-d');
        $employee = Employee::where('soft_delete', '!=', 1)->get();
        return view('page.backend.lead.index', compact('Lead_data', 'today', 'employee'));
    }


    public function store(Request $request)
    {
        $data = new Lead();
        $data->date = $request->get('date');
        $data->name = $request->get('name');
        $data->phonenumber = $request->get('phonenumber');
        $data->source_from = $request->get('source_from');
        $data->employee_id = $request->get('employee_id');
        $data->save();

        return redirect()->route('lead.index')->with('message', 'Added !');
    }


    public function edit(Request $request, $id)
    {
        $LeadData = Lead::findOrFail($id);

        $LeadData->date = $request->get('date');
        $LeadData->name = $request->get('name');
        $LeadData->phonenumber = $request->get('phonenumber');
        $LeadData->source_from = $request->get('source_from');
        $LeadData->employee_id = $request->get('employee_id');
        $LeadData->update();

        return redirect()->route('lead.index')->with('info', 'Updated !');
    }


    public function move($id)
    {
        $LeadData = Lead::findOrFail($id);
        $employee = Employee::where('soft_delete', '!=', 1)->get();
        $today = Carbon::now()->format('Y-m-d');
        $timenow = Carbon::now()->format('H:i');

        return view('page.backend.lead.move', compact('LeadData', 'employee', 'today', 'timenow'));
    }


    public function leadtocustomer(Request $request)
    {
        $randomkey = Str::random(5);

        $data = new Customer();
        $random_no =  rand(100,999);

        $data->unique_key = $randomkey;
        $data->name = $request->get('name');
        $data->phonenumber = $request->get('phonenumber');
        $data->alter_phonenumber = $request->get('alter_phonenumber');
        $data->email_id = $request->get('email_id');
        $data->address = $request->get('address');
        $data->source_from = $request->get('source_from');
        $data->birth_date = $request->get('birth_date');
        $data->wedding_date = $request->get('wedding_date');
        $data->employee_id = $request->get('employee_id');
        $data->lead_id = $request->get('lead_id');


        $customer_photo = $request->customer_photo;
        $filename_customer_photo = $data->name . '_' . $random_no . '_' . 'Photo' . '.' . $customer_photo->getClientOriginalExtension();
        $request->customer_photo->move('assets/customer_photo', $filename_customer_photo);
        $data->customer_photo = $filename_customer_photo;

        $data->save();


        $customerid = $data->id;

        DB::table('leads')->where('id', $request->get('lead_id'))->update(['status' => 1, 'moved_date' => $request->get('moved_date')]);

           
            foreach($request->proof_upload as $key => $proof_upload)
            {
                $imageName = $data->name . '_' . time().rand(1,99).'.'.$proof_upload->extension();  
                $proof_upload->move('assets/proof_one', $imageName);
  
                $CustomerProof = new CustomerProof();
                $CustomerProof->customer_id = $customerid;
                $CustomerProof->prooftype = $request->prooftype[$key];
                $CustomerProof->proof_upload = $imageName;
                $CustomerProof->save();
            }

        
        
            foreach ($request->get('family_name') as $key => $family_name) {

                if($family_name != ""){
                    $CustomerFamilydata = new CustomerFamily();

                    $CustomerFamilydata->customer_id = $customerid;
                    $CustomerFamilydata->family_name = $family_name;
                    $CustomerFamilydata->family_relationship = $request->family_relationship[$key];
                    $CustomerFamilydata->family_dob = $request->family_dob[$key];
                    $CustomerFamilydata->family_weddingdate = $request->family_weddingdate[$key];
                    $CustomerFamilydata->save();
                }
                
            }

        return redirect()->route('lead.index')->with('message', 'Added !');
    }


    public function delete($id)
    {
        $data = Lead::findOrFail($id);

        $data->soft_delete = 1;

        $data->update();

        return redirect()->route('lead.index')->with('warning', 'Deleted !');
    }


    public function excel_import(Request $request){ 
        error_reporting(0);
        Excel::import(new ImportLead, request()->file('lead_file'));
        return redirect()->back();
    }
}
