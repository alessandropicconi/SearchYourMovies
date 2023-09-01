<?php
use Tests\Support\AcceptanceTester;
class ThirdCest
{
    public function _before(AcceptanceTester $I)
    {
    }

     
    public function TryToGetInWhileBanned(AcceptanceTester $I) {
        $I->amOnPage('/');
        $I->click('#login-button');
        $I->amOnPage('/web/pages/signin.php');
        include "db/db_conn.php";
        $sql = "UPDATE users SET status=0 WHERE id=2";  #valore da cambiare
        $result = pg_query($conn, $sql);
        $I->fillField(['name'=>'email'],'prova@prova.it');  #valore da cambiare
        $I->fillField(['name'=>'password'],'prova');       #valore da cambiare
        $I->click('#login');
        $I->amOnPage('/web/pages/signin.php?error=Account disabled"');#$I->dontSeeCurrentUrlEquals('/web/pages/profiloutente.php'); #$I->dontSee('Salve, prova');
    }
}
