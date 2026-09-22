@extends('layouts.agent')
@section('content')
<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
   <!--middle content end here-->
   {{-- Page Heading   --}}
   <div class="row">
      <div class="custom-heading-wrapper col-lg-12">
         <h1 class="h1">History Requests</h1>
         <span class="helpNoteLink font-weight-bold" data-toggle="collapse" data-target="#notes" aria-expanded="true">Help?</span>
      </div>
      <div class="col-md-12 mb-4">
         <div class="card collapse" id="notes" style="">
            <div class="card-body">
              <h3 class="NotesHeader"><b>Notes:</b></h3>
               <ol>
                  <li>You can view all the Advertiser requests to you for services (<b>Request</b>) here.</li>
                  <li>You can view the full details of the Request by clicking the 'View' icon. The Request will
                     display all the details first provided by the Advertiser in the Request.</li>
                  <li>The Request will also note if the invitation was accepted or rejected.</li>
               </ol>
            </div>
         </div>
      </div>
   </div>
   {{-- end --}}
   <div class="row">
      <div class="col-md-12 pt-2">
         <div class="w-100">
            <div class="row">

            @if($lists->isNotEmpty())
               <div class="col-lg-12">
                  <div class="custom-search-form">
                     <form id="searchForm">
                        <label for="search">Search : </label> <input type="search" id="search" name="search" placeholder="Search by Member ID">
                     </form>
                  </div>
               </div>
               @endif

               
               <div class="col-sm-12">
                  <div id="data-container">
                     @include('agent.dashboard.Advertisers.history-requests-list')
                  </div>
               </div>

            </div>
         </div>
      </div>
   </div>
</div>
</div>
@endsection

@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">

<style>
.avatar_img img{
width: 60px;
height: 60px;
}
.gm-style-iw-chr button {display: none !important;}

.location_class {
text-align: center;
}
 </style>  

@endsection


@push('script')
<!-- file upload plugin start here -->
<!-- file upload plugin end here -->
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.js') }}"></script>
<script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google_map.api_key') }}&libraries=places&callback=initMap" async defer></script>

@endpush

@push('script')
<script>
   function fetchData(page = 1, search = '') {

      $.ajax({
         url: "{{ route('agent.history-requests') }}" + "?page=" + page + "&search=" + search,
         type: "GET",
         beforeSend: function() {
         },
         success: function(data) {
            $('#data-container').html(data);
         },
         error: function() {
            alert('Something went wrong.');
         }
      });
   }

   $(document).ready(function() {
      let debounce;
      $('#search').on('keyup', function() {
         clearTimeout(debounce);
         let search = $(this).val();
         debounce = setTimeout(function() {
            if (search.length >= 4) {
            fetchData(1, search);
            }
         }, 500);
      });

      $(document).on('click', '.pagination a', function(e) {
         e.preventDefault();
         let page = $(this).attr('href').split('page=')[1].split('&')[0];
         let search = $('#search').val();
         fetchData(page, search);
      });
   });


   document.getElementById('searchForm').addEventListener('keydown', function(event) {
      if (event.key === 'Enter') {
         event.preventDefault();
      }
   });




   
////////  Google Map Script //////////////

$(document).ready(function() 
{
    
   $('.upload-modal').on('shown.bs.modal', function () {  
        const modal = $(this);
        const mapDiv = modal.find('.modal-map-container');
        
        if (mapDiv.length === 0) return;

        const mapId = mapDiv.attr('id');
        const address = mapDiv.data('address');
        const capitalCity = mapDiv.data('capital-city') || address;

       
        if (!mapDiv.data('rendered')) {
            loadGoogleMapWithPlaces(mapId, address, capitalCity);
            mapDiv.data('rendered', true);
        } else {
            if (mapDiv.data('mapInstance')) {
                const map = mapDiv.data('mapInstance');
                google.maps.event.trigger(map, 'resize');
                if (mapDiv.data('mapCenter')) {
                    map.setCenter(mapDiv.data('mapCenter'));
                }
            }
        }
   });


    function loadGoogleMapWithPlaces(elementId, address, capitalCity) 
    {

         const mapElement = document.getElementById(elementId);
         if (!mapElement) return;
         const geocoder = new google.maps.Geocoder();

         geocoder.geocode({ address: address }, function(results, status) {
            if (status === "OK" && results[0]) {
                  const location = results[0].geometry.location;

                  const map = new google.maps.Map(mapElement, {
                     zoom: 16,
                     center: location,
                     mapTypeControl: false,
                     streetViewControl: false
                  });

                  const marker = new google.maps.Marker({
                     position: location,
                     map: map,
                  });
               
                  $(mapElement).data('mapInstance', map);$(mapElement).data('mapCenter', location);
                  setTimeout(() => {
                     google.maps.event.trigger(map, "resize");
                     map.setCenter(location);
                  }, 300);

            
                  const service = new google.maps.places.PlacesService(map);

                  service.findPlaceFromQuery({
                     query: address,
                     fields: ["name", "photos", "rating"]
                  }, function(placeResults, placeStatus) {

                     let imageUrl = '';  
                     let placeName = capitalCity;
                     let ratingHtml = "";

                     if (placeStatus === google.maps.places.PlacesServiceStatus.OK && placeResults && placeResults[0]) {
                        const place = placeResults[0];

                        placeName = place.name || placeName;

                        if (place.rating) {
                              ratingHtml = `<div style="margin:0; font-size:12px;">Rating: ${place.rating} ⭐</div>`;
                        }

                        if (place.photos && place.photos.length > 0) {
                              imageUrl = place.photos[0].getUrl({ maxWidth: 400 });
                        }
                     }

                     let g_image = "";
                     if (imageUrl !== "") {
                        g_image = `<img style="width:100%; height:80px; object-fit:cover; border-radius:10px; margin-bottom:5px;" src="${imageUrl}" alt="location logo">`;
                     }
                     
                     
                     const content = `<div class="location_class" style="max-width:200px;"> ${g_image} <b>${address}</b></div>`;
                     const infowindow = new google.maps.InfoWindow({
                        content: content
                     });

            
                     infowindow.open(map, marker);
                     marker.addListener("click", () => {
                        infowindow.open(map, marker);
                     });
                  });

            } else {
                  mapElement.innerHTML = `<div class="p-3 text-center text-muted">Map location not found for: ${address}</div>`;
            }
         });
    }


});

////////  End Google Map Script //////////////

</script>
@endpush