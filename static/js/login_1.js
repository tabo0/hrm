$(function () {
    $("#username").on("blur",function () {
        validateMid();
    });
    $("#password").on("blur",function () {
        validatePassword();
    });

    $("#submit").click(function () {
        //所有输入框验证，若都不为空则可以登陆
    	if(validateMid()== "" && validatePassword()== ""){
            //如果手机号和密码为空
            $(".error").text("请输入用户名和密码");
            changeState("login-title","login-msg");
            return false;
        }
        if(validateMid() == ""){
            //如果手机号为空
            $(".error").text("请输入用户名");
            changeState("login-title","login-msg");
            return false;
        }
        if(validatePassword() == ""){
            //如果密码为空
            $(".error").text("请输入密码");
            changeState("login-title","login-msg");
            return false;
        }  
        return validatePassword() && validateMid();
    });
    //enter 事件触发
    $(document).keydown(function(event) {
        if (event.keyCode == 13) {
            if(validateMid()== "" && validatePassword()== ""){
                //如果手机号和密码为空
                $(".error").text("请输入用户名和密码");
                changeState("login-title","login-msg");
                return false;
            }
            if(validateMid() == ""){
                //如果用户名为空
                $(".error").text("请输入用户名");
                changeState("login-title","login-msg");
                return false;
            }
            if(validatePassword() == ""){
                //如果密码为空
                $(".error").text("请输入密码");
                changeState("login-title","login-msg");
                return false;
            }

            return validatePassword() && validateMid();
        }
    });
});

function validateMid() {
    return validateEmpty("phone");
}
function validatePassword() {
    return validateEmpty("password");
}
/**
 * 本函数的主要功能是验证所传入的数据是否为空
 *
 * @param eleId
 */
function validateEmpty(eleId) {
    if($("#" + eleId).val() == ""){ //内容为空
        return false;
    } else {//内容不为空
        return true;
    }
}

function changeState(a,b) {
    var sname=$("."+a);
    var error=$("."+b);
    sname.addClass("right");
    error.removeClass("right");
}