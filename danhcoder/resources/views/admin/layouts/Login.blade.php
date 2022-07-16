<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <title>Đăng nhập hệ thống</title>
    <style>
        @import url("//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css");

        .login-block {
            background: #DE6262;
            background: -webkit-linear-gradient(to bottom, #FFB88C, #DE6262);
            background: linear-gradient(to bottom, #FFB88C, #DE6262);
            float: left;
            width: 100%;
            padding: 70px 0;
            height: 100vh;
        }

        .banner-sec {
            background: url(https://stockdep.net/files/images/47233641.jpg) no-repeat left bottom;
            background-size: cover;
            height: 450px;
            border-radius: 0 10px 10px 0;
            padding: 0;
        }

        .container {
            background: #fff;
            border-radius: 10px;
            box-shadow: 15px 20px 0px rgba(0, 0, 0, 0.1);
        }

        .carousel-inner {
            border-radius: 0 10px 10px 0;
        }

        .carousel-caption {
            text-align: left;
            left: 5%;
        }

        .login-sec {
            padding: 50px 30px;
            position: relative;
        }

        .login-sec .copy-text {
            position: absolute;
            width: 80%;
            bottom: 20px;
            font-size: 13px;
            text-align: center;
        }

        .login-sec .copy-text i {
            color: #FEB58A;
        }

        .login-sec .copy-text a {
            color: #E36262;
        }

        .login-sec h2 {
            margin-bottom: 30px;
            font-weight: 800;
            font-size: 30px;
            color: #DE6262;
        }

        .login-sec h2:after {
            content: " ";
            width: 100px;
            height: 5px;
            background: #FEB58A;
            display: block;
            margin-top: 20px;
            border-radius: 3px;
            margin-left: auto;
            margin-right: auto
        }

        .btn-login {
            background: #DE6262;
            color: #fff;
            font-weight: 600;
        }

        .banner-text {
            width: 115%;
            position: absolute;
            bottom: 40px;
            padding: 20px;
            background-color: #0808087d;
            text-align: center;
            border-radius: 5px;
        }

        .banner-text h2 {
            color: #fff;
            font-weight: 600;
        }

        .banner-text h2:after {
            content: " ";
            width: 100px;
            height: 5px;
            background: #FFF;
            display: block;
            margin: 20px auto;
            border-radius: 3px;
        }

        .banner-text p {
            color: #fff;
        }
    </style>
</head>

<body>
    <section class="login-block">
        <div class="container">
            <div class="row">
                <div class="col-md-5 login-sec">
                    <h2 class="text-center">Đăng Nhập</h2>
                    @yield('content')
                    <div class="copy-text">Created with <i class="fa fa-heart"></i> by Dịch vụ số Media Great</div>
                </div>
                <div class="col-md-7 banner-sec">
                    <!-- <img class="d-block img-fluid" src="https://images.pexels.com/photos/872957/pexels-photo-872957.jpeg" alt="First slide"> -->
                    <div class="carousel-caption d-none d-md-block">
                        <div class="banner-text">
                            <h2>Hỗ trợ quản trị website hiệu quả</h2>
                            <p>"Với kinh nghiệm đào tạo và triển khai các chiến dịch Digital Marketing cho hàng trăm dự án Doanh nghiệp lớn, nhỏ cả trong và ngoài nước. Chúng tôi với những chuyên gia hàng đầu trong lĩnh vực Digital Marketing. </p>
                        </div>
                    </div>
                </div>
            </div>
    </section>
</body>

</html>