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
                                <table class="table" id="counterTable">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
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
                                                {{$counter->counter_name}}  
                                            </td>  
                                            <td id="counter_status_{{$counter->id}}">
                                                @if($counter->status == 'active')   
                                                <span class="badge badge-light-success">
                                                {{$counter->status}}
                                                </span>
                                                @elseif($counter->status == 'inactive')
                                                <span class="badge badge-light-warning">
                                                {{$counter->status}}
                                                </span>
                                                @else
                                                @endif
                                            </td>
                                            <td class="action">
                                                <a href="/panel/clerk/counter/{{$counter->id}}" class="btn btn-icon btn-active-light-success">
                                                    <!--begin::Svg Icon | path: assets/media/icons/duotune/finance/fin003.svg-->
                                                    <span class="svg-icon svg-icon-muted svg-icon-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path d="M21.7 18.9L18.6 15.8C17.9 16.9 16.9 17.9 15.8 18.6L18.9 21.7C19.3 22.1 19.9 22.1 20.3 21.7L21.7 20.3C22.1 19.9 22.1 19.3 21.7 18.9Z" fill="currentColor"/>
                                                    <path opacity="0.3" d="M11 20C6 20 2 16 2 11C2 6 6 2 11 2C16 2 20 6 20 11C20 16 16 20 11 20ZM11 4C7.1 4 4 7.1 4 11C4 14.9 7.1 18 11 18C14.9 18 18 14.9 18 11C18 7.1 14.9 4 11 4ZM8 11C8 9.3 9.3 8 11 8C11.6 8 12 7.6 12 7C12 6.4 11.6 6 11 6C8.2 6 6 8.2 6 11C6 11.6 6.4 12 7 12C7.6 12 8 11.6 8 11Z" fill="currentColor"/>
                                                    </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </a>
                                            </td>
                                        </tr>
                                        <?php 
                                            $count += 1; 
                                        ?>
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

@endsection
