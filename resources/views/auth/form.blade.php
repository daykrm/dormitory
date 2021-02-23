@inject('dormModel', 'App\Models\Dormitory')

<div class="row">
    <div class="form-group col-md-2">
        <label>คำนำหน้า</label>
        <select name="prefix" class="form-control @error('prefix') is-invalid @enderror">
            @foreach ($prefixes as $key => $item)
                @if ($app->student != null)
                    @if ($app->student->prefix->id == $item->id)
                        <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                    @else
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endif
                @else
                    @if ($key == 0)
                        <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                    @else
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endif
                @endif
            @endforeach
        </select>
    </div>
    <div class="form-group col-md-4">
        <label>ชื่อ - สกุล</label>
        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
            value="{{ $app->student->name ?? old('name') }}" autofocus>

        @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group col-md-2">
        <label>ชื่อเล่น</label>
        <input id="nickname" type="text" class="form-control @error('nickname') is-invalid @enderror" name="nickname"
            value="{{ $app->student->nickname ?? old('nickname') }}" autofocus>

        @error('nickname')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group col-md-2">
        <label>เบอร์โทรศัพท์</label>
        <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone"
            value="{{ $app->student->phone ?? old('phone') }}" autofocus>

        @error('phone')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group col-md-2">
        <label>วันเกิด</label>
        <input id="dob" name="dob" value="{{ $app->student->dob ?? old('dob') }}"
            class="form-control @error('dob') is-invalid @enderror" />
        @error('dob')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

@if ($edit == 0)
    <div class="row">
        <div class="form-group col-md-4">
            <label>จังหวัด</label>
            <select name="province" class="selectpicker form-control @error('province') is-invalid @enderror"
                title="เลือกจังหวัด" data-live-search="true">
                @foreach ($provinces as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-4">
            <label>E-mail</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                value="{{ old('email') }}">

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group col-md-4">
            <label>Username</label>
            <input id="username" type="text" class="form-control @error('username') is-invalid @enderror"
                name="username" value="{{ old('username') }}" autofocus>

            @error('username')
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
                title="เลือกคณะ" data-live-search="true">
                @foreach ($faculties as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-2">
            <label>ปีที่เข้าศึกษา</label>
            <input id="enroll" type="text" class="form-control @error('enroll') is-invalid @enderror" name="enroll"
                value="{{ old('enroll') }}" autofocus>

            @error('enroll')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group col-md-4">
            <label>หอพัก</label>
            <select id="dorm" name="dorm" class="selectpicker form-control @error('dorm') is-invalid @enderror"
                title="เลือกหอพัก" data-live-search="true">
                @foreach ($dorms as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-2">
            <label>ห้อง</label>
            <select id="room" name="room" class="selectpicker form-control @error('room') is-invalid @enderror"
                title="เลือกห้องพัก" data-live-search="true">
            </select>
        </div>
        <div class="form-group col-md-2" id="room_container" style="display: none"></div>
    </div>
@endif
