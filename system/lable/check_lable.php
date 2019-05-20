<?php
@session_start();
global $login;
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>在线标注系统</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta name="description" content="Developed By M Abdur Rokib Promy">
    <meta name="keywords" content="Admin, Bootstrap 3, Template, Theme, Responsive">
    <!-- bootstrap 3.0.2 -->
    <link href="../../css01/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- font Awesome -->
    <link href="../../css01/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="../../css01/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Morris chart -->
    <link href="../../css01/morris/morris.css" rel="stylesheet" type="text/css" />
    <!-- jvectormap -->
    <link href="../../css01/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
    <!-- Date Picker -->
    <link href="../../css01/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
    <!-- fullCalendar -->
    <!-- <link href="css/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css" /> -->
    <!-- Daterange picker -->
    <link href="../../css01/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
    <!-- iCheck for checkboxes and radio inputs -->
    <link href="../../css01/iCheck/all.css" rel="stylesheet" type="text/css" />
    <!-- bootstrap wysihtml5 - text editor -->
    <!-- <link href="css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" /> -->
    <link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
    <!-- Theme style -->
    <link href="../../css01/style.css" rel="stylesheet" type="text/css" />



    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
          <![endif]-->

          <style type="text/css">
                body {
                	background-color: #efefef;
                }
                #CalendarMain {
                	width: 300px;
                	height: 300px;
                	border: 1px solid #ccc;
                	margin: 0 auto;
                	margin-top: 100px;
                }
                #title {
                	width: 100%;
                	height: 30px;
                	background-color: #b9121b;
                }
                .selectBtn {
                	font-weight: 900;
                	font-size: 15px;
                	color: #fff;
                	cursor: pointer;
                	text-decoration: none;
                	padding: 7px 10px 6px 10px;
                }
                .selectBtn:hover {
                	background-color: #1d953f;
                }
                .selectYear {
                	float: left;
                	margin-left: 50px;
                	position: absolute;
                }
                .selectMonth {
                	float: left;
                	margin-left: 120px;
                	position: absolute;
                }
                .month {
                	float: left;
                	position: absolute;
                }
                .nextMonth {
                	float: right;
                }
                .currentDay {
                	float: right;
                }
                #context {
                	background-color: #fff;
                	width: 100%;
                }
                .week {
                	width: 100%;
                	height: 30px;
                }
                .week>h3 {
                	float: left;
                	color: #808080;
                	text-align: center;
                	margin: 0;
                	padding: 0;
                	margin-top: 5px;
                	font-size: 16px;
                }
                .dayItem {
                	float: left;
                }
                .lastItem {
                	color: #d1c7b7 !important;
                }
                .item {
                	color: #333;
                	float: left;
                	text-align: center;
                	cursor: pointer;
                	margin: 0;
                	font-family: "微软雅黑";
                	font-size: 13px;
                }
                .item:hover {
                	color: #b9121b;
                }
                .currentItem>a {
                	background-color: #b9121b;
                	width: 25px;
                	line-height: 25px;
                	float: left;
                	-webkit-border-radius: 50%;
                	-moz-border-radius: 50%;
                	border-radius: 50%;
                	color: #fff;
                }
                #foots {
                	width: 100%;
                	height: 35px;
                	background-color: #fff;
                	border-top: 1px solid #ccc;
                	margin-top: -1px;
                }
                #footNow {
                	float: left;
                	margin: 6px 0 0 5px;
                	color: #009ad6;
                	font-family: "微软雅黑";
                }
                #Container {
                	overflow: hidden;
                	float: left;
                }
                #center {
                	width: 100%;
                	overflow: hidden;
                }
                #centerMain {
                	width: 300%;
                	margin-left: -100%;
                }
                #selectYearDiv {
                	float: left;
                	background-color: #fff;
                }
                #selectYearDiv>div {
                	float: left;
                	text-align: center;
                	font-family: "微软雅黑";
                	font-size: 16px;
                	border: 1px solid #ccc;
                	margin-left: -1px;
                	margin-top: -1px;
                	cursor: pointer;
                	color: #909090;
                }
                .currentYearSd, .currentMontSd {
                	color: #ff4400 !important;
                }
                #selectMonthDiv {
                	float: left;
                	background-color: #fff;
                }
                #selectMonthDiv>div {
                	color: #909090;
                	float: left;
                	text-align: center;
                	font-family: "微软雅黑";
                	font-size: 16px;
                	border: 1px solid #ccc;
                	margin-left: -1px;
                	margin-top: -1px;
                	cursor: pointer;
                }
                #selectYearDiv>div:hover, #selectMonthDiv>div:hover {
                	background-color: #efefef;
                }
                #centerCalendarMain {
                	float: left;
                }
                </style>
      </head>

      <body class="skin-black">
        <!-- header logo: style can be found in header.less -->
        <header class="header">
            <a href="../user/User.php" class="logo">
                                           目录
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">

                        <!-- Messages: style can be found in dropdown.less-->
<!--                         <li class="dropdown messages-menu"> -->
<!--                             <a href="#" class="dropdown-toggle" data-toggle="dropdown"> -->
<!--                                 <i class="fa fa-envelope"></i> -->
<!--                                 <span class="label label-success">4</span> -->
<!--                             </a> -->
<!--                             <ul class="dropdown-menu"> -->
<!--                                 <li class="header">You have 4 messages</li> -->
<!--                                 <li> -->
                                    <!-- inner menu: contains the actual data -->
<!--                                     <ul class="menu"> -->
                                        <li><!-- start message -->
<!--                                             <a href="#"> -->
<!--                                                 <div class="pull-left"> -->
<!--                                                     <img src="../../img/26115.jpg" class="img-circle" alt="User Image"/> -->
<!--                                                 </div> -->
<!--                                                 <h4> -->
<!--                                                     Support Team -->
<!--                                                 </h4> -->
<!--                                                 <p>Why not buy a new awesome theme?</p> -->
<!--                                                 <small class="pull-right"><i class="fa fa-clock-o"></i> 5 mins</small> -->
<!--                                             </a> -->
                                        </li><!-- end message -->
<!--                                         <li> -->
<!--                                             <a href="#"> -->
<!--                                                 <div class="pull-left"> -->
<!--                                                     <img src="../../img/26115.jpg" class="img-circle" alt="user image"/> -->
<!--                                                 </div> -->
<!--                                                 <h4> -->
<!--                                                     Director Design Team -->

