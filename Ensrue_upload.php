<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>在线标注系统</title>
</head>

<body>
<form action="upload_file.php" enctype="multipart/form-data" method="post">
<?php
echo "请确认以下标注信息是否正确或完整：<br><br>";
//获取患者姓名
$contents_name = $_POST['username'];
echo "患者姓名:".$contents_name."<br>";
$counter = 0;
while(true){
    //echo "asd=".var_dump(is_dir( iconv( 'UTF-8', 'GB18030', "upload/".$contents_name )))."=asd";
    if (is_dir( iconv( 'UTF-8', 'GB18030', "upload/".$contents_name ))) {
        ++$counter;
        if(strpos($contents_name,"_")){
             $contents_name = substr($contents_name, 0, strrpos($contents_name, '_'));
        }
        $contents_name = $contents_name."_".$counter;
   }else{
        break;
  }
}
mkdir(iconv('utf-8', 'gb2312','upload/'.$contents_name ));
?>
<input type="hidden" name="username" value="<?php echo $contents_name;?>"><br>
<label >静态static:</label>
<?php
//静态static
$contents_static1 = $_POST['userstatic1'];

$contents_static2 = $_POST['userstatic2'];
$contents_static3 = $_POST['userstatic3'];
$contents_static4 = $_POST['userstatic4'];
$contents_static = $contents_static1.$contents_static2.$contents_static3.$contents_static4;
?>
<label>额纹是否对称：</label>
<?php
if($contents_static1==0){
   echo "正常<br>";
}else if($contents_static1==1){
   echo "轻度<br>";
}else if($contents_static1==2){
    echo "中度<br>";
}else{
    echo "重度<br>";
}
?>
<label style="padding-left:81px;">眼睑开合情况：</label>
<?php
if($contents_static2==0){
   echo "正常<br>";
}else if($contents_static2==1){
   echo "轻度<br>";
}else if($contents_static2==2){
    echo "中度<br>";
}else{
    echo "重度<br>";
}
?>
<label style="padding-left:81px;">鼻唇沟深浅程度：</label>
<?php
if($contents_static3==0){
   echo "正常<br>";
}else if($contents_static3==1){
   echo "轻度<br>";
}else if($contents_static3==2){
    echo "中度<br>";
}else{
    echo "重度<br>";
}
?>
<label style="padding-left:81px;">嘴角歪斜的程度：</label>
<?php
if($contents_static4==0){
   echo "正常<br>";
}else if($contents_static4==1){
   echo "轻度<br>";
}else if($contents_static4==2){
    echo "中度<br>";
}else{
    echo "重度<br>";
}
?>
<input type="hidden" name="userstatic" value="<?php echo $contents_static;?>">
<label >静态图片文件:</label>
<?php
//获取static图片文件
if(is_uploaded_file($_FILES['static_photo']['tmp_name'])){
    $static_photo=$_FILES["static_photo"];
    //获取数组里面的值
    $static_name=$static_photo["name"];//上传文件的文件名
    $static_name_file = $static_name ;
    $type=$static_photo["type"];//上传文件的类型
    $tmp_name=$static_photo["tmp_name"];//上传文件的临时存放路径
    //判断是否为图片
    switch ($type){
        case 'image/pjpeg':$okType=true;
        break;
        case 'image/jpeg':$okType=true;
        break;
        case 'image/gif':$okType=true;
        break;
        case 'image/png':$okType=true;
        break;
    }

    if($okType){
        /**
         * 0:文件上传成功<br/>
         * 1：超过了文件大小，在php.ini文件中设置<br/>
         * 2：超过了文件的大小MAX_FILE_SIZE选项指定的值<br/>
         * 3：文件只有部分被上传<br/>
         * 4：没有文件被上传<br/>
         * 5：上传文件大小为0
         */
        $error=$static_photo["error"];//上传后系统返回的值
        $newname = iconv('utf-8','gb2312',$static_name);
        $newbname_1 = iconv('utf-8','gb2312','upload/'.$contents_name.'/'.$newname);
        move_uploaded_file($tmp_name,$newbname_1);
        if($error==0){
            //echo "文件上传成功啦！";
//             $dir = "upload/";
//             $filePath = $dir.$static_name_file;
//             echo "<img src=".$filePath.">";
            echo "<a href='upload/$contents_name/$static_name' target='_blank'>$static_name_file</a><br>";
            //echo " alt=\"图片预览:\r文件名:".$destination."\r上传时间:\">";
        }elseif ($error==1){
            echo "超过了文件大小，在php.ini文件中设置";
        }elseif ($error==2){
            echo "超过了文件的大小MAX_FILE_SIZE选项指定的值";
        }elseif ($error==3){
            echo "文件只有部分被上传";
        }elseif ($error==4){
            echo "没有文件被上传";
        }else{
            echo "上传文件大小为0";
        }
    }else{
        echo "请上传jpg,gif,png等格式的图片！";
    }
}
?>
<input type="hidden" name="static_photo" value="<?php echo $static_name_file;?>">

