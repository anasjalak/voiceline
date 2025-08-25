<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\VoiceCall;

class Voice_CallsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = VoiceCall::all(); // fetch all users from DB
       // return view('users.index', compact('users'));
    }

    /**
     * create function to Show the form for creating a new resource.
     */
    public function create()
    {
        //show form
        return view('users.create');
    }

    // Store new user

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            /* تحديد الحقول الاساسية
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:6'
            */
        ]);

        VoiceCall::create([
            
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
        ]);

        return redirect()->route('users.index')->with('success','New User created successfully');
  
    }

    /**
     * Display the specified resource.
     */
    public function show(VoiceCall $user)
    {
   return view('users.show', compact('user'));    }

    /**
     * Edit Function display the form for editing the specified resource.
     */
    public function edit(VoiceCall  $user)
    {
          return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
   // Update user
    public function update(Request $request, VoiceCall $user)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users,email,'.$user->id,
        ]);

        $user->update([
            'name'=>$request->name,
            'email'=>$request->email,
        ]);

        return redirect()->route('users.index')->with('success','User updated successfully');
    }

    // Delete user
    public function destroy(VoiceCall $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success','User deleted successfully');
    }

}
    