<?
header("Content-type:text/html;charset=utf-8");
$kv = new SaeKV();
$kv->init();
$msg = '';
if(isset($_GET['idshot']) && !empty($_GET['idshot'])){
	$s = $_GET['idshot'];
	if(strlen($s) == 8){
		$vo = $kv->get('url'.$s);
		if($vo){
			header('Location:'.$vo);
		}else{
			$msg = '<font style="color:#ff0000">对不起，您输入的地址不存在！</font>';
		}
	}else{
		$msg = '<font style="color:#ff0000">对不起，您输入的地址不存在！</font>';
	}
}else{
	if(isset($_POST['url']) && !empty($_POST['url'])){
		$url = $_POST['url'];
		if(url($url)){
			$msg = 'http://'.$_SERVER[HTTP_HOST].'/'.rand_str($url);
		}else{
			$msg = '<font style="color:#ff0000">对不起，您输入的网址有误！</font>';
		}
	}else{
		$msg = '<font style="font-size:14px;">请输入以“http://”或“https://”开头的有效链接址。</font>';
	}
}

function rand_str($url){
	$kv = new SaeKV();
	$kv->init();
	$index = $kv->get('umd'.md5($url));
	if($index){
		return $index;
	}else{
		do{
			$string = str();
			$vo = $kv->get('url'.$string);
		}while($vo);
		$kv->add('url'.$string,$url);
		$kv->add('umd'.md5($url),$string);
		return $string;
	}
}

function str(){
	$str = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$n = 8;
	$s = null;
	for($i=0;$i<$n;$i++){
		$s .=  $str[rand(0,strlen($str)-1)];
	}
	return $s;
}

function url($str){
	return preg_match('/^(http|https):\/\/[A-Za-z0-9]+\.[A-Za-z0-9]+[\/=\?%\-&_~`@[\]\':+!]*([^<>\"])*$/', $str);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>BriefURL 开源短地址系统 —— Hopeness</title>
<link rel="stylesheet" type="text/css" href="style/common.css" />
<!--[if IE 6]>
<script type="text/javascript" src="JavaScript/DD_belatedPNG.js" ></script>
<script type="text/javascript">DD_belatedPNG.fix('.top,.logo,.biglogo,.input,.submit,.msg,.hopeness');</script>
<![endif]-->
</head>
<body>
<div class="top">
	<div class="header">
		<div class="logo"><a href="http://<?php echo $_SERVER[HTTP_HOST]; ?>"></a></div>
		<div class="menu">
			<ul>
				<li><a href="about.php">About</a></li>
			</ul>
		</div>
	</div>
</div>
<div class="biglogo"></div>
	<form action="http://<?php echo $_SERVER[HTTP_HOST]?>" method="post">
		<div class="text">
			<div class="input">
				<input type="text" name="url" value="<? echo $_POST['url']; ?>" />
			</div>
			<div class="submit">
				<input type="submit" value="" />
			</div>
		</div>
	</form>
	<div class="msg">
		<div class="msg_body">
			<?=$msg;?>
		</div>
	</div>
<div class="bottom">
	<span>当前版本号：<?=$_SERVER['HTTP_APPVERSION'];?></span>
	<a class="hopeness" href="http://hopeness.sinaapp.com" target="_blank" title="Powered by Hopeness"></a>
	<a class="sae" href="http://sae.sina.com.cn" target="_blank"><img src="http://static.sae.sina.com.cn/image/poweredby/117X12px.gif" title="Powered by Sina App Engine"></a>
</div>
</body>
</html>