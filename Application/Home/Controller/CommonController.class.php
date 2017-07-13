<?php
/**
 * Created by PhpStorm.
 * User: giozola
 * Date: 2017/7/11
 * Time: 11:00
 */

namespace Home\Controller;
use Think\Controller;

class CommonController extends Controller{
    /**
     *  登录拦截器
     */
    public function _initialize(){
        header("Content-type:text/html;charset=utf-8");
        if(!session('?username') && !strpos($_SERVER["PATH_INFO"],"/Index") && $_SERVER["PATH_INFO"] != ""){
            redirect('Index/toLogin/message/1');
            exit(0);
        }
    }
}