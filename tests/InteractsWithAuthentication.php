<?php

use App\User;

/**
 * Trait InteractsWithAuthentication
 * @mixin TestCase
 */
trait InteractsWithAuthentication
{
    /**
     * @var User
     */
    public $user;

    /**
     * Create a new random User using the User factory and authenticate
     * as them.
     *
     * @return User
     */
    public function login() : User
    {
        /** @var User $user */
        $user = factory(User::class)->create();
        return $this->loginAs($user);
    }

    /**
     * Authenticate as the given User.
     *
     * @param User $user
     * @return User
     */
    public function loginAs(User $user) : User
    {
        Cache::clear();
        $this->user = $user;
        $this->be($this->user);
        return $this->user;
    }

    /**
     * Look up user by email address and authenticate as them.
     *
     * @param string $email
     * @return User
     */
    public function loginAsEmail(string $email) : User
    {
        if (! $user = User::whereEmail($email)->first()) {
            $this->assertNotNull($user,"No user found with email [$email]");
        }
        return $this->loginAs($user);
    }
}
