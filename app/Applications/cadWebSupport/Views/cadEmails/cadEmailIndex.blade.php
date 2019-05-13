@extends('layouts.template')
@section('pageTitle', 'Cad Web Support')
@section('content')

    <div class="animated fadeIn">
        <div class='card'>
            <div class='card-header with-border'>
                <h3 class='card-title'>Cad Emails</h3>
            </div>
            <div class='card-body'>
                <div class="row">
                    <div class="col-md-12">
                        <table id="myTable" class="table table-bordered table-hover responsive" style="width: 100%">
                            <thead>
                            <tr>
                                <th>From</th>
                                <th>Name</th>
                                <th>Subject</th>
                                <th>To</th>
                                <th>Created</th>
                                <th>Updated</th>
                                <th width='50px'>Action</th>
                            </tr>
                            <tr class="filter">
                                <th class="theadsearch"></th>
                                <th class="theadsearch"></th>
                                <th class="theadsearch"></th>
                                <th class="theadsearch"></th>
                                <th class="theadsearch"></th>
                                <th class="theadsearch"></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($cadEmails) > 0)
                                @foreach ($cadEmails as $indexKey => $cadEmail)

                                    <tr>
                                        <td><a href="{{route('selectCadEmail', $cadEmail->id)}}">{{ $cadEmail->from }}</a></td>
                                        <td>{{ $cadEmail->name }}</td>
                                        <td>{{ $cadEmail->subject }}</td>
                                        <td>{{ $cadEmail->to }}</td>
                                        <td>{{ $cadEmail->created_at }}</td>
                                        <td>{{ $cadEmail->updated_at }}</td>
                                        <td align="center">

                                            <div class="btn-group" style="min-width: 69px;">
                                                <div class="dropdown">
                                                    <button class="btn btn-default dropdown-toggle btn-xs" id="dropdownMenuButton" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        <a class="dropdown-item" href="{{route('selectCadEmail', $cadEmail->id)}}"><i class="fa fa-eye"></i>Select</a>
                                                    </div>
                                                </div>
                                            </div>

                                        </td>


                                    </tr>



                                @endforeach

                            @else
                                No Records Found

                            @endif
                            </tbody>
                        </table>

                    </div>
                </div>

            </div>
        </div>
    </div>



@endsection

@section('javascript')

    <script type="text/javascript">


        /* Plugin API method to determine is a column is sortable */
        $.fn.dataTable.Api.register( 'column().searchable()', function () {
            var ctx = this.context[0];
            return ctx.aoColumns[ this[0] ].bSearchable;
        } );


        $(document).ready(function() {

            var table = $('#myTable').DataTable( {
                //"processing": true,
                //"serverSide": true,
                //"order": [[ 2, "asc" ]],
                ///"ajax": {
                //    url: "/ajax/fetchTransactionLogs",
                //    type: "POST",
                //data: postData,
                //},
                //"dom": '<"top"lf>rt<"bottom"ip><"clear">',
                //"dom": '<"top"Blf>rt<"bottom"ip><"clear">',
                //"dom": '<"top"<B>lf>rt<"bottom"ip><"clear">',
                //dom: "Blfrtip",
//            "columnDefs": [
//                { "visible": false, "targets": [6,7] }
//            ],
//                buttons: [
//                    {
//                        extend: 'excelHtml5',
//                        text: 'Export to Excel',
//                        filename: 'InventoryLogs',
//                        title: "Inventory System - Inventory Logs",
//                        exportOptions: {
//                            columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15]
//                        }
//                    }
//                ],
                pageLength: 5000,
                "lengthMenu": [1, 20, 30, 50, 100, 5000],
                orderCellsTop: true,
                stateSave: true,
                "bStateSave": true,
                "fnStateSave": function (oSettings, oData) {
                    localStorage.setItem('DataTables', JSON.stringify(oData));
                },
                "fnStateLoad": function (oSettings) {
                    return JSON.parse(localStorage.getItem('DataTables'));
                },
                //do not display page number if 1 page
                "fnDrawCallback": function () {
                    if (Math.ceil((this.fnSettings().fnRecordsDisplay()) / this.fnSettings()._iDisplayLength) > 1) {
                        $('.dataTables_paginate').css("display", "block");
                        //$('.dataTables_length').css("display", "block");
                        //$('.dataTables_filter').css("display", "block");
                    } else {
                        $('.dataTables_paginate').css("display", "none");
                        //$('.dataTables_length').css("display", "none");
                        //$('.dataTables_filter').css("display", "none");
                    }

                },

            });



            // Add filtering
            table.columns().every( function () {
                if ( this.searchable() ) {
                    var columnIndex = this.index();
                    switch ($(".filter th:eq("+columnIndex+")").attr('class')) {
                        case 'theadselect':

                            var that = this;

                            // Create the `select` element
                            var select = $('<select class="form-control" style="width: 100px;"><option value="">filter</option></select>')
                                .appendTo(
                                    $('thead tr:eq(1) th').eq( this.index() )
                                )
                                .on( 'change', function() {
                                    that
                                        .search($(this).val())
                                        .draw();
                                } );

                            // Add data
                            this
                                .data()
                                .sort()
                                .unique()
                                .each( function(d) {
                                    if (d != "") {
                                        select.append($('<option>' + d + '</option>'));
                                    }
                                } );

                            // Restore state saved values
                            var state = this.state.loaded();
                            if ( state ) {
                                var val = state.columns[ this.index() ];
                                select.val( val.search.search );

                            }
                            break;

                        case 'theadsearch':
                            var that = this;

                            $(".filter th:eq("+columnIndex+")").html( '<input type="text" class="form-control" size="5" style="width: 75px;" placeholder="filter"/>' );


                            $( 'input', $(".filter th:eq("+columnIndex+")") ).on( 'keyup change', function () {
                                if ( that.search() !== this.value ) {
                                    that
                                        .search( this.value )
                                        .draw();
                                }
                            });


                            // Restore state - keep filter options if page is refreshed
                            var state = this.state.loaded();
                            if ( state ) {
                                table.columns().eq( 0 ).each( function ( index, colIdx ) {
                                    var colSearch = state.columns[colIdx].search;

                                    if ( colSearch.search ) {
                                        $('#myTable thead tr:eq(1) th:eq(' + index + ') input', $('.filters th')[colIdx]).val( colSearch.search );
                                    }

                                } );

                                //table.draw()
                            }


                            break;




                    }
                }
            } );



        } );



    </script>

@endsection
