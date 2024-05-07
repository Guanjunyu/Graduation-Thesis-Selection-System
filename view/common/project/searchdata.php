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

	<fieldset class="layui-elem-field layui-field-title" style="margin-top: 50px;">
		<legend>检索结果</legend>
	</fieldset>
	<table class="layui-table" lay-even id="demo" lay-filter="test">
		<thead>
			<tr>
				<th style="text-align:center;">姓名</th>
				<th style="text-align:center;">专业</th>
				<th style="text-align:center;">选题情况</th>
				{if $data.checked==1}
				<th style="text-align:center;">课题名称</th>
				<th style="text-align:center;">指导老师</th>
				{/if}
			</tr>
		</thead>
		<tbody>
			<tr>
				<td style="text-align:center;">{$data.name}</td>
				<td style="text-align:center;">{:isset($data.majorname)?$data.majorname:''}</td>
				<td style="text-align:center;">
				{if $data.checked=="0"/}
				<span style="color:red;">未选择</span>
				{elseif $data.checked==1 /}
				<span style="color:black;">已选择</span>
				{/if}
				</td>
				{if $data.checked==1}
				<td style="text-align:center;">{:isset($data.projectname)?$data.projectname:''}</td>
				<td style="text-align:center;">{:isset($data.teachername)?$data.teachername:''}</td>
				{/if}
			</tr>
		</tbody>
	</table>
</body>

</html>