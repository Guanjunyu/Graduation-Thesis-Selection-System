<?php

namespace Tools;

use PHPMailer\PHPMailer\PHPMailer;

class SendMail
{
    public function sendemail($email,$Token)
    {

        //定义发送人的邮箱
        $sendmail="xxxxxxxxxxxxxxxx@qq.com";
        
        // 定义发送方名称
        $sendname="Graduation Thesis Selection System";

        //定义收件人的邮箱
        $toemail = "xxxxxxxxxxxxxxx@qq.com";

        //定义接收方名称
        $toname="Dear User";

        //定义重置链接
        $url="http://127.0.0.1:8001/common/Reset/emailcheck?token=".$Token;

        //邮件标题
        $title="Retrieve password【Please do not reply，thanks】";

        //邮件内容
        $connect="【Graduation Thesis Selection System】您正在使用邮箱重置密码，该
        链接有效期5分分钟，为您的账号安全，请勿泄漏给他人（若非本人操作，请忽略本邮件）,请点击链接完成重置：".$url;
 
        //实例化发送邮件类
        $mail = new PHPMailer();
 
        // 使用SMTP服务
        $mail->isSMTP();

        // 编码格式为utf8
        $mail->CharSet = "utf8";

        // 发送方的SMTP服务器地址,这里使用qq邮箱
        $mail->Host = "smtp.qq.com";

        // 是否使用身份验证
        $mail->SMTPAuth = true;

        // 发送方的邮箱用户名
        $mail->Username = $sendmail;

        //smtp授权密码
        $mail->Password = "xxxxxxxxxxxxxxxxx";

        // 使用ssl协议方式
        $mail->SMTPSecure = "ssl";

        //ssl协议方式端口号是465/994
        $mail->Port = 465;
 
        // 设置发件人信息，如邮件格式说明中的发件人，这里会显示为Mailer(xxxx@163.com），Mailer是当做名字显示
        $mail->setFrom($sendmail,$sendname);

        // 设置收件人信息，如邮件格式说明中的收件人，这里会显示为Liang(yyyy@163.com)
        $mail->addAddress($toemail,$toname);
        
        //$mail->addReplyTo($sendmail,"Reply");// 设置回复人信息，指的是收件人收到邮件后，如果要回复，回复邮件将发送到的邮箱地址
        //$mail->addCC("xxx@163.com");// 设置邮件抄送人，可以只写地址，上述的设置也可以只写地址(这个人也能收到邮件)
        //$mail->addBCC("xxx@163.com");// 设置秘密抄送人(这个人也能收到邮件)
        //$mail->addAttachment("bug0.jpg");// 添加附件
 
        // 邮件标题
        $mail->Subject = $title;

        // 邮件正文
        $mail->Body = $connect;
 
        //判断是否发送成功
        if(!$mail->send()){
            $msg=[
                'code'=>'900001',
                'msg'=>"Mailer Error: ".$mail->ErrorInfo,
                'data'=>""
            ];
            return $msg;
        }else{
            $msg=[
                'code'=>'200',
                'msg'=>'successful',
                'data'=>''
            ];
            return $msg;
        }
    }

}

