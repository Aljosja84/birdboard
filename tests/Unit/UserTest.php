<?php

namespace Tests\Unit;

use App\Project;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Setup\ProjectFactory;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_has_projects()
    {
       $user = factory('App\User')->create();

       $this->assertInstanceOf(Collection::class, $user->projects);
    }

    /** @test */
    public function a_user_has_accesible_projects()
    {
        $john = $this->signIn();

        app(ProjectFactory::class)->ownedBy($john)->create();

        $this->assertCount(1, $john->accessibleProjects());

        $sally = factory('App\User')->create();

        app(ProjectFactory::class)->create()->invite($john);

        $this->assertCount(2, $john->accessibleProjects());
    }
}
