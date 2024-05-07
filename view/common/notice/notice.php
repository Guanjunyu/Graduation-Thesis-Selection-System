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

</head>

<body>
  <fieldset class="layui-elem-field layui-field-title" style="margin-top: 50px;">
    <legend>公告发布</legend>
  </fieldset>
  <form class="layui-form layui-form-pane" action="">

    <!-- 公告标题 -->
    <div class="layui-form-item">
      <label class="layui-form-label">公告标题</label>
      <div class="layui-input-block">
        <input type="text" name="title" autocomplete="off" placeholder="公告名称" class="layui-input" lay-verify="required">
      </div>
    </div>

    <!-- content -->
    <div class="layui-form-item layui-form-text">
      <label class="layui-form-label">内容</label>
      <div class="layui-input-block">
        <textarea placeholder="请输入内容" class="layui-textarea" name="content" lay-verify="required"></textarea>
      </div>
    </div>

    <!-- mark -->
    <div class="layui-form-item layui-form-text">
      <label class="layui-form-label">注意事项</label>
      <div class="layui-input-block">
        <textarea placeholder="请输入内容" class="layui-textarea" name="mark"></textarea>
      </div>
    </div>

    <div class="layui-form-item" pane>
      <label class="layui-form-label">接收对象</label>
      <div class="layui-input-block">
        {if $role=="admin" /}
        <input type="checkbox" name="role[]" title="Admin" value="admin">
        <input type="checkbox" name="role[]" title="Teacher" value="teacher">
        <input type="checkbox" name="role[]" title="Student" value="student">
        {/if}
        {if $role=="teacher" /}
        <input type="checkbox" name="role[]" title="Admin" value="admin" disabled>
        <input type="checkbox" name="role[]" title="Teacher" value="teacher">
        <input type="checkbox" name="role[]" title="Student" value="student">
        {/if}
      </div>
    </div>

    <center>
      <div class="layui-form-item">
        <button class="layui-btn" lay-submit="" lay-filter="save">提交</button>
        <button type="reset" class="layui-btn">重置</button>
      </div>
    </center>
  </form>
</body>

</html>

<!-- 加载jQuery资源 -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script> -->
<!-- 加载本地的jQuery资源 -->
<script src="__JQuery__/jquery-3.6.0.min.js"></script>

<!-- layui的相关操作 -->
<script>
  // 引入form模块
  layui.use(['form', 'layer'], function name() {
    var form = layui.form,
      layer = layui.layer;
    var $ = layui.$;

    //数据提交
    form.on('submit(save)', function (data) {
      //console.log(data.field);
      $.ajax({
        type: "post",
        url: "{:url('notice/notices')}",
        data: data.field,
        dataType: 'json',
        success: function (res) {
          if (res.code == 200) {
            layer.msg(res.msg, { 'icon': 1 });
          } else {
            layer.msg(res.msg, { 'icon': 2 });
          }
        }
      });
      return false;
    });

  });
</script>