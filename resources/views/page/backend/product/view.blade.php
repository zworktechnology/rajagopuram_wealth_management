@extends('layout.backend.auth')

@section('content')

<div class="page-wrapper">
   <div class="content container-fluid">

      <div class="page-header">
         <div class="content-page-header">
            <h6 style="text-transform:uppercase">{{$Getproduct->name}} -  {{$productcounts}}</h6>
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
                                 <th style="width:15%;text-transform:uppercase">Customer</th>
                                 <th style="width:15%;text-transform:uppercase">Date</th>
                                 <th style="width:15%;text-transform:uppercase">Starting Date</th>
                                 <th style="width:15%;text-transform:uppercase">Ending Date</th>
                                 <th style="width:20%;text-transform:uppercase">Staff</th>
                              </tr>
                           </thead>
                           <tbody>
                           @foreach ($customer_list as $keydata => $customer_lists)
                              <tr>
                                 <td style="text-transform:uppercase">{{ ++$keydata }}</td>
                                 <td style="text-transform:uppercase">{{ $customer_lists['customer'] }}</td>
                                 <td>{{ date('d-m-Y', strtotime($customer_lists['date'])) }}</td>
                                 <td style="text-transform:uppercase">{{ date('d M Y', strtotime($customer_lists['starting_date'])) }}</td>
                                 <td style="text-transform:uppercase">{{ date('d M Y', strtotime($customer_lists['ending_date'])) }}</td>
                                 <td style="text-transform:uppercase">{{ $customer_lists['employee'] }}</td>
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