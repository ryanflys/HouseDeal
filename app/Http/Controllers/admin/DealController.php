<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Deal;
use Illuminate\Http\Request;

class DealController extends Controller
{
    /**
     * Display a listing of deals.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Deal::with('house', 'agent', 'buyer', 'seller');

        if ($status = $request->get('status')) {
            $query->where('status', $status);
        }

        $deals = $query->latest()->paginate(15);
        return view('admin.deals.index', compact('deals'));
    }

    /**
     * Show the form for editing the specified deal.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $deal = Deal::with('house', 'agent', 'buyer', 'seller')->findOrFail($id);
        return view('admin.deals.edit', compact('deal'));
    }

    /**
     * Update the specified deal.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $deal = Deal::findOrFail($id);
        $this->validate($request, [
            'status'     => 'required|in:pending,deposit,contract,done,canceled',
            'deal_price' => 'nullable|numeric|min:0',
        ]);
        $deal->update($request->only('status', 'deal_price'));
        if ($request->get('status') === 'done') {
            $deal->update(['signed_at' => now()]);
            $deal->house->update(['status' => 'sold']);
        }
        return redirect()->route('admin.deals.index')->with('success', '交易状态更新成功');
    }

    /**
     * Remove the specified deal.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Deal::findOrFail($id)->delete();
        return redirect()->route('admin.deals.index')->with('success', '交易记录已删除');
    }
}
