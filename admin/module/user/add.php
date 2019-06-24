<?php
    session_start();
    include (__DIR__.'/../../config/define.php');
    include (__DIR__.'/../../config/function.php');
    include (__DIR__.'/../../config/database.php');
    if (isset($_POST['email'])){
        $sql = "SELECT email FROM users WHERE email = '".$_POST['email']."'";
        $row = mysqli_query($db,$sql);
        $list = mysqli_num_rows($row);
    }
    $title = "Thêm quản trị";
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $error = array();
        $success = array();
        $status = isset($_POST['status'])?$_POST['status']:0;
        $created_at = date('Y/m/d H:i:s');
        if (empty($_POST['fullname'])){
            $error['fullname'] = "(*) Bạn chưa nhập tên";
        }else{
            if (strlen($_POST['fullname']) < 5 ){
                $error['fullname'] = '(*) Họ tên phải lớn hơn 5 ký tự';
            }else{
                $fullname = $_POST['fullname'];
            }
        }
        if (empty($_POST['email'])){
            $error['email'] = "(*) Bạn chưa nhập email";
        }elseif ($list > 0){
            $error['email'] = "Email bạn nhập bị trùng";
        }else{
            $patten = '/^[A-Za-z0-9_.]{6,32}@([a-zA-Z0-9]{2,12})(.[a-zA-Z]{2,12})+$/';
            if (!preg_match($patten,$_POST['email'])){
                $error['email'] = "(*) Bạn nhập sai định dạng email";
            }
            $email = $_POST['email'];
        }
        if (empty($_POST['password'])){
            $error['password'] = "(*) Bạn chưa nhập mật khẩu";
        }else{
            $patten = '/^([A-Za-z0-9])([\w_\.!@#$%^&*()]+){5,31}$/';
            if (!preg_match($patten,$_POST['password'])){
                $error['password'] = "(*) Mật khẩu phải hơn 6 ký tự và nhỏ hơn 31 ký tự";
            }else{
                $password = $_POST['password'];
            }
        }
        if (empty($_POST['repassword'])){
            $error['repassword'] = "(*) Bạn chưa nhập lại mật khẩu";
        }
        if ($_POST['password'] != $_POST['repassword']){
            $error['repassword'] = "(*) Nhập lại mật khẩu không đúng";
        }
        if (empty($_POST['phone'])){
            $error['phone'] = "(*) Bạn chưa nhập số điện thoại";
        }else{
            $patten = '/^[0-9]{10,11}$/';
            if (!preg_match($patten,$_POST['phone'])){
                $error['phone'] = "(*) Bạn nhập số điện thoại bị sai";
            }else{
                $phone = $_POST['phone'];
            }
        }
        if ($_FILES['avatar']['error'] != null){
            $error['avatar'] = "(*) Bạn chưa chọn ảnh";
        }
        if (empty($error)){
            $name_avatar = $_FILES['avatar']['name'];
            $name_type = $_FILES['avatar']['type'];
            $name_size = $_FILES['avatar']['size'];
            $name_tmp = $_FILES['avatar']['tmp_name'];
            $path = '../../public/admin/image/';
            if ($name_type == 'image/jpeg' || $name_type == 'image/jpg' || $name_type == 'image/png' || $name_type == 'image/gif'){
                if ($name_size < 10485760){
                    if (!file_exists($path.$name_avatar)){
                        if (move_uploaded_file($name_tmp,$path.$name_avatar)){
                            $sql = "INSERT INTO `users`(`fullname`,`email`,`password`,`avatar`,`phone`,`status`,`created_at`)
                                    VALUES ('".$fullname."','".$email."','".md5($password)."','".$name_avatar."','".$phone."','".$status."','".$created_at."')";
                            print_r($sql);
                            $result = mysqli_query($db,$sql);
                            if($result){
                                header('location:/admin/module/user/list.php');
                                $_SESSION['add_user'] = "Thêm thành công";
                            }else{
                                $error['fail'] = "Thêm thất bại";
                            }
                        }else{
                            $error['avatar'] = "upload thất bại";
                        }
                    }else{
                        $error['avatar'] = "Ảnh đã tồn tại";
                    }
                }else{
                    $error['avatar'] = "Kích thước ảnh quá lớn";
                }
            }else{
                $error['avatar'] = "Bạn nhập sai định dạng đuôi ảnh (jpeg,jpg,png,gif)";
            }
        }
    }
