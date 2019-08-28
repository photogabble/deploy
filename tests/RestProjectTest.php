<?php

use Laravel\Lumen\Testing\DatabaseMigrations;

class RestProjectTest extends TestCase
{
    use DatabaseMigrations;
    use InteractsWithExceptionHandling;
    use InteractsWithAuthentication;

    public function test_project_list()
    {
        $user = $this->login();

        for ($i = 0; $i < 3; $i++) {
            /** @var \App\Project $project */
            $project = factory('App\Project')->make();
            $user->projects()->save($project);
        }

        $this->assertEquals(3, $user->projects()->count());

        $this->json('GET', route('project.list'));
        $this->assertResponseOk();

        $json = $this->responseJson();
        $this->assertCount(3, $json);

        // Check users cant see one-another's projects:

        $nextUser = $user = $this->login();

        $this->assertEquals(0, $nextUser->projects()->count());
        $this->json('GET', route('project.list'));

        $json = $this->responseJson();
        $this->assertCount(0, $json);
    }

    public function test_project_view()
    {
        $user = $this->login();

        /** @var \App\Project $project */
        $project = $user->projects()->save(factory('App\Project')->make());

        $this->json('GET',$project->apiPath());
        $json = $this->responseJson();

        $this->assertEquals($project->id, $json['id']);
    }

    public function test_project_create()
    {
        $this->markTestIncomplete('needs implementation');
        $route = route('project.create');
        $n = 1;
    }

    public function test_project_update()
    {
        $this->markTestIncomplete('needs implementation');
        $route = route('project.update', ['project' => 123]);
        $n = 1;
    }

    public function test_project_delete()
    {
        $user = $this->login();

        /** @var \App\Project $project */
        $project = $user->projects()->save(factory('App\Project')->make());
        $this->seeInDatabase('projects', ['id' => $project->id]);

        $this->json('DELETE',$project->apiPath());
        $this->assertResponseStatus(204);

        $this->notSeeInDatabase('projects', ['id' => $project->id]);
    }
}
