<?php

namespace App\Listeners;

use App\Models\Telegram_Settings;
use App\Events\UserMengirimPesan;
use Illuminate\Queue\InteractsWithQueue;
use Telegram\Bot\Laravel\Facades\Telegram;
use Illuminate\Contracts\Queue\ShouldQueue;


class KirimPesanTelegramKeAdmin
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserMengirimPesan  $event
     * @return void
     */
    public function handle(UserMengirimPesan $event)
    {
        $telegram=Telegram_Settings::get()->first();
        Telegram::sendMessage([
            // 410626437
            'chat_id' => $telegram->chat_id,
            'text' => 'Anda memiliki pesan dari user yang harus segera dijawab!'
        ]);
    }
}
