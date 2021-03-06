<div class="row justify-content-center">
    <div class="form-group col-md-2">
        <label>คำนำหน้า</label>
        <select name="prefix" class="form-control @error('prefix') is-invalid @enderror">
            @foreach ($prefixes as $key => $item)
                @if (isset($person))
                    @if ($person->prefix_id == $item->id)
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
        @error('prefix')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group col-md-4">
        <label>ชื่อ - สกุล</label>
        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
            value="{{ $person->name ?? old('name') }}" autofocus>

        @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="row justify-content-center">
    <div class="col-md-6">
        <label>E-mail</label>
        <input type="text" name="email" value="{{ $person->email ?? old('email') }}"
            class="form-control @error('email') is-invalid @enderror">
        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

    </div>
</div>
<div class="row justify-content-center">
    <div class="form-group col-md-6">
        <label>Username</label>
        <input id="username" type="text" value="{{ $person->username ?? old('username') }}"
            class="form-control @error('username') is-invalid @enderror" name="username"
            value="{{ old('username') }}" autofocus>

        @error('username')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="row justify-content-center">
    <div class="form-group col-md-3">
        <label>Password</label>
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
            name="password">

        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group col-md-3">
        <label>Confirm Password</label>
        <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
    </div>
</div>
<div class="row justify-content-center">
    <div class="form-group col-md-4">
        <label>หอพัก</label>
        <select id="dorm" name="dorm[]" multiple required
            class="selectpicker form-control @error('dorm') is-invalid @enderror" title="เลือกหอพัก"
            data-live-search="true">
            @foreach ($dorms as $item)
                @if (isset($person))
                    <option value="{{ $item->id }}" @foreach ($person->dorms as $val)  @if ($val->id==$item->id)
                        selected @endif
                @endforeach
                >
                {{ $item->name }}</option>
            @else
                <option value="{{ $item->id }}">{{ $item->name }}</option>
            @endif
            @endforeach
        </select>
    </div>
</div>
