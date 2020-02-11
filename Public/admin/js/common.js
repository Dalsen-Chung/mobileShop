layui.use(['element', 'table'], function () {
    var element = layui.element;
    var table = layui.table;
    
    //管理员用户表格
    table.render({
        elem: '#adminList'
        , url: 'get_admin_list' //数据接口
        , height: 'full-250'
        , page: true //开启分页
        , cols: [[ //表头
            { field: 'id', title: 'ID', sort: true, fixed: 'left', align: 'center' }
            , { field: 'name', title: '用户名', align: 'center' }
            , { field: 'account', title: '账号', align: 'center' }
            , { field: 'status', title: '状态', align: 'center' }
            , { field: 'addtime', title: '添加时间', align: 'center' }
            , { fixed: 'right', title: '操作', align: 'center', toolbar: '#adminBar' }
        ]]
    });

});