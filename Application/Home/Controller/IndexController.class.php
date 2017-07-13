<?php
/**
 * Created by PhpStorm.
 * User: giozola
 * Date: 2017/7/11
 * Time: 13:47
 */
namespace Home\Controller;
use Think\Controller;

class IndexController extends CommonController
{

    public function readFile(){

//        header("Access-Control-Allow-Origin: *");
        echo "<h1 style='width: 230px; margin:0 auto'> 文件操作 Test</h1>";
        echo "<br>";
        $filePath= $_SERVER["DOCUMENT_ROOT"]."/Application/Home/Controller";
        echo "<br>";
        $mfile = fopen("index.html","r",$filePath) or die("Unable to open file!");
//        echo fread($mfile,filesize($filePath));       //输出文件内容
        while(!feof($mfile)){      //检查函数是否到底。  feof   end of file
             echo fgets($mfile);     //执行完后，文件指针移到下一行。  fgetc()  移动到下一个字符
        }
        echo "<br>";
        fclose($mfile);  //关闭打开的文件。
        echo "<br>";
        echo "<br>";
        echo "<br>";
    }
    /**
    *  写文件
    **/
    public function writeFile(){
        $txt = "我是一个粉刷匠！咿呀咿呀呦~~<br>";
        $mfile = fopen("myTest.txt","r+") or die("Unable to open file！");
        fwrite($mfile,$txt);
        $txt = "刷了房顶又刷墙，刷子像飞一样。";
        fwrite($mfile,$txt);
        fclose($mfile);
        echo file_get_contents("myTest.txt");
    }

    /**
     *  跳转到上传图片页面
     * @Author   zwc
     * @DateTime 2017-07-12
     */
    public function toUpLoad(){
        $this->display("upLoad");
    }

    /**
     * 上传文件方法
     * @Author   zwc
     * @DateTime 2017-07-12
     * @return   [type]
     */		
    public function upLoadFile(){
        $error =  $_FILES["file"]["error"];
        if($error > 0){
            echo "Error :".$error;
        }
        else{
            echo "upload:".$_FILES["file"]["name"]."<br>";
            echo "Type:".$_FILES["file"]["type"]."<br>";
            echo "Size:".$_FILES["file"]["size"]."<br>";
            echo "Stored in: " . $_FILES["file"]["tmp_name"]."<br>";
            $uploadFilePath = "Public/upload/".$_FILES["file"]["name"];
            if(file_exists($uploadFilePath))
            {
            	echo  $uploadFilePath." already exit";
            }else{
            	$res = move_uploaded_file($_FILES["file"]["tmp_name"], $uploadFilePath);
            	echo "upload  in ".$uploadFilePath."<br>";
                echo $res;
            }
        }
    }

    public function getUploadProcess(){
        session_start();

        //ini_get()获取php.ini中环境变量的值
        $i = ini_get('session.upload_progress.name');

        //ajax中我们使用的是get方法，变量名称为ini文件中定义的前缀 拼接 传过来的参数
        $key = ini_get("session.upload_progress.prefix").$_GET[$i];    
        //判断 SESSION 中是否有上传文件的信息
        if (!empty($_SESSION[$key])) {                                        
            //已上传大小
            $current = $_SESSION[$key]["bytes_processed"];
            //文件总大小
            $total = $_SESSION[$key]["content_length"];

            //向 ajax 返回当前的上传进度百分比。
            echo $current < $total ? ceil($current / $total * 100) : 100;
        }else{
            echo 100;                                                       
        }
    }
    /**
     * 设置cookie的值
     * @Author   zwc
     * @DateTime 2017-07-12
     */
    public function setCookieTest(){
    	setcookie("username","zhangsan0",time()+3600);
    	if (isset($_COOKIE["username"])) {
    		echo "cookie  username  is set";
    	}
    }
    /**
     * 获取cookie
     * @Author   zwc
     * @DateTime 2017-07-12
     * @return   [type]
     */
    public function getCookieTest(){
    	echo $_COOKIE["username"];
    }
    /**
     * 删除cookie
     * @Author   zwc
     * @DateTime 2017-07-12
     * @param    [type]
     * @return   [type]
     */
    function deleteCookie($cookieName){
    	setcookie($cookieName,"",time()-1);
    }

    public function setSession(){
        setSession("name","guoke");
    }
    public function getSession(){
        echo getSession("name");
    }

    public function flushFile(){
        $mfile = fopen("myTest.txt", "r+") or die("didn`t open file");
        echo fflush("Test.txt");
        fclose($mfile);
    }
}