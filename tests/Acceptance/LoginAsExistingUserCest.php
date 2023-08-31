<?php


namespace Tests\Acceptance;

use Tests\Support\AcceptanceTester;

class LoginAsExistingUserCest
{
    public function _before(AcceptanceTester $I)
    {
        
    }

    // tests
    public function tryToTest(AcceptanceTester $I)
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
}