<!--                                                 </h4> -->
<!--                                                 <p>Why not buy a new awesome theme?</p> -->
<!--                                                 <small class="pull-right"><i class="fa fa-clock-o"></i> 2 hours</small> -->
<!--                                             </a> -->
<!--                                         </li> -->
<!--                                         <li> -->
<!--                                             <a href="#"> -->
<!--                                                 <div class="pull-left"> -->
<!--                                                     <img src="../../img/avatar.png" class="img-circle" alt="user image"/> -->
<!--                                                 </div> -->
<!--                                                 <h4> -->
<!--                                                     Developers -->

<!--                                                 </h4> -->
<!--                                                 <p>Why not buy a new awesome theme?</p> -->
<!--                                                 <small class="pull-right"><i class="fa fa-clock-o"></i> Today</small> -->
<!--                                             </a> -->
<!--                                         </li> -->
<!--                                         <li> -->
<!--                                             <a href="#"> -->
<!--                                                 <div class="pull-left"> -->
<!--                                                     <img src="../../img/26115.jpg" class="img-circle" alt="user image"/> -->
<!--                                                 </div> -->
<!--                                                 <h4> -->
<!--                                                     Sales Department -->

<!--                                                 </h4> -->
<!--                                                 <p>Why not buy a new awesome theme?</p> -->
<!--                                                 <small class="pull-right"><i class="fa fa-clock-o"></i> Yesterday</small> -->
<!--                                             </a> -->
<!--                                         </li> -->
<!--                                         <li> -->
<!--                                             <a href="#"> -->
<!--                                                 <div class="pull-left"> -->
<!--                                                     <img src="../../img/avatar.png" class="img-circle" alt="user image"/> -->
<!--                                                 </div> -->
<!--                                                 <h4> -->
<!--                                                     Reviewers -->

<!--                                                 </h4> -->
<!--                                                 <p>Why not buy a new awesome theme?</p> -->
<!--                                                 <small class="pull-right"><i class="fa fa-clock-o"></i> 2 days</small> -->
<!--                                             </a> -->
<!--                                         </li> -->
<!--                                     </ul> -->
<!--                                 </li> -->
<!--                                 <li class="footer"><a href="#">See All Messages</a></li> -->
<!--                             </ul> -->
<!--                         </li> -->
<!--                         <li class="dropdown tasks-menu"> -->
<!--                             <a href="#" class="dropdown-toggle" data-toggle="dropdown"> -->
<!--                                 <i class="fa fa-tasks"></i> -->
<!--                                 <span class="label label-danger">9</span> -->
<!--                             </a> -->
<!--                             <ul class="dropdown-menu"> -->
<!--                                 <li class="header">You have 9 tasks</li> -->
<!--                                 <li> -->
                                    <!-- inner menu: contains the actual data -->
<!--                                     <ul class="menu"> -->
                                        <li><!-- Task item -->
<!--                                             <a href="#"> -->
<!--                                                 <h3> -->
<!--                                                     Design some buttons -->
<!--                                                     <small class="pull-right">20%</small> -->
<!--                                                 </h3> -->
<!--                                                 <div class="progress progress-striped xs"> -->
                                                    <div class="progress-bar progress-bar-success" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
<!--                                                         <span class="sr-only">20% Complete</span> -->
<!--                                                     </div> -->
<!--                                                 </div> -->
<!--                                             </a> -->
                                        </li><!-- end task item -->
                                        <li><!-- Task item -->
<!--                                             <a href="#"> -->
<!--                                                 <h3> -->
<!--                                                     Create a nice theme -->
<!--                                                     <small class="pull-right">40%</small> -->
<!--                                                 </h3> -->
<!--                                                 <div class="progress progress-striped xs"> -->
                                                    <div class="progress-bar progress-bar-danger" style="width: 40%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
<!--                                                         <span class="sr-only">40% Complete</span> -->
<!--                                                     </div> -->
<!--                                                 </div> -->
<!--                                             </a> -->
                                        </li><!-- end task item -->
                                        <li><!-- Task item -->
<!--                                             <a href="#"> -->
<!--                                                 <h3> -->
<!--                                                     Some task I need to do -->
<!--                                                     <small class="pull-right">60%</small> -->
<!--                                                 </h3> -->
<!--                                                 <div class="progress progress-striped xs"> -->
                                                    <div class="progress-bar progress-bar-info" style="width: 60%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
<!--                                                         <span class="sr-only">60% Complete</span> -->
<!--                                                     </div> -->
<!--                                                 </div> -->
<!--                                             </a> -->
                                        </li><!-- end task item -->
                                        <li><!-- Task item -->
<!--                                             <a href="#"> -->
<!--                                                 <h3> -->
<!--                                                     Make beautiful transitions -->
<!--                                                     <small class="pull-right">80%</small> -->
<!--                                                 </h3> -->
<!--                                                 <div class="progress progress-striped xs"> -->
                                                    <div class="progress-bar progress-bar-warning" style="width: 80%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
<!--                                                         <span class="sr-only">80% Complete</span> -->
<!--                                                     </div> -->
<!--                                                 </div> -->
<!--                                             </a> -->
                                        </li><!-- end task item -->
<!--                                     </ul> -->
<!--                                 </li> -->
<!--                                 <li class="footer"> -->
<!--                                     <a href="#">View all tasks</a> -->
<!--                                 </li> -->
<!--                             </ul> -->
<!--                         </li> -->

                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-user"></i>
                                <span><?php echo $login['username'];?> <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu dropdown-custom dropdown-menu-right">
<!--                                 <li class="dropdown-header text-center">Account</li> -->

<!--                                 <li> -->
<!--                                     <a href="#"> -->
<!--                                     <i class="fa fa-clock-o fa-fw pull-right"></i> -->
<!--                                         <span class="badge badge-success pull-right">10</span> Updates</a> -->
<!--                                     <a href="#"> -->
<!--                                     <i class="fa fa-envelope-o fa-fw pull-right"></i> -->
<!--                                         <span class="badge badge-danger pull-right">5</span> Messages</a> -->
<!--                                     <a href="#"><i class="fa fa-magnet fa-fw pull-right"></i> -->
<!--                                         <span class="badge badge-info pull-right">3</span> Subscriptions</a> -->
<!--                                     <a href="#"><i class="fa fa-question fa-fw pull-right"></i> <span class= -->
<!--                                         "badge pull-right">11</span> FAQ</a> -->
<!--                                 </li> -->

