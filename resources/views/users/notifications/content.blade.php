<div class="row justify-content-center">
    <div class="col-12 px-0 px-md-2">

        @if (auth()->user()->uread_notifications() > 0)
            <div class="p-3 border-bottom text-center">
                @if (auth()->user()->uread_notifications() == 1)
                    <strong class="text-warning">Tienes {{ auth()->user()->uread_notifications() }} notificación sin leer</strong>
                @else
                    <strong class="text-warning">Tienes {{ auth()->user()->uread_notifications() }} notificaciones sin leer</strong>
                @endif
            </div>
        @endif

        @if ($notifications->count() == 0)
            <div class="notification px-3 py-4 border-bottom text-center">
                No tienes notificaciones
            </div>
        @else
            <div class="p-3 border-bottom text-center">
                <a href="{{ route('notifications.read_all') }}" class="btn btn-success btn-sm">
                    Marcar todas como leídas
                </a>
                <a href="{{ route('notifications.destroy_all') }}" class="btn btn-danger btn-sm">
                    Eliminar todas
                </a>
            </div>
            @foreach ($notifications as $notification)
                <div class="notification p-3 border-bottom">
                    <div class="clearfix">
                        <div class="float-left">
                            @if ($notification->read)
                                <i class="far fa-envelope-open mr-2"></i>
                            @else
                                <i class="fas fa-envelope text-warning mr-2"></i>
                            @endif
                            <small class="date text-muted">
                                {{ $notification->created_at->diffForHumans() }}
                            </small>
                        </div>
                        <div class="float-right">
                            @if (!$notification->read)
                                <a href="{{ route('notifications.read', $notification->id) }}" class="text-success mx-2">
                                    <i class="fas fa-check"></i>
                                </a>
                            @endif
                            <a href="{{ route('notifications.destroy', $notification->id) }}" class="text-danger">
                                <i class="fas fa-trash"></i>
                            </a>
                        </div>
                    </div>
                    <span class="text d-block px-4 py-2">
                        {{ $notification->text }}
                        @if ($notification->trade)
                            @if ($notification->trade->participant1_id == participant_of_user()->id)
                                @if ($notification->trade->state == "refushed")
                                    <a class="d-block pt-2" href="{{ route('market.trades.sent') }}">Ver ofertas enviadas</a>
                                @endif
                                @if ($notification->trade->state == "confirmed")
                                    <a class="d-block pt-2" href="{{ route('market.agreements') }}">Ver acuerdos</a>
                                @endif
                            @elseif ($notification->trade->participant2_id == participant_of_user()->id)
                                @if ($notification->trade->state == "pending")
                                    <a class="d-block pt-2" href="{{ route('market.trades.received') }}">Ver ofertas recibidas</a>
                                @endif
                            @endif
                        @endif
                    </span>
                </div>
            @endforeach
        @endif
        <p class="p-3 m-0 text-muted" style="line-height: 1.25em">
            <small>
                @if (auth()->user()->profile->email_notifications)
                    <strong>Activado</strong> el envío de e-mail para recibir las notificaciones, puedes cambiar las preferencias desde tu <a href="{{ route('profileEdit') }}">perfil</a>.
                @else
                    <strong>Desactivado</strong> el envío de e-mail para recibir las notificaciones, puedes cambiar las preferencias desde tu <a href="{{ route('profileEdit') }}">perfil</a>.
                @endif
            </small>
        </p>
    </div>
</div>