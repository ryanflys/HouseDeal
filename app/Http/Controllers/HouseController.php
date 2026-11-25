<?php

namespace App\Http\Controllers;

use App\House;
use Illuminate\Http\Request;

class HouseController extends Controller
{
    /**
     * Display a listing of houses.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = House::with('user', 'agent');

        // 搜索
        if ($keyword = $request->get('keyword')) {
            $query->where(function ($q) use ($keyword) {
                $q->where('title', 'like', "%{$keyword}%")
                  ->orWhere('description', 'like', "%{$keyword}%")
                  ->orWhere('address', 'like', "%{$keyword}%")
                  ->orWhere('city', 'like', "%{$keyword}%")
                  ->orWhere('district', 'like', "%{$keyword}%");
            });
        }

        // 类型筛选
        if ($type = $request->get('type')) {
            $query->where('type', $type);
        }

        // 状态筛选
        if ($status = $request->get('status')) {
            $query->where('status', $status);
        }

        // 价格区间
        if ($minPrice = $request->get('min_price')) {
            $query->where('price', '>=', $minPrice);
        }
        if ($maxPrice = $request->get('max_price')) {
            $query->where('price', '<=', $maxPrice);
        }

        $houses = $query->latest()->paginate(12);
        $featured = House::featured()->latest()->limit(4)->get();

        return view('houses.index', compact('houses', 'featured'));
    }

    /**
     * Show the form for creating a new house.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('houses.create');
    }

    /**
     * Store a newly created house.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title'         => 'required|string|max:255',
            'description'   => 'nullable|string',
            'price'         => 'nullable|numeric|min:0',
            'rent_price'    => 'nullable|numeric|min:0',
            'type'          => 'required|in:new,second,rent',
            'city'          => 'nullable|string|max:50',
            'district'      => 'nullable|string|max:50',
            'address'       => 'nullable|string|max:255',
            'area'          => 'nullable|numeric|min:0',
            'bedrooms'      => 'nullable|integer|min:0',
            'living_rooms'  => 'nullable|integer|min:0',
            'bathrooms'     => 'nullable|integer|min:0',
            'floor'         => 'nullable|string',
            'total_floor'   => 'nullable|string',
            'orientation'   => 'nullable|string|max:20',
            'decoration'    => 'nullable|string|max:20',
        ]);

        $data = $request->all();
        $data['user_id'] = auth()->id();
        $data['images'] = $request->has('images') ? explode(',', $request->get('images')) : ['/img/demo/gallery-boxed.jpg'];

        House::create($data);

        return redirect()->route('user.houses')->with('success', '房源发布成功');
    }

    /**
     * Display the specified house.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $house = House::with('user', 'agent', 'deals')->findOrFail($id);
        $related = House::where('city', $house->city)
            ->where('id', '!=', $house->id)
            ->latest()
            ->limit(4)
            ->get();

        return view('houses.show', compact('house', 'related'));
    }

    /**
     * Show the form for editing the specified house.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $house = House::findOrFail($id);
        return view('houses.edit', compact('house'));
    }

    /**
     * Update the specified house.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $house = House::findOrFail($id);

        $this->validate($request, [
            'title'         => 'required|string|max:255',
            'description'   => 'nullable|string',
            'price'         => 'nullable|numeric|min:0',
            'rent_price'    => 'nullable|numeric|min:0',
            'type'          => 'required|in:new,second,rent',
            'city'          => 'nullable|string|max:50',
            'district'      => 'nullable|string|max:50',
            'address'       => 'nullable|string|max:255',
            'area'          => 'nullable|numeric|min:0',
            'bedrooms'      => 'nullable|integer|min:0',
            'living_rooms'  => 'nullable|integer|min:0',
            'bathrooms'     => 'nullable|integer|min:0',
            'floor'         => 'nullable|string',
            'total_floor'   => 'nullable|string',
            'orientation'   => 'nullable|string|max:20',
            'decoration'    => 'nullable|string|max:20',
        ]);

        $data = $request->all();
        $house->update($data);

        return redirect()->route('user.houses')->with('success', '房源更新成功');
    }

    /**
     * Remove the specified house.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        House::findOrFail($id)->delete();
        return redirect()->back()->with('success', '房源已删除');
    }
}
