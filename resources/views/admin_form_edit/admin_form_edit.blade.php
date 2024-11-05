@extends('layout.admin_layout')
@section('admin_layout')

@if ($message = Session::get('success'))
<script>
    Swal.fire({
        icon: 'success'
        , title: '{{ $message }}'
    , })

</script>
@endif


<div class="container">
    <a href="{{ route('adminshowform')}}">กลับหน้าเดิม</a><br><br>
    <h2 class="text-center">แก้ไขฟอร์ม</h2><br>
    <form action="{{ route('admin.forms.update', $form->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" name="form_id" value="{{ $form->id }}">

        <div class="row col-md-3">
            <label for="date">วันเดือนปี</label>
            <input type="date" class="form-control" id="date" name="date" value="{{ $form->date }}" required>
        </div>
        <br>
        <div class="row col-md-4">
            <label for="subject">เรื่อง</label>
            <input type="text" class="form-control" id="subject" name="subject" value="{{ $form->subject }}" required>
        </div>
        <br>

        <div class="row">
            <div class="col-md-2">
                <label for="guest_salutation" class="form-label">คำนำหน้า<span class="text-danger">*</span></label>
                <select class="form-select" id="guest_salutation" name="guest_salutation">
                    <option value="" disabled {{ is_null($form->guest_salutation) ? 'selected' : '' }}>เลือกคำนำหน้า</option>
                    <option value="นาย" {{ $form->guest_salutation === 'นาย' ? 'selected' : '' }}>นาย</option>
                    <option value="นาง" {{ $form->guest_salutation === 'นาง' ? 'selected' : '' }}>นาง</option>
                    <option value="นางสาว" {{ $form->guest_salutation === 'นางสาว' ? 'selected' : '' }}>นางสาว</option>
                </select>
            </div>
            <div class="col-md-4">
                <label for="guest_name">ชื่อ</label>
                <input type="text" class="form-control" id="guest_name" name="guest_name" value="{{ $form->guest_name }}" required>
            </div>
            <div class="col-md-2">
                <label for="guest_age">อายุ</label>
                <input type="number" class="form-control" id="guest_age" name="guest_age" value="{{ $form->guest_age }}" required>
            </div>
        </div>

        <br>

        <div class="row">
            <div class="form-group col-md-3">
                <label for="guest_phone">อยู่บ้านเลขที่</label>
                <input type="text" class="form-control" id="guest_phone" name="guest_phone" value="{{ $form->guest_phone }}" required>
            </div>
            <div class="form-group col-md-3">
                <label for="guest_house_number">บ้านเลขที่</label>
                <input type="text" class="form-control" id="guest_house_number" name="guest_house_number" value="{{ $form->guest_house_number }}" required>
            </div>
            <div class="form-group col-md-3">
                <label for="guest_village">หมู่ที่</label>
                <input type="text" class="form-control" id="guest_village" name="guest_village" value="{{ $form->guest_village }}" required>
            </div>
            <div class="form-group col-md-3">
                <label for="guest_subdistrict">ตำบล</label>
                <input type="text" class="form-control" id="guest_subdistrict" name="guest_subdistrict" value="{{ $form->guest_subdistrict }}" required>
            </div>
            <div class="form-group col-md-3 mt-3">
                <label for="guest_district">อำเภอ</label>
                <input type="text" class="form-control" id="guest_district" name="guest_district" value="{{ $form->guest_district }}" required>
            </div>
            <div class="form-group col-md-3 mt-3">
                <label for="guest_province">จังหวัด</label>
                <input type="text" class="form-control" id="guest_province" name="guest_province" value="{{ $form->guest_province }}" required>
            </div>
        </div>

        <br>

        <div class="row col-md-6">
            <label for="request_details">มีความประสงค์</label>
            <textarea class="form-control" id="request_details" name="request_details" rows="3" required>{{ $form->request_details }}</textarea>
        </div>
        <br>
        <div class="row">
            <label for="attachments">แนบไฟล์(ภาพหรือเอกสาร) **ไม่ต้องแนบไฟล์ใหม่กรณีไม่ต้องการแก้ไขไฟล์</label>
            <input type="file" class="form-control-file" id="attachments" name="attachments[]" multiple>
        </div>
        <br>

        <button type="submit" class="btn btn-primary">ส่งฟอร์ม</button>
    </form>
</div>

@endsection
