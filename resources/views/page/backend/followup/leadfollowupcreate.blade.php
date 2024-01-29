<div class="modal-dialog modal-dialog-centered modal-xl" id="customerfollowupmodal">
   <div class="modal-content">

      <div class="modal-header border-0 pb-0">
         <div class="form-header modal-header-title text-start mb-0">
            <h6 class="mb-0" >Add Lead Followup</h6>
         </div>
         <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span class="align-center" aria-hidden="true">&times;</span>
         </button>
      </div>
      <form autocomplete="off" method="POST" action="{{ route('followup.leadfollowup_store') }}">
      @csrf
      <div class="modal-body">
         <div class="row">
               <div class="col-lg-3 col-md-12">
                  <div class="form-group">
                     <label >Date <span class="text-danger">*</span></label>
                     <input type="date" class="form-control"  name="date" id="date" value="{{$today}}">
                  </div>
               </div>
               <div class="col-lg-3 col-md-12">
                  <div class="form-group">
                     <label >Time <span class="text-danger">*</span></label>
                     <input type="time" class="form-control"  name="time" id="time" value="{{$timenow}}">
                  </div>
               </div>
               <div class="col-lg-3 col-md-12">
                  <div class="form-group">
                     <label >Lead <span class="text-danger">*</span></label>
                     <select class="form-control select js-example-basic-single" name="lead_id" id="lead_id" required>
                           <option value="" disabled selected hiddden>Select Lead</option>
                           @foreach ($lead as $leads)
                                 @if(Auth::user()->role == 'Admin')
                                    @if(Auth::user()->emp_id == $leads->employee_id)
                              <option value="{{ $leads->id }}">{{ $leads->name }} </option>
                                    @endif
                                 @else
                                 <option value="{{ $leads->id }}">{{ $leads->name }} </option>
                                 @endif
                              @endforeach
                      </select>
                  </div>
               </div>

               <div class="col-lg-3 col-md-12">
                  <div class="form-group">
                     <label >Next Call Date <span class="text-danger">*</span></label>
                     <input type="date" class="form-control"  name="next_call_date" id="next_call_date" required>
                  </div>
               </div>
               <div class="col-lg-6 col-md-12" @if(Auth::user()->role == 'Admin') hidden   @endif>
                     <div class="form-group">
                        <label >Staff <span class="text-danger">*</span></label>
                        <select class="form-control select  js-example-basic-single" name="employee_id" id="followupemployee_id" required>
                           <option value="" disabled selected hiddden>Select Staff</option>
                           @foreach ($employee as $employees)
                              <option value="{{ $employees->id }}" {{ Auth::user()->emp_id == $employees->id ? 'selected' : '' }}>{{ $employees->name }}</option>
                           @endforeach
                        </select>
                     </div>
               </div>
               <div class="col-lg-6 col-md-12">
                  <div class="form-group">
                     <label >Product </label>
                     <select class="form-control select js-example-basic-single" name="product_id" id="product_id" required>
                           <option value="" disabled selected hiddden>Select Product</option>
                           @foreach ($product as $products)
                              <option value="{{ $products->id }}">{{ $products->name }}</option>
                           @endforeach
                      </select>
                  </div>
               </div>

               <div class="col-lg-12 col-md-12">
                  <div class="form-group">
                     <label >Description <span class="text-danger">*</span></label>
                     <textarea class="form-control"  name="description" id="description" required></textarea>
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
