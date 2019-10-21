<script>
    var competition_slug = {!! json_encode($competition->slug) !!};
    var season_slug = {!! json_encode(active_season()->slug) !!};

    $(function() {
        $('#updateModal').on('show.bs.modal', function(e) {
            var row = $(e.relatedTarget).parents('tr');
            var id = row.attr("data-id");

            var url = '{{ route("competitions.competition.calendar.match.edit", [":season_slug", ":competition_slug", ":match_id"]) }}';
            url = url.replace(':season_slug', season_slug);
            url = url.replace(':competition_slug', competition_slug);
            url = url.replace(':match_id', id);

            $.ajax({
                url         : url,
                type        : 'GET',
                datatype    : 'html',
            }).done(function(data){
                $('#modal-dialog-update').html(data);
                $('#stats_mvp').selectpicker('refresh');
            });
        });

        $("#updateModal").on("hidden.bs.modal", function(){
            $('#modal-dialog-update').html("");
        });
    });
</script>