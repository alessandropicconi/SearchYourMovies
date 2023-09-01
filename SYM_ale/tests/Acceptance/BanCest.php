<?php
use Tests\Support\AcceptanceTester;
class BanCest
{
    public function _before(AcceptanceTester $I)
    {
       
    }

    public function Ban(AcceptanceTester $I) {     
        $I->amOnPage('/');
        $I->click('#login-button');            
        $I->amOnPage('/web/pages/signin.php');
        $I->fillField(['name'=>'email'],'simone@parrella.it'); #valore da cambiare
        $I->fillField(['name'=>'password'],'simo');    #valore da cambiare
        $I->click('#login');
       $I->amOnPage('/web/pages/admin.php');
       $I->click('#view-users');
       include "db/db_conn.php";
       $sql = "UPDATE users SET status=1 WHERE id=2";   #valore da cambiare
       $result = pg_query($conn, $sql);
       $I->amOnPage('/web/pages/view-users.php');
       $I->see('Ban');
        $I->dontSeeCheckboxIsChecked('.banUseruser');     #valore da cambiare
        $I->checkOption('.banUseruser');                  #valore da cambiare
        $I->seeCheckboxIsChecked('.banUseruser');         #valore da cambiare
       $I->click('Logout');
           $I->amOnPage('/');
           $I->click('#login-button');
           $I->amOnPage('/web/pages/signin.php');
           $I->fillField(['name'=>'email'],'user@test.it');  #valore da cambiare
           $I->fillField(['name'=>'password'],'1');          #valore da cambiare
           $I->click('#login');
           $I->amOnPage('/web/pages/signin.php?error=Account disabled"'); #$I->dontSeeCurrentUrlEquals('/web/pages/profiloutente.php'); #$I->dontSee('Salve, prova');
}
}
              
