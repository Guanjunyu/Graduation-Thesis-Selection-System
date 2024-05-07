<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>SignUp</title>

  <!-- 引入LayuiCDN的CSS,JS -->
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/layui/2.6.8/css/layui.css" integrity="sha512-gK5o6RvUyTWSY+nO4Q9kJKGXbffUbV+u/R3bOAnCiOSIGt8GNDkvLvsQC2WaxyIQwGS56zpwt1TajavwKXBwKA==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/layui/2.6.8/layui.js" integrity="sha512-lH7rGfsFWwehkeyJYllBq73IsiR7RH2+wuOVjr06q8NKwHp5xVnkdSvUm8RNt31QCROqtPrjAAd1VuNH0ISxqQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->

  <!-- 加载本地静态资源 -->
  <link rel="stylesheet" href="__Layui__/CSS/layui.css">
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
  <!-- 头部 -->
  <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
    <legend>
      <h2>用户注册</h2>
    </legend>
  </fieldset>

  <!-- 注册表单 -->
  <form class="layui-form layui-form-pane" action="" lay-filter="formRender">

    <!-- 学号/编号 -->
    <div class="layui-form-item">
      <label class="layui-form-label">学号/编号</label>
      <div class="layui-input-block">
        <input type="text" name="userid" lay-verify="required|number|username" autocomplete="off" placeholder="请输入学号/编号"
          class="layui-input" required maxlength="12" value="">
      </div>
    </div>

    <!-- 姓名 -->
    <div class="layui-form-item">
      <label class="layui-form-label">姓名</label>
      <div class="layui-input-block">
        <input type="text" name="name" lay-verify="required|name" autocomplete="off" placeholder="请输入姓名"
          class="layui-input" required value="student">
      </div>
    </div>

    <!-- 性别 -->
    <div class="layui-form-item" pane>
      <label class="layui-form-label">性别</label>
      <div class="layui-input-block">
        <input type="radio" name="sex" value="1" title="男" checked>
        <input type="radio" name="sex" value="0" title="女">
      </div>
    </div>

    <!-- 邮箱信息 -->
    <div class="layui-form-item">
      <label class="layui-form-label">邮箱</label>
      <div class="layui-input-block">
        <input type="text" name="email" lay-verify="email|required" autocomplete="off" class="layui-input" required
          value="@qq.com">
      </div>
    </div>

    <!-- 角色信息 -->
    <div class="layui-form-item">
      <label class="layui-form-label">角色选择</label>
      <div class="layui-input-block">
        <input type="radio" name="role" value="student" title="学生" lay-filter="role" checked>
        <input type="radio" name="role" value="teacher" title="普通老师" lay-filter="role">
        <!-- <input type="radio" name="role" value="director" title="专业主任" lay-filter="role"> -->
      </div>
    </div>

    <!-- 密码信息 -->
    <div class="layui-form-item">
      <label class="layui-form-label">密码</label>
      <div class="layui-input-block">
        <input type="password" name="password1" id="password1" lay-verify="password|required" placeholder="请设置密码"
          autocomplete="off" class="layui-input" required value="123qwe!Q" title="请填写密码">
        <div class="icon-css-view">
          <i id="iconShowView1" class="layui-icon layui-icon-about" style="color: black;"></i>
          <i id="iconHiddenView1" class="layui-icon layui-icon-about" style="color: orangered;" hidden></i>
        </div>
      </div>
    </div>
    <!-- 密码二次确认 -->
    <div class="layui-form-item">
      <label class="layui-form-label">确认密码</label>
      <div class="layui-input-block">
        <input type="password" name="password2" id="password2" lay-verify="password|required|confirmPass"
          placeholder="请确认密码" autocomplete="off" class="layui-input" required value="123qwe!Q" title="请再次确认密码">
        <div class="icon-css-view">
          <i id="iconShowView2" class="layui-icon layui-icon-about" style="color: black;"></i>
          <i id="iconHiddenView2" class="layui-icon layui-icon-about" style="color: orangered;" hidden></i>
        </div>
      </div>
    </div>

    <!-- 下拉选择框-->
    <div class="layui-form-item">
      <label class="layui-form-label">详细信息</label>
      <!-- 实现学院,系,专业的三级联动操作 -->
      <!-- 学院 -->
      <div class="layui-input-inline">
        <select name="college" lay-search id="college" lay-filter="college">
          <option selected="" disabled="" value="">学院</option>
          <!-- <option>dasd</option> -->
        </select>
      </div>
      <!-- 系 -->
      <div class="layui-input-inline">
        <select name="faculty" lay-search id="faculty" lay-filter="faculty">
          <option selected="" disabled="" value="">院系</option>
        </select>
      </div>
      <!-- 专业 -->
      <div class="layui-input-inline">
        <select name="major" lay-search id="major" lay-filter="major">
          <option disabled selected="" value="">专业</option>
        </select>
      </div>
      <!-- 班级 -->
      <div class="layui-input-inline">
        <select name="class" lay-search id="class" lay-filter="class">
          <option selected disabled="" value="">班级(可选)</option>
        </select>
      </div>
    </div>
    <!-- 上面数据应该由后台数据库查询产生 -->

    <!-- 验证码 -->
    <div class="layui-form-item">
      <label class="layui-form-label">验证码输入</label>
      <div class="layui-input-inline" style="width:45%">
        <input type="text" name="captcha" id="captcha" placeholder="图形验证码" class="layui-input" lay-verify="required" required
          maxlength="5" title="请填写验证码">
      </div>
      <div class="layui-input-inline" style="margin-left:30px;">
        <img id="img" src="{:captcha_src()}" alt="captcha" class="layadmin-user-login-codeimg" onclick="reloadImg()" />
        <!-- onclick="this.src=this.src+'?'+Math.random()" -->
      </div>
    </div>

    <!-- 按钮提交和重置 -->
    <div class="layui-form-item">
      <div class="layui-input-block">
        <button type="submit" class="layui-btn" lay-submit="" lay-filter="submited">立即提交</button>
        <button type="reset" class="layui-btn layui-btn-primary">重置</button>
      </div>
    </div>
    <hr>
  </form>
  <!-- 表单结束 -->

