<?php

namespace App\Http\Controllers\Escort\Concierge;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Exception;
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
      return view('escort.dashboard.Concierge.view-cart');
    } catch (Exception $e) {
      Log::error("cart listing" . $e->getMessage());
    }
  }

  public function getProducts(Request $request)
  {
    try {
      $ids = $request->ids ?? [];

      $query = Product::query();
      if (!empty($ids)) {
        $query = $query->whereIn('id', $ids);
      }
      $products = $query->get();

      return response()->json([
        'products' => $products
      ]);
    } catch (Exception $e) {
      Log::error("get products" . $e->getMessage());
       
    }
  }
}