<br><label >抬眉:</label>
<label style="padding-left:41px;">额肌运动的异常程度:</label>
<?php
//抬眉
$contents_taimei = $_POST['taimei'];
if($contents_taimei==0){
    echo "正常<br>";
}else if($contents_taimei==1){
    echo "轻度<br>";
}else if($contents_taimei==2){
    echo "中度<br>";
}else{
    echo "重度<br>";
}
?>
<input type="hidden" name="taimei" value="<?php echo $contents_taimei;?>">
<label >抬眉图片文件:</label>
<?php
//获取抬眉图片文件
if(is_uploaded_file($_FILES['taimei_photo']['tmp_name'])){
    $taimei_photo=$_FILES["taimei_photo"];
    //获取数组里面的值
    $taiemi_p_name=$taimei_photo["name"];//上传文件的文件名
    $taimei_p_name_file = $taiemi_p_name;
    $type=$static_photo["type"];//上传文件的类型
    $tmp_name=$taimei_photo["tmp_name"];//上传文件的临时存放路径
    //判断是否为图片
    switch ($type){
        case 'image/pjpeg':$okType=true;
        break;
        case 'image/jpeg':$okType=true;
        break;
        case 'image/gif':$okType=true;
        break;
        case 'image/png':$okType=true;
        break;
        case 'image/jpg':$okType=true;
        break;
    }
    if($okType == null){
        $okType = true;
    }
    if($okType){
        /**
         * 0:文件上传成功<br/>
         * 1：超过了文件大小，在php.ini文件中设置<br/>
         * 2：超过了文件的大小MAX_FILE_SIZE选项指定的值<br/>
         * 3：文件只有部分被上传<br/>
         * 4：没有文件被上传<br/>
         * 5：上传文件大小为0
         */
        $error=$taimei_photo["error"];//上传后系统返回的值
        $newname = iconv('utf-8','gb2312',$taiemi_p_name);
        $newbname_1 = iconv('utf-8','gb2312','upload/'.$contents_name.'/'.$taiemi_p_name);
        move_uploaded_file($tmp_name,$newbname_1);
        if($error==0){
            //echo "文件上传成功啦！";
//             $test = mb_convert_encoding($taiemi_p_name,"UTF-8","GB2312");
//             $encode = mb_detect_encoding($test, array('ASCII','UTF-8','GB2312','GBK','BIG5'));
           // echo $encode; //查看变量编码格式
            //echo $test;
            echo "<a href='upload/$contents_name/$taiemi_p_name' target='_blank'>$taiemi_p_name</a>";
            //echo " alt=\"图片预览:\r文件名:".$destination."\r上传时间:\">";
        }elseif ($error==1){
            echo "超过了文件大小，在php.ini文件中设置";
        }elseif ($error==2){
            echo "超过了文件的大小MAX_FILE_SIZE选项指定的值";
        }elseif ($error==3){
            echo "文件只有部分被上传";
        }elseif ($error==4){
            echo "没有文件被上传";
        }else{
            echo "上传文件大小为0";
        }
    }else{
        echo "请上传jpg,gif,png等格式的图片！";
    }
    ?>
    <input type="hidden" name="taimei_photo" value="<?php echo $taimei_p_name_file;?>">
    <?php
}
?>
<br><label >抬眉视频文件:</label>
<?php
//获取抬眉视频文件
if(is_uploaded_file($_FILES['taimei_video']['tmp_name'])){
    $taimei_video=$_FILES["taimei_video"];
    //获取数组里面的值
    $taimei_v_name=$taimei_video["name"];//上传文件的文件名
    $name_file = $taimei_v_name ;
    $type=$taimei_video["type"];//上传文件的类型
    $size=$taimei_video["size"];//上传文件的大小
    $tmp_name=$taimei_video["tmp_name"];//上传文件的临时存放路径
    switch ($type){
        case 'image/mp4':$okType=true;
        break;
        case 'image/mov':$okType=true;
        break;
    }
    if($okType){
    $error=$taimei_video["error"];//上传后系统返回的值
    $newname = iconv('utf-8','gb2312',$taimei_v_name);
    $newbname_1 = iconv('utf-8','gb2312','upload/'.$contents_name.'/'.$taimei_v_name);
//     $encode = mb_detect_encoding($taimei_v_name, array("ASCII","UTF-8","GB2312","GBK","BIG5"));
//     echo $encode;
    move_uploaded_file($tmp_name,$newbname_1);
    //echo "<img src=".$destination.">";
    echo "<a href='upload/$contents_name/$name_file' target='_blank'>$name_file</a><br>";
    //echo " alt=\"图片预览:\r文件名:".$destination."\r上传时间:\">";
    }else{
        echo "<script>alert('抬眉视频格式错误！'); history.go(-1);</script>";;
    }
?>
<input type="hidden" name="taimei_video" value="<?php echo $name_file;?>">
<?php
}
?>

