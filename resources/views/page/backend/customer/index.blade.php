@extends('layout.backend.auth')

@section('content')

<div class="page-wrapper">
   <div class="content container-fluid">

      <div class="page-header">
         <div class="content-page-header">
            <h6 >Customer</h6>
               <div class="list-btn">
                  <div style="display:flex;">
                     <ul class="filter-list">
                        <li>
                           <a class="btn btn-primary" href="{{ route('customer.create') }}" ><i class="fa fa-plus-circle me-2" aria-hidden="true"></i>Add Customer</a>
                        </li>
                     </ul>
                  </div>

               </div>




         </div>
      </div>

      <div class="row">
         <div class="col-sm-12">
               <div class="profile-picture">

                              <form id="csvimport_form" method="POST" action="{{ route('customer.excel_import') }}" enctype="multipart/form-data" class="form-horizontal">
                              @csrf
                                 <div style="display:flex;">
						                  <div class="upload-profile">
													<div class="add-profile" style="display:flex;">
                                                        <p>Import CSV <span style="color: red">*</span></p>
														<input type="file" name="file" id="file" class="form-control" required/>
													</div>
												</div>
												<div class="img-upload">
                                       <input type="hidden" name="hidden_field" value="1" />
                                          <input type="submit" name="import" id="import" class="btn btn-info" value="Import Customers" />
												</div>
                                 </div>
                              </form>

					</div>

            <div class="card">


                  <div class="card-body">
                     <div class="table-responsive">
                        <table class="table table-center table-hover datatable table-striped">
                           <thead class="thead-light">
                              <tr>
                                 <th style="width:5%;">S.No</th>
                                 <th style="width:15%;">Name</th>
                                 <th style="width:10%;">Phone No</th>
                                 <th style="width:10%;">Source From</th>
                                 @if(Auth::user()->role == 'Super-Admin')
                                 <th style="width:20%;">Hand By</th>
                                 @endif
                                 <th style="width:10%">Last Connect</th>
                                 <th style="width:15%">Active On</th>
                                 <th style="width:15%;">Action</th>
                              </tr>
                           </thead>
                           <tbody>
                           @foreach ($Customer_data as $keydata => $customer_data)
                              @if(Auth::user()->role == 'Admin')
                                 @if(Auth::user()->emp_id == $customer_data['employee_id'])
                              <tr>
                                 <td>{{ ++$keydata }}</td>
                                 <td >{{ $customer_data['name'] }}</td>
                                 <td >{{ $customer_data['phonenumber'] }}</td>
                                 <td >{{ $customer_data['source_from'] }}</td>
                                 <td >{{ $customer_data['last_call_date'] }}</td>
                                 <td >
                                 @foreach ($customer_data['productArr'] as $index => $productArr)
                                                    @if ($productArr['customer_id'] == $customer_data['id'])
                                                    <span class="badge bg-info-light" style="color: black">{{ $productArr['products'] }}</span>
                                                    @endif
                                                    @endforeach</td>
                                 <td>
                                    <ul class="list-unstyled hstack gap-1 mb-0">
                                          <li hidden>
                                            <a class="badge" href="#followup_update{{ $customer_data['id'] }}" data-bs-toggle="modal"
                                            data-bs-target=".followup_update-modal-xl{{ $customer_data['id'] }}" style="color: #f8f9fa;background: #095255;">D bY D</a>
                                         </li>
                                       <li>
                                          <a class="badge" href="#customerview{{ $customer_data['id'] }}" data-bs-toggle="modal"
                                          data-bs-target=".customerview-modal-xl{{ $customer_data['id'] }}" style="color: #f8f9fa;background: #8068dc;">View</a>
                                       </li>
                                       <li>
                                          <a href="{{ route('customer.edit', ['id' => $customer_data['id']]) }}"
                                                   class="badge" style="color:#28084b;background: #86ad25;">Edit</a>
                                       </li>
                                    </ul>

                                 </td>
                              </tr>
                              <div class="modal fade followup_update-modal-xl{{ $customer_data['id'] }}"
                                                tabindex="-1" role="dialog" data-bs-backdrop="static"
                                                aria-labelledby="followup_updateLargeModalLabel{{ $customer_data['id']}}"
                                                aria-hidden="true">
                                                @include('page.backend.customer.followupupdate')
                                        </div>
                              <div class="modal fade customerview-modal-xl{{ $customer_data['id'] }}"
                                    tabindex="-1" role="dialog" data-bs-backdrop="static"
                                    aria-labelledby="customerviewLargeModalLabel{{ $customer_data['id'] }}"
                                    aria-hidden="true">
                                    @include('page.backend.customer.view')
                              </div>
                              <div class="modal fade customerdelete-modal-xl{{ $customer_data['id'] }}"
                                    tabindex="-1" role="dialog"data-bs-backdrop="static"
                                    aria-labelledby="customerdeleteLargeModalLabel{{ $customer_data['id'] }}"
                                    aria-hidden="true">
                                    @include('page.backend.customer.delete')
                              </div>
                                 @endif
                              @else


                              <tr>
                                 <td>{{ ++$keydata }}</td>
                                 <td >{{ $customer_data['name'] }}</td>
                                 <td >{{ $customer_data['phonenumber'] }}</td>
                                 <td >{{ $customer_data['source_from'] }}</td>
                                 <td >{{ $customer_data['employee'] }}</td>
                                 <td >{{ $customer_data['last_call_date'] }}</td>

                                 <td > @foreach ($customer_data['productArr'] as $index => $productArr)
                                                    @if ($productArr['customer_id'] == $customer_data['id'])
                                                    <span class="badge bg-info-light" style="color: black">{{ $productArr['products'] }}</span>
                                                    @endif
                                                    @endforeach</td>
                                 <td>
                                    <ul class="list-unstyled hstack gap-1 mb-0">
                                        <li hidden>
                                            <a class="badge" href="#followup_update{{ $customer_data['id'] }}" data-bs-toggle="modal"
                                            data-bs-target=".followup_update-modal-xl{{ $customer_data['id'] }}" style="color: #f8f9fa;background: #095255;">D bY D</a>
                                         </li>
                                        <li>
                                          <a class="badge" href="#customerview{{ $customer_data['id'] }}" data-bs-toggle="modal"
                                          data-bs-target=".customerview-modal-xl{{ $customer_data['id'] }}" style="color: #f8f9fa;background: #8068dc;">View</a>
                                       </li>
                                       <li>
                                          <a href="{{ route('customer.edit', ['id' => $customer_data['id']]) }}"
                                                   class="badge" style="color:#28084b;background: #86ad25;">Edit</a>
                                       </li>
                                       <li>
                                          <a href="#delete{{ $customer_data['id'] }}" data-bs-toggle="modal"
                                          data-bs-target=".customerdelete-modal-xl{{ $customer_data['id'] }}" class="badge bg-danger-light" style="color: #28084b;">Delete</a>
                                       </li>
                                    </ul>

                                 </td>
                              </tr>
                              <div class="modal fade followup_update-modal-xl{{ $customer_data['id'] }}"
                                                tabindex="-1" role="dialog" data-bs-backdrop="static"
                                                aria-labelledby="followup_updateLargeModalLabel{{ $customer_data['id']}}"
                                                aria-hidden="true">
                                                @include('page.backend.customer.followupupdate')
                                        </div>  
                              <div class="modal fade customerview-modal-xl{{ $customer_data['id'] }}"
                                    tabindex="-1" role="dialog" data-bs-backdrop="static"
                                    aria-labelledby="customerviewLargeModalLabel{{ $customer_data['id'] }}"
                                    aria-hidden="true">
                                    @include('page.backend.customer.view')
                              </div>
                              <div class="modal fade customerdelete-modal-xl{{ $customer_data['id'] }}"
                                    tabindex="-1" role="dialog"data-bs-backdrop="static"
                                    aria-labelledby="customerdeleteLargeModalLabel{{ $customer_data['id'] }}"
                                    aria-hidden="true">
                                    @include('page.backend.customer.delete')
                              </div>


                              @endif
                           @endforeach
                           </tbody>
                        </table>
                     </div>
                  </div>

            </div>
         </div>


      </div>






   </div>
</div>
@endsection
