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
    public function index(Record $record)
    {
        //
        $info = $record->paginate(5);
        return view('record.index', ['info' => $info]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('record.create');
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
            'type' => ['bail', 'required', Rule::in(['1', '2'])],
            //|date_format:"Y-m-d H:i:s"
            'datetime' => 'bail|required',
            'action' => ['bail', 'required', Rule::in([1, 2, 3, 4])],
            'amount' => 'bail|required|numeric',
            'tag' => ['bail', 'required', Rule::in([1, 2, 3, 4, 5, 6])],
            'note' => 'bail|required|max:200'
        ]);

        $data = $request->input();
        $data['user_id'] = 1;
        $data['is_delete'] = 1;

        $result = $record->fill($data)->save();
        if($result){
            return redirect()->route('records.index')->with('message', '写入成功');
        }else{
            return back()->with('errors', '写入失败');
        }
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
        $info = Record::where('id', $id)->first();
        return view('record.edit', ['info' => $info]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Record $record)
    {
        $this->validate($request, [
            'type' => ['bail', 'required', Rule::in(['1', '2'])],
            //|date_format:"Y-m-d H:i:s"
            'datetime' => 'bail|required',
            'action' => ['bail', 'required', Rule::in([1, 2, 3, 4])],
            'amount' => 'bail|required|numeric',
            'tag' => ['bail', 'required', Rule::in([1, 2, 3, 4, 5, 6])],
            'note' => 'bail|required|max:200'
        ]);
        $res = $record->update($request->all());
        if($res){
            return redirect()->route('records.index')->with('message', '更新成功');
        }else{
            return back()->with('errors', '更新失败');
        }
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
