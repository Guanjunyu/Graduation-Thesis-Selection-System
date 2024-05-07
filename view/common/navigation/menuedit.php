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

<body style="padding:10px; box-sizing: border-box;">
<fieldset class="layui-elem-field layui-field-title">
  		<legend>导航修改</legend>
</fieldset>
	<form class="layui-form layui-form-pane">

		<!-- 隐藏的smid -->
		<input type="hidden" name="smid" value="{$lists.smid}">

		<!-- 导航名lable -->
		<div class="layui-form-item">
			<label class="layui-form-label">导航名</label>
			<div class="layui-input-block">
				<input type="text" class="layui-input" name="lable" placeholder="请输入导航名" value="{$lists['lable']}" lay-verify="required"
				title="导航名">
			</div>
		</div>

		<!-- 排序sort -->
		<div class="layui-form-item">
			<label class="layui-form-label">排序</label>
			<div class="layui-input-block">
				<input type="number" class="layui-input" name="sort" placeholder="值越大越靠前" value="{$lists['sort']}" lay-verify="required|number"
				oninput="if(value.length>3)value=value.slice(0,3)" title="最小为0,最大为999的权重">
			</div>
		</div>

		<!-- 状态status -->
		<div class="layui-form-item" pane>
			<label class="layui-form-label">状态</label>
			<div class="layui-input-block">
				<input type="radio" name="status" value="1" title="开启" {$lists['status']==1?'checked':''}>
				<input type="radio" name="status" value="0" title="禁用" {$lists['status']==0?'checked':''}>
			</div>
		</div>

		<!-- 数据提交 -->
		<div class="layui-form-item" style="margin-top:10px;">
			<div class="layui-input-block">
				<button type="submit" class="layui-btn" style="margin-left: 30px;" lay-submit lay-filter="save">保存</button>
				<button type="reset" class="layui-btn" style="margin-left: 30px;">重置</button>
			</div>
		</div>
	</form>

</body>

</html>

<!-- 加载jQuery资源 -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script> -->
<!-- 加载本地的jQuery资源 -->
<script src="__JQuery__/jquery-3.6.0.min.js"></script>

<!-- layui的相关操作 -->
<script>
	layui.use(['form', 'layer'], function name() {
		var form = layui.form,
			layer = layui.layer;
		var $ = layui.$;

		//数据提交
		form.on('submit(save)', function (data) {
			$.ajax({
				type: "post",
				url: "{:url('../../common/navigation/menuedit')}",
				data: data.field,
				dataType: 'json',
				success: function (res) {
					console.log(res);
					if(res.code==200){
						layer.msg(res.msg,{'icon':1});
						setTimeout(function(){parent.window.location.reload();},1000);
					}else{
						layer.msg(res.msg,{'icon':2});
					}
				}
			});
		});

	});
</script>