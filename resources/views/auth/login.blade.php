@extends('layout.users_layout')
@section('user_layout')

{{-- <div class="container">
    <h3>login</h3>
    <br>
    <form action="{{ route('login.submit') }}" method="POST">
        @csrf
        <input type="email" name="email" placeholder="อีเมล">
        <input type="password" name="password" placeholder="รหัสผ่าน">
        <button type="submit">เข้าสู่ระบบ</button>
    </form>

</div> --}}

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header text-center bg-primary text-white">
                    <h3>เข้าสู่ระบบ</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('login.submit') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">อีเมล</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="อีเมล" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">รหัสผ่าน</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="รหัสผ่าน" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">เข้าสู่ระบบ</button>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center">
                    <small>ยังไม่มีบัญชี? <a href="{{ route('showRegisterForm') }}">สมัครสมาชิก</a></small>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
