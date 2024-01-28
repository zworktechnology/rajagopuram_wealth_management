@extends('layout.backend.auth')

@section('content')
    <div class="page-wrapper card-body">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="content-page-header">
                    <h6 >{{$EmployeeData->name}} -  <span style="color: #212529;font-size: 17px;font-weight: 500;"> {{$from_date}} - {{$to_date}} </span></h6>
                    <div class="list-btn">
                        <div style="display:flex;">
                           <div class="page-btn">
                              <div style="display: flex;">
                                    <form autocomplete="off" method="POST" action="{{ route('employee.datefilter') }}">
                                        @method('PUT')
                                        @csrf
                                        <div style="display: flex">
                                            <div style="margin-right: 10px;"><input type="date" name="from_date"
                                                    class="form-control from_date" ></div>
                                             <div style="margin-right: 10px;"><input type="date" name="to_date"
                                                    class="form-control to_date"></div>
                                                    <input type="hidden" name="employee_id" value="{{$EmployeeData->id}}"/>
                                            <div style="margin-right: 10px;"><input type="submit" class="btn btn-success"
                                                    value="Search" /></div>
                                        </div>
                                    </form>
                              </div>
                           </div>
                        </div>
                     </div>
                </div>




            <div class="row">
						<div class="col-xl-4 col-sm-6 col-12">
							<div class="card" style="background: #dde8af;">
								<div class="card-body">
									<div class="dash-widget-header">
                              <span class="dash-widget-icon bg-2">
											<i class="fas fa-users"></i>
										</span>
										<div class="dash-count">
											<div class="dash-title" style=";">Handled Customers Count</div>
											<div class="dash-counts">
												<p>{{$total_customer}}</p>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-4 col-sm-6 col-12">
							<div class="card" style="background: #c8bedd;">
								<div class="card-body">
									<div class="dash-widget-header">
                              <span class="dash-widget-icon bg-3">
											<i class="fas fa-file-alt"></i>
										</span>
										<div class="dash-count">
											<div class="dash-title" style=";">Handled Lead Count</div>
											<div class="dash-counts">
												<p >{{$total_lead}}</p>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-4 col-sm-6 col-12">
							<div class="card" style="background: #afd1d585;">
								<div class="card-body">
									<div class="dash-widget-header">
                              <span class="dash-widget-icon bg-2">
											<i class="fas fa-users"></i>
										</span>
										<div class="dash-count">
											<div class="dash-title" style=";">Handled Lead to Customers Count</div>
											<div class="dash-counts">
												<p>{{$total_handled_leadtocustomer}}</p>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

               <ul class="nav nav-tabs nav-tabs-solid nav-tabs-rounded">
                  <li class="nav-item"><a class="nav-link active" href="#solid-tab1" data-bs-toggle="tab">CUSTOMERS</a></li>
                  <li class="nav-item"><a class="nav-link" href="#solid-tab2" data-bs-toggle="tab">LEADS</a></li>
                  <li class="nav-item"><a class="nav-link" href="#solid-tab3" data-bs-toggle="tab">LEAD TO CUSTOMERS</a></li>
               </ul>
               <div class="tab-content">
                  <div class="tab-pane show active" id="solid-tab1">

                        <div class="card">
                           <div class="card-body">
                              <div class="table-responsive">
                                 <table class="table table-center table-hover datatable table-striped">
                                    <thead class="thead-light">
                                       <tr>
                                          <th style="width:5%;">S.No</th>
                                          <th style="width:15%;">Followup Date</th>
                                          <th style="width:15%;">Customer</th>
                                          <th style="width:15%;">Product</th>
                                          <th style="width:15%;">Description</th>
                                          <th style="width:20%;">Starting Date - Ending Date</th>
                                       </tr>
                                    </thead>
                                    @foreach ($followupdata as $keydata => $followupdatas)
                                       <tr>
                                          <td >{{ ++$keydata }}</td>
                                          <td >{{ date('d-m-Y', strtotime($followupdatas['date'])) }}</td>
                                          <td >{{ $followupdatas['customer'] }}</td>
                                          <td >{{ $followupdatas['product'] }}</td>
                                          <td >{{ $followupdatas['description'] }}</td>
                                          <td >{{ date('d M Y', strtotime($followupdatas['starting_date'])) }} - {{ date('d M Y', strtotime($followupdatas['ending_date'])) }}</td>
                                          </td>
                                       </tr>
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
                                          <th style="width:5%;">S.No</th>
                                          <th style="width:15%;">Lead Date</th>
                                          <th style="width:15%;">Name</th>
                                          <th style="width:15%;">Phone Number</th>
                                          <th style="width:15%;">Source From</th>
                                       </tr>
                                    </thead>
                                    @foreach ($Lead_data as $keydata => $Lead_datas)
                                       <tr>
                                          <td >{{ ++$keydata }}</td>
                                          <td >{{ date('d-m-Y', strtotime($Lead_datas['date'])) }}</td>
                                          <td >{{ $Lead_datas['name'] }}</td>
                                          <td >{{ $Lead_datas['phonenumber'] }}</td>
                                          <td >{{ $Lead_datas['source_from'] }}</td>
                                          </td>
                                       </tr>
                                       @endforeach
                                    </tbody>

                                 </table>
                              </div>
                           </div>
                        </div>

                  </div>
                  <div class="tab-pane" id="solid-tab3">

                        <div class="card">
                           <div class="card-body">
                              <div class="table-responsive">
                                 <table class="table table-center table-hover datatable table-striped">
                                    <thead class="thead-light">
                                       <tr>
                                          <th style="width:5%;">S.No</th>
                                          <th style="width:15%;">Moved Date</th>
                                          <th style="width:15%;">Customer</th>
                                          <th style="width:15%;">Product</th>
                                          <th style="width:15%;">Starting Date - Ending Date</th>
                                          <th style="width:15%;">Source From</th>
                                          <th style="width:15%;">Phone Number</th>
                                       </tr>
                                    </thead>
                                    @foreach ($Leadtocustomer_data as $keydata => $Leadtocustomer_dataS)
                                       <tr>
                                          <td >{{ ++$keydata }}</td>
                                          <td >{{ date('d-m-Y', strtotime($Leadtocustomer_dataS['moved_date'])) }}</td>
                                          <td >{{ $Leadtocustomer_dataS['name'] }}</td>
                                          <td >{{ $Leadtocustomer_dataS['productname'] }}</td>
                                          <td >{{ $Leadtocustomer_dataS['starting_Date'] }} - {{ $Leadtocustomer_dataS['ending_Date']}}</td>
                                          <td >{{ $Leadtocustomer_dataS['source_from'] }}</td>
                                          <td >{{ $Leadtocustomer_dataS['phonenumber'] }}</td>
                                          </td>
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
@endsection
