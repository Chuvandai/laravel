<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Variant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CardController extends Controller
{
    public function index()
    {
      
        $cart = Session::get('cart', []);
        //dd($cart);
        $totalPrice = 0;

        foreach ($cart as $item) {
            $totalPrice += $item['price'] * $item['quantity'];
        }
        return view('clients.card', compact('cart','totalPrice'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'storage' => 'required|string',
            'color' => 'required|string',
            'quantity' => 'required|integer|min:1',
        ]);

        $variant = Variant::where('product_id', $request->product_id)
                          ->where('storage', $request->storage)
                          ->where('color', $request->color)
                          ->first();

        if (!$variant) {
            return response()->json(['success' => false, 'message' => 'Biến thể không tồn tại!'], 400);
        }

        $cart = Session::get('cart', []);
        $cartItemKey = $variant->id;

        if (isset($cart[$cartItemKey])) {
            $cart[$cartItemKey]['quantity'] += $request->quantity;
        } else {
            $cart[$cartItemKey] = [
                'id' => $variant->id,
                'name' => $variant->product->name,
                'image' => $variant->product->image,
                'price' => $variant->price,
                'storage' => $variant->storage,
                'color' => $variant->color,
                'quantity' => $request->quantity
            ];
        }

        Session::put('cart', $cart);

        return response()->json(['success' => true, 'cart_count' => count($cart)]);
    }
    public function remove(Request $request)
{
    $cart = session()->get('cart');
    $productId = $request->input('id');

    if (isset($cart[$productId])) {
        unset($cart[$productId]);
        session()->put('cart', $cart);
        return redirect()->route('card')->with('success', 'Sản phẩm đã được xóa khỏi giỏ hàng');
    }

    return redirect()->route('card')->with('error', 'Sản phẩm không tồn tại trong giỏ hàng');
  //  return response()->json(['success' => false, 'message' => 'Sản phẩm không tồn tại trong giỏ hàng.'], 400);
}

}
