<?php

namespace App\Http\Controllers;

use App\Models\Submission;
use App\Models\Title;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

/**
 * Class SubmissionController
 * @package App\Http\Controllers
 */
class SubmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $submissions = Submission::paginate();

        return view('submission.index', compact('submissions'))->with('i', (request()->input('page', 1) - 1) * $submissions->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $submission = new Submission();
        $submission->demand_id = $request->get('demand_id');
        $submission->user_id = Auth::user()->id;

        if ($request->get('nombre') == '') {
            //consulto los ultimos 5 titulos.
            $titles = Title::latest()->take(5)->get();
        } else {
            //creo un array con cada palabra de la variable nombre
            $arr_nombres = explode(' ', $request->get('nombre'));
            //rodeo la parabla con %
            foreach ($arr_nombres as $id => $nombre) {
                $arr_nombres[$id] = '%' . $nombre . '%';
            }
            //dd($arr_nombres);

            //consulo titulos que contengan alguna palabra del array
            $titles = Title::orWhere('artista', 'like', $arr_nombres)
                ->orWhere('titulo', 'like', $arr_nombres)
                ->get();

            if ($titles->count() == 0) {
                //doy vuelta el array y vuelvo a consultar
                $arr_nombres = array_reverse($arr_nombres);
                $titles = Title::orWhere('artista', 'like', $arr_nombres)
                    ->orWhere('titulo', 'like', $arr_nombres)
                    ->get();
            }
            // dd($titles);
        }

        return view('submission.create', compact('submission', 'titles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Submission::$rules);

        $submission = Submission::create($request->all());

        return redirect()
            ->route('submissions.index')
            ->with('success', 'Submission created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $submission = Submission::find($id);

        return view('submission.show', compact('submission'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $submission = Submission::find($id);

        return view('submission.edit', compact('submission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Submission $submission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Submission $submission)
    {
        request()->validate(Submission::$rules);

        $submission->update($request->all());

        return redirect()
            ->route('submissions.index')
            ->with('success', 'Submission updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $submission = Submission::find($id)->delete();

        return redirect()
            ->route('submissions.index')
            ->with('success', 'Submission deleted successfully');
    }
}
