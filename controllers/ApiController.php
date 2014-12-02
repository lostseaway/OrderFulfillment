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
		$user = Auth::user();
		if($user){
			$orders = DB::table('orders')
			->where('id','=',$id)
			->first();

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
	        	'products' => $products,
	        	200
	    		));


		}
			return Response::json(array('error'=>true,'Message' => 'permission denined'),550);
	}
}
?>