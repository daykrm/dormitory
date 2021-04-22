<input type="hidden" name="student_id" value="{{ Auth::user()->id }}">
<input type="hidden" name="year" value="{{ $app->year ?? $year->year }}">
<input type="hidden" name="image_path" id="image_path" value="{{ $app->img_path ?? '' }}">
<hr>
<h5>หอพักที่ต้องการสมัคร</h5>
<div class="row justify-content-center">
    <div class="form-group col-md-12">
        <select id="dorm" name="dorm_id" class="selectpicker form-control" title="เลือกหอพัก" data-live-search="true"
            required>
            @foreach ($dorms as $item)
                @if ($app->dorm_id == $item->id)
                    <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                @else
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endif
            @endforeach
        </select>
    </div>
</div>
<h5>ข้อมูลส่วนตัว</h5>
<div class="container">
    <input type="file" name="image" class="image" id="selectFile" {{$app->img_path == null ? 'required' : ''}}>
</div>
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">ปรับขนาดรูปภาพ
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="img-container">
                    <div class="row">
                        <div class="col-md-8">
                            <img id="image" src="https://avatars0.githubusercontent.com/u/3456749">
                        </div>
                        <div class="col-md-4">
                            <div class="preview"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                <button type="button" class="btn btn-primary" id="crop">อัพโหลด</button>
            </div>
        </div>
    </div>
</div>
@include('auth.form')
<div class="row justify-content center">
    <div class="form-group col-md-2">
        <label>จังหวัด</label>
        <select name="province" id="province" class="selectpicker form-control @error('province') is-invalid @enderror"
            title="เลือกจังหวัด" data-live-search="true" required>
            @foreach ($provinces as $item)
                @if ($app->student != null)
                    @if ($app->student->province_id == $item->id)
                        <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                    @else
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endif
                @else
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endif
            @endforeach
        </select>

    </div>
    <div class="form-group col-md-4">
        <label>ทุนการศึกษาที่เคยได้รับ</label>
        <input type="text" name="scholarship_name" value="{{ $app->scholarship_name ?? old('scholarship_name') }}"
            class="form-control">
    </div>
    <div class="form-group col-md-2">
        <label>โรคประจำตัว</label>
        <input type="text" name="underlying_disease"
            value="{{ $app->underlying_disease ?? old('underlying_disease') }}" class="form-control">
    </div>
    <div class="form-group col-md-2">
        <label>หน่วยกิจกรรมสะสม</label>
        <input type="text" name="credit" value="{{ $app->student->credit ?? old('credit') }}" required
            class="form-control">
    </div>
    <div class="form-group col-md-2">
        <label>ค่าใช้จ่ายต่อเดือน</label>
        <input type="text" name="monthly_expense" value="{{ $app->monthly_expense ?? old('monthly_expense') }}"
            required class="form-control">
    </div>
    <div class="form-group col-md-6">
        <label>ยานพาหนะที่นำมาใช้ในมหาวิทยาลัย</label>
        <input type="text" name="vehicle_type" value="{{ $app->vehicle_type ?? old('vehicle_type') }}"
            class="form-control">
    </div>
    <div class="form-group col-md-2">
        <label>ยี่ห้อ</label>
        <input type="text" name="vehicle_brand" value="{{ $app->vehicle_brand ?? old('vehicle_brand') }}"
            class="form-control">
    </div>
    <div class="form-group col-md-2">
        <label>รุ่น</label>
        <input type="text" name="vehicle_model" value="{{ $app->vehicle_model ?? old('vehicle_model') }}"
            class="form-control">
    </div>
    <div class="form-group col-md-2">
        <label>สี</label>
        <input type="text" name="vehicle_color" value="{{ $app->vehicle_color ?? old('vehicle_color') }}"
            class="form-control">
    </div>