<br><label >皱眉:</label>
<label style="padding-left:41px;">皱眉肌运动的异常程度:</label>
<?php
//皱眉
$contents_zhoumei = $_POST['zhoumei'];
if($contents_zhoumei==0){
    echo "正常<br>";
}else if($contents_zhoumei==1){
    echo "轻度<br>";
}else if($contents_zhoumei==2){
    echo "中度<br>";
}else{
    echo "重度<br>";
}
?>
<input type="hidden" name="zhoumei" value="<?php echo $contents_zhoumei;?>">
<label >皱眉图片文件:</label>
<?php
//获取皱眉图片文件
if(is_uploaded_file($_FILES['zhoumei_photo']['tmp_name'])){
    $zhoumei_photo=$_FILES["zhoumei_photo"];
    //获取数组里面的值
    $zhoumei_p_name=$zhoumei_photo["name"];//上传文件的文件名
    $name_file = $zhoumei_p_name ;
    $type=$zhoumei_photo["type"];//上传文件的类型
    $size=$zhoumei_photo["size"];//上传文件的大小
    $tmp_name=$zhoumei_photo["tmp_name"];//上传文件的临时存放路径
    //判断是否为图片
    switch ($type){
        case 'image/pjpeg':$okType=true;
        break;
        case 'image/jpeg':$okType=true;
        break;
        case 'image/gif':$okType=true;
        break;
        case 'image/png':$okType=true;

        break;
    }
    if($okType == null){
        $okType = true;
    }
    if($okType){
        /**
         * 0:文件上传成功<br/>
         * 1：超过了文件大小，在php.ini文件中设置<br/>
         * 2：超过了文件的大小MAX_FILE_SIZE选项指定的值<br/>
         * 3：文件只有部分被上传<br/>
         * 4：没有文件被上传<br/>
         * 5：上传文件大小为0
         */
        $error=$zhoumei_photo["error"];//上传后系统返回的值
        $newname = iconv('utf-8','gb2312',$zhoumei_p_name);
        $newbname_1 = iconv('utf-8','gb2312','upload/'.$contents_name.'/'.$zhoumei_p_name);
        move_uploaded_file($tmp_name,$newbname_1);
        if($error==0){
            //echo "文件上传成功啦！";
            //echo "<img src=".$destination.">";
            echo "<a href='upload/$contents_name/$name_file' target='_blank'>$name_file</a>";
            //echo " alt=\"图片预览:\r文件名:".$destination."\r上传时间:\">";
        }elseif ($error==1){
            echo "超过了文件大小，在php.ini文件中设置";
        }elseif ($error==2){
            echo "超过了文件的大小MAX_FILE_SIZE选项指定的值";
        }elseif ($error==3){
            echo "文件只有部分被上传";
        }elseif ($error==4){
            echo "没有文件被上传";
        }else{
            echo "上传文件大小为0";
        }
    }else{
        echo "请上传jpg,gif,png等格式的图片！";
    }
    ?>
<input type="hidden" name="zhoumei_photo" value="<?php echo $name_file;?>">
    <?php
}
?>
<br><label >皱眉视频文件:</label>
<?php
//获取皱眉视频文件
if(is_uploaded_file($_FILES['zhoumei_video']['tmp_name'])){
    $zhoumei_video=$_FILES["zhoumei_video"];
    //获取数组里面的值
    $zhoumei_v_name=$zhoumei_video["name"];//上传文件的文件名
    $name_file = $zhoumei_v_name ;
    $type=$zhoumei_video["type"];//上传文件的类型
    $size=$zhoumei_video["size"];//上传文件的大小
    $tmp_name=$zhoumei_video["tmp_name"];//上传文件的临时存放路径
    /**
     * 0:文件上传成功<br/>
     * 1：超过了文件大小，在php.ini文件中设置<br/>
     * 2：超过了文件的大小MAX_FILE_SIZE选项指定的值<br/>
     * 3：文件只有部分被上传<br/>
     * 4：没有文件被上传<br/>
     * 5：上传文件大小为0
     */
    $error=$zhoumei_video["error"];//上传后系统返回的值
    $newname = iconv('utf-8','gb2312',$zhoumei_v_name);
    $newbname_1 = iconv('utf-8','gb2312','upload/'.$contents_name.'/'.$zhoumei_v_name);
    move_uploaded_file($tmp_name,$newbname_1);
    //echo "<img src=".$destination.">";
    echo "<a href='upload/$contents_name/$name_file' target='_blank'>$name_file</a><br>";
    //echo " alt=\"图片预览:\r文件名:".$destination."\r上传时间:\">";
?>
<input type="hidden" name="zhoumei_video" value="<?php echo $name_file;?>">
<?php
}
?>

<br><label >闭眼:</label>
<label style="padding-left:41px;">眼睑开合的异常程度:</label>
<?php
//闭眼
$contents_biyan = $_POST['biyan'];
if($contents_biyan==0){
    echo "正常<br>";
}else if($contents_biyan==1){
    echo "轻度<br>";
}else if($contents_biyan==2){
    echo "中度<br>";
}else{
    echo "重度<br>";
}
?>
<input type="hidden" name="biyan" value="<?php echo $contents_biyan;?>">
<label >闭眼图片文件:</label>
<?php
//获取闭眼图片文件
if(is_uploaded_file($_FILES['biyan_photo']['tmp_name'])){
    $biyan_photo=$_FILES["biyan_photo"];
    //获取数组里面的值
    $biyan_p_name=$biyan_photo["name"];//上传文件的文件名
    $name_file = $biyan_p_name ;
    $type=$static_photo["type"];//上传文件的类型
    $size=$biyan_photo["size"];//上传文件的大小
    $tmp_name=$biyan_photo["tmp_name"];//上传文件的临时存放路径
    //判断是否为图片
    switch ($type){
        case 'image/pjpeg':$okType=true;
        break;
        case 'image/jpeg':$okType=true;
        break;
        case 'image/gif':$okType=true;
        break;
        case 'image/png':$okType=true;
        break;
    }
    if($okType == null){
        $okType = true;
    }
    if($okType){
        /**
         * 0:文件上传成功<br/>
         * 1：超过了文件大小，在php.ini文件中设置<br/>
         * 2：超过了文件的大小MAX_FILE_SIZE选项指定的值<br/>
         * 3：文件只有部分被上传<br/>
         * 4：没有文件被上传<br/>
         * 5：上传文件大小为0
         */
        $error=$biyan_photo["error"];//上传后系统返回的值
        $newname = iconv('utf-8','gb2312',$biyan_p_name);
        $newbname_1 = iconv('utf-8','gb2312','upload/'.$contents_name.'/'.$biyan_p_name);
        move_uploaded_file($tmp_name,$newbname_1);
        if($error==0){
            // echo "文件上传成功啦！";
            //echo "<img src=".$destination.">";
            echo "<a href='upload/$contents_name/$name_file' target='_blank'>$name_file</a>";
            //echo " alt=\"图片预览:\r文件名:".$destination."\r上传时间:\">";
        }elseif ($error==1){
            echo "超过了文件大小，在php.ini文件中设置";
        }elseif ($error==2){
            echo "超过了文件的大小MAX_FILE_SIZE选项指定的值";
        }elseif ($error==3){
            echo "文件只有部分被上传";
        }elseif ($error==4){
            echo "没有文件被上传";
        }else{
            echo "上传文件大小为0";
        }
    }else{
        echo "请上传jpg,gif,png等格式的图片！";
    }
    ?>
    <input type="hidden" name="biyan_photo" value="<?php echo $name_file;?>">
    <?php
}
?>
<br><label >闭眼视频文件:</label>
<?php
//获取闭眼视频文件
if(is_uploaded_file($_FILES['biyan_video']['tmp_name'])){
    $biyan_video=$_FILES["biyan_video"];
    //获取数组里面的值
    $biyan_v_name=$biyan_video["name"];//上传文件的文件名
    $name_file = $biyan_v_name ;
    $type=$biyan_video["type"];//上传文件的类型
    $size=$biyan_video["size"];//上传文件的大小
    $tmp_name=$biyan_video["tmp_name"];//上传文件的临时存放路径
    /**
     * 0:文件上传成功<br/>
     * 1：超过了文件大小，在php.ini文件中设置<br/>
     * 2：超过了文件的大小MAX_FILE_SIZE选项指定的值<br/>
     * 3：文件只有部分被上传<br/>
     * 4：没有文件被上传<br/>
     * 5：上传文件大小为0
     */
    $error=$biyan_video["error"];//上传后系统返回的值
    $newname = iconv('utf-8','gb2312',$biyan_v_name);
    $newbname_1 = iconv('utf-8','gb2312','upload/'.$contents_name.'/'.$biyan_v_name);
    move_uploaded_file($tmp_name,$newbname_1);
    //echo "<img src=".$destination.">";
    echo "<a href='upload/$contents_name/$name_file' target='_blank'>$name_file</a><br>";
    //echo " alt=\"图片预览:\r文件名:".$destination."\r上传时间:\">";
?>
<input type="hidden" name="biyan_video" value="<?php echo $name_file;?>">
<?php
}
?>

