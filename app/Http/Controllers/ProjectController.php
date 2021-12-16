<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Status;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ProjectController extends Controller
{

    public function index()
    {
        $statuses = Status::all();

        return view('projects.index', compact('statuses'));
    }

    public function datatable(Request $request)
    {
        $projects = Project::with(['user', 'status'])->select('projects.*');

        if (request()->ajax()) {

            return DataTables::of($projects)
                ->filter(function ($query) use ($request) {

                    if ($request->has('status_id') && !empty($request->get('status_id'))) {
                        $query->where('status_id', $request->get('status_id'));
                    }

                    if (!empty($request->get('start_date')) && !empty($request->get('end_date'))) {

                        $query->where('start_date', '>=', $request->get('start_date'))
                            ->where('end_date', '<=', $request->get('end_date'));
                    }
                })
                ->make(true);
        }
    }
}
