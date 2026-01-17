<?php

namespace Database\Seeders;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Database\Seeder;

class NotificationSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::find(1);

        if (!$user) {
            $this->command->error('User with ID 1 not found!');
            return;
        }

        // Récupérer tous les utilisateurs disponibles (sauf user 1)
        $availableUsers = User::where('id', '!=', 1)->pluck('id')->toArray();

        if (empty($availableUsers)) {
            $this->command->error('No other users found! Please create more users first.');
            return;
        }

        $this->command->info("Creating notifications for user: {$user->name}");
        $this->command->info("Available users for actors: " . implode(', ', $availableUsers));

        // Fonction helper pour obtenir un actor_id aléatoire
        $getRandomActor = fn() => $availableUsers[array_rand($availableUsers)];

        // Notification 1: Like récent (non lu)
        Notification::create([
            'user_id' => 1,
            'type' => 'like',
            'actor_id' => $getRandomActor(),
            'target_id' => 5,
            'is_read' => false,
            'created_at' => now()->subMinutes(5),
        ]);

        // Notification 2: Comment récent (non lu)
        Notification::create([
            'user_id' => 1,
            'type' => 'comment',
            'actor_id' => $getRandomActor(),
            'target_id' => 8,
            'is_read' => false,
            'created_at' => now()->subMinutes(15),
        ]);

        // Notification 3: Follow récent (non lu)
        Notification::create([
            'user_id' => 1,
            'type' => 'follow',
            'actor_id' => $getRandomActor(),
            'is_read' => false,
            'created_at' => now()->subMinutes(25),
        ]);

        // Notification 4: Live started (non lu)
        Notification::create([
            'user_id' => 1,
            'type' => 'live_started',
            'actor_id' => $getRandomActor(),
            'is_read' => false,
            'created_at' => now()->subHour(1),
        ]);

        // Notification 5: Comment (non lu)
        Notification::create([
            'user_id' => 1,
            'type' => 'comment',
            'actor_id' => $getRandomActor(),
            'target_id' => 3,
            'is_read' => false,
            'created_at' => now()->subHours(2),
        ]);

        // Notification 6: Like (déjà lu)
        Notification::create([
            'user_id' => 1,
            'type' => 'like',
            'actor_id' => $getRandomActor(),
            'target_id' => 12,
            'is_read' => true,
            'read_at' => now()->subMinutes(20),
            'created_at' => now()->subMinutes(30),
        ]);

        // Notification 7: Deletion (non lu)
        Notification::create([
            'user_id' => 1,
            'type' => 'deletion',
            'target_id' => 99,
            'reason' => 'Contenu ne respectant pas les règles de la communauté',
            'is_read' => false,
            'created_at' => now()->subHours(5),
        ]);

        // Notification 8: Live started (déjà lu)
        Notification::create([
            'user_id' => 1,
            'type' => 'live_started',
            'actor_id' => $getRandomActor(),
            'is_read' => true,
            'read_at' => now()->subHours(6),
            'created_at' => now()->subHours(7),
        ]);

        // Notification 9: Follow (déjà lu)
        Notification::create([
            'user_id' => 1,
            'type' => 'follow',
            'actor_id' => $getRandomActor(),
            'is_read' => true,
            'read_at' => now()->subHours(10),
            'created_at' => now()->subHours(12),
        ]);

        // Notification 10: Like (déjà lu)
        Notification::create([
            'user_id' => 1,
            'type' => 'like',
            'actor_id' => $getRandomActor(),
            'target_id' => 18,
            'is_read' => true,
            'read_at' => now()->subDay(1),
            'created_at' => now()->subDay(1)->subHours(2),
        ]);

        $this->command->info('✅ 10 notifications created successfully for user 1!');
        $this->command->info("📊 Unread: 6 | Read: 4");
        $this->command->newLine();
        $this->command->info("Types: 3 likes, 2 comments, 2 follows, 2 live_started, 1 deletion");
    }
}
