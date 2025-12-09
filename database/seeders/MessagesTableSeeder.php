<?php

namespace Database\Seeders;

use App\Models\Message;
use Illuminate\Database\Seeder;

class MessagesTableSeeder extends Seeder
{
    public function run(): void
    {
        $messages = [
            [
                'expediteur' => 1,
                'destinataire' => 2,
                'contenu' => 'Bonjour, je suis intéressé par votre annonce.',
            ],
            [
                'expediteur' => 2,
                'destinataire' => 1,
                'contenu' => 'D\'accord, quand souhaitez-vous visiter ?',
            ],
        ];

        foreach ($messages as $message) {
            try {
                Message::create($message);
            } catch (\Exception $e) {
                logger()->error("Failed to create message: " . $e->getMessage());
            }
        }
    }
} 