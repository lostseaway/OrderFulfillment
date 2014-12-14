<?php
class OrdersController extends BaseController {
	public function show(){
		$user = Auth::user();
		if($user){
			$orders = DB::table('orders')
			->orderBy('order_status', 'desc')
			->get();
			return View::make('orders.main')->with('orders',$orders);
		}
		return Redirect::route('home');
	}

	public function showId($id){
			$orders = DB::table('orders')
			->where('id','=',$id)
			->first();

			// if($orders==null)return 
			$products = DB::table('products_order')
			->where('order_id','=',$id)
			->get();

			return View::make('orders.detail')->with(array('order' => $orders , 'products' => $products));
	}


	public function fulfill(){
		$id = Input::get('order_id');
		$orders = DB::table('orders')
			->where('id','=',$id)
			->first();

			DB::table('orders')
            ->where('id', $id)
            ->update(array('order_status'=>'Fulfilled','shipping_status'=>'Waiting'));

            $this->sendToShipment($id);
			// if($orders==null)return Response::json(array('error'=>true,'Message' => 'Order id Not Found'),404);
			// $productq = DB::table('products_order')
			// ->where('order_id','=',$id)
			// ->get();
			// $url = "";
			// if($orders->site == "jf-shop"){
			// 	$url = "128.199.212.108/jf-shop/api/v1/products/";
			// }

			// foreach($productq as $product ){
			// 	$json = file_get_contents($url.$product->id);
			// 	$data = json_decode($json, TRUE);
			// 	$quantity = (int)$data['product']['quantity'];
			// 	if()
			// }
	}

	public function grap(){
		$id = Input::get('order_id');
		$orders = DB::table('orders')
			->where('id','=',$id)
			->first();

			DB::table('orders')
            ->where('id', $id)
            ->update(array('order_status'=>'OnProcess','shipping_status'=>'Waiting'));	
	}

	public function getJsonTemplate(){
		return View::make('orders.json');
	}

	public function getTest(){
		return View::make('layout.test');
	}

	public function access(){
		return View::make('access');
	}

	public function sendToShipment($id){
		$token ='4543ca877452da8b5dd64d38c64acef6';
		$url = 'http://track-trace.tk:8080/shipments';
		
		$orders = DB::table('orders')
			->where('id','=',$id)
			->first();
		$xml ="<?xml version=\"1.0\" encoding=\"UTF-8\" standalone=\"yes\" ?>";
		$xml .='<shipment>';
		$xml .= '<type>'.'EMS'."</type>";
    	$xml .= '<courier_name>'.$orders->site.'</courier_name>';
    	$xml .= '<courier_address>'."Address Test 1".'</courier_address>';
    	$xml .= '<receive_name>'.$orders->customer_name.'</receive_name>';
    	$xml .= '<receive_address>'.$orders->customer_address.'</receive_address>';
    	$pros = DB::table('products_order')
			->where('order_id','=',$id)
			->get();
		$items="";
		foreach($pros as $p){
			$item = "<item>";
			$item .= '<name>'.$p->product_name.'</name>';
			$item .='<weight>'.$p->weight.'</weight>';
			$item .='<quantity>'.$p->quantity.'</quantity>';
			$item .='</item>';
			$items.=$item;
		}
		$xml .= '<items>'.$items.'</items>';
		$xml .='</shipment>';
		$ch = curl_init($url);                                                                      
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_HEADER, true);                                                                     
		curl_setopt($ch, CURLOPT_POSTFIELDS, $xml); 
		curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type: application/xml','Authorization: '.$token));
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );

		$result = curl_exec($ch);
		list($headers, $response) = explode("\r\n\r\n", $result, 2);
		// $result = implode(" ",$result);

		$headers = explode("\n", $headers);
		foreach($headers as $header) {
		    if (stripos($header, 'Location:') !== false) {
		        preg_match('~shipments/(\d+)~', $header, $m );
		    }
		}

		var_dump($m[1]);
		// curl_close($ch);
		if($m!=null){
			DB::table('orders')
            ->where('id', $id)
            ->update(array('ship_id' => $m[1] ));
		}
		// return $m;

	}
	function array2xml($array, $xml = false){
    if($xml === false){
        $xml = new SimpleXMLElement('<shipment/>');
    }
    foreach($array as $key => $value){
        if(is_array($value)){
            array2xml($value, $xml->addChild($key));
        }else{
            $xml->addChild($key, $value);
        }
    }
    return $xml->asXML();
}
}