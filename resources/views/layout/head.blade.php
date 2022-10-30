<meta charset="utf-8" />
<title>Dashboard | {{ $title ?? 'User' }} </title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}" />

<!-- App favicon -->
<link rel="shortcut icon" href="{{ asset('dashboard/images/favicon.png') }}">

<!-- Bootstrap Css -->
<link href="{{ asset('dashboard/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
<!-- Icons Css -->
<link href="{{ asset('dashboard/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
<!-- App Css-->
<link href="{{ asset('dashboard/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
<link href="{{ asset('dashboard/libs/dropzone/min/dropzone.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('dashboard/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
    type="text/css" />
<link href="{{ asset('dashboard/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet"
    type="text/css" />

<!-- Responsive datatable examples -->
<link href="{{ asset('dashboard/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}"
    rel="stylesheet" type="text/css" />
<link href="{{ asset('dashboard/css/dt-custom.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('dashboard/css/loader.css') }}" rel="stylesheet" type="text/css" />

{{-- select 2 --}}
<link rel="stylesheet" href="{{ asset('dashboard/libs/select2/css/select2.min.css') }}" type="text/css">

{{-- light box (magnific popup) --}}
<link rel="stylesheet" href="{{ asset('dashboard/libs/magnific-popup/magnific-popup.css') }}">
@toastr_css
