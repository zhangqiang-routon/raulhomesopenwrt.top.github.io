<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ERROR);

if ($_SESSION['channeladmin'] == 0) {
    exit("<script>$.alert({title: '警告',content: '你无权访问此页面。',type: 'orange',buttons: {confirm: {text: '确定',btnClass: 'btn-primary',action: function(){history.go(-1);}}}});</script>");
} 

?>

<?php
$categorytype = $_GET['type'];
// 对分类进行重新排序
function sort_id() {
    global $categorytype, $db;
    if ($categorytype == 'default') {
        $numCount = 1;
    } else if ($categorytype == 'province') {
        $numCount = 50;
    } else if ($categorytype == 'chinanet') {
        $numCount = 100;
    } else if ($categorytype == 'unicom') {
        $numCount = 150;
    } else if ($categorytype == 'cmcc') {
        $numCount = 200;
    } else if ($categorytype == 'vip') {
        $numCount = 250;
    } 
    $result = $db->mQuery("SELECT * from luo2888_category where type='$categorytype' order by id");
    while ($row = mysqli_fetch_array($result)) {
        $name = $row['name'];
        $db->mSet("luo2888_category", "id=$numCount", "where name='$name'");
        unset($name);
        $numCount++;
    } 
    unset($row);
	mysqli_free_result($result);
} 
sort_id();
// 检测上下移的ID参数是否存在
function chk_sort_id() {
    global $categorytype, $minid, $maxid, $db;
    if ($row = $db->mGetRow("luo2888_category", "min(id),max(id)", "where type='$categorytype'")) {
        $minid = $row['min(id)'];
        $maxid = $row['max(id)'];
    } 
} 
chk_sort_id(); 
// 增加频道列表
function add_channel_list($cname, $srclist) {
    global $db;
    if (!empty($srclist && $cname)) {
        $db->mDel("luo2888_channels", "where category='$cname'");
        $repetnum = 0;
        $rows = explode("\n", $srclist);
        $rows = preg_replace('# ,#', ',', $rows);
        $rows = preg_replace('#\r#', '', $rows);
        $rows = preg_replace('/高清/', '', $rows);
        $rows = preg_replace('/FHD/', '', $rows);
        $rows = preg_replace('/HD/', '', $rows);
        $rows = preg_replace('/SD/', '', $rows);
        $rows = preg_replace('/\[.*?\]/', '', $rows);
        $rows = preg_replace('/\#genre\#/', '', $rows);
        $rows = preg_replace('/ver\..*?\.m3u8/', '', $rows);
        $rows = preg_replace('/t\.me.*?\.m3u8/', '', $rows);
        $rows = preg_replace("/https(.*)www.bbsok.cf[^>]*/", "", $rows);
        foreach($rows as $row) {
            if (strpos($row, ',') !== false) {
                $ipos = strpos($row, ',');
                $channelname = substr($row, 0, $ipos);
                $source = substr($row, $ipos + 1);
                if (strpos($source, '#') !== false) {
                    $sources = explode("#", $source);
                    foreach ($sources as $src) {
                        $src2 = str_replace("\"", "", $src);
                        $src2 = str_replace("\'", "", $src2);
                        $src2 = str_replace("}", "", $src2);
                        $src2 = str_replace("{", "", $src2);
                        $channelurl = $db->mQuery("SELECT url from luo2888_channels");
                        while ($url = mysqli_fetch_array($channelurl)) {
                            if ($src2 == $url[0]) {
                                $src2 = '';
                                $repetnum++;
                            } 
                        } 
                        unset($url);
                        mysqli_free_result($channelurl);
                        if ($channelname != '' && $src2 != '') {
                            $db->mInt("luo2888_channels", "id,name,url,category", "NULL,'$channelname','$src2','$cname'");
                        } 
                    } 
                } else {
                    $src2 = str_replace("\"", "", $source);
                    $src2 = str_replace("\'", "", $src2);
                    $src2 = str_replace("}", "", $src2);
                    $src2 = str_replace("{", "", $src2);
                    $channelurl = $db->mQuery("SELECT url from luo2888_channels");
                    while ($url = mysqli_fetch_array($channelurl)) {
                        if ($src2 == $url[0]) {
                            $src2 = '';
                            $repetnum++;
                        } 
                    } 
                    unset($url);
					mysqli_free_result($channelurl);
                    if ($channelname != '' && $src2 != '') {
                        $db->mInt("luo2888_channels", "id,name,url,category", "NULL,'$channelname','$src2','$cname'");
                    } 
                } 
            } 
        } 
        unset($rows, $srclist);
        return $repetnum;
    } 
    return -1;
} 
// 获取分类名称
if (isset($_GET['category'])) {
    $cname = $_GET['category'];
} else {
    if ($row = $db->mGetRow("luo2888_category", "name", "order by id")) {
        $cname = $row['name'];
        unset($row);
    } else {
        $cname = '';
    } 
} 
// 修改频道列表
if (isset($_POST['submit']) && isset($_POST['category']) && isset($_POST['srclist'])) {
    $cname = $_POST['category'];
    $srclist = $_POST['srclist'];
    $showindex = $_POST['showindex'];
    $listreturn = add_channel_list($cname, $srclist);
    if ($listreturn != -1) {
        echo"<script>showindex=$showindex;lightyear.notify('保存成功！$listreturn 个重复节目源！', 'success', 3000);</script>";
    } else {
        echo"<script>showindex=$showindex;lightyear.notify('保存失败,列表不能为空！', 'danger', 3000);</script>";
    } 
    unset($srclist);
} 
// 增加分类
if (isset($_POST['submit']) && isset($_POST['category'])) {
    $category = $_POST['category'];
    $cpass = $_POST['cpass'];
    if ($category == "") {
        echo "<script>lightyear.notify('类别名称不能为空！', 'danger', 3000);</script>";
    } else {
        $numCount = $maxid + 1;
        $categoryname = $db->mGetRow("luo2888_category", "name", "where name='$category'");
        if (empty($categoryname)) {
            $db->mInt("luo2888_category", "id,name,psw,type", "$numCount,'$category','$cpass','$categorytype'");
            $showindex = $db->mGet("luo2888_category", "count(*)", "where type='$categorytype'") - 1;
            echo "<script>showindex=$showindex;lightyear.notify('增加类别$category 成功！', 'success', 3000);</script>";
            sort_id();
            mysqli_free_result($result);
            $cname = $category;
        } 
    } 
} 
// 增加外部列表
if (isset($_POST['addthirdlist'])) {
    $category = $_POST['thirdlistcategory'];
    $listurl = $_POST['thirdlisturl'];
    $srclist = file_get_contents($listurl);
    if ($category == "") {
        echo "<script>lightyear.notify('类别名称不能为空！', 'danger', 3000);</script>";
    } else {
        $numCount = $maxid + 1;
        $categoryname = $db->mGetRow("luo2888_category", "name", "where name='$category'");
        if (empty($categoryname)) {
            $db->mInt("luo2888_category", "id,name,psw,type,url", "$numCount,'$category','$cpass','$categorytype','$listurl'");
            $showindex = $db->mGet("luo2888_category", "count(*)", "where type='$categorytype'") - 1;
            $addlist = add_channel_list($category, $srclist);
            if ($addlist !== -1) {
                echo "<script>showindex=$showindex;lightyear.notify('增加列表$category 成功！', 'success', 3000);</script>";
            } else {
                echo "<script>showindex=$showindex;lightyear.notify('增加列表$category 失败！', 'danger', 3000);</script>";
                $db->mDel("luo2888_category", "where name='$category'");
            } 
            sort_id();
        } 
    } 
} 
// 更新外部列表
if (isset($_POST['updatelist'])) {
    $category = $_POST['thirdlist'];
	$listurl=$db->mGet("luo2888_category", "url", "where name='$category'");
    $srclist = file_get_contents($listurl);
    if ($category == "") {
        echo "<script>lightyear.notify('列表名称不能为空！', 'danger', 3000);</script>";
    } else {
        $listurl = $db->mGetRow("luo2888_category", "url", "where name='$category'");
        $addlist = add_channel_list($category, $srclist);
        if ($addlist !== -1) {
            echo "<script>$.alert({title: '成功',content: '更新列表$category 成功！',type: 'green',buttons: {confirm: {text: '好',btnClass: 'btn-primary',action: function(){location.replace(location.href);}}}});</script>";
        } else {
            echo "<script>$.alert({title: '成功',content: '更新列表$category 失败！',type: 'green',buttons: {confirm: {text: '好',btnClass: 'btn-primary',action: function(){location.replace(location.href);}}}});</script>";
        } 
    } 
} 
// 删除分类
if (isset($_POST['submit_deltype']) && isset($_POST['category'])) {
    $category = $_POST['category'];
    $showindex = $_POST['showindex'];
    if ($category == "") {
        echo "<script>lightyear.notify('类别名称不能为空！', 'danger', 3000);</script>";
    } else {
        if ($categoryid = $db->mGet("luo2888_category", "id", "where name='$category'")) {
            $db->mSet("luo2888_category", "id=id-1", "where id>$categoryid");
        } 
        $db->mDel("luo2888_category", "where name='$category'");
        $db->mDel("luo2888_channels", "where category='$category'");
        sort_id();
        echo "<script>showindex=$showindex-1;lightyear.notify('$category 删除成功！', 'success', 3000);</script>";
    } 
} 
// 修改分类
if (isset($_POST['submit_modifytype']) && isset($_POST['category'])) {
    $category = $_POST['category'];
    $cpass = $_POST['cpass'];
    $showindex = $_POST['showindex'];
    $category0 = $_POST['typename0'];
    if ($category == "") {
        echo "<script>lightyear.notify('类别名称不能为空！', 'danger', 3000);</script>";
    } else {
        $db->mSet("luo2888_category", "name='$category',psw='$cpass'", "where name='$category0'");
        $db->mSet("luo2888_channels", "category='$category'", "where category='$category0'");
        echo "<script>showindex=$showindex;lightyear.notify('$category 修改成功！', 'success', 3000);</script>";
        $cname = $category;
    } 
} 
// 上移分类
if (isset($_POST['submit_moveup']) && isset($_POST['category'])) {
    $category = $_POST['category'];
    $showindex = $_POST['showindex'];
    if ($id = $db->mGet("luo2888_category", "id", "where name='$category'")) {
        $preid = $id-1;
        if ($preid >= $minid) {
            $db->mSet("luo2888_category", "id=id+1", "where id=$preid");
            $db->mSet("luo2888_category", "id=id-1", "where name='$category'");
            echo "<script>showindex=$showindex-1;</script>";
        } else {
            echo "<script>showindex=$showindex-1;lightyear.notify('已经上移到最顶了！', 'danger', 3000);</script>";
        } 
    } 
} 
// 下移分类
if (isset($_POST['submit_movedown']) && isset($_POST['category'])) {
    $category = $_POST['category'];
    $showindex = $_POST['showindex'];
    if ($id = $db->mGet("luo2888_category", "id", "where name='$category'")) {
        $nextid = $id + 1;
        if ($nextid <= $maxid) {
            $db->mSet("luo2888_category", "id=id-1", "where id=$nextid");
            $db->mSet("luo2888_category", "id=id+1", "where name='$category'");
            echo "<script>showindex=$showindex+1;</script>";
        } else {
            echo "<script>showindex=$showindex;lightyear.notify('已经下移到最底了！', 'danger', 3000);</script>";
        } 
    } 
} 
// 置顶分类
if (isset($_POST['submit_movetop']) && isset($_POST['category'])) {
    $category = $_POST['category'];
    if ($id = $db->mGet("luo2888_category", "Min(id)", "where type='$categorytype'")) {
        $id = $id-1;
        $db->mSet("luo2888_category", "id=$id", "where name='$category'");
        sort_id();
        echo "<script>showindex=0;</script>";
    } 
} 
// 列表设置
if (isset($_POST['submit']) && isset($_POST['ver'])) {
    $updateinterval = $_POST['updateinterval'];
    if (isset($_POST['autoupdate'])) {
		$db->mSet("luo2888_config", "value='1'", "where name='autoupdate'");
		$db->mSet("luo2888_config", "value='$updateinterval'", "where name='updateinterval'");
    } else {
        $ver = $_POST['ver'];
		$db->mSet("luo2888_config", "value='0'", "where name='autoupdate'");
		$db->mSet("luo2888_config", "value='$ver'", "where name='dataver'");
    } 
    echo "<script>lightyear.notify('保存成功！', 'success', 3000);</script>";
} 
// 分类开关
if (isset($_POST['checkpdname'])) {
    $db->mSet("luo2888_category", "enable=0");
    foreach ($_POST['enable'] as $categoryenable) {
        $db->mSet("luo2888_category", "enable=1", "where name='$categoryenable'");
    } 
} 
// 获取列表设置
$ver = $db->mGet("luo2888_config", "value", "where name='dataver'");
$versionname = $db->mGet("luo2888_config", "value", "where name='appver'");
$autoupdate = $db->mGet("luo2888_config", "value", "where name='autoupdate'");
$updateinterval = $db->mGet("luo2888_config", "value", "where name='updateinterval'");

if ($autoupdate == 1) {
    $checktext = "checked='true'";
} else {
    $checktext = '';
} 

?>