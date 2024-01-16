<div class="modal-dialog modal-dialog-centered modal-xl">
   <div class="modal-content">


            <div class="modal-body">
               <div class="content container-fluid">

               <div class="page-header">
						<div class="content-page-header">
							<h6 style="text-transform:uppercase">Customer Details</h6>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                           <span class="align-center" aria-hidden="true">&times;</span>
                        </button>
						</div>
                  
					</div>


               <div class="card customer-details-group">
						<div class="card-body">
							<div class="row align-items-center">					
								<div class="col-xl-3 col-lg-4 col-md-6 col-12">
									<div class="customer-details">
										<div class="d-flex align-items-center">
											<span class="customer-widget-img d-inline-flex">
												<img class="rounded-circle" src="{{ asset('assets/customer_photo/' . $customer_data['customer_photo']) }}" alt="">
											</span>
											<div class="customer-details-cont">
												<h6 style="text-transform:uppercase">{{$customer_data['name']}}</h6>
												<p style="text-transform:uppercase;color: red;">Staff - {{$customer_data['employee']}}</p>
											</div>
										</div>
									</div> 
								</div>
								<div class="col-xl-3 col-lg-4 col-md-6 col-12">
									<div class="customer-details">
										<div class="d-flex align-items-center">
											<span class="customer-widget-icon d-inline-flex">
												<i class="fe fe-mail"></i>
											</span>
											<div class="customer-details-cont">
												<h6 style="text-transform:uppercase">Email Address</h6>
												<p style="text-transform:uppercase">{{$customer_data['email_id']}}</p>
											</div>
										</div>
									</div>
								</div>
								<div class="col-xl-3 col-lg-4 col-md-6 col-12">
									<div class="customer-details">
										<div class="d-flex align-items-center">
											<span class="customer-widget-icon d-inline-flex">
												<i class="fe fe-phone"></i>
											</span>
											<div class="customer-details-cont">
												<h6 style="text-transform:uppercase">Phone Number</h6>
												<p style="text-transform:uppercase">{{$customer_data['phonenumber']}}</p>
											</div>
										</div>
									</div>
								</div>
								<div class="col-xl-3 col-lg-4 col-md-6 col-12">
									<div class="customer-details">
										<div class="d-flex align-items-center">
											<span class="customer-widget-icon d-inline-flex">
												<i class="fe fe-airplay"></i>
											</span>
											<div class="customer-details-cont">
												<h6 style="text-transform:uppercase">Alternate Phone No</h6>
												<p style="text-transform:uppercase">{{$customer_data['alter_phonenumber']}}</p>
											</div>
										</div>
									</div>
								</div>
								<div class="col-xl-3 col-lg-4 col-md-6 col-12">
									<div class="customer-details">
										<div class="d-flex align-items-center">
											<span class="customer-widget-icon d-inline-flex">
												<i class="fe fe-briefcase"></i>
											</span>
											<div class="customer-details-cont">
												<h6 style="text-transform:uppercase">Address</h6>
												<p style="text-transform:uppercase">{{$customer_data['address']}}</p>
											</div>
										</div>
									</div>
								</div>	
								<div class="col-xl-3 col-lg-4 col-md-6 col-12">
									<div class="customer-details">
										<div class="d-flex align-items-center">
											<span class="customer-widget-icon d-inline-flex">
												<i class="fe fe-briefcase"></i>
											</span>
											<div class="customer-details-cont">
												<h6 style="text-transform:uppercase">Source From</h6>
												<p style="text-transform:uppercase">{{$customer_data['source_from']}}</p>
											</div>
										</div>
									</div>
								</div>
                        <div class="col-xl-3 col-lg-4 col-md-6 col-12">
									<div class="customer-details">
										<div class="d-flex align-items-center">
											<span class="customer-widget-icon d-inline-flex">
												<i class="fe fe-briefcase"></i>
											</span>
											<div class="customer-details-cont">
												<h6 style="text-transform:uppercase">DOB</h6>
												<p style="text-transform:uppercase">{{date('d-m-Y', strtotime($customer_data['birth_date']))}}</p>
											</div>
										</div>
									</div>
								</div>
								<div class="col-xl-3 col-lg-4 col-md-6 col-12">
									<div class="customer-details">
										<div class="d-flex align-items-center">
											<span class="customer-widget-icon d-inline-flex">
												<i class="fe fe-calendar"></i>
											</span>
											<div class="customer-details-cont">
												<h6 style="text-transform:uppercase">Wedding Date</h6>
												<p style="text-transform:uppercase">{{date('d-m-Y', strtotime($customer_data['wedding_date']))}}</p>
											</div>
										</div>
									</div>
								</div>		
							</div>
						</div>
					</div>
					@if ($customer_data['prooftype_one'])
						<div class="page-header">
							<div class="content-page-header">
								<h6 style="text-transform:uppercase">Proofs List</h6>
							</div>
						</div>
										<div class="card">
                                <div class="card-body card-buttons">
                                    <div class="row">
                                        <div class="col-xl-12">

                                            <div class="row">
														  		@if ($customer_data['prooftype_one'])
                                                <div class="col-sm-3">
                                                    <img src="{{ asset('assets/proof_one/' . $customer_data['proof_one']) }}" alt="image" class="img-fluid img-thumbnail" width="200">
                                                    <p class="mb-0">
                                                        <code style="text-transform:uppercase">{{$customer_data['prooftype_one']}}</code>
                                                    </p>
                                                </div>
																@endif
																@if ($customer_data['prooftype_two'])
																<div class="col-sm-3">
                                                    <img src="{{ asset('assets/proof_two/' . $customer_data['proof_two']) }}" alt="image" class="img-fluid img-thumbnail" width="200">
                                                    <p class="mb-0">
                                                        <code style="text-transform:uppercase">{{$customer_data['prooftype_two']}}</code>
                                                    </p>
                                                </div>
																@endif
																@if ($customer_data['prooftype_three'])
																<div class="col-sm-3">
                                                    <img src="{{ asset('assets/proof_three/' . $customer_data['proof_three']) }}" alt="image" class="img-fluid img-thumbnail" width="200">
                                                    <p class="mb-0">
                                                        <code style="text-transform:uppercase">{{$customer_data['prooftype_three']}}</code>
                                                    </p>
                                                </div>
																@endif
																@if ($customer_data['prooftype_four'])
																<div class="col-sm-3">
                                                    <img src="{{ asset('assets/proof_four/' . $customer_data['proof_four']) }}" alt="image" class="img-fluid img-thumbnail" width="200">
                                                    <p class="mb-0">
                                                        <code style="text-transform:uppercase">{{$customer_data['prooftype_four']}}</code>
                                                    </p>
                                                </div>
																@endif
																@if ($customer_data['prooftype_five'])
																<div class="col-sm-3">
                                                    <img src="{{ asset('assets/proof_five/' . $customer_data['proof_five']) }}" alt="image" class="img-fluid img-thumbnail" width="200">
                                                    <p class="mb-0">
                                                        <code style="text-transform:uppercase">{{$customer_data['prooftype_five']}}</code>
                                                    </p>
                                                </div>
																@endif
                                            </div>
                                        </div> <!-- end col-->
                                    </div>
                                </div>
                            </div>
					@endif
               <div class="page-header">
						<div class="content-page-header">
							<h6 style="text-transform:uppercase">Family Details</h6>
						</div>
					</div>

                        <div class="invoice-item invoice-item-two card">
                           <div class="card-body">
                              <div class="row">

                                 <div class="col-md-4 border">
                                       <span style="vertical-align: inherit;vertical-align: inherit;font-size: 14px;color:#28084B;font-weight: 700;line-height: 35px;text-transform:uppercase ">Family Name</span>
                                 </div>
                                 <div class="col-md-2 border">
                                       <span style="vertical-align: inherit;vertical-align: inherit;font-size: 14px;color:#28084B;font-weight: 700;line-height: 35px;text-transform:uppercase ">Relationship</span>
                                 </div>
                                 <div class="col-md-3 border">
                                       <span style="vertical-align: inherit;vertical-align: inherit;font-size: 14px;color:#28084B;font-weight: 700;line-height: 35px;text-transform:uppercase ">DOB</span>
                                 </div>
                                 <div class="col-md-3 border">
                                       <span style="vertical-align: inherit;vertical-align: inherit;font-size: 14px;color:#28084B;font-weight: 700;line-height: 35px; text-transform:uppercase">Wedding Date</span>
                                 </div>

                              </div>
                              <div class="row ">
                                 @foreach ($customer_data['families'] as $index => $families)
                                    @if ($families['customer_id'] == $customer_data['id'])
                                    <div class="col-md-4 border">
                                          <span style="vertical-align: inherit;vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;line-height: 35px;text-transform:uppercase ">{{ $families['family_name'] }}</span>
                                    </div>
                                    <div class="col-md-2 border">
                                          <span style="vertical-align: inherit;vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;line-height: 35px; text-transform:uppercase">{{ $families['family_relationship'] }}</span>
                                    </div>
                                    <div class="col-md-3 border">
                                          <span style="vertical-align: inherit;vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;line-height: 35px; text-transform:uppercase">{{ date('d-m-Y', strtotime($families['family_dob'])) }}</span>
                                    </div>
                                    <div class="col-md-3 border">
                                          <span style="vertical-align: inherit;vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;line-height: 35px; text-transform:uppercase"> {{ date('d-m-Y', strtotime($families['family_weddingdate'])) }}</span>
                                    </div>
                                    @endif
                                 @endforeach
                              </div>
                           </div>
                        </div>



  

               </div>
            </div>
   </div>
</div>

           
   </div>
</div>