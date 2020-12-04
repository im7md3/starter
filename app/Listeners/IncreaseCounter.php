<?php

namespace App\Listeners;

use App\Events\VideoViewer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Contracts\Session\Session;
use Illuminate\Queue\InteractsWithQueue;

class IncreaseCounter
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
     * @param  object  $event
     * @return void
     */
    public function handle(VideoViewer $event)
    {
        $this->updateViewer($event->video);
    }


    public function updateViewer($video)
    {
        if (!Session()->has('videoIsVisited')) {
            $video->viewers = $video->viewers + 1;
            $video->save();
        }
        Session()->put('videoIsVisited', $video->id);
    }
}
