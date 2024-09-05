<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class AwardAvatars extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:award-avatars';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update avatars for the top 5 users based on score and reset avatars for users no longer in the top 5';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting to update avatars.');

        // Haal de huidige top 5 gebruikers op
        $topFive = User::orderBy('score', 'desc')->take(5)->get();
        $currentTopIds = $topFive->pluck('id')->toArray();

        

        // Verkrijg de vorige top 5 gebruikers uit de cache
        $previousTopIds = Cache::get('previous_top_five', []);
        
        // Reset avatars voor gebruikers die niet meer in de top 5 staan
        $usersToReset = User::whereIn('id', $previousTopIds)
            ->whereNotIn('id', $currentTopIds)
            ->get(['id', 'avatar_fallback']);


        foreach ($topFive as $index => $user) {
            $avatarId = $this->getAvatarIdForPosition($index);
            
            if ($avatarId !== null) {
                DB::table('users')->where('id', $user->id)->update(['avatar_id' => $avatarId]);
                $this->info("Updated avatar for user ID {$user->id} to avatar ID {$avatarId}");
            }
        }

        foreach ($usersToReset as $user) {
            DB::table('users')->where('id', $user->id)->update(['avatar_id' => $user->avatar_fallback]);
        }

        Log::debug($previousTopIds);
        Log::debug($currentTopIds);
        Log::debug($usersToReset);

        cache::flush();

        // Sla de huidige top 5 gebruikers op in de cache voor de volgende keer
        Cache::put('previous_top_five', $currentTopIds);

        $this->info('Avatars updated for the top 5 users and reset for users no longer in the top 5.');
    }

    /**
     * Verkrijg het avatar_id op basis van de positie
     *
     * @param int $position
     * @return int|null
     */
    private function getAvatarIdForPosition($position)
    {
        $avatars = [
            0 => 38, // Zeus
            1 => 37, // Poseidon
            2 => 35, // Hades
            3 => 36, // Hera
            4 => 34  // Aphrodite
        ];

        return $avatars[$position] ?? null;
    }
}