</div>
<div class="row justify-content-center">
    <div class="form-group col-md-4">
        <label>อายุการใช้งาน ปี / เดือน</label>
        <div class="row">
            <div class="col-md-5">
                <div class="input-group">
                    <input type="number" name="vehicle_year" min="0" class="form-control"
                        value="{{ $app->vehicle_year ?? old('vehicle_year') }}" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <span class="input-group-text" id="basic-addon2">ปี</span>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="input-group">
                    <input type="number" name="vehicle_month" max="11" min="0" class="form-control"
                        value="{{ $app->vehicle_month ?? old('vehicle_month') }}" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <span class="input-group-text" id="basic-addon2">เดือน</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group col-md-3">
        <label>หมายเลขทะเบียน</label>
        <input type="text" name="vehicle_number" value="{{ $app->vehicle_number ?? old('vehicle_number') }}"
            class="form-control">
    </div>
</div>
<h5>ข้อมูลครอบครัว</h5>
<hr>
<h5>ข้อมูลบิดา</h5>
<div class="row justify-content-center">
    <div class="form-group col-md-4">
        <label>ชื่อบิดา</label>
        <input type="text" name="name_fa" value="{{ $app->name_fa ?? old('name_fa') }}" required
            class="form-control">
    </div>
    <div class="form-group col-md-2">
        <label>อายุ</label>
        <input type="text" name="age_fa" value="{{ $app->age_fa ?? old('age_fa') }}" required class="form-control">
    </div>
    <div class="form-group col-md-2">
        <label>อาชีพ</label>
        <select name="occ_fa" id="occ_fa" class="form-control" required>
            <option value="">เลือกอาชีพ</option>
            @foreach ($occs as $item)
                @if ($app->occupation_fa == $item->id)
                    <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                @else
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endif
            @endforeach
            @if ($app->occupation_fa == 1)
                <option value="1" selected>อื่น ๆ</option>
            @else
                <option value="1">อื่น ๆ</option>
            @endif
        </select>
    </div>
    <div class="form-group col-md-2" id="other_fa_container" style="display: none">
        <label>ระบุอาชีพ</label>
        <input type="text" name="other_fa" id="other_fa" value="{{ $app->other_fa ?? old('other_fa') }}"
            {{ $app->occupation_fa == 1 ? 'required' : '' }}
            class="form-control @error('other_fa') is-invalid @enderror">
        @error('other_fa')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group col-md-2">
        <label>สถานะ</label>
        <select name="status_fa" class="form-control" required>
            <option value="">เลือกสถานะ</option>
            <option value="1" {{ $app->status_fa == 1 ? 'selected' : '' }}>มีชีวิต</option>
            <option value="0" {{ $app->status_fa == 0 ? 'selected' : '' }}>ไม่มีชีวิต</option>
        </select>
    </div>
    <div class="form-group col-md-2">
        <label>เบอร์โทรศัพท์</label>
        <input type="text" name="phone_fa" value="{{ $app->phone_fa ?? old('phone_fa') }}" required
            class="form-control">
    </div>
</div>
<div class="row justify-content-center">
    <div class="form-group col-md-3">
        <label>ที่อยู่</label>
        <input type="text" name="address_fa" value="{{ $app->address_fa ?? old('address_fa') }}" class="form-control"
            required>
    </div>
    <div class="form-group col-md-3">
        <label>จังหวัด</label>
        <select name="province_fa" id="province_fa" data-live-search="true" title="เลือกจังหวัด"
            class="selectpicker form-control" required>
            @foreach ($provinces as $item)
                @if ($app->sub_dist_fa != null)
                    @if ($app->sub_dist_fa->district->province->id == $item->id)
                        <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                    @else
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endif
                @else
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endif
            @endforeach
        </select>
    </div>
    <div class="form-group col-md-3">
        <label>อำเภอ</label>
        <select name="district_fa" id="district_fa" data-live-search="true" title="เลือกอำเภอ"
            class="selectpicker form-control" required>
            @if (isset($fa_district_list))
                @foreach ($fa_district_list as $item)
                    @if ($app->sub_dist_fa->district->id == $item->id)
                        <option value="{{ $item->id }}" selected>{{ $item->name_th }}</option>
                    @else
                        <option value="{{ $item->id }}">{{ $item->name_th }}</option>
                    @endif
                @endforeach
            @endif
        </select>
    </div>
    <div class="form-group col-md-3">
        <label>ตำบล</label>
        <select name="subdistrict_fa" id="subdistrict_fa" data-live-search="true" title="เลือกตำบล"
            class="selectpicker form-control" required>
            @if (isset($fa_subdistrict_list))
                @foreach ($fa_subdistrict_list as $item)
                    @if ($app->sub_district_id_fa == $item->id)
                        <option value="{{ $item->id }}" selected>{{ $item->name_th }}</option>
                    @else
                        <option value="{{ $item->id }}">{{ $item->name_th }}</option>
                    @endif
                @endforeach
            @endif
        </select>
    </div>
