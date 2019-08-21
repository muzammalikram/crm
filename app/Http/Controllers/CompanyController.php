<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;
use Session;
use DB;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['companies']  = Company::paginate(10);
        return view('company.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('company.create');
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
           'name' => 'required',
           'email' =>  'required',
            'website' =>  'required',
//            'logo' =>  'required|dimensions:max_width=100,max_height=100',
        ]);

        if ($request->hasFile('logo')) {
            $filenameWithExt = $request->file('logo')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extention = $request->file('logo')->getClientOriginalExtension();
            $filenameToStore = $filename . '_' . time() . '.' . $extention;
           $path = $request->file('logo')->move(storage_path('/storage/app/public'), $filenameToStore);
           if ($path){
               dd('saved');
           }else{
               dd('not saved');
           }

        }else{
            return back()->with(['error-msg' => 'Something Went Wrong']);
        }
        DB::beginTransaction();
        $addCompany = Company::create([
            'user_id' =>  auth()->user()->id,
            'name' => $request->name,
            'email' =>  $request->email,
            'website' =>  $request->website,
            'logo' => $filenameToStore,
        ]);
        if ($addCompany){
            DB::commit();
            Session::flash('success', 'Company Added successful!');
            return back();
        }else{
            DB::rollBack();
            Session::flash('error', 'Something Went Wrong');
            return back();
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
       $data['company'] = Company::findOrFail($id);
       return view('company.create', $data);
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
        $this->validate($request, [
            'name' => 'required',
            'email' =>  'required',
            'website' =>  'required',
        ]);

        if ($request->hasFile('logo')) {
            $filenameWithExt = $request->file('logo')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extention = $request->file('logo')->getClientOriginalExtension();
            $filenameToStore = $filename . '_' . time() . '.' . $extention;
            $path = $request->file('logo')->move('storage', $filenameToStore);
            $updateData = [
                'user_id' =>  auth()->user()->id,
                'name' => $request->name,
                'email' =>  $request->email,
                'website' =>  $request->website,
                'logo' => $filenameToStore
            ];
        }else{
            $updateData = [
                'user_id' =>  auth()->user()->id,
                'name' => $request->name,
                'email' =>  $request->email,
                'website' =>  $request->website
            ];
        }

        DB::beginTransaction();
        $addCompany = Company::findOrFail($id)->update($updateData);
        if ($addCompany){
            DB::commit();
            Session::flash('success', 'Company Update successful!');
            return back();
        }else{
            DB::rollBack();
            Session::flash('error', 'Something Went Wrong');
            return back();
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
        $deleteCompany = Company::findOrFail($id)->delete();
        if ($deleteCompany){
            Session::flash('success', 'Company Deleted successful!');
            return back();
        }else{
            Session::flash('error', 'Something Went Wrong');
            return back();
        }
    }
}
