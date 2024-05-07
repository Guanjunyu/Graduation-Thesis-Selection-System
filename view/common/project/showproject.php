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
    <legend>毕业设计课题</legend>
  </fieldset>
  <form class="layui-form layui-form-pane">

    <div class="layui-form-item">
      <label class="layui-form-label">课题名称</label>
      <div class="layui-input-block">
        <input type="text" autocomplete="off"  class="layui-input"readonly 
        value="{$data.projectname}" style="background-color:snow;">
      </div>
    </div>

    <div class="layui-form-item">
      <label class="layui-form-label">指导老师</label>
      <div class="layui-input-block">
        <input type="text"  autocomplete="off"
          class="layui-input" readonly style="background-color:snow;" value="{$data.teachername}">
      </div>
    </div>

    <div class="layui-form-item">
      <label class="layui-form-label">test</label>
      <div class="layui-input-block">
        <input type="text" name="testdata"  autocomplete="off"
          class="layui-input" style="background-color:snow;" readonly>
      </div>
    </div>

    <!-- 适用专业 -->
    <div class="layui-form-item">
      <label class="layui-form-label">适用专业</label>
      <div class="layui-input-block">
      <input type="text" name="testdata"  autocomplete="off"
          class="layui-input" style="background-color:snow;" readonly value="{$data.majorname['majorname']}">
      </div>
    </div>

    <div class="layui-form-item" pane="">
      <label class="layui-form-label">课题难度</label>
      <div class="layui-input-block">
        <input type="radio" name="difficultly" title="简单" {$data.difficultly==1?'checked':'disabled'} style="background-color:snow;">
        <input type="radio" name="difficultly"  title="一般" {$data.difficultly==2?'checked':'disabled'} style="background-color:snow;">
        <input type="radio" name="difficultly"  title="难" {$data.difficultly==3?'checked':'disabled'} style="background-color:snow;">
      </div>
    </div>
    <div class="layui-form-item layui-form-text">
      <label class="layui-form-label">能力要求</label>
      <div class="layui-input-block">
        <textarea placeholder="请输入内容" class="layui-textarea" readonly style="background-color:snow;">{$data.ability}</textarea>
      </div>
    </div>

    <div class="layui-form-item layui-form-text">
      <label class="layui-form-label">课题描述</label>
      <div class="layui-input-block">
        <textarea placeholder="请输入内容" class="layui-textarea" readonly style="background-color:snow;">{$data.description}</textarea>
      </div>
    </div>

    <div class="layui-form-item layui-form-text">
      <label class="layui-form-label">详细介绍</label>
      <div class="layui-input-block">
        <textarea placeholder="请输入内容" class="layui-textarea" readonly style="background-color:snow;">{$data.content}</textarea>
      </div>
    </div>
  </form>
</body>

</html>
