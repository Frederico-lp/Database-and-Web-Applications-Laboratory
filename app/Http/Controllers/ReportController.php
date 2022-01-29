<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ReportController extends Controller
{


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $report = new Report();

        $this->authorize('create', $report);

        $report->description = $request->input('description');
        $report->userid = Auth::registered_user()->userid;
        $report->save();

        return $report;
    }

    public function delete(Request $request, $id)
    {
      $report = Report::find($id);

      $this->authorize('delete', $report);
      $report->delete();

      return $report;
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function show(Report $report)
    {
        $this->authorize('show', $report);
        return view('pages.report', ['report' => $report]);
    }

    public function list()
    {
        if (!Auth::check()) return redirect('/login');
        $this->authorize('list', Report::class);
        $reports = Auth::registered_user()->reports()->orderBy('id');
        return view('pages.reports', ['reports' => $reports]);
    }


}
