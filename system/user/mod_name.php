<?php
header("Content-Type: text/html; charset=UTF-8");
if(isset($_POST["submit"]) && $_POST["submit"] == "修改")
{
    $contents_name = $_POST['username'];
    if($contents_name == ''){
        echo "<script>alert('请输入患者姓名！'); history.go(-1);</script>";
        exit();
    }

    $sex = $_POST['usersex'];
    $age = $_POST['userage'];
    if($age == ''){
        echo "<script>alert('病人年龄不能为空！'); history.go(-1);</script>";
        exit();
    }
    if($sex == ''){
        echo "<script>alert('病人性别不能为空！'); history.go(-1);</script>";
        exit();
    }

    // 连接数据库
    //$conn=mysql_connect("219.245.4.239","root","12345")  or die(mysql_error());
    $conn=mysql_connect("localhost","root","123456")  or die(mysql_error());
    mysql_select_db('lables',$conn) or die(mysql_error());
    mysql_query("set names utf8");

    $sql = "select * from upload_labler where id='".$_POST[lable]."'";
    $result = mysql_query($sql);    //执行SQL语句
    $row = mysql_fetch_array($result);
    rename(iconv('utf-8','gb2312','../../upload/'.$row['name']), iconv('utf-8', 'gb2312','../../upload/'.$contents_name));

    $sqlstr1 = "update upload_labler set upload_labler.name='".$contents_name."',upload_labler.sex='".$sex."',upload_labler.age='".$age."'
                where id='".$_POST[lable]."'";
    mysql_query($sqlstr1) or die(mysql_error());

    $sqlstr2 = "update uploads set uploads.username='".$contents_name."',uploads.usersex='".$sex."',uploads.userage='".$age."'
                where userid='".$_POST[lable]."'";
    mysql_query($sqlstr2) or die(mysql_error());

    mysql_close($conn);

    //上传成功
    echo "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
                              <script>alert('修改成功！');window.location.href='User.php';</script>";
}
?>