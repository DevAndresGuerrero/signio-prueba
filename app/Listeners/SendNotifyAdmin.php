<?php

namespace App\Listeners;

use App\Mail\NotifyAdmin;
use App\Services\AdminService;
use App\Event\UserCreatedByAdmin;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendNotifyAdmin {
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct() {}

    /**
     * Handle the event.
     *
     * @param  \App\Event\UserCreatedByAdmin  $event
     * @return void
     */
    public function handle(UserCreatedByAdmin $event) {
		Mail::to($event->email)->send(new NotifyAdmin());
    }
}
