@extends('layouts.principal')

@section('contenido')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title mb-0">Gestion usuarios</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/principal">Home</a>
                            </li>
                            <li class="breadcrumb-item active">Listar usuarios
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body"> 
            <!-- Inicio tabla hoverable -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Lista usuarios</h4>
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                    <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="card-content collapse show">
                                <div class="table-responsive">
                                    <table id="usuarios" style="width: 100%;" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Tipo documento</th>
                                                <th>Documento</th>
                                                <th>Correo electronico</th>
                                                <th>Rol</th>
                                                <th>Estado</th>
                                                <th>Opciones</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Fin tabla hoverable -->
        </div>
    </div>
</div>
@endsection

@section('javascript')
<script>
    $('#usuarios').DataTable({
    processing: true,
    serverSide: true,
    ajax: '/usuarios/listar',
    columns: [
        {data: 'id_usuario', name: 'id_usuario'},
        {data: 'tipo_documento', name: 'tipo_documento'},
        {data: 'documento', name: 'documento'},
        {data: 'email', name: 'email'},
        {data: 'nombre', name: 'nombre'},
        {data: 'Estado', name: 'Estado'},
        {data: 'Opciones', name: 'Opciones', orderable: false, searchable: false}
    ]
});
</script>
@endsection