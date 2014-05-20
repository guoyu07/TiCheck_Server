<?php

class HistoryPriceCommand extends CConsoleCommand
{
	public function actionNormal()
	{
		Yii::app()->db;
//		$subs = new \Subscription;
		echo "hello world";
		exec("./yiic historyprice index &");
		echo "after exec";
		exit;
	}

	public function actionIndex($subs_id)
	{
		$subs = \Subscription::model()->findByAttributes(array('ID'=>$subs_id));
		$lowestPrice = new \D_LowestPrice;
		$subs->CurrentPrice = (int)$lowestPrice->searchFlight($subs);
		try
		{
			$subs->save();
		}
		catch(Exception $e)
		{
			new \Error(5, null, $e->getMessage());
		}

		$date = new \DateGenerater;
		$date = $date->getDateYMD("-");
		$price = $subs->CurrentPrice;
		$history_price = \HistoryPrice::model()->findByAttributes(array(
			'ID_subscription'=>$subs->ID,
			'Date'=>$date
		));
		if ($history_price==NULL || $history_price->count()==0)
		{
			$history_price = new HistoryPrice;
			$history_price->ID_subscription = $subs->ID;
			$history_price->Price = $price;
			$history_price->Date = $date;
			try
			{
				$history_price->save();
			}
			catch(Exception $e)
			{
				new \Error(5, NULL, $e->getMessage());
			}
		}
		else
		{
			//var_dump($history_price);
			$history_price = $history_price[0];
			if ($history_price->Price == $price)
				return;
			$history_price->Price = ($price < $history_price->Price)?$price:$history_price;
			try
			{
				$history_price->save();
			}
			catch(Exception $e)
			{
				new \Error(5, NULL, $e->getMessage());
			}
		}
	}
	/*
	public function actionIndex()
	{
		echo "in index action";
		$fp = fopen("a.txt", 'w');
		for ($i=0; $i<100; $i++)
		{
			fwrite($fp, "1");
		}
		fclose($fp);
	}
	 */
}

?>
