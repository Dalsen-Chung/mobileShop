$(function(){
    /* 商品详情轮播 */
    $('.carousel').carousel({
        interval: 4000
    });

    /* 地区选择器 */
    var province = $('#provinceText').html() || '选择省';
    var cityText = $('#cityText').html() || '选择市';
    var districtText = $('#districtText').html() || '选择区';
    $('#addressSelector').distpicker({
        province: province,
        city: cityText,
        district: districtText
    });
});