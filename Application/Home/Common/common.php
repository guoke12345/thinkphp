<?php
/**
 * Created by PhpStorm.
 * User: giozola
 * Date: 2017/7/10
 * Time: 14:41
 */



/** 设置session  */
 function setSession($sessionName,$sessionValue)
{
	session_start();
	$_SESSION[$sessionName] = $sessionValue;
}

/** 获取session */
 function getSession($sessionName){
	return $_SESSION[$sessionName];
}
/**
 * 删除某些 session 数据，可以使用 unset() 或 session_destroy()
 * unset($_SESSION["sessioname"])  释放指定session
 * session_destroy()  彻底释放session
 */


/** 删除cookie */
function deleteCookie($cookieName){
    	setcookie($cookieName,"",time()-1);
}