?>
<?php include (__DIR__.'/../../layout/head.php');?>
<div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title"><?php echo $title;?></h4>
    </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
            <!--                <li><a href="#">Dashboard</a></li>-->
            <!--                <li class="active">CRM Dashboard</li>-->
        </ol>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="row">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="col-md-8">
            <div class="white-box">
                <h3 class="box-title m-b-0">Thêm mới admin</h3>
                <p class="text-muted m-b-30 font-13"></p>
                <?php if (isset($success['success'])){?>
                    <div class="my-alert">
                        <div class="alert alert-success" style="height: 0;">
                            <p style="color:#0d4e02;text-align: center;line-height: 0;">Thêm mới thành công</p>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="line-height: 0;">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                <?php }elseif (isset($error['fail'])){?>
                    <div class="my-alert">
                        <div class="alert alert-danger" style="height: 0;">
                            <p style="color:#882406;text-align: center;line-height: 0;">Thêm mới thất bại</p>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="line-height: 0;">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                <?php }?>
                <div class="row">
                    <div class="col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Họ tên</label>
                            <input type="text" class="form-control" name="fullname" placeholder="Xin mời nhập họ tên" value="<?php if (isset($_POST['fullname'])) echo $_POST['fullname'];?>">
                            <?php if (isset($error['fullname'])){?>
                                <span style="color: red;"><?php echo $error['fullname']?></span>
                            <?php }?>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <input type="email" class="form-control" name="email" placeholder="Xin mời nhập email" value="<?php if (isset($_POST['email'])) echo $_POST['email'];?>">
                            <?php if (isset($error['email'])){?>
                                <span style="color: red;"><?php echo $error['email']?></span>
                            <?php }?>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mật khẩu</label>
                            <input type="password" class="form-control" name="password" placeholder="Xin mời nhập mật khẩu">
                            <?php if (isset($error['password'])){?>
                                <span style="color: red;"><?php echo $error['password']?></span>
                            <?php }?>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Nhập lại mật khẩu</label>
                            <input type="password" class="form-control" name="repassword" placeholder="Nhập lại mật khẩu">
                            <?php if (isset($error['repassword'])){?>
                                <span style="color: red;"><?php echo $error['repassword']?></span>
                            <?php }?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="white-box">
                <div class="row">
                    <div class="col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Số điện thoại</label>
                            <input type="text" class="form-control" name="phone" placeholder="Nhập số điện thoại" value="<?php if (isset($_POST['phone'])) echo $_POST['phone'];?>">
                            <?php if (isset($error['phone'])){?>
                                <span style="color: red;"><?php echo $error['phone']?></span>
                            <?php }?>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Trạng thái</label>
                            <input type="checkbox" id="status" value="1" name="status"  class="js-switch" data-color="#99d683"/>
                        </div>
                        <div class="form-group">
                            <div class="white-box">
                                <h3 class="box-title">Ảnh đại diện </h3>
                                <input type="file" id="input-file-disable-remove" name="avatar" class="dropify" data-show-remove="true" multiple value="" />
                                <?php if (isset($error['avatar'])){?>
                                    <span style="color: red;"><?php echo $error['avatar']?></span>
                                <?php }?>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success waves-effect waves-light m-r-10" name="add_user">Thêm</button>
                        <button type="submit" class="btn btn-inverse waves-effect waves-light">Hủy</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<?php include (__DIR__.'/../../layout/footer.php');?>