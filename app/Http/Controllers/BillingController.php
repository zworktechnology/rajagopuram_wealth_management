<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Billing;
use App\Models\BillingDocument;
use App\Models\Employee;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class BillingController extends Controller
{
    public function index()
    {
        $today = Carbon::now()->format('Y-m-d');
        $data = Billing::where('soft_delete', '!=', 1)->orderBy('id', 'DESC')->get();
        $Billingdata = [];
        $documents = [];
        foreach ($data as $key => $datas) {
            
            $customer = Customer::findOrFail($datas->customer_id);
            $product = Product::findOrFail($datas->product_id);
            $employee = Employee::findOrFail($datas->employee_id);

            $BillingDocuments = BillingDocument::where('billing_id', '=', $datas->id)->orderBy('id', 'DESC')->get();
            foreach ($BillingDocuments as $key => $BillingDocumentsarr) {

                $documents[] = array(
                    'document_name' => $BillingDocumentsarr->document_name,
                    'document_proof' => $BillingDocumentsarr->document_proof,
                    'id' => $BillingDocumentsarr->id,
                    
                    'billing_id' => $BillingDocumentsarr->billing_id,
                );
            }

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
                'id' => $datas->id,
                'documents' => $documents,
            );
        }

        $employee = Employee::where('soft_delete', '!=', 1)->get();
        $customer = Customer::where('soft_delete', '!=', 1)->get();
        $product = Product::where('soft_delete', '!=', 1)->get();
        return view('page.backend.billing.index', compact('Billingdata', 'today', 'employee', 'customer', 'product'));
    }



    public function store(Request $request)
    {
        $randomkey = Str::random(5);

        $data = new Billing();

        $data->unique_key = $randomkey;
        $data->customer_id = $request->get('customer_id');
        $data->product_id = $request->get('product_id');
        $data->date = $request->get('date');
        $data->employee_id = $request->get('employee_id');
        $data->starting_date = $request->get('starting_date');
        $data->ending_date = $request->get('ending_date');
        $data->remainder_date = $request->get('remainder_date');
        $data->save();

        $billing_id = $data->id;


        foreach($request->document_proof as $key => $document_proof)
            {
                $imageName = $data->customer_id . $data->product_id . '_' . time().rand(1,99).'.'.$document_proof->extension();  
                $document_proof->move('assets/document_proof', $imageName);
  
                $BillingDocument = new BillingDocument();
                $BillingDocument->billing_id = $billing_id;
                $BillingDocument->document_name = $request->document_name[$key];
                $BillingDocument->document_proof = $imageName;
                $BillingDocument->save();
            }

      
        return redirect()->route('billing.index')->with('message', 'Added !');
    }

    public function edit($id)
    {
        $BillingData = Billing::findOrFail($id);
        $BillingDocument = BillingDocument::where('billing_id', '=', $BillingData->id)->get();
        $employee = Employee::where('soft_delete', '!=', 1)->get();
        $customer = Customer::where('soft_delete', '!=', 1)->get();
        $product = Product::where('soft_delete', '!=', 1)->get();

        return view('page.backend.billing.edit', compact('BillingData', 'BillingDocument', 'employee', 'customer', 'product'));
    }


    public function update(Request $request, $id)
    {
        $BillingData = Billing::findOrFail($id);

        $BillingData->customer_id = $request->get('customer_id');
        $BillingData->product_id = $request->get('product_id');
        $BillingData->date = $request->get('date');
        $BillingData->employee_id = $request->get('employee_id');
        $BillingData->starting_date = $request->get('starting_date');
        $BillingData->ending_date = $request->get('ending_date');
        $BillingData->remainder_date = $request->get('remainder_date');
        $BillingData->update();


        $billing_id = $BillingData->id;



        $getInsertedproof = BillingDocument::where('billing_id', '=', $billing_id)->get();
        $proofsarr = array();
        foreach ($getInsertedproof as $key => $getInsertedproofs) {
            $proofsarr[] = $getInsertedproofs->id;
        }

        $updated_proofs = $request->document_id;
        $updated_proofs_ids = array_filter($updated_proofs);
        $different_proofids = array_merge(array_diff($proofsarr, $updated_proofs_ids), array_diff($updated_proofs_ids, $proofsarr));

        if (!empty($different_proofids)) {
            foreach ($different_proofids as $key => $different_proofid) {
                BillingDocument::where('id', $different_proofid)->delete();
            }
        }
        error_reporting(0);
        foreach ($request->get('document_id') as $key => $document_id) {
            if ($document_id > 0) {

                $ids = $document_id;
                $document_name = $request->document_name[$key];

                if ($request->document_proof[$key] != "") {
                    $document_proof = $request->document_proof[$key];
                    $imageName = $BillingData->customer_id . $BillingData->product_id . '_' . time().rand(1,99).'.'.$document_proof->extension();  
                    $document_proof->move('assets/document_proof', $imageName);

                }else {
                    $getInsertedproofimg = BillingDocument::where('id', '=', $document_id)->first();
                    $Insertedproof = $getInsertedproofimg->document_proof;
                    $imageName = $Insertedproof;
                }

                DB::table('billing_documents')->where('id', $document_id)->update([
                    'billing_id' => $billing_id, 'document_name' => $document_name, 'document_proof' => $imageName
                ]);

            } else if ($document_id == '') {

                if($request->document_proof[$key] != ""){
                    $document_proof = $request->document_proof[$key];
                    $imageName = $BillingData->customer_id . $BillingData->product_id . '_' . time().rand(1,99).'.'.$document_proof->extension();  
                    $document_proof->move('assets/document_proof', $imageName);
    
                    $BillingDocument = new BillingDocument();
                    $BillingDocument->billing_id = $billing_id;
                    $BillingDocument->document_name = $request->document_name[$key];
                    $BillingDocument->document_proof = $imageName;
                    $BillingDocument->save();
                }
            }
        }

        return redirect()->route('billing.index')->with('info', 'Updated !');
    }


    public function delete($unique_key)
    {
        $data = Billing::where('unique_key', '=', $unique_key)->first();

        $data->soft_delete = 1;

        $data->update();

        return redirect()->route('billing.index')->with('warning', 'Deleted !');
    }
}
