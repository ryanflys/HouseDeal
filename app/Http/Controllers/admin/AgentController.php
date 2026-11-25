<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Agent;
use Illuminate\Http\Request;

class AgentController extends Controller
{
    /**
     * Display a listing of agents.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Agent::query();

        if ($keyword = $request->get('keyword')) {
            $query->where(function ($q) use ($keyword) {
                $q->where('name', 'like', "%{$keyword}%")
                  ->orWhere('phone', 'like', "%{$keyword}%")
                  ->orWhere('agency', 'like', "%{$keyword}%");
            });
        }

        $agents = $query->latest()->paginate(15);
        return view('admin.agents.index', compact('agents'));
    }

    /**
     * Show the form for creating a new agent.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.agents.create');
    }

    /**
     * Store a newly created agent.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'       => 'required|string|max:255',
            'phone'      => 'nullable|string|max:20',
            'email'      => 'nullable|email|max:255',
            'agency'     => 'nullable|string|max:255',
            'license_no' => 'nullable|string|max:50',
            'description'=> 'nullable|string',
            'rating'     => 'nullable|numeric|min:0|max:5',
        ]);
        Agent::create($request->all());
        return redirect()->route('admin.agents.index')->with('success', '经纪人添加成功');
    }

    /**
     * Show the form for editing the specified agent.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $agent = Agent::findOrFail($id);
        return view('admin.agents.edit', compact('agent'));
    }

    /**
     * Update the specified agent.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $agent = Agent::findOrFail($id);
        $agent->update($request->all());
        return redirect()->route('admin.agents.index')->with('success', '经纪人更新成功');
    }

    /**
     * Remove the specified agent.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Agent::findOrFail($id)->delete();
        return redirect()->route('admin.agents.index')->with('success', '经纪人已删除');
    }
}
