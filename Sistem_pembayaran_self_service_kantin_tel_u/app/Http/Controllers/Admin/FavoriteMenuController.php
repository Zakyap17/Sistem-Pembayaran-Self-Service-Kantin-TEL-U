<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FavoriteMenu;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;


class FavoriteMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $favoriteMenus = FavoriteMenu::with('menu')->orderBy('rank', 'asc')->get();
        
        return view('admin.favorite_menus.index', compact('favoriteMenus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $existingFavoriteMenuIds = FavoriteMenu::pluck('menu_id')->toArray();
        
        $menus = Menu::whereNotIn('id', $existingFavoriteMenuIds)
                     ->get();

        $nextRank = (FavoriteMenu::max('rank') ?? 0) + 1;

        return view('admin.favorite_menus.create', compact('menus', 'nextRank'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'menu_id' => 'required|exists:menus,id|unique:favorite_menus,menu_id',
            'rank' => 'required|integer|min:1|unique:favorite_menus,rank',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Maks 2MB
            'description' => 'nullable|string|max:255',
        ], [
            'menu_id.unique' => 'Menu yang dipilih sudah ada di daftar favorit.',
            'rank.unique' => 'Peringkat ini sudah digunakan. Pilih peringkat lain.',
        ]);

        DB::beginTransaction();
        try {
            $data = $request->only(['menu_id', 'rank', 'description']);

            if ($request->hasFile('image')) {
                // Simpan gambar ke public/storage/favorite_menu_images
                $imageName = time().'.'.$request->image->extension();  
                $request->image->storeAs('public/favorite_menu_images', $imageName);
                $data['image'] = 'storage/favorite_menu_images/'.$imageName;
            }

            FavoriteMenu::create($data);
            DB::commit();

            return redirect()->route('admin.favorite-menus.index')
                             ->with('success', 'Menu favorit berhasil ditambahkan.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Gagal menambahkan menu favorit: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     * Biasanya tidak terlalu sering digunakan untuk admin CRUD jika sudah ada index dan edit.
     * Anda bisa membiarkannya kosong atau mengarahkannya ke edit.
     */
    public function show(FavoriteMenu $favoriteMenu)
    {
        return redirect()->route('admin.favorite-menus.edit', $favoriteMenu->id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FavoriteMenu $favoriteMenu) 
    {
        return view('admin.favorite_menus.edit', compact('favoriteMenu'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FavoriteMenu $favoriteMenu) 
    {
        $request->validate([
            'rank' => 'required|integer|min:1',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'nullable|string|max:255',
        ]);

        DB::beginTransaction();
        try {
            $data = $request->only(['rank', 'description']);
            $newRank = (int)$request->input('rank');
            $oldRank = $favoriteMenu->rank;

            if ($request->hasFile('image')) {
                if ($favoriteMenu->image && Storage::exists(str_replace('storage/', 'public/', $favoriteMenu->image))) {
                    Storage::delete(str_replace('storage/', 'public/', $favoriteMenu->image));
                }
                $imageName = time().'.'.$request->image->extension();  
                $request->image->storeAs('public/favorite_menu_images', $imageName);
                $data['image'] = 'storage/favorite_menu_images/'.$imageName;
            }

            if ($newRank != $oldRank) {
                $collidingMenu = FavoriteMenu::where('rank', $newRank)->where('id', '!=', $favoriteMenu->id)->first();
                if ($collidingMenu) {
                    $collidingMenu->update(['rank' => $oldRank]);
                }
            }
            
            $favoriteMenu->update($data);
            DB::commit();

            return redirect()->route('admin.favorite-menus.index')
                             ->with('success', 'Menu favorit berhasil diperbarui.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Gagal memperbarui menu favorit: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FavoriteMenu $favoriteMenu) 
    {
        DB::beginTransaction();
        try {
            if ($favoriteMenu->image && Storage::exists(str_replace('storage/', 'public/', $favoriteMenu->image))) {
                 Storage::delete(str_replace('storage/', 'public/', $favoriteMenu->image));
            }
            $favoriteMenu->delete();
            DB::commit();

            return redirect()->route('admin.favorite-menus.index')
                             ->with('success', 'Menu favorit berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.favorite-menus.index')
                             ->with('error', 'Gagal menghapus menu favorit: ' . $e->getMessage());
        }
    }
}