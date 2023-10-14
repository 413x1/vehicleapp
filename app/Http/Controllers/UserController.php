<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected $data = [];

    public function __construct() {
        $this->data['page_name'] = 'Users';
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $login_user = Auth::user();
        if ($login_user->role == 'root') {
            $this->data['users'] = User::all(); 
        } elseif ($login_user->role == 'admin') {
            $this->data['page_name'] = 'Staff';
            $this->data['users'] = User::where('role', 'staff')->get(); 
        }   else {
            $this->data['users'] = [];
        }

        return view('pages.users', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
