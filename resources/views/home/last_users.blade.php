<div class="section-title">
    <div class="container">
        <h3>
            Recién llegados
        </h3>
    </div>
</div>
<div class="container py-2 text-white text-center">
    <ul style="padding: 0;">
        @foreach ($last_users as $user)
            <li class="m-2" style="list-style: none; display: inline-block;">
                <img src="{{ asset($user->profile->avatar) }}" width="64" class="rounded-circle p-1" style="border: 1px solid #161b35; background: #00d4e4">
                <small class="d-block text-truncate" style="max-width: 64px">{{ $user->name }}</small>
            </li>
        @endforeach
    </ul>
</div>