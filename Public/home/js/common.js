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

    /* 收货地址表单提交拦截 */
    $('#addressForm').submit(function(e) {
        var phone = $('#address_phone').val();
        var postcode = $('#address_postcode').val();
        var phoneReg = /^1[3456789]\d{9}$/;
        var postcodeReg = /^[0-9]{6}$/;

        if (!phoneReg.test(phone)){
            alert('请输入正确的手机号')
            return false;
        }

        if (!postcodeReg.test(postcode)){
            alert('请输入正确的邮编')
            return false;
        }
        return true;
    });
});