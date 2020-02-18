<?php


namespace Tests\Setup;


class ProjectFactory
{
    protected $taskCount = 0;
    protected $user;

    public function withTasks($count)
    {
        $this->taskCount = $count;

        return $this;
    }

    public function ownedBy($user)
    {
        $this->user = $user;

        return $this;
    }

    public function create()
    {
        $project = factory('App\Project')->create([
            'owner_id' => $this->user ?? factory('App\User')
        ]);

        factory('App\Task', $this->taskCount)->create([
            'project_id' => $project->id
        ]);

        return $project;
    }
}
