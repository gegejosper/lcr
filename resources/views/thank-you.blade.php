@extends('layouts.front')
@section('front-content')
<div class="d-flex flex-column flex-lg-row-fluid py-5">
	<!--begin::Content-->
	<div class="d-flex flex-center flex-column flex-column-fluid">
		<!--begin::Wrapper-->
		<div class="bg-body w-lg-700px p-10 p-lg-15 mx-auto d-flex flex-center flex-column">
				<!--begin::Heading-->
				<div class="text-center">
                    <h3 class="text-dark mb-3">{{$que->destination_detail->counter_details->counter_name}}</h3>
                    <h1 class="text-danger mb-3 fs-1">{{$que->priority_number}}</h1>
                    <div class="card">
                        <div class="card-body">
                        <div id="kt_customer_view_details" class="collapse show">
                                <div class="py-5 fs-6">
                                    <!--begin::Badge-->
                                    <div class="badge badge-light-info d-inline">Client Details</div>
                                    <!--begin::Badge-->
                                    <!--begin::Details item-->
                                    <div class="fw-bolder mt-5">Name</div>
                                    <div class="text-gray-600">{{$que->client_detail->last_name}}, {{$que->client_detail->first_name}} {{$que->client_detail->middle_name}}</div>
                                    <!--begin::Details item-->
                                    <!--begin::Details item-->
                                    <div class="fw-bolder mt-5">Address</div>
                                    <div class="text-gray-600">{{$que->client_detail->address}}</div>
                                    <!--begin::Details item-->
                                    <!--begin::Details item-->
                                    <div class="fw-bolder mt-5">Mobile Number</div>
                                    <div class="text-gray-600">{{$que->client_detail->mobile_num}}</div>

                                    <div class="fw-bolder mt-5">Purpose</div>
                                    <div class="text-gray-600">{{$que->destination_detail->destination_name}}</div>
                                    <!--begin::Details item-->
                                    <button class="btn btn-xl btn-success mt-10" id="print_button"><i class="fa fa-print"></i> Print</button>
                                    <a href="/" class="btn btn-xl btn-primary mt-10"><i class="fa fa-reply"></i> Back</a>

                                    <div id="countdown">10 seconds remaining</div>
                                </div>
                            </div>
                        </div>
                    </div>
					<!--end::Title-->
				</div>
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
<script>
    document.addEventListener('DOMContentLoaded', function() {
    var print_button = document.getElementById('print_button');
    
    print_button.addEventListener('click', function() {
        window.print();
    });
});

function redirect_after_10_seconds() {
    var seconds = 20;

    function updateCountdown() {
        if (seconds > 0) {
            document.getElementById('countdown').textContent = 'Redirecting in ' seconds + ' seconds';
            seconds--;
            setTimeout(updateCountdown, 1000); // Update every 1 second
        } else {
            window.location.href = '/register'; // Redirect when the countdown is done
        }
    }

    updateCountdown();
}

// Call the function to initiate the countdown and redirection
redirect_after_10_seconds();
</script>
@endsection