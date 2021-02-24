<input type="hidden" name="dorm_id" value="{{ Auth::user()->dorm->dormitory->id }}">
<div class="row justify-content-center">
    <div class="form-group col-md-12">
        <label>ชื่อกิจกรรม</label>
        <input type="text" name="name" id="name" value="{{ $activity->name ?? old('name') }}"
            class="form-control @error('name') is-invalid  @enderror">
        @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group col-md-12">
        <label>รายละเอียด</label>
        <textarea name="detail" id="detail" class="form-control @error('detail') is-invalid @enderror" rows="4"
            style="resize:none">{{ $activity->detail ?? old('detail') }}</textarea>
        @error('detail')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="row justify-content-between">
    <div class="form-group col-md-3">
        <label>ปีการศึกษา</label>
        <input type="text" name="year" id="year" maxlength="4" value="{{ $activity->year ?? old('year') }}"
            class="form-control @error('year') is-invalid @enderror">
        @error('year')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group col-md-3">
        <label>งบประมาณ</label>
        <input type="number" min="0" value="{{ $activity->budget ?? old('budget') }}" name="budget"
            class="form-control @error('budget') is-invalid @enderror">
        @error('budget')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group col-md-3">
        <label>วันที่จัดกิจกรรม</label>
        <input value="{{ $activity->activity_date ?? old('date') }}" id="date" name="date"
            class="form-control @error('date') is-invalid @enderror">
        @error('date')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group col-md-3">
        <label>คะแนน</label>
        <input type="number" min="0" value="{{ $activity->credit ?? old('score') }}" name="score"
            class="form-control @error('score') is-invalid @enderror">
        @error('score')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="row justify-content-center">
    <button type="submit" class="btn btn-primary">บันทึก</button>
</div>
