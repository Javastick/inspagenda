<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InviteMail extends Model
{
    use HasFactory;
    protected $table = 'invite_mails';
    protected $fillable = [
        'sender',
        'masuk',
        'hari',
        'kegiatan',
        'tempat',
        'keterangan',
    ];
    public function getStatus()
    {
        $tanggalHari = Carbon::parse($this->hari)->format('Y-m-d');
        $tanggalSekarang = now()->format('Y-m-d');

        if ($tanggalHari == $tanggalSekarang) {
            return 'kini';
        } 
        
        return $tanggalHari > $tanggalSekarang ? 'berikutnya' : 'terlewat';
    }
    public function getStatusColor()
    {
        $status = $this->getStatus();
        if ($status == 'kini') {
            return 'primary';
        } elseif ($status == 'berikutnya') {
            return 'warning';
        } else {
            return 'secondary';
        }
    }
    public function getStatusHex(){
        $status = $this->getStatus();
        if ($status == 'kini') {
            return '#FFC107';
        } elseif ($status == 'berikutnya') {
            return '#17A2B8';
        } else {
            return '#6C757D';
        }
    }
    public function getPerdayEvents()
    {
        return $this->whereDate('hari', '>', now()->toDateString())
                    ->orderBy('hari', 'asc')
                    ->get()
                    ->groupBy(function ($event) {
                        return Carbon::parse($event->hari)->locale('id')->translatedFormat('l, d F Y');
                    });
    }
    public function getTodayEvents()
    {
        return $this->whereDate('hari', now()->toDateString())->orderBy('hari', 'asc')->get();
    }
    public function getUpcomingEvents()
    {
        return $this->whereDate('hari', '>', now()->toDateString())->paginate(5);
    }

    public function getDay(){
        $day = Carbon::parse($this->hari)->locale('id')->dayName;
        $date = Carbon::parse($this->hari)->format('d M Y');
        return "{$day}, {$date}";
    }
    public function getHourOnly(): Attribute
    {
        return Attribute::get(fn () => Carbon::parse($this->hari)->format('H:i'));
    }
}
