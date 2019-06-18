<?php
    session_start();
    if (isset($_SESSION['fullname']) && isset($_SESSION['status']) == 1){
        header('location:/admin/index.php');
    }
    include ('config/define.php');
    include ('config/database.php');
    include ('config/function.php');

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $error = array();
        $success = array();
        if (empty($_POST['email'])){
            $error['email'] = "(*) Bạn chưa nhập email";
        }else{
            $pattern = '/^[A-Za-z0-9_.]{6,32}@([a-zA-Z0-9]{2,12})(.[a-zA-Z]{2,12})+$/';
            if (!preg_match($pattern,$_POST['email'])){
                $error['email'] = "Bạn nhập không đúng định dạng email";
            }else{
                $email = $_POST['email'];
            }
        }
        if (empty($_POST['password'])){
            $error['password'] = "(*) Bạn chưa nhập mật khẩu";
        }else{
            $pattern = '/^[A-Za-z0-9_\.]{6,32}$/';
            if (!preg_match($pattern,$_POST['password'])){
                $error['password'] = "Mật khẩu phải hơn 6 ký tự và không chứa ký tự đặc biệt";
            }else{
                $password = $_POST['password'];
            }
        }
//        // Xử lý để tránh MySQL injection
//        $email = stripslashes($email);
//        $pass = stripslashes($password);
//        $email = mysqli_real_escape_string($db,$email);
//        $pass = mysqli_real_escape_string($db,$pass);
        if (empty($error)){
            $sql = "SELECT * FROM users WHERE email = '".$email."' and password = '".md5($password)."'";
            $result = mysqli_query($db,$sql);
            if (mysqli_num_rows($result) > 0){
                $data = mysqli_fetch_assoc($result);
                $_SESSION['fullname'] = $data['fullname'];
                $_SESSION['status'] = $data['status'];
                header('location:/admin/index.php');
                $_SESSION['success'] = "Đăng nhập thành công";
            }else{
                $error['fail'] = "Đăng nhập thất bại";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <title>Chào bạn đến với admin</title>

        <!-- GOOGLE FONTS -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500|Poppins:400,500,600,700|Roboto:400,500" rel="stylesheet"/>
        <link href="https://cdn.materialdesignicons.com/3.0.39/css/materialdesignicons.min.css" rel="stylesheet" />

        <!-- PLUGINS CSS STYLE -->
        <link href="assets/plugins/toaster/toastr.min.css" rel="stylesheet" />
        <link href="assets/plugins/nprogress/nprogress.css" rel="stylesheet" />
        <link href="assets/plugins/flag-icons/css/flag-icon.min.css" rel="stylesheet"/>
        <link href="assets/plugins/jvectormap/jquery-jvectormap-2.0.3.css" rel="stylesheet" />
        <link href="assets/plugins/ladda/ladda.min.css" rel="stylesheet" />
        <link href="assets/plugins/select2/css/select2.min.css" rel="stylesheet" />
        <link href="assets/plugins/daterangepicker/daterangepicker.css" rel="stylesheet" />

        <!-- SLEEK CSS -->
        <link id="sleek-css" rel="stylesheet" href="assets/css/sleek.css" />



        <!-- FAVICON -->
        <link href="assets/img/favicon.png" rel="shortcut icon" />

        <!--
          HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries
        -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <script src="assets/plugins/nprogress/nprogress.js"></script>
    </head>

</head>
<body class="bg-light-gray" id="body">
<div class="container d-flex flex-column justify-content-between vh-100">
    <div class="row justify-content-center mt-5">
        <div class="col-xl-5 col-lg-6 col-md-10">
            <div class="card">
                <div class="card-header bg-primary">
                    <div class="app-brand">
                        <a href="/index.html">
                            <svg class="brand-icon" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid" width="30" height="33"
                                 viewBox="0 0 30 33">
                                <g fill="none" fill-rule="evenodd">
                                    <path class="logo-fill-blue" fill="#7DBCFF" d="M0 4v25l8 4V0zM22 4v25l8 4V0z" />
                                    <path class="logo-fill-white" fill="#FFF" d="M11 4v25l8 4V0z" />
                                </g>
                            </svg>
                            <span class="brand-name">N_2_K</span>
                        </a>
                    </div>
                </div>
                <div class="card-body p-5">

                    <h4 class="text-dark mb-5">ĐĂNG NHẬP</h4>
                    <?php if (isset($error['fail'])){?>
                        <div class="alert alert-dismissible fade show alert-danger" role="alert" style="height: 0px;">
                            <p style="line-height: 0;color: #c02222;"><?php echo $error['fail']?></p>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="line-height: 0;">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php }?>
                    <form action="" method="post">
                        <div class="row">
                            <div class="form-group col-md-12 mb-4">
                                <input type="email" class="form-control input-lg" name="email" aria-describedby="emailHelp" placeholder="Nhập email" value="<?php if (isset($_POST['email'])) echo $_POST['email'] ;?>">
                                <?php if (isset($error['email'])){?>
                                <span style="color: red"><?php echo $error['email'];?></span>
                                <?php }?>
                            </div>
                            <div class="form-group col-md-12 ">
                                <input type="password" class="form-control input-lg" name="password" placeholder="Nhập mật khẩu">
                                <?php if (isset($error['password'])){?>
                                    <span style="color: red"><?php echo $error['password'];?></span>
                                <?php }?>
                            </div>
                            <div class="col-md-12">
                                <div class="d-flex my-2 justify-content-between">
                                    <div class="d-inline-block mr-3">
                                        <label class="control control-checkbox">Remember me
                                            <input type="checkbox" />
                                            <div class="control-indicator"></div>
                                        </label>

                                    </div>
<!--                                    <p><a class="text-blue" href="#">Forgot Your Password?</a></p>-->
                                </div>
                                <button type="submit" class="btn btn-lg btn-primary btn-block mb-4" name="btn_login">Đăng nhập</button>
                                <p>Bạn chưa có tài khoản ?
                                    <a class="text-blue" href="sign-up.html">Đăng ký</a>
                                </p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright pl-0">
        <p class="text-center">&copy; 2019 Website được phát triển bởi
            <a class="text-primary" href="https://www.facebook.com/nguyenkhanh.N2K" target="_blank">Nguyễn Khánh</a>.
        </p>
    </div>
</div>
<script src="assets/plugins/jquery/jquery.min.js"></script>
<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>