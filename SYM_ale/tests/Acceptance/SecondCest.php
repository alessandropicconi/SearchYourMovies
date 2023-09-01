<?php
use Tests\Support\AcceptanceTester;
class SecondCest
{
    public function _before(AcceptanceTester $I)
    {
       
    }
public function Unban(AcceptanceTester $I) {
    include "db/db_conn.php";
    $sql = "UPDATE users SET status=0 WHERE email='user@test.com'";     #valore da cambiare
    $result = pg_query($conn, $sql);
    $I->amOnPage('/');
    $I->click('#login-button');
    $I->amOnPage('/web/pages/signin.php');
    $I->fillField(['name'=>'email'],'simone@parrella.it');  #valore da cambiare
    $I->fillField(['name'=>'password'],'simo');             #valore da cambiare
    $I->click('#login');
    $I->amOnPage('/web/pages/admin.php');  
    $I->click('#view-users');
    $I->amOnPage('/web/pages/view-users.php');
    include "db/db_conn.php";
    $sql = "UPDATE users SET status=0 WHERE email='user@test.com'";     #valore da cambiare
    $result = pg_query($conn, $sql);
    $I->see('Ban');
    $I->seeCheckboxIsChecked('.banUseruser');               #valore da cambiare
    $I->uncheckOption('.banUseruser');
    $I->dontSeeCheckboxIsChecked('.banUseruser'); 
    $I->click('Logout');
        $I->amOnPage('/');
        $I->click('#login-button');
        $I->amOnPage('/web/pages/signin.php');
        $I->fillField(['name'=>'email'],'user@test.com');  #valore da cambiare
        $I->fillField(['name'=>'password'],'1');          #valore da cambiare
        $I->click('#login'); 
        $I->wait(5);
        $I->see('Salve, user');                            #valore da cambiare
}
}
