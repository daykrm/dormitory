<nav class="navbar navbar-expand-md navbar-dark bg-primary text-white ">
    <div class="container-fluid">
        <div class="row">
            <div class="text-center mb-auto col-md-2"><img src="{{ asset('images/kku_logo.png') }}" height="auto"
                    width="100%" style="max-width: 80px" />
            </div>
            <div class="col-md-10 text-left align-bottom mt-auto" style="line-height: 1.5rem">
                การคัดกรองนักศึกษาเข้าพักในหอพักส่วนกลาง<br>Khon
                Kaen University
            </div>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @if (Auth::guard('web')->check())
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::guard('web')->user()->name }}
                            ({{ Auth::user()->type->name }})<span class="caret"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a href="{{ route('home') }}" class="dropdown-item">Dashboard</a>
                            <a class="dropdown-item" href="#"
                                onclick="event.preventDefault();document.querySelector('#logout-form').submit();">
                                Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @elseif (Auth::guard('personel')->check())
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::guard('personel')->user()->name }}
                            ( บุคลากร )<span class="caret"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a href="{{ route('personel.home') }}" class="dropdown-item">Dashboard</a>
                            <a class="dropdown-item" href="#"
                                onclick="event.preventDefault();document.querySelector('#logout-form').submit();">
                                Logout
                            </a>
                            <form id="logout-form" action="{{ route('personel.logout') }}" method="POST"
                                style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a id="loginDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            เข้าสู่ระบบ
                            <span class="caret"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="loginDropdown">
                            <a class="dropdown-item" href="{{ route('login') }}">นักศึกษา</a>
                            <a class="dropdown-item" href="{{ route('personel.login') }}">บุคลากร</a>
                        </div>
                    </li>
                    {{-- <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li> --}}
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('pdpa', 1) }}">สมัครสมาชิก</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