</body>

</html>

<!-- 加载本地的layui资源 -->
<script src="__Layui__/layui.js"></script>
<!-- 加载jQuery资源 -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script> -->
<!-- 加载本地的jQuery资源 -->
<script src="__JQuery__/jquery-3.6.0.min.js"></script>

<script>
  // 验证码点击刷新
  function reloadImg() {
    $('#img').attr('src', '{:captcha_src()}?rand=' + Math.random());
    //console.log("yes");
    $("#captcha").val("");
  }

  //加载layui模块
  layui.use(['form', 'layer'], function () {
    var form = layui.form,
      layer = layui.layer;
    //使用内置的js时需要加入,$表示一个查询函数,$(查询表达式)这样可以获取对应的DOM元素
    var $ = layui.$;

    //layui验证自动刷新
    window.ReLoadImg=function(){
        $("#captchaPic").attr('src', '{:captcha_src()}?rand=' + Math.random());
        $("#captcha").val("");
    }

    // 学院数据预加载
    $.ajax({
      type: 'post',
      url: "{:url('index/signup/selectcollege')}",
      data: {
        'flag': 1
      },
      dataType: 'json',
      success: function (res) {
        var newres=res;
        if (newres.code == 200) {
          $('#college').empty();
          $('#college').append("<option disabled=\"\" selected=\"\">学院</option>");
          $.each(newres.data, function (index, item) {
            $('#college').append("<option value=" + item.collegecode + ">" + item.collegename +
              "</option>"); //下拉框添加元素
          });
          form.render('select', 'formRender'); //对数据进行重新渲染,layui使用的是静态渲染方式,动态数据更新后需要使用手动渲染
        } else {
          layer.msg(newres.code + " " + newres.msg);
          reloadImg();
        }
      }
    });

    //角色选择时触发select class重新渲染事件,默认选择时不触发该事件
    form.on('radio(role)', function (data) {
      if (data.value != 'student') {
        $('#class').empty();
        $('#class').append("<option disabled=\"\" selected=\"\" value=\"\">教师不需要选择</option>");
        form.render('select', 'formRender');
      } else {
        $('#class').empty();
        //console.log($('#major').val());
        $.ajax({
          type: 'post',
          url: "{:url('index/signup/selectclass')}",
          data: {
            'major_code': $('#major').val()
          },
          dataType: 'json',
          success: function (res) {
            if (res.code == 200) {
              $('#class').append("<option disabled=\"\" selected=\"\" >班级</option>");
              $.each(res.data, function (index, item) {
                $('#class').append(new Option(item.class, item.class)); //下拉框添加元素
              });
              form.render('select', 'formRender');
            } else {
              layer.msg(res.code + " " + res.msg);
              ReLoadImg();
            }
          }
        });
      }
    });

    // 学院下拉选项框选择触发系预加载
    form.on('select(college)', function (data) {
      //console.log(data.value);
      $('#faculty').empty();
      $('#major').empty();
      $('#class').empty();
      $.ajax({
        type: 'post',
        url: "{:url('index/signup/selectfaculty')}",
        data: {
          'college_code': data.value
        },
        dataType: 'json',
        success: function (res) {
          //console.log(res);
          //console.log(typeof res);
          if (res.code == 200) {
            $('#faculty').append("<option disabled=\"\" selected=\"\" >院系</option>");
            $('#major').append("<option disabled=\"\" selected=\"\" >专业</option>");
            $('#class').append("<option disabled=\"\" selected=\"\" >班级</option>");
            $.each(res.data, function (index, item) {
              $('#faculty').append(new Option(item.facultyname, item.facultycode)); //下拉框添加元素
            });
            form.render('select', 'formRender');
          } else {
            layer.msg(res.code + " " + res.msg);
            ReLoadImg();
          }
        }
      });
    });

    // 系下拉触发事件
    form.on('select(faculty)', function (data) {
      $('#major').empty();
      $('#class').empty();
      //console.log(data.value)
      $.ajax({
        type: 'post',
        url: "{:url('index/signup/selectmajor')}",
        data: {
          'faculty_code': data.value
        },
        dataType: 'json',
        success: function (res) {
          console.log(typeof res);
          $('#major').append("<option disabled=\"\" selected=\"\" >专业</option>");
          $('#class').append("<option disabled=\"\" selected=\"\" >班级</option>");
          if (res.code == 200) {
            $.each(res.data, function (index, item) {
              $('#major').append(new Option(item.majorname, item.majorcode)); //下拉框添加元素
            });
            form.render('select', 'formRender');
          } else {
            layer.msg(res.code + " " + res.msg);
            ReLoadImg();
          }
        }
      })
    });

    //专业下拉触发事件
    form.on('select(major)', function (data) {
      $('#class').empty();
      var radioVal = $('input:radio[name="role"]:checked').val(); //获取radio的值
      //console.log(radioVal);
      if (radioVal == "teacher" || radioVal == 'director') {
        $('#class').append("<option disabled=\"\" selected=\"\" value=\"\">教师不需要选择</option>");
        form.render('select', 'formRender');
      } else if (radioVal == 'student') {
        $.ajax({
          type: 'post',
          url: "{:url('index/signup/selectclass')}",
          data: {
            'major_code': data.value
          },
          dataType: 'json',
          success: function (res) {
            //console.log(res);
            $('#class').append("<option disabled=\"\" selected=\"\" >班级</option>");
            if (res.code == 200) {
              $.each(res.data, function (index, item) {
                $('#class').append(new Option(item.class, item.class)); //下拉框添加元素
              });
              form.render('select', 'formRender');
            } else {
              layer.msg(res.code + " " + res.msg);
              ReLoadImg();
            }
          }
        });
      } else {
        layer.alert('角色未选择属于非法操作');
        ReLoadImg();
        return false;
      }
    });

    // 表单数据提交
    form.on('submit(submited)', function (data) {
      //简单的补充验证
      if (data.field['college'] == '' || data.field['faculty'] == '' || data.field['major'] == '') {
        ReLoadImg();
        layer.alert("请选择学院,院系或专业");
        return false;
      }
      if (data.field['role'] == 'student') {
        if (data.field['class'] == '') {
          ReLoadImg();
          layer.alert("请选择班级");

          return false;
        }
      }

      $.ajax({
        type: "post", //提交方式
        url: "{:url('index/signup/signup')}", //目标
        data: data.field, //数据
        dataType: 'json', //格式
        success: function (res) {
          //console.log(res.code);
          if (res.code == 200) {
            layer.msg(res.msg, {
              time: 1000
            }, function () {
              layer.msg('将自动跳转到登录页面');
              //layer.closeAll();
              // top.window.location.href="{:url('/')}";
              setTimeout(function () {
                parent.window.location.reload();
              }, 1500);
            });
          } else {
            layer.msg(res.msg);
            ReLoadImg();
          }
        }
      })
      return false;
    });

    // 是否显示密码函数
    function showhidden(passwordn, show, hidden) {
      var password = $(passwordn);
      $(show).on('click', function (e) {
        password[0].type = "text";
        $(show)[0].hidden = true;
        $(hidden)[0].hidden = false;
        form.render();
      });
      $(hidden).on('click', function (e) {
        password[0].type = "password";
        $(show)[0].hidden = false;
        $(hidden)[0].hidden = true;
        form.render();
      });
    }

    //函数调用
    showhidden(password1, iconShowView1, iconHiddenView1);
    showhidden(password2, iconShowView2, iconHiddenView2);

    //自定义字段验证规则
    form.verify({
      //学号验证(0-9数字,长度为12)
      username: function (value) {
        if (!/^[0-9]{12}$/.test(value)) {
          return '用户名可能不正确,请检查后输入';
        }
      },
      //姓名验证
      name: function (value) {
        if (!new RegExp("^(?!_)(?!.*?_$)[a-zA-Z0-9_\u4e00-\u9fa5]+$").test(value)) {
          return '用户名不能有特殊字符并且不能以下划线开头和结尾';

        }
        if (!/^\w*[a-zA-Z0-9_\u4e00-\u9fa5]+\w*$/.test(value)) {
          return '用户名不能全为数字';

        }
      },
      //密码验证
      password: function (value) {
        if (!/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&_])[A-Za-z\d$@$!%*?&]{8,20}/.test(value)) {
          return "至少八个字符，至少一个大写字母，一个小写字母，一个数字和一个特殊字符";

        }
      },
      //密码确验证
      confirmPass: function (value) {
        if ($('input[name=password1]').val() !== value)
          return '两次密码输入不一致！';

      }

    });


  });
</script>