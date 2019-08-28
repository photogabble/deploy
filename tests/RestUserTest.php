<?php

use Laravel\Lumen\Testing\DatabaseMigrations;

class RestUserTest extends TestCase
{
    use DatabaseMigrations;
    use InteractsWithExceptionHandling;
    use InteractsWithAuthentication;

    public function test_user_list()
    {
        $this->markTestIncomplete('needs implementation');
    }

    public function test_user_view()
    {
        $this->markTestIncomplete('needs implementation');
    }

    public function test_user_create()
    {
        $this->markTestIncomplete('needs implementation');
    }

    public function test_user_update()
    {
        $this->markTestIncomplete('needs implementation');
    }

    public function test_user_delete()
    {
       $this->markTestIncomplete('needs implementation');
    }
}
