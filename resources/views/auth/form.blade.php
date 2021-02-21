<form method="POST" action="{{ route('register') }}">
    @csrf

    <div class="row">
        <div class="form-group col-md-2">
            <label>Prefix</label>
            <select name="prefix" class="form-control @error('prefix') is-invalid @enderror">
                @foreach ($prefixes as $key => $item)
                    @if ($key == 0)
                        <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                    @else
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-4">
            <label>Name</label>
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                value="{{ old('name') }}" autofocus>

            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group col-md-2">
            <label>Nickname</label>
            <input id="nickname" type="text" class="form-control @error('nickname') is-invalid @enderror"
                name="nickname" value="{{ old('nickname') }}" autofocus>

            @error('nickname')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group col-md-2">
            <label>Telephone</label>
            <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone"
                value="{{ old('phone') }}" autofocus>

            @error('phone')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group col-md-2">
            <label>Date of birth</label>
            <input id="dob" name="dob" class="form-control @error('dob') is-invalid @enderror" />
            @error('dob')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-4">
            <label>Province</label>
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
            <label>Faculty</label>
            <select name="faculty" class="selectpicker form-control @error('faculty') is-invalid @enderror"
                title="เลือกคณะ" data-live-search="true">
                @foreach ($faculties as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-2">
            <label>Enrolled Year</label>
            <input id="enroll" type="text" class="form-control @error('enroll') is-invalid @enderror" name="enroll"
                value="{{ old('enroll') }}" autofocus>

            @error('enroll')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group col-md-4">
            <label>Dormitory</label>
            <select id="dorm" name="dorm" class="selectpicker form-control @error('dorm') is-invalid @enderror"
                title="หอพัก" data-live-search="true">
                @foreach ($dorms as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-2" id="room_container" style="display: none"></div>
    </div>

    <div class="row justify-content-center">
        <button type="submit" class="btn btn-primary" disabled>
            {{ __('Register') }}
        </button>
    </div>
</form>

@push('scripts')
    <script>
        $(document).ready(function() {
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
        })

    </script>
@endpush
