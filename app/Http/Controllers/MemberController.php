<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemberController extends Controller
{
    public function home()
    {
        return view('home');
    }

    public function index()
    {
        $members = Member::latest()->paginate(12);
        return view('members.index', compact('members'));
    }

    public function create()
    {
        return view('members.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'last_name' => ['required','string','max:100'],
            'first_names' => ['required','string','max:150'],
            'position_title' => ['nullable','string','max:150'],
            'member_number' => ['required','string','max:30','unique:members,member_number'],
            'join_year' => ['required','integer','between:1900,' . ((int) date('Y') + 1)],
            'photo' => ['nullable','image','max:2048'],
        ]);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('members', 'public');
        }

        Member::create([
            'last_name' => $validated['last_name'],
            'first_names' => $validated['first_names'],
            'position_title' => $validated['position_title'] ?? null,
            'member_number' => $validated['member_number'],
            'join_year' => $validated['join_year'],
            'photo_path' => $photoPath,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('members.index')->with('status', 'Membre ajouté avec succès.');
    }
}


