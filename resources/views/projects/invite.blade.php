<div class="card flex flex-col mt-3">
    <h3 class="font-normal text-xl mb-3 py-4 -ml-5 border-l-4 border-blue-light pl-4">
        Invite a user
    </h3>

    <form method="POST" action="{{ $project->path() . '/invitations' }}">
        @csrf
        <div class="mb-3">
            <input type="email" name="email" class="text-sm border border-grey rounded w-full py-1 px-2" placeholder="Email address">
        </div>
        <button type="submit" class="button">Invite</button>
    </form>
</div>
