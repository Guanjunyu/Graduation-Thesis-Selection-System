*该文件是用于存第三方核心库以及自己对于第三方库的进一步封装

Tools 存放

*对于发送邮件类的进一步封装(SendMail)
/*
    *使用方法:
    *use Tools/SendMail
    *$SendMail=new SendMail( );
    *$SendMail->sendmail($mail,$token);
*/

*对于Token令牌类的进一步封装(JWTAuth)
/*
    *EnToken() 生成Token
    *DeToken() 验证Token
*/