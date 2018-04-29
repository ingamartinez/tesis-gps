<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SendArduinoData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'arduino:send {luz} {temperatura} {sonido} {movimiento} {status} {message} {id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Enviar información de Arduino';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        event(new \App\Events\ActualizarArduinoEvent(
            $this->argument('luz'),
            $this->argument('temperatura'),
            $this->argument('sonido'),
            $this->argument('movimiento'),

            $this->argument('status'),
            $this->argument('message'),

            $this->argument('id')
        ));
    }
}
