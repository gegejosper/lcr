@extends('layouts.panel')
@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<!--begin::Toolbar-->
	<!--end::Toolbar-->
	<!--begin::Post-->
	<div class="post d-flex flex-column-fluid" id="kt_post">
		<!--begin::Container-->
		<div id="kt_content_container" class="container-xxl">                         
	 	 <!--begin: Datatable--> 
		  <div class="row">
			<div class="col-lg-6">
		  	<div class="card card-custom">
				<div class="card-body">       
					
						<table class="table table-row-dashed table-striped" id="counterTable">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Counter Name</th>
								<th scope="col">Waiting List</th>
							</tr>
						</thead>
						<tbody>
							<?php 
								$count = 1; 
							?>
							@foreach($counters as $counter)
							<tr class="row{{$counter->id}}">
								<th scope="row">{{$count}}</th>
								<td>
									<a href="/counter/{{$counter->id}}" id="counter_name_{{$counter->id}}" class="{{$counter->status == 'active' ? 'text-success' : 'text-warning'}}">
										{{$counter->counter_name}}  
									</a> 
								</td>  
								<td>{{$counter->waiting_que->count()}}  </td>
							</tr>
							<?php 
								$count += 1; 
							?>
							@endforeach
						</tbody>
					</table>
						</div>   
					</div>                      
					
				</div>
			</div>
		<!--end: Datatable-->
		</div>
		<!--end::Container-->
	</div>
	<!--end::Post-->
</div>
@endsection