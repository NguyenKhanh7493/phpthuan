<?php
    session_start();
    include (__DIR__.'/../../config/define.php');
    include (__DIR__.'/../../config/database.php');
    $title = "Danh sách sản phẩm";
    $sql = "SELECT count(id) as total FROM users";
    $result = mysqli_query($db,$sql);
    $row = mysqli_fetch_assoc($result);
    //
    $total_records = $row['total'];
    $current_page = isset($_GET['page'])?$_GET['page']:1;
    $limit= 2;
    $total_page = ceil($total_records/$limit);
    if ($current_page > $total_page){
        $current_page = $total_page;
    }elseif ($current_page < 1){
        $current_page = 1;
    }
    $start = ($current_page - 1)*$limit;
    $sql = "SELECT * FROM users LIMIT $start,$limit";
    $target = mysqli_query($db,$sql);
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
                    <?php while ($item = mysqli_fetch_assoc($target)){?>
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
                                <a href="javascript:void(0)" class="proDelItem" data-id="<?=$item['id']?>" data-name="<?=$item['avatar']?>"><i class="ti-trash text-danger"></i></a>
                            </td>
                        </tr>
                    <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!--test-->
    <nav aria-label="...">
        <ul class="pagination">
            <?php if ($current_page > 1 && $total_page > 1){
                echo '<li class="page-item"><a href="/admin/module/user/list.php?page='.($current_page - 1).'" class="page-link" >Lùi</a></li>';
            }?>
            <?php
            for ($i=1;$i<=$total_page;$i++){
                if ($i == $current_page){
                    echo '<li class="page-item active"><span class="page-link">'.$i.'<span class="sr-only">(current)</span></span></li>';
                }else{
                    echo '<li class="page-item"><a class="page-link" href="/admin/module/user/list.php?page='.$i.'">'.$i.'</a></li>';
                }
            }
            ?>
            <?php if ($current_page < $total_page && $total_page > 1){
                echo '<li class="page-item"><a class="page-link" href="/admin/module/user/list.php?page='.($current_page + 1).'">Tới</a></li>';
            }?>
        </ul>
    </nav>
<!--end-->
<?php
    $pagination = [$current_page]; // Đây là mảng lưu các trang sẽ xuất hiện ở phần phân trang
    while (count($pagination) < 5 ){ // Sẽ chạy vòng lặp cho đến khi nào mảng này có đủ 5 phần tử thì thôi
        $left = $pagination[0] - 1; // Phần tử tiếp theo ở bên trái sẽ là phần tử bên trái ở thời điểm hiện tại trừ đi 1
        $right = $pagination[count($pagination) - 1] + 1; // Phần tử tiếp theo ở bên phải sẽ là phần tử bên phải ở thời điểm hiện tại cộng với 1
        $added = false; //Biến kiểm tra xem có trang mới được thêm vào không
        if ($left > 0){
            array_unshift($pagination,$left); //đẩy page mới vào đầu mảng
            $added = true;
        }
        if ($right <= $total_page){
            array_push($pagination,$right); // đẩy page mới vào cuối mảng
            $added = true;
        }
        if (!$added){ // Nếu cả bên trái lẫn bên phải đều không thể thêm phần tử nào vào nữa, thì break khỏi vòng lặp
            break;
        }
    }
    // Sau vòng lặp này bạn sẽ có một mảng có tối đa là 5 trang
//    if ($pagination[0] != $current_page){ // Nếu trang ngoài cùng bên trái, mà không phải là current page, thì sẽ có nút Previous
//        array_unshift($pagination,'lùi');
//    }
//    if ($pagination[count($pagination) - 1] != $current_page){ // Nếu trang ngoài cùng bên phải, mà không phải là current page, thì sẽ có nút Next
//        array_push($pagination,'tới');
//    }
    echo "<pre>";
    print_r($pagination);
    echo "</pre>";
?>
<?php foreach ($pagination as $val){?>
    <nav aria-label="...">
        <ul class="pagination">
            <?php if ($current_page > 1 && $total_page > 1){
                echo '<li class="page-item"><a href="/admin/module/user/list.php?page='.($current_page - 1).'" class="page-link" >Lùi</a></li>';
            }?>
            <li class="page-item"><a class="page-link" href="/admin/module/user/list.php?page=<?=$val?>"><?=$val?></a></li>
            <?php if ($current_page < $total_page && $total_page > 1){
                echo '<li class="page-item"><a class="page-link" href="/admin/module/user/list.php?page='.($current_page + 1).'">Tới</a></li>';
            }?>
        </ul>
    </nav>
    <?php }?>
<?php include (__DIR__.'/../../layout/footer.php');?>