<?php

use Laravel\Lumen\Testing\DatabaseMigrations;

class RestDeploymentTest extends TestCase
{
    use DatabaseMigrations;
    use InteractsWithExceptionHandling;
    use InteractsWithAuthentication;

    public function test_deployment_list()
    {
        $this->markTestIncomplete('needs implementation');
    }

    public function test_deployment_view()
    {
        $this->markTestIncomplete('needs implementation');
    }

    public function test_deployment_create()
    {
        $this->markTestIncomplete('needs implementation');
    }
}
