<nav class="col-md-2 d-none d-md-block bg-light sidebar">
    <div class="sidebar-sticky">
        <ul class="nav flex-column">
            @if (Auth::guard('web')->check() && Auth::guard('web')->user()->type->id == 1)
                <li class="nav-item">
                    <a class="nav-link btn btn-primary mt-2" href="{{ route('home') }}">
                        หน้าแรก <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-primary mt-2" href="{{ route('checkApp', Auth::user()->id) }}">
                        บันทึกใบสมัคร
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-primary mt-2" data-toggle="collapse" href="#collapse1">
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
                                        href="{{ route('report.result.index', Auth::user()->dorm->dormitory->id) }}">ผลการคัดกรองนักศึกษาเข้าพักในหอพักส่วนกลาง</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            @elseif (Auth::guard('web')->check() && Auth::guard('web')->user()->type->id == 2)
                <li class="nav-item">
                    <a class="nav-link btn btn-primary mt-2" href="{{ route('home') }}">
                        หน้าแรก <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-primary mt-2"
                        href="{{ route('activity.show', Auth::user()->dorm->dormitory->id) }}">
                        การจัดการรายการกิจกรรมประจำปี
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-primary mt-2"
                        href="{{ route('indexScore', Auth::user()->dorm->dormitory->id) }}">
                        การจัดการคะแนนการเข้าร่วมกิจกรรม
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-primary mt-2" href="{{ route('checkApp', Auth::user()->id) }}">
                        บันทึกใบสมัคร
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-primary mt-2" data-toggle="collapse" href="#collapse1">
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
                                <li class="list-group-item"><a
                                        href="{{ route('report.activity.showAll', ['id' => Auth::user()->dorm->dormitory->id]) }}">ผลการเข้าร่วมกิจกรรมนักศึกษาในหอพัก</a>
                                </li>
                                {{-- <li class="list-group-item"><a href="#">คะแนนการสัมภาษณ์</a></li> --}}
                                <li class="list-group-item"><a
                                        href="{{ route('report.result.index', Auth::user()->dorm->dormitory->id) }}">ผลการคัดกรองนักศึกษาเข้าพักในหอพักส่วนกลาง</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            @elseif (Auth::guard('web')->check() && Auth::guard('web')->user()->type->id == 3)
                <li class="nav-item">
                    <a class="nav-link btn btn-primary mt-2" href="#">
                        หน้าแรก <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-primary mt-2" href="{{ route('admin.personel.index') }}">
                        จัดการบุคลากร
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-primary mt-2" href="{{ route('faculty.index') }}">
                        จัดการคณะ
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-primary mt-2" href="{{ route('dorm.index') }}">
                        จัดการหอพัก
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-primary mt-2" href="{{ route('yearConfig.index') }}">
                        ปีการศึกษา
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-primary mt-2" href="{{ route('registerRange.index') }}">
                        ช่วงเวลารับสมัคร
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-primary mt-2" href="{{ route('user.index') }}">
                        การกำหนดสิทธิ์นักศึกษา
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-primary mt-2" data-toggle="collapse" href="#collapse1">
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
                                        href="{{ route('report.interview.index') }}">คะแนนการสัมภาษณ์</a></li>
                                <li class="list-group-item"><a
                                        href="{{ route('report.result.select') }}">ผลการคัดกรองนักศึกษาเข้าพักในหอพักส่วนกลาง</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            @elseif (Auth::guard('personel'))
                <li class="nav-item">
                    <a class="nav-link btn btn-primary mt-2" href="{{ route('personel.home') }}">
                        หน้าแรก <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-primary mt-2" href="{{ route('interview.index') }}">
                        การจัดการคะแนนการสัมภาษณ์
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-primary mt-2" href="{{ route('user.index') }}">
                        การกำหนดสิทธิ์นักศึกษา
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-primary mt-2" data-toggle="collapse" href="#collapse1">
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
                                        href="{{ route('report.interview.index') }}">คะแนนการสัมภาษณ์</a></li>
                                <li class="list-group-item"><a
                                        href="{{ route('report.result.select') }}">ผลการคัดกรองนักศึกษาเข้าพักในหอพักส่วนกลาง</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            @endif
        </ul>
    </div>
</nav>
