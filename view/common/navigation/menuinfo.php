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
			.header span{background:#009688;margin-left:30px;padding:10px;color:#ffffff;}
			.header div{border-bottom:solid 2px #009688;margin-top: 8px;}
			.header button{float:right;margin-top:-5px;}
	</style>

</head>

<body style="padding:10px; box-sizing: border-box;">
		<div class="header">
			<span>导航列表</span>
            <button type="submit" class="layui-btn layui-btn-xs layui-btn-primary" lay-submit lay-filter="add">
				<i class="layui-icon layui-icon-add-1">添加</i>
			</button>
			<div></div>
		</div>
		<table class="layui-table" style="text-align:center;">

            <!-- 标题 -->
			<thead>
				<tr>
					<th style="text-align:center;">ID</th>
					<th style="text-align:center;">菜单名</th>
					<th style="text-align:center;">权重</th>
					<th style="text-align:center;">状态</th>
					<th style="text-align:center;">操作</th>
				</tr>
			</thead>

            <!-- 数据内容 -->
			<tbody>
                {volist name="lists" id='vo'}
				<tr>
					<td>{$vo['smid']}</td>
					<td>{$vo['lable']}</td>
					<td>{$vo['sort']}</td>
					<td>
						{$vo['status']==1?'开启':'<span style="color:red;">禁用</span>'}
					</td>
					<td>
					<button type="button" class="layui-btn layui-btn-xs layui-btn-normal" onclick="buttoninfo({$vo.smid})">下级菜单</button>
					<button type="button" class="layui-btn layui-btn-xs layui-btn-primary" onclick="edit({$vo.smid})">
						<i class="layui-icon layui-icon-edit"></i>编辑
					</button>
					<button type="button" class="layui-btn layui-btn-xs layui-btn-primary" onclick="del({$vo.smid})">
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

<!-- layui的相关操作 -->
<script>
    // 引入form模块
    layui.use(['form','layer'], function name() {
        var form = layui.form,
            layer=layui.layer;
        var $ = layui.$;

		//导航添加
		form.on("submit(add)",function(){
			layer.open({
				type:2,
				shade: 0.3,
				area: ['550px','550px'],
				maxmin: true,
				scrollbar: false,
				closeBtn:2,
				title:"",
				anim: 1,
				content: '../../Common/navigation/menuadd'
			});
		});
    });

	//导航修改
	function edit(smid){
		layer.open({
			type: 2,
			closeBtn:2,
			title: '',
			scrollbar: false,
			shade: 0.3,
			area: ['550px','550px'],
			anim: 1,
			content: '../../Common/navigation/menuedit?smid='+smid
		});
	}

	//导航删除
	function del(smid){
		layer.confirm('确定要删除此导航以及下面的子菜单吗?',{icon:3,btn:['确定','取消']},function(){
			$.ajax({
				type: "post",
				url: "{:url('../../common/navigation/menudel')}",
				data: {'smid':smid},
				dataType: 'json',
				success: function (res) {
					if(res.code==200){
						layer.msg(res.msg,{icon:1});
						setTimeout(function(){window.location.reload();},1000);
					}else{
						layer.alert(res.msg,{icon:2});
					}
				}
			});
		});
	}

	//子菜单显示
	function buttoninfo(smid){

		$.get("nextmenu",{smid:smid},function(res){
			if(res.code==200){
				window.location.href="buttoninfo?smid="+smid;
			}else{
				var index1=layer.confirm('是否添加子菜单?', {icon: 3, title:'提示'}, function(index1){
					var index=layer.open({
					type: 2,
					closeBtn:2,
					title: '',
					scrollbar: false,
					shade: 0.3,
					area: ['550px','550px'],
					anim: 1,
					content: '../../Common/navigation/menubuttonadd?smid='+smid,
					success:function(){
						layer.close(index1);
						$.get("nextmenu",{smid:smid},function(data){
							if(data.code==200){
								//layer.closeAll();
								layer.msg(data.msg,{'icon':1,'time': 2000});
							}
						},"json");
						}
					});
				});

			}
		},'json');


	}

</script>