</div>
<h5>ข้อมูลมารดา</h5>
<div class="row justify-content-center">
    <div class="form-group col-md-4">
        <label>ชื่อมารดา</label>
        <input type="text" name="name_mo" value="{{ $app->name_mo ?? old('name_mo') }}" required
            class="form-control">
    </div>
    <div class="form-group col-md-2">
        <label>อายุ</label>
        <input type="text" name="age_mo" value="{{ $app->age_mo ?? old('age_mo') }}" required class="form-control">
    </div>
    <div class="form-group col-md-2">
        <label>อาชีพ</label>
        <select name="occ_mo" id="occ_mo" class="form-control" required>
            <option value="">เลือกอาชีพ</option>
            @foreach ($occs as $item)
                @if ($app->occupation_mo == $item->id)
                    <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                @else
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endif
            @endforeach
            @if ($app->occupation_mo == 1)
                <option value="1" selected>อื่น ๆ</option>
            @else
                <option value="1">อื่น ๆ</option>
            @endif
        </select>
    </div>
    <div class="form-group col-md-2" id="other_mo_container" style="display: @if ($app->
    occupation_mo == 1) block @else none @endif">
        <label>ระบุอาชีพ</label>
        <input type="text" name="other_mo" id="other_mo" value="{{ $app->other_mo ?? old('other_mo') }}"
            {{ $app->occupation_mo == 1 ? 'required' : '' }}
            class="form-control @error('other_mo') is-invalid @enderror">
        @error('other_mo')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group col-md-2">
        <label>สถานะ</label>
        <select name="status_mo" class="form-control" required>
            <option value="">เลือกสถานะ</option>
            <option value="1" {{ $app->status_mo == 1 ? 'selected' : '' }}>มีชีวิต</option>
            <option value="0" {{ $app->status_mo == 0 ? 'selected' : '' }}>ไม่มีชีวิต</option>
        </select>
    </div>
    <div class="form-group col-md-2">
        <label>เบอร์โทรศัพท์</label>
        <input type="text" name="phone_mo" value="{{ $app->phone_mo ?? old('phone_mo') }}" required
            class="form-control">
    </div>
</div>
<div class="row justify-content-center">
    <div class="form-group col-md-3">
        <label>ที่อยู่</label>
        <input type="text" name="address_mo" value="{{ $app->address_mo ?? old('address_mo') }}" class="form-control"
            required>
    </div>
    <div class="form-group col-md-3">
        <label>จังหวัด</label>
        <select name="province_mo" id="province_mo" data-live-search="true" title="เลือกจังหวัด"
            class="selectpicker form-control" required>
            @foreach ($provinces as $item)
                @if ($app->sub_dist_mo != null)
                    @if ($app->sub_dist_mo->district->province->id == $item->id)
                        <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                    @else
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endif
                @else
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endif
            @endforeach
        </select>
    </div>
    <div class="form-group col-md-3">
        <label>อำเภอ</label>
        <select name="district_mo" id="district_mo" data-live-search="true" title="เลือกอำเภอ"
            class="selectpicker form-control" required>
            @if (isset($mo_district_list))
                @foreach ($mo_district_list as $item)
                    @if ($app->sub_dist_mo->district->id == $item->id)
                        <option value="{{ $item->id }}" selected>{{ $item->name_th }}</option>
                    @else
                        <option value="{{ $item->id }}">{{ $item->name_th }}</option>
                    @endif
                @endforeach
            @endif
        </select>
    </div>
    <div class="form-group col-md-3">
        <label>ตำบล</label>
        <select name="subdistrict_mo" id="subdistrict_mo" data-live-search="true" title="เลือกตำบล"
            class="selectpicker form-control" required>
            @if (isset($mo_subdistrict_list))
                @foreach ($mo_subdistrict_list as $item)
                    @if ($app->sub_district_id_mo == $item->id)
                        <option value="{{ $item->id }}" selected>{{ $item->name_th }}</option>
                    @else
                        <option value="{{ $item->id }}">{{ $item->name_th }}</option>
                    @endif
                @endforeach
            @endif
        </select>
    </div>
