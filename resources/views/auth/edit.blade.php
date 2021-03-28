@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">แก้ไขข้อมูลส่วนตัว</div>
        <div class="card-body">
            <form action="{{ route($route, $user) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="form-group col-md-2">
                        <label>คำนำหน้า</label>
                        <select name="prefix" class="form-control @error('prefix') is-invalid @enderror">
                            @foreach ($prefixes as $key => $item)
                                @if ($user->prefix_id == $item->id)
                                    <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                                @else
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label>ชื่อ - สกุล</label>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                            value="{{ $user->name ?? old('name') }}" autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-2">
                        <label>ชื่อเล่น</label>
                        <input id="nickname" type="text" class="form-control @error('nickname') is-invalid @enderror"
                            name="nickname" value="{{ $user->nickname ?? old('nickname') }}" autofocus>

                        @error('nickname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-2">
                        <label>เบอร์โทรศัพท์</label>
                        <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone"
                            value="{{ $user->phone ?? old('phone') }}" autofocus>

                        @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-2">
                        <label>วันเกิด</label>
                        <input id="dob" required name="dob" value="{{ $user->dob ?? old('dob') }}"
                            class="form-control @error('dob') is-invalid @enderror" />
                        @error('dob')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-4">
                        <label>จังหวัด</label>
                        <select name="province" id="province" required
                            class="selectpicker form-control @error('province') is-invalid @enderror" title="เลือกจังหวัด"
                            data-live-search="true">
                            @foreach ($provinces as $item)
                                @if ($user->province_id == $item->id)
                                    <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                                @else
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label>E-mail</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ $user->email ?? old('email') }}">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="form-group col-md-4">
                        <label>Password</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                            name="password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label>Confirm Password</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                    </div>
                </div>

                <hr>

                <div class="row justify-content-center">
                    <div class="form-group col-md-4">
                        <label>คณะ</label>
                        <select name="faculty" class="selectpicker form-control @error('faculty') is-invalid @enderror"
                            title="เลือกคณะ" required data-live-search="true">
                            @foreach ($faculties as $item)
                                @if ($user->faculty_id == $item->id)
                                    <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                                @else
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <label>ปีที่เข้าศึกษา</label>
                        <input id="enroll" type="text" required class="form-control @error('enroll') is-invalid @enderror"
                            name="enroll" value="{{ $user->enrolled_year ?? old('enroll') }}" autofocus>

                        @error('enroll')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label>หอพัก</label>
                        <select id="dorm" name="dorm" class="selectpicker form-control @error('dorm') is-invalid @enderror"
                            title="เลือกหอพัก" required data-live-search="true">
                            @foreach ($dorms as $item)
                                @if ($user->dorm->dormitory->id == $item->id)
                                    <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                                @else
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <label>ห้อง</label>
                        <select id="room" name="room" required
                            class="selectpicker form-control @error('room') is-invalid @enderror" title="เลือกห้องพัก"
                            data-live-search="true">
                        </select>
                    </div>
                    <div class="form-group col-md-2" id="room_container" style="display: none"></div>
                </div>
                <div class="row justify-content-center mt-4">
                    <button type="submit" class="btn btn-success">บันทึก</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            var id = JSON.parse('<?php echo $user->dorm->dormitory->id; ?>');
            var roomId = JSON.parse('<?php echo $user->dorm->room->id; ?>');
            $("#room").empty();
            var option = '';
            $.ajax({
                /* the route pointing to the post function */
                url: '/getRoom/' + id,
                type: 'GET',
                success: function(data) {
                    console.log(data.rooms[0].name)
                    var data = data.rooms;
                    data.forEach(e => {
                        option += '<option value="' + e.id + '">' + e.name +
                            '</option>';
                    });
                    $('#room').append(option);
                    $('#room').selectpicker('refresh');
                    $('#room').val(roomId);
                    $('#room').selectpicker('render');
                }
            });

            $('#dob').datepicker({
                format: 'yyyy-mm-dd',
                startView: "years",
                autoclose: true,
                //minViewMode: "years"
            });

            $('#enroll').datepicker({
                format: 'yyyy',
                startView: "years",
                autoclose: true,
                minViewMode: "years"
            });

            $('#dorm').change(function() {
                var dormId = this.value;
                $("#room").empty();
                var option = '';
                $.ajax({
                    /* the route pointing to the post function */
                    url: '/getRoom/' + dormId,
                    type: 'GET',
                    success: function(data) {
                        console.log(data.rooms[0].name)
                        var data = data.rooms;
                        data.forEach(e => {
                            option += '<option value="' + e.id + '">' + e.name +
                                '</option>';
                        });
                        $('#room').append(option);
                        $('#room').selectpicker('refresh');
                    }
                });
            })
        })

    </script>
@endpush
