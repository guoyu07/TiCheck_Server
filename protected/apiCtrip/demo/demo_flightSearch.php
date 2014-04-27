<!Doctype html> 
<meta http-equiv="Content-Type" content="text/html;charset=UTF8">
<?php
/**
 * 飞机票搜索测试Demo
 */
include_once ('../SDK.config.php');//配置文件加载--必须加载这个文件
include_once (ABSPATH.'sdk/API/Flight/D_FlightSearch.php');//加载D_FlightSearch这个接口的封装类
//include_once(ABSPATH."include/urlRewrite.php");//加载URL伪静态处理
//构造请求

$D_FlightSearch=new get_D_FLightSearch();
$D_FlightSearch->DepartCity="SHA";
$D_FlightSearch->ArriveCity="BJS";
$D_FlightSearch->DepartDate="2014-05-03";
//$D_FlightSearch->EarliestDepartTime="2014-05-01";
//$D_FlightSearch->LatestDepartTime="2014-05-07";
$D_FlightSearch->AirlineDibitCode="CA";
$D_FlightSearch->IsLowestPrice="false";
$D_FlightSearch->OrderBy="Price";
$D_FlightSearch->main();
$returnXML=$D_FlightSearch->ResponseXML;//返回的数据是一个XML
//可以将返回的数据直接用json转换一下，打印出来，方便查看节点名称和数据
//echo  json_encode($returnXML);
//echo $returnXML->DomesticFlightData;
//echo json_encode($returnXML->FlightSearchResponse->FlightRoutes->DomesticFlightRoute->RecordCount);
$flights = $returnXML->FlightSearchResponse->FlightRoutes->DomesticFlightRoute->FlightsList;
//echo json_encode($flights);
var_dump($returnXML);
?>
</html>
