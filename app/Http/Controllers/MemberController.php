<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class MemberController extends Controller
{
    public function home()
    {
        return view('home');
    }

    public function index()
    {
        $members = Member::latest()->paginate(10);
        return view('members.index', compact('members'));
    }

    public function create()
    {
        return view('members.create');
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'last_name' => ['required', 'string', 'max:100'],
            'first_names' => ['required', 'string', 'max:150'],
            'position_title' => ['nullable', 'string', 'max:150'],
            'member_number' => ['required', 'string', 'max:30', 'unique:members,member_number'],
            'join_year' => ['required', 'integer', 'between:1900,' . ((int) date('Y') + 1)],
            'photo' => ['nullable', 'image', 'max:2048'],
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

    public function edit(Member $member)
    {
        return view('members.edit', compact('member'));
    }

    public function update(Request $request, Member $member)
    {
        $validated = $request->validate([
            'last_name' => ['required', 'string', 'max:100'],
            'first_names' => ['required', 'string', 'max:150'],
            'position_title' => ['nullable', 'string', 'max:150'],
            'member_number' => ['required', 'string', 'max:30', 'unique:members,member_number,' . $member->id],
            'join_year' => ['required', 'integer', 'between:1900,' . ((int) date('Y') + 1)],
            'photo' => ['nullable', 'image', 'max:2048'],
        ]);

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('members', 'public');
            $member->photo_path = $photoPath;
        }

        $member->last_name = $validated['last_name'];
        $member->first_names = $validated['first_names'];
        $member->position_title = $validated['position_title'] ?? null;
        $member->member_number = $validated['member_number'];
        $member->join_year = $validated['join_year'];
        $member->save();

        return redirect()->route('members.index')->with('status', 'Membre mis à jour.');
    }

    public function destroy(Member $member)
    {
        $member->delete();
        return redirect()->route('members.index')->with('status', 'Membre supprimé.');
    }

    public function print(Member $member)
    {
        // Préparer les données de la carte (réutilise le design existant)
        $html = view('members.idcard_pdf', ['member' => $member, 'preview' => false])->render();
        $pdf = Pdf::loadHTML($html)->setPaper('a6', 'portrait');

        // Nom de fichier lisible
        $filename = 'carte_membre_' . preg_replace('/\s+/', '_', strtolower($member->last_name.'_'.$member->first_names)) . '.pdf';

        return $pdf->download($filename);
    }

    public function printPreview(Member $member)
    {
        // Affiche directement la page d'aperçu imprimable (HTML standalone)
        // L'iframe du modal charge cette page; le bouton de confirmation reste dans le parent
        return view('members.idcard_pdf', ['member' => $member, 'preview' => true]);
    }
}
