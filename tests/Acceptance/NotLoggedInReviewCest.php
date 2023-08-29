<?php


namespace Tests\Acceptance;

use Tests\Support\AcceptanceTester;

class NotLoggedInReviewCest
{
    public function _before(AcceptanceTester $I)
    {
        
    }

    // tests
    public function tryToTest(AcceptanceTester $I)
    {
        $I->click('movieId');
        $I->amOnPage('/web/pages/movie-detail.php?id=615656');
        $I->see('Meg 2: The Trench');
        $I->see('Esegui il Login o Registrati');
        $I->dontSee('Invia');
    }
}
