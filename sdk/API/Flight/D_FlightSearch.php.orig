<?php
/**
 * 请求D_FlightSearch的服务（酒店列表查询）
 */
class get_D_FlightSearch{
	/**
	 * @var 航程类型：string类型；必填；S（单程）D（往返程）M（联程）
	 */
	var $SearchType="";
	/**
	 * @var 航程列表
	 */
	var $Routes="";
	/**
	 * @var 出发城市：目前仅支持城市三字码 如北京：BJS,上海：SHA
	 */
	var $DepartCity="";
	/**
	 * @var 到达城市：目前仅支持城市三字码 如北京：BJS,上海：SHA
	 */
	var $ArriveCity="";
	/**
	 *@var 出发日期：yyyy-MM-dd （或yyyy-MM-ddThh:mm:ss）格式日期
	 */
	var $DepartDate="";
	/**
	 * @var 航空公司二字码
	 */
	var $AirlineDibitCode="";
	/**
	 * @var 出发机场三字码 上海：SHA 或 PVG
	 */
	var $DepartPort="";
	/**
	 *@var 到达机场三字码 北京：PEK 或 NAY 
	 */
	var $ArrivePort="";
	/**
	 * @var 最早起飞时间 2013-05-20T08:00:00
	 */
	var $EarliestDepartTime="";
	/**
	 * @var 最晚起飞时间 2013-05-20T12:00:00
	 */
	var $LatestDepartTime="";
	/**
	 *@var 送票城市：string类型；可空；缺省默认出发城市
	 */
	var $SendTicketCity="";
	/**
	 *	以下请求选项会减少响应数据，并且增加开销，响应时间会有所增加
	 */
	/**
	 * @var 返回简单响应（历史版本使用过，非常规请求项）
	 */
	var $IsSimpleResponse="";
	/**
	 *@var 是否只返回每个航班最低价记录
	 */
	var $IsLowestPrice="";
	/**
	 *@var 产品价格类型筛选选项 NormalPrice：普通政策，SingleTripPrice: 提前预售特价
	 */
	var $PriceTypeOptions="";
	/**
	 *@var 产品类型筛选选项 Normal：普通，YoungMan:青年特价，OldMan:老年特价
	 */
	var $ProductTypeOptions="";
	/**
	 *
	 *@var Y 经济舱C公务舱 F头等舱
	 */
	var $Classgrade="";
	/**
	 *
	 * @var 响应排序方式 DepartTime/TakeOffTime：起飞时间排序（舱位按价格次之），Price:按价格排序（时间次之），Rate:折扣优先（时间次之）,LowPrice: 低价单一排序
	 */
	var $OrderBy="DepartTime";
	/**
	 *
	 * @var 响应排序方向 ASC:升序，Desc:降序
	 * @var string
	 */
	var $Direction="ASC";
	/**
	 * @var 点选的纬度
	 * @var double
	 */
	/**
	 *@var返回体
	 */
	var $ResponseXML="";

