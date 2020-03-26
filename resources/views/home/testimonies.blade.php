@if ($testimonies->count() > 0)
    <div class="section-title">
        <div class="container">
            <h3>
                Testimonios
            </h3>
        </div>
    </div>

    <section>
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-10 mx-auto">
                    <div class="p-2 p-md-5 text-white rounded">
                        <!-- Bootstrap carousel-->
                        <div class="carousel slide carousel-testimonies" id="testimoniesIndicators" data-ride="carousel">
                            <!-- Bootstrap carousel indicators [nav] -->
                            <ol class="carousel-indicators mb-0">
                                @foreach ($testimonies as $key => $testimony)
                                    @if ($testimony->user && $testimony->user->profile)
                                        <li class="{{ $key == 0 ? 'active' : '' }}" data-target="#testimoniesIndicators" data-slide-to="{{ $key }}"></li>
                                    @endif
                                @endforeach
                            </ol>

                            <!-- Bootstrap inner [slides]-->
                            <div class="carousel-inner px-3 px-md-5 pb-4">
                                <!-- Carousel slide-->
                                @foreach ($testimonies as $key => $testimony)
                                    @if ($testimony->user && $testimony->user->profile)
                                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                            <div class="media">
                                            	<img class="d-none d-md-block rounded-circle img-thumbnail" src="{{ asset($testimony->user->profile->avatar) }}" alt="" width="75">
                                                <div class="media-body ml-3">
                                                    <blockquote class="blockquote border-0 p-0">
                                                        <p class="font-italic lead"> <i class="fa fa-quote-left mr-3 text-success"></i>
                                                            {{ $testimony->message }}
                                                        </p>
                                                        <footer class="blockquote-footer">
                                                            {{ $testimony->user->name }}
                                                            <cite title="Source Title">- {{ $testimony->created_at->diffForHumans() }}</cite>
                                                        </footer>
                                                    </blockquote>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach

                                <!-- Bootstrap controls [dots]-->
                                <a class="carousel-control-prev width-auto" href="#testimoniesIndicators" role="button" data-slide="prev">
                                    <i class="fa fa-angle-left text-success text-lg"></i>
                                    <span class="sr-only">Anterior</span>
                                </a>
                                <a class="carousel-control-next width-auto" href="#testimoniesIndicators" role="button" data-slide="next">
                                    <i class="fa fa-angle-right text-success text-lg"></i>
                                    <span class="sr-only">Siguiente</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif