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

<body>

	<form class="layui-form layui-form-pane" style="padding:0 20%;">
		<div class="layui-tab">
			<ul class="layui-tab-title">
				<li class="layui-this">个人信息</li>
				<li>密码信息</li>
			</ul>
			<div class="layui-tab-content">
				<div class="layui-tab-item layui-show">
					<div style="padding:15px;">
						<label class="layui-form-label">账户</label>
						<div class="layui-input-block">
							<div class="layui-form-label" style="color:#f05050;text-align:left;width:100%;">
								{$aUser['account']}</div>
						</div>
					</div>
					<div style="padding:15px;">
						<label class="layui-form-label">身份</label>
						<div class="layui-input-block">
							<div class="layui-form-label" style="color:#f05050;text-align:left;width:100%;">
								{$aUser['role']}</div>
						</div>
					</div>
					<div style="padding:15px;">
						<label class="layui-form-label">分组信息</label>
						<div class="layui-input-block">
							<div class="layui-form-label" style="color:#f05050;text-align:left;width:100%;">
								{$aUser['groupname']}</div>
						</div>
					</div>

					<div style="padding:15px;">
						<label class="layui-form-label">专业</label>
						<div class="layui-input-block">
							<div class="layui-form-label" style="color:#f05050;text-align:left;width:100%;">
								{$aUser['majorname']}</div>
						</div>
					</div>

					<div style="padding:15px;">
						<label class="layui-form-label">说明</label>
						<div class="layui-input-block">
							<div class="layui-form-label" style="width:100%;text-align:left;color:#999;">
								账户用于登录系统的账号，角色、分组用于确定权限,不能修改</div>
						</div>
					</div>
					<div style="padding:15px;">
						<label class="layui-form-label">姓名</label>
						<div class="layui-input-block">
							<input type="text" class="layui-input" name="name" placeholder="请输入真实姓名"
								value="{$aUser['name']}">
						</div>
					</div>
					<div style="padding:15px;">
						<label class="layui-form-label">Email</label>
						<div class="layui-input-block">
							<input type="text" class="layui-input" name="email" placeholder="请输入邮箱"
								value="{$aUser['email']}">
						</div>
					</div>
					<div style="padding:15px;" pane="">
						<label class="layui-form-label">性别</label>
						<div class="layui-input-block">
							<input type="radio" name="sex" value="1" title="男" {$aUser['sex']==1?'checked':''}>
							<input type="radio" name="sex" value="0" title="女" {$aUser['sex']==0?'checked':''}>
						</div>
					</div>
				</div>
				<div class="layui-tab-item">
					<div style="padding:15px;">
						<label class="layui-form-label">老密码</label>
						<div class="layui-input-block">
							<input type="password" class="layui-input" name="old_pwd" id="old_pwd" placeholder="请输入老密码，不修改不填写">
							<div class="icon-css-view">
								<i id="iconShowView1" class="layui-icon layui-icon-about" style="color: black;"></i>
								<i id="iconHiddenView1" class="layui-icon layui-icon-about" style="color: orangered;"
									hidden></i>
							</div>
						</div>
					</div>
					<div style="padding:15px;">
						<label class="layui-form-label">新密码</label>
						<div class="layui-input-block">
							<input type="password" class="layui-input" name="new_pwd" id="new_pwd" placeholder="请输入新密码，不修改不填写">
							<div class="icon-css-view">
								<i id="iconShowView2" class="layui-icon layui-icon-about" style="color: black;"></i>
								<i id="iconHiddenView2" class="layui-icon layui-icon-about" style="color: orangered;"
									hidden></i>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
	<center>
		<div class="layui-form-item" style="margin-top:10px;">
			<div class="layui-input-block" style="text-align:center;">
				<button type="button" class="layui-btn" onclick="save()">保存</button>
			</div>
		</div>
	</center>
</body>

</html>
<!-- 加载jQuery资源 -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script> -->
<!-- 加载本地的jQuery资源 -->
<script src="__JQuery__/jquery-3.6.0.min.js"></script>

<!-- layui的相关操作 -->
<script>
	layui.use(['layer', 'form', 'element'], function () {
		var form = layui.form;
		element = layui.element;
		layer = layui.layer;
		$ = layui.jquery;
	});

	function save() {
		$.post("", $('form').serialize(), function (res) {
			if (res['code'] != '200') {
				layer.msg(res.msg, {
					'icon': 2
				});
			} else {
				layer.msg(res.msg, {
					'icon': 1
				});
				setTimeout(function () {
					parent.window.location.reload();
				}, 1000);
			}
		}, 'json');
	};

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
	showhidden(old_pwd, iconShowView1, iconHiddenView1);
	showhidden(new_pwd, iconShowView2, iconHiddenView2);
</script>