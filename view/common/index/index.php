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
	
	<link rel="stylesheet" href="__Common__/Index/CSS/index.css">
    <script src="__Common__/Index/JS/admin.js"></script>

	<style>
		.layadmin-side-shrink .layui-layout-admin .layui-logo {
			width: 60px;
			background-image:url("/static/bews/images/logob32.jpg");
		}
	</style>
</head>

<body layadmin-themealias="default" class="layui-layout-body">
	<div id="LAY_app" class="layadmin-tabspage-none">
		<div class="layui-layout layui-layout-admin">
			
			<!-- 头部区域 -->
			<div class="layui-header">
				
				<!-- 头部左侧 -->
				<ul class="layui-nav layui-layout-left">
					<li class="layui-nav-item layadmin-flexible" lay-unselect onclick="shrink()">
						<a href="javascript:;" layadmin-event="flexible" title="侧边伸缩">
							<i class="layui-icon layui-icon-shrink-right" id="LAY_app_flexible"></i>
						</a>
					</li>
				</ul>

				<!-- 头部右侧 -->
				<ul class="layui-nav layui-layout-right" lay-filter="layadmin-layout-right">
				
					<!-- 刷新 -->
					<li class="layui-nav-item" lay-unselect title="刷新">
						<a href="javascript:;" onclick="Reload()">
							<i class="layui-icon layui-icon-refresh-3">刷新页面</i>
						</a>
					</li>

					<!-- 刷新 -->
					<li class="layui-nav-item" lay-unselect title="缓存清理">
						<a href="javascript:;" onclick="Clear()">
							<i class="layui-icon layui-icon-delete">缓存清理</i>
						</a>
					</li>

					<!-- 全屏 -->
					<li class="layui-nav-item layui-hide-xs" lay-unselect title="全屏" onclick="fullScreen()">
						<a href="javascript:;" layadmin-event="fullscreen">
							<i class="layui-icon layui-icon-screen-full">页面全屏</i>
						</a>
					</li>

					<!-- 个人信息 -->
					<li class="layui-nav-item" lay-unselect>
					<a href="javascript:;">
						<img src="//t.cn/RCzsdCq" class="layui-nav-img">
							<cite>{$username}</cite>
					</a>
						<dl class="layui-nav-child">
							<dd layadmin-event="logout" style="text-align:center;" onclick=loginout()>
								<a>退出</a>
							</dd>
						</dl>
					</li>

				</ul>
			</div>

			<!-- 侧边菜单 -->
			<div class="layui-side layui-side-menu">
				<div class="layui-side-scroll">
					<!-- logo -->
					<div class="layui-logo" lay-href="">
						<span>
							<font size="2">
								<a href="index">Graduation Thesis Selection</a>
							</font>
						</span>
					</div>

					<!-- 左侧菜单栏 -->
					<ul class="layui-nav layui-nav-tree" lay-shrink="all" id="LAY-system-side-menu" lay-filter="layadmin-system-side-menu">

					{volist name="menu" id="vo"}
						<!-- 一级菜单 -->
						<li data-name="" data-jump="" class="layui-nav-item">
							<a href="javascript:;" lay-direction="2">
								<i class="layui-icon layui-icons {$vo.icon_class}"></i>
								<cite>{$vo.lable}</cite>
								<!-- 这里涉及到父status=0子状态没有为0 的情况 没有处理 -->
							</a>
							<!-- 二级菜单 -->
							{if (isset($vo['children']) && $vo['children'])}
									<dl class="layui-nav-child">
										{volist name="vo.children" id="cvo"}
											<dd data-name="" data-jump="/">
												{if $cvo['type'] == 1}
													<a href="javascript:;" onclick="menuFire('{$cvo.src}',1)">
														<!-- 这里设置不同的图标 $cvo.icon_class -->
														<i class="layui-icon layui-icons {$cvo.icon_class}"></i>
														<cite>{$cvo.lable}</cite>
													</a>
												{elseif $cvo['type'] == 2 /}
													<a href="{$cvo.src}" target="_blank">
														<!-- 这里设置不同的图标 -->
														<i class="layui-icon layui-icons {$cvo.icon_class}"></i>
														<cite>{$cvo.lable}</cite>
													</a>
												{/if}
											</dd>
										{/volist}
									</dl>
								{/if}
						</li>
					{/volist}

					</ul>

				</div>
			</div>

			<!-- 主体内容 -->
			<div class="layui-body" id="LAY_app_body">
				<div class="layadmin-tabsbody-item layui-show">
					<div class="layui-fluid">
					<div class="layui-card" style="width:100%;background-color:grey;height:10px">&nbsp<div>
						<div class="layui-card">
							<iframe src="/Common/index/welcome" style="width:100%;height:100%;" frameborder="0" scrolling="0">
								主体内容
							</iframe>
						</div>
					<div class="layui-card" style="width:100%;background-color:grey;height:10px">&nbsp<div>
					</div>
				</div>
			</div>

			<!-- 辅助元素，一般用于移动设备下遮罩 -->
			<div class="layadmin-body-shade" layadmin-event="shade" onclick="shrink()"></div>
		</div>
	</div>
	<!-- 辅助元素，一般用于移动设备下遮罩 -->
	<div class="layadmin-body-shade" layadmin-event="shade"></div>
	</div></div>
</body>
</html>

<!-- 加载jQuery资源 -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script> -->
<!-- 加载本地的jQuery资源 -->
<script src="__JQuery__/jquery-3.6.0.min.js"></script>

<script type="text/javascript">
	layui.use(['element','layer','jquery'], function(){
		element = layui.element;
		$ = layui.jquery;
		layer = layui.layer;
		setter = layui.setter;
		resetMainHeight($("iframe"));
	});


	// 重新设置主操作页面高度
	function resetMainHeight(obj){
		var height = parent.document.documentElement.clientHeight - 120;
		$(obj).parent('div').height(height);
	}
	// 菜单点击
	function menuFire(obj){
		$('iframe').attr('src',obj);
		var width = screen();
		if(width < 2){
			shrink();
		}
	}

	//退出登录操作,这里缺失根据角色重定向到不同的登录页面
	function loginout(){
			layer.confirm('确定要退出吗？', {
				icon:3,
				btn: ['确定','取消']
			}, function(){
				$.ajax({
					type: "post",
                	url: "{:url('Common/index/loginout')}",
                	dataType: 'json',
					success: function (res) {
						if(res.code!=200){
							layer.msg(res.msg,{'icon':2});
						}else{
							layer.msg(res.msg,{'icon':1});
							var role=res.data;
							setTimeout(function(){
								if(role=="admin"){
									window.location.href="../../admin/login.php";
								}else{
									window.location.href="index/Login/index";
								}
							},1000);
						}
					}
				});
			});
	}

	function Reload(){
		layer.confirm('确定要刷新整个页面吗？', {
				icon:3,
				btn: ['确定','取消']
			}, function(){
				window.location.reload();
			});
	}

	function Clear(){
		layer.confirm('确定要清除缓存吗？', {
				icon:3,
				btn: ['确定','取消']
			}, function(){
				$.ajax({
					type: "post",
                	url: "{:url('Common/index/clear')}",
                	dataType: 'json',
					data:"flag=1",
					success:function(res){
						if(res.code==200){
							layer.msg(res.msg);
						}else{
							layer.msg(res.mgs);
						}
					}
				})
			});
	}
	
</script>