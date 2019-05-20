<?php
header("Content-Type: text/html; charset=UTF-8");
if(isset($_POST["submit"]) && $_POST["submit"] == "上传")
{
        $contents_name = $_POST['username'];
        if($contents_name == ''){
            echo "<script>alert('请输入患者姓名！'); history.go(-1);</script>";
            exit();
        }

        $sex = $_POST['usersex'];
        $age = $_POST['userage'];
        $is_normal = $_POST['is_normal'];
        if($age == ''){
            echo "<script>alert('病人年龄不能为空！'); history.go(-1);</script>";
            exit();
        }

        $patient=$_FILES["patient"];
        $patient_pv=$patient["name"];//上传文件的文件名
        $tmp_name=$patient["tmp_name"];//上传文件的临时存放路径
        $total = count($patient_pv);
        if($total != 15){
            echo "<script>alert('文件数不正确，请再次确认上传的文件！'); history.go(-1);</script>";
            exit();
        }

        for($i=0; $i<$total; $i++) {
            if(strcasecmp(substr($patient_pv[$i], -3),"jpg") != '0' ){
                if(strcasecmp(substr($patient_pv[$i], -3),"mp4") != '0'){
                    echo "<script>alert('".$patient_pv[$i]."文件格式不正确！'); history.go(-1);</script>";
                    exit();
                }
            }
        }

        //创建文件夹
        $counter = 0;
        while(true){
            //echo "asd=".var_dump(is_dir( iconv( 'UTF-8', 'GB18030', "../../upload/".$contents_name )))."=asd";
            if (is_dir( iconv( 'UTF-8', 'GB18030', "../../upload/".$contents_name ))) {
                ++$counter;
                if(strpos($contents_name,"_")){
                    $contents_name = substr($contents_name, 0, strrpos($contents_name, '_'));
                }
                $contents_name = $contents_name."_".$counter;
            }else{
                break;
            }
        }
        mkdir(iconv('utf-8', 'gb2312','../../upload/'.$contents_name ),777);

        //删除非空目录
        function d_rmdir($dirname) {
                if(!is_dir($dirname)) {
                    return false;
                }
                $handle = @opendir($dirname);
                while(($file = @readdir($handle)) !== false){
                    if($file != '.' && $file != '..'){
                        $dir = $dirname . '/' . $file;
                        is_dir($dir) ? d_rmdir($dir) : unlink($dir);
                    }
                }
                closedir($handle);
                return rmdir($dirname) ;
            }

        //转移文件
        for($i=0; $i<$total; $i++) {
            $newbname_1 = iconv('utf-8','gb2312','../../upload/'.$contents_name.'/'.$patient_pv[$i]);
            move_uploaded_file($tmp_name[$i],$newbname_1);
        }

        //哈希值
        function Hash_num($filename){
            list($width, $height) = getimagesize($filename);
            $img = imagecreatefromjpeg($filename);
            $new_img = imagecreatetruecolor(8, 8);
            imagecopyresampled($new_img, $img, 0, 0, 0, 0, 8, 8, $width, $height);
            imagefilter($new_img, IMG_FILTER_GRAYSCALE);
            $colors = array();
            $sum = 0;

            for ($i = 0; $i < 8; $i++) {
                for ($j = 0; $j < 8; $j++) {
                    $color = imagecolorat($new_img, $i, $j) & 0xff;
                    $sum += $color;
                    $colors[] = $color;
                }
            }

            $avg = $sum / 64;
            $hash = '';
            $curr = '';
            $count = 0;
            foreach ($colors as $color) {
                if ($color > $avg) {
                    $curr .= '1';
                } else {
                    $curr .= '0';
                }
                $count++;
                if (!($count % 4)) {
                    $hash .= dechex(bindec($curr));
                    $curr = '';
                }
            }
            unset($img);
            return $hash;
        }

        //echo Hash_num(iconv('utf-8','gb2312','../../upload/'.$contents_name.'/静态.jpg'))."<br>";

         // 连接数据库
         //$conn=mysql_connect("219.245.4.239","root","12345")  or die(mysql_error());
         $conn=mysql_connect("localhost","root","123456")  or die(mysql_error());
         mysql_select_db('lables',$conn) or die(mysql_error());
         mysql_query("set names utf8");

         $sql = "select t.name from upload_labler t";
         $result = mysql_query($sql);    //执行SQL语句
         $num = mysql_num_rows($result); //统计执行结果影响的行数
         while ($row = mysql_fetch_array($result)){
             if(Hash_num(iconv('utf-8','gb2312','../../upload/'.$row['name'].'/静态.jpg')) == Hash_num(iconv('utf-8','gb2312','../../upload/'.$contents_name.'/静态.jpg'))){
//                  $encode = mb_detect_encoding($contents_name, array("ASCII","UTF-8","GB2312","GBK","BIG5"));
//                  echo $encode;
                 d_rmdir(iconv('utf-8','gb2312','../../upload/'.$contents_name));
                 echo "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
                       <script>alert('该病人文件已存在，请重新选择！');history.go(-1);</script>";
                 exit();

            }
         }

         $sqlstr2 = "insert into photo_video(static_p,taimei_p,taimei_v,zhoumei_p,zhoumei_v,
                      biyan_p,biyan_v,songbi_p,songbi_v,weixiao_p,weixiao_v,shichi_p,shichi_v,gusai_p,gusai_v)
                      values('静态.jpg','抬眉.jpg','抬眉.mp4','皱眉.jpg','皱眉.mp4','闭眼.jpg','闭眼.mp4','耸鼻.jpg',
                      '耸鼻.mp4','微笑.jpg','微笑.mp4','示齿.jpg','示齿.mp4','鼓腮.jpg','鼓腮.mp4')";
         mysql_query($sqlstr2) or die(mysql_error());

         $getID=mysql_insert_id();

         $sqlstr3 = "insert into upload_labler(id,name,sex,age,labler,labler_count,is_normal) values('".$getID."','".$contents_name."','".$sex."','".$age."','','0','".$is_normal."')";
         mysql_query($sqlstr3) or die(mysql_error());

         mysql_close($conn);

         //上传成功
         echo "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
                              <script>alert('上传成功！');
                                 if(confirm('是否继续上传？')){
                                     window.location.href='../patient/up_picv.php';
                                   }else{
                                     window.location.href='../user/User.php';
                                   }</script>";

}


