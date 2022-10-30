<!DOCTYPE html>
<html lang="en">

<head>
    @include('layout.head')
</head>

<body data-sidebar="dark" data-keep-enlarged="true" class="vertical">
    <section id="loading">
        <div id="loading-content"></div>
    </section>
    <div id="loader"></div>
    <div id="layout-wrapper">
        @include('layout.header')
        @include('layout.sidebar')
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    @include('layout.page-title')
                    @yield('main-content')
                </div>
            </div>
        </div>
</body>
@include('layout.footer')
@yield('script')

</html>
