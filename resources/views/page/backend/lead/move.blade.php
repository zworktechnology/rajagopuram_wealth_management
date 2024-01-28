@extends('layout.backend.auth')

@section('content')
    <div class="page-wrapper card-body">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="content-page-header">
                    <h6 >Lead to Customer</h6>
                </div>
            </div>
            <form autocomplete="off" method="POST" action="{{ route('lead.leadtocustomer') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title" >Basic Details</h5>
                            </div>
                            <div class="card-body">
                                <div class="form-group-item border-0 mb-0">
                                    <div class="row align-item-center">

                                        <div class="col-lg-4 col-md-4 col-sm-12" hidden>
                                            <div class="form-group">
                                                <label >Date<span class="text-danger">*</span></label>
                                                <input type="date"  class="form-control" name="moved_date" id="moved_date" value="{{$today}}"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <label >Customer Name <span class="text-danger">*</span></label>
                                                <input type="text"  class="form-control" placeholder="Enter Customer Name" name="name" id="name" value="{{$LeadData->name}}"
                                                    readonly>
                                                <input type="hidden" class="form-control"  name="lead_id" id="lead_id" value="{{$LeadData->id}}">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12"  @if(Auth::user()->role == 'Admin') hidden   @endif>
                                            <div class="form-group">
                                                <label >Staff <span class="text-danger">*</span></label>
                                                <select class="form-control select employee_id js-example-basic-single"
                                                    name="employee_id" id="employee_id" disabled>
                                                    <option value="" disabled selected hiddden>Select Staff
                                                    </option>
                                                    @foreach ($employee as $employees)
                                                        <option value="{{ $employees->id }}" {{ $LeadData->employee_id == $employees->id ? 'selected' : '' }}>{{ $employees->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <label >Source From <span class="text-danger">*</span></label>
                                                <select class="form-control select source_from js-example-basic-single"
                                                    name="source_from" id="source_from" disabled>
                                                    <option value="" disabled selected hiddden>Select Source From
                                                    </option>
                                                    <option  value="Facebook"{{ $LeadData->source_from == 'Facebook' ? 'selected' : '' }}>Facebook</option>
                                                    <option value="Instagram"{{ $LeadData->source_from == 'Instagram' ? 'selected' : '' }}>Instagram</option>
                                                    <option value="Walk-in"{{ $LeadData->source_from == 'Walk-in' ? 'selected' : '' }}>Walk-in</option>
                                                    <option value="Mail"{{ $LeadData->source_from == 'Mail' ? 'selected' : '' }}>Mail</option>
                                                    <option value="Twitter"{{ $LeadData->source_from == 'Twitter' ? 'selected' : '' }}>Twitter</option>
                                                    <option value="Just Dial"{{ $LeadData->source_from == 'Just Dial' ? 'selected' : '' }}>Just Dial</option>
                                                    <option value="Reference"{{ $LeadData->source_from == 'Reference' ? 'selected' : '' }}>Reference</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <label >Phone Number <span class="text-danger">*</span></label>
                                                <input type="text"  value="{{$LeadData->phonenumber}}"class="form-control"
                                                    placeholder="Enter Phone No" name="phonenumber" id="phonenumber"
                                                    readonly>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <label >Alter Phone Number</label>
                                                <input type="text" value="" class="form-control"
                                                    placeholder="Enter Alter Phone No" name="alter_phonenumber"
                                                    id="alter_phonenumber">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <label >E-Mail ID</label>
                                                <input type="text" value="" class="form-control"
                                                    placeholder="Enter E-Mail" name="email_id" id="email_id">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label >Date of Birth <span class="text-danger">*</span></label>
                                                <input type="date" value="" class="form-control" name="birth_date"
                                                    id="birth_date">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label >Wedding Date</label>
                                                <input type="date" value="" class="form-control"
                                                    name="wedding_date" id="wedding_date">
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <label >Address</label>
                                                <textarea name="address" id="address" class="form-control" placeholder="Enter Address"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title" >Proof</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group-item border-0 mb-0">
                                            <div class="row align-item-center">
                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label >Customer Photo <span class="text-danger">*</span></label>
                                                        <input type="file" name="customer_photo" id="customer_photo"
                                                            class="form-control customer_photo" />
                                                        <img src="#" id="customer-img-tag" width="150" height="100" style="display:none;"/>
                                                    </div>
                                                </div>

                                                <div class="table-responsive no-pagination">
                                                    <label >KYC (Know Your Customer) <span class="text-danger">*</span></label>
                                                    <table class="table table-center table-hover datatable">
                                                        <thead class="thead-light">
                                                            <tr>
                                                                <th style="width:40%;;">Proof Type</th>
                                                                <th style="width:50%;;">File</th>
                                                                <th style="width:10%;;">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="proof_fields">
                                                            <tr>
                                                                <td><input type="hidden" name="proof_id[]"/>
                                                                    <select class="form-control" name="prooftype[]"
                                                                        style="width: 100%;" >
                                                                        <option value="" disabled selected hidden
                                                                            class="text-muted">Select Type</option>
                                                                        <option value="Aadhaar Card">Aadhaar Card</option>
                                                                        <option value="Pan Card" >Pan Card</option>
                                                                        <option value="Voter ID">Voter ID</option>
                                                                        <option value="Driving Licence">DrivingLicence</option>
                                                                    </select>
                                                                </td>
                                                                <td><input type="file" name="proof_upload[]" id="proof_upload" class="form-control proof_upload" /></td>
                                                                <td><button class="btn btn-primary form-plus-btn addproofs"type="button" id="" value="Add"><i
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

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title" >Family Details</h5>
                                </div>
                                <div class="card-body">

                                    <div class="table-responsive no-pagination">
                                        <table class="table table-center table-hover datatable">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th style="width:10%;">S.No <span class="text-danger">*</span></th>
                                                    <th style="width:30%;">Name <span class="text-danger">*</span></th>
                                                    <th style="width:20%;">Relationship <span class="text-danger">*</span></th>
                                                    <th style="width:15%;">Date of Birth <span class="text-danger">*</span></th>
                                                    <th style="width:15%;">Wedding Date</th>
                                                    <th style="width:10%;">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody class="family_fields">
                                                <tr>
                                                    <td>
                                                        <input id="#" name="#"
                                                            class="auto_num form-control" type="text" value="1"
                                                            readonly />
                                                    </td>
                                                    <td><input type="hidden" name="family_id[]" value="" />
                                                        <input type="text" class="form-control family_name"
                                                            id="family_name" name="family_name[]"
                                                            value="" />
                                                    </td>
                                                    <td><input type="text" class="form-control family_relationship"
                                                            id="family_relationship" name="family_relationship[]"
                                                            value=""  /></td>
                                                    <td><input type="date" class="form-control family_dob"
                                                            id="family_dob" name="family_dob[]"  /></td>
                                                    <td><input type="date" class="form-control family_weddingdate"
                                                            id="family_weddingdate" name="family_weddingdate[]" /></td>
                                                    <td>
                                                        <button class="btn btn-primary form-plus-btn addfamilys"
                                                            type="button" id="" value="Add"><i
                                                                class="fe fe-plus-circle"></i></button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="text-end" style="margin-top:3%">
                        <input type="submit" class="btn btn-primary" />
                        <a href="{{ route('lead.index') }}" class="btn btn-cancel btn-danger" >Cancel</a>
                    </div>


            </form>


        </div>
    </div>
@endsection
