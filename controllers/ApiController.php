<?php
class ApiController extends BaseController {
	public function getOrder()
	{
		$user = Auth::user();
		if($user){
			$orderq = DB::table('orders')->get();
			$orders = array();
			foreach($orderq as $order){
				array_push($orders, $order);
			}
			return Response::json(array(
	        	'error' => false,
	        	'orders' => $orders,
	        	200
	    		));
		}
		return Response::json(array('error'=>true,'Message' => 'permission denined'),550);
	}

	public function getOrderByID($id){
			$orders = DB::table('orders')
			->where('id','=',$id)
			->first();

			if($orders==null)return Response::json(array('error'=>true,'Message' => 'Order id Not Found'),404);
			$productq = DB::table('products_order')
			->where('order_id','=',$id)
			->get();

			

			$products = array();
			foreach($productq as $product){
				array_push($products, $product);
			}
			return Response::json(array(
	        	'error' => false,
	        	'order' => $orders,
	        	'products' => $products
	        	),200
	    		);

	}

	public function getOrderStatusByID($id){
		$orders = DB::table('orders')
			->where('id','=',$id)
			->first();

			if($orders==null)return Response::json(array('error'=>true,'Message' => 'Order id Not Found'),404);
			return Response::json(array(
	        	'error' => false,
	        	'order_status' => $orders->order_status,
	        	'payment_status' => $orders->payment_status,
	        	'shipping_status' => $orders->shipping_status
	        	),200
	    		);
		}
	
	public function postOrder(){
		if(!Request::isJson())return Response::json(array('error'=>true,'Message' => 'Input type not support , require JSON','ReadMore' => route('orders-get-json')),406);
		$data = Input::all();
		$msg = $data;
		if($this->checkOrderJson($data)){
			$tmp = $data['order'];
			$insert = array();
			$insert['site'] = $tmp['site'];
			$insert['total_price'] = $tmp['totalprice'];
			$insert['customer_id'] = $tmp['customer_id'];
			$insert['customer_name'] = $tmp['customer_name'];
			$insert['customer_phone'] = $tmp['phone_number'];
			$insert['customer_address'] = $tmp['address'];
			$insert['shipping_status'] = "Waiting";
			// $insert['customer_name'] = $tmp['customer_name'];
			$insert['customer_email'] = $tmp['email'];
			if(array_key_exists('invoice_date', $tmp))$insert['invoice_date'] = date_create($tmp['invoice_date']);
			else $insert['invoice_date'] = new DateTime();

			if(array_key_exists('payment_type', $tmp))$insert['payment_type'] = $tmp['payment_type'];
			else $insert['payment_type'] = "None";

			if(array_key_exists('payment_status',$tmp)){
				$a;
				if($tmp['payment_status']==0)$a = 'Waiting';
				else if($tmp['payment_status']==1)$a = 'Paid';
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
			return Response::json(array('error'=>false,'order_id' => $id,'url'=>'http://128.199.132.197/dntk/orders/'.$id),200);	
		}
		return Response::json(array('error'=>true,'Message' => 'Input Mismatch','ReadMore' => route('orders-get-json')),400);

	}

	public function updateOrderStatus($id){
		if(!Request::isJson())return Response::json(array('error'=>true,'Message' => 'Input type not support , require JSON','ReadMore' => route('orders-get-json')),406);
		$orders = DB::table('orders')
			->where('id','=',$id)
			->first();

		if($orders==null)return Response::json(array('error'=>true,'Message' => 'Order id Not Found'),404);

		$data = Input::all();
		if(!array_key_exists('order_status',$data))return Response::json(array('error'=>true,'Message' => 'Input Mismatch','ReadMore' => route('orders-get-json')),400);
		
		$insert = array();
		if($data['order_status']==0)$insert['order_status'] = 'Waiting';
		else if($data['order_status']==1)$insert['order_status'] = 'OnProcess';
		else if($data['order_status']==2)$insert['order_status'] = 'Fulfilled';
		else return Response::json(array('error'=>true,'Message' => 'Input Mismatch','ReadMore' => route('orders-get-json')),400);


		DB::table('orders')
            ->where('id', $id)
            ->update($insert);

		return Response::json(array('error'=>false,'Message' => "order_status Updated"),200);
	}

	public function updatePaymentStatus($id){
		if(!Request::isJson())return Response::json(array('error'=>true,'Message' => 'Input type not support , require JSON','ReadMore' => route('orders-get-json')),406);
		$orders = DB::table('orders')
			->where('id','=',$id)
			->first();

		if($orders==null)return Response::json(array('error'=>true,'Message' => 'Order id Not Found'),404);

		$data = Input::all();
		if(!array_key_exists('payment_status',$data))return Response::json(array('error'=>true,'Message' => 'Input Mismatch','ReadMore' => route('orders-get-json')),400);
		
		$insert = array();
		if($data['payment_status']==0)$insert['payment_status'] = 'Waiting';
		else if($data['payment_status']==1)$insert['payment_status'] = 'Paid';
		else return Response::json(array('error'=>true,'Message' => 'Input Mismatch','ReadMore' => route('orders-get-json')),400);


		DB::table('orders')
            ->where('id', $id)
            ->update($insert);

		return Response::json(array('error'=>false,'Message' => "payment_status Updated"),200);
	}

	public function updateShippingStatus($id){
		if(!Request::isJson())return Response::json(array('error'=>true,'Message' => 'Input type not support , require JSON','ReadMore' => route('orders-get-json')),406);
		$orders = DB::table('orders')
			->where('id','=',$id)
			->first();

		if($orders==null)return Response::json(array('error'=>true,'Message' => 'Order id Not Found'),404);

		$data = Input::all();
		if(!array_key_exists('shipping_status',$data))return Response::json(array('error'=>true,'Message' => 'Input Mismatch','ReadMore' => route('orders-get-json')),400);
		
		$insert = array();
		if($data['shipping_status']==0)$insert['shipping_status'] = 'Waiting';
		else if($data['shipping_status']==1)$insert['shipping_status'] = 'Shipped';
		else return Response::json(array('error'=>true,'Message' => 'Input Mismatch','ReadMore' => route('orders-get-json')),400);


		DB::table('orders')
            ->where('id', $id)
            ->update($insert);

		return Response::json(array('error'=>false,'Message' => "shipping_status Updated"),200);
	}

	public function testPost(){
		if(!Request::isJson())return Response::json(array('error'=>true,'Message' => 'Input type not support , require JSON','ReadMore' => route('orders-get-json')),406);
		$data = Input::all();
		return Response::json(array('error'=>false,'Message' => $data),200);
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
			if(array_key_exists('weight', $pro))$p['weight'] = $pro['weight'];

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
}
?>