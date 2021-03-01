<div class="row justify-content-center">
    <div class="col-md-6">
        <label>ชื่อคณะ</label>
        <input type="text" required name="name" value="{{ $faculty->name ?? old('name') }}" class="form-control">
    </div>
    <div class="col-md-2">
        <label>จำนวนปีที่ใช้ศึกษา</label>
        <input type="number" required min="1" value="{{ $faculty->years ?? old('years') }}" name="years" class="form-control">
    </div>
</div>
