<?php


namespace Tests\Acceptance;

use Tests\Support\AcceptanceTester;

class RenderReviewInProfileCest
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
        $I->amOnPage('/web/pages/movie-detail.php?id=615656');
        $I->see('Meg 2: The Trench');
        $I->see('Lascia una recensione: Test');
        $I->fillField('review', '');
        $I->click(['id'=>'review-send']);
        $I->dontSee('Test:');
        $I->fillField('review', 'Recensione Visibile');
        $I->click(['id'=>'review-send']);
        $I->see('Test:Recensione Visibile');
    }

    // tests
    public function tryToTest(AcceptanceTester $I)
    {
        $I->amOnPage('/');
        $I->click('Profilo');
        $I->amOnPage('/profiloutente.php');
        $I->see('Test:Recensione Visibile');
    }
}
