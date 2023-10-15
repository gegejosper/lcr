<!DOCTYPE html>
<html lang="en">
	<!--begin::Head-->
	<head><base href="../../../">
		@include('layouts.meta')
		<!--end::Global Stylesheets Bundle-->
	</head>
	<style>body { 
		background-image: url({{asset('assets/media/patterns/pattern-1.jpg')}}); 
		background-size:cover;
		} [data-bs-theme="dark"] body { background-image: url('assets/media/misc/pattern-4.jpg'); }</style>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="bg-body">
		<!--begin::Main-->
		<!--begin::Root-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Authentication - Sign-in -->
			<div class="d-flex flex-column flex-lg-row flex-column-fluid">
				<div class="d-flex flex-column flex-lg-row-fluid py-5 text-center">
					<!--begin::Content-->
					<h1 class="text-white " style="font-size:12px;">LOCAL CIVIL REGISTRAR QUEUING SYSTEM</h1>
					<div class="d-flex flex-column flex-column-fluid">
						<!--begin::Wrapper-->
						<a href="/" class="mb-5 align-center">
							<img alt="Logo" src="{{asset(config('app.logo'))}}" class="h-150px" />
						</a>
						<h1 id="digital_clock" class="text-white" style="font-size:100px;"></h1>
				
                @yield('front-content')
				<!--end::Body-->
			</div>
			<!--end::Authentication - Sign-in-->
		</div>
		<!--end::Root-->
		<!--end::Main-->
		<!--begin::Javascript-->
		<script>var hostUrl = "assets/";</script>
		<!--begin::Global Javascript Bundle(used by all pages)-->
		<script src="{{asset('assets/plugins/global/plugins.bundle.js')}}"></script>
		<script src="{{asset('assets/js/scripts.bundle.js')}}"></script>
		<!--end::Global Javascript Bundle-->
		<!--begin::Page Custom Javascript(used by this page)-->
		<!-- <script src="{{asset('assets/js/custom/authentication/sign-in/general.js')}}"></script> -->
		<!--end::Page Custom Javascript-->
		<!--end::Javascript-->
	</body>
	<!--end::Body-->
</html>