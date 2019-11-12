<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class UpdateAccount extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:account';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Account information';

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
        //
        $totalUsers = \DB::table('users')->where('id','=',3)->update(['status' => 0]);


    }
}
