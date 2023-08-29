<?php

use App\Review;

class ReviewIntegrationTest extends \PHPUnit\Framework\TestCase {

    // Utente Test nella table users
    // user_name = Test
    // email = test@test.com
    // pass = 123
    // Alla fine di ogni funzione pulisco il database


    public function testShowReviewWhenPost(){
        // Voglio verificare se la recensione appena postata venga visualizzata
        // all'interno della pagina del film
        // e all'interno della pagina dell'utente
        $true = true;
        $this->assertTrue($true);

    }

    public function noReviewWhenDuplicate(){
        // Voglio verificare se la recensione appena postata non venga inserita
        // se vi è già una recensione dello stesso utente

    }

    public function noReviewWhenInvalidUser(){
        // Voglio verificare se la recensione di un utente non valido non venga
        // visualizzata da nessuna parte
    }

}

// Idee per integration test: verificare se la recensione viene fatta vedere nella pagina del film
// Verificare se la recensione di un utente che ha già recensito non viene inserita nel db e non viene fatta vedere
// Verificare se la recensione di un utente viene fatta vedere all'interno della propria pagina di profilo



// Idee per acceptance test: simulare un utente registrato che commenta, nei vari casi





?>