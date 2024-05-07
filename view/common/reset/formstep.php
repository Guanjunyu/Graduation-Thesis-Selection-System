<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="description"
        content="The topic selection system for graduation thesis is mainly for the convenience of college graduates and instructors to apply for the graduation project online">
    <title>Graduation Thesis Selection System</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="icon" sizes="any" mask="" href="__Common__/Icon/Space development.svg">

    <!-- 引入LayuiCDN的CSS,JS -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/layui/2.6.8/css/layui.css" integrity="sha512-gK5o6RvUyTWSY+nO4Q9kJKGXbffUbV+u/R3bOAnCiOSIGt8GNDkvLvsQC2WaxyIQwGS56zpwt1TajavwKXBwKA==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/layui/2.6.8/layui.js" integrity="sha512-lH7rGfsFWwehkeyJYllBq73IsiR7RH2+wuOVjr06q8NKwHp5xVnkdSvUm8RNt31QCROqtPrjAAd1VuNH0ISxqQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->

    <!-- 引入相关资源 -->
    <link rel="stylesheet" href="__Layui__/CSS/layui.css">
    <script src="__Layui__/layui.js"></script>

    <!-- 引入单独配置文件 -->
    <link rel="stylesheet" href="__Common__/Reset/CSS/public.css" media="all">
    <link rel="stylesheet" href="__Common__/Reset/CSS/step.css" media="all">
    <style>
        .layadmin-user-login-codeimg {
            max-height: 38px;
            width: 100%;
            cursor: pointer;
            box-sizing: border-box;
        }

        img{
            border: 1px solid #e6e6e6;
        }

    </style>
</head>

