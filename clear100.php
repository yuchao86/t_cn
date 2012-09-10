<?
header('Content-type:text/html;charset=utf-8');
$kv = new SaeKV();
$kv->init();

$ret = $kv->pkrget('url', 100);
foreach($ret as $k=>$v){
	$kv->delete($k);
	$kv->delete('umd'.md5($v));
}
echo '删除成功！';
?>