@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
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
                          <th>Nom Estudi</th>
                          <th>Dia</th>
                          <th>Hora</th>
                          <th>Email</th>
                          <th>Estat</th>
                          <th>Accions</th>
                        </tr>
                      </thead>
                      <tfoot>
                        <tr>
                          <th>ID</th>
                          <th>Nom Estudi</th>
                          <th>Dia</th>
                          <th>Hora</th>
                          <th>Email</th>
                          <th>Estat</th>
                          <th>Accions</th>
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
    const table = $('#example2').DataTable( {
        'processing': true,
        'ajax': {
            'url': '/api/cites',
            'dataSrc': ''
        },
        'deferRender': true,
        'columns': [
            { 'data': 'id' },
            { 'data': 'dia.estudi.nom_estudi' },
            { 'data': 'dia.dia' },
            { 'data': 'hora' },
            { 'data': 'email' },
            { 'data': 'estat' },
            {
              'data': null,
              'defaultContent':
                '<div class="btn-group" role="group">'
                + '<button class="btn btn-xs btn-warning" id="block">'
                +   '<span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span>'
                + '</button>'
                + '<button class="btn btn-xs btn-danger" id="cancel">'
                +   '<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>'
                + '</button></div>'
            }
        ],
        'language': window.dt_lang_catalan
    });
    $('#example2 tbody').on('click', 'button', function() {
      const data = table.row($(this).parents('tr')).data();
      window.axios.get('/api/cita/'+data.id+'/'+$(this).attr('id'))
        .then(response => {
          data.email = response.data.email;
          data.estat = response.data.estat;
          table.row($(this).parents('tr')).data(data).draw();
        })
        .catch(e => {
          if(!!e && !!e.response && !!e.response.data && !!e.response.data.message) {
            if(e.response.data.message === 'ple') alert('No es pot bloquejar una cita plena');
          }
        });
    });
});


</script>
@endsection
