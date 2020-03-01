layui.use(['table', 'form', 'upload'], function () {
  var table = layui.table;
  var form = layui.form;
  var upload = layui.upload;

  //商品表格配置
  var productListTbOpt = {
    elem: '#pdList'
    , url: 'get_product_list' //数据接口
    , height: 'full-250'
    , page: true //开启分页
    , cellMinWidth: 100
    , cols: [[ //表头
      { field: 'id', title: 'ID', sort: true, align: 'center', width: 70 }
      , { field: 'name', title: '商品名称', align: 'center' }
      , { field: 'brand_name', title: '品牌', align: 'center' }
      , { field: 'photo', title: '商品封面', align: 'center', templet: '#pd_cover_Tpl' }
      , { field: 'price', title: '单价(¥)', align: 'center' }
      , { field: 'stock', title: '库存(台)', align: 'center' }
      , { field: 'cid', title: '分类ID', align: 'center', hide: true }
      , { field: 'category_name', title: '分类', align: 'center' }
      , { field: 'brand_id', title: '品牌ID', align: 'center', hide: true }
      , { field: 'intro', title: '广告语', align: 'center' }
      , { field: 'content', title: '商品详情', align: 'center' }
      , { field: 'photo_list', title: '详情图片组', align: 'center', templet: '#pd_imgs_Tpl' }
      , { field: 'sales', title: '销量(台)', align: 'center' }
      , { field: 'status', title: '状态', align: 'center' }
      , { field: 'is_hot', title: '是否热卖', align: 'center' }
      , { field: 'updatetime', title: '更新时间', align: 'center', minWidth: 170 }
      , { field: 'addtime', title: '添加时间', align: 'center', minWidth: 170 }
      , { title: '操作', align: 'center', toolbar: '#pdBar', minWidth: 130 }
    ]]
  }
  //渲染商品表格
  table.render(productListTbOpt);

  //监听品牌表格工具条 
  table.on('tool(pdListTb)', function (obj) { //注：tool 是工具条事件名，test 是 table 原始容器的属性 lay-filter="对应的值"
    var data = obj.data; //获得当前行数据
    var layEvent = obj.event; //获得 lay-event 对应的值（也可以是表头的 event 参数对应的值）
    
    if (layEvent === 'del') { //删除
      layer.confirm('确认删除该商品', { icon: 3, title: '确认' }, function (index) {
        obj.del(); //删除对应行（tr）的DOM结构，并更新缓存
        layer.close(index);
        //向服务端发送删除指令
        $.ajax({
          url: "delete_pd",
          data: {
            'pd_id': data.id
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
      form.val("editPd", { //formTest 即 class="layui-form" 所在元素属性 lay-filter="" 对应的值
        "id": data.id,
        "cid": data.cid,
        "brand_id": data.brand_id,
        "name": data.name // "name": "value"
        , "intro": data.intro
        , "price": data.price
        , "photo": data.photo
        , "photo_list": data.photo_list
        , "content": data.content
        , "stock": data.stock
        , "status": data.status === '上架' ? 1 : 0
        , "is_hot": data.is_hot === '是' ? 1 : 0
      });
      $("#pd_edit_cover")[0].src = UPLOAD_URL + data.photo;
      var detail_photos = data.photo_list.split(',');
      $('.pd_edit_img_list').empty(); //..清空dom
      detail_photos.forEach(function(item) {
        $('.pd_edit_img_list').append(`<img src="${UPLOAD_URL + item}" />`)
      });
      layer.open({
        type: 1,
        area: '500px',
        title: '编辑商品',
        content: $('#editPd')
      })
      form.on('submit(edit_pd_save)', function (data) {
        var submitData = data.field //当前容器的全部表单字段，名值对形式：{name: value}
        submitData.photo_list = submitData.photo_list.replace(/,$/gi,"");
        $.ajax({
          url: "edit_pd",
          data: submitData,
          type: "Post",
          dataType: "json",
          success: function (data) {
            if (data !== false) {
              layer.closeAll('page'); //关闭所有页面层
              layer.msg('编辑成功');
              setTimeout(() => {
                location.reload();
              }, 500);
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

  //  上传单张商品封面图
  upload.render({
      elem: '#pd_eidt_cover_btn' //绑定元素
      ,url: 'upload_pd_img' //上传接口
      ,accept: 'images'
      ,size: 5120
      ,acceptMime: 'image/jpeg, image/png'
      ,field: 'pd_cover'
      ,done: function(res){
          let code = res.code;
          if (code === 0) {
              const fullPath = res.data.savepath + res.data.savename
              $("#pd_edit_cover")[0].src = UPLOAD_URL + fullPath
              $("#pd_edit_cover_url").val(fullPath)
              layer.msg('封面上传成功，保存后生效');
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
      elem: '#pd_edit_imgs_btn' //绑定元素
      ,url: 'upload_pd_img' //上传接口
      ,accept: 'images'
      ,size: 5120
      ,acceptMime: 'image/jpeg, image/png'
      ,field: 'pd_cover'
      ,multiple: true
      ,done: function(res){
          let code = res.code;
          if (code === 0) {
            const fullPath = res.data.savepath + res.data.savename
            $(".pd_edit_img_list").append(`<img src="${UPLOAD_URL + fullPath}" />`)
            $("#pd_edit_imgs_url").val($("#pd_edit_imgs_url").val() + fullPath +',')
          } else {
              layer.msg(`封面上传失败，${res.msg}`);
          }
      }
      ,allDone: function(obj){
          if (obj.successful === obj.total) {
            layer.msg('封面上传成功，发布后生效');
          }
      }
      ,error: function(){
          layer.msg('商品详情图上传失败');
      }
  });

  $('#pd_clear_btn').click(function(){
    $(".pd_edit_img_list").empty()
    $("#pd_edit_imgs_url").val('')
  })

});