<body>
    <div class="layuimini-container">
        <div class="layuimini-main">
            <div class="layui-fluid">
                <div class="layui-card">
                    <div class="layui-card-body" style="padding-top: 40px;">
                        <div class="layui-carousel" id="stepForm" lay-filter="stepForm" style="margin: 0 auto;">
                            <div carousel-item>

                                <!-- first step -->
                                <div>
                                    <form class="layui-form" style="margin: 0 auto;max-width: 460px;padding-top: 40px;" lay-filter="step1">
                                        
                                        <!-- 学号/工号 -->
                                        <div class="layui-form-item">
                                            <label class="layui-form-label">学号/工号:</label>
                                            <div class="layui-input-block">
                                                <input type="text" name="username" placeholder="请填写学号/工号"
                                                    class="layui-input" lay-verify="required|username" required maxlength="12"
                                                    title="密码规则:至少八个字符，至少一个大写字母，一个小写字母，一个数字和一个特殊字符"
                                                    value="111111111111" id="step1username"/>

                                            </div>
                                        </div>

                                        <!-- 注册邮箱 -->
                                        <div class="layui-form-item">
                                            <label class="layui-form-label">注册邮箱:</label>
                                            <div class="layui-input-block">
                                                <input type="text" name="email" placeholder="请填写注册邮箱"
                                                    class="layui-input" lay-verify="required|email" required
                                                    title="请填写注册邮箱" value="2841597969@qq.com" id="step1email"/>
                                            </div>
                                        </div>

                                        <!-- 身份 -->
                                        <div class="layui-form-item">
                                            <label class="layui-form-label">请选择身份:</label>
                                            <div class="layui-input-block">
                                                <select lay-verify="required" name="role" id="step1role">
                                                    <option value="student" selected>学生</option>
                                                    <option value="teacher">教师</option>
                                                    <option value="admin">管理员</option>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- 验证码 -->
                                        <div class="layui-form-item">
                                            <div class="layui-row" >
                                            <label class="layui-form-label">验证码:</label>
                                                <div class="layui-col-xs4" >
                                                    <input type="text" name="captcha" id="captcha" placeholder="图形验证码"
                                                        class="layui-input" lay-verify="required" required maxlength="5"
                                                        required title="请填写验证码">
                                                </div>
                                                <div class="layui-col-xs4" style="margin-left: 40px;">
                                                    <div>
                                                        <img id="img" src="{:captcha_src()}" alt="captcha"
                                                            class="layadmin-user-login-codeimg" onclick="reloadImg()" />
                                                        <!-- onclick="this.src=this.src+'?'+Math.random()" -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- 下一步按钮 -->
                                        <div class="layui-form-item">
                                            <div class="layui-input-block">
                                                <center>
                                                    <button class="layui-btn" lay-submit lay-filter="formStep1_2"
                                                        style="margin-right: 15px;">
                                                        &emsp;下一步&emsp;
                                                    </button>
                                                    <button class="layui-btn layui-btn-primary" lay-submit
                                                        style="margin-left: 15px;width: 108px;">
                                                        &emsp;取消&emsp;
                                                    </button>
                                                </center>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <!-- secode step -->
                                <div>
                                    <form class="layui-form" style="margin: 0 auto;max-width: 460px;padding-top: 40px;">
                                        
                                        <!-- 用户账号 -->
                                        <div class="layui-form-item">
                                            <label class="layui-form-label">用户账号:</label>
                                            <div class="layui-input-block">
                                                <div class="layui-form-mid layui-word-aux"  id="username" ></div>
                                            </div>
                                        </div>

                                        <!-- 注册邮箱 -->
                                        <div class="layui-form-item">
                                            <label class="layui-form-label">注册邮箱:</label>
                                            <div class="layui-input-block">
                                                <div class="layui-form-mid layui-word-aux" id="email" ></div>
                                            </div>
                                        </div>

                                        <!-- 用户身份 -->
                                        <div class="layui-form-item">
                                            <label class="layui-form-label">用户身份:</label>
                                            <div class="layui-input-block">
                                                <div class="layui-form-mid layui-word-aux" id="role"></div>
                                            </div>
                                        </div>
                                        
                                        <!-- 说明 -->
                                        <div class="layui-form-item">
                                            <label class="layui-form-label">重要提示:</label>
                                            <div class="layui-input-block">
                                                <div class="layui-form-mid layui-word-aux">
                                                    <span style="color: red;">请确认上述信息无误后，点击确认按钮，
                                                        系统将自动发送重置链接到注册邮箱，请注意及时查收，
                                                        如有任何问题请及时联系管理员处理.</span>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- 按钮 -->
                                        <div class="layui-form-item">
                                            <div class="layui-input-block">
                                                <center>
                                                    <button type="button" class="layui-btn layui-btn-primary pre" lay-filter="formStep2_1" lay-submit
                                                        style="margin-left: 0px;width: 94px;margin-right: 15px;">上一步</button>
                                                    <button class="layui-btn" lay-submit lay-filter="formStep2_3"
                                                        style="margin-right: 0px;margin-left: 15px;">
                                                        &emsp;确认&emsp;
                                                    </button>
                                                </center>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <!-- third step -->
                                <!-- 发送成功样式 -->
                                <div>
                                    <div style="text-align: center;margin-top: 90px;">
                                        <i class="layui-icon layui-circle"
                                            style="color: white;font-size:30px;font-weight:bold;background: #52C41A;padding: 20px;line-height: 80px;">&#xe605;</i>
                                        <div style="font-size: 24px;color: #333;font-weight: 500;margin-top: 30px;">
                                            发送成功
                                        </div>
                                        <div style="font-size: 14px;color: #666;margin-top: 20px;">预计5分钟内送达邮箱</div>
                                    </div>
                                    <div style="text-align: center;margin-top: 50px;">
                                        <button class="layui-btn next" lay-submit lay-filter="formStep3_1">重新填写</button>
                                        <button class="layui-btn layui-btn-primary" lay-submit lay-filter="formStep3_0">返回登录页</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- bottom  -->
                        <hr>
                        <div id='foot' style="color: #666;margin-top: 30px;margin-bottom: 40px;padding-left: 30px;">
                            <center style="margin: bottom 10px;">
                                <span>
                                    <p>©2022&nbsp&nbsp;&nbsp;DESIDE&nbsp&nbspBY&nbsp&nbspGUANJUNYU&nbsp;</p>
                                </span>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 引入layui模块 -->
    <script src="__Common__/Reset/JS/step.js" charset="utf-8"></script>
    <!-- 加载jQuery资源 -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script> -->
    <!-- 加载本地的jQuery资源 -->
    <script src="__JQuery__/jquery-3.6.0.min.js"></script>

    <script>

        //验证码刷新
        function reloadImg() {
            $('#img').attr('src', '{:captcha_src()}?rand=' + Math.random());
            $("#captcha").val("");
        //console.log("yes");
        };

        layui.use(['form', 'step'], function () {
            var $ = layui.$,
                form = layui.form,
                step = layui.step;
            //存放提交表单的数据
            var container;

            //layui内置验证码(id:img)自动刷新,以及自动清空输入框(id:captcha)
            window.ReLoadImg=function(){
                $("#img").attr('src', '{:captcha_src()}?rand=' + Math.random());
                $("#captcha").val("");
            };

            //顶部标题栏
            step.render({
                elem: '#stepForm',
                filter: 'stepForm',
                width: '100%', //设置容器宽度
                stepWidth: '750px',
                height: '500px',
                stepItems: [{
                    title: '填写相关信息'
                }, {
                    title: '确认填写信息'
                }, {
                    title: '完成'
                }]
            });

            //step1->step2
            form.on('submit(formStep1_2)', function (data) {
                //console.log(data.field);
                if (data.field['role'] != "") {
                    container=data.field;
                    //console.log(data.field['username']);
                    $("#username").text(data.field['username']);
                    $("#email").text(data.field['email']);
                    if(data.field['role']=="student"){
                        $("#role").text("学生");
                    }
                    if(data.field['role']=="teacher"){
                        $("#role").text("教师");
                    }
                    if(data.field['role']=="admin"){
                        $("#role").text("管理员");
                    }
                    step.next('#stepForm');
                } else {
                    layer.msg("请先选择身份");
                    ReLoadImg();
                }
                return false;
            });

            //step2->step1
            form.on('submit(formStep2_1)',function(data){
                ReLoadImg();
            });

            //数据提交验证处理
            form.on('submit(formStep2_3)', function (data) {
                data=container;
                $.ajax({
                type: "post",
                url: "{:url('common/Reset/datacheck')}",
                data: data,
                dataType: 'json',
                success:function(res){
                    console.log(res);
                    //数据验证成功才能跳转到下一页
                    if(res.code==200){
                        layer.msg("正在处理,请勿刷新", {time: 5*1000}, function () {
                            step.next('#stepForm');
                    });
                    }else{
                        layer.msg(res.code+" "+res.msg);
                    }
                }
            });
                return false;
            });

            //step3->step1
            form.on('submit(formStep3_1)',function () {
                container=[];
                ReLoadImg();
                $("#step1username").val("");
                $("#step1email").val("");
                $("#step1role").each(function(){
                    $(this).find("option").eq(0).prop("selected",true)
                });
                form.render('select',"step1");
            });

            //step3->step0
            form.on('submit(formStep3_0)',function (){
                layer.msg("即将跳转", {
                    time: 1000
                }, function () {
                    top.window.location.href = "{:url('/')}";
                });
            });

            //前进后退按钮
            $('.pre').click(function () {
                step.pre('#stepForm');
            });
            $('.next').click(function () {
                step.next('#stepForm');
            });

            //自定义验证规则
            form.verify({
                //username验证:学生12位数字,教师12位
                username: function (value) {
                    if (!/^[0-9]{12}$/.test(value)) {
                        return '用户名可能不正确,请检查后输入';
                    }
                }
            });

        });
    </script>
</body>

</html>