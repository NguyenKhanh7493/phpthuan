$(document).ready(function(){
    $('a.proDelItem').click(function(){
        var id = $(this).attr('data-id');
        var avatar = $(this).attr('data-name');
        if (confirm('bạn có muốn xóa '+id)){
            $.ajax({
                url : '/admin/module/user/del.php',
                type : 'POST',
                data :{id:id,avatar:avatar},
                success:function(result){
                    console.log(result);
                    if(result == 'OK'){
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