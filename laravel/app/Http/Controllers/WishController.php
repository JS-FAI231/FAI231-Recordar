<?php

namespace App\Http\Controllers;

use App\Models\Wish;
use App\Models\Folder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


/**
 * Class WishController
 * @package App\Http\Controllers
 */
class WishController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $txtFolder = $request->txtFolder;

        //dd($txtFolder);

        $wishes = Wish::where('user_id', Auth::user()->id)
            ->when($txtFolder, function ($query, $txtFolder) {
                return $query->where('folder_id', $txtFolder);
            })
            ->paginate();
        $folders = Folder::where('user_id', Auth::user()->id)
            ->orderby('nombre')
            ->get();

        return view('wish.index', compact('wishes', 'folders'))->with('i', (request()->input('page', 1) - 1) * $wishes->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $wish = new Wish();
        return view('wish.create', compact('wish'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Wish::$rules);

        $wish = Wish::create($request->all());

        return redirect()
            ->route('wishes.index')
            ->with('success', 'Wish created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $wish = Wish::find($id);

        return view('wish.show', compact('wish'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $wish = Wish::find($id);

        return view('wish.edit', compact('wish'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Wish $wish
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Wish $wish)
    {
        request()->validate(Wish::$rules);

        $wish->update($request->all());

        return redirect()
            ->route('wishes.index')
            ->with('success', 'Wish updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $wish = Wish::find($id)->delete();

        return redirect()
            ->route('wishes.index')
            ->with('success', 'Wish deleted successfully');
    }
}
