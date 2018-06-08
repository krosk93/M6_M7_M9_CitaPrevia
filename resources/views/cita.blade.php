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

                    <p><strong>Estudi:</strong> {{$cita->dia->estudi->nom_estudi}}</p>
                    <p><strong>Hora:</strong> {{$cita->dia->dia}} {{$cita->hora}}</p>
                    <form method="POST" action="{{route('cita.destroy', ['citum' => $cita])}}">
                      {{ csrf_field() }}
                      {{ method_field('DELETE') }}
                      <button type="submit" class="btn btn-danger">Anular Cita</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
document.addEventListener('DOMContentLoaded', () => {
  const estudisEl = document.querySelector('#estudi');
  const diesEl = document.querySelector('#dies');
  const citesEl = document.querySelector('#cites');

  estudisEl.addEventListener('change', (e) => {
    fetch('/api/estudi/'+e.target.value)
      .then(response => response.json())
      .then(({dies}) => {
        while(diesEl.firstChild) diesEl.removeChild(diesEl.firstChild);
        dies.forEach(dia => {
          const diaEl = document.createElement('option');
          diaEl.value = dia.id;
          diaEl.innerHTML = dia.dia;
          diesEl.appendChild(diaEl);
        });
        diesEl.dispatchEvent(new Event('change'));
      });
  });

  diesEl.addEventListener('change', (e) => {
    fetch('/api/dia/'+e.target.value+'/buides')
      .then(response => response.json())
      .then(({cites}) => {
        while(citesEl.firstChild) citesEl.removeChild(citesEl.firstChild);
        cites.forEach(cita => {
          const citaEl = document.createElement('option');
          citaEl.value = cita.id;
          citaEl.innerHTML = cita.hora;
          citesEl.appendChild(citaEl);
        });
      });
  });

  while(estudisEl.firstChild) estudisEl.removeChild(estudisEl.firstChild);
  fetch('/api/estudis')
    .then(response => response.json())
    .then(response => {
      response.forEach(estudi => {
        const estudiEl = document.createElement('option');
        estudiEl.value = estudi.id;
        estudiEl.innerHTML = estudi.nom_estudi;
        estudisEl.appendChild(estudiEl);
      });
      estudisEl.dispatchEvent(new Event('change'));
    });
});


</script>
@endsection
