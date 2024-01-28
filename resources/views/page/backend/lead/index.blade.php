@extends('layout.backend.auth')

@section('content')

<div class="page-wrapper">
   <div class="content container-fluid">

      <div class="page-header">
         <div class="content-page-header">
            <h6 >Leads</h6>
               <div class="list-btn">
                  <div style="display:flex;">
                     <ul class="filter-list">
                        <li>
                        <a class="btn btn-primary"  data-bs-toggle="modal" data-bs-target=".lead-modal-xl">
                              <i class="fa fa-plus-circle me-2" aria-hidden="true"></i>Add Leads</a>
                        </li>
                     </ul>
                  </div>

               </div>


         </div>
      </div>

      <div class="row">
         <div class="col-sm-12">
               <div class="profile-picture">

                              <form id="csvimport_form" method="POST" action="{{ route('lead.excel_import') }}" enctype="multipart/form-data" class="form-horizontal">
                              @csrf
                                 <div style="display:flex;">
						                  <div class="upload-profile">
                                            <div class="add-profile" style="display:flex;">
                                                <p>Import CSV <span style="color: red">*</span></p>
														<input type="file" name="lead_file" id="lead_file" class="form-control" readonly/>
													</div>
												</div>
												<div class="img-upload">
                                       <input type="hidden" name="hidden_field" value="1" />
                                          <input type="submit" name="import" id="import" class="btn btn-info" value="Import Leads" />
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
                                 <th style="width:15%;">Date</th>
                                 <th style="width:15%;">Name</th>
                                 <th style="width:10%;">Phone No</th>
                                 <th style="width:10%;">Source From</th>
                                 @if(Auth::user()->role == 'Super-Admin')
                                 <th style="width:15%;">Hand By</th>
                                 @endif
                                 <th style="width:15%;">Last Connect</th>
                                 <th style="width:20%;">Action</th>
                              </tr>
                           </thead>
                           <tbody>
                           @foreach ($Lead_data as $keydata => $Lead_datas)
                              @if($Lead_datas['status'] == '0')
                              <tr>
                                 <td >{{ $Lead_datas['date'] }}</td>
                                 <td >{{ $Lead_datas['name'] }}</td>
                                 <td >{{ $Lead_datas['phonenumber'] }}</td>
                                 <td >{{ $Lead_datas['source_from'] }}</td>
                                 @if(Auth::user()->role == 'Super-Admin')
                                 <td >{{ $Lead_datas['employee'] }}</td>
                                 @endif
                                 <td >01.01.2024</td>
                                 <td >
                                    <ul class="list-unstyled hstack gap-1 mb-0">
                                        <li>
                                            <a class="badge" href="#edit{{ $Lead_datas['id'] }}" data-bs-toggle="modal"
                                               data-bs-target=".lead_edit-modal-xl{{ $Lead_datas['id'] }}" style="color: white; background: #095255;">D by D</a>
                                            </li>
                                       <li>
                                       <a class="badge bg-warning-light" href="#edit{{ $Lead_datas['id'] }}" data-bs-toggle="modal"
                                          data-bs-target=".lead_edit-modal-xl{{ $Lead_datas['id'] }}" style="color: white;">Edit</a>
                                       </li>
                                       @if(Auth::user()->role == 'Super-Admin')
                                       <li>
                                          <a href="#delete{{ $Lead_datas['id'] }}" data-bs-toggle="modal"
                                          data-bs-target=".leaddelete-modal-xl{{ $Lead_datas['id'] }}" class="badge bg-danger-light" style="color: white;">Delete</a>
                                       </li>
                                       @endif
                                       <li>
                                          <a href="{{ route('lead.move', ['id' => $Lead_datas['id']]) }}"
                                                   class="badge bg-success" style="color:#eee;">L to C</a>
                                       </li>
                                    </ul>

                                 </td>
                              </tr>

                              <div class="modal fade lead_edit-modal-xl{{ $Lead_datas['id'] }}"
                                    tabindex="-1" role="dialog" data-bs-backdrop="static"
                                    aria-labelledby="lead_editLargeModalLabel{{ $Lead_datas['id'] }}"
                                    aria-hidden="true">
                                    @include('page.backend.lead.edit')
                              </div>
                              <div class="modal fade leaddelete-modal-xl{{ $Lead_datas['id'] }}"
                                    tabindex="-1" role="dialog"data-bs-backdrop="static"
                                    aria-labelledby="leaddeleteLargeModalLabel{{ $Lead_datas['id'] }}"
                                    aria-hidden="true">
                                    @include('page.backend.lead.delete')
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

      <div class="modal fade lead-modal-xl" tabindex="-1" role="dialog" aria-labelledby="leadLargeModalLabel"
            aria-hidden="true" data-bs-backdrop="static">
            @include('page.backend.lead.create')
        </div>




   </div>
</div>
@endsection
