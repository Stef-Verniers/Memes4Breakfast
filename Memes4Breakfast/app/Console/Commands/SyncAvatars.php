<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Avatar;
use Illuminate\Support\Facades\File;

class SyncAvatars extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'avatars:sync';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Syncing avatars...');

        $files = File::files(public_path('images/avatars'));
        $premiumfiles = File::files(public_path('images/premium_avatars'));
        $exclusivefiles = File::files(public_path('images/exclusive_avatars'));

        // Public avatars
        foreach ($files as $file) {
            $path = 'images/avatars/' . $file->getFilename();
            Avatar::updateOrCreate(
                ['path' => $path],
                [
                    'name' => pathinfo($file->getFilename(), PATHINFO_FILENAME),
                    'is_premium' => false,
                    'is_exclusive' => false
                ]
            );
        }

        // Premium avatars
        foreach ($premiumfiles as $file) {
            $path = 'images/premium_avatars/' . $file->getFilename();
            Avatar::updateOrCreate(
                ['path' => $path],
                [
                    'name' => pathinfo($file->getFilename(), PATHINFO_FILENAME),
                    'is_premium' => true,
                    'is_exclusive' => false
                ]
            );
        }

        // Exclusive avatars
        foreach ($exclusivefiles as $file) {
            $path = 'images/exclusive_avatars/' . $file->getFilename();
            Avatar::updateOrCreate(
                ['path' => $path],
                [
                    'name' => pathinfo($file->getFilename(), PATHINFO_FILENAME),
                    'is_premium' => false,
                    'is_exclusive' => true
                ]
            );
        }

        $this->info('Avatars synced successfully!');
        return 0;
    }
}