<br><label >耸鼻:</label>
<label style="padding-left:41px;">鼻唇沟异常程度:</label>
<?php
//耸鼻
$contents_songbi = $_POST['songbi'];
if($contents_songbi==0){
    echo "正常<br>";
}else if($contents_songbi==1){
    echo "轻度<br>";
}else if($contents_songbi==2){
    echo "中度<br>";
}else{
    echo "重度<br>";
}
?>
<input type="hidden" name="songbi" value="<?php echo $contents_songbi;?>">
<label >耸鼻图片文件:</label>
<?php
//获取耸鼻图片文件
if(is_uploaded_file($_FILES['songbi_photo']['tmp_name'])){
    $songbi_photo=$_FILES["songbi_photo"];
    //获取数组里面的值
    $songbi_p_name=$songbi_photo["name"];//上传文件的文件名
    $name_file = $songbi_p_name ;
    $type=$songbi_photo["type"];//上传文件的类型
    $size=$songbi_photo["size"];//上传文件的大小
    $tmp_name=$songbi_photo["tmp_name"];//上传文件的临时存放路径
    //判断是否为图片
    switch ($type){
        case 'image/pjpeg':$okType=true;
        break;
        case 'image/jpeg':$okType=true;
        break;
        case 'image/gif':$okType=true;
        break;
        case 'image/png':$okType=true;
        break;
    }
    if($okType == null){
        $okType = true;
    }
    if($okType){
        /**
         * 0:文件上传成功<br/>
         * 1：超过了文件大小，在php.ini文件中设置<br/>
         * 2：超过了文件的大小MAX_FILE_SIZE选项指定的值<br/>
         * 3：文件只有部分被上传<br/>
         * 4：没有文件被上传<br/>
         * 5：上传文件大小为0
         */
        $error=$songbi_photo["error"];//上传后系统返回的值
        $newname = iconv('utf-8','gb2312',$songbi_p_name);
        $newbname_1 = iconv('utf-8','gb2312','upload/'.$contents_name.'/'.$songbi_p_name);
        move_uploaded_file($tmp_name,$newbname_1);
        if($error==0){
            //echo "文件上传成功啦！";
            //echo "<img src=".$destination.">";
            echo "<a href='upload/$contents_name/$name_file' target='_blank'>$name_file</a>";
            //echo " alt=\"图片预览:\r文件名:".$destination."\r上传时间:\">";
        }elseif ($error==1){
            echo "超过了文件大小，在php.ini文件中设置";
        }elseif ($error==2){
            echo "超过了文件的大小MAX_FILE_SIZE选项指定的值";
        }elseif ($error==3){
            echo "文件只有部分被上传";
        }elseif ($error==4){
            echo "没有文件被上传";
        }else{
            echo "上传文件大小为0";
        }
    }else{
        echo "请上传jpg,gif,png等格式的图片！";
    }
    ?>
    <input type="hidden" name="songbi_photo" value="<?php echo $name_file;?>">
    <?php
}
?>
<br><label >耸鼻视频文件:</label>
<?php
//获取耸鼻视频文件
if(is_uploaded_file($_FILES['songbi_video']['tmp_name'])){
    $songbi_video=$_FILES["songbi_video"];
    //获取数组里面的值
    $songbi_v_name=$songbi_video["name"];//上传文件的文件名
    $name_file = $songbi_v_name ;
    $type=$songbi_video["type"];//上传文件的类型
    $size=$songbi_video["size"];//上传文件的大小
    $tmp_name=$songbi_video["tmp_name"];//上传文件的临时存放路径
    /**
     * 0:文件上传成功<br/>
     * 1：超过了文件大小，在php.ini文件中设置<br/>
     * 2：超过了文件的大小MAX_FILE_SIZE选项指定的值<br/>
     * 3：文件只有部分被上传<br/>
     * 4：没有文件被上传<br/>
     * 5：上传文件大小为0
     */
    $error=$songbi_video["error"];//上传后系统返回的值
    $newname = iconv('utf-8','gb2312',$songbi_v_name);
    $newbname_1 = iconv('utf-8','gb2312','upload/'.$contents_name.'/'.$songbi_v_name);
    move_uploaded_file($tmp_name,$newbname_1);
    //echo "<img src=".$destination.">";
    echo "<a href='upload/$contents_name/$name_file' target='_blank'>$name_file</a><br>";
    //echo " alt=\"图片预览:\r文件名:".$destination."\r上传时间:\">";
?>
<input type="hidden" name="songbi_video" value="<?php echo $name_file;?>">
<?php
}
?>

