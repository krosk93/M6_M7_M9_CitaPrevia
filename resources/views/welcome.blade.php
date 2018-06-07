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
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{route('cita.store')}}">
                      {{ csrf_field() }}
                      <div class="form-group">
                          <label for="estudi">Estudi</label>
                          <select class="form-control" id="estudi">
                          </select>
                      </div>
                      <div class="form-group">
                          <label for="dia">Dies</label>
                          <select class="form-control" id="dies" disabled>
                          </select>
                      </div>
                      <div class="form-group">
                          <label for="hora">Hora</label>
                          <select class="form-control" id="cites" name="cita">
                          </select>
                      </div>
                      <div class="form-group">
                          <label for="email">Correu electrònic</label>
                          <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com" required>
                      </div>
                      <div class="form-check">
                          <input class="form-check-input" type="checkbox" value="" id="lopd" required>
                          <label class="form-check-label" for="lopd">
                            LOPD
                          </label>
                      </div>
                      <button type="submit" class="btn btn-primary">Reservar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Buscar Cita</div>

                <div class="panel-body">
                    @if (session('buscarStatus'))
                        <div class="alert alert-danger">
                            {{ session('buscarStatus') }}
                        </div>
                    @endif
                    <form method="POST" action="{{route('cita.searchEmail')}}">
                      {{ csrf_field() }}

                      <div class="form-group">
                          <label for="buscarEmail">Correu electrònic</label>
                          <input type="email" class="form-control" name="email" id="buscarEmail" placeholder="name@example.com" required>
                      </div>
                      <button type="submit" class="btn btn-primary">Buscar</button>
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
