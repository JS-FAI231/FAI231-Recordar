<?php

namespace App\Http\Controllers;

use App\Models\Demand;
use App\Models\Style;
use App\Models\Submission;
use App\Models\Title;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;



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

        return view('demand.index', compact('demands'))->with('i', (request()->input('page', 1) - 1) * $demands->perPage());
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
        $demand->status = 'Open';
        $styles = Style::orderBy('estilo')->get();

        return view('demand.create', compact('demand', 'styles'));
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

        return redirect()
            ->route('demands.index')
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

        $latests=Title::orderBy('updated_at','DESC')->take(5)->get();

        if ($demand->nombre == '') {
            //consulto los ultimos 5 titulos.
            $titles = Title::orderBy('updated_at','DESC')->take(5)->get();
        } else {
            //creo un array con cada palabra de la variable nombre
            $arr_nombres = explode(' ', $demand->nombre);
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
            $titles=$titles->merge($latests);
            //dd($titles->merge($latests));
        }

        return view('demand.show', compact('demand','titles'));
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
        $styles = Style::orderBy('estilo')->get();
        return view('demand.edit', compact('demand', 'styles'));
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

        return redirect()
            ->route('demands.index')
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

        return redirect()
            ->route('demands.index')
            ->with('success', 'Demand deleted successfully');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function addMessageResponse(Request $request)
    {
        $response = ['status' => 'fail'];
        if ($request->comentario && $request->demand_id && $request->user_id) {
            $submission = new Submission();
            $submission->comentario = $request->comentario;
            $submission->demand_id = $request->demand_id;
            $submission->user_id = $request->user_id;
            $submission->title_id = $request->title_id;
            $submission->save();
            $titulo=$submission->title;
            $response = ['status' => 'ok', 'demand_user_id' => $submission->demand->user_id, 'submission' => $submission, 'title'=>$titulo];
        }
        return $response;
    }

    /**
     * Rating a user Response...
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function rateUserSubmission(Request $request)
    {
        $response = ['status' => 'fail'];
        $block = false;
        if ($request->submission_id){
            $submission = Submission::find($request->submission_id);
            $submission->rating=$request->rate;
            $submission->save();
            
            $avgRating = Submission::where('user_id',$submission->user_id)->where('rating','>',0)->avg('rating');
            
            //Guardo el promedio en el usuario
            $user=User::find($submission->user_id);
            $user->rating=$avgRating;
            $user->save();

            //$response = ['status' => 'success', 'rating'=>$averageUserRating];
            $response['status'] = 'rating';
            $response['submission'] = $submission;
            $response['avgRating']=$avgRating;
            $response['user']=$user;
            
        }

        if ($block) {
            
            //ActivityLog on 'Rating' if status is ok

            if ($response['status'] == 'ok') {
                if (Auth::user()) {
                    $activities = Activity::where('log_name', 'rating')
                        ->where('subject_type', 'App\Models\Wish')
                        ->where('subject_id', $wish->id)
                        ->where('causer_type', 'App\Models\User')
                        ->where('causer_id', Auth::user()->id)
                        ->get();

                    if (count($activities) == 0) {
                        activity('rating')
                            ->performedOn($wish)
                            ->log('1');
                    } else {
                        foreach ($activities as $activity) {
                            $activity->description = $activity->description + 1;
                            $activity->save();
                        }
                    }
                }
                $response['status'] = 'rating';
            }
        }
        return $response;
    }
}
