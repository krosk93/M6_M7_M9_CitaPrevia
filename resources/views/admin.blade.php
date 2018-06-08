@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <img src="/img/logo.jpg" />
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Cita Previa</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-danger">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table id="example2" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Dia</th>
                          <th>Hora</th>
                          <th>Email</th>
                          <th>Estat</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tfoot>
                        <tr>
                          <th>ID</th>
                          <th>Dia</th>
                          <th>Hora</th>
                          <th>Email</th>
                          <th>Estat</th>
                          <th></th>
                        </tr>
                      </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
document.addEventListener('DOMContentLoaded', () => {
    $('#example2').DataTable( {
        'processing': true,
        'ajax': {
            'url': '/api/cites',
            'dataSrc': ''
        },
        'deferRender': true,
        'columns': [
            { 'data': 'id' },
            { 'data': 'dia.dia' },
            { 'data': 'hora' },
            { 'data': 'email' },
            { 'data': 'estat' },
            { 'data': 'dia.estudi.nom_estudi' }
        ],
        'language': window.dt_lang_catalan
    });
});


</script>
@endsection
