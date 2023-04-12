<?php

namespace App\Http\Controllers;

use App\Models\Gradebook;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        //teacher - gradebook
        // gradebook - students
        // Vuces relaciju teacher -> gradebook -> students

        $users = User::with('gradebooks')->paginate(10);

        // $users = Gradebook::with('students')->with('user')->paginate(10);

        return response()->json($users);

    }

    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
   
        // $user = Gradebook::with('students')->with('user')->findOrFail($id);
       
        // $user = Gradebook::findOrFail($id)->with('students')->with('user');
        
        $user = User::with('gradebooks')->findOrFail($id);



        return response()->json($user);

    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
