<?php

namespace App\Console\Commands;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Console\Command;

class AddTestNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notification:test {--user=1}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add a test notification for a user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $userId = $this->option('user');
        
        $user = User::find($userId);
        if (!$user) {
            $this->error("User with ID {$userId} not found.");
            return 1;
        }

        $notification = Notification::create([
            'user_id' => $userId,
            'type' => 'quiz_start',
            'title' => '🔔 Quiz Set 1 Started!',
            'message' => 'Quiz Set 1 is now available. Click here to start taking the quiz!',
            'data' => [
                'set' => 1,
                'action_url' => route('quiz')
            ]
        ]);

        $this->info("Test notification created for user: {$user->firstname} {$user->lastname}");
        $this->info("Notification ID: {$notification->id}");
        
        return 0;
    }
}
