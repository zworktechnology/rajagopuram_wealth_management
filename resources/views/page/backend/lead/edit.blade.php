<div class="modal-dialog modal-dialog-centered modal-l">
    <div class="modal-content">

        <div class="modal-header border-0 pb-0">
            <div class="form-header modal-header-title text-start mb-0">
                <h6 class="mb-0" style="text-transform:uppercase">Update Leads</h6>
            </div>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span class="align-center" aria-hidden="true">&times;</span>
            </button>
        </div>
        <form autocomplete="off" method="POST" action="{{ route('lead.edit', ['id' => $Lead_datas['id']]) }}">
            @csrf
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="form-group">
                            <label style="text-transform:uppercase">Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="Enter Lead Name" name="name" value="{{$Lead_datas['name']}}"
                                id="name" required>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12">
                        <div class="form-group">
                            <label style="text-transform:uppercase">Phone Number <span class="text-danger">*</span></label>
                            <input type="text" class="form-control customer_phoneno"
                                placeholder="Enter Lead Contact No" name="phonenumber" id="phonenumber" value="{{$Lead_datas['phonenumber']}}"
                                required>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12">
                        <div class="form-group">
                                       <label style="text-transform:uppercase">Source From <span class="text-danger">*</span></label>
                                                <select class="form-control select source_from js-example-basic-single"
                                                    name="source_from" id="source_from" required>
                                                    <option value="" disabled selected hiddden>Select Source From
                                                    </option>
                                                    <option  value="Facebook"{{ $Lead_datas['source_from'] == 'Facebook' ? 'selected' : '' }}>Facebook</option>
                                                    <option value="Instagram"{{ $Lead_datas['source_from'] == 'Instagram' ? 'selected' : '' }}>Instagram</option>
                                                    <option value="Walk-in"{{ $Lead_datas['source_from'] == 'Walk-in' ? 'selected' : '' }}>Walk-in</option>
                                                    <option value="Mail"{{ $Lead_datas['source_from'] == 'Mail' ? 'selected' : '' }}>Mail</option>
                                                    <option value="Twitter"{{ $Lead_datas['source_from'] == 'Twitter' ? 'selected' : '' }}>Twitter</option>
                                                    <option value="Just Dial"{{ $Lead_datas['source_from'] == 'Just Dial' ? 'selected' : '' }}>Just Dial</option>
                                                    <option value="Reference"{{ $Lead_datas['source_from'] == 'Reference' ? 'selected' : '' }}>Reference</option>
                                                </select>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12" @if(Auth::user()->role == 'Admin') hidden   @endif>
                        <div class="form-group">
                                 <label style="text-transform:uppercase">Staff <span class="text-danger">*</span></label>
                                                <select class="form-control select employee_id js-example-basic-single"
                                                    name="employee_id" id="employee_id" required>
                                                    <option value="" disabled selected hiddden>Select Staff
                                                    </option>
                                                    @foreach ($employee as $employees)
                                                        <option value="{{ $employees->id }}" {{ $Lead_datas['employee_id'] == $employees->id ? 'selected' : '' }}>{{ $employees->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" style="margin-right: 5px;">Save</button>
                <button type="button" class="btn btn-cancel btn-danger" data-bs-dismiss="modal"
                    aria-label="Close">Cancel</button>
            </div>
        </form>
    </div>
</div>
