<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Distributor;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\FlashSale;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $flashsales = FlashSale::where('status', true)->get();

        return view('pages.user.index', compact('products','flashsales'));
    }

    public function detail_product($id)
    {
        $product = Product::findOrFail($id);

        return view('pages.user.detail', compact('product'));
    }

    public function detail_flashsale($id)
    {
        $flashsale = FlashSale::findOrFail($id);

        return view('pages.user.detail2', compact('flashsale'));
    }


    public function purchase($productId, $userId)
    {
        $product = Product::findOrFail($productId);
        $user = User::findOrFail($userId);

        if($user->point > $product->price) {
            $totalPoints = $user->point - $product->price;

            $user->update([
                'point' => $totalPoints,
            ]);

            Alert::success('Berhasil!', 'Produk Berhasil dibeli');
            return redirect()->back();
        } else {
            Alert::error('Gagal!', 'Point anda tidak cukup');
            return redirect()->back();
        }
    }

    public function pur($flashsaleId, $userId)
    {
        $flashsale = FlashSale::findOrFail($flashsaleId);
        $user = User::findOrFail($userId);

        if($user->point > $flashsale->discount_price) {
            $totalPoints = $user->point - $flashsale->discount_price;

            $user->update([
                'point' => $totalPoints,
            ]);

            Alert::success('Berhasil!', 'Produk Berhasil dibeli');
            return redirect()->back();
        } else {
            Alert::error('Gagal!', 'Point anda tidak cukup');
            return redirect()->back();
        }
    }
}
