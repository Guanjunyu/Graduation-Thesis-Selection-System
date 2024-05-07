<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <link rel="stylesheet" href="__Layui__/css/layui.css" media="all">
  <link rel="stylesheet" href="__Layui__/css/font-awesome.min.css" media="all">
  <link rel="stylesheet" href="__Layui__/public.css" media="all">
</head>

<body>
  <div class="layui-bg-gray" style="padding: 30px;">
    <div class="layui-row layui-col-space15">
      <div class="layui-col-md6">
        <div class="layui-panel">
          <div class="layui-card-header"><i class="layui-icon layui-icon-notice"></i>&nbsp&nbsp选题控制</div>
          <div style="padding: 50px 30px;">

            <center>
              <div style="margin-bottom: 100px;">
                <span id="flag1">状态：
                  {if $flag1 == 1 }
                  开启中
                  {elseif $flag1 == 0 /}
                  关闭中
                  {else /}
                  未知
                  {/if}
                </span>
              </div>
              <div class="layui-btn-container">
                <button type="button" class="layui-btn" style="margin-right: 40px;" id="btn1_1"
                  onclick="openbt1_1()">开启选题</button>
                <button type="button" class="layui-btn" style="margin-left: 40px;" id="btn1_2"
                  onclick="closebt1_2()">关闭选题</button>
              </div>
            </center>
          </div>
        </div>
      </div>
      <div class="layui-col-md6">
        <div class="layui-panel">
          <div class="layui-card-header"><i class="layui-icon layui-icon-notice"></i>&nbsp&nbsp征题控制</div>
          <div style="padding: 50px 30px;">
            <center>
              <div style="margin-bottom: 100px;">
                <span id="flag2">状态：
                  {if $flag2 == 1 }
                  开启中
                  {elseif $flag2 == 0 /}
                  关闭中
                  {else /}
                  未知
                  {/if}
                </span>
              </div>
              <div class="layui-btn-container">
                <button type="button" class="layui-btn" style="margin-right: 40px;" id="btn2_1"
                  onclick="openbt2_1()">开启征题</button>
                <button type="button" class="layui-btn" style="margin-left: 40px;" id="btn2_2"
                  onclick="closebt2_2()">关闭征题</button>
              </div>
            </center>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>

<script src="__Layui__/layui.js" charset="utf-8"></script>
<script src="__JQuery__/jquery-3.6.0.min.js"></script>

<script>

  layui.use(['layer'], function () {
    var $ = layui.jquery,
      layer = layui.layer;
  });

  function openbt1_1() {
    layer.confirm('确认开启选题吗?', { icon: 3, title: '提示' }, function (index) {
      $.get('topicselection', { 'topicselection': "1" }, function (res) {
        if (res.code == 200) {
          layer.msg("开启成功", { 'icon': 1, 'time': 1500 });
          $("#flag1").text("开启中");
        } else {
          layer.msg("开启失败请重试", { 'icon': 2 });
        }
      }, 'json');
    });
  }


  function closebt1_2() {
    layer.confirm('确认关闭选题吗?', { icon: 3, title: '提示' }, function (index) {
      $.get('topicselection', { 'topicselection': "0" }, function (res) {
        if (res.code == 200) {
          layer.msg("关闭成功", { 'icon': 1, 'time': 1500 });
          $("#flag1").text("关闭中");
        } else {
          layer.msg("关闭失败", { 'icon': 2 });
        }
      }, 'json');
    });
  }

  function openbt2_1() {
    layer.confirm('确认开启征题吗?', { icon: 3, title: '提示' }, function (index) {
      $.get('Signtopic', { 'Signtopic': "1" }, function (res) {
        if (res.code == 200) {
          layer.msg("开启成功", { 'icon': 1, 'time': 1500 });
          $("#flag2").text("开启中");
        } else {
          layer.msg("开启失败请重试", { 'icon': 2 });
        }
      }, 'json');
    });
  }

  function closebt2_2() {
    layer.confirm('确认关闭征题吗?', { icon: 3, title: '提示' }, function (index) {
      $.get('Signtopic', { 'Signtopic': "0" }, function (res) {
        if (res.code == 200) {
          layer.msg("关闭成功", { 'icon': 1, 'time': 1500 });
          $("#flag2").text("关闭中");
        } else {
          layer.msg("关闭失败请重试", { 'icon': 2 });
        }
      }, 'json');
    });
  }

</script>