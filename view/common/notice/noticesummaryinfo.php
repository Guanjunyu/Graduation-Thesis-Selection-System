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
	<div>
		<form class="layui-form layui-form-pane" action="">
			<div class="layui-form-item">
				<div class="layui-inline">
					<label class="layui-form-label">数据检索</label>
					<div class="layui-input-inline">
						<!--注意此处input标签里的id-->
						<input class="layui-input" name="search" id="search" autocomplete="off" placeholder="请输入标题进行查询">
					</div>
				</div>
				<div class="layui-inline">
					<!--注意此处button标签里的type属性-->
					<button type="button" id="search-btn" class="layui-btn layui-btn-primary"><i
							class="layui-icon"></i> 搜 索</button>
				</div>
			</div>
		</form>
	</div>

	<div class="header">
		<div></div>
	</div>

	<table class="layui-table" lay-even id="demo" lay-filter="test">
		<thead>
			<tr>
				<th style="text-align:center;">标题</th>
				<th style="text-align:center;">接收组</th>
				<th style="text-align:center;">发布时间</th>
				<th style="text-align:center;">详细信息</th>
				<th style="text-align:center;">操作</th>
			</tr>
		</thead>
		<tbody>
			{volist name="lists" id='vo'}
			<tr>
				<td style="text-align:center;">{$vo.title}</td>
				<td style="text-align:center;">{$vo.rolegroup}</td>
				<td style="text-align:center;">{$vo.create_time}</td>
				<td style="text-align:center;"><a style="color:blue;" onclick="show({$vo.id})">查看详情</a></td>
				<td style="text-align:center;">
					<button type="button" class="layui-btn layui-btn-primary layui-btn-xs" onclick="del({$vo.id})">
						<i class="layui-icon layui-icon-delete"></i>删除
					</button>
				</td>
			</tr>
			{/volist}
		</tbody>
	</table>
</body>

</html>

<!-- 加载jQuery资源 -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script> -->
<!-- 加载本地的jQuery资源 -->
<script src="__JQuery__/jquery-3.6.0.min.js"></script>

<script>
	// 引入form模块
	layui.use(['form', 'layer', 'table'], function name() {
		var form = layui.form,
			layer = layui.layer,
			table = layui.table;
		var $ = layui.$;
	});

	//search
	function searchData() {
		var data = $("#search").val();
		if (data != '') {
			layer.open({
				type: 2,
				title: '',
				maxmin: true,
				anim: 1,
				shade: 0.3,
				area: ['550px', '550px'],
				content: "searchdata?data=" + data
			});
		} else {
			layer.alert("请输入学生姓名");
		}
	}

	//show
	function show(id) {
		layer.open({
			type: 2,
			title: '',
			maxmin: true,
			anim: 1,
			shade: 0.3,
			area: ['550px', '550px'],
			content: "noticeinfo?id=" + id
		});
	}

		//del
	function del(id) {
			layer.confirm('确定要审核不通过吗？', {
				icon: 3,
				btn: ['确定', '取消']
			}, function () {
				$.get("noticedel", { 'id': id }, function (res) {
					if (res.code != 200) {
						layer.alert(res.msg, { icon: 2 });
					} else {
						layer.msg(res.msg);
						setTimeout(function () { window.location.reload(); }, 1000);
					}
				}, 'json');
			});
		}
	
</script>