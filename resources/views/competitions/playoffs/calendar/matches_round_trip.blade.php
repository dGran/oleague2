<tr class="round-trip">
    <td colspan="9">
        <span>Partidos de ida</span>
    </td>
</tr>
@foreach ($round->clashes as $clash)
    @foreach ($clash->matches as $match)
        @if ($match->order == 1)
            @include('competitions.playoffs.calendar.matches')
        @endif
    @endforeach
@endforeach

<tr class="round-trip">
    <td colspan="9">
        <span>Partidos de vuelta</span>
    </td>
</tr>
@foreach ($round->clashes as $clash)
    @foreach ($clash->matches as $match)
        @if ($match->order == 2)
            @include('competitions.playoffs.calendar.matches')
        @endif
    @endforeach
@endforeach