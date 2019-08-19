@if(Session::has('success'))
    <script>
        $(function(){
            swal({
                className: "swal-success",
                text : '{{ session('success') }}',
                timer: 3000,
                button: false,
            })
        });
    </script>
@endif

@if(Session::has('error'))
    <script>
        $(function(){
            swal({
                className: "swal-error",
                text : '{{ session('error') }}',
                timer: 3000,
                button: false,
            })
        });
    </script>
@endif

@if(Session::has('warning'))
    <script>
        $(function(){
            swal({
                className: "swal-warning",
                text : '{{ session('warning') }}',
                timer: 3000,
                button: false,
            })
        });
    </script>
@endif

@if(Session::has('info'))
    <script>
        $(function(){
            swal({
                className: "swal-info",
                text : '{{ session('info') }}',
                timer: 3000,
                button: false,
            })
        });
    </script>
@endif