<?php


namespace Tests\Acceptance;

use Tests\Support\AcceptanceTester;

class TryingToLoginAsNonExistingUserCest
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
        $I->fillField('email', 'invalid@user.com');
        $I->fillField('password', '123');
        $I->click('#login');
        $I->see('Incorrect Email or password');
    }
}
