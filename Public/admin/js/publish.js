layui.use(['form', 'upload'], function(){
    var form = layui.form;
    var upload = layui.upload;
    
    //  上传单张商品封面图
    upload.render({
        elem: '#pd_cover_btn' //绑定元素
        ,url: 'upload_pd_img' //上传接口
        ,accept: 'images'
        ,size: 5120
        ,acceptMime: 'image/jpg, image/png'
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
        ,acceptMime: 'image/jpg, image/png'
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
});