//单个上传（备用！）
// if(isset($_POST["submit"]) && $_POST["submit"] == "上传")
// {
//     //判断姓名是否为空
//     $contents_name = $_POST['username'];
//     if($contents_name == ''){
//         echo "<script>alert('请输入患者姓名！'); history.go(-1);</script>";
//         exit();
//     }

//     //判断static是否为空
//     if(is_uploaded_file($_FILES['static_photo']['tmp_name'])){
//         $static_photo=$_FILES["static_photo"];
//         $static_name=$static_photo["name"];//上传文件的文件名
//         $type=$static_photo["type"];//上传文件的类型
//         if(substr($static_name, 0, strrpos($static_name, '.')) == '静态'){
//             $okType=false;
//             //判断是否为图片
//             switch ($type){
//                 case 'image/pjpeg':$okType=true;
//                 break;
//                 case 'image/jpeg':$okType=true;
//                 break;
//                 case 'image/gif':$okType=true;
//                 break;
//                 case 'image/png':$okType=true;
//                 break;
//             }
//             if($okType == false){
//                 echo "<script>alert('静态图片格式错误！'); history.go(-1);</script>";
//                 exit();
//             }
//         }else{
//             echo "<script>alert('上传的静态图片名字有误！'); history.go(-1);</script>";
//             exit();
//         }
//     }else{
//         echo "<script>alert('请上传静态图片！'); history.go(-1);</script>";
//         exit();
//     }

