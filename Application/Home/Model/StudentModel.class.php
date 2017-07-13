<?php
  namespace Home\Model;
  use Think\Model;
  class StudentModel extends Model{
      public  function  add($username,$password){
          $sql = "insert into student  (name,sno) VALUES ('$username','$password')";
          $result=M()->execute($sql);
          return $result;
      }
  }