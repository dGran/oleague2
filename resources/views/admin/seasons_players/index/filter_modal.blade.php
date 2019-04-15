<div class="modal fade" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="filterModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="frmFilter" role="search" method="get" action="{{ route('admin.season_players') }}">
                <input type="hidden" name="filtering" value="true"> {{-- field for controller --}}
                <div class="modal-header bg-light">
                    <h4 class="m-0">Opciones de tabla</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    <div class="py-2 m-0 clearfix">
                        <div class="float-left">
                            <h5 class="m-0 p-0">
                                <i class="fas fa-filter mr-1"></i>
                                Filtros
                            </h5>
                        </div>
                        <div class="float-right">
                            @if ($filterName || $filterParticipant >= 0 || $filterTeam || $filterNation || $filterPosition)
                                <ul class="nav">
                                    @if ($filterName)
                                        <li class="nav-item">
                                            <a href="" class="badge badge-secondary mr-1" onclick="cancelFilterName()">
                                                <span class="r-1">Nombre</span>
                                                <i class="fas fa-times"></i>
                                            </a>
                                        </li>
                                    @endif
                                    @if ($filterParticipant >= 0)
                                        <li class="nav-item">
                                            <a href="" class="badge badge-secondary mr-1" onclick="cancelFilterParticipant()">
                                                <span class="r-1">Participante</span>
                                                <i class="fas fa-times"></i>
                                            </a>
                                        </li>
                                    @endif
                                    @if ($filterTeam)
                                        <li class="nav-item">
                                            <a href="" class="badge badge-secondary mr-1" onclick="cancelFilterTeam()">
                                                <span class="r-1">Equipo</span>
                                                <i class="fas fa-times"></i>
                                            </a>
                                        </li>
                                    @endif
                                    @if ($filterNation)
                                        <li class="nav-item">
                                            <a href="" class="badge badge-secondary mr-1" onclick="cancelFilterNation()">
                                                <span class="r-1">País</span>
                                                <i class="fas fa-times"></i>
                                            </a>
                                        </li>
                                    @endif
                                    @if ($filterPosition)
                                        <li class="nav-item">
                                            <a href="" class="badge badge-secondary mr-1" onclick="cancelFilterPosition()">
                                                <span class="r-1">Posición</span>
                                                <i class="fas fa-times"></i>
                                            </a>
                                        </li>
                                    @endif
                                </ul>
                            @endif
                        </div>
                    </div>

                    <div class="py-3 border-top">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label for="filterName" class="mb-1">Nombre</label>
                                <input class="form-control" name="filterName" id="filterName" type="text" value="{{ $filterName ? $filterName : '' }}" aria-describedby="filterNameHelp" placeholder="Nombre">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label for="filterSeasonLarge" class="mb-1">Temporadas</label>
                                <select name="filterSeason" id="filterSeason" class="selectpicker form-control filterSeason">
                                    @foreach ($seasons as $season)
                                        @if ($season->id == $filterSeason)
                                            <option selected value="{{ $season->id }}">{{ $season->name }}</option>
                                        @else
                                            <option value="{{ $season->id }}">{{ $season->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label for="filterParticipantLarge" class="mb-1">Participantes</label>
                                <select name="filterParticipant" id="filterParticipantLarge" class="selectpicker form-control filterParticipant">
                                    <option {{ $filterParticipant == -1 ? 'selected' : '' }} value="-1">Todos los participantes</option>
                                    <option {{ $filterParticipant == 0 ? 'selected' : '' }} value="0">Agentes libres</option>
                                    @foreach ($participants as $participant)
                                        <option {{ $participant->id == $filterParticipant ? 'selected' : '' }} value="{{ $participant->id }}">{{ $participant->name() }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label for="filterTeam" class="mb-1">Equipo</label>
                                <select name="filterTeam" id="filterTeam" class="selectpicker form-control filterTeam" data-live-search="true" data-size="5">
                                    <option value="">Todas los equipos</option>
                                    @foreach ($teams as $team)
                                        <option {{ $team->team_name == $filterTeam ? 'selected' : '' }} value="{{ $team->team_name }}">{{ $team->team_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label for="filterNation" class="mb-1">País</label>
                                <select name="filterNation" id="filterNation" class="selectpicker form-control filterNation" data-live-search="true" data-size="5">
                                    <option value="">Todas los paises</option>
                                    @foreach ($nations as $nation)
                                        <option {{ $nation->nation_name == $filterNation ? 'selected' : '' }} value="{{ $nation->nation_name }}">{{ $nation->nation_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label for="filterPosition" class="mb-1">Posiciones</label>
                                <select name="filterPosition" id="filterPosition" class="selectpicker form-control filterPosition">
                                    <option value="">Todas las posiciones</option>
                                    @foreach ($positions as $pos)
                                        <option {{ $pos->position == $filterPosition ? 'selected' : '' }} value="{{ $pos->position }}">{{ $pos->position }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="filterActive" name="filterActive" {{ $filterActive ? 'checked = "checked"' : ''}}>
                                    <label class="custom-control-label is-valid" for="filterActive">
                                        <span>Ocultar inactivos</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                    </div>

                    <h5 class="py-2 m-0">
                        <i class="fas fa-sort-numeric-up mr-1"></i>
                        Orden
                    </h5>
                    <div class="py-2 border-top">
                        <div class="form-group row">
                            <div class="col-sm-12 mt-2">
                                <select name="order" class="selectpicker show-tick form-control order">
                                    <option value="default" {{ $order == 'default' ? 'selected' : '' }}>Por defecto</option>
                                    <option value="date_desc" {{ $order == 'date_desc' ? 'selected' : '' }} data-icon="fas fa-sort-amount-up">Los últimos al principio</option>
                                    <option value="date" {{ $order == 'date' ? 'selected' : '' }} data-icon="fas fa-sort-amount-down">Los últimos al final</option>
                                    <option value="name" {{ $order == 'name' ? 'selected' : '' }} data-icon="fas fa-sort-alpha-up">Por nombre</option>
                                    <option value="name_desc" {{ $order == 'name_desc' ? 'selected' : '' }} data-icon="fas fa-sort-alpha-down">Por nombre</option>
                                    <option value="overall" {{ $order == 'overall' ? 'selected' : '' }} data-icon="fas fa-sort-numeric-up">Por media</option>
                                    <option value="overall_desc" {{ $order == 'overall_desc' ? 'selected' : '' }} data-icon="fas fa-sort-numeric-down">Por media</option>
                                    <option value="position" {{ $order == 'position' ? 'selected' : '' }} data-icon="fas fa-sort-alpha-up">Por posición</option>
                                    <option value="position_desc" {{ $order == 'position_desc' ? 'selected' : '' }} data-icon="fas fa-sort-alpha-down">Por posición</option>
                                    <option value="age" {{ $order == 'age' ? 'selected' : '' }} data-icon="fas fa-sort-numeric-up">Por edad</option>
                                    <option value="age_desc" {{ $order == 'age_desc' ? 'selected' : '' }} data-icon="fas fa-sort-numeric-down">Por edad</option>
                                    <option value="height" {{ $order == 'height' ? 'selected' : '' }} data-icon="fas fa-sort-numeric-up">Por altura</option>
                                    <option value="height_desc" {{ $order == 'height_desc' ? 'selected' : '' }} data-icon="fas fa-sort-numeric-down">Por altura</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <h5 class="py-2 m-0">
                        <i class="far fa-eye mr-1"></i>
                        Visualización
                    </h5>
                    <div class="py-2 border-top">
                        <div class="form-group row">
                            <div class="col-sm-12 mt-2">
                                <select name="pagination" class="selectpicker show-tick form-control pagination">
                                    <option value="6" {{ $pagination == '6' ? 'selected' : '' }}>6 registros / pagina</option>
                                    <option value="12" {{ $pagination == '12' || !$pagination ? 'selected' : '' }}>12 registros / pagina</option>
                                    <option value="20" {{ $pagination == '20' ? 'selected' : '' }}>20 registros / pagina</option>
                                    <option value="50" {{ $pagination == '50' ? 'selected' : '' }}>50 registros / pagina</option>
                                    <option value="100" {{ $pagination == '100' ? 'selected' : '' }}>100 registros / pagina</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Aplicar...</button>
                </div>
            </form>
        </div>
    </div>
</div>