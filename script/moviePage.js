
// Questo è l'API key, l'URL base e l'URL dell'immagine
const APIKEY = 'api_key=02e3a326a583ca3d6822726c2970a704';
const BASEURL = 'https://api.themoviedb.org/3';
const IMAGEURL = 'https://image.tmdb.org/t/p/w500';

// Ottengo l'id del film e i dettagli
let id = '';
const urlParams = new URLSearchParams(location.search);
for(const [key, value]of urlParams){
    id = value;
}

id_film = id;
let link = `/movie/${id}?language=en-US&append_to_response=videos&`;
let f_url = BASEURL+link+APIKEY;




apiCall(f_url);

// Funzione per creare un elemento (utilizzo ajax con metodi jquery)
function apiCall(url){
    $.ajax({
        url: url,
        success: function(res){
            $('#movie-display').empty();
            var Json = res;
            getMovies(Json);
        },
        error: function(){
            window.alert('cannot get')
        }
    });
}

// funzione prende i dati JSON e li mostra sulla pagina dei dettagli del film
function getMovies(myJson){
    // Ottengo il link del trailer di YouTube
    var MovieTrailer = myJson.videos.results.filter(filterArray);
    // Ottengo l'immagine di sfondo per la pagina
    $('body').css('background-image', `url(${IMAGEURL+myJson.backdrop_path}), linear-gradient(rgba(0,0,0,1), rgba(0,0,0,0) 250%)`);
    var movieDiv = $('<div>').addClass('each-movie-page');

    // Impostazione del link di YouTube
    var youtubeURL;
    if(MovieTrailer.length==0){
        if(myJson.videos.results.length ==0){
            youtubeURL='';
        }else{
            youtubeURL = `https://www.youtube.com/embed/${myJson.videos.results[0].key}`;
        }
    }else{
        youtubeURL = `https://www.youtube.com/embed/${MovieTrailer[0].key}`;
    }

    // HTML per la pagina dei dettagli del film
    movieDiv.html(`
        
        <div class="movie-poster">
            <img src=${IMAGEURL+myJson.poster_path} alt="Poster">
        </div>
        <div class="movie-details">
            <div class="title">
                ${myJson.title}
            </div>

            <div class="tagline">${myJson.tagline}</div>

            <div style="display: flex;"> 
                <div class="movie-duration">
                    <b><i class="fas fa-clock"></i></b> ${myJson.runtime}
                </div>
                <div class="release-date">
                    <b>Raleased</b>: ${myJson.release_date}
                </div>
            </div>

            <div class="rating">
                <b><i class="fab fa-imdb"></i></b>: ${myJson.vote_average}
            </div>

            <div class="trailer-div" id="trailer-div-btn">
                <i class="fab fa-youtube"></i>
            </div>

            <div id="trailer-video-div">
                <button id="remove-video-player"><i class="fas fa-times"></i></button>
                <br>
                <span><iframe width="560" height="315" src=${youtubeURL} title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></span>
            </div>
    
            <div class="plot">
                ${myJson.overview}
            </div>
        </div>
    `);
    $('#movie-display').append(movieDiv);


    sendReview = ` 
                
                <button class="bottone palette-netflix-bright-red w3-padding-16" type="submit" name="movieId" value="${id_film}" id="ziocane"> Invia
                </button>
                <input type="hidden" name="movieTitle" value="${myJson.title}" />
              `
    $('#review-section').append(sendReview);

    commentButtons = `
                <button type="submit" name="movieId" value="${id_film}" id="ziocane" style="background:none;border:none;display:block">Invia</button>
                <input type="hidden" name="movieTitle" value="${myJson.title}" />
    `;
    $('#comment-section').append(commentButtons);

    deleteComment = `<button type="submit" class="bottone palette-netflix-bright-red w3-padding-16" name="delete" value="${id_film}"> Cancella le tue recensioni (dev) 
    </button>`;




    /// riproduci il video di YouTube
    var youtubeVideo = $('#trailer-video-div');
    $('#trailer-div-btn').click(function(){
        youtubeVideo.css('display', 'block');
    });
    // interrompi il video di YouTube
    $('#remove-video-player').click(function(){
        stopVideo();
        youtubeVideo.css('display', 'none');
    })

    // funzione per interrompere il video di YouTube
    function stopVideo(){
        var iframe = $('iframe')[0];
        var url = iframe.getAttribute('src');
        iframe.setAttribute('src', '');
        iframe.setAttribute('src', url);
    }

}

// filtra l'array per i video
function filterArray(obj){
    var vtitle = obj.name 
    var rg = /Official Trailer/i;
    if(vtitle.match(rg)){
        return obj;
    }
}


// pulsante di login
document.querySelector(".loginBtn").addEventListener("click", function() {
    window.location.href = "registration.html";
});


function attivaEditorCommenti(){
    $("#invia-commento").toggle();
}


