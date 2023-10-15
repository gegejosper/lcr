@extends('layouts.panel')
@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">	
	<div class="toolbar" id="kt_toolbar">
		<!--begin::Container-->
		<div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
			<!--begin::Page title-->
			<div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
				
			</div>
			<!--end::Page title-->
			<!--begin::Actions-->
			<div class="d-flex align-items-center gap-2 gap-lg-3">
				<!--begin::Filter menu-->
				<div class="m-0">
					<!--begin::Menu toggle-->
					<a href="#" class="btn btn-sm btn-flex btn-light btn-active-primary fw-bolder" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
					<!--begin::Svg Icon | path: icons/duotune/general/gen031.svg-->
					<span class="svg-icon svg-icon-5 svg-icon-gray-500 me-1">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
							<path d="M19.0759 3H4.72777C3.95892 3 3.47768 3.83148 3.86067 4.49814L8.56967 12.6949C9.17923 13.7559 9.5 14.9582 9.5 16.1819V19.5072C9.5 20.2189 10.2223 20.7028 10.8805 20.432L13.8805 19.1977C14.2553 19.0435 14.5 18.6783 14.5 18.273V13.8372C14.5 12.8089 14.8171 11.8056 15.408 10.964L19.8943 4.57465C20.3596 3.912 19.8856 3 19.0759 3Z" fill="currentColor"></path>
						</svg>
					</span>
					<!--end::Svg Icon-->Filter</a>
					<!--end::Menu toggle-->
					<!--begin::Menu 1-->
					<div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true" id="kt_menu_6244760677ea6" style="">
						<!--begin::Header-->
						<div class="px-7 py-5">
							<div class="fs-5 text-dark fw-bolder">Filter Options</div>
						</div>
						<!--end::Header-->
						<!--begin::Menu separator-->
						<div class="separator border-gray-200"></div>
						<!--end::Menu separator-->
						
						<form action="{{route ('panel.admin.reports_range')}}" method="post">
							<!--begin::Form-->
							@csrf
							<div class="px-7 py-5">
								<!--begin::Input group-->
								<div class="mb-10">
									<!--begin::Label-->
									<label class="form-label fw-bold">From:</label>
									<input class="form-control form-control-solid" placeholder="From:" name="from_date" id="from_date" type="date" required>

									<label class="form-label fw-bold">To:</label>
									<input class="form-control form-control-solid" placeholder="To:" name="to_date" id="to_date" type="date" required>
									<label class="form-label fw-bold">Purpose:</label>
									<div>
										<select name="purpose" class="form-select form-select-solid select2-hidden-accessible" data-kt-select2="true" data-placeholder="Select option" data-dropdown-parent="#kt_menu_6244760677ea6" data-allow-clear="true" data-select2-id="select2-data-7-qifz" tabindex="-1" aria-hidden="true">
										
											<option value="all" selected>All</option>
											@foreach($destinations as $destination)
											<option value="{{$destination->id}}">{{$destination->destination_name}}</option>
											@endforeach
										</select>
									</div>
									<label class="form-label fw-bold">Priority:</label>
									<div>
										<select name="priority" class="form-select form-select-solid select2-hidden-accessible" data-kt-select2="true" data-placeholder="Select option" data-dropdown-parent="#kt_menu_6244760677ea6" data-allow-clear="true" data-select2-id="select2-data-7-qifz" tabindex="-1" aria-hidden="true">
							
											<option value="all" selected>All</option>
											<option value="pwd">PWD</option>
											<option value="senior_citizen">Senior Citizen</option>
											<option value="regular">Regular</option>
										</select>
									</div>
									<label class="form-label fw-bold">Status:</label>
									<div>
										<select name="status" class="form-select form-select-solid select2-hidden-accessible" data-kt-select2="true" data-placeholder="Select option" data-dropdown-parent="#kt_menu_6244760677ea6" data-allow-clear="true" data-select2-id="select2-data-7-qifz" tabindex="-1" aria-hidden="true">
											
											<option value="all" selected>All</option>
											<option value="waiting">Waiting</option>
											<option value="done">Done</option>
											<option value="serving">Serving</option>
											<option value="skipped">Skipped</option>
										</select>
									</div>
									<!--end::Input-->
								</div>
								<!--end::Input group-->
								<!--begin::Actions-->
								<div class="d-flex justify-content-end">
									<button type="reset" class="btn btn-sm btn-light btn-active-light-primary me-2" data-kt-menu-dismiss="true">Reset</button>
									<button type="submit" class="btn btn-sm btn-primary" data-kt-menu-dismiss="true">Apply</button>
								</div>
								<!--end::Actions-->
							</div>
							<!--end::Form-->
						</form>
					</div>
					<!--end::Menu 1-->
				</div>
				
			</div>
			<!--end::Actions-->
		</div>
		<!--end::Container-->
	</div>			
	<!--begin::Entry-->
	<div class="d-flex flex-column-fluid">
		<!--begin::Container-->
		<div class="container pt-20">
			<div class="row justify-content-center">
				<div class="col-lg-11 text-center ">
					<div class="card">
						<div class="card-body">
							
							<div class="card card-custom">
							<div class="card-header border-0 py-5">
								<h3 class="card-title align-items-start flex-column">
									<span class="card-label font-weight-bolder text-dark">Report</span>
								</h3>
								
							</div>
								<div class="card-body"> 
									<!--begin: Datatable-->                             
									<table class="table table-striped table-row-dashed" id="queTable">
										<thead>
											<tr>
												<th scope="col">Date</th>
												<th scope="col">Counter</th>
												<th scope="col">Priority #</th>
												<th scope="col">Client</th>
												<th scope="col">Destination</th>
												<th scope="col">Priority</th>
												<th scope="col">Status</th>
												<!-- <th scope="col">Action</th> -->
											</tr>
										</thead>
										<tbody>
											@forelse($ques as $que)
											<tr class="row{{$que->id}}">
												<td>{{$que->que_date}}</td>
												<td>{{$que->destination_detail->counter_details->counter_name}}</td>
												<td>{{$que->priority_number}}</td>
												<td>{{$que->client_detail->last_name}}, {{$que->client_detail->first_name}} 
												</td>  
												<td>{{$que->destination_detail->destination_name}}</td>
												<td>{{$que->priority}}</td>
												<td id="que_status_{{$que->id}}">
												{{$que->status}}
												</td>

											</tr>
											@empty
											<tr class="text-center">
												<td colspan="5" class="text-center">
													<em class="text-danger">No Current Ques...</em>
												</td>
											</td>
											@endforelse
										</tbody>
									</table>
									
								</div>
							</div>
							<button class="btn btn-primary mt-5 no-print" onclick="window.print();"><i class="fas fa-print"></i> Print</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--end::Container-->
	</div>
	<!--end::Entry-->
</div>
@endsection