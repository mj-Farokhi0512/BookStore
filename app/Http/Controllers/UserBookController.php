<?php

namespace App\Http\Controllers;

use App\Models\Book;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UserBookController extends Controller
{

    public function show(): View
    {
        $user = Auth::user();
        $orders = $user->orders()->wherePivotNull('deleted_at')->wherePivot('paid', false)->get();

        return view('dashboard.cart.cart', ['orders' => $orders]);
    }

    public function create(Request $request): array
    {
        $id = $request->get('id');
        $user = Auth::user();
        $order = $user->orders()->wherePivot('book_id', $id)->wherePivot('paid', false)->wherePivotNull('deleted_at');

        $check = $order->first();
        if (isset($check)) {
            $order->updateExistingPivot($id, [
                'number' => $order->first()->pivot->number + 1
            ]);
            return ['order' => 'باموفقیت به خرید قبلی اضافه شد', 'number' =>  $order->first()->pivot->number, 'cartItems' => count($user->orders()->wherePivotNull('deleted_at')->wherePivot('paid', false)->get())];
        } else {
            $book = Book::find($id);
            $user->orders()->save($book);
            return ['order' => 'باموفقیت به سبدخرید اضافه شد', 'cartItems' => count($user->orders()->wherePivotNull('deleted_at')->wherePivot('paid', false)->get())];
        }
    }

    public function createFave(Request $request): array
    {
        $id = $request->get('id');
        $user = Auth::user();
        $fave = $user->bookmarks()->find($id);
        if (isset($fave)) {
            $user->bookmarks()->detach($id);
            return ['message' => 'از علاقمندی ها حذف شد', 'like' => false];
        } else {
            $user->bookmarks()->attach($id);
            return ['message' => 'به علاقمندی ها اضافه شد', 'like' => true];
        }
    }

    public function update(Request $request): array
    {
        $id = $request->get('id');
        $order = Auth::user()->orders()->wherePivot('paid', false);
        $order_val = $order->wherePivot('book_id', $id)->first();
        if (is_numeric($request->get('number'))) {
            $number = intval($request->get('number'));
            $order->updateExistingPivot($id, [
                'number' => $number,
            ]);

            return ['id' => $request->get('id'), 'number' => $number, 'total_price' => $order_val->price * $number];
        }

        return ['message' => 'درخواست ناموفق', 'number' => $order_val->pivot->number];
    }
    public function delete($id): array
    {
        // Auth::user()->orders()->detach($id);
        Auth::user()->orders()->wherePivot('paid', false)->updateExistingPivot($id, [
            'deleted_at' => now()
        ]);
        return ['message' => 'سفارش باموفقیت حذف شد'];
    }


    public function paid($id): array
    {
        Auth::user()->orders()->wherePivotNull('deleted_at')->wherePivot('paid', false)->updateExistingPivot($id, [
            'paid' => true,
        ]);

        return ['id' => $id, 'message' => 'با موفقیت پرداخت شد'];
    }

    public function paids(): View
    {
        $paid_orders = Auth::user()->orders()->wherePivot('paid', true)->orderByPivot('updated_at', 'desc')->get();
        return view('dashboard.cart.paid', ['paids' => $paid_orders]);
    }

    public function faverites(): View
    {
        $faves = Auth::user()->bookmarks()->get();
        return view('dashboard.faverite.faverite', ['faves' => $faves]);
    }
}
