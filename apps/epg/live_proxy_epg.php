<?php
header("Content-Type:application/json;chartset=uft-8");
include_once "proxy_chk.php";
include_once "curl.class.php";
include_once "caches.class.php";

$cachedir = "./cache";
if (! is_dir ($cachedir)) {
    @mkdir ($cachedir, 0755, true) or die ('创建文件夹失败');
} 
$id = !empty($_GET["id"])?$_GET["id"]:exit(json_encode(["code" => 500, "msg" => "EPG频道参数不能为空!", "name" => $name, "date" => null, "data" => null], JSON_UNESCAPED_UNICODE));
echo out_epg($id);
exit;
// 输出EPG节目地址
function out_epg($id) {
    $tvdata = channel($id);
    $tvid = $tvdata['id'];
    $epgid = $tvdata['name'];

    if (!is_numeric($tvid)) {
        return $tvid;
    } 

    $tt = cache("time_out_chk", "cache_time_out"); //获取当前时间（后天）的00:00时间戳
    if (time() >= $tt) {
        Cache::$cache_path = "./cache/"; 
        // 删除除当前目录缓存文件
        Cache::dels(); 
        // 重新写入当天时间缓存文件
        cache("time_out_chk", "cache_time_out");
    } 
    if(strstr($epgid,"tvming") != false) {
    	$ejson = get_epg_data($tvid, $epgid, $id);
    } else {
    	$ejson = cache($tvid, "get_epg_data", [$tvid, $epgid, $id]);
    }
    
    return $ejson;
} 
// 缓存EPG节目数据
function cache($key, $f_name, $ff = []) {
    Cache::$cache_path = "./cache/";
    $val = Cache::gets($key);
    if (!$val) {
        $data = call_user_func_array($f_name, $ff);
        Cache::put($key, $data);
        return $data;
    } else {
        return $val;
    } 
} 

