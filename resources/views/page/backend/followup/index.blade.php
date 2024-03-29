@extends('layout.backend.auth')

@section('content')

<div class="page-wrapper">
   <div class="content container-fluid">

      <div class="page-header">
         <div class="content-page-header">
            <h6 >Day By Day - Follow Up</h6>
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
                        <a class="btn btn-primary" data-bs-toggle="modal"  data-bs-target=".customerfollowup-modal-xl">
                              <i class="fa fa-plus-circle me-2" aria-hidden="true"></i>Customer</a>
                        </li>
                        <li>
                            <a class="btn btn-danger" data-bs-toggle="modal"  data-bs-target=".leadfollowup-modal-xl">
                                  <i class="fa fa-plus-circle me-2" aria-hidden="true"></i>Lead</a>
                            </li>
                     </ul>
                  </div>

               </div>
         </div>
      </div>


      <ul class="nav nav-tabs nav-tabs-solid nav-tabs-rounded">
         <li class="nav-item"><a class="nav-link active" href="#solid-tab1" data-bs-toggle="tab">LEAD</a></li>
         <li class="nav-item"><a class="nav-link" href="#solid-tab2" data-bs-toggle="tab">CUSTOMER</a></li>
      </ul>
      <div class="tab-content">
            <div class="tab-pane show active" id="solid-tab1">

                  <div class="card">
                     <div class="card-body">
                        <div class="table-responsive">
                           <table class="table table-center table-hover datatable table-striped">
                              <thead class="thead-light">
                                 <tr>
                                    <th style="width:15%;">S.No</th>
                                    <th style="width:15%;">Lead</th>
                                    <th style="width:10%;">Product</th>
                                    @if(Auth::user()->role != 'Admin')
                                       <th style="width:15%;">Employee</th>
                                    @endif
                                    <th style="width:15%;">Description</th>
                                    <th style="width:10%;">Next Call Date</th>
                                    <th style="width:20%;">Action</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 @php  $i=1; @endphp
                              @foreach ($leadfollowupdata as $keydata => $followup_data)
                                    @if(Auth::user()->role == 'Admin')
                                       @if(Auth::user()->emp_id == $followup_data['employee_id'])
                                       

                                          <tr>
                                             <td>{{ $i }}</td>
                                             <td >{{ $followup_data['leadname'] }}</td>

                                             <td >{{ $followup_data['product'] }}</td>
                                             <td >{{ $followup_data['description'] }}</td>
                                             <td >{{ date('d M Y', strtotime($followup_data['next_call_date'])) }}</td>
                                             <td >
                                                <ul class="list-unstyled hstack gap-1 mb-0">
                                                   <li>
                                                   <a class="badge" href="#edit{{ $followup_data['unique_key'] }}" data-bs-toggle="modal"
                                                      data-bs-target=".followup_edit-modal-xl{{ $followup_data['unique_key'] }}" style="color: white;background: #86ad25;">Edit</a>
                                                   </li>
                                                </ul>

                                             </td>
                                          </tr>

                                          <div class="modal fade followup_edit-modal-xl{{ $followup_data['unique_key'] }}"
                                               role="dialog" data-bs-backdrop="static"
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
                                          <td>{{ $i }}</td>
                                          <td >{{ $followup_data['leadname'] }}</td>
                                          <td >{{ $followup_data['product'] }}</td>
                                          <td >{{ $followup_data['employee'] }}</td>
                                          <td >{{ $followup_data['description'] }}</td>
                                          <td >{{ date('d M Y', strtotime($followup_data['next_call_date'])) }}</td>
                                          <td >
                                             <ul class="list-unstyled hstack gap-1 mb-0">
                                                <li>
                                                <a class="badge" style="color:#28084b;background: #86ad25;" href="#edit{{ $followup_data['unique_key'] }}" data-bs-toggle="modal"
                                                   data-bs-target=".followup_edit-modal-xl{{ $followup_data['unique_key'] }}">Edit</a>
                                                </li>
                                                <li>
                                                   <a href="#delete{{ $followup_data['unique_key'] }}" data-bs-toggle="modal"
                                                   data-bs-target=".followupdelete-modal-xl{{ $followup_data['unique_key'] }}" class="badge bg-danger-light" style="color: white;">Delete</a>
                                                </li>
                                             </ul>

                                          </td>
                                       </tr>

                                       <div class="modal fade followup_edit-modal-xl{{ $followup_data['unique_key'] }}"
                                              role="dialog" data-bs-backdrop="static"
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
                              @php $i++; @endphp 
                              @endforeach


                              </tbody>
                           </table>
                        </div>
                     </div>
                  </div>

            </div>


            
            <div class="tab-pane" id="solid-tab2">

                  <div class="card">
                     <div class="card-body">
                        <div class="table-responsive">
                           <table class="table table-center table-hover datatable table-striped">
                              <thead class="thead-light">
                                 <tr>
                                    <th style="width:15%;">S.No</th>
                                    <th style="width:15%;">Customer</th>
                                    <th style="width:10%;">Product</th>
                                    @if(Auth::user()->role != 'Admin')
                                       <th style="width:15%;">Employee</th>
                                    @endif
                                    <th style="width:15%;">Description</th>
                                    <th style="width:10%;">Next Call Date</th>
                                    <th style="width:20%;">Action</th>
                                 </tr>
                              </thead>
                              <tbody>
                              @php  $j=1; @endphp
                              @foreach ($customerfollowupdata as $keydata => $followup_data)
                                    @if(Auth::user()->role == 'Admin')
                                       @if(Auth::user()->emp_id == $followup_data['employee_id'])
                                       

                                          <tr>
                                             <td>{{ $j }}</td>
                                             <td >{{ $followup_data['customer'] }}</td>

                                             <td >{{ $followup_data['product'] }}</td>
                                             <td >{{ $followup_data['description'] }}</td>
                                             <td >{{ date('d M Y', strtotime($followup_data['next_call_date'])) }}</td>
                                             <td >
                                                <ul class="list-unstyled hstack gap-1 mb-0">
                                                   <li>
                                                   <a class="badge" href="#edit{{ $followup_data['unique_key'] }}" data-bs-toggle="modal"
                                                      data-bs-target=".followup_edit-modal-xl{{ $followup_data['unique_key'] }}" style="color: white;background: #86ad25;">Edit</a>
                                                   </li>
                                                </ul>

                                             </td>
                                          </tr>

                                          <div class="modal fade followup_edit-modal-xl{{ $followup_data['unique_key'] }}"
                                                 role="dialog" data-bs-backdrop="static"
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
                                          <td>{{ $j }}</td>
                                          <td >{{ $followup_data['customer'] }}</td>
                                          <td >{{ $followup_data['product'] }}</td>
                                          <td >{{ $followup_data['employee'] }}</td>
                                          <td >{{ $followup_data['description'] }}</td>
                                          <td >{{ date('d M Y', strtotime($followup_data['next_call_date'])) }}</td>
                                          <td >
                                             <ul class="list-unstyled hstack gap-1 mb-0">
                                                <li>
                                                <a class="badge" style="color:#28084b;background: #86ad25;" href="#edit{{ $followup_data['unique_key'] }}" data-bs-toggle="modal"
                                                   data-bs-target=".followup_edit-modal-xl{{ $followup_data['unique_key'] }}">Edit</a>
                                                </li>
                                                <li>
                                                   <a href="#delete{{ $followup_data['unique_key'] }}" data-bs-toggle="modal"
                                                   data-bs-target=".followupdelete-modal-xl{{ $followup_data['unique_key'] }}" class="badge bg-danger-light" style="color: white;">Delete</a>
                                                </li>
                                             </ul>

                                          </td>
                                       </tr>

                                       <div class="modal fade followup_edit-modal-xl{{ $followup_data['unique_key'] }}"
                                             role="dialog" data-bs-backdrop="static"
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
                                 @php $j++; @endphp 
                              @endforeach
                              
                              </tbody>
                           </table>
                        </div>
                     </div>
                  </div>
            </div>
      </div>
               



      <div class="modal fade customerfollowup-modal-xl"  role="dialog" aria-labelledby="customerfollowupLargeModalLabel"
            aria-hidden="true" data-bs-backdrop="static">
            @include('page.backend.followup.create')
        </div>

        <div class="modal fade leadfollowup-modal-xl"  role="dialog" aria-labelledby="leadfollowupLargeModalLabel"
            aria-hidden="true" data-bs-backdrop="static">
            @include('page.backend.followup.leadfollowupcreate')
        </div>



   </div>
</div>
@endsection
