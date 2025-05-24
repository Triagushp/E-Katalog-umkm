<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function __construct()
    {
        // Middleware untuk membatasi akses hanya untuk admin
        $this->middleware('admin');
    }

    // Tampilkan daftar semua event
    public function index()
    {
        $events = Event::latest()->get();
        return view('admin.events.index', compact('events'));
    }

    // Tampilkan form untuk menambahkan event baru
    public function create()
    {
        return view('admin.events.create');
    }

    // Simpan event baru ke database
    public function store(Request $request)
{
    $request->validate([
        'judul' => 'required|string|max:255',
        'deskripsi' => 'required|string',
        'tgl_mulai' => 'nullable|date',
        'tgl_berakhir' => 'nullable|date',
        'image' => 'nullable|image|max:2048',
        'contact' => 'nullable|string|max:255',
    ]);

    $imagePath = null;
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('events', 'public');
    }

    Event::create([
        'judul' => $request->judul,           
        'deskripsi' => $request->deskripsi,   
        'tgl_mulai' => $request->tgl_mulai,   
        'tgl_berakhir' => $request->tgl_berakhir, 
        'image' => $imagePath,
        'contact' => $request->contact,       
    ]);

    return redirect()->route('admin.events_index')->with('success', 'Event berhasil ditambahkan.');
}


    // Tambahan opsional: Method untuk menghapus event
    public function destroy(Event $event)
    {
        if ($event->image) {
            Storage::disk('public')->delete($event->image);
        }

        $event->delete();
        return back()->with('success', 'Event berhasil dihapus.');
    }
}
