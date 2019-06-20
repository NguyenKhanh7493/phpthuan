<?php
    session_start();
    include (__DIR__.'/../../config/define.php');
    include (__DIR__.'/../../config/database.php');
    $sql = "SELECT * FROM users ";
    $result = mysqli_query($db,$sql);
?>
<?php include (__DIR__.'/../../layout/head.php');?>
<div class="row">
    <div class="col-sm-12">
        <div class="white-box">
            <h3 class="box-title m-b-0">Danh sách sản phẩm</h3>
            <p class="text-muted m-b-30"></p>
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
                        <?php print_r($item);?>
                        <tr>
                            <td><?php echo $item['id']?></td>
                            <td><?php echo $item['fullname']?></td>
                            <td><?php echo $item['email']?></td>
                            <td><?php echo $item['phone']?></td>
                            <td>
                                <img src="<?=base_url?>/admin/public/admin/image/<?php echo $item['avatar']?>" width="80px;" height="80px;" alt="">
                            </td>
                            <td>
                                <a href="<?=base_url?>/admin/module/user/edit.php?id=<?php echo $item['id']?>" id="editItem"><i class="ti-pencil text-success"></i></a> |
                                <a href="" class="proDelItem" data-msg="Bạn muốn xóa?"><i class="ti-trash text-danger"></i></a>
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