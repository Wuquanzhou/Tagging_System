<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>在线标注系统</title>
</head>
<body>
<form action="TestPictrue.html" enctype="multipart/form-data" method="post">
<label >标注完成:</label>
<input type="submit" name="submit" value="确定" />
</form>
</body>
</html>
<?php
//获取患者姓名
$contents_name = $_POST['username'];

//静态static
$contents_static = $_POST['userstatic'];
//获取static图片文件
$static_name = $_POST['static_photo'];

//抬眉
$contents_taimei = $_POST['taimei'];
//获取抬眉图片文件
$taiemi_p_name = $_POST['taimei_photo'];
//获取抬眉视频文件
$taimei_v_name = $_POST['taimei_video'];

//皱眉
$contents_zhoumei = $_POST['zhoumei'];
//获取皱眉图片文件
$zhoumei_p_name = $_POST['zhoumei_photo'];
//获取皱眉视频文件
$zhoumei_v_name = $_POST['zhoumei_video'];

//闭眼
$contents_biyan = $_POST['biyan'];
//获取闭眼图片文件
$biyan_p_name = $_POST['biyan_photo'];
//获取闭眼视频文件
$biyan_v_name = $_POST['biyan_video'];

//耸鼻
$contents_songbi = $_POST['songbi'];
//获取耸鼻图片文件
$songbi_p_name = $_POST['songbi_photo'];
//获取耸鼻视频文件
$songbi_v_name = $_POST['songbi_video'];

//微笑
$contents_weixiao = $_POST['weixiao'];
//获取微笑图片文件
$weixiao_p_name = $_POST['weixiao_photo'];
//获取微笑视频文件
$weixiao_v_name = $_POST['weixiao_video'];

//示齿
$contents_shichi = $_POST['shichi'];
//获取示齿图片文件
$shichi_p_name = $_POST['shichi_photo'];
//获取示齿视频文件
$shichi_v_name = $_POST['shichi_video'];

//鼓腮
$contents_gusai = $_POST['gusai'];
//获取鼓腮图片文件
$gusai_p_name = $_POST['gusai_photo'];
//获取鼓腮视频文件
$gusai_v_name = $_POST['gusai_video'];

// 连接数据库
//$conn=mysql_connect("219.245.4.239","root","12345")  or die(mysql_error());
$conn=mysql_connect("localhost","root","123456")  or die(mysql_error());
mysql_select_db('lables',$conn) or die(mysql_error());
mysql_query("set names utf8");
// 判断action
$action = isset($_REQUEST['action'])? $_REQUEST['action'] : '';
// 上传图片
if($action=='add'){
    $sqlstr1 = "insert into uploads(username,userstatic,usertaimei,
                      userzhoumei,userbiyan,usersongbi,userweixiao,usershichi,usergusai)
                      values('".$contents_name."','".$contents_static."','".$contents_taimei.
                      "','".$contents_zhoumei."','".$contents_biyan."','".$contents_songbi."','".
                      $contents_weixiao."','".$contents_shichi."','".$contents_gusai."')";
    mysql_query($sqlstr1) or die(mysql_error());
    $getID=mysql_insert_id();
    $sqlstr2 = "insert into photo_video(id,static_p,taimei_p,taimei_v,zhoumei_p,zhoumei_v,
                      biyan_p,biyan_v,songbi_p,songbi_v,weixiao_p,weixiao_v,shichi_p,shichi_v,gusai_p,gusai_v)
                      values('".$getID."','".$static_name."','".$taiemi_p_name.
                      "','".$taimei_v_name."','".$zhoumei_p_name."','".$zhoumei_v_name."','".
                      $biyan_p_name."','".$biyan_v_name."','".$songbi_p_name."','".$songbi_v_name.
                      "','".$weixiao_p_name."','".$weixiao_v_name."','".$shichi_p_name."','".$shichi_v_name.
                      "','".$gusai_p_name."','".$gusai_v_name."')";
    mysql_query($sqlstr2) or die(mysql_error());
    exit();
 }
?>