@extends('layout.users_account_layout')
@section('account_layout')

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
                    <option value="นาย" {{ old('guest_salutation', $user->userDetail->salutation ?? '') == 'นาย' ? 'selected' : '' }}>นาย</option>
                    <option value="นาง" {{ old('guest_salutation', $user->userDetail->salutation ?? '') == 'นาง' ? 'selected' : '' }}>นาง</option>
                    <option value="นางสาว" {{ old('guest_salutation', $user->userDetail->salutation ?? '') == 'นางสาว' ? 'selected' : '' }}>นางสาว</option>
                </select>
            </div>
            <div class="col-md-4">
                <label for="guest_name" class="form-label">ชื่อ - สกุล<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="guest_name" name="guest_name" placeholder="ชื่อ - นามสกุล" value="{{ old('fullname', $user->name ?? '') }}" required>
            </div>
            <div class="col-md-1">
                <label for="guest_age" class="form-label">อายุ<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="guest_age" name="guest_age" placeholder="โปรดระบุ" value="{{ old('guest_age', $user->userDetail->age ?? '') }}" required>
            </div>
            <div class="col-md-3">
                <label for="guest_phone" class="form-label">เบอร์มือถือ</label>
                <input type="text" class="form-control" id="guest_phone" name="guest_phone" value="{{ old('guest_age', $user->userDetail->phone ?? '') }}" required>
            </div>
        </div>

        <br>

        <div class="row">
            <div class="col-md-3">
                <label for="guest_house_number" class="form-label">บ้านเลขที่</label>
                <input type="text" class="form-control" id="guest_house_number" name="guest_house_number" value="{{ old('guest_age', $user->userDetail->house_number ?? '') }}" required>
            </div>
            <div class="col-md-2">
                <label for="guest_village" class="form-label">หมู่ที่</label>
                <input type="text" class="form-control" id="guest_village" name="guest_village" value="{{ old('guest_age', $user->userDetail->village ?? '') }}" required>
            </div>
            <div class="col-md-3">
                <label for="guest_subdistrict" class="form-label">ตำบล</label>
                <input type="text" class="form-control" id="guest_subdistrict" name="guest_subdistrict" value="{{ old('guest_age', $user->userDetail->subdistrict ?? '') }}" required>
            </div>
            <div class="col-md-3">
                <label for="guest_district" class="form-label">อำเภอ</label>
                <input type="text" class="form-control" id="guest_district" name="guest_district" value="{{ old('guest_age', $user->userDetail->district ?? '') }}" required>
            </div>
            <div class="col-md-3">
                <label for="guest_province" class="form-label">จังหวัด</label>
                <input type="text" class="form-control" id="guest_province" name="guest_province" value="{{ old('guest_age', $user->userDetail->province ?? '') }}" required>
            </div>
        </div>

        <br>

        <div class="form-group col-md-6">
            <label for="request_details" class="form-label">มีความประสงค์</label>
            <textarea class="form-control" id="request_details" name="request_details" rows="3" required></textarea>
        </div>
        <br>
        <div class="form-group">
            <label for="attachments" class="form-label">แนบไฟล์ (ภาพหรือเอกสาร)</label>
            <input type="file" class="form-control-file" id="attachments" name="attachments[]" multiple>
        </div>
        <br>

        <button type="submit" class="btn btn-primary">ส่งฟอร์ม</button>
    </form>
</div>

@endsection
