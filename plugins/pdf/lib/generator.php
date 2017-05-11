<?php
class generator2 extends template{

	private $orderID = 0;
	private $site = "blackberry";
	private $admin = false;
	private $ur = false;
	private $data = [];

	function __construct($orderID = false, $site = "blackberry", $admin=false, $ur=false){
		$this->orderID = Request::GetSession('last_order_id');
		$this->site = $site;
		$this->admin = $admin;
		$this->ur = $ur;
		$this->getData();
	}

	public function render(){
		$this->getView();
	}

	private function getView(){
		$this->get_tpl("order".$this->site);
		$this->setValues();
		$this->tpl_parse();
		$this->genPDF();
	}

	private function genPDF(){
		$mpdf = new mPDF('utf-8', 'A4', '9', 'Arial', 0, 0, 20, 5, 5, 5);
		$mpdf->charset_in = 'utf-8';

		$stylesheet = '
		table, td, tr, p{
			padding: 2px;
			margin: 2px;
		}
		table{
			border-collapse: collapse;
		}
		';

		//Записываем стили
		$mpdf->WriteHTML($stylesheet, 1);
		$mpdf->list_indent_first_level = 0;
		//Записываем html
		$mpdf->WriteHTML($this->html, 2);
		$mpdf->Output(ROOT.'files/orders/order'.$this->orderID.'.pdf', 'F');
	}

	private function setValues(){
		foreach ($this->data as $key => $value) {
			if($key != "items")
				$this->set_value($key, $value);
			else
				$this->setitem($value);
		}
	}

	private function setitem($items){
		$itemStr = "";
		foreach ($items as $key => $item) {
			$itemStr .= "<tr>
					<td style='border: 2px solid #000; text-align: right;'>".($key+1)."</td>
					<td style='border: 2px solid #000; text-align: left;'>{$item['name']}</td>
					<td style='border: 2px solid #000; text-align: right;'>{$item['price']}</td>
					<td style='border: 2px solid #000; text-align: right;'>{$item['quantity']}</td>
					<td style='border: 2px solid #000; text-align: right;'>{$item['unit']}</td>
					<td style='border: 2px solid #000; text-align: right;'>{$item['allprice']}</td>
				</tr>";
		}
		$this->set_value("ITEMS", $itemStr);
	}

	private function getData(){
		$getdata = new getdata($this->orderID, $this->site, $this->admin, $this->ur);
		$this->data = $getdata->get();
	}
}