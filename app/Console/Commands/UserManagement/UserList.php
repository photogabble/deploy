<?php

namespace App\Console\Commands\UserManagement;

use App\User;
use Exception;
use Illuminate\Console\Command;

class UserList extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Lists all users in database';

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
        $headers = ['Created At', 'Last Login',  'Name', 'Email'];
        $users = User::all(['created_at', 'last_login', 'name', 'email'])->toArray();
        $this->table($headers, $users);
        return 0;
    }
}
