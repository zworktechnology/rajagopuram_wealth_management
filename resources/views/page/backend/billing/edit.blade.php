@extends('layout.backend.auth')

@section('content')
    <div class="page-wrapper card-body">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="content-page-header">
                    <h6 style="text-transform:uppercase">Update Billing</h6>
                </div>
            </div>

            <form autocomplete="off" method="POST"
                action="{{ route('billing.update', ['id' => $BillingData->id]) }}"
                enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="card-title" style="text-transform:uppercase">Basic Details</h6>
                            </div>
                            <div class="card-body">
                                <div class="form-group-item border-0 mb-0">
                                    <div class="row align-item-center">


                                    <div class="col-lg-6 col-md-12">
                                       <div class="form-group">
                                          <label style="text-transform:uppercase">Date<span class="text-danger">*</span></label>
                                          <input type="date" class="form-control"  name="date" id="date" value="{{$BillingData->date}}">
                                       </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                       <div class="form-group">
                                          <label style="text-transform:uppercase">Customer <span class="text-danger">*</span></label>
                                          <select class="form-control select  js-example-basic-single" name="customer_id" id="customer_id" required>
                                                <option value="" disabled selected hiddden>Select Customer</option>
                                                   @foreach ($customer as $customers)
                                                      @if(Auth::user()->role == 'Admin')
                                                         @if(Auth::user()->emp_id == $customers->employee_id)
                                                   <option value="{{ $customers->id }}"@if ($customers->id === $BillingData->customer_id) selected='selected' @endif>{{ $customers->name }} </option>
                                                         @endif
                                                      @else
                                                      <option value="{{ $customers->id }}">{{ $customers->name }} </option>
                                                      @endif
                                                   @endforeach
                                          </select>
                                       </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                       <div class="form-group">
                                          <label style="text-transform:uppercase">Product<span class="text-danger">*</span></label>
                                          <select class="form-control select product_id js-example-basic-single" name="product_id" id="product_id" required>
                                                <option value="" disabled selected hiddden>Select Product</option>
                                                   @foreach ($product as $products)
                                                   <option value="{{ $products->id }}"@if ($products->id === $BillingData->product_id) selected='selected' @endif>{{ $products->name }} </option>
                                                   @endforeach
                                          </select>
                                       </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12" @if(Auth::user()->role == 'Admin') hidden   @endif>
                                       <div class="form-group">
                                          <label style="text-transform:uppercase">Employee</label>
                                          <select class="form-control select  js-example-basic-single" name="employee_id" id="employee_id">
                                                <option value="" disabled selected hiddden>Select Employee</option>
                                                   @foreach ($employee as $employees)
                                                   <option value="{{ $employees->id }}"@if ($employees->id === $BillingData->employee_id) selected='selected' @endif>{{ $employees->name }} </option>
                                                   @endforeach
                                          </select>
                                       </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                       <div class="form-group">
                                          <label style="text-transform:uppercase">Starting Date<span class="text-danger">*</span></label>
                                          <input type="date" class="form-control"  name="starting_date" id="starting_date" required value="{{$BillingData->starting_date}}">
                                       </div>
                                    </div>
                                    
                                    <div class="col-lg-6 col-md-12">
                                       <div class="form-group">
                                          <label style="text-transform:uppercase">Ending Date<span class="text-danger">*</span></label>
                                          <input type="date" class="form-control"  name="ending_date" id="ending_date" required value="{{$BillingData->ending_date}}">
                                       </div>
                                    </div>
                                    
                                    <div class="col-lg-6 col-md-12">
                                       <div class="form-group">
                                          <label style="text-transform:uppercase">Remainder Date<span class="text-danger">*</span></label>
                                          <input type="date" class="form-control"  name="remainder_date" id="remainder_date" required value="{{$BillingData->remainder_date}}">
                                       </div>
                                    </div>


                                          <div class="col-lg-12 col-md-12">
                                             <div class="form-group">
                                             <label style="text-transform:uppercase">Documents Upload<span class="text-danger">*</span></label>
                                                <div class="">
                                                    <table class="table">
                                                        <thead class="thead-light">
                                                            <tr>
                                                                <th style="width:40%;text-transform:uppercase;">Document Name</th>
                                                                <th style="width:40%;text-transform:uppercase;">File</th>
                                                                <th style="width:10%;text-transform:uppercase;">Image</th>
                                                                <th style="width:10%;text-transform:uppercase;">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="document_fields">
                                                        @foreach ($BillingDocument as $index => $BillingDocuments)
                                                         @php
                                                        $ext = pathinfo(storage_path().asset('assets/document_proof/' . $BillingDocuments->document_proof), PATHINFO_EXTENSION);
                                                        @endphp
                                                            <tr>
                                                                <td><input type="hidden" name="document_id[]" value="{{$BillingDocuments->id}}"/>
                                                                     <input type="text" name="document_name[]" id="document_name" class="form-control document_name" 
                                                                     value="{{$BillingDocuments->document_name}}" placeholder="Enter Document Title"/>
                                                                </td>
                                                                <td><input type="file" name="document_proof[]" id="document_proof" class="form-control document_proof" /></td>
                                                                <td>
                                                                  @if($ext == 'pdf')
                                                                  <a href="{{ asset('assets/document_proof/' . $BillingDocuments->document_proof) }} " target="_blank">Download PDF</a>
                                                                  @else
                                                                  <img src="{{ asset('assets/document_proof/' . $BillingDocuments->document_proof) }}"
                                                                              alt="" style="width: 60px !important; height: 60px !important;">
                                                                  @endif
                                                                </td>
                                                                <td><button class="btn btn-danger form-plus-btn remove-documenttr" type="button" id="" value="Add"><i class="fe fe-minus-circle"></i></button></td>
                                                            </tr>
                                                            @endforeach
                                                            <tr>
                                                                <td><input type="hidden" name="document_id[]"/>
                                                                <input type="text" name="document_name[]" id="document_name" class="form-control document_name" placeholder="Enter Document Title"/>
                                                                </td>
                                                                <td><input type="file" name="document_proof[]" id="document_proof" class="form-control document_proof" /></td>
                                                                <td><button class="btn btn-primary form-plus-btn add_documents"type="button" id="" value="Add"><i
                                                                    class="fe fe-plus-circle"></i></button></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                             </div>
                                          </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="text-end" style="margin-top:3%">
                        <input type="submit" class="btn btn-primary" />
                        <a href="{{ route('billing.index') }}" class="btn btn-cancel btn-danger">Cancel</a>
                    </div>


            </form>


        </div>
    </div>
@endsection










