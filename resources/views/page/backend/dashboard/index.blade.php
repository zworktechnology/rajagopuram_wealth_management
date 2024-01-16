@extends('layout.backend.auth')

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

                <div class="page-header">
                    <div class="content-page-header">
                        <div class="page-title">
                            <h4  style="text-transform:uppercase">Dashboard</h4>
                        </div>

                        <div class="page-btn">
                            <div style="display: flex;">
                                    <form autocomplete="off" method="POST" action="{{ route('home.datefilter') }}">
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
                    </div>
                </div>
            <div class="row">


            @if(Auth::user()->role == 'Super-Admin')
                <div class="col-xl-4 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{ route('employee.index') }}"><div class="dash-widget-header">
                                <span class="dash-widget-icon bg-1">
                                    <i class="far fa-user"></i>
                                </span>
                                <div class="dash-count">
                                    <div class="dash-title"  style="text-transform:uppercase">Total Employees</div>
                                    <div class="dash-counts"  style="text-transform:uppercase">
                                        <p> {{$total_Employee}}</p>
                                    </div>
                                </div>
                            </div></a>
                        </div>
                    </div>
                </div>
                @endif
                <div class="col-xl-4 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{ route('customer.index') }}"><div class="dash-widget-header">
                                <span class="dash-widget-icon bg-2">
                                    <i class="fas fa-user"></i>
                                </span>
                                <div class="dash-count">
                                    <div class="dash-title" style="text-transform:uppercase">Total Customers</div>
                                    <div class="dash-counts" style="text-transform:uppercase">
                                        <p>{{$total_Customer}}</p>
                                    </div>
                                </div>
                            </div></a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-sm-6 col-12">
                    <div class="card" >
                        <div class="card-body">
                            <a href="{{ route('product.index') }}"><div class="dash-widget-header">
                                <span class="dash-widget-icon bg-3">
                                    <i class="fas fa-user"></i>
                                </span>
                                <div class="dash-count">
                                    <div class="dash-title" style="text-transform:uppercase">Total Products</div>
                                    <div class="dash-counts" style="text-transform:uppercase">
                                        <p> {{$total_Product}}</p>
                                    </div>
                                </div>
                            </div></a>
                        </div>
                    </div>
                </div>
            </div>



            <div class="row">
                {{-- <div class="col-md-6 col-sm-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-center">
                                <div class="col">
                                    <h5 class="card-title" style="text-transform:uppercase"> Bills</h5>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-stripped table-hover border">

                                    <thead class="thead-light ">

                                        <tr>
                                            <th class="border">Customer</th>
                                            <th class="border">Product</th>
                                            @if(Auth::user()->role != 'Admin')
                                            <th class="border">Employee</th>
                                            @endif
                                            <th class="border">Starting - Ending Date</th>
                                        </tr>
                                    </thead>
                                    <tbody >
                                    @foreach ($Billingdata as $keydata => $billingdata)
                                        @if(Auth::user()->role == 'Admin')
                                            @if(Auth::user()->emp_id == $billingdata['employee_id'])
                                        <tr>
                                            <td class="border" style="font-weight: 700;">{{ $billingdata['customer'] }}</td>
                                            <td class="border">{{ $billingdata['product'] }}</td>
                                            <td class="border">{{ date('d M Y', strtotime($billingdata['starting_date'])) }} - {{ date('d M Y', strtotime($billingdata['ending_date'])) }}</td>
                                        </tr>
                                            @endif
                                        @else
                                        <tr>
                                            <td class="border" style="font-weight: 700;">{{ $billingdata['customer'] }}</td>
                                            <td class="border">{{ $billingdata['product'] }}</td>
                                            <td class="border" style="color: red;">{{ $billingdata['employee'] }}</td>
                                            <td class="border">{{ date('d M Y', strtotime($billingdata['starting_date'])) }} - {{ date('d M Y', strtotime($billingdata['ending_date'])) }}</td>
                                        </tr>
                                        @endif
                                        @endforeach

                                    </tbody>




                                </table>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <div class="col-md-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-center">
                                <div class="col">
                                    <h5 class="card-title" style="text-transform:uppercase">Today Followups</h5>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-center table-hover datatable table-striped">
                                    <thead class="thead-light">
                                        <tr>
                                            <th class="" style="text-transform:uppercase">PreviousCall Date</th>
                                            <th class="" style="text-transform:uppercase">Customer</th>
                                            <th class="" style="text-transform:uppercase">Phone Number</th>
                                            @if(Auth::user()->role != 'Admin')
                                            <th class="" style="text-transform:uppercase">Employee</th>
                                            @endif
                                            <th class="" style="text-transform:uppercase">Product</th>
                                            <th class="" style="text-transform:uppercase">Call Details</th>
                                            <th class="" style="text-transform:uppercase">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($followupdata as $keydata => $followupdatas)
                                        @if(Auth::user()->role == 'Admin')
                                            @if(Auth::user()->emp_id == $followupdatas['employee_id'])
                                            <tr>
                                                <td class="" style="text-transform:uppercase">{{ date('d M Y', strtotime($followupdatas['date'])) }}</td>
                                                <td class="" style="text-transform:uppercase" style="font-weight: 700;">{{ $followupdatas['customer'] }}</td>
                                                <td class="" style="text-transform:uppercase" style="font-weight: 700;">{{ $followupdatas['phonenumber'] }}</td>
                                                <td class="" style="text-transform:uppercase" style="font-weight: 700;">{{ $followupdatas['product'] }}</td>
                                                <td class="" style="text-transform:uppercase">{{ $followupdatas['description'] }}</td>
                                                <td class="" style="text-transform:uppercase">
                                                    <a class="badge bg-warning-light" href="#followup_update{{ $followupdatas['id'] }}" data-bs-toggle="modal"
                                                        data-bs-target=".followup_update-modal-xl{{ $followupdatas['id'] }}" style="color: #28084b;">Update</a>
                                                </td>
                                            </tr>
                                            @endif
                                        @else
                                            <tr>
                                                <td class="" style="text-transform:uppercase">{{ date('d M Y', strtotime($followupdatas['date'])) }}</td>
                                                <td class="" style="font-weight: 700;text-transform:uppercase">{{ $followupdatas['customer'] }}</td>
                                                <td class="" style="text-transform:uppercase" style="font-weight: 700;">{{ $followupdatas['phonenumber'] }}</td>
                                                <td class="" style="color: red;text-transform:uppercase">{{ $followupdatas['employee'] }}</td>
                                                <td class="" style="text-transform:uppercase">{{ $followupdatas['product'] }}</td>
                                                <td class="" style="text-transform:uppercase">{{ $followupdatas['description'] }}</td>
                                                <td class="" style="text-transform:uppercase">
                                                <a class="badge bg-warning-light" href="#followup_update{{ $followupdatas['id'] }}" data-bs-toggle="modal"
                                                        data-bs-target=".followup_update-modal-xl{{ $followupdatas['id'] }}" style="color: #28084b;">Update</a>
                                                    </td>
                                            </tr>
                                        @endif


                                        <div class="modal fade followup_update-modal-xl{{ $followupdatas['id'] }}"
                                                tabindex="-1" role="dialog" data-bs-backdrop="static"
                                                aria-labelledby="followup_updateLargeModalLabel{{ $followupdatas['id']}}"
                                                aria-hidden="true">
                                                @include('page.backend.followup.update')
                                        </div>
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
