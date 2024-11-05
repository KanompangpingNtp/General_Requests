<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body style="background-color: #566573;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card mt-5">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>
                            <a href="{{ route('userAccountFormsIndex')}}" style="text-decoration: none; color: black;">
                                <h3>คำร้องทั่วไป สป.</h3>
                            </a>
                        </span>
                        <div class="d-flex gap-2">
                            <div>
                                <a href="{{ route('userRecordForm')}}" class="btn btn-primary btn-sm">ประวัติการส่งฟอร์ม</a>
                            </div>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm">Logout</button>
                            </form>
                        </div>
                    </div>


                    <div class="card-body">
                        <br>

                        @yield('account_layout')

                        <br>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <br>
    <br>

    <footer style="background-color: #1c2833; color: white; padding: 20px; text-align: center;">
        <div>
            <p>&copy; 2024 Gm Sky Smartcity สงวนลิขสิทธิ์</p>
            <a href="#" style="color: white; text-decoration: none;">คู่มือการใช้งาน</a></p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
