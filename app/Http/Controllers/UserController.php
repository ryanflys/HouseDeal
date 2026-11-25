<?php

namespace App\Http\Controllers;

use App\House;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * User dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        $user = auth()->user();
        $houseCount = $user->houses()->count();
        $favoriteCount = $user->favorites()->count();
        $recentHouses = $user->houses()->latest()->limit(5)->get();

        return view('user.dashboard', compact('user', 'houseCount', 'favoriteCount', 'recentHouses'));
    }

    /**
     * My houses.
     *
     * @return \Illuminate\Http\Response
     */
    public function myHouses()
    {
        $houses = auth()->user()->houses()->latest()->paginate(10);
        return view('user.houses', compact('houses'));
    }

    /**
     * My favorites.
     *
     * @return \Illuminate\Http\Response
     */
    public function favorites()
    {
        $houses = auth()->user()->favorites()->latest()->paginate(10);
        return view('user.favorites', compact('houses'));
    }

    /**
     * Toggle favorite.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function toggleFavorite($id)
    {
        $house = House::findOrFail($id);
        $user = auth()->user();

        if ($user->favorites()->where('house_id', $id)->exists()) {
            $user->favorites()->detach($id);
            return redirect()->back()->with('success', '已取消收藏');
        }

        $user->favorites()->attach($id);
        return redirect()->back()->with('success', '收藏成功');
    }
}
