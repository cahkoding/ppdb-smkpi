<?php

namespace App\Listeners;

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
        Telegram::sendMessage([
            'chat_id' => '410626437',
            'text' => 'Anda memiliki pesan dari user yang harus segera dijawab!'
        ]);
    }
}
