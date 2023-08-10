<base href="">
<title>{{config('app.name')}}{{isset($page_name) ? ' | '.$page_name : ''}}</title>
<meta charset="utf-8" />
<meta name="description" content="{{config('app.desc')}}" />
<meta name="keywords" content="{{config('app.keywords')}}" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta property="og:locale" content="en_US" />
<meta property="og:type" content="article" />
<meta property="og:title" content="{{config('app.name')}}" />
<meta property="og:url" content="{{config('app.url')}}" />
<meta property="og:site_name" content="{{config('app.name')}}" />
<link rel="canonical" href="{{config('app.url')}}" />
<link rel="icon shortcut" href="{{asset('assets/img/favicon.ico')}}" />
<!--begin::Fonts-->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
<!--end::Fonts-->
<!--begin::Page Vendor Stylesheets(used by this page)-->
<link href="{{asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
<!--end::Page Vendor Stylesheets-->
<!--begin::Global Stylesheets Bundle(used by all pages)-->
<link href="{{asset('assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('css/custom.css')}}" rel="stylesheet" type="text/css" />
<!--end::Global Stylesheets Bundle-->
<script src="{{asset('js/jquery-2.0.3.min.js')}}"></script>
<script type="text/javascript">
	const asset_url = "{{asset('images')}}";
</script>
