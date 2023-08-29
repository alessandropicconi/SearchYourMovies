const APIKEY = '02e3a326a583ca3d6822726c2970a704';
const IMAGEURL = 'https://image.tmdb.org/t/p/w500';

// recupero degli elementi da index.php
var container = $('#movie-container');
var search = $('#searchMovie');
var dropdownButton = $(".dropdown-button");


// questo è il bottone precedente
var prev = $('#prev-page');
/// questo è il bottone successivo
var next = $('#next-page');

// contatore delle pagine
var pageNumber = 1;
// variabile per la ricerca
var searchQuery = ""


/// questa è la funzione per ottenere i dati dell'API
function fetchMovies() {
    container.html("");
    // Effettua una richiesta GET all'API per ottenere i film in 
    //base alla query di ricerca e al numero di pagina
    $.get(`https://api.themoviedb.org/3/${searchQuery !== '' ? 'search' : 'discover'}/movie?api_key=${APIKEY}&query=${searchQuery}&page=${pageNumber}&language=en-US&sort_by=popularity.desc&include_adult=false&include_video=false&with_watch_monetization_types=flatrate`, function (response) {
        // Per ogni film nella risposta, aggiungi il film alla pagina chiamando la funzione addMovieToPage(movie)
        response.results.forEach(movie => addMovieToPage(movie));
        checkButton();
    });
}

// crea gli elementi della homepage
function addMovieToPage(movie) {
    // Crea un nuovo elemento div con la classe "movie-element"
    let movieElement = $('<div>',
     
     {
        class: 'movie-element'
     }
    
     );

    // Aggiunge il codice HTML per visualizzare il poster del film, 
    // il titolo e il voto medio del film
    movieElement.html(
        `<div class="movie-poster">
        <form action="/web/pages/movie-detail.php?id=${movie.id}" method="post" id="myForm">
            <input type="hidden" name="movieTitle" value="${movie.title}"/>
            <button type="submit" name="movieId" value="${movie.id}" id="${movie.id}" style="background:none; border:none;cursor:pointer"><img src= "${IMAGEURL + movie.poster_path}" alt="Movie Poster">
            </button>       
        </form>
        </div>
        <div class="movie-title">${movie.title}</div>
        <div class="movie-element-tags">
            <div class="movie-rating">
            <i class="fas fa-star"></i> ${movie.vote_average} 
            </div>
        </div>`
    );

    // Se l'utente corrente è autenticato, 
    //aggiunge un'icona per aggiungere o rimuovere il film dalla lista 
    //dei preferiti
    if (CURRENT_USER_ID) {
        movieElement.find(".movie-element-tags")
            .append(`<div class="add-movie-to-list" onclick="toggleFavourite(${movie.id})" data-movie-id="${movie.id}">
                 ${USER_FAVOURITES.includes(movie.id) ? '<i class="fas fa-check"></i>' : '<i class="fas fa-plus"></i>'}
            </div>`)
    }

    // Aggiunge l'elemento del film al contenitore principale
    container.append(movieElement);
}


// Controlla lo stato del bottone precedente/ successivo in base al numero di pagina
function checkButton() {
    if (pageNumber == 1) {
        prev.prop('disabled', true);
    } else {
        prev.prop('disabled', false);
    }
}


// Funzione per aggiungere o rimuovere un film dalla lista dei preferiti
function toggleFavourite(movieId) {
    // Se il film è già nella lista dei preferiti
    if (USER_FAVOURITES.includes(movieId)) {
        // Se il film è già presente nella lista dei preferiti dell'utente
        // Effettua una richiesta POST per rimuoverlo dalla lista
        $.post("/web/action/do-remove-from-favourites.php", { movieId }).then(function () {
            // Rimuovi il film dall'array USER_FAVOURITES
            USER_FAVOURITES.splice(USER_FAVOURITES.indexOf(movieId), 1);
            // Aggiorna la visualizzazione dei film richiamando la funzione fetchMovies()
            fetchMovies();
        });
    } else {
        // Se il film non è presente nella lista dei preferiti dell'utente
        // Effettua una richiesta POST per aggiungerlo alla lista
        $.post("/web/action/do-add-to-favourites.php", { movieId }).then(function () {
            // Aggiungi il film all'array USER_FAVOURITES
            USER_FAVOURITES.push(movieId);
            // Aggiorna la visualizzazione dei film richiamando la funzione fetchMovies()
            fetchMovies();
        });
    }
}

// Aggiungi un listener di eventi al pulsante del menu a tendina
if (dropdownButton) {
    dropdownButton.click(() => {
        var dropdownContent = $('.dropdown-content');
        if (dropdownContent.css('display') === "block") {
            dropdownContent.css('display', 'none');
        } else {
            dropdownContent.css('display', 'block');
        }
    });
}


// Vai alla pagina successiva
next.click(function () {
    // Incrementa il numero di pagina
    pageNumber++;
    // Controlla lo stato del bottone precedente/successivo
    checkButton();
    // Recupera i film corrispondenti alla nuova pagina
    fetchMovies();
});

// Vai alla pagina precedente
prev.click(function () {
    // Decrementa il numero di pagina
    pageNumber--;
    // Controlla lo stato del bottone precedente/successivo
    checkButton();
    // Recupera i film corrispondenti alla nuova pagina
    fetchMovies();
});


// Funzione di ricerca dei film in base all'input dell'utente
search.keyup(function () {
    // Ottieni il valore dell'input di ricerca
    searchQuery = search.val();
    // Reimposta il numero di pagina a 1
    pageNumber = 1;
    // Recupera i film corrispondenti alla nuova ricerca
    fetchMovies();
});



// Recupera i film iniziali al caricamento della pagina
fetchMovies();