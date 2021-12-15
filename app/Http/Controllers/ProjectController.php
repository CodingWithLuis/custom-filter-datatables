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
        $projects = Project::with(['user', 'status'])->select('projects.*');

        if (request()->ajax()) {

            return DataTables::of($projects)
                ->make(true);
        }

        $statuses = Status::all();

        return view('projects.index', compact('statuses'));
    }
}
