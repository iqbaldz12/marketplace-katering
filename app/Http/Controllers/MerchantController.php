<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Merchant;
use App\Models\Menu;
use App\Models\Order;

class MerchantController extends Controller
{
    public function dashboard()
    {
        $merchant = Auth::user()->merchant;

        $orders = $merchant->orders()->with('customer')->latest()->take(10)->get();

        return view('merchant.dashboard', compact('merchant', 'orders'));
    }

    public function menus()
    {
        $merchant = Auth::user()->merchant;
        $menus = $merchant->menus()->latest()->get();
        return view('merchant.menus.index', compact('menus'));
    }

    public function createMenu()
    {
        return view('merchant.menus.create');
    }

    public function storeMenu(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $merchant = Auth::user()->merchant;

        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();

            $destinationPath = public_path('storage/menu_image');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }

            $image->move($destinationPath, $imageName);
            $imagePath = $imageName;
        }

        $merchant->menus()->create([
            'name' => $request->name,
            'category' => $request->category,
            'price' => $request->price,
            'description' => $request->description ?? '',
            'image' => $imagePath,
        ]);

        return redirect()->route('merchant.menus')->with('success', 'Menu berhasil ditambahkan!');
    }
    public function editMenu($id)
    {
        $menu = Menu::findOrFail($id);
        return view('merchant.menus.edit', compact('menu'));
    }

    public function updateMenu(Request $request, $id)
    {
        $menu = Menu::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = [
            'name' => $request->name,
            'category' => $request->category,
            'price' => $request->price,
            'description' => $request->description ?? '',
        ];

        if ($request->hasFile('image')) {
            if ($menu->image) {
                @unlink(public_path('storage/menu_image/' . $menu->image));
            }
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('storage/menu_image'), $imageName);
            $data['image'] = $imageName;
        }

        $menu->update($data);

        return redirect()->route('merchant.menus')->with('success', 'Menu berhasil diupdate!');
    }

    public function deleteMenu($id)
    {
        $menu = Menu::findOrFail($id);
        if ($menu->image) {
            \Storage::delete('public/menu_images/' . $menu->image);
        }
        $menu->delete();

        return redirect()->route('merchant.menus')->with('success', 'Menu berhasil dihapus!');
    }

public function orders()
{
    $merchant = Auth::user()->merchant;
    $orders = $merchant->orders()->with('customer','items.menu')->latest()->get();
    return view('merchant.orders.index', compact('orders'));
}

public function invoice($orderId)
{
    $merchant = Auth::user()->merchant;
    $order = Order::with('customer','items.menu')
        ->where('merchant_id', $merchant->id)
        ->findOrFail($orderId);

    return view('merchant.orders.invoice', compact('order'));
}
 public function editProfile()
    {
        $merchant = Merchant::where('user_id', Auth::id())->firstOrFail();

        return view('merchant.profile.edit', compact('merchant'));
    }

   public function updateProfile(Request $request)
{
    $request->validate([
        'company_name' => 'required|string|max:255',
        'address' => 'required|string',
        'contact' => 'required|string|max:50',
        'description' => 'nullable|string',
    ]);

    $merchant = auth()->user()->merchant; // Assuming the merchant is related to the authenticated user
    $merchant->update([
        'company_name' => $request->company_name,
        'address' => $request->address,
        'contact' => $request->contact,
        'description' => $request->description,
    ]);

    return redirect()->route('merchant.profile.edit')->with('success', 'Profil berhasil diperbarui.');
}
}