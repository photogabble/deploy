<?php

use Laravel\Lumen\Testing\DatabaseMigrations;

class RestEnvironmentTest extends TestCase
{
    use DatabaseMigrations;
    use InteractsWithExceptionHandling;
    use InteractsWithAuthentication;

    public function test_environment_list()
    {
        $this->markTestIncomplete('needs implementation');
    }

    public function test_environment_view()
    {
        $this->markTestIncomplete('needs implementation');
    }

    public function test_environment_create()
    {
        $this->markTestIncomplete('needs implementation');
    }

    public function test_environment_update()
    {
        $this->markTestIncomplete('needs implementation');
    }

    public function test_environment_delete()
    {
       $this->markTestIncomplete('needs implementation');
    }
}
