<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Transport;
use App\Models\Tracking;

use Validator;
class TransportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Transport::all();

        return view('transport.index')->with(['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('transport.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'type' => 'required',
            'license_number' => 'required',
            'transport_code' => 'required'
        ]);

        if ($validate->fails()) {
            $error = $validate->errors();
            return redirect()->back()->withErrors($error)->withInput();
        }

        $data = [
            'name' => $request->name,
            'transport_type' => $request->type, 
            'license_number' => $request->license_number,
            'transport_code' => $request->transport_code
        ];

        Transport::create($data);

        return redirect()->route('transport.index');
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
        $data = Transport::find($id);

        return view('transport.edit')->with(['data' => $data]);
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
        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'type' => 'required',
            'license_number' => 'required',
            'transport_code' => 'required'
        ]);

        if ($validate->fails()) {
            $error = $validate->errors();
            return redirect()->back()->withErrors($error)->withInput();
        }

        $data = [
            'name' => $request->name,
            'transport_type' => $request->type, 
            'license_number' => $request->license_number,
            'transport_code' => $request->transport_code
        ];
        
        $result = Transport::find($id);

        $result->update($data);
        
        return redirect()->route('transport.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Transport::find($id);

        $transaction  = Tracking::where('id_transport', $id)->first();
        
        if (empty($transaction)) {
            $data->delete();
            return redirect()->back();
        }

        
        return redirect()->back()->withErrors(['cant_delete' => 'Cant Delete this record']);

    }
}
