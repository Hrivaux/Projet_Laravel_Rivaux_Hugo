<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCBYyW_eWBnuoKjc3YEhNyQ0Eah31gdCgg&callback=initMap" async defer></script>
@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            {{ $annonce->libelle }}
        </div>
        <div class="card-body">
            <p>Prix : {{ number_format($annonce->prix, 2, ',', ' ') }} €</p>
            <p>État : {{ $annonce->etat }}</p>
            <p>Description : {{ $annonce->description }}</p>
            <p>Adresse : {{ $annonce->adresse }}, {{ $annonce->ville }} {{ $annonce->code_postal }}</p>

            <!-- Affichage des photos de l'annonce -->
            @if($annonce->photos->isNotEmpty())
            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    @foreach($annonce->photos as $photo)
                    <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                        <img src="{{ asset('storage/images/' . $photo->image) }}" class="d-block w-100" alt="{{ $annonce->libelle }}">
                    </div>
                    @endforeach
                </div>
                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            @else
            <p>Aucune photo disponible pour cette annonce.</p>
            @endif
            <div id="googleMap" style="height: 400px; margin-top: 20px;"></div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
 <script>

function initMap() {
    var address = "{{ $annonce->adresse }}";
    var city = "{{ $annonce->ville }}";
    var postalCode = "{{ $annonce->code_postal }}";
    
    var fullAddress = address + ", " + city + ", " + postalCode;

    var geocoder = new google.maps.Geocoder();
    geocoder.geocode({ 'address': fullAddress }, function (results, status) {
        if (status == 'OK') {
            var latitude = results[0].geometry.location.lat();
            var longitude = results[0].geometry.location.lng();

            // Vérifiez si les valeurs de latitude et longitude sont valides
            if (!isNaN(latitude) && !isNaN(longitude)) {
                var map = new google.maps.Map(document.getElementById('googleMap'), {
                    center: { lat: latitude, lng: longitude },
                    zoom: 15
                });

                var marker = new google.maps.Marker({
                    position: { lat: latitude, lng: longitude },
                    map: map,
                    title: fullAddress
                });
            } else {
                console.error('Les valeurs de latitude et longitude sont invalides.');
            }
        } else {
            alert('Erreur de géocodage : ' + status);
        }
    });
}
</script>
@endsection