@extends('layouts.front')
@section('front-content')
		<div class="row ">
			@foreach($counters as $counter)
            <div class="col-lg-4 bg-white me-5">
                <!--begin::Heading-->
                <div class="text-center">
                    <div class="card">
                        <div class="card-body">
                            <h2>{{$counter->counter_name}}</h2>
                            @if(isset($counter->serving_que))
                            @forelse($counter->serving_que as $que)
                            <h3>Serving</h3>
                            <h1 class="text-danger" style="font-size:80px;" id="counter_{{$counter->id}}">{{$que->priority_number}}</h1>
                            @empty
                            <h1 class="text-danger" style="font-size:80px;" id="counter_{{$counter->id}}">...</h1>
                            @endforelse
                            @endif
                        </div>
                    </div>
					<!--end::Title-->
				</div>
            </div>
            @endforeach
            <div class="row">
                <div class="col mt-20">
                    <a href="/register" class="btn btn-primary btn-lg"> Register</a>
                </div>
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

function updateDigitalClock() {
    const digitalClock = document.getElementById('digital_clock');
    const now = new Date();
    const hours = String(now.getHours()).padStart(2, '0');
    const minutes = String(now.getMinutes()).padStart(2, '0');
    const seconds = String(now.getSeconds()).padStart(2, '0');
    digitalClock.textContent = `${hours}:${minutes}:${seconds}`;
}

// Update the digital clock every second
setInterval(updateDigitalClock, 1000);

// Initial update
updateDigitalClock();
let que_counter_id = parseInt({{ $latest_que->id ?? '0' }});
setInterval(() => {
    
    $.ajax({
            type: 'get',
            url: '/check_que',
            success: function(data) {
                if(parseInt(data.id) === que_counter_id){
                    $('#counter_'+data.counter_id).text(data.que_details.priority_number);
                    //console.log('first');
                }
                else {
                    //console.log(data, que_counter_id);
                    que_counter_id = data.id;
                } 
            },
            error: function(data){
            const errorContainer = document.getElementById('errors');
            let errors = data.responseJSON.errors;
            let errormessage = '';
            Object.keys(errors).forEach(function(key) {
                errormessage += errors[key] + '<br />'; 
            });
            errorContainer.innerHTML = ` <div class="alert alert-danger" role="alert"> ${errormessage} </div>`;
            errorContainer.hidden = false;
            }

        });
}, 2000);
</script>
@endsection