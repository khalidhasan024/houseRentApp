<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Rent | {{ $page_title }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- ========= active for only native desktop ======== --}}
    <link rel="stylesheet" type="text/css" media="screen" href="{{ asset('css/app.css') }}" />

    {{-- =========== Custom stylesheets for child views ========== --}}
    @yield('stylesheets')

    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('css/main.css')}}" />
    <style>
        a.nav-link{font-size:1.1rem;} 
        a.navbar-brand{font-size: 1.3rem}
        .container-fluid {margin-bottom: 2rem!important;}
    </style>
        
</head>
<body>
    {{-- =========== Container starts ============ --}}
    <div class="container-fluid">
        {{-- ========= Main Navigation =========== --}}
        @include('_includes.nav')

        {{-- ============ Header starts ============= --}}
        @section('heading')
            <div class="row my-2">
                <div class="col"><h2>{{ $heading }}</h2></div>
            </div>
        @show
        
        {{-- ============== Header ends ================= --}}

        <div class="row"><div class="col">@yield('content')</div></div>


        <div class="row">
            <div class="col">
                <footer class="fixed-bottom bg-dark small text-center p-1 text-white">
                    Copyright &copy; <?= date("Y") ?> &amp; Developed by : <a target="_blank" href="http://www.khalid.info" class="text-warning">Md khalid hasan</a>
                    from <a target="_blank" href="http://www.deltacodex.com" class="text-warning">DeltaCodex</a>
                </footer>
            </div>
        </div>
        

    </div>
    {{-- ========= Container ends ========== --}}


    <script src="{{asset('js/app.js')}}"></script>
    {{-- <script src="/js/bootstrap.min.js"></script> --}}

    {{-- =========== Custom javascript for child views ========== --}}
    @yield('scripts')
        

</body>
</html>