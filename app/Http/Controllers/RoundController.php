<?php

namespace App\Http\Controllers;

use App\Models\Round;
use Illuminate\Http\Request;

/**
 * Class RoundController
 * @package App\Http\Controllers
 */
class RoundController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rounds = Round::paginate();

        return view('round.index', compact('rounds'))
            ->with('i', (request()->input('page', 1) - 1) * $rounds->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $round = new Round();
        return view('round.create', compact('round'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Round::$rules);

        $round = Round::create($request->all());

        return redirect()->route('rounds.index')
            ->with('success', __('Created successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $round = Round::find($id);

        return view('round.show', compact('round'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $round = Round::find($id);

        return view('round.edit', compact('round'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Round $round
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Round $round)
    {
        request()->validate(Round::$rules);

        $round->update($request->all());

        return redirect()->route('rounds.index')
            ->with('success', __('Updated successfully'));
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $round = Round::find($id)->delete();

        return redirect()->route('rounds.index')
            ->with('success', __('Deleted successfully'));
    }
}
