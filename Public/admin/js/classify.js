layui.use(['table','form', 'upload'], function () {
    var table = layui.table;
    var form = layui.form;
    var upload = layui.upload;
 
    //分类表格配置
    var productClassifyTbOpt = {
        elem: '#classifyList'
        , url: 'get_classify_list' //数据接口
        , height: 'full-250'
        , page: true //开启分页
        , cols: [[ //表头
            { field: 'id', title: 'ID', sort: true, align: 'center' }
            , { field: 'name', title: '分类名称', align: 'center' }
            , { field: 'icon', title: '分类图标', align: 'center', templet: '#classifyTpl' }
            , { field: 'introduction', title: '分类简介', align: 'center' }
            , { field: 'addtime', title: '添加时间', align: 'center' }
            , { title: '操作', align: 'center', toolbar: '#classifyBar' }
        ]]
    }
    //品牌表格
    table.render(productClassifyTbOpt);

    //监听品牌表格工具条 
    table.on('tool(productClassifyTb)', function (obj) { //注：tool 是工具条事件名，test 是 table 原始容器的属性 lay-filter="对应的值"
        var data = obj.data; //获得当前行数据
        var layEvent = obj.event; //获得 lay-event 对应的值（也可以是表头的 event 参数对应的值）

        if (layEvent === 'del') { //删除
            layer.confirm('确认删除该分类', { icon: 3, title: '确认' }, function (index) {
                obj.del(); //删除对应行（tr）的DOM结构，并更新缓存
                layer.close(index);
                //向服务端发送删除指令
                $.ajax({
                    url: "delete_category",
                    data: {
                        'category_id': data.id
                    },
                    type: "Post",
                    dataType: "json",
                    success: function (data) {
                        layer.msg('删除成功');
                        if (data === 1) {
                            setTimeout(() => {
                                location.reload();
                            }, 500);
                        }
                    },
                    error: function (data) {
                        layer.msg('删除失败');
                    }
                });
            });
        } else if (layEvent === 'edit') { //编辑
            //给表单赋值
            form.val("editProductClassify", { //formTest 即 class="layui-form" 所在元素属性 lay-filter="" 对应的值
                "id": data.id,
                "name": data.name // "name": "value"
                , "icon": data.icon
                , "introduction": data.introduction
            });
            $("#edit_classify_icon")[0].src = UPLOAD_URL + data.icon;
            layer.open({
                type: 1,
                title: '编辑分类',
                content: $('#editProductClassify')
            })
            form.on('submit(classifyEditSave)', function (data) {
                var submitData = data.field //当前容器的全部表单字段，名值对形式：{name: value}
                $.ajax({
                    url: "edit_category",
                    data: submitData,
                    type: "Post",
                    dataType: "json",
                    success: function (data) {
                        if (data !== false) {
                            obj.update({
                                name: submitData.name
                                , icon: submitData.icon
                                , introduction: submitData.introduction
                            });
                            layer.closeAll('page'); //关闭所有页面层
                            layer.msg('编辑成功');
                        } else {
                            layer.msg('编辑失败');
                        }
                    },
                    error: function (data) {
                        layer.msg('编辑失败');
                    }
                });
                return false; //阻止表单跳转。如果需要表单跳转，去掉这段即可。
            });
        }
    });

    //监听添加品牌的按钮
    $('#addClassifyBtn').click(function () {
        layer.open({    //打开添加表单
            type: 1,
            title: '添加商品品牌',
            content: $('#addProductClassify')
        })
    });

    //监听添加品牌的表单提交事件
    form.on('submit(classifyAddSave)', function (data) {
        var submitData = data.field //当前容器的全部表单字段，名值对形式：{name: value}
        $.ajax({
            url: "add_category",
            data: submitData,
            type: "Post",
            dataType: "json",
            success: function (data) {
                if (data) {
                    layer.closeAll('page'); //关闭所有页面层
                    layer.msg('添加成功');
                    setTimeout(() => {
                        location.reload();
                    }, 500);
                } else {
                    layer.msg('添加失败');
                }
            },
            error: function (data) {
                layer.msg('添加失败');
            }
        });
        return false; //阻止表单跳转。如果需要表单跳转，去掉这段即可。
    });
     
    //  修改分类图标
    upload.render({
        elem: '#editClassifyIconUpload' //绑定元素
        ,url: 'upload_category_icon' //上传接口
        ,accept: 'images'
        ,size: 5120
        ,acceptMime: 'image/jpeg, image/png'
        ,field: 'category_icon'
        ,done: function(res){
            let code = res.code;
            if (code === 0) {
                const fullPath = res.data.savepath + res.data.savename
                $("#edit_classify_icon")[0].src = UPLOAD_URL + fullPath
                $("#edit_classify_icon_path").val(fullPath)
                layer.msg('图标上传成功，点击保存后生效');
            } else {
                layer.msg(`图标上传失败，${res.msg}`);
            }
        }
        ,error: function(){
            layer.msg('图标上传失败');
        }
    });

    //  添加品牌图标
    upload.render({
        elem: '#addClassifyIconUpload' //绑定元素
        ,url: 'upload_category_icon' //上传接口
        ,accept: 'images'
        ,size: 5120
        ,acceptMime: 'image/jpeg, image/png'
        ,field: 'category_icon'
        ,done: function(res){
            let code = res.code;
            if (code === 0) {
                const fullPath = res.data.savepath + res.data.savename
                $("#add_classify_icon")[0].src = UPLOAD_URL + fullPath
                $("#add_classify_icon").show()
                $("#add_classify_icon_path").val(fullPath)
                layer.msg('图标上传成功，点击保存后生效');
            } else {
                layer.msg(`图标上传失败，${res.msg}`);
            }
        }
        ,error: function(){
            layer.msg('图标上传失败');
        }
    });
});