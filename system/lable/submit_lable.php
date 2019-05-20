<?php
if(isset($_POST["submit"]) && $_POST["submit"] == "提交")
{
    //静态标注
    $contents_static1 = $_POST['userstatic1'];
    $contents_static2 = $_POST['userstatic2'];
    $contents_static3 = $_POST['userstatic3'];
    $contents_static4 = $_POST['userstatic4'];
    $contents_static = $contents_static1.$contents_static2.$contents_static3.$contents_static4;
    //echo $contents_static."<br>";

    //抬眉标注
    $contents_taimei = $_POST['taimei'];
    //echo $contents_taimei."<br>";

    //皱眉标注
    $contents_zhoumei = $_POST['zhoumei'];
    //echo $contents_zhoumei."<br>";

    //闭眼
    $contents_biyan = $_POST['biyan'];
    //echo $contents_biyan."<br>";

    //耸鼻
    $contents_songbi = $_POST['songbi'];
    //echo $contents_songbi."<br>";

    //微笑
    $contents_weixiao = $_POST['weixiao'];
    //echo $contents_weixiao."<br>";

    //示齿
    $contents_shichi = $_POST['shichi'];
    //echo $contents_shichi."<br>";

    //鼓腮
    $contents_gusai1 = $_POST['gusai1'];
    $contents_gusai2 = $_POST['gusai2'];
    $contents_gusai = $contents_gusai1.$contents_gusai2;
    //echo $contents_gusai."<br>";

    //标注者
    @session_start();
    if (session_is_registered(login))
    {
        global $login;
        //echo $login['username']."<br>";
    }

    //userid
    $lable = $_POST['lable'];
    //echo $lable."<br>";

    //连接数据库
    //$conn=mysql_connect("219.245.4.239","root","12345")  or die(mysql_error());
    $conn=mysql_connect("localhost","root","123456")  or die(mysql_error());
    mysql_select_db('lables',$conn) or die(mysql_error());
    mysql_query("set names utf8");

    //select---查询已标注人数
    $sql1="select * from upload_labler where id='".$lable."'";
    $result1 = mysql_query($sql1);
    $row1 = mysql_fetch_array($result1);

    $sql3 = "select * from uploads where userid='".$lable."' and labler='".$login['username']."'";
    $result3 = mysql_query($sql3);
    $num = mysql_num_rows($result3);
    if($num == 2){
        $n=0;
        while($row3=mysql_fetch_array($result3)){
            $n++;
            if ($n>1){
                $sql4 = "update uploads set uploads.userstatic='".$contents_static."',uploads.usertaimei='".$contents_taimei."'
                       ,uploads.userzhoumei='".$contents_zhoumei."',uploads.userbiyan='".$contents_biyan."'
                       ,uploads.usersongbi='".$contents_songbi."',uploads.userweixiao='".$contents_weixiao."'
                       ,uploads.usershichi='".$contents_shichi."',uploads.usergusai='".$contents_gusai."'
                       where labler_id = '".$row3['labler_id']."'";
                $result4 = mysql_query($sql4);
                echo "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
                                              <script>alert('更新成功！'); window.location.href='../user/User.php';</script>";
                exit();
            }
        }
    }
    if($num == 1){
        if(strpos($row1['labler'], $login['username']) == false){
            $row3=mysql_fetch_array($result3);
            $sql5 = "update uploads set uploads.userstatic='".$contents_static."',uploads.usertaimei='".$contents_taimei."'
                       ,uploads.userzhoumei='".$contents_zhoumei."',uploads.userbiyan='".$contents_biyan."'
                       ,uploads.usersongbi='".$contents_songbi."',uploads.userweixiao='".$contents_weixiao."'
                       ,uploads.usershichi='".$contents_shichi."',uploads.usergusai='".$contents_gusai."'
                       where labler_id = '".$row3['labler_id']."'";
            $result5 = mysql_query($sql5);
            echo "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
                                              <script>alert('更新成功！'); window.location.href='../user/User.php';</script>";
            exit();
        }
    }

    //echo $row1['labler_count'];
    if($row1['labler_count'] == 0){
        $sql2 = "update upload_labler set upload_labler.labler='".$login['username']."'
                     ,upload_labler.labler_count='".($row1['labler_count']+1)."' where id ='".$lable."'";
        $result2 = mysql_query($sql2);
    }
    if($row1['labler_count'] > 0 && $row1['labler_count'] < 3){
        $sql2="update upload_labler set upload_labler.labler=CONCAT_WS(',',upload_labler.labler,'".$login['username']."')
                    ,upload_labler.labler_count='".($row1['labler_count']+1)."' where id ='".$lable."'";
        $result2 = mysql_query($sql2);
    }

    //insert
    $sql= "insert into uploads(userid,username,usersex,userage,is_normal,userstatic,usertaimei,
                      userzhoumei,userbiyan,usersongbi,userweixiao,usershichi,usergusai,labler)
                      values('".$lable."','".$row1['name']."','".$row1['sex']."','".$row1['age']."','".$row1['is_normal']."','".$contents_static."','".$contents_taimei."'
                      ,'".$contents_zhoumei."','".$contents_biyan."','".$contents_songbi."','".$contents_weixiao."'
                      ,'".$contents_shichi."','".$contents_gusai."','".$login['username']."')";
    mysql_query($sql) or die(mysql_error());
    //$getID=mysql_insert_id();
    mysql_close($conn);
    echo "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
                          <script>alert('标注成功！'); window.location.href='../user/User.php';</script>";
    }
?>