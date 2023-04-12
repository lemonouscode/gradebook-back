<?php

namespace App\Http\Controllers;

use App\Models\Gradebook;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;

class GradebookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $gradebooks = Gradebook::with('user')->paginate(10);
        
        return response()->json($gradebooks);

    }

    public function getGradebookWithoutTeachers()
    {
        
        $users = User::doesntHave('gradebooks')->get();

        return response()->json($users);
    }


    public function myGradebook(string $id)
    {

        $gradebook = User::findOrFail($id);

        return response()->json($gradebook);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required|string|min:2|max:255',
            'user_id' => 'exists:users,id|nullable|unique:gradebooks,user_id'
        ]);


        $gradebook = Gradebook::create($request->all());


        return response()->json($gradebook);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $gradebooks = Gradebook::with('user')->findOrFail($id);
        
        return response()->json($gradebooks);

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

        $gradebook=Gradebook::find($id);
        $gradebook->delete();

        return response()->json(["status"=>'Deleted Succefully']);
    }
}
