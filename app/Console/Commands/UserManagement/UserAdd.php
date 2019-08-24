<?php

namespace App\Console\Commands\UserManagement;

use App\User;
use Illuminate\Console\Command;

class UserAdd extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:add {name} {email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Adds a new user to the database';

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
        $user = new User(['name' => $this->argument('name'), 'email' => $this->argument('email')]);

        $random = str_shuffle('abcdefghjklmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ234567890!$%^&!$%^&');
        $password = substr($random, 0, 32);
        $user->password = $password;

        $user->save();

        $this->line('New user added with id [<info>'. $user->id .'</info>] and password [<info>'. $password .'</info>]');

        return 0;
    }
}
