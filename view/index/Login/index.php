<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="The topic selection system for graduation thesis is mainly for the convenience of college graduates and instructors to apply for the graduation project online">
    <title>Graduation Thesis Selection System</title>
    <!--引入ICON -->
    <link rel="icon" sizes="any" mask="" href="__Common__/Icon/Space development.svg">

    <!-- 引入LayuiCDN的CSS,JS -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/layui/2.6.8/css/layui.css" integrity="sha512-gK5o6RvUyTWSY+nO4Q9kJKGXbffUbV+u/R3bOAnCiOSIGt8GNDkvLvsQC2WaxyIQwGS56zpwt1TajavwKXBwKA==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/layui/2.6.8/layui.js" integrity="sha512-lH7rGfsFWwehkeyJYllBq73IsiR7RH2+wuOVjr06q8NKwHp5xVnkdSvUm8RNt31QCROqtPrjAAd1VuNH0ISxqQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->

    <!-- 网络失效情况下引用本地的layui -->
    <link rel="stylesheet" href="__Layui__/CSS/layui.css">
    <script src="__Layui__/layui.js"></script>

    <!-- __STATIC__用于定位静态资源位置 -->
    <!-- 引入静态CSS,JS -->
    <link rel="stylesheet" href="__Index__/CSS/Login.css">
    <script src="__Index__/JS/Login.js"></script>
    <style>
        .layadmin-user-login-codeimg {
            max-height: 38px;
            width: 100%;
            cursor: pointer;
            box-sizing: border-box;
        }

        .icon-css-view {
            position: absolute;
            width: 40px;
            height: 40px;
            margin-top: 1.15rem;
            right: 10px;
            text-align: center;
            float: right;
        }

        input::-ms-clear {
            display: none;
        }

        input::-ms-reveal {
            display: none;
        }

        #img{
            border: 1px solid #e6e6e6;
        }
    </style>
</head>

<body>
    <!--主体结构Main-->
    <div class="container switch">
        <!-- 登录页面（默认显示） -->
        <div class="container-form container-signin">
            <form action="" class="form layui-form" method="">
                <h2 class="form-title">Sign In</h2>
                <!-- 用户账号username -->
                <div class="layui-form-item" style="width:100%">
                    <input type="text" title="用户名为12位的数字" name="username" placeholder="User" class="input layui-input"
                        required="required" lay-verify="required|number|username" maxlength="12" value="111111111111">
                </div>
                <!-- 用户密码password -->
                <div class="layui-form-item" style="width:100%">
                    <input type="password" name="password" id="password" title="密码规则:至少八个字符，至少一个大写字母，一个小写字母，一个数字和一个特殊字符"
                        name="password" placeholder="Password" class="input layui-input" required="required"
                        lay-verify="required|password" value="123qwe!Q" style="display:inline-block">
                    <div class="icon-css-view" style="display:inline-block">
                        <i id="iconShowView" class="layui-icon layui-icon-about" style="color: black"></i>
                        <i id="iconHiddenView" class="layui-icon layui-icon-about" style="color: orangered;" hidden></i>
                    </div>
                </div>
                <!-- 角色选择role -->
                <div class="layui-form-item">
                    <label class="layui-form-label" style="padding: 9px 0px;margin-bottom: 0px;">角色选择:</label>
                    <div class="layui-input-block">
                        <input type="radio" name="role" value="student" title="学生" checked>
                        <input type="radio" name="role" value="teacher" title="教师">
                    </div>
                </div>
                <!-- 验证码captcha -->
                <div class="layui-form-item" style="width:100%;margin-top: 10px;margin-bottom: 25px">
                    <div class="layui-row">
                        <div class="layui-col-xs7">
                            <input type="text" id="captcha" name="captcha" placeholder="图形验证码" class="layui-input"
                                lay-verify="required" required maxlength="5" required title="请填写验证码">
                        </div>
                        <div class="layui-col-xs5">
                            <div style="margin-left:20px;">
                                <img id="img" src="{:captcha_src()}" alt="captcha" class="layadmin-user-login-codeimg"
                                    onclick="reloadImg()" />
                                <!-- onclick="this.src=this.src+'?'+Math.random()" -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- 设置提交事件以及监听器Demo -->
                <div class="layui-form-item">
                    <button class="submit" lay-submit lay-filter="signin">sign in</button>
                </div>
                <!-- 忘记密码 -->
                <div class="layui-form-item">
                    <a href="common\Reset\index" class="layui-font-blue">忘记密码</a>
                </div>
            </form>
        </div>
        <!-- 注册页面（点击弹出注册页面） -->
        <div class="container-form container-signup">
            <img src="__Index__\Image\IndexImage1.png" alt="背景图片" srcset="" align="center">
        </div>
        <!-- 覆盖层 -->
        <div class="container-overlay">
            <div class="overlay">
                <div class="overlay-slide overlay-left">
                    <!-- 添加监听事件用户点击的时候触发注册页面 -->
                    <button class="submit" id="goSignUp" lay-submit lay-filter="signup">sign up</button>
                </div>
                <div class="overlay-slide overlay-right">
                    <button class="submit" id="goSignIn">sign in</button>
                </div>
            </div>
        </div>
    </div>
    <!--固定底部footer-->
    <div class="foot">
        <span>
            <p>©2022&nbsp--&nbsp<?php echo date("Y") ?>&nbsp;&nbsp;DESIDE&nbsp&nbspBY&nbsp&nbspGUANJUNYU&nbsp;</p>
        </span>
    </div>


