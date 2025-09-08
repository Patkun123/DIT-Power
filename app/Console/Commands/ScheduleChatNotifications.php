<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Services\ChatNotificationService;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ScheduleChatNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'chat:auto-notify';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automatically send scheduled chat notifications to users';

    public function __construct(private ChatNotificationService $chatNotificationService)
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $now = Carbon::now('Asia/Manila');

        // Choose a sender: an admin if available, otherwise the first user.
        $sender = User::where('role', 'admin')->first() ?: User::first();
        if (!$sender) {
            $this->warn('No users found to use as sender.');
            return self::SUCCESS;
        }

        // Define chat notification schedule slots (customize as needed)
        $slots = [
            ['time' => $now->copy()->setTime(9, 0),  'message' => 'Good morning! Say hello in the chat 👋'],
            ['time' => $now->copy()->setTime(12, 0), 'message' => 'It\'s noon! Anyone up for a quick chat?'],
            ['time' => $now->copy()->setTime(15, 0), 'message' => 'Afternoon check-in: how\'s your day going?'],
        ];

        $sent = 0;
        foreach ($slots as $slot) {
            // Within the first minute of the scheduled time
            if ($now->between($slot['time'], $slot['time']->copy()->addMinute())) {
                $count = $this->chatNotificationService->sendChatNotification(
                    $slot['message'],
                    $sender->id
                );
                $sent += $count;
                $this->info("Sent scheduled chat notification to {$count} users.");
            }
        }

        if ($sent === 0) {
            $this->info('No chat notifications needed at this time.');
        } else {
            $this->info("Total chat notifications sent: {$sent}");
        }

        return self::SUCCESS;
    }
}


