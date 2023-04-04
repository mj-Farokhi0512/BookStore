<?php

namespace App\Http\Controllers;

use App\Models\Book;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class UserBookController extends Controller
{

    public function show(): View
    {
        $user = Auth::user();
        $orders = $user->orders()->wherePivotNull('deleted_at')->wherePivot('paid', false)->get();

        return view('dashboard.cart.cart', ['orders' => $orders]);
    }

    public function create(Request $request, $id): array
    {
        $user = Auth::user();
        $order = $user->orders()->wherePivot('book_id', $id)->wherePivot('paid', false)->wherePivotNull('deleted_at');

        $check = $order->first();
        if (isset($check)) {
            $order->updateExistingPivot($id, [
                'number' => $order->first()->pivot->number + 1
            ]);
            return ['order' => 'باموفقیت به خرید قبلی اضافه شد', 'number' =>  $order->first()->pivot->number];
        } else {
            $book = Book::find($id);
            $user->orders()->save($book);
            return ['order' => 'باموفقیت به سبدخرید اضافه شد'];
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
}
