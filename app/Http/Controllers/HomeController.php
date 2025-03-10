<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\InviteMail;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $calendarEvents = InviteMail::all()->map(function ($event) {
            return [
                'title' => $event->kegiatan,
                'start' => $event->hari, // Pastikan format Y-m-d
                'url' => route('events.show', $event->id),
                'backgroundColor' => $event->getStatusColor(),
                'extendedProps' => [
                    'tempat' => $event->tempat,
                    'keterangan' => $event->keterangan
                ]
            ];
        });

        return view('home.index', [
            'events' => $calendarEvents, // Untuk kalender
            'upcomings' => (new InviteMail)->getPerdayEvents()->take(2),
            'todays' => (new InviteMail)->getTodayEvents()
        ]);
    }

    public function daily($date)
    {
        // Validasi format tanggal
        $events = InviteMail::whereDate('hari', $date)->get();
        
        return view('home.daily', [
            'date' => Carbon::parse($date)->locale('id'),
            'events' => $events
        ]);
    }

    public function show($id)
    {
        $event = InviteMail::findOrFail($id);
        return view('home.show', compact('event'));
    }
}