//     //判断抬眉图片是否为空
//     if(is_uploaded_file($_FILES['taimei_photo']['tmp_name'])){
//         $taimei_photo=$_FILES["taimei_photo"];
//         $taiemi_p_name=$taimei_photo["name"];//上传文件的文件名
//         $type=$taimei_photo["type"];//上传文件的类型
//         if(substr($taiemi_p_name, 0, strrpos($taiemi_p_name, '.')) == '抬眉'){
//             $okType=false;
//             //判断是否为图片
//             switch ($type){
//                 case 'image/pjpeg':$okType=true;
//                 break;
//                 case 'image/jpeg':$okType=true;
//                 break;
//                 case 'image/gif':$okType=true;
//                 break;
//                 case 'image/png':$okType=true;
//                 break;
//                 case 'image/jpg':$okType=true;
//                 break;
//             }
//             if($okType == false){
//                 echo "<script>alert('抬眉图片文件格式错误！'); history.go(-1);</script>";
//                 exit();
//             }
//         }else{
//             echo "<script>alert('上传的抬眉图片文件名字有误！'); history.go(-1);</script>";
//             exit();
//         }
//     }else{
//         echo "<script>alert('请上传抬眉图片文件！'); history.go(-1); </script>";
//         exit();
//     }
//     //判断抬眉视频是否为空
//     if(is_uploaded_file($_FILES['taimei_video']['tmp_name'])){
//         $taimei_video=$_FILES["taimei_video"];
//         $taimei_v_name=$taimei_video["name"];//上传文件的文件名
//         $type=$taimei_video["type"];//上传文件的类型
//         if(substr($taimei_v_name, 0, strrpos($taimei_v_name, '.')) == '抬眉'){
//             $okType=false;
//             switch ($type){
//                 case 'video/mp4':$okType=true;
//                 break;
//                 case 'video/mov':$okType=true;
//                 break;
//             }
//             if($okType == false){
//                 echo "<script>alert('抬眉视频文件格式错误！'); history.go(-1);</script>";
//                 exit();
//             }
//         }else{
//             echo "<script>alert('上传的抬眉视频文件名字有误！'); history.go(-1);</script>";
//             exit();
//         }
//     }else{
//         echo "<script>alert('请上传抬眉视频文件！'); history.go(-1); </script>";
//         exit();
//     }

//     //判断皱眉图片是否为空
//     if(is_uploaded_file($_FILES['zhoumei_photo']['tmp_name'])){
//         $zhoumei_photo=$_FILES["zhoumei_photo"];
//         $zhoumei_p_name=$zhoumei_photo["name"];//上传文件的文件名
//         $type=$zhoumei_photo["type"];//上传文件的类型
//         if(substr($zhoumei_p_name, 0, strrpos($zhoumei_p_name, '.')) == '皱眉'){
//             $okType=false;
//             switch ($type){
//                 case 'image/pjpeg':$okType=true;
//                 break;
//                 case 'image/jpeg':$okType=true;
//                 break;
//                 case 'image/gif':$okType=true;
//                 break;
//                 case 'image/png':$okType=true;
//                 break;
//             }
//             if($okType == false){
//                 echo "<script>alert('皱眉图片文件格式错误！'); history.go(-1);</script>";
//                 exit();
//             }
//         }else{
//             echo "<script>alert('上传的皱眉图片文件名字有误！'); history.go(-1);</script>";
//             exit();
//         }
//     }else{
//         echo "<script>alert('请上传皱眉图片文件！'); history.go(-1); </script>";
//         exit();
//     }
//     //判断皱眉视频是否为空
//     if(is_uploaded_file($_FILES['zhoumei_video']['tmp_name'])){
//         $zhoumei_video=$_FILES["zhoumei_video"];
//         $zhoumei_v_name=$zhoumei_video["name"];//上传文件的文件名
//         $type=$zhoumei_video["type"];//上传文件的类型
//         if(substr($zhoumei_v_name, 0, strrpos($zhoumei_v_name, '.')) == '皱眉'){
//             $okType=false;
//             switch ($type){
//                 case 'video/mp4':$okType=true;
//                 break;
//                 case 'video/mov':$okType=true;
//                 break;
//             }
//             if($okType == false){
//                 echo "<script>alert('皱眉视频文件格式错误！'); history.go(-1);</script>";
//                 exit();
//             }
//         }else{
//             echo "<script>alert('上传的皱眉视频文件名字有误！'); history.go(-1);</script>";
//             exit();
//         }
//     }else{
//         echo "<script>alert('请上传皱眉视频文件！'); history.go(-1); </script>";
//         exit();
//     }

