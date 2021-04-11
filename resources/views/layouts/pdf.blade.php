<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Korekt s.c.</title>
    <link href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}" async></script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
</head>
<body>
    <div id="app">
        @include('inc.nav')
        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <script>
        $(document).ready(function() {
            if(document.getElementById('table')) {
             const t = $('#table').DataTable({
                "order": [[ 1, "asc" ]],
                "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Wszystko"]],
                pageLength: parseInt(localStorage.getItem('dtPageLength')) || 10,
                 language: {
                    "emptyTable":     "Brak danych w tabeli",
                    "info":           "Pokazuje _START_ do _END_ z _TOTAL_ wyników",
                    "infoEmpty":      "Pokazuje 0 do 0 z 0 wyników",
                    "infoFiltered":   "(przefiltrowano _MAX_ wyników)",
                    "infoPostFix":    "",
                    "thousands":      ",",
                    "lengthMenu":     "Pokaż _MENU_ wyników",
                    "loadingRecords": "Ładowanie...",
                    "processing":     "Przetwarzanie...",
                    "search":         "Szukaj:",
                    "zeroRecords":    "Nie znaleziono pasujących wyników",
                    "paginate": {
                        "first":      "Pierwszy",
                        "last":       "Ostatni",
                        "next":       "Następny",
                        "previous":   "Poprzedni"
                    },
                    "aria": {
                        "sortAscending":  ": aktywuj by sortować rosnąco",
                        "sortDescending": ": aktywuj by sortować malejąco"
                    }
                }
             });
            $('#table').on( 'length.dt', function ( e, settings, len ) {
                localStorage.setItem('dtPageLength', len);
            });
            t.on( 'order.dt search.dt', function () {
                t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                    cell.innerHTML = i+1;
                });
            }).draw();
        }
    });
    </script> 
</body>
</html>