</div>
<div class="row justify-content-center">
    <div class="form-group col-md-3">
        <label>สถานภาพสมรสบิดา - มารดา</label>
        <select name="marital_status" class="form-control" required>
            <option value="">เลือกสถานภาพ</option>
            <option value="1" {{ $app->marital_status == 1 ? 'selected' : '' }}>อยู่ด้วยกัน</option>
            <option value="2" {{ $app->marital_status == 2 ? 'selected' : '' }}>แยกกันอยู่</option>
            <option value="3" {{ $app->marital_status == 3 ? 'selected' : '' }}>หย่าร้าง</option>
        </select>
    </div>
    <div class="form-group col-md-3">
        <label>รายได้ครอบครัวต่อเดือน</label>
        <input type="text" name="fam_monthly_income"
            value="{{ $app->family_monthly_income ?? old('fam_monthly_income') }}" class="form-control" required>
    </div>
    <div class="form-group col-md-3">
        <label>มีพี่น้องรวม (รวมตนเอง)</label>
        <input type="text" name="relative_number" value="{{ $app->relative_number ?? old('relative_number') }}"
            class="form-control" required>
    </div>
    <div class="form-group col-md-3">
        <label>นักศึกษาเป็นบุตรคนที่</label>
        <input type="text" name="being_number" value="{{ $app->being_number ?? old('being_number') }}"
            class="form-control" required>
    </div>
</div>
<div class="row justify-content-center">
    <div class="form-group col-md-3">
        <label>จำนวนพี่น้องที่เรียนจบแล้ว</label>
        <input type="text" name="graduated" value="{{ $app->graduated ?? old('graduated') }}" class="form-control"
            required>
    </div>
    <div class="form-group col-md-3">
        <label>จำนวนที่อยู่ในความดูแล</label>
        <input type="text" name="in_progress" value="{{ $app->in_progress ?? old('in_progress') }}"
            class="form-control" required>
    </div>
</div>
<div class="row justify-content-center">
    <div class="form-group col-md-6">
        <label>ผู้อุปการะ</label>
        <select name="sp" id="sp" class="form-control">
            <option value="1">บิดา / มารดา</option>
            <option value="0" {{ $app->name_sp != null ? 'selected' : '' }}>บุคคลอื่น</option>
        </select>
    </div>
