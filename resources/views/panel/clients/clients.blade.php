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
                        <div class="card">
                            
                            <!--begin::Card body-->
                            <div class="card-body pt-0">
                                <!--begin::Table-->
                                <div id="kt_clients_table_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                    <div class="table-responsive">
                                        <table class="table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer" id="kt_clients_table">
                                            <!--begin::Table head-->
                                            <thead>
                                                <!--begin::Table row-->
                                                <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                                    
                                                    <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_clients_table" rowspan="1" colspan="1" aria-label="Client Name: activate to sort column ascending" style="width: 171.9375px;">Client Name</th>
                                                    
                                                    <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_clients_table" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending" style="width: 225.21875px;">Contact Number</th>
                                                    <th class="sorting" tabindex="0" aria-controls="kt_clients_table" rowspan="1" colspan="1" aria-label="Client Name: activate to sort column ascending" style="width: 171.9375px;">Address</th>
                                                    <!-- <th class="max-w-50px" tabindex="0">Status</th> -->
                                                    <!-- <th class="text-end min-w-150px" rowspan="1" colspan="1" aria-label="Actions" style="width: 132.984375px;">Actions</th></tr> -->
                                                <!--end::Table row-->
                                            </thead>
                                            <!--end::Table head-->
                                        <!--begin::Table body-->
                                            <tbody class="fw-bold text-gray-600 clients-list"> 
                                                @foreach($clients as $client)  
                                                <tr>
                                                    <td>
                                                        @if($page_name != 'Blacklist Client')
                                                        <a href="/panel/clients/{{$client->id}}" class="text-gray-800 text-hover-primary mb-1">{{$client->last_name}}, {{$client->first_name}}</a>
                                                        @else
                                                        <a href="" class="text-gray-800 text-hover-primary mb-1">{{$client->last_name}}, {{$client->first_name}}</a>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        {{$client->mobile_num}}
                                                    </td>
                                                    <td>
                                                        {{$client->address}}
                                                    </td>
                                                    <?php 
                                                        $status = '';
                                                        $classAdd = '';
                                                        if($client->status === 'active'){
                                                            $classAdd = 'badge-light-success';
                                                        }
                                                        else {
                                                            $classAdd = 'badge-light-danger';
                                                        }
                                                    ?>
                                                    <!-- <td >
                                                        <span id="client_status_{{$client->id}}" class="badge {{$classAdd}}">{{$client->status}}</span>
                                                    </td> -->
                                                    <!-- <td class="text-end">
                                                        <a href="javascript:;" id="client_edit_{{$client->id}}" class="btn btn-icon btn-active-light-info edit-client"
                                                            data-client_id="{{$client->id}}"
                                                            data-client_last_name="{{$client->last_name}}"
                                                            data-client_first_name="{{$client->first_name}}"
                                                            data-client_mobile_num="{{$client->mobile_num}}"
                                                            data-client_address="{{$client->address}}"
                                                            data-client_facebook="{{$client->facebook}}"
                                                        >
                                                                <span class="svg-icon svg-icon-3">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                    <path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="currentColor"></path>
                                                                    <path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="currentColor"></path>
                                                                </svg>
                                                            </span>
                                                        </a>
                                                        <a href="/panel/clients/{{$client->id}}" class="btn btn-icon btn-active-light-success">
                                                            <span class="svg-icon svg-icon-muted svg-icon-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                            <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor"/>
                                                            <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor"/>
                                                            </svg></span>
                                                        </a>
                                                    </td> -->
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        <!--end::Table body-->
                                        </table>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 d-flex align-items-center justify-content-center">
                                            <div class="dataTables_paginate paging_simple_numbers" id="kt_clients_table_paginate">
                                            {{$clients->appends(request()->input())->links('pagination::bootstrap-4')}} 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Table-->
                            </div>
                            <!--end::Card body-->
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
<!-- Modal Client -->
<div class="modal fade" id="modal_client" tabindex="-1" style="display: none;" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-850px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header">
                <!--begin::Modal title-->
                <h2 id="modal_title">Add Client</h2>
                <!--end::Modal title-->
                <!--begin::Close-->
                
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                    <span class="svg-icon svg-icon-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor"></rect>
                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor"></rect>
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                </div>
                <!--end::Close-->
            </div>
            <!--end::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                <!--begin::Form-->
                <!-- <form id="kt_modal_new_card_form" class="form fv-plugins-bootstrap5 fv-plugins-framework" action="#"> -->
                    <!--begin::Input group-->
                    @csrf
                    <div class="row mb-10">
                    <div id="errors" hidden></div>
                        <!--begin::Row-->
                        <div class="row fv-row fv-plugins-icon-container">
                            <!--begin::Col-->
                            <div class="col-6">
                                <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                    <span class="required">First Name</span>
                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="First name is required" ></i>
                                </label>
                                <!--end::Label-->
                                <input type="text" id="first_name" class="form-control form-control-solid" placeholder="First Name of Client" name="first_name">
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-6">
                                <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                    <span class="required">Last Name</span>
                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Last name is required"></i>
                                </label>
                                <!--end::Label-->
                                <input type="text" id="last_name" class="form-control form-control-solid" placeholder="Last Name of Client" name="last_name">
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->
                        <!--begin::Row-->
                        <div class="row mt-3">

                            <div class="col-xl-8">
                                <div class="form-group fv-plugins-icon-container">
                                    <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                        <span class="required">Address</span>
                                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Client's address is required" ></i>
                                    </label>
                                    <input type="text" class="form-control form-control-lg form-control-solid" name="address" placeholder="Lot #/ Block #, Etc" id="address" required>
                                    <span class="form-text text-muted">Please enter your address.</span>
                                <div class="fv-plugins-message-container"></div></div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xl-4">
                                <div class="form-group fv-plugins-icon-container">
                                    <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                        <span class="required">Contact Number</span>
                                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Client's contact number is required" ></i>
                                    </label>
                                    <input type="text" class="form-control form-control-lg form-control-solid" name="mobile_num" placeholder="0999-999-9999" id="mobile_num" required>
                                    <span class="form-text text-muted">Please enter contact number.</span>
                                <div class="fv-plugins-message-container"></div></div>
                            </div>

                        </div>
                    </div>
                    <!--end::Input group-->
                    <!--begin::Actions-->
                    <div class="text-center pt-15">
                        <button type="reset" id="kt_modal_new_card_cancel" class="btn btn-light me-3" data-bs-dismiss="modal">Discard</button>
                        <button type="submit" id="addclient" class="btn btn-primary">
                            <span class="indicator-label">Save</span>
                            <span class="indicator-progress">Please wait...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                    </div>
                    <!--end::Actions-->
                
                <!-- </form> -->
                <!--end::Form-->
            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>
