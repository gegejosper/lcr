@extends('layouts.front')
@section('front-content')
		<div class="row ">
            <div class="col bg-white me-5">
                <!--begin::Heading-->
                <div class="text-center">
                    <div class="card">
                        <div class="card-body">
                            <h2>{{$counter->counter_name}}</h2>
                            @if(isset($serving))
                            <h3>Serving: {{$serving->priority_number}}</h3>
                            @endif
                            <div class="card card-custom">
                            <div class="card-body"> 
                                <!--begin: Datatable-->                             
                                <table class="table" id="queTable">
                                    <thead>
                                        <tr>
                                            <th scope="col">Date</th>
                                            <th scope="col">Priority #</th>
                                            <th scope="col">Client</th>
                                            <th scope="col">Destination</th>
                                            <th scope="col">Status</th>
                                            <!-- <th scope="col">Action</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($ques as $que)
                                        <tr class="row{{$que->id}}">
                                            <td>{{$que->que_date}}</td>
                                            <td>{{$que->priority_number}}</td>
                                           
                                            <td>
                                                <a href="/panel/clients/{{$que->client_detail->id}}" id="client_name_{{$que->client_detail->id}}" class="{{$que->status == 'active' ? 'text-success' : 'text-warning'}}">
                                                    {{$que->client_detail->last_name}}, {{$que->client_detail->first_name}}   
                                                </a> 
                                            </td>  
                                            <td>{{$que->destination_detail->destination_name}}</td>
                                            <td id="que_status_{{$que->id}}">
                                                @if($que->status == 'waiting')   
                                                <span class="badge badge-light-warning">
                                                {{$que->status}}
                                                </span>
                                                @elseif($que->status == 'serving')
                                                <span class="badge badge-light-success">
                                                {{$que->status}}
                                                </span>
                                                @elseif($que->status == 'skipped')
                                                <span class="badge badge-light-primary">
                                                {{$que->status}}
                                                </span>
                                                @elseif($que->status == 'done')
                                                <span class="badge badge-light-danger">
                                                {{$que->status}}
                                                </span>
                                                @else
                                                @endif
                                            </td>

                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="row">
                                    <div class="col">
                                        <a href="javascript:;" data-redirect_url="/serve/{{$counter->id}}" data-src="{{asset('assets/sounds/doorbell.wav')}}" class="btn btn-success play_next_sound">Serve</a>
                                        <a href="javascript:;" data-redirect_url="/next/{{$counter->id}}" data-src="{{asset('assets/sounds/doorbell.wav')}}" class="btn btn-primary play_next_sound">Next</a>
                                        <a href="javascript:;" data-src="{{asset('assets/sounds/doorbell.wav')}}" class="btn btn-primary" id="ring_bell"><i class="fa fa-bell"></i></a>
                                        <a href="javascript:;"  data-redirect_url="/skip/{{$counter->id}}"data-src="{{asset('assets/sounds/doorbell.wav')}}" class="btn btn-warning play_next_sound">Skip</a>
                                        <a href="javascript:;"  data-redirect_url="/end/{{$counter->id}}" data-src="{{asset('assets/sounds/doorbell.wav')}}" class="btn btn-danger play_next_sound">End</a>
                                    </div>
                                </div>
                                <!--end: Datatable-->
                            </div>
                        </div>
                        </div>
                    </div>
					<!--end::Title-->
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
<audio id="next_sound" src="{{asset('assets/sounds/doorbell.wav')}}"></audio>
<audio id="audioElement"></audio>
<script>
const audio = document.getElementById('next_sound');

let que_counter_id = parseInt({{ $latest_que->id ?? '0' }});


const buttons = document.querySelectorAll('.play_next_sound');
const audioElement = document.getElementById('audioElement');
const ring_bell = document.getElementById('ring_bell');
ring_bell.addEventListener('click', function (){
        const audioSrc = ring_bell.getAttribute('data-src');
        if (audioSrc) {
            audioElement.src = audioSrc;
            audioElement.currentTime = 0;
            audioElement.play();
        }
});
buttons.forEach(function (button) {
    button.addEventListener('click', function () {
        const audioSrc = button.getAttribute('data-src');
        const redirectUrl = button.getAttribute('data-redirect_url');
        if (audioSrc) {
            audioElement.src = audioSrc;
            audioElement.currentTime = 0;
            audioElement.play();
        }
        setTimeout(() => {
            window.location.href = redirectUrl;
        }, 2000);
        // audioElement.addEventListener('ended', function () {
        //     if (redirectUrl) {
        //         window.location.href = redirectUrl;
        //     }
        // });
    });
});
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

</script>
@endsection