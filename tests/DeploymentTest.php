<?php

use Laravel\Lumen\Testing\DatabaseMigrations;

class DeploymentTest extends TestCase
{
    use DatabaseMigrations;
    use InteractsWithExceptionHandling;
    use InteractsWithAuthentication;

    public function test_deploy_webhook()
    {
       $this->markTestIncomplete('needs implementation');
    }
}
