<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request, Product $product)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|min:10|max:1000'
        ]);

        // Kiểm tra xem người dùng đã mua sản phẩm này chưa
        if (!$product->hasUserPurchased(Auth::id())) {
            return response()->json([
                'success' => false,
                'message' => 'Bạn cần mua và nhận hàng thành công trước khi đánh giá.'
            ]);
        }

        // Kiểm tra xem người dùng đã đánh giá sản phẩm này chưa
        $existingReview = Review::where('user_id', Auth::id())
            ->where('product_id', $product->id)
            ->first();

        if ($existingReview) {
            return response()->json([
                'success' => false,
                'message' => 'Bạn đã đánh giá sản phẩm này rồi.'
            ]);
        }

        $review = Review::create([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
            'rating' => $request->rating,
            'comment' => $request->comment
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Đánh giá của bạn đã được gửi thành công.',
            'review' => $review->load('user')
        ]);
    }
} 