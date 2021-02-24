@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">ผลการเข้าร่วมกิจกรรม</div>
        <div class="card-body">
            <div class="row justify-content-center">
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header bg-secondary">คะแนนกิจกรรมรวมตลอดปีการศึกษา</div>
                        <div class="card-body text-center text-primary">
                            {{ $sumCredit }} คะแนน
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header bg-secondary">คะแนนรวมที่ได้</div>
                        <div class="card-body text-center text-primary">
                            {{ $sumUserCredit }} คะแนน
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header bg-secondary">การเข้าร่วมกิจกรรมคิดเป็นร้อยละ</div>
                        <div class="card-body text-center text-primary">
                            {{ $percent }} %
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <table class="table table-striped">
                    <thead>
                        <th>#</th>
                        <th>ชื่อกิจกรรม</th>
                        <th>วันที่เข้าร่วมกิจกรรม</th>
                        <th>คะแนน</th>
                    </thead>
                    <tbody>
                        @foreach ($activity_credit as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->date_create }}</td>
                                <td>{{ $item->credit }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
