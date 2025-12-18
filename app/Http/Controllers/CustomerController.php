<?php
namespace App\Http\Controllers;

use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Models\Merchant;
use App\Models\Menu;
use App\Models\Order;

class CustomerController extends Controller
{
    public function dashboard()
    {
        $customer = auth()->user(); 
        $orders = Order::where('customer_id', $customer->id)
            ->with('merchant')
            ->latest()
            ->take(10)
            ->get();

        return view('customer.dashboard', compact('customer', 'orders'));
    }
    public function search()
    {
        $merchants = Merchant::with('menus')->get();
        return view('customer.katering.search', compact('merchants'));
    }

    public function searchResults(Request $request)
    {
        $request->validate([
            'location' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:255',
        ]);

        $query = Merchant::query();

        if ($request->location) {
            $query->where('address', 'like', '%' . $request->location . '%');
        }

        $merchants = $query->with([
            'menus' => function ($q) use ($request) {
                if ($request->category) {
                    $q->where('category', 'like', '%' . $request->category . '%');
                }
            }
        ])->get();

        return view('customer.katering.search', compact('merchants'));
    }

    public function merchantsList()
    {
        $merchants = Merchant::all();
        return view('customer.orders.index', compact('merchants')); }

    public function orderForm($merchantId)
    {
        $merchant = Merchant::find($merchantId);
        if (!$merchant) {
            return redirect()->route('customer.merchants.list')->with('error', 'Merchant tidak ditemukan');
        }

        return view('Customer.orders.form', compact('merchant')); // sesuaikan dengan folder orders
    }
public function orders()
    {
        $customer = auth()->user(); // user yang sedang login

        $orders = Order::where('customer_id', $customer->id)
            ->with(['merchant', 'orderItems.menu'])
            ->latest()
            ->get();

        return view('customer.orders.index', compact('orders'));
    }
    public function orderSubmit(Request $request, $merchantId)
    {
        $merchant = Merchant::findOrFail($merchantId);

        $request->validate([
            'nama' => 'required|string',
            'delivery_date' => 'required|date',
            'jumlah' => 'required|array',
            'jumlah.*' => 'integer|min:0',
        ]);


        $order = Order::create([
            'customer_id' => auth()->id(),
            'merchant_id' => $merchant->id,
            'delivery_date' => $request->delivery_date,
            'total' => 0,
            'status' => 'pending',
        ]);

        $total = 0;

        foreach ($request->jumlah as $menuId => $qty) {
            if ($qty > 0) {
                $menu = Menu::findOrFail($menuId);

                $order->orderItems()->create([
                    'menu_id' => $menu->id,
                    'quantity' => $qty,
                    'price' => $menu->price,
                ]);
                OrderItem::create([
                    'order_id' => $order->id,
                    'menu_id' => $menu->id,
                    'quantity' => $qty,
                    'price' => $menu->price,
                ]);

                $total += $menu->price * $qty;
            }
        }

        $order->update(['total' => $total]);

        return redirect()->route('customer.merchants.list')
            ->with('success', 'Pesanan berhasil dibuat!');
    }


   public function invoice($id)
{
    $order = Order::with(['merchant', 'orderItems.menu'])->findOrFail($id);

    if ($order->customer_id !== auth()->id()) {
        abort(403, 'Unauthorized action.');
    }

        return view('customer.invoice', compact('order'));
    }
}