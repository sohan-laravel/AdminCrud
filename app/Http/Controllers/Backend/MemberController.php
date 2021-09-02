<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Model\Employee;
use App\Model\Member;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Str;
use Image;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $member = Member::orderBy('id', 'desc')->get();
        return view('backend.member.index', compact('member'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employee = Employee::orderBy('id', 'desc')->get();
        return view('backend.member.create', compact('employee'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return $request->all();

        $this->validate($request, [

            'name'  => 'required',
            'email'  => 'required|email',
        ]);

        $member = new Member();

        $member->name = $request->name;
        $member->email = $request->email;
        $member->employee_id = $request->employee_id;

        $member->save();

        Toastr::success('member Successfully Created', 'Success');

        return redirect()->route('admin.member.index');
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
        $member = Member::find($id);
        $employee = Employee::orderBy('id', 'desc')->get();

        return view('backend.member.edit', compact('member', 'employee'));
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

            'name'  => 'required',
            'email'  => 'required|email',
        ]);

        $member = Member::find($id);

        $member->name = $request->name;
        $member->email = $request->email;
        $member->employee_id = $request->employee_id;

        $member->save();

        Toastr::success('member Successfully Updated', 'Success');

        return redirect()->route('admin.member.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $member = Member::find($id);

        if (!is_null($member)) {

            $member->delete();
        }

        Toastr::success('member Successfully Deleted', 'Success');

        return back();
    }
}
