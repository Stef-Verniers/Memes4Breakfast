<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schedule;

class awardAvatars implements ShouldQueue
{
    use Queueable;

    protected $signature = 'jobs:avatar';

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {

        $user = Auth::user();
        
        $topFive = User::all()->sortByDesc('score')->take(5);
        
        // Zoek de positie van de huidige gebruiker in de top 5
        $position = $topFive->pluck('id')->search($user->id);

        if ($position !== false) {
            // De gebruiker bevindt zich in de top 5
            switch ($position) {
                case 0:
                    // Zeus
                    DB::table('users')->where('id', $user->id)->update(['avatar_id' => 38]);
                    break;
                case 1:
                    // Poseidon
                    DB::table('users')->where('id', $user->id)->update(['avatar_id' => 37]);
                    break;
                case 2:
                    // Hades
                    DB::table('users')->where('id', $user->id)->update(['avatar_id' => 35]);
                    break;
                case 3:
                    // Hera
                    DB::table('users')->where('id', $user->id)->update(['avatar_id' => 36]);
                    break;
                case 4:
                    // Aphrodite
                    DB::table('users')->where('id', $user->id)->update(['avatar_id' => 34]);
                    break;
            }   
        }
    }

    protected function schedule(Schedule $schedule)
    {
        $schedule->job(awardAvatars::class)->everyMinute();
    }

}
