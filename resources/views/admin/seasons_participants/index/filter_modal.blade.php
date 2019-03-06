<div class="modal fade" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="filterModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="frmFilter" role="search" method="get" action="{{ route('admin.season_participants') }}">
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
                    </div>

                    <div class="py-3 border-top">
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
                                    @if ($active_season->participant_has_team)
                                        <option value="team" {{ $order == 'team' ? 'selected' : '' }} data-icon="fas fa-sort-alpha-up">Por nombre de equipo</option>
                                        <option value="team_desc" {{ $order == 'team_desc' ? 'selected' : '' }} data-icon="fas fa-sort-alpha-down">Por nombre de equipo</option>
                                    @endif
                                    <option value="user" {{ $order == 'user' ? 'selected' : '' }} data-icon="fas fa-sort-alpha-up">Por nombre de usuario</option>
                                    <option value="user_desc" {{ $order == 'user_desc' ? 'selected' : '' }} data-icon="fas fa-sort-alpha-down">Por nombre de usuario</option>
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