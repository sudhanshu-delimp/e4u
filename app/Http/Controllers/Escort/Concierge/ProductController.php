<?php

namespace App\Http\Controllers\Escort\Concierge;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductOrder;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
  public function index()
  {

    try {

      $products = Product::get();
      return view("escort.dashboard.Concierge.products", compact("products"));
    } catch (Exception $e) {
      Log::error("product lists error" . $e->getMessage());
    }
  }
  public function cartListing()
  {
    try {
      $states = config('escorts.profile.states');
      $country = config('app.country');
      $state = $states[Auth::user()->state_id]['stateName'] ?? null;
      return view('escort.dashboard.Concierge.view-cart', compact('state', 'country'));
    } catch (Exception $e) {
      Log::error("cart listing" . $e->getMessage());
    }
  }

  public function getProducts(Request $request)
  {
    try {

      $ids = $request->ids ?? [];
      $cart = $request->cart ?? [];
      $finalCart = $request->finalCart ?? [];
      $query = Product::query();
      if (!empty($ids)) {
        $query = $query->whereIn('id', $ids);
      }
      $products = $query->get();

      // Render Blade

      $html = view('admin.products.render', [
        'products' => $products,
        'cart' => $cart,
        'finalCart' => $finalCart
      ])->render();

      return response()->json(['html' => $html, 'status' => count($cart) == 0 ? true : false]);
    } catch (Exception $e) {
      Log::error("get products" . $e->getMessage());
    }
  }
  public function getTransactionSummary(Request $request)
  {
    try {
      $ids = $request->ids ?? [];
      $shipping = $request->shipping ?? [];
      $cart = $request->cart ?? [];
      $finalCart = $request->finalCart ?? [];

      $query = Product::query();
      if (!empty($ids)) {
        $query = $query->whereIn('id', $finalCart);
      }

      $products = $query->get();
      $shippingCharge = 0;

      if ($shipping == 'post') {
        $shippingCharge = config('escorts.delivery_charge_post');
      } elseif ($shipping == 'door') {
        $shippingCharge = config('escorts.delivery_charge_door');
      }

      $html = view('admin.products.transaction_details', [
        'products' => $products,
        'cart' => $cart,
        'finalCart' => $finalCart,
        'shipping' => $shippingCharge
      ])->render();

      return response()->json(['html' => $html]);
    } catch (Exception $e) {
      Log::error("get products" . $e->getMessage());
    }
  }


 
}
