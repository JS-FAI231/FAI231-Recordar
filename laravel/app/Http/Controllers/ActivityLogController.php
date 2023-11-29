<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\Demand;
use App\Models\Submission;
use App\Models\Wish;
use App\Models\Folder;

/**
 * Class ActivityLogController
 * @package App\Http\Controllers
 */
class ActivityLogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Todos a través de la clase ActivityLog
        $activityLogs = ActivityLog::paginate();

        //Recupero los ultimos titlos a través de la clase Activity del usuario logueado
        $mostVisitedTitles = [];
        $ratedTitles = [];

        if (Auth::user()) {
            $activities = Activity::where('causer_id', Auth::user()->id)
                ->where('log_name', 'visit')
                ->orderby('description', 'DESC')
                ->get();
            foreach ($activities as $activity) {
                array_push($mostVisitedTitles, ['title' => $activity->subject, 'times' => intval($activity->description)]);
            }
            $colTimes=array_column($mostVisitedTitles,'times');
            array_multisort($colTimes, SORT_DESC, $mostVisitedTitles);
            //dd($mostVisitedTitles);

            $activities = Activity::where('causer_id', Auth::user()->id)
                ->where('log_name', 'rating')
                ->orderby('description', 'DESC')
                ->get();
            foreach ($activities as $activity) {
                array_push($ratedTitles, ['wish' => $activity->subject, 'times' => intval($activity->description)]);
            }
            $colTimes=array_column($ratedTitles,'times');
            array_multisort($colTimes, SORT_DESC, $ratedTitles);
            //dd($ratedTitles);

            $demands=Demand::where('user_id',Auth::user()->id)->get();
            $submissions=Submission::where('user_id',Auth::user()->id)->get();
            $wishes=Wish::where('user_id',Auth::user()->id)->get();
            $folders=Folder::where('user_id',Auth::user()->id)->get();
            //dd($demands);
        }
        return view('activitylog.index', compact('activityLogs','mostVisitedTitles','ratedTitles','demands','submissions','wishes','folders'))->with('i', (request()->input('page', 1) - 1) * $activityLogs->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $activityLog = new ActivityLog();
        return view('activitylog.create', compact('activityLog'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(ActivityLog::$rules);

        $activityLog = ActivityLog::create($request->all());

        return redirect()
            ->route('activitylogs.index')
            ->with('success', 'ActivityLog created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $activityLog = ActivityLog::find($id);

        return view('activitylog.show', compact('activityLog'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $activityLog = ActivityLog::find($id);

        return view('activitylog.edit', compact('activityLog'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  ActivityLog $activityLog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ActivityLog $activityLog)
    {
        request()->validate(ActivityLog::$rules);

        $activityLog->update($request->all());

        return redirect()
            ->route('activitylogs.index')
            ->with('success', 'ActivityLog updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $activityLog = ActivityLog::find($id)->delete();

        return redirect()
            ->route('activitylogs.index')
            ->with('success', 'ActivityLog deleted successfully');
    }
}
