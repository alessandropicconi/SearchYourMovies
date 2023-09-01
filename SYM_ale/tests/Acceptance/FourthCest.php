<?php
use Tests\Support\AcceptanceTester;
class FourthCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    // tests
    public function TryToBanAdmin(AcceptanceTester $I){
        $I->amOnPage('/');
        $I->click('#login-button');            
        $I->amOnPage('/web/pages/signin.php');
        $I->fillField(['name'=>'email'],'simone@parrella.it');   #valore da cambiare
        $I->fillField(['name'=>'password'],'simo');              #valore da cambiare
        $I->click('#login');
       $I->amOnPage('/web/pages/admin.php');
       $I->click('#view-users');
       $I->amOnPage('/web/pages/view-users.php');
       $I->see('Ban');
       $I->dontSeeCheckboxIsChecked('.banUserSimo');     #valore da cambiare
       $I->checkOption('.banUserSimo');  #$I->dontSeeElement('checkBox',['id'=>'banUser1']);       #valore da cambiare
       $I->dontSeeCheckboxIsChecked('.banUserSimo');
    }
}