//     //判断闭眼图片是否为空
//     if(is_uploaded_file($_FILES['biyan_photo']['tmp_name'])){
//         $biyan_photo=$_FILES["biyan_photo"];
//         $biyan_p_name=$biyan_photo["name"];//上传文件的文件名
//         $type=$biyan_photo["type"];//上传文件的类型
//         $tmp_name=$biyan_photo["tmp_name"];//上传文件的临时存放路径
//         if(substr($biyan_p_name, 0, strrpos($biyan_p_name, '.')) == '闭眼'){
//             $okType=false;
//             //判断是否为图片
//             switch ($type){
//                 case 'image/pjpeg':$okType=true;
//                 break;
//                 case 'image/jpeg':$okType=true;
//                 break;
//                 case 'image/gif':$okType=true;
//                 break;
//                 case 'image/png':$okType=true;
//                 break;
//             }
//             if($okType == false){
//                 echo "<script>alert('闭眼图片文件格式错误！'); history.go(-1);</script>";
//                 exit();
//             }
//         }else{
//             echo "<script>alert('上传的闭眼图片文件名字有误！'); history.go(-1);</script>";
//             exit();
//         }
//     }else{
//         echo "<script>alert('请上闭眼眉图片文件！'); history.go(-1); </script>";
//         exit();
//     }
//     //判断闭眼视频是否为空
//     if(is_uploaded_file($_FILES['biyan_video']['tmp_name'])){
//         $biyan_video=$_FILES["biyan_video"];
//         $biyan_v_name=$biyan_video["name"];//上传文件的文件名
//         $type=$biyan_video["type"];//上传文件的类型
//         $tmp_name=$biyan_video["tmp_name"];//上传文件的临时存放路径
//         if(substr($biyan_v_name, 0, strrpos($biyan_v_name, '.')) == '闭眼'){
//             $okType=false;
//             switch ($type){
//                 case 'video/mp4':$okType=true;
//                 break;
//                 case 'video/mov':$okType=true;
//                 break;
//             }
//             if($okType == false){
//                 echo "<script>alert('闭眼视频文件格式错误！'); history.go(-1);</script>";
//                 exit();
//             }
//         }else{
//             echo "<script>alert('上传的闭眼视频文件名字有误！'); history.go(-1);</script>";
//             exit();
//         }
//     }else{
//         echo "<script>alert('请上传闭眼视频文件！'); history.go(-1); </script>";
//         exit();
//     }

//     //判断耸鼻图片是否为空
//     if(is_uploaded_file($_FILES['songbi_photo']['tmp_name'])){
//         $songbi_photo=$_FILES["songbi_photo"];
//         $songbi_p_name=$songbi_photo["name"];//上传文件的文件名
//         $type=$songbi_photo["type"];//上传文件的类型
//         if(substr($songbi_p_name, 0, strrpos($songbi_p_name, '.')) == '耸鼻'){
//             $okType=false;
//             //判断是否为图片
//             switch ($type){
//                 case 'image/pjpeg':$okType=true;
//                 break;
//                 case 'image/jpeg':$okType=true;
//                 break;
//                 case 'image/gif':$okType=true;
//                 break;
//                 case 'image/png':$okType=true;
//                 break;
//             }
//             if($okType == false){
//                 echo "<script>alert('耸鼻图片文件格式错误！'); history.go(-1);</script>";
//                 exit();
//             }
//         }else{
//             echo "<script>alert('上传的耸鼻图片文件名字有误！'); history.go(-1);</script>";
//             exit();
//         }
//     }else{
//         echo "<script>alert('请上传耸鼻图片文件！'); history.go(-1); </script>";
//         exit();
//     }
//     //判断耸鼻视频是否为空
//     if(is_uploaded_file($_FILES['songbi_video']['tmp_name'])){
//         $songbi_video=$_FILES["songbi_video"];
//         $songbi_v_name=$songbi_video["name"];//上传文件的文件名
//         $type=$songbi_video["type"];//上传文件的类型
//         if(substr($songbi_v_name, 0, strrpos($songbi_v_name, '.')) == '耸鼻'){
//             $okType=false;
//             switch ($type){
//                 case 'video/mp4':$okType=true;
//                 break;
//                 case 'video/mov':$okType=true;
//                 break;
//             }
//             if($okType == false){
//                 echo "<script>alert('耸鼻视频文件格式错误！'); history.go(-1);</script>";
//                 exit();
//             }
//         }else{
//             echo "<script>alert('上传的耸鼻视频文件名字有误！'); history.go(-1);</script>";
//             exit();
//         }
//     }else{
//         echo "<script>alert('请上传耸鼻视频文件！'); history.go(-1); </script>";
//         exit();
//     }

