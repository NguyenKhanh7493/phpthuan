$(document).ready(function(){
    $('a.proDelItem').click(function(){
        var id = $(this).attr('data-id');
        if (confirm('bạn có muốn xóa '+id)){
            $.ajax({
                url : '/admin/module/user/del.php',
                type : 'POST',
                data :{id:id},
                success:function($result){
                    console.log($result);
                    if($result == 'OK'){
                        $('tr#'+id).slideUp(500,function(){
                            $(this).remove();
                        });
                    }else{
                        alert("xóa thất bại");
                    }

                }
            });
        }
    });
});