layui.use(['table','form'], function () {
    var table = layui.table;
    var form = layui.form;

    //订单表格配置
    var orderbOpt = {
        elem: '#orderList'
        , url: 'get_order_list' //数据接口
        , height: 'full-250'
        , page: true //开启分页
        , cols: [[ //表头
            { field: 'id', title: 'ID', sort: true, align: 'center', width: 60 }
            , { field: 'order_sn', title: '订单号', align: 'center', width: 190 }
            , { field: 'username', title: '用户昵称', align: 'center', minWidth: 120 }
            , { field: 'price', title: '订单价格(¥)', align: 'center', width: 110 }
            , { field: 'product_num', title: '商品数量(台)', align: 'center', minWidth: 110 }
            , { field: 'desc', title: '商品描述', align: 'center', minWidth: 240 }
            , { field: 'status_text', title: '订单状态', align: 'center', minWidth: 100 }
            , { field: 'tracking_num', title: '快递单号', align: 'center', minWidth: 100 }
            , { field: 'addtime', title: '下单时间', align: 'center', minWidth: 170 }
            , { title: '操作', align: 'center', toolbar: '#orderBar', width: 70 }
        ]]
    }
    //订单表格
    table.render(orderbOpt);

    //监听订单表格工具条 
    table.on('tool(orderTb)', function (obj) { //注：tool 是工具条事件名，test 是 table 原始容器的属性 lay-filter="对应的值"
        var data = obj.data; //获得当前行数据
        var layEvent = obj.event; //获得 lay-event 对应的值（也可以是表头的 event 参数对应的值）

        if (layEvent === 'deliver') { //发货
            //给表单赋值
            form.val("deliverForm", { //formTest 即 class="layui-form" 所在元素属性 lay-filter="" 对应的值
                "id": data.id,
                "tracking_num": '',  // "name": "value"
            });
            layer.open({
                type: 1,
                title: '订单发货',
                content: $('#deliverForm')
            })
            form.on('submit(confirmDeliver)', function (data) {
                var submitData = data.field //当前容器的全部表单字段，名值对形式：{name: value}
                $.ajax({
                    url: "deliver",
                    data: submitData,
                    type: "Post",
                    dataType: "json",
                    success: function (data) {
                        if (data) {
                            obj.update({
                                tracking_num: submitData.tracking_num,
                                status_text: '已发货'
                            });
                            layer.closeAll('page'); //关闭所有页面层
                            layer.msg('发货成功');
                        } else {
                            layer.msg('发货失败');
                        }
                    },
                    error: function (data) {
                        layer.msg('发货失败');
                    }
                });
                return false; //阻止表单跳转。如果需要表单跳转，去掉这段即可。
            });
        }
    });
});