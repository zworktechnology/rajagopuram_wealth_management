<div class="modal-dialog modal-dialog-centered modal-xl">
   <div class="modal-content">


            <div class="modal-body">
               <div class="">
											<div class="page-header">
												<div class="content-page-header">
													<h7 style="text-transform:uppercase;color:black;">Customer Detail</h7>
													<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
														<span class="align-center" aria-hidden="true">&times;</span>
													</button>

												</div>
											</div>
								

							<div class="card customer-details-group">
								<div class="">
											<div class="page-header">
												<div class="content-page-header">
													<h7 style="text-transform:uppercase;color:red;">Profile</h7>
												</div>
											</div>
									<div class="row align-items-center">					
										<div class="col-xl-3 col-lg-4 col-md-6 col-12">
											<div class="customer-details">
												<div class="d-flex align-items-center">
													<span class="customer-widget-img d-inline-flex">
														<img class="rounded-circle" src="{{ asset('assets/customer_photo/' . $customer_data['customer_photo']) }}" alt="">
													</span>
													<div class="customer-details-cont">
														<h7 style="text-transform:uppercase">{{$customer_data['name']}}</h7>
														<p style="text-transform:uppercase;color: green;">Staff - {{$customer_data['employee']}}</p>
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
														<h7 style="text-transform:uppercase">Email Address</h7>
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
														<h7 style="text-transform:uppercase">Phone Number</h7>
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
														<h7 style="text-transform:uppercase">Alternate Phone No</h7>
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
														<h7 style="text-transform:uppercase">Address</h7>
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
														<h7 style="text-transform:uppercase">Source From</h7>
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
														<h7 style="text-transform:uppercase">DOB</h7>
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
														<h7 style="text-transform:uppercase">Wedding Date</h7>
														<p style="text-transform:uppercase">{{date('d-m-Y', strtotime($customer_data['wedding_date']))}}</p>
													</div>
												</div>
											</div>
										</div>		
									</div>


											@if (count($customer_data['proofs']) > 0)
												<div class="page-header">
													<div class="content-page-header">
														<h7 style="text-transform:uppercase;color:red;">Proofs List</h7>
													</div>
												</div>
														<div class="row">
															<div class="col-xl-12">

																<div class="row">
																@foreach ($customer_data['proofs'] as $index => $proofs)
																	@if ($proofs['customer_id'] == $customer_data['id'])
																		<div class="col-sm-3">
																			<img src="{{ asset('assets/proof_one/' . $proofs['proof_upload']) }}" alt="image" class="img-fluid img-thumbnail" width="200">
																			<p class="mb-0">
																				<code style="text-transform:uppercase;color:black">{{$proofs['prooftype']}}</code>
																			</p>
																		</div>
																		@endif
																	@endforeach
																</div>
															</div> <!-- end col-->
														</div><br/>
											@endif

											@if (count($customer_data['families']) > 0)
											<div class="page-header">
												<div class="content-page-header">
													<h7 style="text-transform:uppercase;color:red;">Family Details</h7>
												</div>
											</div>

												<div class="row">

													<div class="col-md-4 border">
															<span style="vertical-align: inherit;vertical-align: inherit;font-size: 14px;font-weight: 700;line-height: 35px;text-transform:uppercase ">Family Name</span>
													</div>
													<div class="col-md-2 border">
															<span style="vertical-align: inherit;vertical-align: inherit;font-size: 14px;font-weight: 700;line-height: 35px;text-transform:uppercase ">Relationship</span>
													</div>
													<div class="col-md-3 border">
															<span style="vertical-align: inherit;vertical-align: inherit;font-size: 14px;font-weight: 700;line-height: 35px;text-transform:uppercase ">DOB</span>
													</div>
													<div class="col-md-3 border">
															<span style="vertical-align: inherit;vertical-align: inherit;font-size: 14px;font-weight: 700;line-height: 35px; text-transform:uppercase">Wedding Date</span>
													</div>

												</div>
												<div class="row ">
													@foreach ($customer_data['families'] as $index => $families)
														@if ($families['customer_id'] == $customer_data['id'])
														<div class="col-md-4 border">
																<span style="vertical-align: inherit;vertical-align: inherit;font-size: 14px;font-weight: 400;line-height: 35px;text-transform:uppercase ">{{ $families['family_name'] }}</span>
														</div>
														<div class="col-md-2 border">
																<span style="vertical-align: inherit;vertical-align: inherit;font-size: 14px;font-weight: 400;line-height: 35px; text-transform:uppercase">{{ $families['family_relationship'] }}</span>
														</div>
														<div class="col-md-3 border">
																<span style="vertical-align: inherit;vertical-align: inherit;font-size: 14px;font-weight: 400;line-height: 35px; text-transform:uppercase">{{ date('d-m-Y', strtotime($families['family_dob'])) }}</span>
														</div>
														<div class="col-md-3 border">
																<span style="vertical-align: inherit;vertical-align: inherit;font-size: 14px;font-weight: 400;line-height: 35px; text-transform:uppercase"> {{ date('d-m-Y', strtotime($families['family_weddingdate'])) }}</span>
														</div>
														@endif
													@endforeach
												</div>
											@endif

								</div>
							</div>

  

               </div>
            </div>
   </div>
</div>

           
   </div>
</div>