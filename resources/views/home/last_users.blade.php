<div class="section-title">
    <div class="container">
        <h3>
            Recién llegados
        </h3>
    </div>
</div>
<div class="container py-2 text-white text-center">
    <ul style="padding: 0">
        @foreach ($last_users as $user)
            <li class="m-2" style="list-style: none; display: inline-block;">
                <div class="text-center">
                    <img src="{{ asset($user->profile->avatar) }}" width="64">
                    <small class="d-block">{{ $user->name }}</small>
                </div>
            </li>

        @endforeach
    </ul>
</div>