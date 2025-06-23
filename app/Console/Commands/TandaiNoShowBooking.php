<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Booking;
use Carbon\Carbon;

class TandaiNoShowBooking extends Command
{
    protected $signature = 'booking:noshow';
    protected $description = 'Tandai booking yang tidak hadir (no-show) secara otomatis';

    public function handle()
    {
        $now = Carbon::now();

        $bookings = Booking::where('status', 'terima')
            ->whereDate('tanggal', '<=', $now->toDateString())
            ->where(function ($query) use ($now) {
                $query->whereDate('tanggal', '<', $now->toDateString())
                    ->orWhere(function ($q) use ($now) {
                        $q->whereDate('tanggal', $now->toDateString())
                          ->whereRaw("STR_TO_DATE(jam_selesai, '%H:%i') <= ?", [$now->copy()->subMinutes(15)->format('H:i')]);
                    });
            })
            ->update(['status' => 'no-show']);

        $this->info('Booking yang no-show telah diperbarui.');
    }
}
