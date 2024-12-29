<?php

namespace App\Http\Controllers;

use App\Models\MembersModel;
use Illuminate\Http\Request;

class MembersController extends Controller
{
    public function index()
    {
        $members = MembersModel::all(); 
        return view('members.index', compact('members')); 
    }

    public function show($id)
    {
        $member = MembersModel::findOrFail($id); 
        return view('members.show', compact('member')); 
    }

    public function create()
    {
        return view('members.create'); 
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:members,name',
            'email' => 'required|email|unique:members,email',
            'phone' => 'nullable|numeric|digits_between:10,15',
        ]);

        $member = MembersModel::create($request->only([
            'name',
            'email',
            'phone',
        ]));

        return redirect()->route('members.index')->with('success', 'Member created successfully.');
    }

    public function edit($id)
    {
        $member = MembersModel::findOrFail($id);

        return view('members.edit', compact('member')); // Pass data anggota ke view members.edit
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:members,name,' . $id,
            'email' => 'required|email|unique:members,email,' . $id,
            'phone' => 'nullable|string|max:20',
        ]);

        $member = MembersModel::findOrFail($id);

        $member->update($request->only([
            'name',
            'email',
            'phone',
        ]));

        return redirect()->route('members.index')->with('success', 'Member updated successfully.');
    }

    public function destroy($id)
    {
        $member = MembersModel::findOrFail($id);

        $member->delete();

        return redirect()->route('members.index')->with('success', 'Member deleted successfully.');
    }
}