<!--                                 <li class="divider"></li> -->

<!--                                     <li> -->
<!--                                         <a href="#"> -->
<!--                                         <i class="fa fa-user fa-fw pull-right"></i> -->
<!--                                             Profile -->
<!--                                         </a> -->
<!--                                         <a data-toggle="modal" href="#modal-user-settings"> -->
<!--                                         <i class="fa fa-cog fa-fw pull-right"></i> -->
<!--                                             Settings -->
<!--                                         </a> -->
<!--                                         </li> -->

                                        <li class="divider"></li>

                                        <li>
                                            <a href="../Login/Login.php"><i class="fa fa-ban fa-fw pull-right"></i> 退出登录</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </header>
                <div class="wrapper row-offcanvas row-offcanvas-left">
                    <!-- Left side column. contains the logo and sidebar -->
                    <aside class="left-side sidebar-offcanvas">
                        <!-- sidebar: style can be found in sidebar.less -->
                        <section class="sidebar">
                            <!-- Sidebar user panel -->
                            <div class="user-panel">
                                <div class="pull-left image">
                                    <img src="../../img/26115.jpg" class="img-circle" alt="User Image" />
                                </div>
                                <div class="pull-left info">

                                <p>你好，<?php echo $login['username'];?></p>
                                    <a href="#"><i class="fa fa-circle text-success"></i> 在线</a>
                                </div>
                            </div>
                            <!-- search form -->
<!--                             <form action="#" method="get" class="sidebar-form"> -->
<!--                                 <div class="input-group"> -->
<!--                                     <input type="text" name="q" class="form-control" placeholder="Search..."/> -->
<!--                                     <span class="input-group-btn"> -->
<!--                                         <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button> -->
<!--                                     </span> -->
<!--                                 </div> -->
<!--                             </form> -->
                            <!-- /.search form -->
                            <!-- sidebar menu: : style can be found in sidebar.less -->
                            <ul class="sidebar-menu">
                                <li class="active">
                                    <a href="../user/User.php">
                                        <i class="fa fa-dashboard"></i> <span>返回</span>
                                    </a>
                                </li>
<!--                                 <li> -->
<!--                                     <a href="#"> -->
<!--                                         <i class="fa fa-gavel"></i> <span>------</span> -->
<!--                                     </a> -->
<!--                                 </li> -->

<!--                                 <li> -->
<!--                                     <a href="#"> -->
<!--                                         <i class="fa fa-globe"></i> <span>------</span> -->
<!--                                     </a> -->
<!--                                 </li> -->

