<?php

namespace App\Http\Controllers;

use App\Models\Demand;
use App\Models\Submission; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

/**
 * Class DemandController
 * @package App\Http\Controllers
 */
class DemandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $demands = Demand::paginate();

        return view('demand.index', compact('demands'))
            ->with('i', (request()->input('page', 1) - 1) * $demands->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $demand = new Demand();
        $demand->user_id = Auth::user()->id;
        $demand->status='Open';
        
        return view('demand.create', compact('demand'));
    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Demand::$rules);

        $demand = Demand::create($request->all());

        return redirect()->route('demands.index')
            ->with('success', 'Demand created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $demand = Demand::find($id);

        return view('demand.show', compact('demand'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $demand = Demand::find($id);

        return view('demand.edit', compact('demand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Demand $demand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Demand $demand)
    {
        request()->validate(Demand::$rules);

        $demand->update($request->all());

        return redirect()->route('demands.index')
            ->with('success', 'Demand updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $demand = Demand::find($id)->delete();

        return redirect()->route('demands.index')
            ->with('success', 'Demand deleted successfully');
    }
}
