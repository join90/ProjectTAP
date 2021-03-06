@extends('layout.backend.master')

@section('head_extra')
<style>
    /* Always set the map height explicitly to define the size of the div
    * element that contains the map. */
    #map {
    height: 300px;
    }

    #description {
    font-family: Roboto;
    font-size: 15px;
    font-weight: 300;
    }

    #infowindow-content .title {
    font-weight: bold;
    }

    #infowindow-content {
    display: none;
    }

    #map #infowindow-content {
    display: inline;
    }

    .pac-card {
    margin: 10px 10px 0 0;
    border-radius: 2px 0 0 2px;
    box-sizing: border-box;
    -moz-box-sizing: border-box;
    outline: none;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
    background-color: #fff;
    font-family: Roboto;
    }

    #pac-container {
    padding-bottom: 12px;
    margin-right: 12px;
    }

    .pac-controls {
    display: inline-block;
    padding: 5px 11px;
    }

    .pac-controls label {
    font-family: Roboto;
    font-size: 13px;
    font-weight: 300;
    }

    #pac-input {
    background-color: #fff;
    font-family: Roboto;
    font-size: 15px;
    font-weight: 300;
    margin-left: 12px;
    padding: 0 11px 0 13px;
    text-overflow: ellipsis;
    width: 390px;
    z-index: 0;
    position: absolute;
    left: 110px !important;
    top: 13px !important;
    }

    #pac-input:focus {
    border-color: #4d90fe;
    }

    #title {
    color: #fff;
    background-color: #4d90fe;
    font-size: 25px;
    font-weight: 500;
    padding: 6px 12px;
    }
    #target {
    width: 345px;
    }
</style>
@endsection

@section('heading')
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Modifica <i>{{ $shop->nomeNegozio }}</i>
            </h1>
        </div>
    </div>
    <!-- /.row -->
@endsection

@section('content')
    @if(count($errors) > 0)
        <div class="row">
            <div class="col-sm-12">
                <div class="alert alert-danger" role="alert">
                    {!! Html::ul($errors->all()) !!}
                </div>
            </div>
        </div>
    @endif
    <div class="row">
        {!! Form::model($shop, ['method' => 'PUT', 'action' => ['SellerController@update', $shop->id], 'files' => true]) !!}
            <div class="col-md-6 col-sm-12">
                <div class="form-group">
                    {!! Form::file('imgProfilo') !!}
                </div>        
                <div class="form-group">
                    {!! Form::label('nomeNegozio', 'Nome negozio') !!}
                    {!! Form::text('nomeNegozio', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('descrizione', 'Descrizione') !!}
                    {!! Form::textarea('descrizione', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('piva', 'P.Iva') !!}
                    {!! Form::text('piva', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('GiorniApertura', 'Giorni apertura') !!}
                    {!! Form::text('GiorniApertura', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('OrariApertura', 'Orari apertura') !!}
                    {!! Form::text('OrariApertura', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('presente', 'Attivo') !!}
                    {!! Form::checkbox('presente', 'presente', ($shop->presente == 1)?true:false) !!}
                </div>            
            </div>
            <div class="col-md-6 col-sm-12">
                <input id="pac-input" class="controls" type="text" placeholder="Cerca...">
                <div id="map"></div>
                <p>&nbsp;</p>
                <div class="form-group">
                    {!! Form::label('latitudine', 'Latitudine') !!}
                    {!! Form::text('latitudine', null, ['class' => 'form-control',  'readonly']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('longitudine', 'Longitudine') !!}
                    {!! Form::text('longitudine', null, ['class' => 'form-control', 'readonly']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('indirizzo', 'Indirizzo') !!}
                    {!! Form::text('indirizzo', null, ['class' => 'form-control',  'readonly']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('citta', 'Citta') !!}
                    {!! Form::text('citta', null, ['class' => 'form-control', 'readonly']) !!}
                </div>
            </div>
            <div class="col-sm-12">
                {!! Form::submit('Modifica', ['class' => 'btn btn-primary']) !!}
            </div>
        {!! Form::close() !!}
    </div>
@endsection

@section('footer_extra')
<script>
    // This example adds a search box to a map, using the Google Place Autocomplete
    // feature. People can enter geographical searches. The search box will return a
    // pick list containing a mix of places and predicted search terms.

    // This example requires the Places library. Include the libraries=places
    // parameter when you first load the API. For example:
    // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

    function initAutocomplete() {
        var geocoder = new google.maps.Geocoder;
        var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: -33.8688, lng: 151.2195},
          zoom: 13,
          mapTypeId: 'roadmap'
        });

        // Create the search box and link it to the UI element.
        var input = document.getElementById('pac-input');
        var searchBox = new google.maps.places.SearchBox(input);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        // Bias the SearchBox results towards current map's viewport.
        map.addListener('bounds_changed', function() {
          searchBox.setBounds(map.getBounds());
        });

        var markers = [];
        // Listen for the event fired when the user selects a prediction and retrieve
        // more details for that place.
        searchBox.addListener('places_changed', function() {
          var places = searchBox.getPlaces();

          if (places.length == 0) {
            return;
          }

          // Clear out the old markers.
          markers.forEach(function(marker) {
            marker.setMap(null);
          });
          markers = [];

          // For each place, get the icon, name and location.
          var bounds = new google.maps.LatLngBounds();
          places.forEach(function(place) {
            if (!place.geometry) {
              console.log("Returned place contains no geometry");
              return;
            }
            var icon = {
              url: place.icon,
              size: new google.maps.Size(71, 71),
              origin: new google.maps.Point(0, 0),
              anchor: new google.maps.Point(17, 34),
              scaledSize: new google.maps.Size(25, 25)
            };

            // Create a marker for each place.
            markers.push(new google.maps.Marker({
              map: map,
              icon: icon,
              title: place.name,
              position: place.geometry.location
            }));

            if (place.geometry.viewport) {
              // Only geocodes have viewport.
              bounds.union(place.geometry.viewport);
            } else {
              bounds.extend(place.geometry.location);
            }

            geocoder.geocode({'location': place.geometry.location}, function(results, status) {
              if (status === 'OK') {
                if (results[1]) {
                  document.getElementById('indirizzo').value = results[0].formatted_address;
                  document.getElementById('citta').value = results[1].formatted_address;
                } else {
                  console.log('No results found');
                }
              } else {
                console.log('Geocoder failed due to: ' + status);
              }
            });

            // popolo i campi lat e long del form
            document.getElementById('latitudine').value = place.geometry.location.lat();
            document.getElementById('longitudine').value = place.geometry.location.lng();
          });
          map.fitBounds(bounds);
        });
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA983UTkguA7igNoO-SLhTPaj_ARJ_aCTE&libraries=places&callback=initAutocomplete" async defer></script>
@endsection
