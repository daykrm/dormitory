<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"
        integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw=="
        crossorigin="anonymous" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"
        integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ=="
        crossorigin="anonymous"></script>

    {{-- <script src="{{asset('js/app.js')}}"></script> --}}

    @stack('scripts')

    <!-- Fonts -->
    {{-- <link rel="dns-prefetch" href="//fonts.gstatic.com"> --}}

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        @include('inc.navbar')
        <div class="container-fluid">
            <div class="row">
                @if (Auth::guard('web')->check() || Auth::guard('personel')->check())
                    <div class="col-md-3 col-12 my-2">
                        <div class="card">
                            <div class="card-body">
                                <div class="container-fluid">
                                    @include('inc.sidebar')
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <main role="main" class="col-12 col-md-9 pt-md-2 pl-md-0 pr-md-3">
                        @yield('content')
                    </main>
                @else
                    <main role="main" class="col-md-12 ml-sm-auto pt-3 px-4">
                        @yield('content')
                    </main>
                @endif
            </div>
        </div>

        @if (Session::has('status'))
            <script type="text/javascript">
                $(document).ready(function() {
                    $('#showStatusModal').modal();
                    setTimeout(function() {
                        $('#showStatusModal').modal('hide');
                    }, 1500);
                });

            </script>
            <div id="showStatusModal" class="modal fade" tabindex="-1" role="dialog"
                aria-labelledby="showStatusModalLabel" style="display: block; padding-right: 16px;">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="row justify-content-center">
                                <h5>{{ Session::get('status') }}</h5>
                            </div>
                            <div class="row justify-content-center">
                                <button type="button" data-dismiss="modal" class="btn btn-primary">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if (Session::has('error'))
            <script type="text/javascript">
                $(document).ready(function() {
                    $('#showError').modal();
                    setTimeout(function() {
                        $('#showError').modal('hide');
                    }, 1500);
                });

            </script>
            <div id="showError" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="showErrorLabel"
                style="display: block; padding-right: 16px;">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="row justify-content-center">
                                <h5>{{ Session::get('error') }}</h5>
                            </div>
                            <div class="row justify-content-center">
                                <button type="button" data-dismiss="modal" class="btn btn-primary">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</body>

</html>
