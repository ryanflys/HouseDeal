<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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

        if ($keyword = $request->get('keyword')) {
            $query->where('title', 'like', "%{$keyword}%");
        }
        if ($status = $request->get('status')) {
            $query->where('status', $status);
        }

        $houses = $query->latest()->paginate(15);
        return view('admin.houses.index', compact('houses'));
    }

    /**
     * Show the form for creating a new house.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.houses.create');
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
            'title'       => 'required|string|max:255',
            'price'       => 'nullable|numeric|min:0',
            'type'        => 'required|in:new,second,rent',
            'city'        => 'nullable|string|max:50',
            'district'    => 'nullable|string|max:50',
            'area'        => 'nullable|numeric|min:0',
            'bedrooms'    => 'nullable|integer|min:0',
            'status'      => 'required|in:sale,sold,rent,rented,offline',
        ]);

        $data = $request->all();
        $data['user_id'] = auth()->id();
        $data['images'] = $request->has('images') ? explode(',', $request->get('images')) : ['/img/demo/gallery-boxed.jpg'];

        House::create($data);
        return redirect()->route('admin.houses.index')->with('success', '房源添加成功');
    }

    /**
     * Display the specified house.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $house = House::findOrFail($id);
        return view('admin.houses.show', compact('house'));
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
        return view('admin.houses.edit', compact('house'));
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
        $house->update($request->all());
        return redirect()->route('admin.houses.index')->with('success', '房源更新成功');
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
        return redirect()->route('admin.houses.index')->with('success', '房源已删除');
    }
}
