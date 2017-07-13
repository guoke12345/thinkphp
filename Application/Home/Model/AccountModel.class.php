<?php
namespace  Home\Model;
use Think\Model;
class AccountModel extends Model{
    /**
     * 添加一条记录
     * @param mixed|string $username
     * @param array $passworrd
     * @return false|int
     */
    public function  add($username,$passworrd){
        $sql = "insert into account (username,password) VALUES  ('$username','$passworrd')";
        $result = M()->execute($sql);
        return $result;
    }

    /**
     * 根据用户名 查找
     * @param $username
     * @return false|int
     */
    public function selectByName($username){
        $sql = "select * from account where username = '$username'";
        return M()->execute($sql);

    }

    /**
     * 匹配用户名密码
     * @param $username
     * @param $password
     * @return false|int
     */
    public function selectByAccount($username,$password){
        $sql = "select * from account where username = '$username' and password = '$password'";
        return M()->execute($sql);
    }
}