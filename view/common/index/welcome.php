<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>welcome</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="__Layui__/css/layui.css" media="all">
    <link rel="stylesheet" href="__Layui__/css/font-awesome.min.css" media="all">
    <link rel="stylesheet" href="__Layui__/public.css" media="all">
    <style>
        .layui-card {
            border: 1px solid #f2f2f2;
            border-radius: 5px;
        }

        .icon {
            margin-right: 10px;
            color: #1aa094;
        }

        .icon-cray {
            color: #ffb800 !important;
        }

        .icon-blue {
            color: #1e9fff !important;
        }

        .icon-tip {
            color: #ff5722 !important;
        }

        .layuimini-qiuck-module {
            text-align: center;
            margin-top: 10px
        }

        .layuimini-qiuck-module a i {
            display: inline-block;
            width: 100%;
            height: 60px;
            line-height: 60px;
            text-align: center;
            border-radius: 2px;
            font-size: 30px;
            background-color: #F8F8F8;
            color: #333;
            transition: all .3s;
            -webkit-transition: all .3s;
        }

        .layuimini-qiuck-module a cite {
            position: relative;
            top: 2px;
            display: block;
            color: #666;
            text-overflow: ellipsis;
            overflow: hidden;
            white-space: nowrap;
            font-size: 14px;
        }

        .welcome-module {
            width: 100%;
            height: 210px;
        }

        .panel {
            background-color: #fff;
            border: 1px solid transparent;
            border-radius: 3px;
            -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
            box-shadow: 0 1px 1px rgba(0, 0, 0, .05)
        }

        .panel-body {
            padding: 10px
        }

        .panel-title {
            margin-top: 0;
            margin-bottom: 0;
            font-size: 12px;
            color: inherit
        }

        .label {
            display: inline;
            padding: .2em .6em .3em;
            font-size: 75%;
            font-weight: 700;
            line-height: 1;
            color: #fff;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: .25em;
            margin-top: .3em;
        }

        .layui-red {
            color: red
        }

        .main_btn>p {
            height: 40px;
        }

        .layui-bg-number {
            background-color: #F8F8F8;
        }

        .layuimini-notice:hover {
            background: #f6f6f6;
        }

        .layuimini-notice {
            padding: 7px 16px;
            clear: both;
            font-size: 12px !important;
            cursor: pointer;
            position: relative;
            transition: background 0.2s ease-in-out;
        }

        .layuimini-notice-title,
        .layuimini-notice-label {
            padding-right: 70px !important;
            text-overflow: ellipsis !important;
            overflow: hidden !important;
            white-space: nowrap !important;
        }

        .layuimini-notice-title {
            line-height: 28px;
            font-size: 14px;
        }

        .layuimini-notice-extra {
            position: absolute;
            top: 50%;
            margin-top: -8px;
            right: 16px;
            display: inline-block;
            height: 16px;
            color: #999;
        }
    </style>
</head>

<body id="body">
    <div class="layuimini-container">
        <div class="layuimini-main">
            <div class="layui-row layui-col-space15">
                <div class="layui-col-md6">
                    <!-- 系统公告 -->
                    <div class="layui-card" style="height:100%;">
                        <div class="layui-card-header"><i class="layui-icon layui-icon-notice"></i>&nbsp&nbsp系统公告</div>
                        <div class="layui-card-body layui-text">
                            <div class="layuimini-notice" id="layuimini-notice">
                                <div class="layui-hide" id="noticeid">修改选项卡样式</div>
                                <div class="layuimini-notice-title">修改选项卡样式</div>
                                <div class="layuimini-notice-extra">2022-04-30 1:59</div>
                                <div class="layuimini-notice-content layui-hide">
                                    test-data;
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="__Layui__/layui.js" charset="utf-8"></script>
    <script src="__JQuery__/jquery-3.6.0.min.js"></script>

    <script>

        //         //数据预加载
        // $.ajax({
        //     type: "post",
        //     url: "{:url('notice')}",
        //     dataType: 'json',
        // });


        layui.use(['layer'], function () {
            var $ = layui.jquery,
                layer = layui.layer;

            /**
             * 查看公告信息
             **/

            $("#layuimini-notice").click(function () {
                var title = $(this).children('.layuimini-notice-title').text(),
                    noticeTime = $(this).children('.layuimini-notice-extra').text(),
                    content = $(this).children('.layuimini-notice-content').html(),
                    noticeid = $(this).children('#noticeid').text();
                var html = '<div style="padding:15px 20px; text-align:justify; line-height: 22px;border-bottom:1px solid #e2e2e2;background-color: #2f4056;color: #ffffff">\n' +
                    '<div style="text-align: center;margin-bottom: 20px;font-weight: bold;border-bottom:1px solid #718fb5;padding-bottom: 5px"><h4 class="text-danger">' + title + '</h4></div>\n' +
                    '<div style="font-size: 12px">' + content + '</div>\n' +
                    '</div>\n';
                console.log(noticeid);
                parent.layer.open({
                    type: 1,
                    title: '系统公告' + '<span style="float: right;right: 1px;font-size: 12px;color: #b1b3b9;margin-top: 1px">' + noticeTime + '</span>',
                    area: '300px;',
                    shade: 0.8,
                    id: 'layuimini-notice',
                    btn: ['完成', '取消'],
                    btnAlign: 'c',
                    moveType: 1,
                    content: html,
                    success: function () {
                        //成功回调
                    }
                });
            });

        });
    </script>
</body>

</html>