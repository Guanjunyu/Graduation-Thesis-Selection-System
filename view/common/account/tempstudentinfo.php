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
		<span>学生审核列表</span>
		<div></div>
	</div>

	<table class="layui-table">
		<thead>
			<tr>
				<th style="text-align:center;">学号</th>
				<th style="text-align:center;">姓名</th>
				<th style="text-align:center;">性别</th>
                <th style="text-align:center;">Email</th>
				<th style="text-align:center;">角色</th>
                <th style="text-align:center;">学院</th>
                <th style="text-align:center;">系</th>
				<th style="text-align:center;">专业</th>
                <th style="text-align:center;">班级</th>
				<th style="text-align:center;">状态</th>
				<th style="text-align:center;">操作</th>
			</tr>
		</thead>
		<tbody>
			{volist name="lists" id='vo'}
			<tr>
				<td style="text-align:center;">{$vo.studentid}</td>
				<td style="text-align:center;">{$vo.studentname}</td>
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
                <td style="text-align:center;">{$vo.class}</td>
				<td style="text-align:center;">
					{if $vo.checked==0}
						<span style="color:red;">未审核</span>
					{elseif $vo.checked==1 /}
						<span style="color:black;">审核通过</span>
					{elseif $vo.checked==2 /}
						<span style="color:green;">审核不通过</span>
					{else /}
						未知
					{/if}
				</td>
				<td style="text-align:center;">
					{if $vo.checked==0}
					<button type="button" class="layui-btn layui-btn-primary layui-btn-xs" onclick="pass({$vo.studentid})">
						<i class="layui-icon layui-icon-edit"></i>通过
					</button>
					<button type="button" class="layui-btn layui-btn-primary layui-btn-xs" onclick="nopass({$vo.studentid})">
						<i class="layui-icon layui-icon-delete"></i>不通过
					</button>
					{/if}
					{if $vo.checked!=0}
					<button type="button" class="layui-btn layui-btn-primary layui-btn-xs" onclick="del({$vo.studentid})">
						<i class="layui-icon layui-icon-delete"></i>删除此纪录
					</button>
					{/if}
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

	// 通过
	function pass(studentid){
		layer.confirm('确定要审核通过吗？', {
			icon:3,
			btn: ['确定','取消']
		}, function(){
			$.post("tempstudentadd",{'studentid':studentid},function(res){
				if(res.code!=200){
					layer.alert(res.msg,{icon:2});
				}else{
					layer.msg(res.msg);
					setTimeout(function(){window.location.reload();},1000);
				}
			},'json');
		});
	}

	// 不通过
	function nopass(studentid){
		layer.confirm('确定要审核不通过吗？', {
			icon:3,
			btn: ['确定','取消']
		}, function(){
			$.post("tempstudentnopass",{'studentid':studentid},function(res){
				if(res.code!=200){
					layer.alert(res.msg,{icon:2});
				}else{
					layer.msg(res.msg);
					setTimeout(function(){window.location.reload();},1000);
				}
			},'json');
		});
	}

	// 删除记录
	function del(studentid){
		layer.confirm('确定要删除记录吗？', {
			icon:3,
			btn: ['确定','取消']
		}, function(){
			$.post("tempstudentdel",{'studentid':studentid},function(res){
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