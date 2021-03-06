@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            การจัดการคะแนนสัมภาษณ์ ประจำ{{ $dorm->name }} ปีการศึกษา {{ $year->year + 543 }}
        </div>
        <div class="card-body">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-2 text-right">
                        รหัสนักศึกษา :
                    </div>
                    <div class="form-group col-md-10">
                        <form method="GET" action="{{ route('findApplication') }}">
                            <div class="row">
                                <div class="form-group col-md-10">
                                    <input type="text" name="username" value="{{ old('username') }}" required
                                        class="form-control">
                                    <input type="hidden" name="personel_id"
                                        value="{{ Auth::guard('personel')->user()->id }}">
                                    @if (session('error'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ session('error') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-outline-primary">ค้นหา</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if (session('user'))
        <form action="{{ route('interview.store') }}" method="POST">
            @csrf
            <input type="hidden" name="personel_id" value="{{ Auth::guard('personel')->user()->id }}">
            <input type="hidden" name="app_id" value="{{ session('appId') }}">
            <div class="container-fluid mt-4">
                <h5>ผลการค้นหา</h5>
                <hr>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th rowspan="3" class="align-middle">รหัสนักศึกษา</th>
                                <th rowspan="3" class="align-middle">ชื่อ - สกุล</th>
                                <th rowspan="3" class="align-middle">คณะ</th>
                                <th colspan="4">การมีส่วนร่วมในกิจกรรม</th>
                                <th rowspan="3" class="align-middle">ความจำเป็นตามฐานะทางเศรษฐกิจ (20)</th>
                                <th rowspan="3" class="align-middle">ความประพฤติ (20)</th>
                                <th rowspan="3" class="align-middle">รายละเอียดใบสมัคร</th>
                                <th rowspan="3" class="align-middle">จัดการ</th>
                            </tr>
                            <tr class="text-center">
                                <th colspan="2">กิจกรรมหอพัก (40)</th>
                                <th colspan="2">กิจกรรมคณะ / มหาวิทยาลัย (20)</th>
                            </tr>
                            <tr class="text-center">
                                <th>ร้อยละการเข้าร่วมกิจกรรม</th>
                                <th>คะแนนที่ได้รับ</th>
                                <th>หน่วยกิจกรรม</th>
                                <th>คะแนนที่ได้</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ session('user')->username }}</td>
                                <td>{{ session('user')->name }}</td>
                                <td>{{ session('user')->faculty->name }}</td>
                                <td class="text-center">
                                    {{ session('percent') }} %
                                </td>
                                <td class="text-center">
                                    {{ session('dorm_score') }}
                                    <input type="hidden" value="{{ session('dorm_score') }}" name="dorm_score">
                                </td>
                                <td class="text-center">{{ session('user')->credit }}</td>
                                <td>
                                    <input type="number" min="0" max="20" value="{{ session('score')->kku_score ?? 0 }}"
                                        step="any" name="kku_score" required class="form-control">
                                </td>
                                <td>
                                    <input type="number" min="0" max="20"
                                        value="{{ session('score')->family_score ?? 0 }}" step="any" name="family_score"
                                        required class="form-control">
                                </td>
                                <td>
                                    <input type="number" min="0" max="20"
                                        value="{{ session('score')->behavior_score ?? 0 }}" step="any"
                                        name="behavior_score" required class="form-control">
                                </td>
                                <td><a href="{{ url('application/detail/' . session('appId')) }}">รายละเอียดใบสมัคร</a>
                                </td>
                                <td>
                                    @if (session('score') != null)
                                        <button type="submit" class="btn btn-warning">แก้ไข</button>
                                    @else
                                        <button type="submit" class="btn btn-success">บันทึก</button>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </form>
    @endif
    <form action="{{ route('calculate') }}" method="post">
        @csrf
        <div class="container-fluid mt-4">
            <h5>รายการรอประมวลผล</h5>
            <hr>
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr class="text-center">
                            <th rowspan="3" class="align-middle">รหัสนักศึกษา</th>
                            <th rowspan="3" class="align-middle">ชื่อ - สกุล</th>
                            <th rowspan="3" class="align-middle">คณะ</th>
                            <th colspan="4">การมีส่วนร่วมในกิจกรรม</th>
                            <th rowspan="3" class="align-middle">ความจำเป็นตามฐานะทางเศรษฐกิจ (20)</th>
                            <th rowspan="3" class="align-middle">ความประพฤติ (20)</th>
                            <th rowspan="3" class="align-middle">รวม (100)</th>
                            <th rowspan="3" class="align-middle">รายละเอียดใบสมัคร</th>
                            <th rowspan="3" class="align-middle">จำนวนผู้ให้คะแนน</th>
                        </tr>
                        <tr class="text-center">
                            <th colspan="2">กิจกรรมหอพัก (40)</th>
                            <th colspan="2">กิจกรรมคณะ / มหาวิทยาลัย (20)</th>
                        </tr>
                        <tr class="text-center">
                            <th>ร้อยละการเข้าร่วมกิจกรรม</th>
                            <th>คะแนนที่ได้รับ</th>
                            <th>หน่วยกิจกรรม</th>
                            <th>คะแนนที่ได้</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <!-- Modal -->
                            <input type="hidden" name="app[]" value="{{ $item['id'] }}">
                            {{-- <input type="hidden" name="sum[]" value="{{ $item['sum_score'] }}"> --}}
                            <tr>
                                <td>{{ $item['username'] }}</td>
                                <td>{{ $item['name'] }}</td>
                                <td>{{ $item['faculty'] }}</td>
                                <td class="text-center">{{ $item['percent'] }}</td>
                                <td class="text-center">{{ $item['dorm_score'] }}</td>
                                <td class="text-center">{{ $item['credit'] }}</td>
                                <td class="text-center">{{ $item['kku_score'] }}</td>
                                <td class="text-center">{{ $item['family_score'] }}</td>
                                <td class="text-center">{{ $item['behavior_score'] }}</td>
                                <td class="text-center">
                                    {{ $item['dorm_score'] + $item['kku_score'] + $item['family_score'] + $item['behavior_score'] }} ({{$item['sum_score']}})
                                </td>
                                <td class="text-center"><a
                                        href="{{ url('application/detail/' . $item['id']) }}">ใบสมัคร</a></td>
                            <td class="@if ($item['count']>= 2) text-success @else
                                    text-danger @endif text-center">
                                    {{ $item['count'] }} คน</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{-- {{ $apps->links() }} --}}
            </div>
            {{-- <div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="formModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="formModalLabel">จำนวนห้องว่าง</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="number" min="1" required name="available" class="form-control">
                        </div>
                        <div class="modal-footer justify-content-center">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">บันทึก</button>
                        </div>
                    </div>
                </div>
            </div> --}}
            <div class="row justify-content-center mt-2">
                <button type="submit" class="btn btn-primary" @if (count($data) == 0) disabled @endif>ประมวลผล</button>
            </div>
        </div>
    </form>
@endsection