//     //判断微笑图片是否为空
//     if(is_uploaded_file($_FILES['weixiao_photo']['tmp_name'])){
//         $weixiao_photo=$_FILES["weixiao_photo"];
//         $weixiao_p_name=$weixiao_photo["name"];//上传文件的文件名
//         $type=$weixiao_photo["type"];//上传文件的类型
//         if(substr($weixiao_p_name, 0, strrpos($weixiao_p_name, '.')) == '微笑'){
//             $okType=false;
//             //判断是否为图片
//             switch ($type){
//                 case 'image/pjpeg':$okType=true;
//                 break;
//                 case 'image/jpeg':$okType=true;
//                 break;
//                 case 'image/gif':$okType=true;
//                 break;
//                 case 'image/png':$okType=true;
//                 break;
//             }
//             if($okType == false){
//                 echo "<script>alert('微笑图片文件格式错误！'); history.go(-1);</script>";
//                 exit();
//             }
//         }else{
//             echo "<script>alert('上传的微笑图片文件名字有误！'); history.go(-1);</script>";
//             exit();
//         }
//     }else{
//         echo "<script>alert('请上微笑眉图片文件！'); history.go(-1); </script>";
//         exit();
//     }
//     //判断微笑视频是否为空
//     if(is_uploaded_file($_FILES['weixiao_video']['tmp_name'])){
//         $weixiao_video=$_FILES["weixiao_video"];
//         $weixiao_v_name=$weixiao_video["name"];//上传文件的文件名
//         $type=$weixiao_video["type"];//上传文件的类型
//         if(substr($weixiao_v_name, 0, strrpos($weixiao_v_name, '.')) == '微笑'){
//             $okType=false;
//             switch ($type){
//                 case 'video/mp4':$okType=true;
//                 break;
//                 case 'video/mov':$okType=true;
//                 break;
//             }
//             if($okType == false){
//                 echo "<script>alert('微笑视频文件格式错误！'); history.go(-1);</script>";
//                 exit();
//             }
//         }else{
//             echo "<script>alert('上传的微笑视频文件名字有误！'); history.go(-1);</script>";
//             exit();
//         }
//     }else{
//         echo "<script>alert('请上传微笑视频文件！'); history.go(-1); </script>";
//         exit();
//     }

//     //判断示齿图片是否为空
//     if(is_uploaded_file($_FILES['shichi_photo']['tmp_name'])){
//         $shichi_photo=$_FILES["shichi_photo"];
//         $shichi_p_name=$shichi_photo["name"];//上传文件的文件名
//         $type=$shichi_photo["type"];//上传文件的类型
//         if(substr($shichi_p_name, 0, strrpos($shichi_p_name, '.')) == '示齿'){
//             $okType=false;
//             //判断是否为图片
//             switch ($type){
//                 case 'image/pjpeg':$okType=true;
//                 break;
//                 case 'image/jpeg':$okType=true;
//                 break;
//                 case 'image/gif':$okType=true;
//                 break;
//                 case 'image/png':$okType=true;
//                 break;
//             }
//             if($okType == false){
//                 echo "<script>alert('示齿图片文件格式错误！'); history.go(-1);</script>";
//                 exit();
//             }
//         }else{
//             echo "<script>alert('上传的示齿图片文件名字有误！'); history.go(-1);</script>";
//             exit();
//         }
//     }else{
//         echo "<script>alert('请上传示齿图片文件！'); history.go(-1); </script>";
//         exit();
//     }

//     //判断示齿视频是否为空
//     if(is_uploaded_file($_FILES['shichi_video']['tmp_name'])){
//         $shichi_video=$_FILES["shichi_video"];
//         $shichi_v_name=$shichi_video["name"];//上传文件的文件名
//         $type=$shichi_video["type"];//上传文件的类型
//         if(substr($shichi_v_name, 0, strrpos($shichi_v_name, '.')) == '示齿'){
//             $okType=false;
//             switch ($type){
//                 case 'video/mp4':$okType=true;
//                 break;
//                 case 'video/mov':$okType=true;
//                 break;
//             }
//             if($okType == false){
//                 echo "<script>alert('示齿视频文件格式错误！'); history.go(-1);</script>";
//                 exit();
//             }
//         }else{
//             echo "<script>alert('上传的示齿视频文件名字有误！'); history.go(-1);</script>";
//             exit();
//         }
//     }else{
//         echo "<script>alert('请上传示齿视频文件！'); history.go(-1); </script>";
//         exit();
//     }

