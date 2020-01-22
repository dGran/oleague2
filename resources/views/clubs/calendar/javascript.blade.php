<script>
    var season_slug = {!! json_encode(active_season()->slug) !!};

    $(function() {
        $('#matchDetailsModal').on('show.bs.modal', function(e) {
			var match_id = $(this).attr("data-id");
			var competition_slug = $(this).attr("competition_slug");
            var url = '{{ route("competitions.calendar.match.details", [":season_slug", ":competition_slug", ":match_id"]) }}';
            url = url.replace(':season_slug', season_slug);
            url = url.replace(':competition_slug', competition_slug);
            url = url.replace(':match_id', match_id);
            $.ajax({
                url         : url,
                type        : 'GET',
                datatype    : 'html',
            }).done(function(data){
                $('#modal-dialog-match-details').html(data);
            });
        });

        $("#matchDetailsModal").on("hidden.bs.modal", function(){
            $('#modal-dialog-match-details').html("");
        });
    });
</script>