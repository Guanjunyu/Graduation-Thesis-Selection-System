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
		<span>课题选择</span>
		<div></div>
	</div>

	<table class="layui-table">
		<thead>
			<tr>
                <th style="text-align:center;">编号/ID</th>
				<th style="text-align:center;">课题名称</th>
				<th style="text-align:center;">指导老师</th>
                <th style="text-align:center;">课题难度</th>
                <th style="text-align:center;">课题简介</th>
                <th style="text-align:center;">详细介绍</th>
			</tr>
		</thead>
		<tbody>
			{volist name="lists" id='vo'}
			<tr>
                <td style="text-align:center;">{$vo.projectid}</td>
				<td style="text-align:center;">{$vo.projectname}</td>
				<td style="text-align:center;">{:isset($name[$vo.teacherid])?$name[$vo.teacherid]['name']:''}</td>
				<td style="text-align:center;">
					{if $vo['difficultly']==1}
					<span style="color:black;">简单</span>
					{elseif $vo['difficultly'] == 0 /}
					<span style="color:green;">一般</span>
					{else /}
					<span style="color:red;">困难</span>
					{/if}
				</td>
				<td style="text-align:center;">{$vo.description}</td>
                <td style="text-align:center;"><a style="color:blue;" onclick="show({$vo.projectid})">查看详情</a></td>
			</tr>
			{/volist}
		</tbody>
	</table>
	<center>
	{$lists|raw}
	</center>
</body>

</html>

<!-- 加载jQuery资源 -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script> -->
<!-- 加载本地的jQuery资源 -->
<script src="__JQuery__/jquery-3.6.0.min.js"></script>

<script>
	    //showpage
		function show(projectid){
        layer.open({
			type: 2,
			title: '',
			maxmin: true,
			anim: 1,
			shade: 0.3,
			area: ['550px','550px'],
			content: "showproject?projectid="+projectid
		});
    }
	</script>
