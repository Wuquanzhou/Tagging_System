<?php
header("Content-Type: text/html; charset=utf-8");
if(is_uploaded_file($_FILES['zip_file']['tmp_name'])){
    $zip_file=$_FILES["zip_file"];
    //获取数组里面的值
    $filename1=$zip_file["name"];//上传文件的文件名
    $tmp_name=$zip_file["tmp_name"];//上传文件的临时存放路径
    $newname = iconv('utf-8','gb2312',$filename1);
    move_uploaded_file($tmp_name,'upload/'.$newname);
    echo $filename1."<br>";
//     $filename = '1.jpg';
    $filename = 'upload/'.$newname;
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
    print $hash . "\n";
//     function unzip_file($filename1,$filename2, $destination){
//         $filename = substr($filename2, 0, strrpos($filename2, '.'));
//         mkdir(iconv('utf-8', 'gb2312','upload/'.$filename),0777);
//         $zip = new ZipArchive;
//         $file = iconv('utf-8', 'gb2312',$filename1);
//         if ($zip->open($file) === true) {
//             for($i = 0; $i < $zip->numFiles; $i++) {
//                 //$destination = iconv('UTF-8','GB2312',$destination)."<br>";
//                 //echo mb_substr($zip->getNameIndex($i),-6,6,'utf-8')."<br>";
// //                 $encode = mb_detect_encoding($zip->getNameIndex($i), array("ASCII","UTF-8","GB2312","GBK","BIG5"));
// //                 echo $encode;
//                 //$zip->extractTo($destination);
//                 copy("zip:\\\\".dirname(__FILE__)."\\".$filename1."#".$zip->getNameIndex($i), 'upload/'.$filename);
//             }

//             $zip->close();

//         }
//     }
//     unzip_file('upload\\'.$filename,$filename,'upload/');
}
?>