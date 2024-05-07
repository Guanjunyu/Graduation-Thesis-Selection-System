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
	<div class="header">
		<span>教师列表</span>
		<button type="button" class="layui-btn layui-btn-primary layui-btn-sm" onclick="add()">
			<i class="layui-icon layui-icon-add-1"></i>添加
		</button>
		<div></div>
	</div>

	<table class="layui-table">
		<thead>
			<tr>
				<th style="text-align:center;">账户/ID</th>
				<th style="text-align:center;">姓名</th>
				<th style="text-align:center;">性别</th>
                <th style="text-align:center;">Email</th>
				<th style="text-align:center;">角色</th>
                <td style="text-align:center;">学院</td>
                <th style="text-align:center;">系</th>
                <th style="text-align:center;">专业</th>
				<th style="text-align:center;">分组</th>
				<th style="text-align:center;">状态</th>
				<th style="text-align:center;">操作</th>
			</tr>
		</thead>
		<tbody>
			{volist name="lists" id='vo'}
			<tr>
				<td style="text-align:center;">{$vo.teacherid}</td>
				<td style="text-align:center;">{$vo.name}</td>
				<td style="text-align:center;">
					{if $vo['sex']==1}
					<span style="color:red;">男</span>
					{elseif $vo['sex'] == 0 /}
					<span style="color:green;">女</span>
					{else /}
					未知
					{/if}
				</td>
				<td style="text-align:center;">{$vo.email}</td>
				<td style="text-align:center;">{$vo.role}</td>
                <td style="text-align:center;">{:isset($college[$vo.collegecode])?$college[$vo.collegecode]['collegename']:''}</td>
                <td style="text-align:center;">{:isset($faculty[$vo.facultycode])?$faculty[$vo.facultycode]['facultyname']:''}</td>
                <td style="text-align:center;">{:isset($major[$vo.majorcode])?$major[$vo.majorcode]['majorname']:''}</td>
				<td style="text-align:center;">{:isset($group[$vo.groupid])?$group[$vo.groupid]['groupname']:''}</td>
				<td style="text-align:center;">{$vo.status==0?'开启':'<span style="color:red;">禁用</span>'}</td>
				<td style="text-align:center;">
					<button type="button" class="layui-btn layui-btn-primary layui-btn-xs" onclick="edit({$vo.teacherid})">
						<i class="layui-icon layui-icon-edit"></i>编辑
					</button>
					<button type="button" class="layui-btn layui-btn-primary layui-btn-xs" onclick="del({$vo.teacherid})">
						<i class="layui-icon layui-icon-delete"></i>删除
					</button>
				</td>
			</tr>
			{/volist}
		</tbody>
	</table>
	<center>
		{$lists|raw}
	<center>
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

	});

	// 添加
	function add(){
		layer.open({
			type: 2,
			title: '',
			maxmin: true,
			anim: 1,
			shade: 0.3,
			area: ['550px','550px'],
			content: "teacheradd"
		});
	}

	// 编辑
	function edit(teacherid){
		layer.open({
			type: 2,
			title: '',
			shade: 0.3,
			maxmin: true,
			anim: 1,
			area: ['550px','550px'],
			content: "teacheredit?teacherid="+teacherid
		});
	}

	// 删除
	function del(teacherid){
		layer.confirm('确定要删除吗？', {
			icon:3,
			btn: ['确定','取消']
		}, function(){
			$.post("teacherdel",{'teacherid':teacherid},function(res){
				if(res.code!=200){
					layer.alert(res.msg,{icon:2});
				}else{
					layer.msg(res.msg);
					setTimeout(function(){window.location.reload();},1000);
				}
			},'json');
		});
	}
	
</script>