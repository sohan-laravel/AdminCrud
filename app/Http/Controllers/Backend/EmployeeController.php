<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Model\Employee;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Str;
use Image;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employee = Employee::orderBy('id', 'desc')->get();
        return view('backend.employee.index', compact('employee'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.employee.create');
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

            'image'  => 'required|image',
            'name'  => 'required',
            'contact'  => 'required',
            'email'  => 'required|email',
            'date'  => 'required',
        ]);

        $employee = new Employee();

        $employee->name = $request->name;
        $employee->contact = $request->contact;
        $employee->email = $request->email;
        $employee->date = $request->date;

        if ($request->hasFile('image')) {
            //insert that image
            $employeeImage = $request->file('image');
            $imgName = rand(1111, 9999) . date('.d-m-y.') . '.' . $employeeImage->getClientOriginalExtension();
            $location = public_path('frontend/images/employeeImage/' . $imgName);
            Image::make($employeeImage)->save($location);


            $employee->image = $imgName;
        }

        $employee->save();

        Toastr::success('employee Successfully Created', 'Success');

        return redirect()->route('admin.employee.index');
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
        $employee = Employee::find($id);

        return view('backend.employee.edit', compact('employee'));
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
            'contact'  => 'required',
            'email'  => 'required|email',
            'date'  => 'required',
        ]);

        $employee = Employee::find($id);

        $employee->name = $request->name;
        $employee->contact = $request->contact;
        $employee->email = $request->email;
        $employee->date = $request->date;


        if ($request->image != '') {

            if (file_exists(public_path('frontend/images/employeeImage/' . $employee->image))) {
                unlink(public_path('frontend/images/employeeImage/' . $employee->image));
            }

            //insert that image
            $employeeImage = $request->file('image');
            $imgName = rand(1111, 9999) . date('.d-m-y.') . '.' . $employeeImage->getClientOriginalExtension();
            $location = public_path('frontend/images/employeeImage/' . $imgName);
            Image::make($employeeImage)->save($location);


            $employee->image = $imgName;
        }

        $employee->save();

        Toastr::success('employee Successfully Updated', 'Success');

        return redirect()->route('admin.employee.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::find($id);

        if (!is_null($employee)) {

            if (file_exists(public_path('frontend/images/employeeImage/' . $employee->image))) {
                unlink(public_path('frontend/images/employeeImage/' . $employee->image));
            }

            $employee->delete();
        }

        Toastr::success('employee Successfully Deleted', 'Success');

        return back();
    }

    public function inactive(Request $request)
    {
        $hero = Hero::findOrFail($request->id);
        $hero->status = $request->status;

        // if ($hero->status === 0) {
        //     return 0;
        // }

        $hero->save();
        //Toastr::success('Status Successfully Changed', 'Success');
        return 1;
    }
}
