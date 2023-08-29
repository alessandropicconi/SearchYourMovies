// Questa è l'API, l'URL di base e l'URL dell'immagine
const APIKEY = 'api_key=02e3a326a583ca3d6822726c2970a704';
const BASEURL = 'https://api.themoviedb.org/3';
const IMAGEURL = 'https://image.tmdb.org/t/p/w500';
// Loop attraverso l'array dei film preferiti
USER_FAVOURITES.forEach(async id => {
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
        <div class="remove-movie" id='${id}' onclick="deleteMovie(${id})">
          <i id="removeicon" class="far fa-trash-alt"></i>
        </div>
      </div>
    </div>
  </div>
  `);
  $('#list-container').append(eachListItem);
}

// Rimuoviamo tutti i film dall'elenco dei preferiti
// Cancella la memoria locale.
$('#clear-whole-list').click(function(){
  $.post("/web/action/do-remove-all-favourites.php").then(() => {
    location.reload();
  })
});

function cancellaTutto(){
  if (window.confirm('Cancellare tutti i film preferiti?')) {
    $.post("/web/action/do-remove-all-favourites.php").then(() => {
      location.reload();
    })
 }
}


// Elimina un singolo film dall'array dei preferiti
async function deleteMovie(movieId) {
  if (window.confirm('Delete this movie from fav list?')) {
    $.post("/web/action/do-remove-from-favourites.php",{
      movieId
    }).then(() => {
      location.reload();
    })
  }
}

// nascondi/mostra form delle segnalazioni



 
function toggleForm(){
  $("#popupForm").toggle();
}