//     //判断鼓腮图片是否为空
//     if(is_uploaded_file($_FILES['gusai_photo']['tmp_name'])){
//         $gusai_photo=$_FILES["gusai_photo"];
//         $gusai_p_name=$gusai_photo["name"];//上传文件的文件名
//         $type=$gusai_photo["type"];//上传文件的类型
//         if(substr($gusai_p_name, 0, strrpos($gusai_p_name, '.')) == '鼓腮'){
//             $okType=false;
//             //判断是否为图片
//             switch ($type){
//                 case 'image/pjpeg':$okType=true;
//                 break;
//                 case 'image/jpeg':$okType=true;
//                 break;
//                 case 'image/gif':$okType=true;
//                 break;
//                 case 'image/png':$okType=true;
//                 break;
//             }
//             if($okType == false){
//                 echo "<script>alert('鼓腮图片文件格式错误！'); history.go(-1);</script>";
//                 exit();
//             }
//         }else{
//             echo "<script>alert('上传的鼓腮图片文件名字有误！'); history.go(-1);</script>";
//             exit();
//         }
//     }else{
//         echo "<script>alert('请上传鼓腮图片文件！'); history.go(-1); </script>";
//         exit();
//     }
//     //判断鼓腮视频是否为空
//     if(is_uploaded_file($_FILES['gusai_video']['tmp_name'])){
//         $gusai_video=$_FILES["gusai_video"];
//         $gusai_v_name=$gusai_video["name"];//上传文件的文件名
//         $type=$gusai_video["type"];//上传文件的类型
//         if(substr($gusai_v_name, 0, strrpos($gusai_v_name, '.')) == '鼓腮'){
//             $okType=false;
//             switch ($type){
//                 case 'video/mp4':$okType=true;
//                 break;
//                 case 'video/mov':$okType=true;
//                 break;
//             }
//             if($okType == false){
//                 echo "<script>alert('抬眉视频文件格式错误！'); history.go(-1);</script>";
//                 exit();
//             }
//         }else{
//             echo "<script>alert('上传的鼓腮视频文件名字有误！'); history.go(-1);</script>";
//             exit();
//         }
//     }else{
//         echo "<script>alert('请上传鼓腮视频文件！'); history.go(-1); </script>";
//         exit();
//     }

//     //创建文件夹
//     $counter = 0;
//     while(true){
//         //echo "asd=".var_dump(is_dir( iconv( 'UTF-8', 'GB18030', "../../upload/".$contents_name )))."=asd";
//         if (is_dir( iconv( 'UTF-8', 'GB18030', "../../upload/".$contents_name ))) {
//             ++$counter;
//             if(strpos($contents_name,"_")){
//                 $contents_name = substr($contents_name, 0, strrpos($contents_name, '_'));
//             }
//             $contents_name = $contents_name."_".$counter;
//         }else{
//             break;
//         }
//     }
//     mkdir(iconv('utf-8', 'gb2312','../../upload/'.$contents_name ));

//     //传文件
//     //获取static图片文件
//     if(is_uploaded_file($_FILES['static_photo']['tmp_name'])){
//         $static_photo=$_FILES["static_photo"];
//         $static_name=$static_photo["name"];//上传文件的文件名
//         $tmp_name=$static_photo["tmp_name"];//上传文件的临时存放路径
//         $newbname_1 = iconv('utf-8','gb2312','../../upload/'.$contents_name.'/'.$static_name);
//         move_uploaded_file($tmp_name,$newbname_1);
//     }

//     //获取抬眉图片文件
//     if(is_uploaded_file($_FILES['taimei_photo']['tmp_name'])){
//         $taimei_photo=$_FILES["taimei_photo"];
//         $taiemi_p_name=$taimei_photo["name"];//上传文件的文件名
//         $tmp_name=$taimei_photo["tmp_name"];//上传文件的临时存放路径
//             $newbname_1 = iconv('utf-8','gb2312','../../upload/'.$contents_name.'/'.$taiemi_p_name);
//             move_uploaded_file($tmp_name,$newbname_1);
//     }
//     //获取抬眉视频文件
//     if(is_uploaded_file($_FILES['taimei_video']['tmp_name'])){
//         $taimei_video=$_FILES["taimei_video"];
//         $taimei_v_name=$taimei_video["name"];//上传文件的文件名
//         $tmp_name=$taimei_video["tmp_name"];//上传文件的临时存放路径
//         $newbname_1 = iconv('utf-8','gb2312','../../upload/'.$contents_name.'/'.$taimei_v_name);
//         move_uploaded_file($tmp_name,$newbname_1);
//     }