<!--                                 <li> -->
<!--                                     <a href="#"> -->
<!--                                         <i class="fa fa-glass"></i> <span>------</span> -->
<!--                                     </a> -->
<!--                                 </li> -->

                            </ul>
                        </section>
                        <div id="Demo">
                            <div id="CalendarMain" style="width:220px;bottom: 0px;position:absolute;">
                              <div id="title"> <a class="selectBtn month" href="javascript:" onclick="CalendarHandler.CalculateLastMonthDays();"><</a><a  style="margin-left:30px;" class="selectBtn selectYear" href="javascript:" onClick="CalendarHandler.CreateSelectYear(CalendarHandler.showYearStart);">2014年</a><a  style="margin-left:100px;" class="selectBtn selectMonth" onClick="CalendarHandler.CreateSelectMonth()">6月</a> <a  class="selectBtn nextMonth" href="javascript:" onClick="CalendarHandler.CalculateNextMonthDays();">></a><a class="selectBtn currentDay" href="javascript:" onClick="CalendarHandler.CreateCurrentCalendar(0,0,0);">今天</a></div>
                              <div id="context">
                                <div class="week">
                                  <h3> 一 </h3>
                                  <h3> 二 </h3>
                                  <h3> 三 </h3>
                                  <h3> 四 </h3>
                                  <h3> 五 </h3>
                                  <h3> 六 </h3>
                                  <h3> 日 </h3>
                                </div>
                                <div id="center">
                                  <div id="centerMain">
                                    <div id="selectYearDiv"></div>
                                    <div id="centerCalendarMain">
                                      <div id="Container"></div>
                                    </div>
                                    <div id="selectMonthDiv"></div>
                                  </div>
                                </div>
                                <div id="foots"><a id="footNow">19:14:34</a></div>
                              </div>
                            </div>
                            </div>
                        <!-- /.sidebar -->
                    </aside>
           <aside class="right-side">
           <div class="row">
                    <?php
                        //$conn=mysql_connect("219.245.4.239","root","12345")  or die(mysql_error());
                        $conn=mysql_connect("localhost","root","123456")  or die(mysql_error());//连接数据库
                        mysql_select_db('lables',$conn) or die(mysql_error());  //选择数据库
                        mysql_query("set names utf8"); //设定字符集

						$sql1 = "select * from upload_labler where id = '$_GET[userid]'";
						$result1 = mysql_query($sql1);
						$row1 = mysql_fetch_array($result1);
					 ?>
					  <div class="col-md-8"  style="width:100%;">
                            <div class="panel">
                              <header class="panel-heading">
                                                                                         标注结果  (<?php echo $row1['name']." , ";
                                                 echo $row1['sex']." , ";
                                                 echo $row1['age']."岁 , ";
                                                 if($row1['is_normal'] == 'yes'){
                                                    echo "正常人, ";
                                                 }else{
                                                     echo "面瘫患者, ";
                                                 }?>正常得0分，轻度得1分，中度得2分，重度得3分)
                                 <a href="../../reference.html" target="_blank"><i class="fa fa-question fa-fw pull-right"></i></a>
                              </header>
                            <div class="panel-body table-responsive">
                            <div class="box-tools m-b-15">

                            </div>
 							<form action="submit_lable.php" enctype="multipart/form-data" method="post">
                                <table class="table table-hover" >
                                  <thead>
                                    <tr>
                                      <th>表情</th>
                                      <th>图片文件</th>
                                      <th>视频文件</th>
                                      <th>标注</th>
                                      <?php
                                      $sql2 = "select * from uploads where userid = '$_GET[userid]'"; //SQL语句
                                      $result2 = mysql_query($sql2);    //执行SQL语句
                                      while($row2 = mysql_fetch_array($result2)){
                                      ?>
                                      <th style="text-align:center;"><?php echo $row2['labler']."的标注结果";?></th>
                                      <?php
                                      }
                                      ?>
                                    </tr>
                                  </thead>
                                  <tbody>
								   <?php
                                    $sql = "select * from photo_video where id = '$_GET[userid]'"; //SQL语句
                                    $result = mysql_query($sql);    //执行SQL语句

                                    while($row = mysql_fetch_array($result)){
                                    ?>
                                    <tr>
                                      <th>静态</th>
                                      <th ><?php echo "<a href='../../upload/".$row1['name']."/".$row['static_p']."' target='_blank'>".$row['static_p']."</a>";?></th>
                                      <th></th><!--  -->
                                      <th>额纹对称情况：
                                      <?php $sql3 = "select post_id from register where register_name='".$login['username']."'";
                                            $result3 = mysql_query($sql3);
                                            $row3 = mysql_fetch_array($result3);
                                            if($row3['post_id'] == p001){
                                      ?>
                                  			<select name="userstatic1">
                                              <option value ="0" >正常</option>
                                              <option value ="1">轻度</option>
                                              <option value="2">中度</option>
                                              <option value="3">重度</option>
                                            </select>
                                       <?php
                                      }
                                      ?>
										     <br>眼睑开合情况：
									  <?php
								             if($row3['post_id'] == p001){
									  ?>
                                            <select name="userstatic2">
                                              <option value ="0" >正常</option>
                                              <option value ="1">轻度</option>
                                              <option value="2">中度</option>
                                              <option value="3">重度</option>
                                            </select>
                                       <?php }?>
                                             <br>鼻唇沟深浅程度：
                                       <?php
								             if($row3['post_id'] == p001){
									   ?>
                                            <select name="userstatic3">
                                              <option value ="0" >正常</option>
                                              <option value ="1">轻度</option>
                                              <option value="2">中度</option>
                                              <option value="3">重度</option>
                                            </select>
                                       <?php }?>
                                             <br> 嘴角歪斜的程度：
                                       <?php
								             if($row3['post_id'] == p001){
									   ?>
                                            <select name="userstatic4">
                                              <option value ="0" >正常</option>
                                              <option value ="1">轻度</option>
                                              <option value="2">中度</option>
                                              <option value="3">重度</option>
                                            </select>
								      <?php }?>
                                      </th>
									  <?php
									  $result2 = mysql_query($sql2);    //执行SQL语句
                                      while($row2 = mysql_fetch_array($result2)){
                                      ?>
                                      <th style="text-align:center;"><?php if(substr($row2['userstatic'], 0,1)==0){
                                                   echo "正常<br>";
                                                }else if(substr($row2['userstatic'], 0,1)==1){
                                                   echo "轻度<br>";
                                                }else if(substr($row2['userstatic'], 0,1)==2){
                                                    echo "中度<br>";
                                                }else{
                                                    echo "重度<br>";
                                                }
                                                if(substr($row2['userstatic'], 1,1)==0){
                                                    echo "正常<br>";
                                                }else if(substr($row2['userstatic'], 1,1)==1){
                                                    echo "轻度<br>";
                                                }else if(substr($row2['userstatic'], 1,1)==2){
                                                    echo "中度<br>";
                                                }else{
                                                    echo "重度<br>";
                                                }
                                                if(substr($row2['userstatic'], 2,-1)==0){
                                                    echo "正常<br>";
                                                }else if(substr($row2['userstatic'], 2,-1)==1){
                                                    echo "轻度<br>";
                                                }else if(substr($row2['userstatic'], 2,-1)==2){
                                                    echo "中度<br>";
                                                }else{
                                                    echo "重度<br>";
                                                }
                                                if(substr($row2['userstatic'], 3,3)==0){
                                                    echo "正常<br>";
                                                }else if(substr($row2['userstatic'], 3,3)==1){
                                                    echo "轻度<br>";
                                                }else if(substr($row2['userstatic'], 3,3)==2){
                                                    echo "中度<br>";
                                                }else{
                                                    echo "重度<br>";
                                                }
                                                ?></th>
                                      <?php
                                      }
                                      ?>
                                    </tr>
                                    <tr>
                                      <th>抬眉</th>
                                      <th><?php echo "<a href='../../upload/".$row1['name']."/".$row['taimei_p']."' target='_blank'>".$row['taimei_p']."</a>";?></th>
                                      <th><?php echo "<a href='../../upload/".$row1['name']."/".$row['taimei_v']."' target='_blank'>".$row['taimei_v']."</a>";?></th>
                                      <th>
                                                                                                      额肌运动的异常程度：
                                      <?php
								             if($row3['post_id'] == p001){
									  ?>
                                        <select name="taimei">
                                          <option value ="0" >正常</option>
                                          <option value ="1">轻度</option>
                                          <option value="2">中度</option>
                                          <option value="3">重度</option>
                                        </select>
                                       <?php }?>
                                      </th>
                                      <?php
									  $result2 = mysql_query($sql2);    //执行SQL语句
                                      while($row2 = mysql_fetch_array($result2)){
                                      ?>
                                      <th style="text-align:center;"><?php if($row2['usertaimei']==0){
                                                   echo "正常<br>";
                                                }else if($row2['usertaimei']==1){
                                                               echo "轻度<br>";
                                                }else if($row2['usertaimei']==2){
                                                    echo "中度<br>";
                                                }else{
                                                    echo "重度<br>";
                                                }?></th>
                                      <?php
                                      }
                                      ?>
                                    </tr>
                                    <tr>
                                      <th>皱眉</th>
                                      <th><?php echo "<a href='../../upload/".$row1['name']."/".$row['zhoumei_p']."' target='_blank'>".$row['zhoumei_p']."</a>";?></th>
                                      <th><?php echo "<a href='../../upload/".$row1['name']."/".$row['zhoumei_v']."' target='_blank'>".$row['zhoumei_v']."</a>";?></th>
                                      <th>
										    皱眉肌运动的异常程度：
									  <?php
								         if($row3['post_id'] == p001){
									  ?>
										<select name="zhoumei">
                                          <option value ="0" >正常</option>
                                          <option value ="1">轻度</option>
                                          <option value="2">中度</option>
                                          <option value="3">重度</option>
                                        </select>
                                      <?php }?>
                                      </th>
                                      <?php
									  $result2 = mysql_query($sql2);    //执行SQL语句
                                      while($row2 = mysql_fetch_array($result2)){
                                      ?>
                                      <th style="text-align:center;"><?php if($row2['userzhoumei']==0){
                                                   echo "正常<br>";
                                                }else if($row2['userzhoumei']==1){
                                                               echo "轻度<br>";
                                                }else if($row2['userzhoumei']==2){
                                                    echo "中度<br>";
                                                }else{
                                                    echo "重度<br>";
                                                }?></th>
                                      <?php
                                      }
                                      ?>
                                    </tr>
                                    <tr>
                                      <th>闭眼</th>
                                      <th><?php echo "<a href='../../upload/".$row1['name']."/".$row['biyan_p']."' target='_blank'>".$row['biyan_p']."</a>";?></th>
                                      <th><?php echo "<a href='../../upload/".$row1['name']."/".$row['biyan_v']."' target='_blank'>".$row['biyan_v']."</a>";?></th>
                                      <th>
                                     	 眼睑开合的异常程度：
                                     	 <?php
								         if($row3['post_id'] == p001){
									  ?>
                                     	<select name="biyan">
                                          <option value ="0" >正常</option>
                                          <option value ="1">轻度</option>
                                          <option value="2">中度</option>
                                          <option value="3">重度</option>
                                        </select>
                                        <?php }?>
                                      </th>
                                      <?php
									  $result2 = mysql_query($sql2);    //执行SQL语句
                                      while($row2 = mysql_fetch_array($result2)){
                                      ?>
                                      <th style="text-align:center;"><?php if($row2['userbiyan']==0){
                                                   echo "正常<br>";
                                                }else if($row2['userbiyan']==1){
                                                               echo "轻度<br>";
                                                }else if($row2['userbiyan']==2){
                                                    echo "中度<br>";
                                                }else{
                                                    echo "重度<br>";
                                                }?></th>
                                      <?php
                                      }
                                      ?>
                                    </tr>
                                    <tr>
                                      <th>耸鼻</th>
                                      <th><?php echo "<a href='../../upload/".$row1['name']."/".$row['songbi_p']."' target='_blank'>".$row['songbi_p']."</a>";?></th>
                                      <th><?php echo "<a href='../../upload/".$row1['name']."/".$row['songbi_v']."' target='_blank'>".$row['songbi_v']."</a>";?></th>
                                      <th>
                                      	     鼻唇沟异常程度：
                                  	  <?php
						                 if($row3['post_id'] == p001){
									  ?>
                                      	<select name="songbi">
                                          <option value ="0" >正常</option>
                                          <option value ="1">轻度</option>
                                          <option value="2">中度</option>
                                          <option value="3">重度</option>
                                        </select>
                                        <?php }?>
                                      </th>
                                      <?php
									  $result2 = mysql_query($sql2);    //执行SQL语句
                                      while($row2 = mysql_fetch_array($result2)){
                                      ?>
                                      <th style="text-align:center;"><?php if($row2['usersongbi']==0){
                                                   echo "正常<br>";
                                                }else if($row2['usersongbi']==1){
                                                               echo "轻度<br>";
                                                }else if($row2['usersongbi']==2){
                                                    echo "中度<br>";
                                                }else{
                                                    echo "重度<br>";
                                                }?></th>
                                      <?php
                                      }
                                      ?>
                                    </tr>
                                    <tr>
                                      <th>微笑</th>
                                      <th><?php echo "<a href='../../upload/".$row1['name']."/".$row['weixiao_p']."' target='_blank'>".$row['weixiao_p']."</a>";?></th>
                                      <th><?php echo "<a href='../../upload/".$row1['name']."/".$row['weixiao_v']."' target='_blank'>".$row['weixiao_v']."</a>";?></th>
                                      <th>
                                       	    口角歪斜的异常程度：
                                       	    <?php
						                 if($row3['post_id'] == p001){
									  ?>
                                       	<select name="weixiao">
                                          <option value ="0" >正常</option>
                                          <option value ="1">轻度</option>
                                          <option value="2">中度</option>
                                          <option value="3">重度</option>
                                        </select>
                                        <?php }?>
                                      </th>
                                      <?php
									  $result2 = mysql_query($sql2);    //执行SQL语句
                                      while($row2 = mysql_fetch_array($result2)){
                                      ?>
                                      <th style="text-align:center;"><?php if($row2['userweixiao']==0){
                                                   echo "正常<br>";
                                                }else if($row2['userweixiao']==1){
                                                               echo "轻度<br>";
                                                }else if($row2['userweixiao']==2){
                                                    echo "中度<br>";
                                                }else{
                                                    echo "重度<br>";
                                                }?></th>
                                      <?php
                                      }
                                      ?>
                                    </tr>
                                    <tr>
                                      <th>示齿</th>
                                      <th><?php echo "<a href='../../upload/".$row1['name']."/".$row['shichi_p']."' target='_blank'>".$row['shichi_p']."</a>";?></th>
                                      <th><?php echo "<a href='../../upload/".$row1['name']."/".$row['shichi_v']."' target='_blank'>".$row['shichi_v']."</a>";?></th>
                                      <th>
                                      	    口角歪斜的异常程度：
                                      	    <?php
						                 if($row3['post_id'] == p001){
									  ?>
                                      	<select name="shichi">
                                          <option value ="0" >正常</option>
                                          <option value ="1">轻度</option>
                                          <option value="2">中度</option>
                                          <option value="3">重度</option>
                                        </select>
                                        <?php }?>
                                      </th>
                                      <?php
									  $result2 = mysql_query($sql2);    //执行SQL语句
                                      while($row2 = mysql_fetch_array($result2)){
                                      ?>
                                      <th style="text-align:center;"><?php if($row2['usershichi']==0){
                                                   echo "正常<br>";
                                                }else if($row2['usershichi']==1){
                                                               echo "轻度<br>";
                                                }else if($row2['usershichi']==2){
                                                    echo "中度<br>";
                                                }else{
                                                    echo "重度<br>";
                                                }?></th>
                                      <?php
                                      }
                                      ?>
                                    </tr>
                                    <tr>
                                      <th>鼓腮</th>
                                      <th><?php echo "<a href='../../upload/".$row1['name']."/".$row['gusai_p']."' target='_blank'>".$row['gusai_p']."</a>";?></th>
                                      <th><?php echo "<a href='../../upload/".$row1['name']."/".$row['gusai_v']."' target='_blank'>".$row['gusai_v']."</a>";?></th>
                                      <th>
                                      	    鼓腮漏气的情况：
                                      	    <?php
						                 if($row3['post_id'] == p001){
									  ?>
                                      	<select name="gusai1">
                                          <option value ="0" >正常</option>
                                          <option value ="1">轻度</option>
                                          <option value="2">中度</option>
                                          <option value="3">重度</option>
                                        </select>
                                        <?php }?><br>
                                                                                                        口角歪斜的程度：
                                      <?php
						                 if($row3['post_id'] == p001){
									  ?>
                                        <select name=gusai2>
                                          <option value ="0" >正常</option>
                                          <option value ="1">轻度</option>
                                          <option value="2">中度</option>
                                          <option value="3">重度</option>
                                        </select>
                                        <?php }?>
                                      </th>
                                      <?php
									  $result2 = mysql_query($sql2);    //执行SQL语句
                                      while($row2 = mysql_fetch_array($result2)){
                                      ?>
                                      <th style="text-align:center;"><?php
                                              if(substr($row2['usergusai'], 0,1)==0){
                                                  echo "正常<br>";
                                              }else if(substr($row2['usergusai'], 0,1)==1){
                                                  echo "轻度<br>";
                                              }else if(substr($row2['usergusai'], 0,1)==2){
                                                  echo "中度<br>";
                                              }else{
                                                  echo "重度<br>";
                                              }
                                              if(substr($row2['usergusai'], 1,1)==0){
                                                  echo "正常<br>";
                                              }else if(substr($row2['usergusai'], 1,1)==1){
                                                  echo "轻度<br>";
                                              }else if(substr($row2['usergusai'], 1,1)==2){
                                                  echo "中度<br>";
                                              }else{
                                                  echo "重度<br>";
                                              }?></th>
                                      <?php
                                      }
                                      ?>
                                    </tr>
                                    <tr>
                                      <th>得分</th>
                                      <th></th>
                                      <th></th>
                                      <th></th>
                                      <?php
                                      $sql2 = "select * from uploads where userid = '$_GET[userid]'"; //SQL语句
                                      $result2 = mysql_query($sql2);    //执行SQL语句
                                      while($row2 = mysql_fetch_array($result2)){
                                      ?>
                                      <th style="text-align:center;"><?php echo substr($row2['userstatic'], 0,1)+substr($row2['userstatic'], 1,1)
                                      +substr($row2['userstatic'], 2,-1)+substr($row2['userstatic'], 3,3)+$row2['usertaimei']
                                      +$row2['userzhoumei']+$row2['userbiyan']+$row2['usersongbi']+$row2['userweixiao']
                                      +$row2['usershichi']+substr($row2['usergusai'], 0,1)+substr($row2['usergusai'], 1,1);?></th>
                                      <?php
                                      }
                                      ?>
                                    </tr>
                                  </tbody>
                                </table>

                                <?php $sql3 = "select post_id from register where register_name='".$login['username']."'";
                                      $result3 = mysql_query($sql3);
                                      $row3 = mysql_fetch_array($result3);
                                      if($row3['post_id'] == p001){
                                ?>
                                <input type="hidden" name="lable" value="<?php echo $_GET[userid];?>">
                                <input type="submit" name="submit" style="width:3.5em;height:2em;" value="提交" class="btn btn-info" onclick="if(confirm('确认提交吗？')==false) return false;else window.location.href=('submit_lable.php');"/>
                                <?php
                                      }
                                ?>
                                  <?php
                                    }
                                  mysql_close($conn);
                                  ?>

                            </form>
                  </div>
              </div>
            </div><!--end col-6 -->
          </div>
           </aside><!-- /.right-side -->
      </div>
