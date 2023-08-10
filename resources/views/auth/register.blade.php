@extends('auth.layout')
@section('auth-content')
<div class="d-flex flex-column flex-lg-row-fluid py-10">
	<!--begin::Content-->
	<div class="d-flex flex-center flex-column flex-column-fluid">
		<!--begin::Wrapper-->
		<div class="bg-body w-lg-700px p-10 p-lg-15 mx-auto d-flex flex-center flex-column">
			<a href="/" class="py-9 mb-5 align-center">
				<img alt="Logo" src="{{asset(config('app.logo'))}}" class="h-250px" />
			</a>
			<!--begin::Form-->
			<form class="form w-100" id="kt_sign_in_form" action="{{ route('login') }}" method="post">
				@csrf
				<!--begin::Heading-->
				<div class="text-center mb-10">
					<!--begin::Title-->
					<h1 class="text-dark mb-3">Register to {{config('app.name')}}</h1>
					<!--end::Title-->
				</div>
				<!--begin::Heading-->
				@if($errors->count() != 0)
					<div class="alert alert-danger">
				        <x-auth-session-status class="mb-4" :status="session('status')" />
						<!-- Validation Errors -->
						<x-auth-validation-errors class="mb-4" :errors="$errors" /> 
				     </div>
				 @endif
				<!--begin::Input group-->
				<div class="row mb-10 mt-10">
                    <div class="col col-lg-4">
                        <input class="form-control form-control-lg form-control-solid" placeholder="First Name" type="text" name="first_name" required/>
                    </div>
                    <div class="col col-lg-4">
                        <input class="form-control form-control-lg form-control-solid" placeholder="Middle Name"  type="text" name="middle_name" />
                    </div>
                    <div class="col col-lg-4">
                        <input class="form-control form-control-lg form-control-solid" placeholder="Last Name"  type="text" name="last_name" required/>
                    </div>
					
				</div>
				<!--end::Input group-->
				<!--begin::Input group-->
				<div class="row mb-10">
                    <div class="col-lg-6">
                        <div class="d-flex flex-stack mb-2">
                            <label class="form-label fw-bolder text-dark fs-6 mb-0">Mobile Number</label>
                        </div>
                        <input class="form-control form-control-lg form-control-solid" type="number" name="mobile_number" placeholder="Mobile Number" />
                    </div>
                    <div class="col-lg-6">
                        <div class="d-flex flex-stack mb-2">
                            <label class="form-label fw-bolder text-dark fs-6 mb-0">Address</label>
                        </div>
                        <input class="form-control form-control-lg form-control-solid" type="text" name="address" placeholder="Address" />
                    </div>
					
				</div>
                <div class="row mb-10">
                    <div class="col-lg-6">
                        <div class="d-flex flex-stack mb-2">
                            <label class="form-label fw-bolder text-dark fs-6 mb-0">Destination</label>
                        </div>
                        <select class="form-control form-control-lg form-control-solid" name="destination" required>
                            <option></option>
                            @foreach($destinations as $destination)
                                <option value="{{$destination->id}}">{{$destination->destination_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-6">
                        <div class="d-flex flex-stack mb-2">
                            <label class="form-label fw-bolder text-dark fs-6 mb-0">Type</label>
                        </div>
                        
                        <select class="form-control form-control-lg form-control-solid" name="type" required>
                            <option value="regular">Regular</option>
                            <option value="pwd">PWD</option>
                            <option value="senior_citizen">Senior Citizen</option>
                           
                        </select>
                    </div>
					
				</div>
				<!--begin::Actions-->
				<div class="text-center">
					<!--begin::Submit button-->
					<button type="submit" id="kt_sign_in_submit" class="btn btn-lg btn-primary w-100 mb-5">
						<span class="indicator-label">Register</span>
						<span class="indicator-progress">Please wait...
						<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
					</button>
					<!--end::Submit button-->
				</div>
				<!--end::Actions-->
			</form>
			<!--end::Form-->
		</div>
		<!--end::Wrapper-->
	</div>
	<!--end::Content-->
	<!--begin::Footer-->
	<div class="d-flex flex-center flex-wrap fs-6 p-5 pb-0">
		<!--begin::Links-->
		<div class="d-flex flex-center fw-bold fs-6">
			<a href="#" class="text-muted text-hover-primary px-2" target="_blank">2023 @ LSSTI - BSCS IV</a>
		</div>
		<!--end::Links-->
	</div>
	<!--end::Footer-->
</div>
@endsection