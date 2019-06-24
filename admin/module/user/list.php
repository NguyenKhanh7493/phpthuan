<?php
    session_start();
    include (__DIR__.'/../../config/define.php');
    include (__DIR__.'/../../config/database.php');
    $title = "Danh sách sản phẩm";
    $sql = "SELECT * FROM users ";
    $result = mysqli_query($db,$sql);
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
    <div class="col-sm-12">
        <div class="white-box">
            <h3 class="box-title m-b-0">Danh sách sản phẩm</h3>
            <p class="text-muted m-b-30"></p>
            <?php if (isset($_SESSION['add_user'])){?>
                    <div class="my-alert">
                        <div class="alert alert-success" style="height: 0;">
                            <p style="color:#0d4e02;text-align: center;line-height: 0;"><?php echo $_SESSION['add_user']?></p>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="line-height: 0;">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                <?php unset($_SESSION['add_user']);?>
                <?php } ?>
            <div class="table-responsive">
                <table id="myTable" class="table table-striped">
                    <thead>
                    <tr>
                        <th>id</th>
                        <th>Họ tên</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>avatar</th>
                        <th>tùy chọn</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php while ($item = mysqli_fetch_assoc($result)){?>
                        <tr id="<?=$item['id']?>">
                            <td><?php echo $item['id']?></td>
                            <td><?php echo $item['fullname']?></td>
                            <td><?php echo $item['email']?></td>
                            <td><?php echo $item['phone']?></td>
                            <td>
                                <img src="<?=base_url?>/admin/public/admin/image/<?php echo $item['avatar']?>" width="80px;" height="80px;" alt="">
                            </td>
                            <td>
                                <a href="<?=base_url?>/admin/module/user/edit.php?id=<?php echo $item['id']?>" id="editItem"><i class="ti-pencil text-success"></i></a> |
                                <a href="javascript:void(0)" class="proDelItem" data-id="<?=$item['id']?>"><i class="ti-trash text-danger"></i></a>
                            </td>
                        </tr>
                    <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php include (__DIR__.'/../../layout/footer.php');?>