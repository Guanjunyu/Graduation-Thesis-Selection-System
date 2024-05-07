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
	<style type="text/css">
		.header span {
			background: #009688;
			margin-left: 30px;
			padding: 10px;
			color: #ffffff;
		}

		.header div {
			border-bottom: solid 2px #009688;
			margin-top: 8px;
		}

		.header button {
			float: right;
			margin-top: -5px;
		}
	</style>
</head>

<body style="padding:10px; box-sizing: border-box;">
	<fieldset class="layui-elem-field layui-field-title">
		<legend>子菜单添加</legend>
	</fieldset>
	<form class="layui-form layui-form-pane">
		<input type="hidden" name="smid"  value="{$smid}">
		<!-- 菜单lable -->
		<div class="layui-form-item">
			<label class="layui-form-label">导航名</label>
			<div class="layui-input-block">
				<input type="text" class="layui-input" name="lable" placeholder="请输入导航名称" required
				lay-verify="required">
			</div>
		</div>

		<!-- 类型 type 根据type的值确定使用src1 还是 src2-->
		<div class="layui-form-item" style="width:100%;">
			<label class="layui-form-label">类型</label>
			<div class="layui-input-block">
				<select name="type" lay-filter="type" lay-verify="required">
					<option value=0 selected></option>
					<option value='1'>内部代码</option>
					<option value='2'>超链接</option>
				</select>
			</div>
		</div>
		<!-- 跳转的url或者链接 src1 src2 -->
		<div class="layui-form-item" style="display:none;" id="src1">
			<label class="layui-form-label">内部代码</label>
			<div class="layui-input-block" >
				<input type="text" class="layui-input" name="src1" placeholder="请输入：模块/方法"
				>
			</div>
		</div>
		<div class="layui-form-item" style="display:none;" id="src2">
			<label class="layui-form-label">链接地址</label>
			<div class="layui-input-block">
				<input type="text" class="layui-input" name="src2" placeholder="请输入http网址"
				>
			</div>
		</div>

		<!-- 权重/排序sort -->
		<div class="layui-form-item">
			<label class="layui-form-label">排序</label>
			<div class="layui-input-block">
				<input type="number" class="layui-input" name="sort" placeholder="请输入权重,值越大越靠前" 
					lay-verify="required|number" title="最小为0,最大为999的权重" oninput="if(value.length>3)value=value.slice(0,3)" required>
			</div>
		</div>

		<!-- 状态status -->
		<div class="layui-form-item" pane>
			<label class="layui-form-label">状态</label>
			<div class="layui-input-block">
				<input type="radio" name="status" value="1" title="开启" checked="">
				<input type="radio" name="status" value="0" title="禁用">
			</div>
		</div>

		<!-- 数据提交savemenu -->
		<div class="layui-form-item">
			<div class="layui-input-block" style="top: 10px;">
				<button type="submit" class="layui-btn" lay-submit lay-filter="save"
					style="margin-left: 30px;">保存</button>
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
	// 引入form模块
	layui.use(['form', 'layer'], function name() {
		var form = layui.form,
			layer = layui.layer;
		var $ = layui.$;

		form.on('select(type)', function (data) {
			if (data.value == 1) {
				$("#src1").show();
				$("#src2").hide();
				$("#src3").hide();
			} else if (data.value == 2) {
				$("#src1").hide();
				$("#src2").show();
				$("#src3").hide();
			} else {
				$("#src1").hide();
				$("#src2").hide();
				$("#src3").hide();
			}
		});

		form.on('submit(save)', function (data) {
			//console.log(data.field);
			$.ajax({
				type: "post",
				url: "{:url('../../common/navigation/menubuttonadd')}",
				data: data.field,
				dataType: 'json',
				success: function (res) {
					var res=res;
					if(res.code=="200"){
						layer.msg(res.msg,{'icon':1,'time': 2000});
						setTimeout(function(){parent.window.location.reload();},200);
					}else{
						layer.msg(res.msg,{'icon':2});
					}
				}
			});
		});

	});
</script>