<script type="text/javascript" src="../../js/jquery-1.4.min.js"></script>
<script type="text/javascript">
		$(document).ready(function(e) {
			CalendarHandler.initialize();
		});

		var CalendarHandler = {
			currentYear: 0,
			currentMonth: 0,
			isRunning: false,
			showYearStart:2009,
			tag:0,
			initialize: function() {
				$calendarItem = this.CreateCalendar(0, 0, 0);
				$("#Container").append($calendarItem);

				$("#context").css("height", $("#CalendarMain").height() - 65 + "px");
				$("#center").css("height", $("#context").height() - 30 + "px");
				$("#selectYearDiv").css("height", $("#context").height() - 30 + "px").css("width", $("#context").width() + "px");
				$("#selectMonthDiv").css("height", $("#context").height() - 30 + "px").css("width", $("#context").width() + "px");
				$("#centerCalendarMain").css("height", $("#context").height() - 30 + "px").css("width", $("#context").width() + "px");

				$calendarItem.css("height", $("#context").height() - 30 + "px"); //.css("visibility","hidden");
				$("#Container").css("height", "0px").css("width", "0px").css("margin-left", $("#context").width() / 2 + "px").css("margin-top", ($("#context").height() - 30) / 2 + "px");
				$("#Container").animate({
					width: $("#context").width() + "px",
					height: ($("#context").height() - 30) * 2 + "px",
					marginLeft: "0px",
					marginTop: "0px"
				}, 300, function() {
					$calendarItem.css("visibility", "visible");
				});
				$(".dayItem").css("width", $("#context").width() + "px");
				var itemPaddintTop = $(".dayItem").height() / 6;
				$(".item").css({
					"width": $(".week").width() / 7 + "px",
					"line-height": itemPaddintTop + "px",
					"height": itemPaddintTop + "px"
				});
				$(".currentItem>a").css("margin-left", ($(".item").width() - 25) / 2 + "px").css("margin-top", ($(".item").height() - 25) / 2 + "px");
				$(".week>h3").css("width", $(".week").width() / 7 + "px");
				this.RunningTime();
			},
			CreateSelectYear: function(showYearStart) {
				CalendarHandler.showYearStart=showYearStart;
				$(".currentDay").show();
				$("#selectYearDiv").children().remove();
				var yearindex = 0;
				for (var i = showYearStart; i < showYearStart+12; i++) {
					yearindex++;
					if(i==showYearStart){
						$last=$("<div>往前</div>");
						$("#selectYearDiv").append($last);
						$last.click(function(){
							CalendarHandler.CreateSelectYear(CalendarHandler.showYearStart-10);
						});
						continue;
					}
					if(i==showYearStart+11){
						$next=$("<div>往后</div>");
						$("#selectYearDiv").append($next);
						$next.click(function(){
							CalendarHandler.CreateSelectYear(CalendarHandler.showYearStart+10);
						});
						continue;
					}

					if (i == this.currentYear) {
						$yearItem=$("<div class=\"currentYearSd\" id=\"" + yearindex + "\">" + i + "</div>")

					}
					else{
						 $yearItem=$("<div id=\"" + yearindex + "\">" + i + "</div>");
					}
					$("#selectYearDiv").append($yearItem);
					$yearItem.click(function(){
						$calendarItem=CalendarHandler.CreateCalendar(Number($(this).html()),1,1);
						$("#Container").append($calendarItem);
						CalendarHandler.CSS()
					    CalendarHandler.isRunning = true;
					    $($("#Container").find(".dayItem")[0]).animate({
						height: "0px"
					    }, 300, function() {
						$(this).remove();
						CalendarHandler.isRunning = false;
					    });
						$("#centerMain").animate({
						marginLeft: -$("#center").width() + "px"
					}, 500);
					});
					if (yearindex == 1 || yearindex == 5 || yearindex == 9) $("#selectYearDiv").find("#" + yearindex).css("border-left-color", "#fff");
					if (yearindex == 4 || yearindex == 8 || yearindex == 12) $("#selectYearDiv").find("#" + yearindex).css("border-right-color", "#fff");

				}
				$("#selectYearDiv>div").css("width", ($("#center").width() - 4) / 4 + "px").css("line-height", ($("#center").height() - 4) / 3 + "px");
				$("#centerMain").animate({
					marginLeft: "0px"
				}, 300);
			},
			CreateSelectMonth: function() {
				$(".currentDay").show();
				$("#selectMonthDiv").children().remove();
				for (var i = 1; i < 13; i++) {
					if (i == this.currentMonth) $monthItem=$("<div class=\"currentMontSd\" id=\"" + i + "\">" + i + "月</div>");
					else  $monthItem=$("<div id=\"" + i + "\">" + i + "月</div>");
					$("#selectMonthDiv").append($monthItem);
					$monthItem.click(function(){
						$calendarItem=CalendarHandler.CreateCalendar(CalendarHandler.currentYear,Number($(this).attr("id")),1);
						$("#Container").append($calendarItem);
						CalendarHandler.CSS()
					    CalendarHandler.isRunning = true;
					    $($("#Container").find(".dayItem")[0]).animate({
						height: "0px"
					    }, 300, function() {
						$(this).remove();
						CalendarHandler.isRunning = false;
					    });
						$("#centerMain").animate({
						marginLeft: -$("#center").width() + "px"
					}, 500);
					});
					if (i == 1 || i == 5 || i == 9) $("#selectMonthDiv").find("#" + i).css("border-left-color", "#fff");
					if (i == 4 || i == 8 || i == 12) $("#selectMonthDiv").find("#" + i).css("border-right-color", "#fff");
				}
				$("#selectMonthDiv>div").css("width", ($("#center").width() - 4) / 4 + "px").css("line-height", ($("#center").height() - 4) / 3 + "px");
				$("#centerMain").animate({
					marginLeft: -$("#center").width() * 2 + "px"
				}, 300);
			},
			IsRuiYear: function(aDate) {
				return (0 == aDate % 4 && (aDate % 100 != 0 || aDate % 400 == 0));
			},
			CalculateWeek: function(y, m, d) {
				var arr = "7123456".split("");
				with(document.all) {
					var vYear = parseInt(y, 10);
					var vMonth = parseInt(m, 10);
					var vDay = parseInt(d, 10);
				}
				var week =arr[new Date(y,m-1,vDay).getDay()];
				return week;
			},
			CalculateMonthDays: function(m, y) {
				var mDay = 0;
				if (m == 0 || m == 1 || m == 3 || m == 5 || m == 7 || m == 8 || m == 10 || m == 12) {
					mDay = 31;
				} else {
					if (m == 2) {
						//判断是否为芮年
						var isRn = this.IsRuiYear(y);
						if (isRn == true) {
							mDay = 29;
						} else {
							mDay = 28;
						}
					} else {
						mDay = 30;
					}
				}
				return mDay;
			},
			CreateCalendar: function(y, m, d) {
				$dayItem = $("<div class=\"dayItem\"></div>");
				//获取当前月份的天数
				var nowDate = new Date();
				if(y==nowDate.getFullYear()&&m==nowDate.getMonth()+1||(y==0&&m==0))
				$(".currentDay").hide();
				var nowYear = y == 0 ? nowDate.getFullYear() : y;
				this.currentYear = nowYear;
				var nowMonth = m == 0 ? nowDate.getMonth() + 1 : m;
				this.currentMonth = nowMonth;
				var nowDay = d == 0 ? nowDate.getDate() : d;
				$(".selectYear").html(nowYear + "年");
				$(".selectMonth").html(nowMonth + "月");
				var nowDaysNub = this.CalculateMonthDays(nowMonth, nowYear);
				//获取当月第一天是星期几
				//var weekDate = new Date(nowYear+"-"+nowMonth+"-"+1);
				//alert(weekDate.getDay());
				var nowWeek = parseInt(this.CalculateWeek(nowYear, nowMonth, 1));
				//nowWeek=weekDate.getDay()==0?7:weekDate.getDay();
				//var nowWeek=weekDate.getDay();
				//获取上个月的天数
				var lastMonthDaysNub = this.CalculateMonthDays((nowMonth - 1), nowYear);

				if (nowWeek != 0) {
					//生成上月剩下的日期
					for (var i = (lastMonthDaysNub - (nowWeek - 1)); i < lastMonthDaysNub; i++) {
						$dayItem.append("<div class=\"item lastItem\"><a>" + (i + 1) + "</a></div>");
					}
				}

				//生成当月的日期
				for (var i = 0; i < nowDaysNub; i++) {
					if (i == (nowDay - 1)) $dayItem.append("<div class=\"item currentItem\"><a>" + (i + 1) + "</a></div>");
					else $dayItem.append("<div class=\"item\"><a>" + (i + 1) + "</a></div>");
				}

				//获取总共已经生成的天数
				var hasCreateDaysNub = nowWeek + nowDaysNub;
				//如果小于42，往下个月推算
				if (hasCreateDaysNub < 42) {
					for (var i = 0; i <= (42 - hasCreateDaysNub); i++) {
						$dayItem.append("<div class=\"item lastItem\"><a>" + (i + 1) + "</a></div>");
					}
				}

				return $dayItem;
			},
			CSS: function() {
				var itemPaddintTop = $(".dayItem").height() / 6;
				$(".item").css({
					"width": $(".week").width() / 7 + "px",
					"line-height": itemPaddintTop + "px",
					"height": itemPaddintTop + "px"
				});
				$(".currentItem>a").css("margin-left", ($(".item").width() - 25) / 2 + "px").css("margin-top", ($(".item").height() - 25) / 2 + "px");
			},
			CalculateNextMonthDays: function() {
				if (this.isRunning == false) {
					$(".currentDay").show();
					var m = this.currentMonth == 12 ? 1 : this.currentMonth + 1;
					var y = this.currentMonth == 12 ? (this.currentYear + 1) : this.currentYear;
					var d = 0;
					var nowDate = new Date();
					if (y == nowDate.getFullYear() && m == nowDate.getMonth() + 1) d = nowDate.getDate();
					else d = 1;
					$calendarItem = this.CreateCalendar(y, m, d);
					$("#Container").append($calendarItem);

					this.CSS();
					this.isRunning = true;
					$($("#Container").find(".dayItem")[0]).animate({
						height: "0px"
					}, 300, function() {
						$(this).remove();
						CalendarHandler.isRunning = false;
					});
				}
			},
			CalculateLastMonthDays: function() {
				if (this.isRunning == false) {
					$(".currentDay").show();
					var nowDate = new Date();
					var m = this.currentMonth == 1 ? 12 : this.currentMonth - 1;
					var y = this.currentMonth == 1 ? (this.currentYear - 1) : this.currentYear;
					var d = 0;

					if (y == nowDate.getFullYear() && m == nowDate.getMonth() + 1) d = nowDate.getDate();
					else d = 1;
					$calendarItem = this.CreateCalendar(y, m, d);
					$("#Container").append($calendarItem);
					var itemPaddintTop = $(".dayItem").height() / 6;
					this.CSS();
					this.isRunning = true;
					$($("#Container").find(".dayItem")[0]).animate({
						height: "0px"
					}, 300, function() {
						$(this).remove();
						CalendarHandler.isRunning = false;
					});
				}
			},
			CreateCurrentCalendar: function() {
				if (this.isRunning == false) {
					$(".currentDay").hide();
					$calendarItem = this.CreateCalendar(0, 0, 0);
					$("#Container").append($calendarItem);
					this.isRunning = true;
					$($("#Container").find(".dayItem")[0]).animate({
						height: "0px"
					}, 300, function() {
						$(this).remove();
						CalendarHandler.isRunning = false;
					});
					this.CSS();
					$("#centerMain").animate({
						marginLeft: -$("#center").width() + "px"
					}, 500);
				}
			},
			RunningTime: function() {
				var mTiming = setInterval(function() {
					var nowDate = new Date();
					var h=nowDate.getHours()<10?"0"+nowDate.getHours():nowDate.getHours();
					var m=nowDate.getMinutes()<10?"0"+nowDate.getMinutes():nowDate.getMinutes();
					var s=nowDate.getSeconds()<10?"0"+nowDate.getSeconds():nowDate.getSeconds();
					var nowTime = h + ":" + m + ":" + s;
					$("#footNow").html(nowTime);
				}, 1000);

			}
		}
		</script>
        <!-- jQuery 2.0.2 -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <script src="../../js/jquery.min.js" type="text/javascript"></script>

        <!-- jQuery UI 1.10.3 -->
        <script src="../../js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>
        <!-- Bootstrap -->
        <script src="../../js/bootstrap.min.js" type="text/javascript"></script>
        <!-- daterangepicker -->
        <script src="../../js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>

        <script src="../../js/plugins/chart.js" type="text/javascript"></script>

        <!-- datepicker
        <script src="../../js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>-->
        <!-- Bootstrap WYSIHTML5
        <script src="../../js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>-->
        <!-- iCheck -->
        <script src="../../js/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
        <!-- calendar -->
        <script src="../../js/plugins/fullcalendar/fullcalendar.js" type="text/javascript"></script>

        <!-- Director App -->
        <script src="../../js/Director/app.js" type="text/javascript"></script>

        <!-- Director dashboard demo (This is only for demo purposes) -->
        <script src="../../js/Director/dashboard.js" type="text/javascript"></script>

        <!-- Director for demo purposes -->
        <script type="text/javascript">
            $('input').on('ifChecked', function(event) {
                // var element = $(this).parent().find('input:checkbox:first');
                // element.parent().parent().parent().addClass('highlight');
                $(this).parents('li').addClass("task-done");
                console.log('ok');
            });
            $('input').on('ifUnchecked', function(event) {
                // var element = $(this).parent().find('input:checkbox:first');
                // element.parent().parent().parent().removeClass('highlight');
                $(this).parents('li').removeClass("task-done");
                console.log('not');
            });

        </script>
        <script>
            $('#noti-box').slimScroll({
                height: '400px',
                size: '5px',
                BorderRadius: '5px'
            });

            $('input[type="checkbox"].flat-grey, input[type="radio"].flat-grey').iCheck({
                checkboxClass: 'icheckbox_flat-grey',
                radioClass: 'iradio_flat-grey'
            });
