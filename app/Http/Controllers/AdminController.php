<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\InviteMail;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    // AdminController.php
public function index(Request $request)
{
    $query = InviteMail::query();
    
    // Filter default (hanya kini & berikutnya)
    if(!$request->has('show_all')) {
        $query->whereDate('hari', '>=', now()->toDateString());
    }

    $surat = $query->orderBy('hari', 'asc')->get();
    
    return view('admin.index', compact('surat'));
}

    public function store(Request $request)
{
    $validated = $request->validate([
        'sender' => 'required|string|max:255',
        'masuk' => 'required|date',
        'hari' => 'required|date',
        'kegiatan' => 'required|string|max:255',
        'tempat' => 'required|string|max:255',
        'keterangan' => 'nullable|string'
    ]);

    InviteMail::create([
        'sender' => $request->sender,
        'masuk' => $request->masuk,
        'hari' => $request->hari,
        'kegiatan' => $request->kegiatan,
        'tempat' => $request->tempat,
        'keterangan' => $request->keterangan
    ]);

    return redirect()->route('admin')->with('success', 'Surat berhasil ditambahkan!');
}
public function edit($id)
{
    $surat = InviteMail::findOrFail($id);
    return view('admin.edit', compact('surat'));
}

public function update(Request $request, $id)
{
    $validated = $request->validate([
        'hari' => 'required',
        'sender' => 'required|string|max:255',
        'kegiatan' => 'required|string|max:255',
        'tempat' => 'required|string|max:255',
        'keterangan' => 'nullable|string',
    ]);

    $surat = InviteMail::findOrFail($id);
    $surat->update($validated);

    return redirect()->route('admin')->with('success', 'Surat berhasil diperbarui!');
}

public function destroy($id)
{
    $surat = InviteMail::findOrFail($id);
    $surat->delete();

    return redirect()->route('admin')->with('success', 'Surat berhasil dihapus!');
}
}
