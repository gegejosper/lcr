@extends('layouts.panel')

@section('content')
 
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Entry-->
    
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Row-->
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <!--begin::Card-->
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
                                            <th scope="col">Counter</th>
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
                                            <td>{{$que->destination_detail->counter_details->counter_name}}</td>
                                            <td id="que_status_{{$que->id}}">
                                                @if($que->status == 'waiting')   
                                                <span class="badge badge-light-warning">
                                                {{$que->status}}
                                                </span>
                                                @elseif($que->status == 'done')
                                                <span class="badge badge-light-success">
                                                {{$que->status}}
                                                </span>
                                                @else
                                                <!-- <span class="badge badge-light-danger">
                                                {{$que->status}}
                                                </span> -->
                                                @endif
                                            </td>
                                            <!-- <td class="action">
                                                <a href="/panel/ques/{{$que->id}}" class="btn btn-icon btn-active-light-success">
                                                    <span class="svg-icon svg-icon-muted svg-icon-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path d="M21.7 18.9L18.6 15.8C17.9 16.9 16.9 17.9 15.8 18.6L18.9 21.7C19.3 22.1 19.9 22.1 20.3 21.7L21.7 20.3C22.1 19.9 22.1 19.3 21.7 18.9Z" fill="currentColor"/>
                                                    <path opacity="0.3" d="M11 20C6 20 2 16 2 11C2 6 6 2 11 2C16 2 20 6 20 11C20 16 16 20 11 20ZM11 4C7.1 4 4 7.1 4 11C4 14.9 7.1 18 11 18C14.9 18 18 14.9 18 11C18 7.1 14.9 4 11 4ZM8 11C8 9.3 9.3 8 11 8C11.6 8 12 7.6 12 7C12 6.4 11.6 6 11 6C8.2 6 6 8.2 6 11C6 11.6 6.4 12 7 12C7.6 12 8 11.6 8 11Z" fill="currentColor"/>
                                                    </svg>
                                                    </span>
                                                </a>
                                            </td> -->
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <!--end: Datatable-->
                            </div>
                        </div>
                        <!--end::Card-->
                    </div>
                </div>
            <!--end::Row-->
            
            <!--end::Dashboard-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
</div>

<script src="{{asset('js/app.js')}}"></script>  
<script src="{{asset('assets/js/ques.js')}}"></script>

@endsection