<!-- End Modal Client -->
<!-- Update Client Modal-->
<div class="modal fade" id="modal_edit_client" tabindex="-1" style="display: none;" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-850px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header">
                <!--begin::Modal title-->
                <h2 id="modal_title">Add Client</h2>
                <!--end::Modal title-->
                <!--begin::Close-->
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                    <span class="svg-icon svg-icon-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor"></rect>
                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor"></rect>
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                </div>
                <!--end::Close-->
            </div>
            <!--end::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                <!--begin::Form-->
                <form id="update_client_form" class="form fv-plugins-bootstrap5 fv-plugins-framework">
                    <!--begin::Input group-->
                    @csrf
                    <div class="row mb-10">
                    <div id="errors" hidden></div>
                        <!--begin::Row-->
                        <div class="row fv-row fv-plugins-icon-container">
                            <!--begin::Col-->
                            <div class="col-6">
                                <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                    <span class="required">First Name</span>
                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="First name is required" ></i>
                                </label>
                                <!--end::Label-->
                                <input type="text" id="edit_first_name" class="form-control form-control-solid" placeholder="First Name of Client" name="edit_first_name">
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-6">
                                <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                    <span class="required">Last Name</span>
                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Last name is required"></i>
                                </label>
                                <!--end::Label-->
                                <input type="text" id="edit_last_name" class="form-control form-control-solid" placeholder="Last Name of Client" name="edit_last_name">
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->
                        <!--begin::Row-->
                        <div class="row mt-3">
                            
                            <div class="col-xl-12">
                                <div class="form-group fv-plugins-icon-container">
                                    <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                        <span class="required">Address</span>
                                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Client's address is required" ></i>
                                    </label>
                                    <input type="text" class="form-control form-control-lg form-control-solid" name="edit_address" id="edit_address" placeholder="Lot #/ Block #, Etc" required>
                                    <span class="form-text text-muted">Please enter your address.</span>
                                <div class="fv-plugins-message-container"></div></div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xl-4">
                                <div class="form-group fv-plugins-icon-container">
                                    <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                        <span class="required">Contact Number</span>
                                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Client's contact number is required" ></i>
                                    </label>
                                    <input type="text" class="form-control form-control-lg form-control-solid" name="edit_mobile_num" placeholder="0999-999-9999" id="edit_mobile_num" required>
                                    <span class="form-text text-muted">Please enter contact number.</span>
                                <div class="fv-plugins-message-container"></div></div>
                            </div>
                        </div>
                    </div>
                    <!--end::Input group-->
                    <!--begin::Actions-->
                    <div class="text-center pt-15">
                        <input type="hidden" id="edit_client_id" name="edit_client_id"required>
                        <button type="reset" id="kt_modal_new_card_cancel" class="btn btn-light me-3" data-bs-dismiss="modal">Discard</button>
                        <button type="submit" id="updateclient" class="btn btn-primary">
                            <span class="indicator-label">Update</span>
                            <span class="indicator-progress">Please wait...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                    </div>
                    <!--end::Actions-->
                
                </form>
                <!--end::Form-->
            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>
<!-- End Update Client Modal -->

<div class="modal fade" id="clientUpdateModalSuccess" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="titleSuccess">Update client</h5>
                <!--begin::Close-->
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                    <span class="svg-icon svg-icon-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor"></rect>
                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor"></rect>
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                </div>
                <!--end::Close-->
            </div>
            <div class="modal-body">
                <div class="alert alert-success alert-message" role="alert"> Client successfully updated...</div>
            </div>
            <div class="modal-footer">
           
                <button type="button" class="btn btn-light-success btn-sm font-weight-bold closeblock" data-dismiss="modal"> <i class=" fas fa-check"></i> Close</button>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('js/app.js')}}"></script>  
<script src="{{asset('assets/js/clients.js')}}"></script>

@endsection
