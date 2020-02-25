<?php

namespace Tests\Feature;

use App\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Setup\ProjectFactory;
use Tests\TestCase;

class InvitationsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function non_owners_may_not_invite_users()
    {
        $project = app(ProjectFactory::class)->create();
        $user = factory('App\User')->create();

        $assertInvitationForbidden = function() use ($user, $project) {
            $this->actingAs($user)
                ->post($project->path() . '/invitations')
                ->assertStatus(403);
        };

        $assertInvitationForbidden();

        $project->invite($user);

         $assertInvitationForbidden();
    }

    /** @test */
    function a_project_owner_can_invite_a_user()
    {
        $project = app(ProjectFactory::class)->create();

        $userToInvite = factory('App\User')->create();

        $this->actingAs($project->owner)->post($project->path() . '/invitations', [
            'email' => $userToInvite->email
        ]);

        $this->assertTrue($project->members->contains($userToInvite));
    }

    /** @test */
    function the_invited_email_address_must_be_associated_with_a_valid_birdboard_account()
    {
        $project = app(ProjectFactory::class)->create();

        $this->actingAs($project->owner)->post($project->path() . '/invitations', [
            'email' => 'notauser@gmail.com'
        ])->assertSessionHasErrors(['email' => 'The user you are inviting does not have a birdboard account'], null, 'invitations');
    }

    /** @test */
    public function invited_users_may_update_project_details()
    {
        $this->withoutExceptionHandling();
        $project = app(ProjectFactory::class)->create();

        $project->invite($newUser = factory('App\User')->create());

        $this->signIn($newUser);
        $this->post(action('ProjectTasksController@store', $project), $task = ['body' => 'Foo task']);

        $this->assertDatabaseHas('tasks', $task);
    }
}
