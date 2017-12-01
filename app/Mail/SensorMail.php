<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SensorMail extends Mailable
{
    use Queueable, SerializesModels;

    private $sensor;
    private $overflowParam;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($sensor, $overflowParam)
    {
        $this->sensor = $sensor;
        $this->overflowParam = $overflowParam;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
            ->subject("Alerta poluare")
            ->view('emails.sensor')
            ->with([ "sensor" => $this->sensor, "overflowParam" => $this->overflowParam]);
    }
}
