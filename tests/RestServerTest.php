<?php

use Laravel\Lumen\Testing\DatabaseMigrations;

class RestServerTest extends TestCase
{
    use DatabaseMigrations;
    use InteractsWithExceptionHandling;
    use InteractsWithAuthentication;

    public function test_server_list()
    {
        $this->markTestIncomplete('needs implementation');
    }

    public function test_server_view()
    {
        $this->markTestIncomplete('needs implementation');
    }

    public function test_server_create()
    {
        $this->markTestIncomplete('needs implementation');
    }

    public function test_server_update()
    {
        $this->markTestIncomplete('needs implementation');
    }

    public function test_server_delete()
    {
       $this->markTestIncomplete('needs implementation');
    }
}