</div>
<div id="sp_container" style="display: @if ($app->name_sp != null) block @else
    none @endif">
    <div class="row">
        <h5>ผู้อุปการะ - กรณีบิดาหรือมารดาไม่ได้เป็นผู้ปกครอง / ผู้อุปการะ </h5>
        <span class="ml-2 text-danger">(เว้นว่างหากบิดาหรือมารดาเป็นผู้ปกครอง / ผู้อุปการะ)</span>
    </div>
    <hr>
    <div class="row justify-content-center">
        <div class="form-group col-md-4">
            <label>ชื่ออุปการะ</label>
            <input type="text" name="name_sp" value="{{ $app->name_sp ?? old('name_sp') }}"
                {{ $app->name_sp != null ? 'required' : '' }} id="name_sp"
                class="form-control @error('name_sp') is-invalid @enderror">
            @error('name_sp')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group col-md-1">
            <label>อายุ</label>
            <input type="text" name="age_sp" id="age_sp" value="{{ $app->age_sp ?? old('age_sp') }}"
                {{ $app->name_sp != null ? 'required' : '' }}
                class="form-control @error('age_sp') is-invalid @enderror">
            @error('age_sp')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group col-md-3">
            <label>อาชีพ</label>
            <select name="occ_sp" id="occ_sp" {{ $app->name_sp != null ? 'required' : '' }}
                class="form-control @error('occ_sp') is-invalid @enderror">
                <option value="">เลือกอาชีพ</option>
                @foreach ($occs as $item)
                    @if ($app->occupation_sp == $item->id)
                        <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                    @else
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endif
                @endforeach
                @if ($app->occupation_sp == 1)
                    <option value="1" selected>อื่น ๆ</option>
                @else
                    <option value="1">อื่น ๆ</option>
                @endif
            </select>
            @error('occ_sp')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group col-md-2" id="other_sp_container" style="display: none">
            <label>ระบุอาชีพ</label>
            <input type="text" {{ $app->name_sp != null ? 'required' : '' }}
                value="{{ $app->other_sp ?? old('other_sp') }}" name="other_sp" id="other_sp"
                class="form-control @error('other_sp') is-invalid @enderror">
            @error('other_sp')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group col-md-2">
            <label>เกี่ยวข้องเป็น</label>
            <input type="text" name="relevance" id="relevance" value="{{ $app->relevance ?? old('relevance') }}"
                {{ $app->name_sp != null ? 'required' : '' }}
                class="form-control @error('relevance') is-invalid @enderror">
            @error('relevance')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group col-md-2">
            <label>รายได้ต่อเดือน</label>
            <input type="text" name="monthly_income_sp" id="monthly_income_sp"
                value="{{ $app->monthly_income_sp ?? old('monthly_income_sp') }}"
                {{ $app->name_sp != null ? 'required' : '' }}
                class="form-control @error('monthly_income_sp') is-invalid @enderror">
            @error('monthly_income_sp')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="form-group col-md-3">
            <label>ที่อยู่</label>
            <input type="text" name="address_sp" value="{{ $app->address_sp ?? old('address_sp') }}"
                class="form-control">
        </div>
        <div class="form-group col-md-3">
            <label>จังหวัด</label>
            <select name="province_sp" id="province_sp" data-live-search="true" title="เลือกจังหวัด"
                class="selectpicker form-control">
                @foreach ($provinces as $item)
                    @if ($app->sub_dist_sp != null)
                        @if ($app->sub_dist_sp->district->province->id == $item->id)
                            <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                        @else
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endif
                    @else
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-3">
            <label>อำเภอ</label>
            <select name="district_sp" id="district_sp" data-live-search="true" title="เลือกอำเภอ"
                class="selectpicker form-control">
                @if (isset($sp_district_list))
                    @foreach ($sp_district_list as $item)
                        @if ($app->sub_dist_sp->district->id == $item->id)
                            <option value="{{ $item->id }}" selected>{{ $item->name_th }}</option>
                        @else
                            <option value="{{ $item->id }}">{{ $item->name_th }}</option>
                        @endif
                    @endforeach
                @endif
            </select>
        </div>
        <div class="form-group col-md-3">
            <label>ตำบล</label>
            <select name="subdistrict_sp" id="subdistrict_sp" data-live-search="true" title="เลือกตำบล"
                class="selectpicker form-control">
                @if (isset($sp_subdistrict_list))
                    @foreach ($sp_subdistrict_list as $item)
                        @if ($app->sub_district_id_sp == $item->id)
                            <option value="{{ $item->id }}" selected>{{ $item->name_th }}</option>
                        @else
                            <option value="{{ $item->id }}">{{ $item->name_th }}</option>
                        @endif
                    @endforeach
                @endif
            </select>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="form-group col-md-3">
            <label>เบอร์โทรศัพท์</label>
            <input type="text" name="phone_sp" value="{{ $app->phone_sp ?? old('phone_sp') }}" class="form-control">
        </div>
    </div>
</div>