//      //获取皱眉图片文件
//      if(is_uploaded_file($_FILES['zhoumei_photo']['tmp_name'])){
//          $zhoumei_photo=$_FILES["zhoumei_photo"];
//          $zhoumei_p_name=$zhoumei_photo["name"];//上传文件的文件名
//          $tmp_name=$zhoumei_photo["tmp_name"];//上传文件的临时存放路径
//              $newbname_1 = iconv('utf-8','gb2312','../../upload/'.$contents_name.'/'.$zhoumei_p_name);
//              move_uploaded_file($tmp_name,$newbname_1);
//      }
//      //获取皱眉视频文件
//      if(is_uploaded_file($_FILES['zhoumei_video']['tmp_name'])){
//          $zhoumei_video=$_FILES["zhoumei_video"];
//          $zhoumei_v_name=$zhoumei_video["name"];//上传文件的文件名
//          $tmp_name=$zhoumei_video["tmp_name"];//上传文件的临时存放路径
//          $newbname_1 = iconv('utf-8','gb2312','../../upload/'.$contents_name.'/'.$zhoumei_v_name);
//          move_uploaded_file($tmp_name,$newbname_1);
//      }

//      //获取闭眼图片文件
//      if(is_uploaded_file($_FILES['biyan_photo']['tmp_name'])){
//          $biyan_photo=$_FILES["biyan_photo"];
//          $tmp_name=$biyan_photo["tmp_name"];//上传文件的临时存放路径
//          $biyan_p_name=$biyan_photo["name"];//上传文件的文件名
//              $newbname_1 = iconv('utf-8','gb2312','../../upload/'.$contents_name.'/'.$biyan_p_name);
//              move_uploaded_file($tmp_name,$newbname_1);
//      }
//      //获取闭眼视频文件
//      if(is_uploaded_file($_FILES['biyan_video']['tmp_name'])){
//          $biyan_video=$_FILES["biyan_video"];
//          $biyan_v_name=$biyan_video["name"];//上传文件的文件名
//          $tmp_name=$biyan_video["tmp_name"];//上传文件的临时存放路径
//          $newbname_1 = iconv('utf-8','gb2312','../../upload/'.$contents_name.'/'.$biyan_v_name);
//          move_uploaded_file($tmp_name,$newbname_1);
//      }

//      //获取耸鼻图片文件
//      if(is_uploaded_file($_FILES['songbi_photo']['tmp_name'])){
//          $songbi_photo=$_FILES["songbi_photo"];
//          $songbi_p_name=$songbi_photo["name"];//上传文件的文件名
//          $tmp_name=$songbi_photo["tmp_name"];//上传文件的临时存放路径
//          $newbname_1 = iconv('utf-8','gb2312','../../upload/'.$contents_name.'/'.$songbi_p_name);
//          move_uploaded_file($tmp_name,$newbname_1);
//      }
//      //获取耸鼻视频文件
//      if(is_uploaded_file($_FILES['songbi_video']['tmp_name'])){
//          $songbi_video=$_FILES["songbi_video"];
//          $songbi_v_name=$songbi_video["name"];//上传文件的文件名
//          $tmp_name=$songbi_video["tmp_name"];//上传文件的临时存放路径
//          $newbname_1 = iconv('utf-8','gb2312','../../upload/'.$contents_name.'/'.$songbi_v_name);
//          move_uploaded_file($tmp_name,$newbname_1);
//      }

//      //获取微笑图片文件
//      if(is_uploaded_file($_FILES['weixiao_photo']['tmp_name'])){
//          $weixiao_photo=$_FILES["weixiao_photo"];
//          $weixiao_p_name=$weixiao_photo["name"];//上传文件的文件名
//          $tmp_name=$weixiao_photo["tmp_name"];//上传文件的临时存放路径
//              $newbname_1 = iconv('utf-8','gb2312','../../upload/'.$contents_name.'/'.$weixiao_p_name);
//              move_uploaded_file($tmp_name,$newbname_1);
//      }
//      //获取微笑视频文件
//      if(is_uploaded_file($_FILES['weixiao_video']['tmp_name'])){
//          $weixiao_video=$_FILES["weixiao_video"];
//          $weixiao_v_name=$weixiao_video["name"];//上传文件的文件名
//          $tmp_name=$weixiao_video["tmp_name"];//上传文件的临时存放路径
//          $newbname_1 = iconv('utf-8','gb2312','../../upload/'.$contents_name.'/'.$weixiao_v_name);
//          move_uploaded_file($tmp_name,$newbname_1);
//      }

