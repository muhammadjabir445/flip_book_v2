<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;

class resetLogin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reset:user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset user apabila tidak login selama 1 hari';

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
     * @return int
     */
    public function handle()
    {
        $now = \Carbon\Carbon::now();
        $now = $now->format('Y-m-d H:i:s');
        $user = \App\User::select('updated_at',\DB::raw("TIMESTAMPDIFF(hour, updated_at, '$now') as jam"))
        ->where(\DB::raw("TIMESTAMPDIFF(hour, updated_at, '$now')"),'>=',24)
        ->where('id_role',25)
        ->update([
            'status' => 0
        ]);
    }
}
