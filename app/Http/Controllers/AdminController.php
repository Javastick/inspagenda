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
    public function index()
    {
        $surat = InviteMail::latest()->get();
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
        'masuk' => 'required',
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
