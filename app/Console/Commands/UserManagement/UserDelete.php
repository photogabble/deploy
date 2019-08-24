<?php

namespace App\Console\Commands\UserManagement;

use App\User;
use Exception;
use Illuminate\Console\Command;

class UserDelete extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:rm {id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deletes a given user by id';

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
     * @throws Exception
     */
    public function handle()
    {
        if (! $user = User::whereId($this->argument('id'))->first()) {
            $this->line('<error>[!]</error> No user was found with the id <info>'. $this->argument('id') .'</info>');
            return 1;
        }

        $user->delete();

        $this->line('User with id ['. $this->argument('id') .'] has been removed from the database.');

        return 0;
    }
}
