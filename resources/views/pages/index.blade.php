
@extends('layouts.master')

@section('styles')



@endsection

@section('content')

							<!-- PAGE-HEADER -->
							<div class="page-header">
								<h1 class="page-title">Tableau de bord</h1>
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="javascript:void(0);">Acceuil</a></li>
									<li class="breadcrumb-item active" aria-current="page">Tableau de bord</li>
								</ol>
					     	</div>
							<!-- PAGE-HEADER END -->

							<!-- ROW-1 -->
							<div class="row">
								<div class="col-lg-12 col-md-12 col-sm-12 col-xl-6">
									<div class="row">
										<div class="col-lg-6 col-md-6 col-sm-12 col-xl-6">
											<div class="card">
												<div class="card-body text-center statistics-info">
													<div class="counter-icon bg-primary mb-0 box-primary-shadow">
														<i class="fe fe-trending-up text-white"></i>
													</div>
													<h6 class="mt-4 mb-1">Total Sales</h6>
													<h2 class="mb-2 number-font">34,516</h2>
													<p class="text-muted">Sed ut perspiciatis unde omnis accusantium doloremque</p>
												</div>
											</div>
										</div>
										<div class="col-lg-6 col-md-6 col-sm-12 col-xl-6">
											<div class="card">
												<div class="card-body text-center statistics-info">
													<div class="counter-icon bg-secondary mb-0 box-secondary-shadow">
														<i class="fe fe-codepen text-white"></i>
													</div>
													<h6 class="mt-4 mb-1">Total Leads</h6>
													<h2 class="mb-2 number-font">56,992</h2>
													<p class="text-muted">Sed ut perspiciatis unde omnis accusantium doloremque</p>
												</div>
											</div>
										</div>
										<div class="col-lg-6 col-md-6 col-sm-12 col-xl-6">
											<div class="card">
												<div class="card-body text-center statistics-info">
													<div class="counter-icon bg-success mb-0 box-success-shadow">
														<i class="fe fe-dollar-sign text-white"></i>
													</div>
													<h6 class="mt-4 mb-1">Total Profit</h6>
													<h2 class="mb-2  number-font">$42,567</h2>
													<p class="text-muted">Sed ut perspiciatis unde omnis accusantium doloremque</p>
												</div>
											</div>
										</div>
										<div class="col-lg-6 col-md-6 col-sm-12 col-xl-6">
											<div class="card">
												<div class="card-body text-center statistics-info">
													<div class="counter-icon bg-info mb-0 box-info-shadow">
														<i class="fe fe-briefcase text-white"></i>
													</div>
													<h6 class="mt-4 mb-1">Total Cost</h6>
													<h2 class="mb-2  number-font">$34,789</h2>
													<p class="text-muted">Sed ut perspiciatis unde omnis accusantium doloremque</p>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-12 col-md-12 col-lg-12 col-xl-6">
									<div class="card">
										<div class="card-header">
											<h3 class="card-title">Earnings</h3>
										</div>
										<div class="card-body">
											<div id="echart1" class="chart-donut chart-dropshadow"></div>
											<div class="mt-5 text-center d-flex justify-content-center">
												<div class=""><span class="dot-label bg-info me-2"></span>Sales</div>
												<div class="mx-5"><span class="dot-label bg-secondary me-2"></span>Profit</div>
												<div class=""><span class="dot-label bg-success me-2"></span>Growth</div>
											</div>
										</div>
									</div>
								</div><!-- COL END -->
							</div>
							<!-- ROW-1 END -->

							<!-- ROW-2 -->
							<div class="row">
								<div class="col-sm-12 col-md-12 col-lg-12 col-xl-4">
									<div class="card browsing-status">
										<div class="card-header">
											<h3 class="card-title">Browsing Status</h3>
										</div>
										<div class="card-body p-5">
											<div class="">
												<p class="mb-2">Chrome<span class="float-end text-muted">80%</span></p>
												<div class="progress h-2">
													<div class="progress-bar bg-primary w-80 " role="progressbar"></div>
												</div>
											</div>
											<div class="browsing-status-item">
												<p class="mb-2">Firefox<span class="float-end text-muted">70%</span></p>
												<div class="progress h-2">
													<div class="progress-bar bg-pink w-70" role="progressbar"></div>
												</div>
											</div>
											<div class="browsing-status-item">
												<p class="mb-2">Safari<span class="float-end text-muted">80%</span></p>
												<div class="progress h-2">
													<div class="progress-bar bg-warning w-65" role="progressbar"></div>
												</div>
											</div>
											<div class="browsing-status-item">
												<p class="mb-2">Opera<span class="float-end text-muted">80%</span></p>
												<div class="progress h-2">
													<div class="progress-bar bg-danger w-80" role="progressbar"></div>
												</div>
											</div>
											<div class="browsing-status-item">
												<p class="mb-2">UC Browser<span class="float-end text-muted">70%</span></p>
												<div class="progress h-2">
													<div class="progress-bar bg-success w-60" role="progressbar"></div>
												</div>
											</div>
											<div class="mb-0">
												<p class="mb-2">Internet Explore<span class="float-end text-muted">50%</span></p>
												<div class="progress h-2">
													<div class="progress-bar bg-info w-50" role="progressbar"></div>
												</div>
											</div>
										</div>
									</div>
								</div><!-- COL END -->
								<div class="col-sm-12 col-md-12 col-lg-12 col-xl-4">
									<div class="card production-status">
										<div class="card-header">
											<h3 class="card-title">Production Status</h3>
										</div>
										<div class="production-status-item border-bottom">
											<div class="row">
												<div class="col">
													<p class="mb-1">Production Volume</p>
													<h3 class="mb-0 number-font">57,865</h3>
												</div>
												<div class="col mb-0">
													<div id="spark1" class=""></div>
												</div>
											</div>
										</div>
										<div class="production-status-item border-bottom">
											<div class="row">
												<div class="col">
													<p class="mb-1">Sales Revenue</p>
													<h3 class="mb-0 number-font">22,345</h3>
												</div>
												<div class="col mb-0">
													<div class="chart-wrapper">
														<div id="spark2" class=""></div>
													</div>
												</div>
											</div>
										</div>
										<div class="production-status-item border-bottom">
											<div class="row">
												<div class="col">
													<p class="mb-1">Total Orders</p>
													<h3 class="mb-0 number-font">52,156</h3>
												</div>
												<div class="col mb-0">
													<div id="spark3" class=""></div>
												</div>
											</div>
										</div>
										<div class="production-status-item border-bottom">
											<div class="row">
												<div class="col">
													<p class="mb-1">Total profit</p>
													<h3 class="mb-0 number-font">34,673</h3>
												</div>
												<div class="col mb-0">
													<div id="spark4" class=""></div>
												</div>
											</div>
										</div>
										<div class="p-4 px-5">
											<div class="row">
												<div class="col">
													<p class="mb-1">Total profit</p>
													<h3 class="mb-0 number-font">34,673</h3>
												</div>
												<div class="col mb-0">
													<div id="spark5" class=""></div>
												</div>
											</div>
										</div>
									</div>
								</div><!-- COL END -->
								<div class="col-sm-12 col-md-12 col-lg-12 col-xl-4">
									<div class="card">
										<div class="card-header">
											<h3 class="card-title">Total Sales By Org Unit</h3>
										</div>
										<div class="card-body">
											<small class="text-muted">Total Sales</small>
											<h2 class="number-font">69,453</h2>
											<div class="progress grouped h-3">
												<div class="progress-bar w-25 bg-primary " role="progressbar"></div>
												<div class="progress-bar w-30 bg-danger" role="progressbar"></div>
												<div class="progress-bar w-20 bg-warning" role="progressbar"></div>
											</div>
											<div class="row mt-3 pt-3">
												<div class="col border-end">
													<p class=" number-font1 mb-0"><span class="dot-label bg-primary"></span>Sales</p>
													<h5 class="mt-2 fw-semibold mb-0">25%</h5>
												</div>
												<div class="col  border-end">
													<p class=" number-font mb-0"><span class="dot-label bg-danger"></span>Marketing</p>
													<h5 class="mt-2 fw-semibold mb-0">30%</h5>
												</div>
												<div class="col">
													<p class="number-font1 mb-0"><span class="dot-label bg-warning"></span>Finance</p>
													<h5 class="mt-2 fw-semibold mb-0">20%</h5>
												</div>
											</div>
										</div>
									</div>
									<div class="card">
										<div class="card-body">
											<div class="align-items-center">
												<h4 class="">Total Expenses</h4>
											</div>
											<div class="row d-flex align-items-center">
												<div class="col">
													<h6 class="text-muted mb-2">Monthly</h6>
													<h2 class="d-flex mb-0 number-font">$35487<small><i class="fe fe-arrow-up text-success"></i></small></h2>
												</div>
												<div class="col text-end">
													<div class="">
														<span class="sparkline_bar1 chart-dropshadow-secondary"></span>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div><!-- COL END -->
							</div>
							<!-- ROW-2 END -->

							<!-- ROW-3 -->
							<div class="row">
								<div class="col-sm-12 col-md-12 col-lg-12 col-xl-6 col-xxl-4">
									<div class="card overflow-hidden border-0">
										<div class="card-body pb-0">
											<div class="">
												<div class="d-flex">
													<h6 class="mb-3">Members Online</h6>
													<div class="ms-auto">
														<a class="btn btn-light btn-sm btn-icon me-2" href="javascript:void(0);"><i class="fa fa-chevron-left"></i></a>
														<a class="btn btn-light btn-sm btn-icon" href="javascript:void(0);"><i class="fa fa-chevron-right"></i></a>
													</div>
												</div>
												<h3 class="number-font mb-1">2356</h3>
												<span class="text-success"><i class="zmdi zmdi-long-arrow-up zmdi-hc-lg me-2"></i><span>+24%</span></span><span class="text-muted ms-2">From Last Month</span>
												<p class="mb-0 mt-2 text-muted">Lorem ipsum dolor sit amet odio consectetur accusamus .</p>
											</div>
										</div>
										<div class="chart-wrapper">
											<canvas id="widgetChart1" class="chart-dropshadow-info"></canvas>
										</div>
									</div>
								</div>
								<div class="col-sm-12 col-md-12 col-lg-12 col-xl-6 col-xxl-4">
									<div class="card overflow-hidden border-0">
										<div class="card-body pb-0">
											<div class="">
												<div class="d-flex">
													<h6 class="mb-3">Current Serverload</h6>
													<div class="ms-auto">
														<a class="btn btn-light btn-sm btn-icon me-2" href="javascript:void(0);"><i class="fa fa-chevron-left"></i></a>
														<a class="btn btn-light btn-sm btn-icon" href="javascript:void(0);"><i class="fa fa-chevron-right"></i></a>
													</div>
												</div>
												<h3 class="number-font mb-1">4321</h3>
												<span class="text-success"><i class="zmdi zmdi-long-arrow-up zmdi-hc-lg me-2"></i><span>90.5%</span></span><span class="text-muted ms-2">From Last Month</span>
												<p class="mb-0 mt-2 text-muted">Lorem ipsum dolor sit amet odio consectetur accusamus .</p>
											</div>
										</div>
										<div class="chart-wrapper">
											<canvas id="widgetChart2" class="chart-dropshadow-secondary"></canvas>
										</div>
									</div>
								</div>
								<div class="col-sm-12 col-md-12 col-lg-12 col-xxl-4">
									<div class="card overflow-hidden border-0">
										<div class="card-body pb-0">
											<div class="">
												<div class="d-flex">
													<h6 class="mb-3">To Day's Revenue</h6>
													<div class="ms-auto">
														<a class="btn btn-light btn-sm btn-icon me-2" href="javascript:void(0);"><i class="fa fa-chevron-left"></i></a>
														<a class="btn btn-light btn-sm btn-icon" href="javascript:void(0);"><i class="fa fa-chevron-right"></i></a>
													</div>
												</div>
												<h3 class="number-font mb-1">8963</h3>
												<span class="text-success"><i class="zmdi zmdi-long-arrow-up zmdi-hc-lg me-2"></i><span>20.8%</span></span><span class="text-muted ms-2">From Last Month</span>
												<p class="mb-0 mt-2 text-muted">Lorem ipsum dolor sit amet odio consectetur accusamus .</p>
											</div>
										</div>
										<div class="chart-wrapper">
											<canvas id="widgetChart3" class="chart-dropshadow-success"></canvas>
										</div>
									</div>
								</div>
							</div>
							<!-- ROW-3 END -->

							 <!-- Row -->
							 <div class="row row-sm">
								<div class="col-lg-12">
									<div class="card">
										<div class="card-header">
											<h3 class="card-title mb-0">Product Sales</h3>
										</div>
										<div class="card-body">
											<div class="table-responsive">
												<table class="table table-bordered text-nowrap border-bottom" id="basic-datatable">
													<thead class="border-top">
														<tr>
															<th class="bg-transparent border-bottom-0 w-5"
																>Tracking Id</th>
															<th
																class="bg-transparent border-bottom-0">
																Product</th>
															<th
																class="bg-transparent border-bottom-0">
																Customer</th>
															<th
																class="bg-transparent border-bottom-0">
																Date</th>
															<th
																class="bg-transparent border-bottom-0">
																Amount</th>
															<th
																class="bg-transparent border-bottom-0">
																Payment Mode</th>
															<th class="bg-transparent border-bottom-0 w-10"
																>Status</th>
															<th class="bg-transparent border-bottom-0 w-5"
																>Action</th>
														</tr>
													</thead>
													<tbody>
														<tr class="border-bottom">
															<td class="text-center">
																<div class="mt-0 mt-sm-2 d-block">
																	<h6
																		class="mb-0 fs-14 fw-semibold">
																		#98765490</h6>
																</div>
															</td>
															<td>
																<div class="d-flex">
																	<img src="{{asset('build/assets/images/pngs/8.png')}}" alt="" class="avatar avatar-sm bg-default bradius">
																	<div
																		class="ms-3 mt-0 mt-sm-2 d-block">
																		<h6
																			class="mb-0 fs-14 fw-semibold">
																			Sports shoes</h6>
																	</div>
																</div>
															</td>
															<td>
																<div class="d-flex">
																	<div
																		class="mt-0 mt-sm-3 d-block">
																		<h6
																			class="mb-0 fs-14 fw-semibold">
																			Cherry Blossom</h6>
																	</div>
																</div>
															</td>
															<td><span class="mt-sm-2 d-block">30 Aug
																	2021</span></td>
															<td><span
																	class="fw-semibold mt-sm-2 d-block">$6.721.5</span>
															</td>
															<td>
																<div class="d-flex">
																	<div
																		class="mt-0 mt-sm-3 d-block">
																		<h6
																			class="mb-0 fs-14 fw-semibold">
																			Online Payment</h6>
																	</div>
																</div>
															</td>
															<td>
																<div class="mt-sm-1 d-block">
																	<span
																		class="badge bg-success-transparent rounded-pill text-success p-2 px-3">Shipped</span>
																</div>
															</td>
															<td>
																<div class="g-2">
																	<a class="btn text-primary btn-sm"
																		data-bs-toggle="tooltip"
																		data-bs-original-title="Edit"><span
																			class="fe fe-edit fs-14"></span></a>
																	<a class="btn text-danger btn-sm"
																		data-bs-toggle="tooltip"
																		data-bs-original-title="Delete"><span
																			class="fe fe-trash-2 fs-14"></span></a>
																</div>
															</td>
														</tr>
														<tr class="border-bottom">
															<td class="text-center">
																<div class="mt-0 mt-sm-2 d-block">
																	<h6
																		class="mb-0 fs-14 fw-semibold">
																		#23986456</h6>
																</div>
															</td>
															<td>
																<div class="d-flex">
																	<img src="{{asset('build/assets/images/pngs/7.png')}}" alt="" class="avatar avatar-sm bg-default bradius">
																	<div
																		class="ms-3 mt-0 mt-sm-2 d-block">
																		<h6
																			class="mb-0 fs-14 fw-semibold">
																			Smart Watch</h6>
																	</div>
																</div>
															</td>
															<td>
																<div class="d-flex">
																	<div
																		class="mt-0 mt-sm-3 d-block">
																		<h6
																			class="mb-0 fs-14 fw-semibold">
																			Manny Jah</h6>
																	</div>
																</div>
															</td>
															<td><span class="mt-sm-2 d-block">27 Jan
																	2021</span></td>
															<td><span
																	class="fw-semibold mt-sm-2 d-block">$5,89,6437</span>
															</td>
															<td>
																<div class="d-flex">
																	<div
																		class="mt-0 mt-sm-3 d-block">
																		<h6
																			class="mb-0 fs-14 fw-semibold">
																			Cash on Delivery</h6>
																	</div>
																</div>
															</td>
															<td>
																<div class="mt-sm-1 d-block">
																	<span
																		class="badge bg-warning-transparent rounded-pill text-warning p-2 px-3">Pending</span>
																</div>
															</td>
															<td>
																<div class="g-2">
																	<a class="btn text-primary btn-sm"
																		data-bs-toggle="tooltip"
																		data-bs-original-title="Edit"><span
																			class="fe fe-edit fs-14"></span></a>
																	<a class="btn text-danger btn-sm"
																		data-bs-toggle="tooltip"
																		data-bs-original-title="Delete"><span
																			class="fe fe-trash-2 fs-14"></span></a>
																</div>
															</td>
														</tr>
														<tr class="border-bottom">
															<td class="text-center">
																<div class="mt-0 mt-sm-2 d-block">
																	<h6
																		class="mb-0 fs-14 fw-semibold">
																		#65783926</h6>
																</div>
															</td>
															<td>
																<div class="d-flex">
																	<img src="{{asset('build/assets/images/pngs/5.png')}}" alt="" class="avatar avatar-sm bg-default bradius">
																	<div
																		class="ms-3 mt-0 mt-sm-2 d-block">
																		<h6
																			class="mb-0 fs-14 fw-semibold">
																			Wooden Chair</h6>
																	</div>
																</div>
															</td>
															<td>
																<div class="d-flex">
																	<div
																		class="mt-0 mt-sm-3 d-block">
																		<h6
																			class="mb-0 fs-14 fw-semibold">
																			Ivan Notheridiya</h6>
																	</div>
																</div>
															</td>
															<td><span class="mt-sm-2 d-block">06 Oct
																	2021</span></td>
															<td><span
																	class="fw-semibold mt-sm-2 d-block">$8.654.4</span>
															</td>
															<td>
																<div class="d-flex">
																	<div
																		class="mt-0 mt-sm-3 d-block">
																		<h6
																			class="mb-0 fs-14 fw-semibold">
																			Cash on Delivery</h6>
																	</div>
																</div>
															</td>
															<td>
																<div class="mt-sm-1 d-block">
																	<span
																		class="badge bg-danger-transparent rounded-pill text-danger p-2 px-3">Cancelled</span>
																</div>
															</td>
															<td>
																<div class="g-2">
																	<a class="btn text-primary btn-sm"
																		data-bs-toggle="tooltip"
																		data-bs-original-title="Edit"><span
																			class="fe fe-edit fs-14"></span></a>
																	<a class="btn text-danger btn-sm"
																		data-bs-toggle="tooltip"
																		data-bs-original-title="Delete"><span
																			class="fe fe-trash-2 fs-14"></span></a>
																</div>
															</td>
														</tr>
														<tr class="border-bottom">
															<td class="text-center">
																<div class="mt-0 mt-sm-2 d-block">
																	<h6
																		class="mb-0 fs-14 fw-semibold">
																		#34654895</h6>
																</div>
															</td>
															<td>
																<div class="d-flex">
																	<img src="{{asset('build/assets/images/pngs/4.png')}}" alt="" class="avatar avatar-sm bg-default bradius">
																	<div
																		class="ms-3 mt-0 mt-sm-2 d-block">
																		<h6
																			class="mb-0 fs-14 fw-semibold">
																			Back Pack</h6>
																	</div>
																</div>
															</td>
															<td>
																<div class="d-flex">
																	<div
																		class="mt-0 mt-sm-3 d-block">
																		<h6
																			class="mb-0 fs-14 fw-semibold">
																			Willie Findit</h6>
																	</div>
																</div>
															</td>
															<td><span class="mt-sm-2 d-block">10 Jul
																	2021</span></td>
															<td><span
																	class="fw-semibold mt-sm-2 d-block">$8.654.4</span>
															</td>
															<td>
																<div class="d-flex">
																	<div
																		class="mt-0 mt-sm-3 d-block">
																		<h6
																			class="mb-0 fs-14 fw-semibold">
																			Cash on Delivery</h6>
																	</div>
																</div>
															</td>
															<td>
																<div class="mt-sm-1 d-block">
																	<span
																		class="badge bg-warning-transparent rounded-pill text-warning p-2 px-3">Pending</span>
																</div>
															</td>
															<td>
																<div class="g-2">
																	<a class="btn text-primary btn-sm"
																		data-bs-toggle="tooltip"
																		data-bs-original-title="Edit"><span
																			class="fe fe-edit fs-14"></span></a>
																	<a class="btn text-danger btn-sm"
																		data-bs-toggle="tooltip"
																		data-bs-original-title="Delete"><span
																			class="fe fe-trash-2 fs-14"></span></a>
																</div>
															</td>
														</tr>
														<tr class="border-bottom">
															<td class="text-center">
																<div class="mt-0 mt-sm-2 d-block">
																	<h6
																		class="mb-0 fs-14 fw-semibold">
																		#98765345</h6>
																</div>
															</td>
															<td>
																<div class="d-flex">
																	<img src="{{asset('build/assets/images/pngs/3.png')}}" alt="" class="avatar avatar-sm bg-default bradius">
																	<div
																		class="ms-3 mt-0 mt-sm-2 d-block">
																		<h6
																			class="mb-0 fs-14 fw-semibold">
																			Headphones</h6>
																	</div>
																</div>
															</td>
															<td>
																<div class="d-flex">
																	<div
																		class="mt-0 mt-sm-3 d-block">
																		<h6
																			class="mb-0 fs-14 fw-semibold">
																			Addie Minstra</h6>
																	</div>
																</div>
															</td>
															<td><span class="mt-sm-2 d-block">25 Jun
																	2021</span></td>
															<td><span
																	class="fw-semibold mt-sm-2 d-block">$7,34,9768</span>
															</td>
															<td>
																<div class="d-flex">
																	<div
																		class="mt-0 mt-sm-3 d-block">
																		<h6
																			class="mb-0 fs-14 fw-semibold">
																			Online Payment</h6>
																	</div>
																</div>
															</td>
															<td>
																<div class="mt-sm-1 d-block">
																	<span
																		class="badge bg-success-transparent rounded-pill text-success p-2 px-3">Shipped</span>
																</div>
															</td>
															<td>
																<div class="g-2">
																	<a class="btn text-primary btn-sm"
																		data-bs-toggle="tooltip"
																		data-bs-original-title="Edit"><span
																			class="fe fe-edit fs-14"></span></a>
																	<a class="btn text-danger btn-sm"
																		data-bs-toggle="tooltip"
																		data-bs-original-title="Delete"><span
																			class="fe fe-trash-2 fs-14"></span></a>
																</div>
															</td>
														</tr>
														<tr class="border-bottom">
															<td class="text-center">
																<div class="mt-0 mt-sm-2 d-block">
																	<h6
																		class="mb-0 fs-14 fw-semibold">
																		#67546577</h6>
																</div>
															</td>
															<td>
																<div class="d-flex">
																	<img src="{{asset('build/assets/images/pngs/2.png')}}" alt="" class="avatar avatar-sm bg-default bradius">
																	<div
																		class="ms-3 mt-0 mt-sm-2 d-block">
																		<h6
																			class="mb-0 fs-14 fw-semibold">
																			Flower pot</h6>
																	</div>
																</div>
															</td>
															<td>
																<div class="d-flex">
																	<div
																		class="mt-0 mt-sm-3 d-block">
																		<h6
																			class="mb-0 fs-14 fw-semibold">
																			Laura Biding</h6>
																	</div>
																</div>
															</td>
															<td><span class="mt-sm-2 d-block">22 Feb
																	2021</span></td>
															<td><span
																	class="fw-semibold mt-sm-2 d-block">$7.76.654</span>
															</td>
															<td>
																<div class="d-flex">
																	<div
																		class="mt-0 mt-sm-3 d-block">
																		<h6
																			class="mb-0 fs-14 fw-semibold">
																			Cash on Delivery</h6>
																	</div>
																</div>
															</td>
															<td>
																<div class="mt-sm-1 d-block">
																	<span
																		class="badge bg-warning-transparent rounded-pill text-warning p-2 px-3">Pending</span>
																</div>
															</td>
															<td>
																<div class="g-2">
																	<a class="btn text-primary btn-sm"
																		data-bs-toggle="tooltip"
																		data-bs-original-title="Edit"><span
																			class="fe fe-edit fs-14"></span></a>
																	<a class="btn text-danger btn-sm"
																		data-bs-toggle="tooltip"
																		data-bs-original-title="Delete"><span
																			class="fe fe-trash-2 fs-14"></span></a>
																</div>
															</td>
														</tr>
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- End Row -->

@endsection

@section('scripts')

		<!-- SPARKLINE JS-->
		<script src="{{asset('build/assets/plugins/jquery/jquery.sparkline.min.js')}}"></script>

		<!-- CHARTJS CHART JS-->
		<script src="{{asset('build/assets/plugins/chart/Chart.bundle.js')}}"></script>
		<script src="{{asset('build/assets/plugins/chart/utils.js')}}"></script>

		<!-- ECHART JS-->
		<script src="{{asset('build/assets/plugins/echarts/echarts.js')}}"></script>


		<!-- SELECT2 JS -->
		<script src="{{asset('build/assets/plugins/select2/select2.full.min.js')}}"></script>
		@vite('resources/assets/js/select2.js')

		<!-- DATA TABLE JS-->
		<script src="{{asset('build/assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
		<script src="{{asset('build/assets/plugins/datatable/js/dataTables.bootstrap5.js')}}"></script>
		<script src="{{asset('build/assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
		<script src="{{asset('build/assets/plugins/datatable/dataTables.responsive.min.js')}}"></script>

		<!-- APEXCHART JS -->
		@vite('resources/assets/js/apexcharts.js')

		<!-- INDEX JS -->
		@vite('resources/assets/js/index1.js')

@endsection
