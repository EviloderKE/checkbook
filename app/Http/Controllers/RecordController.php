<?php

namespace App\Http\Controllers;

use App\Models\Record;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RecordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('Record.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param $record
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Record $record)
    {
        //
        $this->validate($request, [
            'type' => [
                'bail',
                'required',
                Rule::in(['1', '2']),
            ],

            //|date_format:"Y-m-d H:i:s"
            'datetime' => 'bail|required',

            'action' => ['bail', 'required', Rule::in([1, 2, 3, 4])],

            'amount' => 'bail|required|numeric',

            'tag' => ['bail', 'required', Rule::in([1, 2, 3, 4, 5, 6])],

            'note' => 'bail|required|max:200'
        ]);

        $record->user_id = 1;
        $record->type = $request->type;
        $record->datetime = $request->datetime;
        $record->action = $request->action;
        $record->amount = $request->amount;
        $record->tag = $request->tag;
        $record->note = $request->note;
        $record->is_delete = 1;

        $res = $record->save();
        dd($res);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
