<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Product;
use App\Order;
use Auth;
use Illuminate\Http\Request;
use Session;

class ProductController extends Controller
{

   //FOR CRUD -Products
   public function index()
   {
       $products = Product::latest()->paginate(5);
 
       return view('products.index',compact('products'))
           ->with('i', (request()->input('page', 1) - 1) * 5);
   }

   public function create()
   {
       return view('products.create');
   }

   public function store(Request $request)
    {   
        $this->validate($request,[
            'imagePath' => 'required',
            'title' => 'required',
            'description' => 'required',
            'price' => 'required'
        ]);

        Product::create($request->all());
        
   
        return redirect()->route('products.index')->with('success','Product created successfully!');
    }

    public function show($id)
    {
        $product = Product::find($id);
        return view('products.show',compact('product'));
    }

    public function edit($id)
    {
        $product = Product::find($id);
        return view('products.edit',compact('product'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'imagePath' => 'required',
            'title' => 'required',
            'description' => 'required',
            'price' => 'required'
        ]);
  
        Product::find($id)->update($request->all());
  
        return redirect()->route('products.index')->with('success','Product updated successfully');
    }

    public function destroy($id)
    {
        Product::find($id)->delete();
  
        return redirect()->route('products.index')->with('success','Product deleted successfully');
    }
    
   
  //FOR CRUD -Products




    public function getIndex(){

        $products = Product::all();
        return view('shop.index',['products' => $products ]);
    }

    public function getAddToCart(Request $request ,$id){
       $product = Product::find($id);//find by id of product
       $oldCart = Session::has('cart') ? Session::get('cart') : null;

       $cart = new Cart($oldCart);//create new cart
       $cart->add($product,$product->id);

       $request->session()->put('cart', $cart);
       return redirect()->route('product.index');

    }

    public function getReduceByOne($id){
       $oldCart = Session::has('cart') ? Session::get('cart') : null;
       $cart = new Cart($oldCart);//create new cart

       $cart->reduceByOne($id);//reduce by one

       if(count($cart->items) > 0){//if we have more that 0 item in the cart
             Session::put('cart',$cart);//store in the session the new cart

        }else{
              Session::forget('cart');//delete the cart
            }

       return  redirect()->route('product.shoppingCart');

    }

    

    public function getRemoveItem($id){
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);//create new cart

        $cart->removeItem($id);//remove item from cart

        if(count($cart->items) > 0){//if we have more that 0 item in the cart
            Session::put('cart',$cart);//store in the session the new cart
        }else{
            Session::forget('cart');//delete the cart
        }
        
       
        return  redirect()->route('product.shoppingCart');
    }

    public function getCart(){
        if(!Session::has('cart')){//if we do have a cart stored in this session(NOT THE CASE)
            return view ('shop.shopping-cart');
        }
        $oldCart = Session::get('cart');//if we do have a old car stored here
        $cart = new Cart($oldCart);//create a new cart were we put the old cart
        return view('shop.shopping-cart',['products' => $cart->items, 'totalPrice' => $cart->totalPrice]);
    }

   public function getCheckout(){
     if(!Session::has('cart')){//if we do have a cart stored in this session(NOT THE CASE)
        return view ('shop.shopping-cart');
      }
      $oldCart = Session::get('cart');
      $cart = new Cart($oldCart);
      $total = $cart->totalPrice;
      return view('shop.checkout',['total' => $total]);

    }

    public function postCheckout(Request $request ){
        if(!Session::has('cart')){//if we do have a cart stored in this session(NOT THE CASE)
            return redirect()->route('shop.shoppingCart');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);


        //save the order 
        $order = new Order();
        $order->cart = serialize($cart);
        $order->address = $request->input('address');
        $order->name = $request->input('name');

        Auth::user()->orders()->save($order);


        Session::forget('cart');
        return redirect()->route('product.index')->with('success','Successfully purchased products!');

    }



}
