@extends('layout.backend.auth')

@section('content')

<div class="page-wrapper">
   <div class="content container-fluid">

      <div class="page-header">
         <div class="content-page-header">
            <h6 style="text-transform:uppercase">Employee</h6>
               <div class="list-btn">
                  <div style="display:flex;">
                     <ul class="filter-list">
                        <li>
                        <a class="btn btn-primary" data-bs-toggle="modal" style="text-transform:uppercase" data-bs-target=".employee-modal-xl">
                              <i class="fa fa-plus-circle me-2" aria-hidden="true"></i>Add Employee</a>
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
                                 <th style="width:5%;text-transform:uppercase">S.No</th>
                                 <th style="width:15%;text-transform:uppercase">Employee</th>
                                 <th style="width:15%;text-transform:uppercase">Address</th>
                                 <th style="width:15%;text-transform:uppercase">Phone No</th>
                                 <th style="width:15%;text-transform:uppercase">Email</th>
                                 <th style="width:20%;text-transform:uppercase">Action</th>
                              </tr>
                           </thead>
                            
                           @foreach ($data as $keydata => $employee_data)
                              <tr>
                                 <td style="text-transform:uppercase">{{ ++$keydata }}</td>
                                 <td style="text-transform:uppercase">{{ $employee_data->name }}</td>
                                 <td style="text-transform:uppercase">{{ $employee_data->address }}</td>
                                 <td style="text-transform:uppercase">{{ $employee_data->phonenumber }}</td>
                                 <td style="text-transform:uppercase">{{ $employee_data->email_id }}</td>
                                 <td style="text-transform:uppercase">
                                    <ul class="list-unstyled hstack gap-1 mb-0">
                                       <li>
                                          <a href="{{ route('employee.view', ['id' => $employee_data->id]) }}"
                                                   class="badge" style="color: #f8f9fa;background: #8068dc;text-transform:uppercase">View</a>
                                       </li>
                                       <li>
                                       <a class="badge bg-warning-light" href="#edit{{ $employee_data->unique_key }}" data-bs-toggle="modal"
                                          data-bs-target=".employeeedit-modal-xl{{ $employee_data->unique_key }}" style="color: #28084b;">Edit</a>
                                       </li>
                                       <li>
                                          <a href="#delete{{ $employee_data->unique_key }}" data-bs-toggle="modal"
                                          data-bs-target=".employeedelete-modal-xl{{ $employee_data->unique_key }}" class="badge bg-danger-light" style="color: #28084b;">Delete</a>
                                       </li>
                                    </ul>
                                 
                                 </td>
                              </tr>

                              <div class="modal fade employeeedit-modal-xl{{ $employee_data->unique_key }}"
                                    tabindex="-1" role="dialog" data-bs-backdrop="static"
                                    aria-labelledby="employeeeditLargeModalLabel{{ $employee_data->unique_key }}"
                                    aria-hidden="true">
                                    @include('page.backend.employee.edit')
                              </div>
                              <div class="modal fade employeedelete-modal-xl{{ $employee_data->unique_key }}"
                                    tabindex="-1" role="dialog"data-bs-backdrop="static"
                                    aria-labelledby="employeedeleteLargeModalLabel{{ $employee_data->unique_key }}"
                                    aria-hidden="true">
                                    @include('page.backend.employee.delete')
                              </div>
                           @endforeach
                           </tbody>
                        </table>
                     </div>
                  </div>
               
            </div>
         </div>


      </div>



      <div class="modal fade employee-modal-xl" tabindex="-1" role="dialog" aria-labelledby="employeeLargeModalLabel"
            aria-hidden="true" data-bs-backdrop="static">
            @include('page.backend.employee.create')
        </div>



   </div>
</div>
@endsection