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


	public function fulfill(){
		$id = Input::get('order_id');
		$orders = DB::table('orders')
			->where('id','=',$id)
			->first();

			DB::table('orders')
            ->where('id', $id)
            ->update(array('order_status'=>'Fulfilled','shipping_status'=>'Waiting'));
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

}