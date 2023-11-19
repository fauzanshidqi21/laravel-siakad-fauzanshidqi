<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    //index
    public function index()
    {
        //pagination
        $subjects = Subject::paginate(10);
        return view('pages.subjects.index', compact('subjects'));
    }

    //create
    public function create()
    {
        return view('pages.subjects.create');
    }

    //store
    public function store(Request $request)
    {
        //validate the request...
        $request->validate([
            'name' => 'required|unique:subjects|max:255',
            'description' => 'required',
            'lecturer_id' => 'required|exists:users, id',
        ]);

        Subject::create($request->all());
        return redirect()->route('subjects.index')->with('success', 'Subject created successfully.');
    }
}
