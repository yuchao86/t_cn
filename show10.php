<?
header("Content-type:text/html;charset=utf-8");
$kv = new SaeKV();
$kv->init();

$kv->delete('umd32597931de447d85c3a5ad51da998b48');

$ret = $kv->pkrget('url', 10);
var_dump($ret);
echo '<br/><br/>';
$umd = $kv->pkrget('umd', 10);
var_dump($umd);

?>