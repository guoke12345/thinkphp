<?php
namespace Home\Controller;
use Think\Controller;
use Org\Util\String;
class AccountController extends Controller {

    public function index(){
        $this->toLogin();
    }

    public function toLogin(){
        if($_GET["message"] == 1){
            $this->assign("message"," * 请登录后操作！");
        }
        $this->display('login');
    }

    public function login(){
        $username = $_POST["username"];
        $password = $_POST["password"];
        $result = 1;
        $model = new \Home\Model\AccountModel();
        $sqlResult = $model->selectByAccount($username,$password);
        if(is_null($sqlResult) || empty($sqlResult)){
            $result = 0;
        }else{
            session('username',$username);
            session('password',$password);
        }
        echo $result;
    }

    /**
     * 注册账号
     */
    public function createAccount(){
        $result["code"] = 0;
        $userReg = "/^[A-Za-z\d]\w{3,11}[a-zA-Z\d]/";
        $passReg = "/^[A-Za-z0-9]{6,20}$/";
        $emailReg = "/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i";

        $username = $_POST["username"];
        $password = $_POST["password"];
        $email = $_POST["email"];
        // 用户名密码初步校验
        if(preg_match($passReg, $password)>0){
            $result["password"] = 1;
        }
        if(preg_match($emailReg, $email)>0){
            $result["email"] = 1;
        }
        if(preg_match($userReg, $username)>0){
            $result["username"] = 1;
        }
        if( $result["username"] == 1 && $result["password"] == 1 && $result["email"] == 1 ){
            // 用户名密码插入数据库
            //判断用户是否存在
            $b =  $this->isAccountExit($username);
            if(!$b){
                $model = new \Home\Model\AccountModel;
                $sqlResult = $model->add($username,$password);
                if($sqlResult > 0){
                    $result["message"] = "注册成功！";
                    $result["code"] = 1;
                }
            }else{
                $result["nameisexit"] = 1;
            }
        }
        echo json_encode($result);
    }

    /**
     * 判断用户是否存在
     * @param $username
     * @return bool
     */
    private function isAccountExit($username){
        $b = true;
        $model = new \Home\Model\AccountModel;
        $sqlResult = $model->selectByName($username);
        if(is_null($sqlResult) || empty($sqlResult)){
            $b = false;
        }
        return $b;
    }

    /** 发送邮箱验证码 */
/*    public function getEmailCheck(){
        import("Org.Util.String");
        new String();
        $checkMsg = String::randString();
        $email = $_POST["email"];
        mail($email, "主题", "消息 ：网站验证码为 ：".$checkMsg);
        echo "asdfds";
    }*/
}