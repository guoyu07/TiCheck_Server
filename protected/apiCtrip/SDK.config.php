<?php
//定义本系统的相对路径根部
if(!defined('ABSPATH') )
{
	define('ABSPATH',dirname(__FILE__).'/');
}
$isSiteConfigPHP=false;
if(file_exists(ABSPATH."appData/site.config.php"))
{
	$isSiteConfigPHP=true;
    include_once (ABSPATH."appData/site.config.php");
}
if($isSiteConfigPHP&&$SiteAllianceid!=""&&$SiteSid!=""&&$SiteSiteKey!=""&&$SiteAllianceid_Uid!="")
{
	//site.config.php中配置联盟信息后，启用站点的配置信息
	define('Allianceid',$SiteAllianceid);
	define('Sid',$SiteSid);
	define('SiteKey',$SiteSiteKey);
	define('Allianceid_Uid',$SiteAllianceid_Uid);
	define('UnionSite_ShortName',urlencode($UnionSite_ShortName));//定义网站发短信通知时的简称
}
else{
//预置的联盟信息，如果site.config.php中没有配置联盟信息，则用默认的（PHPSDK预置有联盟信息）
//定义分销联盟的AID
if(!defined('Allianceid')) {
		define('Allianceid','4341');
}
//定义分销联盟的SID
if(!defined('Sid')) {
	define('Sid','439437');
}
//定义分销联盟的key
if(!defined('SiteKey')) {
	define('SiteKey','ED2C1865-E81C-424E-A05C-5DEE7DFF92EB');//abcDFG645354
}
 
//预置的联盟信息，如果site.config.php中没有配置联盟信息，则用默认的（PHPSDK预置有联盟信息）
}
$ServiceUrlCtripOpenAPI="http://openapi.ctrip.com";
//定义酒店直接查询接口的URL
if(!defined('D_HotelSearch_Url')) {
	define('D_HotelSearch_Url',$ServiceUrlCtripOpenAPI.'/flight/D_HotelSearch.asmx');
}
//定义酒店详细查询接口的URL
if(!defined('D_HotelDetail_Url')) {
	define('D_HotelDetail_Url',$ServiceUrlCtripOpenAPI.'/flight/D_HotelDetail.asmx');
}
//定义酒店评价接口的URL
if(!defined('D_HotelCommentList_Url')) {
	define('D_HotelCommentList_Url',$ServiceUrlCtripOpenAPI.'/flight/D_HotelCommentList.asmx');
}
//定义酒店评价接口的URL-带有分页功能
if(!defined('D_HotelCommentListPage_Url')) {
	define('D_HotelCommentListPage_Url',$ServiceUrlCtripOpenAPI.'/flight/D_HotelCommentListWithPage.asmx');
}

//定义酒店团购接口的URL
if(!defined('GroupProductList_Url')) {
	define('GroupProductList_Url',$ServiceUrlCtripOpenAPI.'/tuan/GroupProductList.asmx');
}
//定义酒店团购详细接口的URL
if(!defined('GroupProductInfo_Url')) {
	define('GroupProductInfo_Url',$ServiceUrlCtripOpenAPI.'/tuan/GroupProductInfo.asmx');
}
//定义酒店订单列表的URL
if(!defined('D_HotelOrderList_Url')) {
	define('D_HotelOrderList_Url',$ServiceUrlCtripOpenAPI.'/flight/D_HotelOrderList.asmx');
}
//定义酒店订单详细的URL
if(!defined('D_HotelOrderDetail_Url')) {
	define('D_HotelOrderDetail_Url',$ServiceUrlCtripOpenAPI.'/flight/D_HotelOrderDetail.asmx');
}
//定义获取“检查并生成外部UserUniqueID”的URL
if(!defined('OTA_UserUniqueID_Url')) {
	define('OTA_UserUniqueID_Url',$ServiceUrlCtripOpenAPI.'/flight/OTA_UserUniqueID.asmx');
}

//定义获取订单取消的URL
if(!defined('OTA_OrderCancel_Url')) {
	define('OTA_OrderCancel_Url',$ServiceUrlCtripOpenAPI.'/flight/OTA_Cancel.asmx');
}

//定义国内机票查询接口的URL
if(!defined('OTA_FlightSearch_Url')) {
	define('OTA_FlightSearch_Url',$ServiceUrlCtripOpenAPI.'/Flight/DomesticFlight/OTA_FlightSearch.asmx');
}
//定义测试接口地址
if(!defined('OTA_Ping_Url')) {
	define('OTA_Ping_Url',$ServiceUrlCtripOpenAPI.'/Hotel/OTA_Ping.asmx');
}
//定义酒店周边信息接口地址
if(!defined('D_HotelNearbyInfo_Url')) {
	define('D_HotelNearbyInfo_Url',$ServiceUrlCtripOpenAPI.'/Hotel/D_HotelNearbyInfo.asmx');
}
//定义酒店点评关键字接口地址
if(!defined('D_HotelCommentKey_Url')) {
	define('D_HotelCommentKey_Url',$ServiceUrlCtripOpenAPI.'/Hotel/D_HotelCommentKey.asmx');
}
//定义最新热门酒店点评接口地址
if(!defined('D_HotelHotComment_Url')) {
	define('D_HotelHotComment_Url',$ServiceUrlCtripOpenAPI.'/Hotel/D_HotelHotComment.asmx');
}
//定义品牌的城市分布接口地址
if(!defined('D_GetBrandCityRequest_Url')) {
	define('D_GetBrandCityRequest_Url',$ServiceUrlCtripOpenAPI.'/Hotel/D_GetBrandCityRequest.asmx');
}


//定义本系统的对于API2.0采用的请求模式：httpRequest/soap(如果PHP的服务器上没有开启支持SOAP的功能，则用httpRequest)
if(!defined('System_RequestType')) {
	define('System_RequestType', 'httpRequest');//soap  httpRequest
}

//定义首页团购获取距离今天多少天内的产品
if(!defined('TuanEndDate_Distance')) {
	define('TuanEndDate_Distance','7');
}

//添加分销权限控制类
include_once (ABSPATH.'Common/rightControl.php');
//添加请求控制类（http请求还是soap请求）
include_once (ABSPATH.'Common/commonRequestData.php');
//工具类
include_once (ABSPATH.'Common/toolExt.php');
//http请求模式类
include_once (ABSPATH.'Common/httpRequestData.php');
//soap请求模式类
include_once (ABSPATH.'Common/soapData.php');
//http请求的类
include_once (ABSPATH.'Common/HttpRequest.php');
//工具类
include_once (ABSPATH.'Common/getDate.php');
//解析酒店API2.0返回的字符串为XML
include_once (ABSPATH.'Common/RequestDomXml.php');
?>
