@if (count($activity->changes['after']) == 1)
    {{ $activity->user->name }} updated the <span class="text-blue">{{ key($activity->changes['after']) }}</span> of the project
@else
    {{ $activity->user->name }} updated the project
@endif

