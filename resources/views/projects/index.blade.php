@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Proyectos</div>

                <div class="card-body">

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <input type="text" name="start_date" class="form-control start_date" readonly />
                        </div>
                        <div class="col-md-4">
                            <input type="text" name="end_date" class="form-control end_date" readonly />
                        </div>
                        <div class="col-md-3">
                            <select class="form-control status_id" name="status_id">
                                <option value="">Seleccione</option>
                                @foreach($statuses as $status)
                                <option value="{{$status->id}}">{{$status->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-1">
                            <button id="filtrar" class="btn btn-danger">Filtrar</button>
                        </div>
                    </div>
                    <table class="table table-bordered table-striped projects_table" style="width: 100%;">
                        <thead>
                            <tr>
                                <th scope="col">Proyecto</th>
                                <th scope="col">Fecha de Inicio</th>
                                <th scope="col">Fecha finalizacion</th>
                                <th scope="col">Estado</th>
                                <th scope="col">Asignado a</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {

        $(".start_date").flatpickr();
        $(".end_date").flatpickr();
        $(".status_id").select2();

        const table = $('.projects_table').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            searching: false,
            ajax: {
                url: "{{route('projects.datatable')}}",
                data: function(d) {
                    d.status_id = $('.status_id').val(),
                        d.start_date = $('.start_date').val(),
                        d.end_date = $('.end_date').val()
                },
            },
            dataType: 'json',
            type: "POST",
            columns: [{
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'start_date',
                    name: 'start_date',
                },
                {
                    data: 'end_date',
                    name: 'end_date'
                },
                {
                    data: 'status.name',
                    name: 'status.name',
                },
                {
                    data: 'user.name',
                    name: 'user.name',
                },
            ],
        })

        $('#filtrar').click(function() {
            table.draw()
        })
    })
</script>
@endsection
