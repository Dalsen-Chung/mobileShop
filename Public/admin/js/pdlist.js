layui.use(['table', 'form', 'upload'], function () {
  var table = layui.table;
  var form = layui.form;
  var upload = layui.upload;

  //商品表格配置
  var productListTbOpt = {
    elem: '#pdBar'
    , url: 'get_product_list' //数据接口
    , height: 'full-250'
    , page: true //开启分页
    , cols: [[ //表头
      { field: 'id', title: 'ID', sort: true, align: 'center' }
      , { field: 'name', title: '商品名称', align: 'center' }
      , { field: 'intro', title: '广告语', align: 'center' }
      , { field: 'price', title: '单价(¥)', align: 'center' }
      , { field: 'photo', title: '商品封面', align: 'center' }
      , { field: 'content', title: '商品详情', align: 'center' }
      , { field: 'photo_list', title: '详情图片组', align: 'center' }
      , { field: 'stock', title: '库存(台)', align: 'center' }
      , { field: 'status', title: '状态', align: 'center' }
      , { field: 'is_hot', title: '是否热卖', align: 'center' }
      , { field: 'updatetime', title: '更新时间', align: 'center' }
      , { field: 'addtime', title: '添加时间', align: 'center' }
      , { title: '操作', align: 'center', toolbar: '#brandBar' }
    ]]
  }
  //品牌表格
  table.render(productListTbOpt);

  //监听品牌表格工具条 
  table.on('tool(productBrandTb)', function (obj) { //注：tool 是工具条事件名，test 是 table 原始容器的属性 lay-filter="对应的值"
    var data = obj.data; //获得当前行数据
    var layEvent = obj.event; //获得 lay-event 对应的值（也可以是表头的 event 参数对应的值）

    if (layEvent === 'del') { //删除
      layer.confirm('确认删除该品牌', { icon: 3, title: '确认' }, function (index) {
        obj.del(); //删除对应行（tr）的DOM结构，并更新缓存
        layer.close(index);
        //向服务端发送删除指令
        $.ajax({
          url: "delete_brand",
          data: {
            'brand_id': data.id
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
      form.val("editProductBrand", { //formTest 即 class="layui-form" 所在元素属性 lay-filter="" 对应的值
        "id": data.id,
        "name": data.name // "name": "value"
        , "icon": data.icon
      });
      $("#brandIcon")[0].src = UPLOAD_URL + data.icon;
      layer.open({
        type: 1,
        title: '编辑品牌',
        content: $('#editProductBrand')
      })
      form.on('submit(brandEditSave)', function (data) {
        var submitData = data.field //当前容器的全部表单字段，名值对形式：{name: value}
        $.ajax({
          url: "edit_brand",
          data: submitData,
          type: "Post",
          dataType: "json",
          success: function (data) {
            if (data !== false) {
              obj.update({
                name: submitData.name
                , icon: submitData.icon
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
  $('#addBrandBtn').click(function () {
    layer.open({    //打开添加表单
      type: 1,
      title: '添加商品品牌',
      content: $('#addProductBrand')
    })
  });

  //监听添加品牌的表单提交事件
  form.on('submit(brandAddSave)', function (data) {
    var submitData = data.field //当前容器的全部表单字段，名值对形式：{name: value}
    $.ajax({
      url: "add_brand",
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

  //  修改品牌图标
  upload.render({
    elem: '#editIconUpload' //绑定元素
    , url: 'upload_brand_icon' //上传接口
    , accept: 'images'
    , size: 5120
    , acceptMime: 'image/jpeg, image/png'
    , field: 'brand_icon'
    , done: function (res) {
      let code = res.code;
      if (code === 0) {
        const fullPath = res.data.savepath + res.data.savename
        $("#brandIcon")[0].src = UPLOAD_URL + fullPath
        $("#icon_path").val(fullPath)
        layer.msg('图标上传成功，点击保存后生效');
      } else {
        layer.msg(`图标上传失败，${res.msg}`);
      }
    }
    , error: function () {
      layer.msg('图标上传失败');
    }
  });

  //  添加品牌图标
  upload.render({
    elem: '#addIconUpload' //绑定元素
    , url: 'upload_brand_icon' //上传接口
    , accept: 'images'
    , size: 5120
    , acceptMime: 'image/jpeg, image/png'
    , field: 'brand_icon'
    , done: function (res) {
      let code = res.code;
      if (code === 0) {
        const fullPath = res.data.savepath + res.data.savename
        $("#add_brand_icon")[0].src = UPLOAD_URL + fullPath
        $("#add_brand_icon").show()
        $("#add_icon_path").val(fullPath)
        layer.msg('图标上传成功，点击保存后生效');
      } else {
        layer.msg(`图标上传失败，${res.msg}`);
      }
    }
    , error: function () {
      layer.msg('图标上传失败');
    }
  });
});