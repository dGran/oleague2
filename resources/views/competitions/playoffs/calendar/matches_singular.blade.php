@foreach ($round->clashes as $clash)
    @foreach ($clash->matches as $match)
        @include('competitions.playoffs.calendar.matches')
    @endforeach
@endforeach