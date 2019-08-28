<?php

use App\Environment;
use App\Project;
use App\Server;
use App\User;
use Laravel\Lumen\Testing\DatabaseMigrations;

class DeploymentTest extends TestCase
{
    use DatabaseMigrations;
    use InteractsWithExceptionHandling;

    /** @var User */
    private $user;

    /** @var Project */
    private $project;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = factory('App\User')->create();
        $this->project = factory('App\Project')->make();
        $this->user->projects()->save($this->project);
    }

    public function test_deploy_webook_without_signature()
    {
        $this->json('POST', $this->project->webHookPath(), [], ['X-GitHub-Delivery' => 112233, 'X-GitHub-Event' => 'push']);
        $this->assertResponseStatus(422);
    }

    public function test_deploy_webhook_with_bad_signature()
    {
        $data = [
            'ref' => 'refs/heads/master',
            'repository' => [
                'archive_url' => 'https://api.github.com/repos/Acme/Hello-World/{archive_format}{/ref}',
            ]
        ];
        $sig = '112233445566';

        $this->json('POST', $this->project->webHookPath(), $data, ['X-GitHub-Delivery' => 112233, 'X-Hub-Signature' => $sig, 'X-GitHub-Event' => 'push']);
        $this->assertResponseStatus(401);
    }

    public function test_deploy_webhook_with_no_environments()
    {
        $data = [
            'ref' => 'refs/heads/master',
            'repository' => [
                'archive_url' => 'https://api.github.com/repos/Acme/Hello-World/{archive_format}{/ref}',
            ]
        ];
        $sig = 'sha1=' . hash_hmac('sha1', json_encode($data), env('X_HUB_SIGNATURE'), false);

        $this->json('POST', $this->project->webHookPath(), $data, ['X-GitHub-Delivery' => 112233, 'X-Hub-Signature' => $sig, 'X-GitHub-Event' => 'push']);
        $json = $this->responseJson();
        $this->assertEquals(0, $json['jobs']);
    }

    public function test_deploy_webhook_with_environments()
    {
        $this->withoutExceptionHandling();

        /** @var Server $server */
        $server = $this->project->servers()->save(new Server([
            'name' => 'unit test example.com',
            'host' => 'example.com',
            'username' => 'example',
            'private_key' => '...',
            'public_key' => '...',
            'project_path' => '/var/www/public'
        ]));

        $environment = new Environment([
            'url' => 'https://staging.example.com',
            'branch' => 'refs/heads/master'
        ]);

        $environment->server()->associate($server);

        $this->project->environments()->save($environment);

        $data = [
            'ref' => 'refs/heads/master',
            'repository' => [
                'archive_url' => 'https://api.github.com/repos/Acme/Hello-World/{archive_format}{/ref}',
            ]
        ];
        $sig = 'sha1=' . hash_hmac('sha1', json_encode($data), env('X_HUB_SIGNATURE'), false);

        $this->json('POST', $this->project->webHookPath(), $data, ['X-GitHub-Delivery' => 112233, 'X-Hub-Signature' => $sig, 'X-GitHub-Event' => 'push']);
        $json = $this->responseJson();
        $this->assertEquals(1, $json['jobs']);
        $this->seeInDatabase('jobs', ['id' => 1]);
    }
}
