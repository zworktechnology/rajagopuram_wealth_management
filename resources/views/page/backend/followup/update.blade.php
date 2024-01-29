<div class="modal-dialog modal-dialog-centered modal-xl">
   <div class="modal-content">

      <div class="modal-header border-0 pb-0">
         <div class="form-header modal-header-title text-start mb-0">
            <h6 class="mb-0" >Update Followup Status</h6>
         </div>
         <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span class="align-center" aria-hidden="true">&times;</span>
         </button>
      </div>
      <form autocomplete="off" method="POST" action="{{ route('followup.updatestatus', ['unique_key' => $followupdatas['unique_key']]) }}">
      @csrf
      <div class="modal-body">
         <div class="row">
               <div class="col-lg-3 col-md-12">
                  <div class="form-group">
                     <label >Date<span class="text-danger">*</span></label>
                     <input type="date" class="form-control"  name="date" id="date" value="{{$currentdate}}">
                  </div>
               </div>

               <div class="col-lg-3 col-md-12">
                  <div class="form-group">
                     <label >Time<span class="text-danger">*</span></label>
                     <input type="time" class="form-control"  name="time" id="time" value="{{$timenow}}">
                  </div>
               </div>
               @if($followupdatas['customer_id'] != '')
               <div class="col-lg-3 col-md-12">
                  <div class="form-group">
                     <label >Customer <span class="text-danger">*</span></label>
                     <select class="form-control select usedcustomer_id js-example-basic-single" name="customer_id" id="customer_id" disabled>
                           <option value="" disabled selected hiddden>Select Customer</option>
                              @foreach ($customer as $customers)
                                 @if(Auth::user()->role == 'Admin')
                                    @if(Auth::user()->emp_id == $customers->employee_id)
                              <option value="{{ $customers->id }}"@if ($customers->id === $followupdatas['customer_id']) selected='selected' @endif>{{ $customers->name }} </option>
                                    @endif
                                 @else
                                 <option value="{{ $customers->id }}">{{ $customers->name }} </option>
                                 @endif
                              @endforeach
                      </select>
                  </div>
               </div>
               @endif

               @if ($followupdatas['lead_id'] != '')
               <div class="col-lg-3 col-md-12">
                  <div class="form-group">
                     <label >Lead <span class="text-danger">*</span></label>
                     <select class="form-control select lead_id js-example-basic-single" name="lead_id" id="lead_id" disabled>
                           <option value="" disabled selected hiddden>Select Lead</option>
                              @foreach ($lead as $leads)
                                 @if(Auth::user()->role == 'Admin')
                                    @if(Auth::user()->emp_id == $leads->employee_id)
                              <option value="{{ $leads->id }}"@if ($leads->id === $followupdatas['lead_id']) selected='selected' @endif>{{ $leads->name }} </option>
                                    @endif
                                 @else
                                 <option value="{{ $leads->id }}">{{ $leads->name }} </option>
                                 @endif
                              @endforeach
                      </select>
                  </div>
               </div>
               @endif
               <div class="col-lg-3 col-md-12">
                  <div class="form-group">
                     <label >Next Call Date<span class="text-danger">*</span></label>
                     <input type="date" class="form-control"  name="next_call_date" id="next_call_date" required >
                  </div>
               </div>
               <div class="col-lg-6 col-md-12">
                  <div class="form-group">
                     <label >Product <span class="text-danger">*</span></label>
                     <select class="form-control select customerproduct_id js-example-basic-single " name="product_id" id="product_id" disabled>
                           <option value="" disabled selected hiddden>Select Product</option>
                              @foreach ($product as $products)
                              <option value="{{ $products->id }}"@if ($products->id === $followupdatas['product_id']) selected='selected' @endif>{{ $products->name }} </option>
                              @endforeach
                      </select>
                  </div>
               </div>
               <div class="col-lg-6 col-md-12"  @if(Auth::user()->role == 'Admin') hidden   @endif>
                  <div class="form-group">
                     <label >Employee</label>
                     <select class="form-control select  js-example-basic-single customeremployee_id" name="employee_id" id="employee_id" >
                           <option value="" disabled selected hiddden>Select Employee</option>
                              @foreach ($employee as $employees)
                              <option value="{{ $employees->id }}"@if ($employees->id === $followupdatas['employee_id']) selected='selected' @endif>{{ $employees->name }} </option>
                              @endforeach
                      </select>
                  </div>
               </div>
               
               
               <div class="col-lg-12 col-md-12">
                  <div class="form-group">
                     <label >Description<span class="text-danger">*</span></label>
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
