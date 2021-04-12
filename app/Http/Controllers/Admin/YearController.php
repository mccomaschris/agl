<?php

namespace App\Http\Controllers\Admin;

use App\Models\Year;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Week;
use Carbon\Carbon;

class YearController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $years = Year::orderBy('name', 'desc')->get();
        return view('admin.years.index', compact('years'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.years.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:years,name',
            'start_date' => 'nullable|date',
            'skip_date' => 'nullable|date',
        ]);

        $year = Year::create([
            'name' => $request->name,
            'active' => $request->active == 'on' ? 1 : 0,
            'start_date' => $request->start_date,
            'skip_date' => $request->skip_date
        ]);

        // Need to add year setup stuff

        if ($year->active) {
            DB::table('years')->where('active', 1)->where('id', '!=', $year->id)->update(['active' => 0]);
        }

        return redirect('/admin/years')->with('flash', "Year has been created.");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Year $year)
    {
        $weeks = Week::where('year_id', $year->id)->orderBy('week_order', 'desc')->get();
        $last_week = Week::where('year_id', $year->id)->where('week_date', '<=', Carbon::yesterday())->orderBy('week_date', 'desc')->first();
        return view('admin.years.edit', compact('year', 'weeks', 'last_week'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Year $year)
    {
        $this->validate($request, [
            'name' => 'required|unique:years,name,' . $year->id,
            'start_date' => 'nullable|date',
            'skip_date' => 'nullable|date'
        ]);

        $active = $request->active == 'on' ? 1 : 0;

        $request->merge(['active' => $active]);

        $year->update($request->all());

        // Need to make all other years inactive if active is selected

        if ($active) {
            DB::table('years')->where('active', 1)->where('id', '!=', $year->id)->update(['active' => 0]);
        }

        return redirect('/admin/years')->with('flash', "{$year->name} season has been edited.");
    }
}
