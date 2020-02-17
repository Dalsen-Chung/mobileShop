layui.use(['form', 'upload'], function(){
    var form = layui.form;
    var upload = layui.upload;
    
    //  上传单张商品封面图
    upload.render({
        elem: '#pd_cover_btn' //绑定元素
        ,url: 'upload_pd_img' //上传接口
        ,accept: 'images'
        ,size: 5120
        ,acceptMime: 'image/jpeg, image/png'
        ,field: 'pd_cover'
        ,done: function(res){
            let code = res.code;
            if (code === 0) {
                const fullPath = res.data.savepath + res.data.savename
                $("#pd_cover_img")[0].src = UPLOAD_URL + fullPath
                $("#pd_cover_img").show()
                $("#pd_cover").val(fullPath)
                layer.msg('封面上传成功，发布后生效');
            } else {
                layer.msg(`封面上传失败，${res.msg}`);
            }
        }
        ,error: function(){
            layer.msg('封面上传失败');
        }
    });

    //  上传多张商品详情图
    upload.render({
        elem: '#pd_imgs_btn' //绑定元素
        ,url: 'upload_pd_img' //上传接口
        ,accept: 'images'
        ,size: 5120
        ,acceptMime: 'image/jpeg, image/png'
        ,field: 'pd_cover'
        ,multiple: true
        ,done: function(res){
            console.log(res)
            let code = res.code;
            if (code === 0) {
                const fullPath = res.data.savepath + res.data.savename
                $(".upload_img_list").append(`<img src="${UPLOAD_URL + fullPath}" />`)
                $("#pd_imgs").val($("#pd_imgs").val() + fullPath +',')
            } else {
                layer.msg(`封面上传失败，${res.msg}`);
            }
        }
        ,allDone: function(obj){
            if (obj.successful === obj.total) {
                console.log($("#pd_imgs").val())
                layer.msg('封面上传成功，发布后生效');
            }
        }
        ,error: function(){
            layer.msg('商品详情图上传失败');
        }
    });

    //监听发布商品的表单提交事件
    form.on('submit(publishPd)', function (data) {
        var submitData = data.field //当前容器的全部表单字段，名值对形式：{name: value}
        console.log(submitData);
        // $.ajax({
        //     url: "add_brand",
        //     data: submitData,
        //     type: "Post",
        //     dataType: "json",
        //     success: function (data) {
        //         if (data) {
        //             layer.closeAll('page'); //关闭所有页面层
        //             layer.msg('添加成功');
        //             setTimeout(() => {
        //                 location.reload();
        //             }, 500);
        //         } else {
        //             layer.msg('添加失败');
        //         }
        //     },
        //     error: function (data) {
        //         layer.msg('添加失败');
        //     }
        // });
        return false; //阻止表单跳转。如果需要表单跳转，去掉这段即可。
    });
});