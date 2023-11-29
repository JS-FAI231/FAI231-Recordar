<?php

namespace App\Http\Controllers;

use App\Models\Visit;
use Illuminate\Http\Request;

/**
 * Class VisitController
 * @package App\Http\Controllers
 */
class VisitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $visits = Visit::paginate();

        return view('visit.index', compact('visits'))
            ->with('i', (request()->input('page', 1) - 1) * $visits->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $visit = new Visit();
        return view('visit.create', compact('visit'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Visit::$rules);

        $visit = Visit::create($request->all());

        return redirect()->route('visits.index')
            ->with('success', 'Visit created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $visit = Visit::find($id);

        return view('visit.show', compact('visit'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $visit = Visit::find($id);

        return view('visit.edit', compact('visit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Visit $visit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Visit $visit)
    {
        request()->validate(Visit::$rules);

        $visit->update($request->all());

        return redirect()->route('visits.index')
            ->with('success', 'Visit updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $visit = Visit::find($id)->delete();

        return redirect()->route('visits.index')
            ->with('success', 'Visit deleted successfully');
    }
}
