<?php


namespace Tests\Acceptance;

use Tests\Support\AcceptanceTester;

class GoogleLoginCest
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
        $I->executeJS("document.querySelector('.google-button').click();");
        $I->amOnPage('/');
        
        $I->amOnUrl('https://accounts.google.com/o/oauth2/v2/auth/oauthchooseaccount?response_type=code&access_type=online&client_id=11015160457-7k1n0s58hm73vte2hb6k0in29mdla7h6.apps.googleusercontent.com&redirect_uri=http%3A%2F%2Flocalhost%3A3000%2Fweb%2Fpages%2Fcallback.php&state&scope=email%20profile&approval_prompt=auto&service=lso&o2v=2&flowName=GeneralOAuthFlow');
        
        $I->fillField("identifier","labsym2023@gmail.com");

        $I->click("Avanti");
        $I->wait(5);
        //$I->fillField("");
        /*
        $I->wait(5);
        $I->see("SYM");
        $divSelector='div[data-email]';
        $xpath = "//div[text()='SYM']";
        $I->executeJS("document.querySelector('$divSelector').click();");
        $I->amOnPage('/profiloutente.php');
        $I->see("Salve,SYM");
        */ 
        // 
    }
}
