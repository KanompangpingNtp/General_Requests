@extends('layout.users_layout')
@section('user_layout')

@if ($message = Session::get('success'))
<script>
    Swal.fire({
        icon: 'success'
        , title: '{{ $message }}'
    , })

</script>
@endif

<div class="container">
    <h3>กรอกข้อมูลฟอร์ม</h3><br>
    <form action="{{ route('FormCreate') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group col-md-3">
            <label for="date">วันเดือนปี</label>
            <input type="date" class="form-control" id="date" name="date" required>
        </div>
        <br>
        <div class="form-group col-md-4">
            <label for="subject">เรื่อง</label>
            <input type="text" class="form-control" id="subject" name="subject" required>
        </div>
        <br>

        <div class="row">
            <div class="col-md-2">
                <label for="guest_salutation" class="form-label">คำนำหน้า<span class="text-danger">*</span></label>
                <select class="form-select" id="guest_salutation" name="guest_salutation">
                    <option value="" selected disabled>เลือกคำนำหน้า</option>
                    <option value="นาย">นาย</option>
                    <option value="นาง">นาง</option>
                    <option value="นางสาว">นางสาว</option>
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label for="guest_name" class="form-label">ชื่อ - สกุล<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="guest_name" name="guest_name" placeholder="ชื่อ - นามสกุล" required>
            </div>
            <div class="col-md-1 mb-3">
                <label for="guest_age" class="form-label">อายุ<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="guest_age" name="guest_age" placeholder="โปรดระบุ" required>
            </div>
        </div>

        <br>

        <div class="row">
            <div class="form-group col-md-3">
                <label for="guest_phone">อยู่บ้านเลขที่</label>
                <input type="text" class="form-control" id="guest_phone" name="guest_phone" required>
            </div>
            <div class="form-group col-md-3">
                <label for="guest_house_number">บ้านเลขที่</label>
                <input type="text" class="form-control" id="guest_house_number" name="guest_house_number" required>
            </div>
            <div class="form-group col-md-3">
                <label for="guest_village">หมู่ที่</label>
                <input type="text" class="form-control" id="guest_village" name="guest_village" required>
            </div>
            <div class="form-group col-md-3">
                <label for="guest_subdistrict">ตำบล</label>
                <input type="text" class="form-control" id="guest_subdistrict" name="guest_subdistrict" required>
            </div>
            <div class="form-group col-md-3 mt-3">
                <label for="guest_district">อำเภอ</label>
                <input type="text" class="form-control" id="guest_district" name="guest_district" required>
            </div>
            <div class="form-group col-md-3 mt-3">
                <label for="guest_province">จังหวัด</label>
                <input type="text" class="form-control" id="guest_province" name="guest_province" required>
            </div>
        </div>

        <br>

        <div class="form-group col-md-6">
            <label for="request_details">มีความประสงค์</label>
            <textarea class="form-control" id="request_details" name="request_details" rows="3" required></textarea>
        </div>
        <br>
        <div class="form-group">
            <label for="attachments">แนบไฟล์ (ภาพหรือเอกสาร)</label>
            <input type="file" class="form-control-file" id="attachments" name="attachments[]" multiple>
        </div>
        <br>

        <button type="submit" class="btn btn-primary">ส่งฟอร์ม</button>
    </form>
</div>

@endsection
