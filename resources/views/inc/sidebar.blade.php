<nav class="col-md-2 d-none d-md-block bg-light sidebar">
    <div class="sidebar-sticky">
        <ul class="nav flex-column">
            @if (Auth::guard('web')->user()->type->id == 1)
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('home') }}">
                        Student Dashboard <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        Orders
                    </a>
                </li>
            @elseif (Auth::guard('web')->user()->type->id == 2)
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('home') }}">
                        หน้าแรก <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('activity.index') }}">
                        การจัดการรายการกิจกรรมประจำปี
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('indexScore') }}">
                        การจัดการคะแนนการเข้าร่วมกิจกรรม
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('application.create') }}">
                        บันทึกใบสมัคร
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('activity.index') }}">
                        รายงาน
                    </a>
                </li>
            @elseif (Auth::guard('personel'))
                <li class="nav-item">
                    <a class="nav-link active" href="#">
                        Personel Dashboard <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        Orders
                    </a>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link active" href="#">
                        Admin Dashboard <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        Orders
                    </a>
                </li>
            @endif
        </ul>
    </div>
</nav>
