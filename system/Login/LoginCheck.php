<?php
global $login;
if(isset($_POST["submit"]) && $_POST["submit"] == "登录")
{
    $user = $_POST["Userame"];
    $psw = $_POST["Password"];
    if($user == "" || $psw == "")
    {
        echo "<script>alert('请输入用户名或密码！'); history.go(-1);</script>";
    }
    else
    {
        //$conn=mysql_connect("219.245.4.239","root","12345")  or die(mysql_error());
        $conn=mysql_connect("localhost","root","123456")  or die(mysql_error());
        mysql_select_db('lables',$conn) or die(mysql_error());
        mysql_query("set names utf8");
        $sql = "select register_name,password from register where register_name = '$user' and password = '$psw'";
        $result = mysql_query($sql);    //执行SQL语句
        $num = mysql_num_rows($result); //统计执行结果影响的行数
        if($num)
        {
            $login = array('username'=>$_POST["Userame"],
                'password'=>$_POST["Password"]);
            session_start();
            session_register(login);
            $row = mysql_fetch_array($result);  //将数据以索引方式储存在数组中
            echo "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
                  <script>window.location.href=('../user/User.php');</script>";
        }
        else
        {
            echo "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
                  <script>alert('用户名或密码不正确！');history.go(-1);</script>";
        }
    }
}
else
{
    echo "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
          <script>alert('提交未成功！'); history.go(-1);</script>";
  }

?>