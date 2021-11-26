<?php
// 响应状态
$retCode = 200;
// 图片类型 bg,head,porn,phone
$imgType = $_GET['type'];
// 存储数据的文件
switch ($imgType) {
	case 'bg':
	case 'head':
	case 'porn':
	case 'phone':
	default:
		$filename = 'sinetxt.txt';
		break;
}
if (!file_exists($filename)) {
	die($filename . '数据文件不存在');
} else {
	// 读取资源文件
	$giturlArr = file($filename);
}
$giturlData = [];
// 将资源文件写入数组
foreach ($giturlArr as $key => $value) {
	$value = trim($value);
	if (!empty($value)) {
		$giturlData[] = trim($value);
	}
}
// 输出协议头
$sslType = $_GET['ssl'];
switch ($sslType) {
	case 'false':
		$ssl = 'http://';
		break;
	case 'auto':
		$ssl = '//';
		break;
	case 'true':
	default:
		$ssl = 'https://';
		break;
}
// 随机图片服务器
$server = rand(1, 4);
// 输出图片大小
$size_arr = array('large', 'mw1024', 'mw690', 'bmiddle', 'small', 'thumb180', 'thumbnail', 'square');
$size = !empty($_GET['size']) ? $_GET['size'] : 'large';
if (!in_array($size, $size_arr)) {
	$size = 'large';
}
// 随机获取一张
$randKey = rand(0, count($giturlData));
$sina_img = str_re($giturlData[$randKey]);
$imgurl = $ssl . 'tva' . $server . '.sinaimg.cn/' . $size . '/' . $sina_img;
// json格式
$json = array("ret" => $retCode);
$returnType = $_GET['return'];
switch ($returnType) {
		// 浏览器直接输出图片
	case 'img':
		$infoUrl = $ssl === '//' ? 'https:' . $imgurl : $imgurl;
		$img = file_get_contents($infoUrl, true);
		header("Content-Type:image/jpeg;");
		echo $img;
		break;
		// 随机输出图片链接
	case 'url':
		header('Content-type:text/plain');
		echo $imgurl;
		break;
		// 随机JSON输出10张图片
	case 'jsonpro':
		// 后面数字可改
		$randKeys = array_rand($giturlData, 10);
		$imgurls = [];
		foreach ($randKeys as $key) {
			$sina_img = str_re($giturlData[$key]);
			$imgurls[] = $ssl . '://tva' . $server . '.sinaimg.cn/' . $size . '/' . $sina_img;
		}
		$json['imgurls'] = $imgurls;
		header('Content-type:text/json');
		echo json_encode($json, JSON_PRETTY_PRINT);
		break;
		// JSON格式输出
	case 'json':
		$json['imgurl'] = $imgurl;
		$infoUrl = $ssl === '//' ? 'http:' . $imgurl : $imgurl;
		$imageInfo = getimagesize($infoUrl);
		$json['width'] = "$imageInfo[0]";
		$json['height'] = "$imageInfo[1]";
		header('Content-type:text/json');
		echo json_encode($json, JSON_PRETTY_PRINT);
		break;
		// 直接跳转
	default:
		header("Location:" . $imgurl);
		break;
}
// 文档字符串换行处理
function str_re($str)
{
	$str = str_replace(' ', "", $str);
	$str = str_replace("\n", "", $str);
	$str = str_replace("\t", "", $str);
	$str = str_replace("\r", "", $str);
	return $str;
}
