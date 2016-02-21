<?php

namespace App\Http\Controllers;

use App\Book;
use App\Http\Requests;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'book_id' => 'required',
        ]);

        $book_id = $request->get('book_id');
        $book = Book::findOrFail($book_id);


        if ($this->checkHasOrdered($book_id)) {
            return back()->withInput()->withErrors($book->name . '您已经订购过了');
        }
        /**
         * 不能订购自己卖的书去掉注释
         */
        /*if($book->user->id == Auth::user()->id)
        {
            return back()->withInput()->withErrors('您不能订购自己卖的书');
        }*/
        return view('order.create')->with(compact('book'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'book_id' => 'required',
            'address' => 'required|max:250',
            'phone_number' => 'required|size:11',
            'other_contact_way' => 'max:255'
        ],
            [
                'phone_number.required' => '请填写手机号码',
                'address.required' => '请填写地址',

            ]);

        $book_id = $request->get('book_id');
        $book = Book::findOrFail($book_id);

        if (($this->checkHasOrdered($book_id))) {
            return back()->withInput()->withErrors($book->name . '您已经订购过了');
        }

        $order = new Order();
        $order->book_id = $book_id;
        $order->seller_id = $book->user->id;
        $order->phone_number = $request->get('phone_number');
        $order->other_contact_way = $request->get('other_contact_way');
        $order->message = $request->get('message');
        $order->address = $request->get('address');
        /**
         * 不能订购自己卖的书去掉注释
         */
        /*if($order->seller_id == Auth::user()->id)
        {
            return back()->withInput()->withErrors('您不能订购自己卖的书');
        }*/

        $order->status = config('oldbook.status.order_status.success');

        Auth::user()->orders()->save($order);
        return redirect()->route('book.show', $book->id)->withSuccess('订购' . $book->name . '成功');
    }

    private function checkHasOrdered($book_id)
    {
        return Auth::user()->orders()->where('book_id', $book_id)->exists();
    }
}
