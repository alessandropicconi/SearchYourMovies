<?php


namespace Tests\Acceptance;

use Tests\Support\AcceptanceTester;

class InvalidReviewCest
{
    public function _before(AcceptanceTester $I)
    {
        $I->amOnPage('/');
        $I->click('#login-button');
        $I->amOnPage('/web/pages/signin.php');
        $I->fillField('email', 'test@test.com');
        $I->fillField('password', '123');
        $I->click('#login');
        $I->see('Salve, Test');
        $I->click('Home');
        $I->see('Hi, Test');
    }

    // tests
    public function tryToTest(AcceptanceTester $I)
    {
        include "../SYM_ale/db/db_conn.php";
        $wipe = "DELETE FROM reviews WHERE name='Test'";
        pg_query($conn,$wipe);
        $I->amOnPage('/web/pages/movie-detail.php?id=615656');
        $I->see('Meg 2: The Trench');
        $I->see('Lascia una recensione: Test');
        $I->fillField('review', '');
        $I->click(['id'=>'ziocane']);
        $I->dontSee('Test:');
        $I->fillField('review', 'Recensione Visibile');
        $I->click(['id'=>'ziocane']);
        $I->see('Test:Recensione Visibile');
        include "../SYM_ale/db/db_conn.php";
        $wipe = "DELETE FROM reviews WHERE name='Test'";
        pg_query($conn,$wipe);

        
    }
}