<br><label >微笑:</label>
<label style="padding-left:41px;">口角歪斜的异常程度:</label>
<?php
//微笑
$contents_weixiao = $_POST['weixiao'];
if($contents_weixiao==0){
    echo "正常<br>";
}else if($contents_weixiao==1){
    echo "轻度<br>";
}else if($contents_weixiao==2){
    echo "中度<br>";
}else{
    echo "重度<br>";
}
?>
<input type="hidden" name="weixiao" value="<?php echo $contents_weixiao;?>">
<label >微笑图片文件:</label>
<?php
//获取微笑图片文件
if(is_uploaded_file($_FILES['weixiao_photo']['tmp_name'])){
    $weixiao_photo=$_FILES["weixiao_photo"];
    //获取数组里面的值
    $weixiao_p_name=$weixiao_photo["name"];//上传文件的文件名
    $name_file = $weixiao_p_name ;
    $type=$weixiao_photo["type"];//上传文件的类型
    $size=$weixiao_photo["size"];//上传文件的大小
    $tmp_name=$weixiao_photo["tmp_name"];//上传文件的临时存放路径
    //判断是否为图片
    switch ($type){
        case 'image/pjpeg':$okType=true;
        break;
        case 'image/jpeg':$okType=true;
        break;
        case 'image/gif':$okType=true;
        break;
        case 'image/png':$okType=true;
        break;
    }
    if($okType == null){
        $okType = true;
    }
    if($okType){
        /**
         * 0:文件上传成功<br/>
         * 1：超过了文件大小，在php.ini文件中设置<br/>
         * 2：超过了文件的大小MAX_FILE_SIZE选项指定的值<br/>
         * 3：文件只有部分被上传<br/>
         * 4：没有文件被上传<br/>
         * 5：上传文件大小为0
         */
        $error=$weixiao_photo["error"];//上传后系统返回的值
        $newname = iconv('utf-8','gb2312',$weixiao_p_name);
        $newbname_1 = iconv('utf-8','gb2312','upload/'.$contents_name.'/'.$weixiao_p_name);
        move_uploaded_file($tmp_name,$newbname_1);
        if($error==0){
            // echo "文件上传成功啦！";
            //echo "<img src=".$destination.">";
            echo "<a href='upload/$contents_name/$name_file' target='_blank'>$name_file</a>";
            //echo " alt=\"图片预览:\r文件名:".$destination."\r上传时间:\">";
        }elseif ($error==1){
            echo "超过了文件大小，在php.ini文件中设置";
        }elseif ($error==2){
            echo "超过了文件的大小MAX_FILE_SIZE选项指定的值";
        }elseif ($error==3){
            echo "文件只有部分被上传";
        }elseif ($error==4){
            echo "没有文件被上传";
        }else{
            echo "上传文件大小为0";
        }
    }else{
        echo "请上传jpg,gif,png等格式的图片！";
    }
    ?>
    <input type="hidden" name="weixiao_photo" value="<?php echo $name_file;?>">
    <?php
}
?>
<br><label >微笑视频文件:</label>
<?php
//获取微笑视频文件
if(is_uploaded_file($_FILES['weixiao_video']['tmp_name'])){
    $weixiao_video=$_FILES["weixiao_video"];
    //获取数组里面的值
    $weixiao_v_name=$weixiao_video["name"];//上传文件的文件名
    $name_file = $weixiao_v_name ;
    $type=$weixiao_video["type"];//上传文件的类型
    $size=$weixiao_video["size"];//上传文件的大小
    $tmp_name=$weixiao_video["tmp_name"];//上传文件的临时存放路径
    /**
     * 0:文件上传成功<br/>
     * 1：超过了文件大小，在php.ini文件中设置<br/>
     * 2：超过了文件的大小MAX_FILE_SIZE选项指定的值<br/>
     * 3：文件只有部分被上传<br/>
     * 4：没有文件被上传<br/>
     * 5：上传文件大小为0
     */
    $error=$weixiao_video["error"];//上传后系统返回的值
    $newname = iconv('utf-8','gb2312',$weixiao_v_name);
    $newbname_1 = iconv('utf-8','gb2312','upload/'.$contents_name.'/'.$weixiao_v_name);
    move_uploaded_file($tmp_name,$newbname_1);
    //echo "<img src=".$destination.">";
    echo "<a href='upload/$contents_name/$name_file' target='_blank'>$name_file</a><br>";
    //echo " alt=\"图片预览:\r文件名:".$destination."\r上传时间:\">";
    ?>
    <input type="hidden" name="weixiao_video" value="<?php echo $name_file;?>">
    <?php
}
?>

