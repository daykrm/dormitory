@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row justify-content-between">
                <div class="col-md-2"></div>
                <div class="col-md-8"> สรุปคะแนนการสัมภาษณ์{{ $dorm->name }} ประจำปีการศึกษา {{ $year->year + 543 }}
                </div>
                <div class="col-md-2">
                    <a target="_blank" href="{{ route('showInterview', $dorm->id) }}" class="btn btn-light">พิมพ์</a>
                </div>
            </div>
        </div>
        <div class="card-body">
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
                            <th rowspan="3" class="align-middle">สถานะ</th>
                            <th rowspan="3">จัดการ</th>
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
                                    {{ $item['dorm_score'] + $item['kku_score'] + $item['family_score'] + $item['behavior_score'] }}
                                </td>
                                @if ($item['status'] == 1)
                                    <td class="text-center text-success">ผ่าน</td>
                                @else
                                    <td class="text-center text-danger">ไม่ผ่าน</td>
                                @endif
                                <td>
                                    <form action="{{ route('interview.update', $item['resultId']) }}" class="ml-2"
                                        method="post">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-outline-primary">เปลี่ยน</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $apps->links() }}
            </div>
        </div>
    </div>
@endsection
