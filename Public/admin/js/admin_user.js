layui.use(['table','form'], function () {
    var table = layui.table;
    var form = layui.form;

    //管理员用户表格配置
    var adminUserTbOpt = {
        elem: '#adminList'
        , url: 'get_admin_list' //数据接口
        , height: 'full-250'
        , page: true //开启分页
        , cols: [[ //表头
            { field: 'id', title: 'ID', sort: true, align: 'center' }
            , { field: 'name', title: '用户名', align: 'center' }
            , { field: 'account', title: '账号', align: 'center' }
            , { field: 'status', title: '状态', align: 'center' }
            , { field: 'addtime', title: '添加时间', align: 'center' }
            , { fixed: 'right', title: '操作', align: 'center', toolbar: '#adminBar' }
        ]]
    }
    //管理员用户表格
    table.render(adminUserTbOpt);

    //监听管理员用户表格工具条 
    table.on('tool(adminUserTb)', function (obj) { //注：tool 是工具条事件名，test 是 table 原始容器的属性 lay-filter="对应的值"
        var data = obj.data; //获得当前行数据
        var layEvent = obj.event; //获得 lay-event 对应的值（也可以是表头的 event 参数对应的值）

        if (layEvent === 'del') { //删除
            layer.confirm('确认删除该用户', { icon: 3, title: '确认' }, function (index) {
                obj.del(); //删除对应行（tr）的DOM结构，并更新缓存
                layer.close(index);
                //向服务端发送删除指令
                $.ajax({
                    url: "delete_admin",
                    data: {
                        'user_id': data.id
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
            form.val("editAdminUser", { //formTest 即 class="layui-form" 所在元素属性 lay-filter="" 对应的值
                "id": data.id,
                "name": data.name // "name": "value"
                , "status": data.status === '正常' ? '1' : '0' 
                , "password": ""
            });
            layer.open({
                type: 1,
                title: '编辑管理员',
                content: $('#editAdminUser')
            })
            form.on('submit(adminEditSave)', function (data) {
                var submitData = data.field //当前容器的全部表单字段，名值对形式：{name: value}
                $.ajax({
                    url: "edit_admin",
                    data: submitData,
                    type: "Post",
                    dataType: "json",
                    success: function (data) {
                        if (data !== false) {
                            obj.update({
                                name: submitData.name
                                , status: submitData.status == '1' ? '正常' : '禁用'
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

    //监听添加管理员用户的按钮
    $('#addAdminBtn').click(function () {
        layer.open({    //打开添加表单
            type: 1,
            title: '添加管理员',
            content: $('#addAdminUser')
        })
    });

    //监听添加管理员的表单提交事件
    form.on('submit(addAddSave)', function (data) {
        var submitData = data.field //当前容器的全部表单字段，名值对形式：{name: value}
        console.log(submitData)
        $.ajax({
            url: "add_admin",
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
});