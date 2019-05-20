<?php
if(isset($_POST["submit"]) && $_POST["submit"] == "注册")
{
    $user = $_POST["Register_Name"];
    $psw = $_POST["Password"];
    $psw_confirm = $_POST["Confirm_Password"];
    $phone = $_POST["Phone_Number"];
    if($user == "" || $psw == "" || $psw_confirm == "" || $phone == "")
    {
        echo "<script>alert('请确认信息完整性！'); history.go(-1);</script>";
    }
    else
    {
        if($psw == $psw_confirm)
        {
            //$conn=mysql_connect("219.245.4.239","root","12345")  or die(mysql_error());
            $conn=mysql_connect("localhost","root","123456")  or die(mysql_error());        //连接数据库
            mysql_select_db('lables',$conn) or die(mysql_error());  //选择数据库
            mysql_query("set names utf8"); //设定字符集
            $sql = "select register_name from register where register_name = '$_POST[Register_Name]'"; //SQL语句
            $result = mysql_query($sql);    //执行SQL语句
            $num = mysql_num_rows($result); //统计执行结果影响的行数
            if($num)    //如果已经存在该用户
            {
                echo "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
                      <script>alert('用户名已存在'); history.go(-1);</script>";
            }
             else    //不存在当前注册用户名称
             {
                $sql_insert = "insert into register (register_name,password,phone,post_id) values('$_POST[Register_Name]','$_POST[Password]','$_POST[Phone_Number]','p002')";
                $res_insert = mysql_query($sql_insert);
                //$num_insert = mysql_num_rows($res_insert);
                if($res_insert)
                {
                    echo "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
                          <script>alert('注册成功！'); window.location.href='../Login/Login.php';</script>";
                }
                else
                {
                    echo "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
                          <script>alert('系统繁忙，请稍候！'); history.go(-1);</script>";
                }
             }
        }
        else
        {
            echo "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
                  <script>alert('密码不一致！'); history.go(-1);</script>";
        }
    }
}
else
{
    echo "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
          <script>alert('提交未成功！'); history.go(-1);</script>";
 }
?>