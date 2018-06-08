@extends('layouts.app')

@section('content')
  <div class="container">
      <div class="row">
          <div class="col-xs-12">
              <div class="panel panel-default">
                  <div class="panel-body">
                      <div class="row">
                        <div class="col-xs-12 col-md-4">
                          <img src="/img/logo.jpg" class="img-responsive" />
                        </div>
                        <div class="col-xs-12 col-md-8">
                          <h2>Vine a estudiar a l'Institut Sant Esteve de Roures!</h2>
                          <div class="media">
                            <div class="media-left">
                              <img class="media-object img-circle" src="/img/orni.jpg" alt="El director Orni">
                            </div>
                            <div class="media-body">
                              <blockquote>
                                <p>El nostre centre és el millor en resultats acadèmics de la comarca, només per darrere dels centres més prestigiosos de La Platja de Lleida.</p>
                                <p>Fem excursions al Parc Nacional d'Aguastorcidas, i a final de curs visitem el municipi menorquí de Menorca.</p>
                                <p>A més, disposem també d'un centre rural adjunt a L'Arbog, per a que els alumnes de 1r i 2n d'ESO no s'hagin de desplaçar del poble.</p>
                                <footer>Josep Orni, director del centre</footer>
                              </blockquote>
                            </div>
                          </div>
                        </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>

  @yield('content')
@overwrite
