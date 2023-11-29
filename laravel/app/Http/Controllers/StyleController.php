<?php

namespace App\Http\Controllers;

use App\Models\Style;
use App\Models\Gender;
use Illuminate\Http\Request;

/**
 * Class StyleController
 * @package App\Http\Controllers
 */
class StyleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $styles = Style::paginate();

        return view('style.index', compact('styles'))
            ->with('i', (request()->input('page', 1) - 1) * $styles->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $style = new Style();
        $genders = Gender::orderby('genero')->get(); 
        return view('style.create', compact('style','genders'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Style::$rules);

        $style = Style::create($request->all());

        return redirect()->route('styles.index')
            ->with('success', 'Style created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $style = Style::find($id);

        return view('style.show', compact('style'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $style = Style::find($id);
        $genders = Gender::orderby('genero')->get();
        return view('style.edit', compact('style','genders'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Style $style
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Style $style)
    {
        request()->validate(Style::$rules);

        $style->update($request->all());

        return redirect()->route('styles.index')
            ->with('success', 'Style updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $style = Style::find($id)->delete();

        return redirect()->route('styles.index')
            ->with('success', 'Style deleted successfully');
    }
}
