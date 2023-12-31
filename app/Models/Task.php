<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;
    // Mengambil data user yang memiliki task
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public $timestamps = false;

    protected $fillable = [
        'title',
        'description',
        'status',
        'deadline',
        'finished_at',
        'priority',
        'user_id',
    ];

    // protected $guarded = [
    //     'id',
    //     'created_at',
    //     'updated_at',
    // ];

    public static function getTask() {
        return self::where('user_id', auth()->user()->id)->paginate(3);
    }

    public static function getTaskNotStarted() {
        return self::where('user_id', auth()->user()->id)->where('status', 'not_started')->paginate(3);
    }

    public static function getTaskOnProgress() {
        return self::where('user_id', auth()->user()->id)->where('status', 'on_progress')->paginate(3);
    }

    public static function getTaskCompleted() {
        return self::where('user_id', auth()->user()->id)->where('status', 'completed')->paginate(3);
    }

    public static function getTaskExpired() {
        return self::where('user_id', auth()->user()->id)->where('status', 'expired')->paginate(3);
    }


    // Jumlah Task keseluruhan
    public static function countAll() {
        return self::where('user_id', auth()->user()->id)->count();
    }

    public static function countCompleteByDate($date) {
        return self::where('user_id', auth()->user()->id)->where('finished_at', 'like', $date . '%')->count();
    }

    public static function countCompleteForLast7Days() {
        $countPerDay = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $countPerDay[$date] = self::countCompleteByDate($date);
        }

        return $countPerDay;
    }


    public static function countNotStarted() {
        return self::where('user_id', auth()->user()->id)->where('status', 'not_started')->count();
    }

    // Jumlah Task on progress
    // status enum = 'on progress'
    public static function countOnProgress() {
        return self::where('user_id', auth()->user()->id)->where('status', 'on_progress')->count();
    }

    // jumlah task yang sudah selesai
    // status enum = 'completed'
    public static function countComplete() {
        return self::where('user_id', auth()->user()->id)->where('status', 'completed')->count();
    }

    // jumlah task yang kadaluarsa
    // status enum = 'expired'
    public static function countExpired() {
        return self::where('user_id', auth()->user()->id)->where('status', 'expired')->count();
    }

    // Menghitung sisa waktu dari deadline
    public function remainingTime() {
        // Set zona waktu yang diinginkan
        $timezone = new \DateTimeZone('Asia/Jakarta');

        // Ambil waktu sekarang dengan zona waktu yang diatur
        $now = new \DateTime(null, $timezone);

        // Ambil batas waktu dari database
        $deadline = new \DateTime($this->deadline, $timezone);

        // Pastikan waktu sekarang tidak lebih besar daripada waktu batas
        if ($now > $deadline) {
            // Jika waktu sekarang lebih besar, beri nilai negatif pada objek waktu sekarang
            $now->sub($now->diff($deadline));
        }

        // Hitung selisih waktu
        $interval = $now->diff($deadline);

        // Jika selisih waktu negatif, maka tugas sudah kadaluarsa
        if ($interval->format('%r') === '-') {
            // Ubah status tugas menjadi 'expired'
            $this->status = 'expired';
            $this->save();
        }

        // Format selisih waktu
        return $interval->format('%r%d days %h hours %i minutes');
    }

}
