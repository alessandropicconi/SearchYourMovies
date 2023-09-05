<?php


namespace Tests\Acceptance;

use Tests\Support\AcceptanceTester;

class AlreadyReviewedCest
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
        $I->see('Lascia una recensione: Test');
        $I->see('Lascia una recensione: Test');
        $I->fillField('review', 'Recensione Visibile');
        $I->click(['id'=>'review-send']);
        $I->see('Test:Recensione Visibile');
        $I->fillField('review', 'Recensione Non Visibile');
        $I->click(['id'=>'review-send']);
        $I->see('Test:Recensione Visibile');
        $I->dontSee('Test:Recensione Non Visibile');

    }
}
