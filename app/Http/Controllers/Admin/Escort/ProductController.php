<?php

namespace App\Http\Controllers\Admin\Escort;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
  public function index()
  {

    try {
      $products = Product::with('cartItem')->get();
$query=CartItem::where("user_id", auth()->user()->id);
      $cartItems = $query->pluck("product_id")->toArray();
       $totalCartItem = $query->sum("quantity");

      return view("escort.dashboard.Concierge.products", compact("products", "cartItems",'totalCartItem'));
    } catch (Exception $e) {
      Log::error("product lists error" . $e->getMessage());
    }
  }

  public function addToCart(Request $request)
  {
    try {
      $user = auth()->user();

      $item = CartItem::firstOrNew([
        'user_id' => $user->id,
        'product_id' => $request->id
      ]);
      $message = 'Cart updated';
      if ($request->type == 'add') {
        $item->quantity = $item->exists ? $item->quantity + 1 : 1;
        $message = 'Item Added To Cart!';
      }



      if ($request->type == 'increase')
        $item->quantity++;


      if ($request->type === 'decrease') {
        if ($item->quantity > 1) {
          $item->quantity--;
          $item->save();
        } else {
          // delete if only 1 left
          $item->delete();

          return response()->json([
            'status' => true,
            'message' => 'Item removed',
            'removed' => true,
            'cart_count' => CartItem::where('user_id', $user->id)->sum('quantity')
          ]);
        }
      }

      $item->save();

      return response()->json([
        'status' => true,
        'message' => $message,
        'qty' => $item->quantity,
        'cart_count' => CartItem::where('user_id', $user->id)->sum('quantity')
      ]);
    } catch (Exception $e) {
      return response()->json(['status' => false, 'message' => $e->getMessage()]);
    }
  }
}
