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
		<legend>分组权限添加</legend>
	</fieldset>
	<form class="layui-form layui-form-pane">
		<input type="hidden" name="groupid" value="{$group.groupid}">
		<!-- groupname -->
		<div class="layui-form-item">
			<label class="layui-form-label">分组名称</label>
			<div class="layui-input-block">
				<input type="text" class="layui-input" name="groupname" placeholder="请输入分组名称"
					value="{$group.groupname}">
			</div>
		</div>

		<!-- status -->
		<div class="layui-form-item" pane>
			<label class="layui-form-label">状态</label>
			<div class="layui-input-block">
				<input type="radio" name="status" value="1" title="开启" {$group.status==1?'checked':''}>
				<input type="radio" name="status" value="0" title="禁用" {$group.status==0?'checked':''}>
			</div>
		</div>

		<!-- lable -->
		<fieldset class="layui-elem-field layui-field-title">
			<legend>分组权限菜单</legend>
		<div class="layui-form-itme">
			<!-- <label class="layui-form-label">权限菜单</label> -->
			{volist name="menus" id="vo"}
			<hr>
			<label class="layui-form-label">一级菜单</label>
			<div class="layui-input-block">
				<input type="checkbox" name="menu[{$vo.smid}]"  title="{$vo.lable}" id="{$vo.smid}" lay-filter="menu_one"
					{:isset($group['right']) && $group['right'] && in_array($vo.smid,$group['right'])?'checked':''}>
				<hr>
			</div>
			<label class="layui-form-label">二级级菜单</label>
			<div class="layui-input-block">
			{if (isset($vo['children']) && $vo['children'])}
				    {volist name="vo.children" id="cvo"}
				        <input type="checkbox" name="menu[{$cvo.smid}]" lay-skin="primary" title="{$cvo.lable}" lay-filter="menu_two" id="{$cvo.smid}"
					    {:isset($group['right']) && $group['right'] && in_array($cvo.smid,$group['right'])?'checked':''}>
				    {/volist}
                {/if}
			</div>
			{/volist}
		</div>
		</fieldset>

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
		
		//处理父节点的
		form.on('checkbox(menu_one)',function(data){
			if(!(data.elem.checked)){
				var id=data.elem.id;
				$.get('GetSon',{id:id},function(res){
					for(var i=0;i<res.length;i++){
						var p="#"+res[i];
						$(p).prop('checked',false)
						form.render('checkbox');
					}
				},"json");
			}
		});

		//处理子节点的
		form.on('checkbox(menu_two)',function(data){
			if(data.elem.checked){
				var id=data.elem.id;
				$.get("GetParent",{id,id},function(res){
					if(!$("#"+res['parentid']).prop("checked")){
						console.log(1);
						$("#"+res['parentid']).prop("checked",true);
						form.render('checkbox');
					}
				},'json');
			}
		});


		//数据提交
		form.on('submit(save)', function (data) {
			//console.log(data.field);
			$.ajax({
				type: "post",
				url: "{:url('../../common/Account/groupedit')}",
				data: data.field,
				dataType: 'json',
				success: function (res) {
					if (res.code == "200") {
						layer.msg(res.msg, { 'icon': 1 });
						setTimeout(function () { parent.window.location.reload(); }, 200);
					} else {
						layer.msg(res.msg, { 'icon': 2 });
					}
				}
			});
			
		});
	});
</script>