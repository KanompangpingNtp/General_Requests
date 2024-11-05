<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <body style="background-color: #566573;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card mt-5">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <span>
                                <a href="" style="text-decoration: none; color: black;">
                                    <h3>คำร้องทั่วไป สป.</h3>
                                </a>
                            </span>
                            <div>
                                <a href="{{route('showLoginForm')}}" class="btn btn-info btn-sm">เข้าสู่ระบบ</a>
                                {{-- <a href="{{route('showRegisterForm')}}" class="btn btn-secondary btn-sm">สมัครเข้าใช้งานระบบ</a> --}}
                            </div>
                        </div>

                        <br>

                        @yield('user_layout')

                        <br>

                    </div>
                </div>
            </div>
        </div>

        <br>
        <br>

        <footer style="background-color: #1c2833; color: white; padding: 20px; text-align: center;">
            <div>
                <p>&copy; สงวนลิขสิทธิ์</p>
                <p><a href="" style="color: white; text-decoration: none;">สำหรับผู้ดูแลระบบ</a> | <a href="#" style="color: white; text-decoration: none;">คู่มือการใช้งาน</a></p>
            </div>
        </footer>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</body>
</html>
