@extends('layouts.app.master')

@section('title', Str::ucfirst($prefix))

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/prism.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendors/datatables.css') }}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
    <h3>Kelola {{ $prefix }}</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">{{ Str::ucfirst($prefix) }}</li>
    <li class="breadcrumb-item active">Index</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row starter-main">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Data</h5>
                    </div>
                    <div class="card-body">
                        <table class="display" id="table-index">
                            <thead>
                                <tr>
                                    <th width="5%">#</th>
                                    <th>Nama {{ Str::ucfirst($prefix) }}</th>
                                    <th>Hak Akses</th>
                                    <th width="20%">Aksi</th>
                                </tr>
                            </thead>

                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

@section('js')
    <script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatables/datatable.custom.js') }}"></script>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#table-index').DataTable({
                serverSide: true,
                ajax: '{{ route('role.get') }}',
                columns: [{
                        data: 'id',
                        name: 'id',
                        searchable: false,
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart +
                                1; // add 1 to start at 1 instead of 0
                        }
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'permissions',
                        name: 'permissions.name',
                        render: function(data) {
                            var html = "<ul>";
                            data.map(function(permission) {
                                html += "<li>" + permission.name + "</li>"
                            });
                            html += "</ul>";

                            return html;
                        }
                    },
                    {
                        data: null,
                        name: 'action',
                        searchable: false,
                        orderable: false,
                        render: function(data, type, row) {
                            var edit_url = "{{ route('role.edit', ['id' => 'id']) }}".replace('id',
                                row.id);
                            var delete_url = "{{ route('role.delete', ['id' => 'id']) }}".replace(
                                'id',
                                row.id);
                            return '<a href="' + edit_url +
                                '" class="btn btn-outline-info"><i class="fa fa-pencil"></i></a> ' +
                                '<a href="' + delete_url +
                                '" class="btn btn-outline-danger"><i class="fa fa-trash"></i></a> ';
                        }
                    },
                ]
            });
        });
    </script>
@endsection
