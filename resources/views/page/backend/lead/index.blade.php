@extends('layout.backend.auth')

@section('content')

<div class="page-wrapper">
   <div class="content container-fluid">

      <div class="page-header">
         <div class="content-page-header">
            <h6 style="text-transform:uppercase">Leads</h6>
               <div class="list-btn">
                  <div style="display:flex;">
                     <ul class="filter-list">
                        <li>
                        <a class="btn btn-primary" style="text-transform:uppercase" data-bs-toggle="modal" data-bs-target=".lead-modal-xl">
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
													<div class="add-profile">
														<input type="file" name="lead_file" id="lead_file" class="form-control"/>
													</div>
												</div>
												<div class="img-upload">
                                       <input type="hidden" name="hidden_field" value="1" />
                                          <input type="submit" name="import" id="import" class="btn btn-info" value="Import" />
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
                              <th style="width:15%;text-transform:uppercase">S.No</th>
                                 <th style="width:15%;text-transform:uppercase">Date</th>
                                 <th style="width:15%;text-transform:uppercase">Name</th>
                                 <th style="width:15%;text-transform:uppercase">Staff</th>
                                 <th style="width:15%;text-transform:uppercase">Phone No</th>
                                 <th style="width:15%;text-transform:uppercase">Source From</th>
                                 <th style="width:20%;text-transform:uppercase">Action</th>
                              </tr>
                           </thead>
                           <tbody>
                           @foreach ($Lead_data as $keydata => $Lead_datas)
                              @if($Lead_datas['status'] == '0')
                              <tr>
                              <td>{{ ++$keydata }}</td>
                                 <td style="text-transform:uppercase">{{ date('d-m-Y', strtotime($Lead_datas['date'])) }}</td>
                                 <td style="text-transform:uppercase">{{ $Lead_datas['employee'] }}</td>
                                 <td style="text-transform:uppercase">{{ $Lead_datas['employee'] }}</td>
                                 <td style="text-transform:uppercase">{{ $Lead_datas['phonenumber'] }}</td>
                                 <td style="text-transform:uppercase">{{ $Lead_datas['source_from'] }}</td>
                                 <td style="text-transform:uppercase">
                                    <ul class="list-unstyled hstack gap-1 mb-0">
                                       <li>
                                       <a class="badge bg-warning-light" href="#edit{{ $Lead_datas['id'] }}" data-bs-toggle="modal"
                                          data-bs-target=".lead_edit-modal-xl{{ $Lead_datas['id'] }}" style="color: #28084b;">Edit</a>
                                       </li>
                                       <li>
                                          <a href="#delete{{ $Lead_datas['id'] }}" data-bs-toggle="modal"
                                          data-bs-target=".leaddelete-modal-xl{{ $Lead_datas['id'] }}" class="badge bg-danger-light" style="color: #28084b;">Delete</a>
                                       </li>
                                       <li>
                                          <a href="{{ route('lead.move', ['id' => $Lead_datas['id']]) }}"
                                                   class="badge bg-success" style="color:#eee;text-transform:uppercase">Lead to Customer</a>
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