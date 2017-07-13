<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Gentelella Alela! | </title>

    <!-- Bootstrap -->
    <link href="/Public/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="/Public/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="/Public/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="/Public/vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="/Public/build/css/custom.min.css" rel="stylesheet">
    <link href="/Public/css/login.css" rel="stylesheet">
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form>
              <h1>Login Form</h1>
              <div id="loginError" style="color: red"> <?php echo ($message); ?></div>
              <div>
                <input id="username"  type="text" class="form-control" placeholder="Username" required="" />
              </div>
              <div>
                <input id="password" type="password" class="form-control" placeholder="Password" required="" />
              </div>
              <div>
                <a class="btn btn-default submit" onclick="login()">Log in</a>
                <a class="reset_pass" href="#">Lost your password?</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">New to site?
                  <a href="#signup" class="to_register"> Create Account </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
                  <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
                </div>
              </div>
            </form>
          </section>
        </div>

        <div id="register" class="animate form registration_form">
          <section class="login_content">
            <form>
              <h1>Create Account</h1>
              <div>
                <span id="usernameMsg" class="loginCheck"> * 用户名格式不正确 </span>
                <input type="text" name="username" class="form-control" placeholder="Username" required="" />
              </div>
              <div>
                <span id="passwordMsg" class="loginCheck"> * 密码格式不正确</span>
                <input type="password" name="password" class="form-control" placeholder="Password" required="" />
              </div>
              <div>
                <span id="emailMsg" class="loginCheck"> * 邮箱格式不正确</span>
                <input type="email" name="email" class="form-control" placeholder="Email" required="" />
              </div>
              <!-- 登录邮箱验证 -->
<!--               <div>
                <span id="check" class="loginCheck"> * 验证码不正确</span>
                <input style="width:50%;display: inline;margin-right:20%" type="text" class="form-control" placeholder="验证码" required="" />
                <input type="button" value="获取验证码" class="btn btn-default" onclick="getCheck()">
              </div> -->

              <div>
                <div class="btn btn-default submit" onclick="submit()">Submit</div>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Already a member ?
                  <a href="#signin" class="to_register"> Log in </a>
                </p>

                <div class="clearfix"></div>
                <br />
                <div>
                  <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
                  <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </body>
  <script type="text/javascript" src="/Public/js/jquery-3.2.1.min.js"></script>
<script type="text/javascript">
/** 邮箱验证 */
/*function getCheck(){
  var email = $("input[name='email']").val();
  console.log(email);
  $.ajax({
    type :"POST",
    url :"/admin.php/Account/getEmailCheck",
    data : {
      email : email
    },
    datatype:"json",
    success : function (data){
        console.log("success");
    }
  })
}
*/

/** 登录   */
  function login(){
    var username = $("#username").val();
    var password = $("#password").val();
    $.ajax({
      type : 'POST',
      url : "/admin.php/Account/login",
      data : {
        username : username,
        password :  password
      },
      datatype : "json",
      success : function (data){
        if (data == 1){
            window.location.href = "/admin.php";
        }else {
          $("#loginError").text("用户名或密码错误！");
        }
      }
    })
  }

  /**
   * 注册
   */
  function submit(){


    var username = $("input[name='username']").val();
    var password = $("input[name='password']").val();
    var email = $("input[name='email']").val();
    $.ajax({
      type: 'POST',
      url: "/admin.php/Account/createAccount",
      data:{
        username:username,
        password:password,
        email:email
      },
      datatype: "json",
      success: function(data){
        $(".loginCheck").hide();
        var obj =  JSON.parse(data);
        if (obj.code>0){
          window.location.href = "/admin.php/Index/toLogin";
        }else {
          if (obj.email != 1){
            $("#emailMsg").show();
          }
          if (obj.password != 1){
            $("#passwordMsg").show();
          }
          if (obj.username != 1){
            $("#usernameMsg").show();
          }
          if(obj.nameisexit == 1){
            alert("用户名已存在！");
          }
        }
      }
    });
  }
</script>
</html>