function cache_time_out() {
    date_default_timezone_set("Asia/Shanghai");
    $tt = strtotime(date("Y-m-d 00:00:00", time())) + 86400;
    return $tt;
} 
// 请求频道的EPG数据
// CNTV
function get_epg_data($tvid, $epgid, $name = "", $date = "") {
    if (strstr($epgid, "cntv") != false) {
        $url = "https://api.cntv.cn/epg/epginfo?serviceId=cbox&c=" . substr($epgid, 5) . "&d=" . date('Ymd');
        $str = curl::c()->set_ssl()->get($url);
        $re = json_decode($str, true);
        if (!empty($re[substr($epgid, 5)]['program'])) {
            $data = array("code" => 200, "msg" => "请求成功!", "name" => $re[substr($epgid, 5)]['channelName'], "tvid" => $tvid, "date" => date('Y-m-d'));
            foreach($re[substr($epgid, 5)]['program'] as $row) {
                $data["data"][] = array("name" => $row['t'], "starttime" => $row['showTime']);
            } 
            return json_encode($data, JSON_UNESCAPED_UNICODE);
        } 
        $data = ["code" => 500, "msg" => "请求失败!", "name" => $name, "date" => null, "data" => null];
        return json_encode($data, JSON_UNESCAPED_UNICODE);
        // 极速数据
    } else if (strstr($epgid, "jisu") != false) {
        $appkey = get_config('jisuapi_key');;
        $url = "https://api.jisuapi.com/tv/query?appkey=" . $appkey . "&tvid=" . substr($epgid, 5) . "&date=" . date('Y-m-d');
        $str = curl::c()->set_ssl()->get($url);
        $re = json_decode($str, true);
        if ($re["status"] == 0) {
            $data = [];
            $data["code"] = 200;
            $data["msg"] = "请求成功!";
            $data["name"] = $re["result"]["name"];
            $data["tvid"] = $re["result"]["tvid"];
            $data["date"] = $re["result"]["date"];
            $data["data"] = $re["result"]["program"];
            return json_encode($data, JSON_UNESCAPED_UNICODE);
        } 
        $data = ["code" => 500, "msg" => "请求失败!", "name" => $name, "date" => null, "data" => null];
        return json_encode($data, JSON_UNESCAPED_UNICODE);
        // 搜视网
    } else if (strstr($epgid, "tvsou") != false) {
        $wday = intval(date('w', strtotime(date('Y-m-d'))));
        if ($wday == 0)$wday = 7;
        $url = "https://www.tvsou.com/epg/" . substr($epgid, 6) . "/w" . $wday;
        $file = curl::c()->set_ssl()->get($url);
        $file = strstr($file, "<tbody>");
        $pos = strpos($file, "</tbody>");
        $file = substr($file, 0, $pos);
        $file = preg_replace(array("/<script[\s\S]*?<\/script>/i", "/<a .*?href='(.*?)'.*?>/is", "/<tbody>/i", "/<\/a>/i"), '', $file);
        $file = trim($file);
        $file = str_replace("</td><td style='width: 100px;'></td></tr> <tr><td>", '|', $file);
        $file = str_replace("</td><td style='width: 100px;'></td></tr>", '', $file);
        $file = str_replace("<tr><td>", '', $file);
        $file = str_replace("</td><td>", '#', $file);
        $preview = $file;
        if (!empty($preview)) {
            $data = array("code" => 200, "msg" => "请求成功!", "name" => $name, "tvid" => $tvid, "date" => date('Y-m-d'));
            $preview = explode('|', $preview);
            foreach($preview as $row) {
                $row1 = explode('#', $row);
                $data["data"][] = array("name" => $row1[1], "starttime" => $row1[0]);
            } 
            return json_encode($data, JSON_UNESCAPED_UNICODE);;
        } 
        $data = ["code" => 500, "msg" => "请求失败!", "name" => $name, "date" => null, "data" => null];
        return json_encode($data, JSON_UNESCAPED_UNICODE);
        // 电视猫
    } else if (strstr($epgid, "tvmao") != false) {
        $keyStr = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";
        $wday = intval(date('w', strtotime(date('Y-m-d'))));
        if ($wday == 0)
            $wday = 7;
        $str = curl::c()->set_ssl()->get("https://m.tvmao.com/program/" . substr($epgid, 6) . "-w" . $wday . ".html");
        preg_match('#action="/query.jsp" q="(\w+)" a="(\w+)"#', $str, $id);
        preg_match('#name="submit" id="(\w+)"#', $str, $id1);
        $str1 = curl::c()->set_ssl()->get("https://m.tvmao.com/api/pg?p=" . $keyStr[$wday * $wday] . base64_encode($id1[1] . "|" . $id[2]) . base64_encode("|" . $id[1]));
        $str1 = preg_replace(array('/<tr[^>]*>/i', '/<td[^>]*>/i', '/<div[^>]*>/i', '/<a[^>]*>/i'), '', $str1);
        $str1 = str_replace("<\/a>", '', $str1);
        $str1 = str_replace("<\/div><\/td>", '#', $str1);
        $str1 = str_replace("<\/td><\/tr>", '|', $str1);
        $str1 = str_replace('[1,"', '', $str1);
        $str1 = str_replace('"]', '', $str1);
        $str1 = str_replace('\n', '', $str1);
        $str1 = substr($str1, 0, strlen($str1)-1);
        $preview = $str1;
        if (!empty($preview)) {
            $data = array("code" => 200, "msg" => "请求成功!", "name" => $name, "tvid" => $tvid, "date" => date('Y-m-d'));
            $preview = explode('|', $preview);
            foreach($preview as $row) {
                $row1 = explode('#', $row);
                $data["data"][] = array("name" => $row1[1], "starttime" => $row1[0]);
            } 
            return json_encode($data, JSON_UNESCAPED_UNICODE);
        } 
        // echo "失败";
        return json_encode($data, JSON_UNESCAPED_UNICODE);
        // 天脉聚源
	} else if(strstr($epgid,"tvming") != false) {
		$url = "http://stream.suntv.sungole.com/approve/epginfo?channel=";
		$str = curl::c()->set_ssl()->get($url.substr($epgid, 7));
		$xml = simplexml_load_string($str);
		$arr = json_encode($xml);
		$arr = json_decode($arr,true);
        if (!empty($arr)) {
            $data = array("code" => 200, "msg" => "请求成功!", "name" => $name, "tvid" => $tvid, "date" => date('Y-m-d'));
				foreach($arr["epg"][0]["program"] as &$val) {
	                $epgarr[] = array("name" => $val["title"], "starttime" => date("H:i", $val["start_time"]));
				}
				$data["data"]= array_reverse($epgarr);
        } else {
        	$data = ["code" => 500, "msg" => "请求失败!", "name" => $name, "date" => null, "data" => null]; 
        }
        return json_encode($data, JSON_UNESCAPED_UNICODE);
        // 51zmt
    } else if (strstr($epgid, "51zmt") != false) {
        $cachefile = "./cache/51zmt.xml";
        $url = "http://epg.51zmt.top:8000/e.xml";
        if (file_exists($cachefile)) {
            $filemtime = filemtime ($cachefile);
            if (time() - $filemtime >= 259200) {
                unlink($cachefile);
                $file = curl::c()->get($url);
                file_put_contents($cachefile, $file) ;
            } 
        } else {
            $file = curl::c()->get($url);
            file_put_contents($cachefile, $file) ;
        } 
        $xml = simplexml_load_file($cachefile);
        $xml = json_encode($xml);
        $xml = json_decode($xml, true);
        $arr = $channel = $epgdata = $result = array();
        foreach($xml['channel'] as $row) {
            $channel['data'][] = array('id' => $row['@attributes']['id'], 'name' => $row['display-name']);
        } 
        foreach($channel['data'] as $key => $value) {
            foreach ($value as $valu) {
                if (substr($epgid, 6) == $valu) {
                    array_push($arr, $key);
                } 
            } 
        } 
        foreach ($arr as $key => $value) {
            if (array_key_exists($value, $channel['data'])) {
                array_push($result, $channel['data'][$value]);
            } 
        } 
        foreach($xml['programme'] as $row) {
            $epgdata[] = array('id' => $row['@attributes']['channel'], "start" => $row['@attributes']['start'], 'title' => $row['title']);
        } 
        if (!empty($epgdata)) {
            $data = array("code" => 200, "msg" => "请求成功!", "name" => $name, "tvid" => $tvid, "date" => date('Y-m-d'));
            foreach($epgdata as $row) {
                if ($row['id'] == $result[0]['id']) {
                    $data["data"][] = array("name" => $row['title'], "starttime" => preg_replace('{^(\d{4})(\d{2})(\d{2})(\d{2})(\d{2})(\d{2})(.*?)$}u', '$4:$5', $row["start"]));
                } 
            } 
            return json_encode($data, JSON_UNESCAPED_UNICODE);
        } 
        $data = ["code" => 500, "msg" => "请求失败!", "name" => $name, "date" => null, "data" => null];
        return json_encode($data, JSON_UNESCAPED_UNICODE);
    } 
} 
// 频道映射对应表
function channel($id) {
    global $db;
    $id = urldecode($id);
    if ($row = $db->mGetRow("luo2888_epg", "*", "where status=1 AND FIND_IN_SET('$id',content)")) {
        return $row;
    } else {
        $data = ["code" => 500, "msg" => "频道不存在!", "name" => null, "date" => null, "data" => null];
        exit(json_encode($data, JSON_UNESCAPED_UNICODE));
    } 
} 

?>