<br><label >示齿:</label>
<label style="padding-left:41px;">口角歪斜的异常程度:</label>
<?php
//示齿
$contents_shichi = $_POST['shichi'];
if($contents_shichi==0){
    echo "正常<br>";
}else if($contents_shichi==1){
    echo "轻度<br>";
}else if($contents_shichi==2){
    echo "中度<br>";
}else{
    echo "重度<br>";
}
?>
<input type="hidden" name="shichi" value="<?php echo $contents_shichi;?>">
<label >示齿图片文件:</label>
<?php
//获取示齿图片文件
if(is_uploaded_file($_FILES['shichi_photo']['tmp_name'])){
    $shichi_photo=$_FILES["shichi_photo"];
    //获取数组里面的值
    $shichi_p_name=$shichi_photo["name"];//上传文件的文件名
    $name_file = $shichi_p_name ;
    $type=$shichi_photo["type"];//上传文件的类型
    $size=$shichi_photo["size"];//上传文件的大小
    $tmp_name=$shichi_photo["tmp_name"];//上传文件的临时存放路径
    //判断是否为图片
    switch ($type){
        case 'image/pjpeg':$okType=true;
        break;
        case 'image/jpeg':$okType=true;
        break;
        case 'image/gif':$okType=true;
        break;
        case 'image/png':$okType=true;
        break;
    }
    if($okType == null){
        $okType = true;
    }
    if($okType){
        /**
         * 0:文件上传成功<br/>
         * 1：超过了文件大小，在php.ini文件中设置<br/>
         * 2：超过了文件的大小MAX_FILE_SIZE选项指定的值<br/>
         * 3：文件只有部分被上传<br/>
         * 4：没有文件被上传<br/>
         * 5：上传文件大小为0
         */
        $error=$shichi_photo["error"];//上传后系统返回的值
        $newname = iconv('utf-8','gb2312',$shichi_p_name);
        $newbname_1 = iconv('utf-8','gb2312','upload/'.$contents_name.'/'.$shichi_p_name);
        move_uploaded_file($tmp_name,$newbname_1);
        if($error==0){
            //echo "文件上传成功啦！";
            //echo "<img src=".$destination.">";
            echo "<a href='upload/$contents_name/$name_file' target='_blank'>$name_file</a>";
            //echo " alt=\"图片预览:\r文件名:".$destination."\r上传时间:\">";
        }elseif ($error==1){
            echo "超过了文件大小，在php.ini文件中设置";
        }elseif ($error==2){
            echo "超过了文件的大小MAX_FILE_SIZE选项指定的值";
        }elseif ($error==3){
            echo "文件只有部分被上传";
        }elseif ($error==4){
            echo "没有文件被上传";
        }else{
            echo "上传文件大小为0";
        }
    }else{
        echo "请上传jpg,gif,png等格式的图片！";
    }
    ?>
    <input type="hidden" name="shichi_photo" value="<?php echo $name_file;?>">
    <?php
}
?>
<br><label >示齿视频文件:</label>
<?php
//获取示齿视频文件
if(is_uploaded_file($_FILES['shichi_video']['tmp_name'])){
    $shichi_video=$_FILES["shichi_video"];
    //获取数组里面的值
    $shichi_v_name=$shichi_video["name"];//上传文件的文件名
    $name_file = $shichi_v_name ;
    $type=$shichi_video["type"];//上传文件的类型
    $size=$shichi_video["size"];//上传文件的大小
    $tmp_name=$shichi_video["tmp_name"];//上传文件的临时存放路径
    /**
     * 0:文件上传成功<br/>
     * 1：超过了文件大小，在php.ini文件中设置<br/>
     * 2：超过了文件的大小MAX_FILE_SIZE选项指定的值<br/>
     * 3：文件只有部分被上传<br/>
     * 4：没有文件被上传<br/>
     * 5：上传文件大小为0
     */
    $error=$shichi_video["error"];//上传后系统返回的值
    $newname = iconv('utf-8','gb2312',$shichi_v_name);
    $newbname_1 = iconv('utf-8','gb2312','upload/'.$contents_name.'/'.$shichi_v_name);
    move_uploaded_file($tmp_name,$newbname_1);
    //echo "<img src=".$destination.">";
    echo "<a href='upload/$contents_name/$name_file' target='_blank'>$name_file</a><br>";
    //echo " alt=\"图片预览:\r文件名:".$destination."\r上传时间:\">";
    ?>
    <input type="hidden" name="shichi_video" value="<?php echo $name_file;?>">
    <?php
}
?>

