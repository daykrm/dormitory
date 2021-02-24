<nav class="col-md-2 d-none d-md-block bg-light sidebar">
    <div class="sidebar-sticky">
        <ul class="nav flex-column">
            @if (Auth::guard('web')->check() && Auth::guard('web')->user()->type->id == 1)
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('home') }}">
                        หน้าแรก <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('checkApp', Auth::user()->id) }}">
                        บันทึกใบสมัคร
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#collapse1">
                        รายงาน
                    </a>
                </li>
                <div class="nav-item panel-group">
                    <div class="panel panel-default">
                        <div id="collapse1" class="panel-collapse collapse">
                            <ul class="list-group">
                                <li class="list-group-item"><a
                                        href="{{ route('report.activity.index', Auth::user()->dorm->dormitory->id) }}">รายการกิจกรรมประจำปี</a>
                                </li>
                                {{-- <li class="list-group-item"><a href="#">รายชื่อสมาชิกในหอพัก</a></li> --}}
                                <li class="list-group-item"><a
                                        href="{{ route('report.activity.show', ['id' => Auth::user()->id, 'dormId' => Auth::user()->dorm->dormitory->id]) }}">ผลการเข้าร่วมกิจกรรม</a>
                                </li>
                                {{-- <li class="list-group-item"><a href="#">คะแนนการสัมภาษณ์</a></li> --}}
                                <li class="list-group-item"><a
                                        href="{{ route('report.result.index', Auth::user()->dorm_detail_id) }}">ผลการคัดกรองนักศึกษาเข้าพักในหอพักส่วนกลาง</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            @elseif (Auth::guard('web')->check() && Auth::guard('web')->user()->type->id == 2)
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('home') }}">
                        หน้าแรก <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('activity.show', Auth::user()->dorm->dormitory->id) }}">
                        การจัดการรายการกิจกรรมประจำปี
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('indexScore', Auth::user()->dorm->dormitory->id) }}">
                        การจัดการคะแนนการเข้าร่วมกิจกรรม
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('checkApp', Auth::user()->id) }}">
                        บันทึกใบสมัคร
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#collapse1">
                        รายงาน
                    </a>
                </li>
                <div class="nav-item panel-group">
                    <div class="panel panel-default">
                        <div id="collapse1" class="panel-collapse collapse">
                            <ul class="list-group">
                                <li class="list-group-item"><a
                                        href="{{ route('report.activity.index', Auth::user()->dorm->dormitory->id) }}">รายการกิจกรรมประจำปี</a>
                                </li>
                                <li class="list-group-item"><a
                                        href="{{ route('report.dorm.index', Auth::user()->dorm->dormitory->id) }}">รายชื่อสมาชิกในหอพัก</a>
                                </li>
                                <li class="list-group-item"><a
                                        href="{{ route('report.activity.show', ['id' => Auth::user()->id, 'dormId' => Auth::user()->dorm->dormitory->id]) }}">ผลการเข้าร่วมกิจกรรม</a>
                                </li>
                                {{-- <li class="list-group-item"><a href="#">คะแนนการสัมภาษณ์</a></li> --}}
                                <li class="list-group-item"><a
                                        href="{{ route('report.result.index', Auth::user()->dorm_detail_id) }}">ผลการคัดกรองนักศึกษาเข้าพักในหอพักส่วนกลาง</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            @elseif (Auth::guard('personel'))
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('personel.home') }}">
                        หน้าแรก <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('interview.index') }}">
                        การจัดการคะแนนการสัมภาษณ์
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('user.index') }}">
                        ข้อมูลนักศึกษา
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#collapse1">
                        รายงาน
                    </a>
                </li>
                <div class="nav-item panel-group">
                    <div class="panel panel-default">
                        <div id="collapse1" class="panel-collapse collapse">
                            <ul class="list-group">
                                {{-- <li class="list-group-item"><a href="#">รายการกิจกรรมประจำปี</a></li>
                                <li class="list-group-item"><a href="#">รายชื่อสมาชิกในหอพัก</a></li>
                                <li class="list-group-item"><a href="#">ผลการเข้าร่วมกิจกรรม</a></li> --}}
                                <li class="list-group-item"><a
                                        href="{{ route('interview.index') }}">คะแนนการสัมภาษณ์</a></li>
                                <li class="list-group-item"><a
                                        href="{{ route('report.result.select') }}">ผลการคัดกรองนักศึกษาเข้าพักในหอพักส่วนกลาง</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
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