</script>
<script type="text/javascript">
    $(function() {
                "use strict";
                //BAR CHART
                var data = {
                    labels: ["January", "February", "March", "April", "May", "June", "July"],
                    datasets: [
                        {
                            label: "My First dataset",
                            fillColor: "rgba(220,220,220,0.2)",
                            strokeColor: "rgba(220,220,220,1)",
                            pointColor: "rgba(220,220,220,1)",
                            pointStrokeColor: "#fff",
                            pointHighlightFill: "#fff",
                            pointHighlightStroke: "rgba(220,220,220,1)",
                            data: [65, 59, 80, 81, 56, 55, 40]
                        },
                        {
                            label: "My Second dataset",
                            fillColor: "rgba(151,187,205,0.2)",
                            strokeColor: "rgba(151,187,205,1)",
                            pointColor: "rgba(151,187,205,1)",
                            pointStrokeColor: "#fff",
                            pointHighlightFill: "#fff",
                            pointHighlightStroke: "rgba(151,187,205,1)",
                            data: [28, 48, 40, 19, 86, 27, 90]
                        }
                    ]
                };
            new Chart(document.getElementById("linechart").getContext("2d")).Line(data,{
                responsive : true,
                maintainAspectRatio: false,
            });

            });
            // Chart.defaults.global.responsive = true;
</script>
</body>
</html>