@extends('layouts.panel')

@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <!--begin::Layout-->
            <div class="d-flex flex-column flex-xl-row">
                <!--begin::Sidebar-->
                <div class="flex-column flex-lg-row-auto w-100 w-xl-350px mb-10">
                    <!--begin::Card-->
                    <div class="card mb-5 mb-xl-8">
                        <!--begin::Card body-->
                        <div class="card-body pt-15">
                            <!--begin::Summary-->
                            <div class="d-flex flex-center flex-column mb-5">
                                <!--begin::Avatar-->
                                <div class="symbol symbol-100px symbol-circle mb-7 text-center">
                                <?php 
                                    $url = config('app.url').'/clients/qrcode/'.$client->account_number.'/'.$client->id;
                                    function encodeURIComponent($str){
                                    $revert = array('%21'=>'!', '%2A'=>'*', '%27'=>"'", '%28'=>'(', '%29'=>')');
                                        return strtr(rawurlencode($str), $revert);
                                    }
                                    $qr_code = "https://chart.googleapis.com/chart?chs=200x200&cht=qr&chl=".$url."&choe=UTF-8";
                                    echo '<a href="/clients/qrcode?url='.encodeURIComponent($qr_code).'" target="_blank">';
                            
                                    // add the string in the Google Chart API URL
                                    $google_chart_api_url = "https://chart.googleapis.com/chart?chs=200x200&cht=qr&chl=".$url."&choe=UTF-8";
        
                                    // let's display the generated QR code
                                    echo "<img src='".$google_chart_api_url."' alt='".$client->id."'></a>";
                                ?>
                                <!-- <img src="https://randomuser.me/api/portraits/lego/1.jpg" alt="image"> --> <br>
                                <a onclick="PrintImage('https://chart.googleapis.com/chart?chs=200x200&cht=qr&chl={{$client->id}}&choe=UTF-8')" class="btn btn-xs btn-icon btn-primary" print><i class="fa fa-print text-dark"> </i></a> 
                                <!-- <a href="/clients/qrcode?url='<?php encodeURIComponent($qr_code);?>'" target="_blank" class="btn btn-xs btn-icon btn-danger"><i class="fa fa-save text-dark"> </i></a>  -->
                                </div>
                                <!--end::Avatar-->
                                <!--begin::Name-->
                                <a href="#" class="fs-3 text-gray-800 text-hover-primary fw-bolder mb-1">{{$client->last_name}}, {{$client->first_name}}</a>
                                <!--end::Name-->
                                <!--begin::Position-->
                                <div class="fs-5 fw-bold text-muted mb-6">{{$client->status}}</div>
                                <!--end::Position-->
                              
                            </div>
                            <!--end::Summary-->
                            
                            <div class="separator separator-dashed my-3"></div>
                            <!--begin::Details content-->
                            <div id="kt_client_view_details" class="collapse show">
                                <div class="py-5 fs-6">
                                    <!--begin::Badge-->

                                    <!--begin::Details item-->
                                    
                                    <!--begin::Details item-->
                                    <!-- <div class="fw-bolder mt-5">Email</div>
                                    <div class="text-gray-600">
                                        <a href="mailto:{{$client->email}}" class="text-gray-600 text-hover-primary">{{$client->email}}</a>
                                    </div> -->
                                    <!--begin::Details item-->
                                    <!--begin::Details item-->
                                    <div class="fw-bolder mt-5">Billing Address</div>
                                    <div class="text-gray-600">{{$client->address}}</div>
                                    <!--begin::Details item-->
                                    <!--begin::Details item-->
                                    <div class="fw-bolder mt-5">Contact #</div>
                                    <div class="text-gray-600">{{$client->mobile_num}}</div>
                                    <!--begin::Details item-->
                                  
                                    <!--begin::Details item-->
                                </div>
                            </div>
                            <!--end::Details content-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card-->
                   
                </div>
                <!--end::Sidebar-->
                <!--begin::Content-->
                <div class="flex-lg-row-fluid ms-lg-15">
                    <!--begin:::Tabs-->
                    <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-bold mb-8">
                        <!--begin:::Tab item-->
                        <li class="nav-item">
                            <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab" href="#kt_client_view_overview_tab">Overview</a>
                        </li>
                        <!--end:::Tab item-->
                       
                        <!--begin:::Tab item-->
                        <li class="nav-item ms-auto">
                            <!--begin::Action menu-->
                            <a href="#" class="btn btn-primary ps-7 text-black" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">Actions
                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                            <span class="svg-icon svg-icon-2 text-black me-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="currentColor"></path>
                                </svg>
                            </span>
                            <!--end::Svg Icon--></a>
                            <!--begin::Menu-->
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-bold py-4 w-250px fs-6" data-kt-menu="true">
                                
                                <!--begin::Menu item-->
                                <div class="menu-item px-5">
                                    <div class="menu-content text-muted pb-2 px-5 fs-7 text-uppercase">Account</div>
                                </div>
                                <!--end::Menu item-->
                            
                                <!--begin::Menu item-->
                                <div class="menu-item px-5 my-1">
                                    <a href="javascript:;" class="menu-link px-5 edit-client"
                                        data-client_id="{{$client->id}}"
                                        data-client_last_name="{{$client->last_name}}"
                                        data-client_first_name="{{$client->first_name}}"
                                        data-client_mobile_num="{{$client->mobile_num}}"
                                        data-client_address="{{$client->address}}"
                                    >Update Account</a>
                                </div>
                                <!--end::Menu item-->
                            </div>
                            <!--end::Menu-->
                            <!--end::Menu-->
                        </li>
                        <!--end:::Tab item-->
                    </ul>
                    <!--end:::Tabs-->
                    <!--begin:::Tab content-->
                    <div class="tab-content" id="myTabContent">
                        <!--begin:::Tab pane-->
                        <div class="tab-pane fade active show" id="kt_client_view_overview_tab" role="tabpanel">

                            <!--begin::Card-->
                            <div class="card pt-4 mb-6 mb-xl-9">
                                <!--begin::Card header-->
                                <div class="card-header border-0">
                                    <!--begin::Card title-->
                                    <div class="card-title">
                                        <h2>History Records</h2>
                                    </div>
                                    <!--end::Card title-->
                                    
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body pt-0 pb-5">
                                    <!--begin::Table-->
                                    <div id="kt_table_clients_payment_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                        <div class="table-responsive">
                                            <table class="table align-middle table-row-dashed gy-5 dataTable no-footer" id="kt_table_clients_payment">
                                                <!--begin::Table head-->
                                                <thead class="border-bottom border-gray-200 fs-7 fw-bolder">
                                                    <!--begin::Table row-->
                                                    <tr class="text-start text-muted text-uppercase gs-0">
                                                        <th>Date</th>
                                                        <th>Amount</th>
                                                        <th>Rebates</th>
                                                        <th >Penalty</th>
                                                        <th >Remarks</th>
                                                        <th >Status</th>
                                                        <th></th></tr>
                                                    <!--end::Table row-->
                                                </thead>
                                                <!--end::Table head-->
                                                <!--begin::Table body-->
                                                <tbody class="fs-6 fw-bold text-gray-600">
                                                    <!--begin::Table row-->
                                                    <!--end::Table row-->
                                                   
                                                </tbody>
                                                <!--end::Table body-->
                                            </table>
                                        </div>
                                        <!--end::Table-->
                                    </div>
                                    <!--end::Card body-->
                                </div>
                                <!--end::Card-->
                            
                            </div>
                        </div>
                        <!--end:::Tab pane-->
                    </div>
                    <!--end:::Tab content-->
                </div>
                <!--end::Content-->
            </div>
            <!--end::Layout-->

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
                                    <!--end::Row-->
                                    <div class="row">
                                        <div class="col-xl-4">
                                            <div class="form-group fv-plugins-icon-container">
                                                <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                    <span class="required">Province</span>
                                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Client's province is required" ></i>
                                                </label>
                                                <select name="edit_province" id="edit_province" class="form-control form-control-lg form-control-solid" required>
                                                    <option value="0"></option>
                                                    @foreach($provinces as $province)
                                                        <option value="{{$province->provCode}}">{{$province->provDesc}}</option>
                                                    @endforeach
                                                </select>
                                            <div class="fv-plugins-message-container"></div></div>
                                        </div>
                                        <div class="col-xl-4">
                                            <div class="form-group fv-plugins-icon-container spinner-border text-success" role="status" id="edit_loading_city_municipality">
                                                <span class="sr-only">Loading...</span>
                                            </div>
                                            <div class="form-group fv-plugins-icon-container" id="edit_municipality">
                                                
                                                <label class="required">City/Town</label> <br>
                                                <select name="edit_city_municipality" id="edit_city_municipality" class="form-control form-control-lg form-control-solid" required>
                                            
                                                </select>
                                            <div class="fv-plugins-message-container"></div></div>
                                        </div>
                                        <div class="col-xl-4">
                                            <div class="form-group fv-plugins-icon-container spinner-border text-success" role="status" id="edit_loading_barangay">
                                                <span class="sr-only">Loading...</span>
                                            </div>
                                            <div class="form-group fv-plugins-icon-container" id="edit_div_barangay">
                                                <label class="required">Barangay</label> <br>
                                                <select name="edit_barangay" id="edit_barangay" class="form-control form-control-lg form-control-solid" required>
                                                    
                                                </select>
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
                                        <div class="col-xl-4">
                                            <div class="form-group fv-plugins-icon-container">
                                                <label>Facebook</label>
                                                <input type="text" class="form-control form-control-lg form-control-solid" id="edit_facebook" name="edit_facebook" placeholder="http://facebook.com/skinaura" required>
                                                <span class="form-text text-muted">Please enter facebook link</span>
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
            <!--end::Modals-->
            
        </div>
        <!--end::Container-->
    </div>
</div>

<script src="{{asset('js/app.js')}}"></script>  
<script src="{{asset('assets/js/clients.js')}}"></script>

@endsection
