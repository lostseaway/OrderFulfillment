<?php
class OrdersController extends BaseController {
	public function show(){
		$user = Auth::user();
		if($user){
			$orders = DB::table('orders')->get();
			return View::make('orders.main')->with('orders',$orders);
		}
		return Redirect::route('home');
	}

	public function showId($id){
		$user = Auth::user();
		if($user){
			$orders = DB::table('orders')
			->where('id','=',$id)
			->first();

			$products = DB::table('products_order')
			->where('order_id','=',$id)
			->get();

			return View::make('orders.detail')->with(array('order' => $orders , 'products' => $products));
		}
		return Redirect::route('home');
	}

	public function postOrder(){
		$data = Input::all();
		$msg = $data;
		if($this->checkOrderJson($data)){
			$tmp = $data['order'];
			$insert = array();
			$insert['site'] = $tmp['site'];
			$insert['total_price'] = $tmp['totalprice'];
			$insert['customer_id'] = $tmp['customer_id'];
			// $insert['customer_name'] = $tmp['customer_name'];
			$insert['customer_email'] = $tmp['email'];
			if(array_key_exists('invoice_date', $tmp))$insert['invoice_date'] = date_create($tmp['invoice_date']);
			else $insert['invoice_date'] = new DateTime();

			if(array_key_exists('payment_type', $tmp))$insert['payment_type'] = $tmp['payment_type'];
			else $insert['payment_type'] = "None";

			if(array_key_exists('payment_status',$tmp)){
				$a;
				if($tmp['payment_status']==0)$a = 'Waiting';
				else if($tmp['payment_status']==1)$a = 'Paied';
				else $a = $tmp['payment_status'];
				$insert['payment_status'] = $a;
			}
			else $insert['payment_status'] = 'Waiting';

			if(array_key_exists('order_status',$tmp)){
				$a;
				if($tmp['order_status']==0)$a = 'Waiting';
				else if($tmp['order_status']==1)$a = 'Done';
				else $a = $tmp['order_status'];
				$insert['order_status'] = $a;
			}
			else $insert['order_status'] = 'Waiting';

			$insert['created_at'] = new DateTime();

			$id = DB::table('orders')->insertGetId($insert);

			if(array_key_exists('products', $tmp)){
				if($this->checkProductJson($tmp['products'])){
					$this->addProduct($tmp['products'],$id);
				}
				else return Response::json(array('error'=>true,'Message' => 'Input Mismatch','ReadMore' => route('orders-get-json')),400);
			}
			return Response::json(array('error'=>false,'Message' => 'have'),200);	
		}
		return Response::json(array('error'=>true,'Message' => 'Input Mismatch','ReadMore' => route('orders-get-json')),400);

	}

	private function addProduct($products,$id){
		foreach($products as $pro){
			$p = array();
			$p['order_id'] = $id;
			$p['product_id'] = $pro['product_id'];
			$p['product_name'] = $pro['product_name'];
			$p['price'] = $pro['price'];
			$p['quantity'] = $pro['quantity'];
			$p['created_at'] = new DateTime();

			DB::table('products_order')->insert($p);
		}
	}

	private function checkOrderJson($data){
		if(array_key_exists('order',$data)){
			$tmp = $data['order'];
			if(array_key_exists('site',$tmp))
				if(array_key_exists('totalprice',$tmp))
					if(array_key_exists('customer_id',$tmp))
						if(array_key_exists('customer_name',$tmp))
							if(array_key_exists('email',$tmp))
								if(array_key_exists('address',$tmp))
									return true;
		}
		return false;
	}

	private function checkProductJson($data){
		foreach($data as $l){
			if(!array_key_exists('product_id',$l))return false;
			if(!array_key_exists('product_name',$l))return false;
			if(!array_key_exists('price',$l))return false;
			if(!array_key_exists('quantity',$l))return false;
		}
		return true;
	}

	public function getJsonTemplate(){
		return View::make('orders.json');
	}

}