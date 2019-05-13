@extends('layouts.template')
@section('pageTitle', 'Cad Web Support')
@section('content')


<div class='box box-solid '>
    <div class='box-header with-border'>
        <h3 class='box-title'>List User</h3>
    </div>
    <div class='box-body'>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered table-hover responsive nowrap" width=100%">
                    <tr>
                        <th colspan="6">Search Fields:</th>
                    </tr>
                    <tr>
                        <td><strong>User Id:</strong> {{ $userId }}</td>
                        <td><strong>Bar Num:</strong> {{ $barNum }}</td>
                        <td><strong>Email:</strong> {{ $email}}</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table id="myTable" class="table table-bordered table-hover responsive nowrap" width="100%">
                    <thead>
                    <tr>
                        <th>User Id</th>
                        <th>Bar Num</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Email Id</th>
                        <th>Law Firm</th>
                        <th width='50px'>Action</th>
                    </tr>
                    <tr class="filter">
                        <th class="theadselect"></th>
                        <th class="theadsearch"></th>
                        <th class="theadsearch"></th>
                        <th class="theadsearch"></th>
                        <th class="theadsearch"></th>
                        <th class="theadsearch"></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($users) > 0)
                        @foreach ($users as $indexKey => $user)

                            <tr>
                                <td>{{ $user->user_id }}</td>
                                <td>{{ $user->bar_num }}</td>
                                <td>{{ $user->first_name }} {{ $user->middle_name }} {{ $user->last_name }}</td>
                                <td>{{ $user->email_addr}}</td>
                                <td>{{ $user->email_addr_id}}</td>
                                <td>{{ $user->lawfirm_name }}</td>

                                <td>
                                    <a href="#confirm-delete" id="formdelete_{{$indexKey}}" data-toggle="modal" class="btn btn-danger submitBtn">Delete</a>
                                    <input type="hidden" id="userId_{{$indexKey}}" value="{{ $user->user_id }}">
                                    <input type="hidden" id="loginId_{{$indexKey}}" value="{{ $user->email_addr_id}}">
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

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <div class="col-lg-12" align="center">
                        <a href="{{route('findAccount')}}" class="btn btn-primary">Back</a>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>

<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-horizontal" id="deleteform" name="deleteform" method="POST" action="{{route('deleteAccount')}}">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Confirm Delete</h4>
                </div>

                <div class="modal-body">

                    <div>
                        <p>You are about to delete an account. This procedure is irreversible.</p>
                        <p>Do you want to proceed?</p>
                    </div>
                    <div class="modal-footer">
                        <!--a href="#" id="submit" class="btn btn-danger btn-ok">Yes</a>-->
                        <!--button type="button" class="btn btn-danger btn-ok">Yes</button>-->
                        <button class="btn btn-danger btn-ok" id="submit" type="submit">Yes</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>

                    </div>

                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group">
                                <label for="sendEmailTo" class="col-lg-3 control-label">Respond To Email:</label>
                                <div class="col-lg-8">
                                    <input type="email" class="form-control" name="formEmail" id="formEmail" value="" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group">
                                <label for="sendEmailTo" class="col-lg-3 control-label">Respond To Name:</label>
                                <div class="col-lg-8">
                                    <input type="text" class="form-control" name="formName" id="formName" value="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="formUserId" id="formUserId">
                    <input type="hidden" name="formLoginId" id="formLoginId">


                </div><!-- End of Modal body -->
                {!! csrf_field() !!}
            </form>
        </div>
    </div>
</div>

@endsection

@section('javascript')

<script type="text/javascript">

    $('.submitBtn').on('click' , function() {
        //alert("hey1");
        /* when the button in the form, display the entered values in the modal */
        var id = $(this).attr('id');
        //alert(id);
        var count = id.substr(id.indexOf("_") + 1);
        //alert($('#userId_0').val());
        $('#formUserId').val($('#userId_' + count).val());
        $('#formLoginId').val($('#loginId_' + count).val());


    });



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
            "dom": '<"top"lf>rt<"bottom"ip><"clear">',
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
