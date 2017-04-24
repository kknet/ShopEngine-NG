<?php
class getData{

	private $orderID = 0;
	private $site = "";
	private $admin = false;
	private $ur = false;

	private $data = [
		"ORDERID" => "",
		"DATE" => "",
		"CUSTOMERNAME" => "",
		"CUSTOMERPHONE" => "",
		"ALLPRICE" => "",
		"ALLPRICESTRING" => "",
		"items" => [],
	];

	function __construct($orderID, $site, $admin, $ur){
		if($orderID === false){
			echo "ID not found";
			die();
		}
		else{
			$this->orderID = $orderID;
			$this->site = $site;
			$this->admin = $admin;
			$this->ur = $ur;
		}
	}

	public function get(){
		$this->getQuery();
		return $this->data;
	}

	private function getQuery(){
            $id = Request::GetSession('last_order_id');
            
		if($data = ShopEngine::GetOrderData($id)){
				$totalPrice = (int)$data['info']['orders_payment'] === 2 ? ($data['info']['orders_price'] * 1.05) : $data['info']['orders_price'];
				$this->data = [
					"ORDERID" => $data['info']['orders_id'],
					"DATE" => $data['info']['orders_date'],
					"CUSTOMERNAME" => (int)$data['info']['orders_payment'] === 2 ? $data['info']['orders_company'] : $data['info']['orders_name']." ".$data['info']['orders_last_name'],
					"CUSTOMERNAMETWO" => $data['info']['orders_name']." ".$data['info']['orders_last_name'],
					"CUSTOMERPHONE" => $data['info']['orders_phone'],
					"ALLPRICE" => number_format($totalPrice, 2, ".", ""),
					"ALLPRICESTRING" => $this->num2str($totalPrice),
				];

				$this->getItems($data);
//			else{
//				echo "Заказ выполнен. Смотрите документы в разделе \"Личный кабинет\".";
//				die();
//			}
		}
		else{
			echo "ID not found";
			die();
		}
	}

//	private function checkOrder($order){
//		return true;
//		return strlen($order['cancelled_at']) ? false : true;
//	}

	private function getItems($data){
		$lastKey = 0;
		foreach ($data['products'] as $key => $value) {
			$price = (int)$data['info']['orders_payment'] === 2 ? ($value['price'] * 1.05) : $value['price'];
			$this->data['items'][$key] = [
				"name" => $value['title'],
				"quantity" => $value['orders_count'],
				"unit" => "шт",
				"price" => number_format($price, 2, ".", ""),
				"allprice" => number_format(($price * $value['orders_count']), 2, ".", ""),
			];
			$lastKey = $key;
		}
		if((float)$data['info']['orders_shipping_price'] !== 0.00){
			$price = (int)$data['info']['orders_payment'] === 2 ? ($data['info']['orders_shipping_price'] * 1.05) : $data['info']['orders_shipping_price'];
			$this->data['items'][($lastKey+1)] = [
				"name" => $data['info']['orders_shipping'],
				"quantity" => "1",
				"unit" => "",
				"price" => number_format($price, 2, ".", ""),
				"allprice" => number_format($price, 2, ".", ""),
			];
		}
	}

	private function num2str($num) {
		$nul='ноль';
		$ten=array(
			array('','один','два','три','четыре','пять','шесть','семь', 'восемь','девять'),
			array('','одна','две','три','четыре','пять','шесть','семь', 'восемь','девять'),
		);
		$a20=array('десять','одиннадцать','двенадцать','тринадцать','четырнадцать' ,'пятнадцать','шестнадцать','семнадцать','восемнадцать','девятнадцать');
		$tens=array(2=>'двадцать','тридцать','сорок','пятьдесят','шестьдесят','семьдесят' ,'восемьдесят','девяносто');
		$hundred=array('','сто','двести','триста','четыреста','пятьсот','шестьсот', 'семьсот','восемьсот','девятьсот');
		$unit=array( // Units
			array('копейка' ,'копейки' ,'копеек',	 1),
			array('рубль'   ,'рубля'   ,'рублей'    ,0),
			array('тысяча'  ,'тысячи'  ,'тысяч'     ,1),
			array('миллион' ,'миллиона','миллионов' ,0),
			array('миллиард','милиарда','миллиардов',0),
		);
		//
		list($rub,$kop) = explode('.',sprintf("%015.2f", floatval($num)));
		$out = array();
		if (intval($rub)>0) {
			foreach(str_split($rub,3) as $uk=>$v) { // by 3 symbols
				if (!intval($v)) continue;
				$uk = sizeof($unit)-$uk-1; // unit key
				$gender = $unit[$uk][3];
				list($i1,$i2,$i3) = array_map('intval',str_split($v,1));
				// mega-logic
				$out[] = $hundred[$i1]; # 1xx-9xx
				if ($i2>1) $out[]= $tens[$i2].' '.$ten[$gender][$i3]; # 20-99
				else $out[]= $i2>0 ? $a20[$i3] : $ten[$gender][$i3]; # 10-19 | 1-9
				// units without rub & kop
				if ($uk>1) $out[]= $this->morph($v,$unit[$uk][0],$unit[$uk][1],$unit[$uk][2]);
			} //foreach
		}
		else $out[] = $nul;
		$out[] = $this->morph(intval($rub), $unit[1][0],$unit[1][1],$unit[1][2]); // rub
		$out[] = $kop.' '.$this->morph($kop,$unit[0][0],$unit[0][1],$unit[0][2]); // kop
		return trim(preg_replace('/ {2,}/', ' ', join(' ',$out)));
	}

	private function morph($n, $f1, $f2, $f5) {
		$n = abs(intval($n)) % 100;
		if ($n>10 && $n<20) return $f5;
		$n = $n % 10;
		if ($n>1 && $n<5) return $f2;
		if ($n==1) return $f1;
		return $f5;
	}

}
?>