<br><label >鼓腮:</label>
<?php
//鼓腮
$contents_gusai1 = $_POST['gusai1'];
$contents_gusai2 = $_POST['gusai2'];
$contents_gusai = $contents_gusai1.$contents_gusai2;
?>
<label style="padding-left:41px;">鼓腮漏气的情况:</label>
<?php
if($contents_gusai1==0){
    echo "正常<br>";
}else if($contents_gusai1==1){
    echo "轻度<br>";
}else if($contents_gusai1==2){
    echo "中度<br>";
}else{
    echo "重度<br>";
}
?>
<label style="padding-left:81px;">口角歪斜的程度:</label>
<?php
if($contents_gusai2==0){
    echo "正常<br>";
}else if($contents_gusai2==1){
    echo "轻度<br>";
}else if($contents_gusai2==2){
    echo "中度<br>";
}else{
    echo "重度<br>";
}
?>
<input type="hidden" name="gusai" value="<?php echo $contents_gusai;?>">
<label >鼓腮图片文件:</label>
<?php
//获取鼓腮图片文件
if(is_uploaded_file($_FILES['gusai_photo']['tmp_name'])){
    $gusai_photo=$_FILES["gusai_photo"];
    //获取数组里面的值
    $gusai_p_name=$gusai_photo["name"];//上传文件的文件名
    $name_file = $gusai_p_name ;
    $type=$gusai_photo["type"];//上传文件的类型
    $size=$gusai_photo["size"];//上传文件的大小
    $tmp_name=$gusai_photo["tmp_name"];//上传文件的临时存放路径
    //判断是否为图片
    switch ($type){
        case 'image/pjpeg':$okType=true;
        break;
        case 'image/jpeg':$okType=true;
        break;
        case 'image/gif':$okType=true;
        break;
        case 'image/png':$okType=true;
        break;
    }
    if($okType == null){
        $okType = true;
    }
    if($okType){
        /**
         * 0:文件上传成功<br/>
         * 1：超过了文件大小，在php.ini文件中设置<br/>
         * 2：超过了文件的大小MAX_FILE_SIZE选项指定的值<br/>
         * 3：文件只有部分被上传<br/>
         * 4：没有文件被上传<br/>
         * 5：上传文件大小为0
         */
        $error=$gusai_photo["error"];//上传后系统返回的值
        $newname = iconv('utf-8','gb2312',$gusai_p_name);
        $newbname_1 = iconv('utf-8','gb2312','upload/'.$contents_name.'/'.$gusai_p_name);
        move_uploaded_file($tmp_name,$newbname_1);
        if($error==0){
            //echo "文件上传成功啦！";
            //echo "<img src=".$destination.">";
            echo "<a href='upload/$contents_name/$name_file' target='_blank'>$name_file</a>";
            //echo " alt=\"图片预览:\r文件名:".$destination."\r上传时间:\">";
        }elseif ($error==1){
            echo "超过了文件大小，在php.ini文件中设置";
        }elseif ($error==2){
            echo "超过了文件的大小MAX_FILE_SIZE选项指定的值";
        }elseif ($error==3){
            echo "文件只有部分被上传";
        }elseif ($error==4){
            echo "没有文件被上传";
        }else{
            echo "上传文件大小为0";
        }
    }else{
        echo "请上传jpg,gif,png等格式的图片！";
    }
    ?>
    <input type="hidden" name="gusai_photo" value="<?php echo $name_file;?>">
    <?php
}
?>
<br><label >鼓腮视频文件:</label>
<?php
//获取鼓腮视频文件
if(is_uploaded_file($_FILES['gusai_video']['tmp_name'])){
    $gusai_video=$_FILES["gusai_video"];
    //获取数组里面的值
    $gusai_v_name=$gusai_video["name"];//上传文件的文件名
    $name_file = $gusai_v_name ;
    $type=$gusai_video["type"];//上传文件的类型
    $size=$gusai_video["size"];//上传文件的大小
    $tmp_name=$gusai_video["tmp_name"];//上传文件的临时存放路径
    /**
     * 0:文件上传成功<br/>
     * 1：超过了文件大小，在php.ini文件中设置<br/>
     * 2：超过了文件的大小MAX_FILE_SIZE选项指定的值<br/>
     * 3：文件只有部分被上传<br/>
     * 4：没有文件被上传<br/>
     * 5：上传文件大小为0
     */
    $error=$gusai_video["error"];//上传后系统返回的值
    $newname = iconv('utf-8','gb2312',$gusai_v_name);
    $newbname_1 = iconv('utf-8','gb2312','upload/'.$contents_name.'/'.$gusai_v_name);
    move_uploaded_file($tmp_name,$newbname_1);
    //echo "<img src=".$destination.">";
    echo "<a href='upload/$contents_name/$name_file' target='_blank'>$name_file</a><br>";
    //echo " alt=\"图片预览:\r文件名:".$destination."\r上传时间:\">";
    ?>
    <input type="hidden" name="gusai_video" value="<?php echo $name_file;?>">
    <?php
}
?>
<p><input type="hidden" name="action" value="add"><input type="submit" name="submit" value="确认" /></p>
</form>
<span><a href="javascript:history.back(-1);">返回上一步</a></span>
</body>
</html>