</body>

</html>

<!-- 加载jQuery资源 -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script> -->
<!-- 加载本地的jQuery资源 -->
<script src="__JQuery__/jquery-3.6.0.min.js"></script>
<script src="__JQuery__/jquery.cookie.js"></script>

<!-- layui的相关操作 -->
<script>
    //验证码刷新
    function reloadImg() {
        $('#img').attr('src', '{:captcha_src()}?rand=' + Math.random());
        //console.log("yes");
        $("#captcha").val("");
    };


    // 引入form模块
    layui.use('form', function name() {
        var form = layui.form,
            layer=layui.layer;
        var $ = layui.$;

        //layui内置验证码自动刷新
        window.ReLoadImg=function(){
                $("#img").attr('src', '{:captcha_src()}?rand=' + Math.random());
                $("#captcha").val("");
            };

        //密码显示
        var password = $("#password");
        $("#iconShowView").on('click', function (e) {
            console.log("smile");
            password[0].type = "text";
            $("#iconShowView")[0].hidden = true;
            $("#iconHiddenView")[0].hidden = false;
            form.render();
        });
        $("#iconHiddenView").on('click', function (e) {
            console.log("cry");
            password[0].type = "password";
            $("#iconShowView")[0].hidden = false;
            $("#iconHiddenView")[0].hidden = true;
            form.render();
        });

        //登录监听提交
        form.on('submit(signin)', function (data) {
            //layer.msg(JSON.stringify(data.field));回显提交数据测试用
            $.ajax({
                type: "post",
                url: "{:url('index/Login/login')}",
                data: data.field,
                dataType: 'json',
                success: function (res) {
                    console.log(typeof res);
                    //res = $.parseJSON(res);
                    if (res.code == 200) {
                        //实现跳转
                        $.cookie('username',res.data.username);
                        $.cookie('role',res.data.role);
                        console.log(document.cookie);
                        layer.msg("即将跳转", {
                            time: 1000
                            }, function () {
                            top.window.location.href = "{:url('/common/Index/index')}";
                        });

                    } else {
                        ReLoadImg();
                        layer.msg(res.msg);
                    }
                }
            });
            return false;
        });

        //注册监听提交,用于用户注册
        form.on('submit(signup)', function () {
            //打开一个弹出层
            var index = layer.open({
                // layer.alert("1");测试用
                type: 2, //加载一个新页面
                title: "",
                content: 'index/SignUp', //存放表单页面或者直接在本页面设置一个隐藏的表单
                offset: 'auto',
                area: ['75%', '60%'],
                anim: 1,
                closeBtn: 2,
                maxmin: true,
                resize: false,
                move: false,
                cancel: function (index, layero) {
                    if (confirm('信息可能未保存,确要关闭嘛')) { //只有当点击confirm框的确定时，该层才会关闭
                        layer.close(index);
                    } else {
                        ReLoadImg();
                    }
                    return false;
                }
            });
            //弹出层如果刷新会先确认是否可行
            window.onbeforeunload = function (event) {
                event.returnValue = "我在这写点东西...";
                var index1 = layer.load(2, {
                    time: 10 * 1000
                });
                layer.close(index1);
            };

        });

        // 自定义验证规则1account验证
        form.verify({
            //username验证:学生12位数字,教师12位
            username: function (value) {
                if (!/^[0-9]{12}$/.test(value)) {
                    return '用户名可能不正确,请检查后输入';
                }
            },
            //password验证
            password: function (value) {
                if (!/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&_])[A-Za-z\d$@$!%*?&]{8,20}/
                    .test(value)) {
                    return "至少八个字符，至少一个大写字母，一个小写字母，一个数字和一个特殊字符";
                }
            }
        });
    });
</script>