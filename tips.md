tips:

邮件发送使用phpmailer/phpmailer模块
进入项目后,安装composer require phpmailer/phpmailer
使用phpmailer时，需要用到php的openssl扩展，在php.ini中开启
在composer.json设置了自动加载,phpmailer=>extend/phpmailer

验证器的快速创建:php think make:validate 验证器名字
使用验证场景可以对不同需求进行验证,调用方法:验证器->sance('场景')->checked('数据')
直接调用验证类的check方法即可完成验证

数据库连接问题:受到.env文件以及config\database.php的影响

多应用模式下路由各自部署在各种的应用下面
访问规则：127.0.0.1:端口/index.php(入口文件)/应用/自定的路由规则

默认应用在app中设置,已经设置为index应用
默认控制器在route中设置,已经设置为index控制器
视图模板的后缀名在view中设置，以及设置为php

Thinkphp6命名规则

目录和文件

    目录使用小写+下划线；
    类库、函数文件统一以.php为后缀；
    类的文件名均以命名空间定义，并且命名空间的路径和类库文件所在路径一致；
    类（包含接口和Trait）文件采用驼峰法命名（首字母大写），其它文件采用小写+下划线命名；
    类名（包括接口和Trait）和文件名保持一致，统一采用驼峰法命名（首字母大写）；

函数和类、属性命名
    
    类的命名采用驼峰法（首字母大写），例如 User、UserType；
    函数的命名使用小写字母和下划线（小写字母开头）的方式，例如 get_client_ip；
    方法的命名使用驼峰法（首字母小写），例如 getUserName；
    属性的命名使用驼峰法（首字母小写），例如 tableName、instance；
    特例：以双下划线__打头的函数或方法作为魔术方法，例如 __call 和 __autoload；

常量和配置

    常量以大写字母和下划线命名，例如 APP_PATH；
    配置参数以小写字母和下划线命名，例如 url_route_on 和url_convert；
    环境变量定义使用大写字母和下划线命名，例如APP_DEBUG；

数据表和字段

    数据表和字段采用小写加下划线方式命名，并注意字段名不要以下划线开头，例如 think_user 表和 user_name字段，不建议使用驼峰和中文作为数据表及字段命名。

# ThinkPHP 6.0

> 运行环境要求PHP7.2+，兼容PHP8.1

[官方应用服务市场](https://market.topthink.com) | [`ThinkAPI`——官方统一API服务](https://docs.topthink.com/think-api)

ThinkPHPV6.0版本由[亿速云](https://www.yisu.com/)独家赞助发布。

## 主要新特性

- 采用`PHP7`强类型（严格模式）
- 支持更多的`PSR`规范
- 原生多应用支持
- 更强大和易用的查询
- 全新的事件系统
- 模型事件和数据库事件统一纳入事件系统
- 模板引擎分离出核心
- 内部功能中间件化
- SESSION/Cookie机制改进
- 对Swoole以及协程支持改进
- 对IDE更加友好
- 统一和精简大量用法

## 安装

```
composer create-project topthink/think tp 6.0.*
```

如果需要更新框架使用

```
composer update topthink/framework
```

## 文档

[完全开发手册](https://www.kancloud.cn/manual/thinkphp6_0/content)

## 参与开发

请参阅 [ThinkPHP 核心框架包](https://github.com/top-think/framework)。

## 版权信息

ThinkPHP遵循Apache2开源协议发布，并提供免费使用。

本项目包含的第三方源码和二进制文件之版权信息另行标注。

版权所有Copyright © 2006-2021 by ThinkPHP (http://thinkphp.cn)

All rights reserved。

ThinkPHP® 商标和著作权所有者为上海顶想信息科技有限公司。

更多细节参阅 [LICENSE.txt](LICENSE.txt)