	/**
	 *@var 构造请求体
	 */
	private  function getRequestXML()
	{
		/*
		 * 从config.php中获取系统的联盟信息(只读)
		 */
		$AllianceID=Allianceid;
		$SID=Sid;
		$KEYS=SiteKey;
		$RequestType="D_FlightSearch";
		//构造权限头部
		$headerRight=getRightString($AllianceID,$SID,$KEYS,$RequestType);
		$city="";
		if($this->CityID!=""){
			$city=<<<BEGIN
<CityID>$this->CityID</CityID>
BEGIN;
		}
		//构造坐标的查询条件
		$DotXs="";
		if($this->DotX!=0){
			$DotXs=<<<BEGIN
<DotX>$this->DotX</DotX>
BEGIN;
		}
		$DotYs="";
		if($this->DotY!=0){
			$DotYs=<<<BEGIN
<DotY>$this->DotY</DotY>
BEGIN;
		}
		$Radiuss="";
		if($this->Radius!=0){
			$Radiuss=<<<BEGIN
<Radius>$this->Radius</Radius>
BEGIN;
		}
		$HotelMaps="";//坐标的请求节点
		if($DotXs!=""&&$DotYs!=""&&$Radiuss!="")
		{
			$HotelMaps="<HotelMap>$DotXs$DotYs$Radiuss</HotelMap>";
		}
		
		//构造坐标的查询条件
		$checkIn="";
		if($this->CheckInDate!=""){
			$checkIn=<<<BEGIN
<CheckInDate>$this->CheckInDate</CheckInDate>
BEGIN;
		}
		$checkOut="";
		if($this->CheckOutDate!=""){
			$checkOut=<<<BEGIN
<CheckOutDate>$this->CheckOutDate</CheckOutDate>
BEGIN;
		}
		$hotelNames="";
		if($this->HotelName!=""){
			$hotelNames=<<<BEGIN
<HotelName>$this->HotelName</HotelName>
BEGIN;
		}
		$PriceTypes="";
		if($this->PriceType!=""){
			$PriceTypes=<<<BEGIN
<PriceType>$this->PriceType</PriceType>
BEGIN;
		}


		$pagesizes="";
		if($this->PageSize!=""){
			$pagesizes=<<<BEGIN
<PageSize>$this->PageSize</PageSize>
BEGIN;
		}
		$pagenumbers="";
		if($this->PageNumber!=""){
			$pagenumbers=<<<BEGIN
<PageNumber>$this->PageNumber</PageNumber>
BEGIN;
		}
		$HotelLists="";
		if($this->HotelList!=""){
			$HotelLists=<<<BEGIN
<HotelList>$this->HotelList</HotelList>
BEGIN;
		}
		$starlists="";
		if($this->StarList!=""){
			$starlists=<<<BEGIN
<StarList>$this->StarList</StarList>
BEGIN;
		}
		//用酒店的品牌作为关键字，提供给酒店名称，做模糊查询，实现一个品牌名称，查询出多个子品牌的数据
		$hotelbrands="";
		if($this->HotelBrand!=""){
			$hotelbrands=<<<BEGIN
<HotelBrand>$this->HotelBrand</HotelBrand>
BEGIN;
		}
		$ordernames="";
		if($this->OrderName!=""){
			$ordernames=<<<BEGIN
<OrderName>$this->OrderName</OrderName>
BEGIN;
		}
		$ordertypes="";
		if($this->OrderType!=""){
			$ordertypes=<<<BEGIN
<OrderType>$this->OrderType</OrderType>
BEGIN;
		}
		$lowprices="";
		if($this->LowPrice!=""){
			$lowprices=<<<BEGIN
<LowPrice>$this->LowPrice</LowPrice>
BEGIN;
		}
		$highprices="";
		if($this->HighPrice!=""){
			$highprices=<<<BEGIN
<HighPrice>$this->HighPrice</HighPrice>
BEGIN;
		}
		$locations="";
		if($this->Location!=""){
			$locations=<<<BEGIN
<Location>$this->Location</Location>
BEGIN;
		}
		$zones="";
		if($this->Zone!=""){
			$zones=<<<BEGIN
<Zone>$this->Zone</Zone>
BEGIN;
		}
		$Districts="";
		if($this->District!=""){
			$Districts=<<<BEGIN
<District>$this->District</District>
BEGIN;
		}

		$HotelFacilitys="";
		if($this->HotelFacility!="")
		{
			if(strpos($this->HotelFacility,",")>0)
			{
				//如果有多个则要切割
				$arrayFacility=explode(",",$this->HotelFacility);
				for($i=0;$i<count($arrayFacility);$i++)
				{
					if($arrayFacility[$i]!=""&&$arrayFacility[$i]!=null)
					{
						$HotelFacilitys=$HotelFacilitys."<".$arrayFacility[$i].">T</".$arrayFacility[$i].">";
					}
				}
			}
			else
			{
				$HotelFacilitys="<".$this->HotelFacility.">T</".$this->HotelFacility.">";
			}
			
			if($HotelFacilitys!="")//如果有设备，则前后加上设备标签
			{
			  $HotelFacilitys="<HotelFacility>".$HotelFacilitys."</HotelFacility>";
			}
		}

				$paravalues=<<<BEGIN
<?xml version="1.0"?>
<Request>
<Header $headerRight/>
<DomesticHotelListRequest>$city$checkIn$checkOut$hotelNames$pagesizes$pagenumbers$starlists$hotelbrands$ordernames$ordertypes$lowprices$highprices$locations$zones$Districts$HotelFacilitys$HotelLists$PriceTypes$HotelMaps</DomesticHotelListRequest>
</Request>
BEGIN;

				return  $paravalues;
			}
			/**
			 *
			 * 调用直接查询酒店列表的接口，获取到酒店的数据
			 */
			function main(){
				try{
					$requestXML=$this->getRequestXML();
					$commonRequestDo=new commonRequest();//常用数据请求
					$commonRequestDo->requestURL=D_HotelSearch_Url;
					$commonRequestDo->requestXML=$requestXML;
					$commonRequestDo->requestType=System_RequestType;//取config中的配置
					$commonRequestDo->doRequest();
					$returnXML=$commonRequestDo->responseXML;
					
					//print_r($commonRequestDo);die;
	    // echo json_encode($returnXML);die;//校验请求数据-临时用
					//调用Common/RequestDomXml.php中函数解析返回的XML
					$this->ResponseXML=getXMLFromReturnString($returnXML);
				}
				catch(Exception $e)
				{
					$this->ResponseXML=null;
				}
			}
		
		}
		?>
