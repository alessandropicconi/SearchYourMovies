 
const url=window.location.search;
const params= new URLSearchParams(url);
var  a =params.get('id');
var id=JSON.stringify(a);
 // Questa è l'API, l'URL di base e l'URL dell'immagine
const APIKEY = 'api_key=02e3a326a583ca3d6822726c2970a704';
const BASEURL = 'https://api.themoviedb.org/3';
const IMAGEURL = 'https://image.tmdb.org/t/p/w500';
// Loop attraverso l'array dei film preferiti dell'utente visualizzato

 FAVS.forEach(async id => {
  let link = `/movie/${id}?language=en-US&`;
  let url = BASEURL + link + APIKEY;
  await apiCall(url, id);
});

// Chiamiamo la funzione per richiedere l'API
function apiCall(url, id) {
  $.get(url, function (jsonRes) {
    favMovieData(jsonRes, id);
  });
}

/// Visualizziamo i film preferiti qui
function favMovieData(jsonResp, id) {
  var eachListItem = $('<div>').addClass('list-item');
  eachListItem.html(`
  <div class="w3-container" style="background-color:#ccc; border-radius:10px; margin:20px;" >
    <div class="movie-details w3-container">
      <div class="thumbnail">
        <form action="/web/pages/movie-detail.php?id=${id}" method="post" id="myForm">
          <input type="hidden" name="movieTitle" value="${jsonResp.title}" />
          <button type="submit" name="movieId" value="${id}" style="background:none; border:none;cursor:pointer"><img id="movieimg" src= "${IMAGEURL+jsonResp.poster_path}" alt="Thumbnail">
          </button>       
        </form>   
      </div>
      <div id="details" class="w3-container w3-padding">
        <div class="title" style="margin-bottom:10px">
          <form action="/web/pages/movie-detail.php?id=${id}" method="post" id="myForm">
            <input type="hidden" name="movieTitle" value="${jsonResp.title}" />
            <button type="submit" name="movieId" value="${id}" style="background:none; border:none;cursor:pointer">${jsonResp.title} 
            </button>       
          </form>    
        </div>
        
        </div>
      </div>
    </div>
  </div>
  `);
  $('#list-container').append(eachListItem);
}

 