//      //获取示齿图片文件
//      if(is_uploaded_file($_FILES['shichi_photo']['tmp_name'])){
//          $shichi_photo=$_FILES["shichi_photo"];
//          $shichi_p_name=$shichi_photo["name"];//上传文件的文件名
//          $tmp_name=$shichi_photo["tmp_name"];//上传文件的临时存放路径
//              $newbname_1 = iconv('utf-8','gb2312','../../upload/'.$contents_name.'/'.$shichi_p_name);
//              move_uploaded_file($tmp_name,$newbname_1);
//      }
//      //获取示齿视频文件
//      if(is_uploaded_file($_FILES['shichi_video']['tmp_name'])){
//          $shichi_video=$_FILES["shichi_video"];
//          $shichi_v_name=$shichi_video["name"];//上传文件的文件名
//          $tmp_name=$shichi_video["tmp_name"];//上传文件的临时存放路径
//          $newbname_1 = iconv('utf-8','gb2312','../../upload/'.$contents_name.'/'.$shichi_v_name);
//          move_uploaded_file($tmp_name,$newbname_1);
//      }

//      //获取鼓腮图片文件
//      if(is_uploaded_file($_FILES['gusai_photo']['tmp_name'])){
//          $gusai_photo=$_FILES["gusai_photo"];
//          $gusai_p_name=$gusai_photo["name"];//上传文件的文件名
//          $tmp_name=$gusai_photo["tmp_name"];//上传文件的临时存放路径
//              $newbname_1 = iconv('utf-8','gb2312','../../upload/'.$contents_name.'/'.$gusai_p_name);
//              move_uploaded_file($tmp_name,$newbname_1);
//      }
//      //获取鼓腮视频文件
//      if(is_uploaded_file($_FILES['gusai_video']['tmp_name'])){
//          $gusai_video=$_FILES["gusai_video"];
//          $gusai_v_name=$gusai_video["name"];//上传文件的文件名
//          $tmp_name=$gusai_video["tmp_name"];//上传文件的临时存放路径
//          $newbname_1 = iconv('utf-8','gb2312','../../upload/'.$contents_name.'/'.$gusai_v_name);
//          move_uploaded_file($tmp_name,$newbname_1);
//      }

//      // 连接数据库
//      //$conn=mysql_connect("219.245.4.239","root","12345")  or die(mysql_error());
//      $conn=mysql_connect("localhost","root","123456")  or die(mysql_error());
//      mysql_select_db('lables',$conn) or die(mysql_error());
//      mysql_query("set names utf8");
//      $sqlstr1 = "insert into uploads(username,userstatic,usertaimei,
//                   userzhoumei,userbiyan,usersongbi,userweixiao,usershichi,usergusai)
//                   values('".$contents_name."','".$contents_static."','".$contents_taimei.
//                   "','".$contents_zhoumei."','".$contents_biyan."','".$contents_songbi."','".
//                   $contents_weixiao."','".$contents_shichi."','".$contents_gusai."')";
//      mysql_query($sqlstr1) or die(mysql_error());
//      $getID=mysql_insert_id();
//      $sqlstr2 = "insert into photo_video(id,static_p,taimei_p,taimei_v,zhoumei_p,zhoumei_v,
//                   biyan_p,biyan_v,songbi_p,songbi_v,weixiao_p,weixiao_v,shichi_p,shichi_v,gusai_p,gusai_v)
//                   values('".$getID."','".$static_name."','".$taiemi_p_name.
//                   "','".$taimei_v_name."','".$zhoumei_p_name."','".$zhoumei_v_name."','".
//                   $biyan_p_name."','".$biyan_v_name."','".$songbi_p_name."','".$songbi_v_name.
//                   "','".$weixiao_p_name."','".$weixiao_v_name."','".$shichi_p_name."','".$shichi_v_name.
//                   "','".$gusai_p_name."','".$gusai_v_name."')";
//      mysql_query($sqlstr2) or die(mysql_error());
//      mysql_close($conn);

//      //上传成功
//      echo "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
//                           <script>alert('上传成功！'); window.location.href='../user/User.php';</script>";
//}
?>