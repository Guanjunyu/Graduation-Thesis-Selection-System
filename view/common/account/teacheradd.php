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

<body style="padding:10px; box-sizing: border-box;">
	<fieldset class="layui-elem-field layui-field-title">
		<legend>教师添加</legend>
	</fieldset>

	<form class="layui-form layui-form-pane">
		<!-- adminid -->
		<div class="layui-form-item">
			<label class="layui-form-label">账户</label>
			<div class="layui-input-block">
				<input type="text" class="layui-input" name="teacherid" placeholder="账户请用工号"
					lay-verify="required|number|username" autocomplete="off" maxlength="12">
			</div>
		</div>

		<!-- password -->
		<div class="layui-form-item">
			<label class="layui-form-label">密码</label>
			<div class="layui-input-block">
				<input type="password" class="layui-input" name="password" id="password" placeholder="请输入密码"
					autocomplete="off" lay-verify="password|required">
				<div class="icon-css-view">
					<i id="iconShowView1" class="layui-icon layui-icon-about" style="color: black;"></i>
					<i id="iconHiddenView1" class="layui-icon layui-icon-about" style="color: orangered;" hidden></i>
				</div>
			</div>
		</div>

		<!-- name -->
		<div class="layui-form-item">
			<label class="layui-form-label">姓名</label>
			<div class="layui-input-block">
				<input type="text" class="layui-input" name="name" placeholder="请输入真实姓名" autocomplete="off"
					lay-verify="required|name">
			</div>
		</div>

		<!-- sex -->
		<div class="layui-form-item" pane>
			<label class="layui-form-label">性别</label>
			<div class="layui-input-block">
				<input type="radio" name="sex" value="1" title="男" checked="">
				<input type="radio" name="sex" value="0" title="女">
			</div>
		</div>

		<!-- email -->
		<div class="layui-form-item">
			<label class="layui-form-label">Email</label>
			<div class="layui-input-block">
				<input type="text" class="layui-input" name="email" placeholder="请输入邮箱" lay-verify="email|required"
					autocomplete="off">
			</div>
		</div>

		<!-- groupid -->
		<div class="layui-form-item">
			<label class="layui-form-label">部门</label>
			<div class="layui-input-block">
				<select name="groupid">
					<option value=0></option>
					{volist name="group" id="vo"}
					<option value="{$vo.groupid}">{$vo.groupname}</option>
					{/volist}
				</select>
			</div>
		</div>

		<!-- status -->
		<div class="layui-form-item">
			<label class="layui-form-label">状态</label>
			<div class="layui-input-block">
				<input type="radio" name="status" value="0" title="开启" checked="">
				<input type="radio" name="status" value="1" title="禁用">
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

		//数据提交
		form.on('submit(save)', function (data) {
			//console.log(data.field);
			$.ajax({
				type: "post",
				url: "{:url('../../common/Account/teacheradd')}",
				data: data.field,
				dataType: 'json',
				success: function (res) {
					if (res.code == 200) {
						layer.msg(res.msg, { 'icon': 1 });
						setTimeout(function () { parent.window.location.reload(); }, 200);
					} else {
						layer.msg(res.msg, { 'icon': 2 });
					}
				}
			});
		});

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
					return '用户名不能有特殊字符并且不能以下划线开头和结尾'
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
			}
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
		showhidden(password, iconShowView1, iconHiddenView1);
	});


</script>