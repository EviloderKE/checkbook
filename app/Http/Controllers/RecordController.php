<?php

namespace App\Http\Controllers;

use App\Models\Record;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Validation\Rule;
use phpDocumentor\Reflection\Types\Compound;

class RecordController extends Controller
{

    public function __construct(){
        $this->middleware('auth');

        View::share('recordType', config('common.record_type'));

        View::share('recordAction', config('common.record_action'));

        View::share('recordTag', config('common.record_tag'));
    }

    /**
     * @param Record $record
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Record $record)
    {
        $info = $record->paginate(15);

        return view('record.index', compact('info'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
            'amount' => 'bail|required|numeric|min:0',
            'tag' => ['bail', 'required', Rule::in([1, 2, 3, 4, 5, 6])],
            'note' => 'bail|required|max:200'
        ]);

        $data = $request->input();
        $data['user_id'] = Auth::id();

        $result = $record->fill($data)->save();
        if($result){
            return redirect()->route('records.index')->with('message', '写入成功');
        }else{
            return back()->with('errors', '写入失败');
        }
    }

    /**
     * @param Record $record
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Record $record)
    {
        return view('record.edit', compact('record'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param $record
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Record $record)
    {
        $this->validate($request, [
            'type' => ['bail', 'required', Rule::in(['1', '2'])],
            //|date_format:"Y-m-d H:i:s"
            'datetime' => 'bail|required',
            'action' => ['bail', 'required', Rule::in([1, 2, 3, 4])],
            'amount' => 'bail|required|numeric|min:0',
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
     * @param Record $record
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Record $record)
    {
        $record->delete();
        return back()->with('message', '删除成功');
    }
}
