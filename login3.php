<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ERROR);

require_once "aes.php";
require_once "config.php";
$db = Config::GetIntance();

if (isset($_GET['id'])) {
    $androidid = $_GET['id'];
    $mealid = $db->mGet("luo2888_users", "meal", "where deviceid='$androidid'");
    $mealname = $db->mGet("luo2888_meals", "name", "where id='$mealid'");
    echo $mealname;
} 

if (isset($_POST['login'])) {
    $GetIP = new GetIP();
    $ip = $GetIP->getuserip();
    $num = $db->mGet("luo2888_users", "count(*)", "where ip='$ip'");
    if ($num >= $db->mGet("luo2888_config", "value", "where name='max_sameip_user'")) {
        header('HTTP/1.1 403 Forbidden');
        exit();
    } else {
        $json = $_POST['login'];
        $obj = json_decode($json);
        $region = $obj->region;
        $androidid = $obj->androidid;
        $mac = $obj->mac;
        $model = $obj->model;
        $nettype = $obj->nettype;
        $appname = $obj->appname; 
        if ($ip == '' || $ip == '127.0.0.1') {
	        $ip = '127.0.0.1';
	        $region = 'localhost'; 
        }
        if (empty($region)) {
            $myurl = 'http://' . $_SERVER['HTTP_HOST'];
            $json = file_get_contents("$myurl/getIpInfo.php?ip=$ip");
            $obj = json_decode($json);
            $region = $obj->data->region . $obj->data->city . $obj->data->isp;
        } 
        function genName() {
            global $db;
            $name = rand(1000, 999999);
            $result = $db->mGet("luo2888_users", "*", "where name=$name");
            if (!$result) {
                unset($result);
                return $name;
            } else {
                genName();
            } 
        } 
        // status=1,正常用户；
        // status=0,停用用户;
        // status=-1,未授权用户
        // status=999为永不到期
        $nowtime = time(); 
        // 没有mac禁止登陆
	    if(strstr($mac,"获取地址失败") != false) {
	        header('HTTP/1.1 403 Forbidden');
	        exit();
	    }
        // mac是否匹配
        if ($row = $db->mCheckRow("luo2888_users", "name,status,exp,deviceid,mac,model,meal", "where mac='$mac'")) {
            // 匹配成功
            $days = ceil(($row['exp'] - time()) / 86400);
            $status = intval($row['status']);
            $name = $row['name'];
            $deviceid = $row['deviceid'];
            $mealid = $row['meal'];
            $exp = $row["exp"]; //收视期限，时间戳
            $status2 = $status;
            if ($days > 0 && $status == -1) {
                $status = 1;
            } else if ($status2 == -999) {
                $status = 1;
            } 
            if ($deviceid != $androidid){
            	$db->mSet("luo2888_users", "deviceid='$androidid',idchange=idchange+1", "where mac='$mac'"); 
            }
            // 更新位置，登陆时间
            $db->mSet("luo2888_users", "region='$region',ip='$ip',lasttime=$nowtime", "where mac='$mac'"); 
        } else {
            // 用户验证失败，识别用户信息存入后台
            $name = genName();
            $days = $db->mGet("luo2888_config", "value", "where name='trialdays'");
            if (empty($days)) {
                $days = 0;
            } 
            if ($days > 0) {
                $status = -1;
                $marks = '试用';
            } else if ($days == "-999") {
                $status = -999;
                $marks = '免费';
                $days = 3;
            } else {
                $status = -1;
                $marks = '未授权';
            } 
            $mealid = 1000;
            $status2 = $status;
            $exp = strtotime(date("Y-m-d"), time()) + 86400 * $days;
            $db->mInt("luo2888_users", "name,mac,deviceid,model,exp,ip,status,region,lasttime,marks", "$name,'$mac','$androidid','$model',$exp,'$ip',$status,'$region',$nowtime,'$marks'");
            if ($days > 0 && $status == -1) {
                $status = 1;
            } else if ($status2 == -999) {
                $status = 1;
            } 
        } 
        unset($row);

        $app_appname = $db->mGet("luo2888_config", "value", "where name='app_appname'");
        $dataver = $db->mGet("luo2888_config", "value", "where name='dataver'");
        $appUrl = $db->mGet("luo2888_config", "value", "where name='appurl'");
        $appver = $db->mGet("luo2888_config", "value", "where name='appver'");
        $setver = $db->mGet("luo2888_config", "value", "where name='setver'");
        $adinfo = $db->mGet("luo2888_config", "value", "where name='adinfo'");
        $adtext = $db->mGet("luo2888_config", "value", "where name='adtext'");
        $showwea = $db->mGet("luo2888_config", "value", "where name='showwea'");
        $showtime = $db->mGet("luo2888_config", "value", "where name='showtime'");
        $showinterval = $db->mGet("luo2888_config", "value", "where name='showinterval'");
        $decoder = $db->mGet("luo2888_config", "value", "where name='decoder'");
        $buffTimeOut = $db->mGet("luo2888_config", "value", "where name='buffTimeOut'");
        $needauthor = $db->mGet("luo2888_config", "value", "where name='needauthor'");
        $autoupdate = $db->mGet("luo2888_config", "value", "where name='autoupdate'");
        $randkey = $db->mGet("luo2888_config", "value", "where name='randkey'");
        $updateinterval = $db->mGet("luo2888_config", "value", "where name='updateinterval'");
        $tiploading = $db->mGet("luo2888_config", "value", "where name='tiploading'");
        $tipusernoreg = $db->mGet("luo2888_config", "value", "where name='tipusernoreg'");
        $tipuserexpired = '当前账号' . $name . '，' . $db->mGet("luo2888_config", "value", "where name='tipuserexpired'");
        $tipuserforbidden = '当前账号' . $name . '，' . $db->mGet("luo2888_config", "value", "where name='tipuserforbidden'");
        $url = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER["REQUEST_URI"];
        $dataurl = dirname($url) . "/data.php";

        if ($needauthor == 0 || ($status2 == -999)) {
            $status = 999;
        } 

        $mealname = $db->mGet("luo2888_meals", "name", "where id='$mealid'");
        $adtext = '尊敬的用户，欢迎使用' . $app_appname . '，当前套餐：' . $mealname . '。' . $adtext;

        if ($showwea == 1) {
            $weaapi_id = $db->mGet("luo2888_config", "value", "where name='weaapi_id'");
            $weaapi_key = $db->mGet("luo2888_config", "value", "where name='weaapi_key'");
            $url = "https://www.tianqiapi.com/api?version=v6&appid=$weaapi_id&appsecret=$weaapi_key&ip=$ip";
            $weajson = file_get_contents($url);
            $obj = json_decode($weajson);
            if (!empty($obj->city)) {
                $weather = date('今天n月d号') . $obj->week . '，' . $obj->city . '，' . $obj->tem . '℃' . $obj->wea . '，' . '气温:' . $obj->tem2 . '℃' . '～' . $obj->tem1 . '℃' . '，' . $obj->win . $obj->win_speed . '，' . '相对湿度:' . $obj->humidity . '，' . '空气质量:' . $obj->air_level . '。';
                $adtext = $adtext . $weather;
            } 
        } 

        if ($status < 1) {
            $dataurl = '';
            $appUrl = '';
        } 
		
		
		$movieengine = '{
			"model": [';
		$result=$db->mQuery("select * from eztv_movie");
		while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
			if($row["state"]==1||$row["state"]=='1'){
				$movieengine.='{"name": "'.$row["name"].'","api": "'.$row["api"].'"}';
			}
		}
		mysqli_free_result($result);
		//点播采集站，自己配置就好了
		$movieengine.=']}';
		//$movieengine="";//设置为空，默认用软件自带的采集站，
		
		

        $result = $db->mQuery("SELECT name from luo2888_category where enable=1 and type='province' order by id");
        while ($row = mysqli_fetch_array($result)) {
            $arrprov[] = $row[0];
        } 
        $arrcanseek[] = '';
        $objres = array('movieengine' => $movieengine,'status' => $status, 'mealname' => $mealname, 'dataurl' => $dataurl, 'appurl' => $appUrl, 'dataver' => $dataver, 'appver' => $appver, 'setver' => $setver, 'adtext' => $adtext, 'showinterval' => $showinterval, 'categoryCount' => 0, 'exp' => $days, 'ip' => $ip, 'showtime' => $showtime , 'provlist' => $arrprov, 'canseeklist' => $arrcanseek, 'id' => $name, 'decoder' => $decoder, 'buffTimeOut' => $buffTimeOut, 'tipusernoreg' => $tipusernoreg, 'tiploading' => $tiploading, 'tipuserforbidden' => $tipuserforbidden, 'tipuserexpired' => $tipuserexpired, 'qqinfo' => $adinfo, 'arrsrc' => $src, 'arrproxy' => $proxy, 'location' => $region, 'nettype' => $nettype, 'autoupdate' => $autoupdate, 'updateinterval' => $updateinterval, 'randkey' => $randkey, 'exps' => $exp, 'stus' => $stus);

        $objres = str_replace("\\/", "/", json_encode($objres, JSON_UNESCAPED_UNICODE)); 
        $key = substr($key, 5, 16);
        $aes2 = new Aes($key);
        $encrypted = $aes2->encrypt($objres);
        mysqli_free_result($result);
        unset($arrprov, $objres);
        echo $encrypted;
    } 
} else {
    exit();
} 

?>