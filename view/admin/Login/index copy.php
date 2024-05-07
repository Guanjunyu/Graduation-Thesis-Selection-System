<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Graduation Thesis Selection System</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta http-equiv="Access-Control-Allow-Origin" content="*">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">
    <!--引入ICON -->
    <link rel="icon" sizes="any" mask="" href="__Common__/Icon/Space development.svg">

    <!-- 引入layui.CSS.CDN资源
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/layui/2.6.8/css/layui.css"
        integrity="sha512-gK5o6RvUyTWSY+nO4Q9kJKGXbffUbV+u/R3bOAnCiOSIGt8GNDkvLvsQC2WaxyIQwGS56zpwt1TajavwKXBwKA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" /> -->

    <!-- 引入本地的Layui资源 -->
    <!-- 网络失效情况下引用本地的layui -->
    <link rel="stylesheet" href="__Layui__/CSS/layui.css">
    <script src="__Layui__/layui.js"></script>

    <!-- 引入页面控制的静态资源 -->
    <link rel="stylesheet" href="__Admin__/CSS/Login.css">

    <!-- [if lt IE 9]>用于适配IE9以下的浏览器 -->
    <!-- <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script> -->
    <!-- <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script> -->
    <!-- <![endif] -->
    <style>
        .icon-css-view {
            position: absolute;
            width: 40px;
            height: 40px;
            top: 10px;
            right: 0px;
            text-align: center;
        }

        
        input::-ms-clear {
            display: none;
        }

        input::-ms-reveal {
            display: none;
        }
    </style>
</head>

<body id="body">
    <!-- 主体结构 -->
    <div class="layui-container">
        <div class="admin-login-background">
            <!-- 登录表单容器 -->
            <div class="login-form">
                <!-- 登录表单 -->
                <form class="layui-form" action="">
                    <!-- 标题 -->
                    <div class="layui-form-item logo-title">
                        <h1>教务办登录</h1>
                    </div>

                    <!-- 账号 -->
                    <div class="layui-form-item">
                        <label class="layui-icon layui-icon-username" for="username"></label>
                        <input type="text" name="username" lay-verify="required|number|account" placeholder="用户名"
                            autocomplete="off" class="layui-input" required maxlength="12" value="111111111111">
                    </div>

                    <!-- 密码 -->
                    <div class="layui-form-item">
                        <label class="layui-icon layui-icon-password" for="password"></label>
                        <input type="password" name="password" id="password" lay-verify="required|password"
                            placeholder="密码" autocomplete="off" class="layui-input" required value="qwe123Q!">
                        <div class="icon-css-view">
                            <i id="iconShowView" class="layui-icon layui-icon-about" style="color: black;"></i>
                            <i id="iconHiddenView" class="layui-icon layui-icon-about" style="color: orangered;"
                                hidden></i>
                        </div>
                    </div>

                    <!-- 验证码 -->
                    <div class="layui-form-item">
                        <label class="layui-icon layui-icon-vercode" for="captcha"></label>
                        <input type="text" name="captcha" lay-verify="required|captcha" placeholder="图形验证码"
                            autocomplete="off" class="layui-input verification captcha" required maxlength="5" value="qwer">
                        <div class="captcha-img">
                            <!-- <img src="{:captcha_src()}" onClick="this.src='{:captcha_src()}?'+Math.random();" alt="captcha" /> -->
                            <img id="captchaPic" src="{:captcha_src()}" onclick="reloadImage()">
                            <!-- 这里设置验证码,点击刷新 -->
                        </div>
                    </div>

                    <!-- 记住密码以及忘记密码 -->
                    <div class="layui-form-item" style="position: relative;">
                        <input type="checkbox" name="rememberMe" value="true" lay-skin="primary" title="记住密码">
                        <div class="div-forget-password">
                            <a href="javascript:" class="forget-password">忘记密码？</a>
                        </div>
                    </div>

                    <!-- 提交 -->
                    <div class="layui-form-item">
                        <button class="layui-btn layui-btn layui-btn-normal layui-btn-fluid" lay-submit=""
                            lay-filter="login">登 入</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <!-- 引入layui模块以及本地的jQuery资源 -->
    <script src="__Admin__/JS/jquery-3.4.1.min.js" charset="utf-8"></script>
    <!-- 本地调试时使用本地的layui资源 -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/layui/2.6.8/layui.js" charset="utf-8"></script> -->
    <script src="__Admin__/JS/jquery.particleground.min.js" charset="utf-8"></script>

    <!-- layui模块的相关操作 -->
    <script>
        //验证码刷新
        function reloadImage() {
            $("#captchaPic").attr('src', '{:captcha_src()}?rand=' + Math.random());
        }

        //引入layui的相关操作
        layui.use(['form'], function () {
            var form = layui.form,
                layer = layui.layer;

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

            // 登录过期的时候，跳出ifram框架
            if (top.location != self.location) top.location = self.location;

            // 粒子线条背景
            $(document).ready(function () {
                $('.layui-container').particleground({
                    dotColor: '#7ec7fd',
                    lineColor: '#7ec7fd'
                });
            });

            // 进行登录操作
            form.on('submit(login)', function (data) {
                datan = data.field;
                if (datan.username == '') {
                    layer.msg('用户名不能为空');
                    return false;
                }
                if (datan.password == '') {
                    layer.msg('密码不能为空');
                    return false;
                }
                if (datan.captcha == '') {
                    layer.msg('验证码不能为空');
                    return false;
                }
                layer.alert(JSON.stringify(data.field), {
                    title: '最终的提交信息'
                });
                return false;
            });

            //自定义验证规则1账号验证
            form.verify({
                account: function (value) {
                    if (!/^[0-9]{12}$/.test(value)) {
                        return '用户名可能不正确,请检查后输入';
                    }
                }
            });

            //自定义验证规则2密码验证
            form.verify({
                //password验证
                password: function (value) {
                    if (!/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&_])[A-Za-z\d$@$!%*?&]{8,20}/
                        .test(value)) {
                        return "至少八个字符，至少一个大写字母，一个小写字母，一个数字和一个特殊字符";
                    }
                }
            })

        });
    </script>
</body>

</html>