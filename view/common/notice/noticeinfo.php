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
    <legend>公告信息</legend>
  </fieldset>
  <form class="layui-form layui-form-pane" action="">

    <!-- 公告标题 -->
    <div class="layui-form-item">
      <label class="layui-form-label">公告标题</label>
      <div class="layui-input-block">
        <input type="text" name="title" value="{$lists.title}" class="layui-input" readonly style="background-color:snow">
      </div>
    </div>

    <!-- content -->
    <div class="layui-form-item layui-form-text">
      <label class="layui-form-label">内容</label>
      <div class="layui-input-block">
        <textarea class="layui-textarea" name="content" readonly style="background-color:snow">
        {$lists.content}
      </textarea>
      </div>
    </div>

    <!-- mark -->
    <div class="layui-form-item layui-form-text">
      <label class="layui-form-label">注意事项</label>
      <div class="layui-input-block">
        <textarea class="layui-textarea" name="mark" readonly style="background-color:snow">
        {$lists.mark}
      </textarea>
      </div>
    </div>

    <div class="layui-form-item" pane>
      <label class="layui-form-label">接收对象</label>
      <div class="layui-input-block">
      <input type="text" name="rolegroup" class="layui-input" value="{$lists.rolegroup}" readonly style="background-color:snow">
      </div>
    </div>

    <div class="layui-form-item" pane>
      <label class="layui-form-label">发布时间</label>
      <div class="layui-input-block">
      <input type="text" class="layui-input" value="{$lists.create_time}" readonly style="background-color:snow">
      </div>
    </div>

  </form>
</body>

</html>
