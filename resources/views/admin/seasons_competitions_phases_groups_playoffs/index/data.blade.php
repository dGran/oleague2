<div class="row">
    <div class="col-12">
        <div class="pt-3">
            <h5><strong>Configuración</strong></h5>
                <ul>
                    <li>Cuadro predefinido S/N</li>
                    <li>Numero de rondas</li>
                    <li>Stats, goleadores, asistencias, tarjetas amarillas, tarjetas rojas, MVP</li>
                </ul>
        </div>

        <div class="pt-3 pb-4">
            <h5><strong>Rondas</strong></h5>
            @if ($playoff->rounds->count() == 0)
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="type_round" id="unique_round" value="1">
                    <label class="form-check-label" for="unique_round">
                        Ronda única
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="type_round" id="complete_playoff" value="0" checked>
                    <label class="form-check-label" for="complete_playoff">
                        Playoff completo
                    </label>
                </div>
                <a href="" id="btnGenerateRounds" class="btn btn-primary mt-2" data-id={{ $playoff->id }}>
                    Generar rondas
                </a>
            @else
                <a href="" id="btnResetRounds" class="btn btn-danger" data-id={{ $playoff->id }}>
                    Resetear todas las rondas
                </a>
            @endif
        </div>
    </div>
</div>


<div class="table-form-content col-12 animated fadeIn p-0 border-0">
    @if (!$playoff->rounds)
        <div class="text-center border-top py-4">
            <figure>
                <img src="{{ asset('img/table-empty.png') }}" alt="" width="72">
            </figure>
            Actualmente no existen rondas
        </div>
    @else
        <table class="table calendar">
{{--            <colgroup>
                <col width="50%" />
                <col width="0%" />
                <col width="0%" />
                <col width="0%" />
                <col width="50%" />
            </colgroup> --}}
            @foreach ($playoff->rounds as $round)
                <tr class="days border">
                    <td colspan="6" class="p-2">
                        <strong class="text-uppercase float-left">{{ $round->name }}</strong>
                    </td>
                </tr>
                <tr>
                    <td colspan="6">
                        <ul>
                            <li>editar nombre de la ronda</li>
                            <li>editar fecha limite</li>
                            <li>editar configuracion de ganancias por jugar, ganar y perder</li>
                            <li>tipo de ronda, partido unico o ida y vuelta</li>
                            <li>valor doble visitante</li>
                        </ul>
                    </td>
                </tr>
            @endforeach
        </table>

    @endif
</div>