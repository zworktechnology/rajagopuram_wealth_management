@extends('layout.backend.auth')

@section('content')

<div class="page-wrapper">
   <div class="content container-fluid">

      <div class="page-header">
         <div class="content-page-header">
            <h6 >{{$Getproduct->name}} -  {{$productcounts}}</h6>
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
                                 <th style="width:5%;">S.No</th>
                                 <th style="width:15%;">Customer</th>
                                 <th style="width:15%;">Date</th>
                                 <th style="width:15%;">Starting Date</th>
                                 <th style="width:15%;">Ending Date</th>
                                 <th style="width:20%;">Staff</th>
                              </tr>
                           </thead>
                           <tbody>
                           @foreach ($customer_list as $keydata => $customer_lists)
                              <tr>
                                 <td >{{ ++$keydata }}</td>
                                 <td >{{ $customer_lists['customer'] }}</td>
                                 <td>{{ date('d-m-Y', strtotime($customer_lists['date'])) }}</td>
                                 <td >{{ date('d M Y', strtotime($customer_lists['starting_date'])) }}</td>
                                 <td >{{ date('d M Y', strtotime($customer_lists['ending_date'])) }}</td>
                                 <td >{{ $customer_lists['employee'] }}</td>
                              </tr>
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
