<?php

namespace App;



class Cart
{
    public $items = null;
    public $totalQty = 0;
    public $totalPrice = 0;

    public function __construct($oldCart)
    {
        if($oldCart){
            $this->items = $oldCart->items;
            $this->totalQty = $oldCart->totalQty;
            $this->totalPrice = $oldCart->totalPrice;
        }
    }



   public function add($item, $id)
   {
      $storedItem = ['qty' => 0,'price' => $item->price, 'item' => $item];
      if($this->items){
          if(array_key_exists($id, $this->items)){//checks if the given key or index exists in the array 
              $storedItem = $this->items[$id];
            }
        }
          $storedItem['qty']++;
          $storedItem['price'] = $item->price * $storedItem['qty'];
          $this->items[$id] = $storedItem;
          $this->totalQty++;
          $this->totalPrice += $item->price;
    }

    

    public function reduceByOne($id){
       $this->items[$id]['qty']--;//reduce quantity by 1
       $this->items[$id]['price'] -=  $this->items[$id]['item']['price'];//reduce price only with a price of a single item
       $this->totalQty--;//reduce total quantity 
       $this->totalPrice -= $this->items[$id]['item']['price'];//reduce price only with a price of a single item

       if($this->items[$id]['qty'] <= 0){
           unset($this->items[$id]);//destroy variable
       }
    }

    public function removeItem($id){

        $this->totalQty -=$this->items[$id]['qty'];//reduce total quantity 
        $this->totalPrice -= $this->items[$id]['price'];//reduce price only with a price of a single item

        unset($this->items[$id]);//destroy variable
    }

}
