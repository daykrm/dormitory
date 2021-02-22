<input type="hidden" name="student_id" value="{{ Auth::user()->id }}">
<input type="hidden" name="year" value="{{ $year->year }}">
<hr>
<h5>ข้อมูลหอพัก</h5>
<div class="row justify-content-center">
    <div class="form-group col-md-12">
        <select id="dorm" name="dorm_id" class="selectpicker form-control" title="เลือกหอพัก" data-live-search="true"
            required>
            @foreach ($dorms as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
            @endforeach
        </select>
    </div>
</div>
<h5>ข้อมูลส่วนตัว</h5>
@include('auth.form')
<div class="row justify-content center">
    <div class="form-group col-md-6">
        <label>ทุนการศึกษาที่เคยได้รับ</label>
        <input type="text" name="scholarship_name" required class="form-control">
    </div>
    <div class="form-group col-md-4">
        <label>โรคประจำตัว</label>
        <input type="text" name="underlying_disease" required class="form-control">
    </div>
    <div class="form-group col-md-2">
        <label>ค่าใช้จ่ายต่อเดือน</label>
        <input type="text" name="monthly_expense" required class="form-control">
    </div>
</div>
<hr>
<h5>ข้อมูลครอบครัว</h5>
<hr>
<div class="row justify-content-center">
    <div class="form-group col-md-4">
        <label>ชื่อบิดา</label>
        <input type="text" name="name_fa" required class="form-control">
    </div>
    <div class="form-group col-md-2">
        <label>อายุ</label>
        <input type="text" name="age_fa" required class="form-control">
    </div>
    <div class="form-group col-md-3">
        <label>อาชีพ</label>
        <select name="occ_fa" class="form-control" required>
            <option>เลือกอาชีพ</option>
        </select>
    </div>
    <div class="form-group col-md-3">
        <label>สถานะ</label>
        <select name="status_fa" class="form-control" required>
            <option>เลือกสถานะ</option>
            <option value="1">มีชีวิต</option>
            <option value="0">ไม่มีชีวิต</option>
        </select>
    </div>
    <div class="form-group col-md-4">
        <label>ชื่อมารดา</label>
        <input type="text" name="name_mo" required class="form-control">
    </div>
    <div class="form-group col-md-2">
        <label>อายุ</label>
        <input type="text" name="age_mo" required class="form-control">
    </div>
    <div class="form-group col-md-3">
        <label>อาชีพ</label>
        <select name="occ_mo" class="form-control" required>
            <option>เลือกอาชีพ</option>
        </select>
    </div>
    <div class="form-group col-md-3">
        <label>สถานะ</label>
        <select name="status_mo" class="form-control" required>
            <option>เลือกสถานะ</option>
            <option value="1">มีชีวิต</option>
            <option value="0">ไม่มีชีวิต</option>
        </select>
    </div>
    <div class="form-group col-md-2">
        <label>สถานภาพสมรสบิดา - มารดา</label>
        <select name="marital_status" class="form-control" required>
            <option>เลือกสถานภาพ</option>
            <option value="1">อยู่ด้วยกัน</option>
            <option value="2">แยกกันอยู่</option>
            <option value="3">หย่าร้าง</option>
        </select>
    </div>
    <div class="form-group col-md-2">
        <label>รายได้ครอบครัวต่อเดือน</label>
        <input type="text" name="fam_monthly_income" class="form-control" required>
    </div>
    <div class="form-group col-md-2">
        <label>มีพี่น้องรวม (รวมตนเอง)</label>
        <input type="text" name="relative_number" class="form-control" required>
    </div>
    <div class="form-group col-md-2">
        <label>นักศึกษาเป็นบุตรคนที่</label>
        <input type="text" name="being_number" class="form-control" required>
    </div>
    <div class="form-group col-md-2">
        <label>จำนวนพี่น้องที่เรียนจบแล้ว</label>
        <input type="text" name="graduated" class="form-control" required>
    </div>
    <div class="form-group col-md-2">
        <label>จำนวนที่อยู่ในความดูแล</label>
        <input type="text" name="in_progress" class="form-control" required>
    </div>
</div>
<div class="row">
    <h5>ผู้อุปการะ - กรณีบิดาหรือมารดาไม่ได้เป็นผู้ปกครอง / ผู้อุปการะ </h5>
    <span class="ml-2 text-danger">(เว้นว่างหากบิดาหรือมารดาเป็นผู้ปกครอง / ผู้อุปการะ)</span>
</div>
<hr>
<div class="row justify-content-center">
    <div class="form-group col-md-4">
        <label>ชื่ออุปการะ</label>
        <input type="text" name="name_sp" required class="form-control">
    </div>
    <div class="form-group col-md-1">
        <label>อายุ</label>
        <input type="text" name="age_sp" required class="form-control">
    </div>
    <div class="form-group col-md-3">
        <label>อาชีพ</label>
        <select name="occ_sp" class="form-control" required>
            <option>เลือกอาชีพ</option>
        </select>
    </div>
    <div class="form-group col-md-2">
        <label>เกี่ยวข้องเป็น</label>
        <input type="text" name="relevance" required class="form-control">
    </div>
    <div class="form-group col-md-2">
        <label>รายได้ต่อเดือน</label>
        <input type="text" name="monthly_income_sp" required class="form-control">
    </div>
</div>
