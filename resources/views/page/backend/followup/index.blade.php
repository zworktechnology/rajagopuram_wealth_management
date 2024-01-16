@extends('layout.backend.auth')

@section('content')

<div class="page-wrapper">
   <div class="content container-fluid">

      <div class="page-header">
         <div class="content-page-header">
            <h6 style="text-transform:uppercase">Day By Day</h6>
               <div class="list-btn">
                  <div style="display:flex;">
                        <div class="page-btn">
                            <div style="display: flex;">
                                    <form autocomplete="off" method="POST" action="{{ route('followup.datefilter') }}">
                                        @method('PUT')
                                        @csrf
                                        <div style="display: flex">
                                            <div style="margin-right: 10px;"><input type="date" name="from_date"
                                                    class="form-control from_date" value="{{ $today }}"></div>
                                            <div style="margin-right: 10px;"><input type="submit" class="btn btn-success"
                                                    value="Search" /></div>
                                        </div>
                                    </form>
                            </div>


                        </div>
                     <ul class="filter-list">
                        <li>
                        <a class="btn btn-primary" data-bs-toggle="modal" style="text-transform:uppercase" data-bs-target=".followup-modal-xl">
                              <i class="fa fa-plus-circle me-2" aria-hidden="true"></i>Add Followup</a>
                        </li>
                     </ul>
                  </div>

               </div>
         </div>
      </div>

      <div class="row">
         <div class="col-sm-12">
            <div class="card">

                  <div class="card-body">
                     <div class="table-responsive">
                        <table class="table table-center table-hover datatable table-striped">
                           <thead class="thead-light">
                              <tr>
                                 <th style="width:15%;text-transform:uppercase">Date</th>
                                 <th style="width:15%;text-transform:uppercase">Customer</th>
                                 <th style="width:15%;text-transform:uppercase">Product</th>
                                 @if(Auth::user()->role != 'Admin')
                                    <th style="width:15%;text-transform:uppercase">Employee</th>
                                 @endif
                                 <th style="width:15%;text-transform:uppercase">Description</th>
                                 <th style="width:15%;text-transform:uppercase">Next Call Date</th>
                                 <th style="width:20%;text-transform:uppercase">Action</th>
                              </tr>
                           </thead>
                           <tbody>
                           @foreach ($followupdata as $keydata => $followup_data)
                              @if(Auth::user()->role == 'Admin')
                                 @if(Auth::user()->emp_id == $followup_data['employee_id'])
                              <tr>
                                 <td style="text-transform:uppercase">{{ date('d-m-Y', strtotime($followup_data['date'])) }}</td>
                                 <td style="text-transform:uppercase">{{ $followup_data['customer'] }}</td>
                                 <td style="text-transform:uppercase">{{ $followup_data['product'] }}</td>
                                 <td style="text-transform:uppercase">{{ $followup_data['description'] }}</td>
                                 <td style="text-transform:uppercase">{{ date('d M Y', strtotime($followup_data['next_call_date'])) }}</td>
                                 <td style="text-transform:uppercase">
                                    <ul class="list-unstyled hstack gap-1 mb-0">
                                       <li>
                                       <a class="badge bg-warning-light" href="#edit{{ $followup_data['unique_key'] }}" data-bs-toggle="modal"
                                          data-bs-target=".followup_edit-modal-xl{{ $followup_data['unique_key'] }}" style="color: #28084b;">Edit</a>
                                       </li>
                                       <li>
                                          <a href="#delete{{ $followup_data['unique_key'] }}" data-bs-toggle="modal"
                                          data-bs-target=".followupdelete-modal-xl{{ $followup_data['unique_key'] }}" class="badge bg-danger-light" style="color: #28084b;">Delete</a>
                                       </li>
                                    </ul>

                                 </td>
                              </tr>

                              <div class="modal fade followup_edit-modal-xl{{ $followup_data['unique_key'] }}"
                                    tabindex="-1" role="dialog" data-bs-backdrop="static"
                                    aria-labelledby="followup_editLargeModalLabel{{ $followup_data['unique_key']}}"
                                    aria-hidden="true">
                                    @include('page.backend.followup.edit')
                              </div>
                              <div class="modal fade followupdelete-modal-xl{{ $followup_data['unique_key'] }}"
                                    tabindex="-1" role="dialog"data-bs-backdrop="static"
                                    aria-labelledby="followupdeleteLargeModalLabel{{ $followup_data['unique_key'] }}"
                                    aria-hidden="true">
                                    @include('page.backend.followup.delete')
                              </div>

                                 @endif
                              @else


                              <tr>
                                 <td style="text-transform:uppercase">{{ date('d-m-Y', strtotime($followup_data['date'])) }}</td>
                                 <td style="text-transform:uppercase">{{ $followup_data['customer'] }}</td>
                                 <td style="text-transform:uppercase">{{ $followup_data['product'] }}</td>
                                 <td style="text-transform:uppercase">{{ $followup_data['employee'] }}</td>
                                 <td style="text-transform:uppercase">{{ $followup_data['description'] }}</td>
                                 <td style="text-transform:uppercase">{{ date('d M Y', strtotime($followup_data['next_call_date'])) }}</td>
                                 <td style="text-transform:uppercase">
                                    <ul class="list-unstyled hstack gap-1 mb-0">
                                       <li>
                                       <a class="badge bg-warning-light" href="#edit{{ $followup_data['unique_key'] }}" data-bs-toggle="modal"
                                          data-bs-target=".followup_edit-modal-xl{{ $followup_data['unique_key'] }}" style="color: #28084b;">Edit</a>
                                       </li>
                                       <li>
                                          <a href="#delete{{ $followup_data['unique_key'] }}" data-bs-toggle="modal"
                                          data-bs-target=".followupdelete-modal-xl{{ $followup_data['unique_key'] }}" class="badge bg-danger-light" style="color: #28084b;">Delete</a>
                                       </li>
                                    </ul>

                                 </td>
                              </tr>

                              <div class="modal fade followup_edit-modal-xl{{ $followup_data['unique_key'] }}"
                                    tabindex="-1" role="dialog" data-bs-backdrop="static"
                                    aria-labelledby="followup_editLargeModalLabel{{ $followup_data['unique_key']}}"
                                    aria-hidden="true">
                                    @include('page.backend.followup.edit')
                              </div>
                              <div class="modal fade followupdelete-modal-xl{{ $followup_data['unique_key'] }}"
                                    tabindex="-1" role="dialog"data-bs-backdrop="static"
                                    aria-labelledby="followupdeleteLargeModalLabel{{ $followup_data['unique_key'] }}"
                                    aria-hidden="true">
                                    @include('page.backend.followup.delete')
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



      <div class="modal fade followup-modal-xl" tabindex="-1" role="dialog" aria-labelledby="followupLargeModalLabel"
            aria-hidden="true" data-bs-backdrop="static">
            @include('page.backend.followup.create')
        </div>



   </div>
</div>
@endsection
