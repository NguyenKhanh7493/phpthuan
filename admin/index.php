<?php
    session_start();
    if (!isset($_SESSION['fullname']) || $_SESSION['status'] != 1){
        header('location:/admin/login.php');
    }
    $title = 'Trang quản trị';
    include ('config/define.php');
?>

<?php include ('layout/head.php');?>
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><?php echo $title;?></h4>
        </div>
        <div class="col-lg-4 col-md-5 col-sm-5 col-xs-12">
            <?php if (isset($_SESSION['success']) && $_SESSION['success'] != ''){?>
                <div class="my-alert">
                    <div class="alert alert-success" style="height: 0;">
                        <p style="color:#0d4e02;text-align: center;line-height: 0;"><?php echo $_SESSION['success'];?></p>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="line-height: 0;">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <?php unset($_SESSION['success']);?>
            <?php }?>
        </div>
        <div class="col-lg-5 col-sm-3 col-md-3 col-xs-12">
            <ol class="breadcrumb">
<!--                <li><a href="#">Dashboard</a></li>-->
<!--                <li class="active">CRM Dashboard</li>-->
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <div class="white-box">
                <h3 class="box-title"> Trang quản trị </h3>
                <!-- sample modal content -->
                <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="modal-title" id="myModalLabel">Modal Heading</h4>
                            </div>
                            <div class="modal-body">
                                <h4>Điều khoản admin</h4>
                                <p>Cái này của khánh</p>
                                <p>Và Hiếu điên</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-info waves-effect" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->
                <!-- Button trigger modal -->
                <img src="<?=base_url?>/admin/assets/image/anh.jpg" alt="default" data-toggle="modal" data-target="#myModal" class="model_img img-responsive"/> </div>
        </div>
        <div class="col-md-4"></div>
    </div>
<?php include ('layout/footer.php');?>
