<?php session_start();
session_unregister(login);?>
<!DOCTYPE html>
<html>

<!-- Head -->
<head>

<title>在线标注系统</title>

<!-- Meta-Tags -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //Meta-Tags -->

<!-- Style --> <link rel="stylesheet" href="../../css/style.css" type="text/css" media="all">



</head>
<!-- //Head -->

<!-- Body -->
<body>

<h1>标注系统</h1>

<div class="container w3layouts agileits" style="width:400px;height:300px;">

<div class="login w3layouts agileits" style="margin-left:25%;">
<h2 style="margin-left:25%;">登 录</h2>
<form action="LoginCheck.php" method="post">
<input type="text" Name="Userame" placeholder="用户名" required="">
<input type="password" Name="Password" placeholder="密码" required="">
<ul class="tick w3layouts agileits">
<li>
<input type="checkbox" id="brand1" value="">
<label for="brand1"><span></span>记住我</label>
</li>
</ul>
<div class="send-button w3layouts agileits">
<input type="submit" name="submit" value="登录">
</div>
</form>
<a href="#">忘记密码?</a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;
<a href="../register/Register.html">注册</a>
<div class="clear"></div>
</div>

<div class="clear"></div>

</div>

<div class="footer w3layouts agileits">
<!--
<p>Copyright &copy; More Templates <a href="http://www.cssmoban.com/" target="_blank" title="模板之家">模板之家</a> - Collect from <a href="http://www.cssmoban.com/" title="网页模板" target="_blank">网页模板</a></p>
-->
</div>

</body>
<!-- //Body -->

</html>