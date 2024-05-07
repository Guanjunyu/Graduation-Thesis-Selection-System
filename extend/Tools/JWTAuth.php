<?php

namespace Tools;

use Firebase\JWT\BeforeValidException;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\JWT;
use Firebase\JWT\SignatureInvalidException;

use Firebase\JWT\Key;


class JWTAuth
{

    /**
     * 封装Toekn产生方法
     * @param email data[]
     * @return mixed
     */

    public static function EnToken($email,$data)
    {
        //把配置文件config/app.php里面自定义常量JWTAuth_key当作盐值
        //$key = config('app.JWTAuth_key');
        $key = "1111";
        //定义token生成信息项，并赋值给$tokenmsg
        $tokenmsg = array(
            //"iss" => config('app.JWTAuth_iss'),//签发机构，比如爱兔网
            "iss" => "guan",
            "aud" => $email,//接收人，也就是发给谁
            "iat" => time(), //签发时间,当前时间
            "nbf" => time(), //生效时间,立即生效
            'exp' => time() + 10800, //过期时间，4分钟后(240s)
            'data' => $data, //自定义信息
        );
        //利用JWT里面的encode()方法生成token,H256是转码方式定义
        $token = JWT::encode($tokenmsg, $key, 'HS256'); 
        return $token;
    }

    /**
     * 封装Toekn检验方法
     * @param string $token
     * @return array
     */

    public static function DeToken($Token)
    {
        //设置盐值和加密时使用的时候相同,用于解码
        //$key = config('app.JWTAuth_key');
        $key = "1111";
        try {
            /*设置时间延迟
            *即在设置过期时间的基础上增加leeway时间
            *若验证时间刚好好在 exp<now<exp+leeway 之间Token仍然有效
            我这里设置的总的有效时间为300s
            */
            JWT::$leeway = 60;
            //对token解码，得到的一个对象，所以直接转成数组
            $data =(array)JWT::decode($Token, new Key($key, 'HS256'));

            //获取token里面的相关信息并赋值给数据集
            /*
                *$result[
                    code
                    msg
                    data
                ]
            */
            $result['data'] = $data['data'];
            //定义Result变量的status字段
            $result['code'] = "200";
            $result['msg']="";
            //验证通过后返回$result数据集
            return $result;
            //如果验证失败，catch以下错误
        } catch (SignatureInvalidException $exception) {
            //定义result数据集状态码status和data的默认值
            $result['code'] = 10002;
            $result['msg'] = '验证失败！请重新登录';
            return $result;
        } catch (BeforeValidException $exception) {
            //定义result数据集状态码status和data的默认值
            $result['code'] = 10003;
            $result['msg'] = 'token未生效，请稍后！';
            return $result;
        } catch (ExpiredException $exception) {
            //定义result数据集状态码status和data的默认值
            $result['code'] = 10004;
            $result['msg'] = '登录过期，请重新登录！';
            return $result;
        } catch (\Exception $exception) {
            //定义result数据集状态码status和data的默认值
            $result['code'] = 10005;
            $result['msg'] = '未知错误，请重新登录！';
            return $result;
        }
    }

}
