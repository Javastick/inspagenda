<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\InviteMail;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    private function formatEventForCalendar($event)
    {
        // Gabungkan tanggal dan waktu
        $startDateTime = Carbon::parse($event->hari)->setTimezone('Asia/Jakarta')->toIso8601String();

        return [
            'title' => $event->judul ?? 'Undangan', // Pastikan ada field judul
            'start' => $startDateTime,
            'color' => '#ff0000',
            'extendedProps' => [
                'tempat' => $event->tempat // Sesuaikan dengan field tempat
            ]
        ];
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $events = InviteMail::all();
        // $days = InviteMail::select('hari')->get();

        // Ubah format agar sesuai dengan FullCalendar
        // $formattedEvents = $days->map(function ($event) {
        //     return $this->formatEventForCalendar($event);
        // });


        $days = InviteMail::select('hari')->get();

    // Ubah format agar sesuai dengan FullCalendar
    $formattedEvents = $days->map(function ($event) {
        return [
            'title' => 'Undangan',
            'start' => $event->hari, // Format: YYYY-MM-DD
            'color' => 'red', // Warna merah untuk tanggal yang ditandai
        ];
    });

        // Kirim data ke view
        return view('home', [
            'days' => $formattedEvents,
            'events' => $events,
            'upcomings' => (new InviteMail)->getPerdayEvents(),
            'todays' => (new InviteMail)->getTodayEvents()
        ]);
    }

    
    public function daily($date)
{
    // Validasi format tanggal
    try {
        $parsedDate = Carbon::parse($date);
    } catch (\Exception $e) {
        abort(404);
    }

    // Ambil jadwal untuk tanggal tersebut
    $schedules = InviteMail::whereDate('hari', $parsedDate)->orderBy('hari', 'asc')->get();

    return view('daily-schedule', [
        'date' => $parsedDate,
        'schedules' => $schedules
    ]);
}
    public function admin(){
        return view('admin');
    }
}
