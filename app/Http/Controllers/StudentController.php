<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //$students =  Student::all();
        $students =  Student::latest()->paginate(10);
        $index = (request()->input('page',1)-1)*3;

        return view('index', compact('students'))->with('i',$index );
    } 

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('students.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name'=>'required',
            'sid'=>'required',
            'pw'=>'required',
            'email'=>'required'
        ]);
        $student = new Student([
            'name' => $request->get('name'),
            'sid' => $request->get('sid'),
            'email' => $request->get('email'),
            'pw' => $request->get('pw'),
            'gentle' => $request->get('gentle')
        ]);
        $student->save();
            return redirect('/students')->with('success', 'Student saved!');
            
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
        $student = Student::find($id);
        return view('edit', compact('student'));
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
        $request->validate([
                'sid'=>'required',
                'name'=>'required',
                'email'=>'required'
            ]);
            $student = Student::find($id);
            $student->sid = $request->get('sid');
            $student->name = $request->get('name');
            $student->email = $request->get('email');
            $student->gentle = $request->get('Gentle');
            $student->pw = $request->get('pw');
            
            $student->save();
            return redirect('/students')->with('success', 'Student updated!');

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
        $student = Student::find($id);
        $student->delete();
        return redirect('/students')->with('success', 'Student deleted!');

    }
}
