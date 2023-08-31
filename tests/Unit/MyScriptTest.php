<?php

use PHPUnit\Framework\TestCase;

class MyScriptTest extends TestCase {
    public function PageRendersCorrectly() {

        ob_start();
        include 'web/action/show-reviews-test.php';
        $output = ob_get_clean(); 
        $output_string = trim(preg_replace('/\s+/', ' ', $output));


        $expectedOutput = '
        <div style="background-color: grey; padding: 8px 16px; margin-bottom: 8px; width: 100%;border-radius:10px"> 
            <p id="review-id" style="padding: 16px; border-radius:10px">Test:Cavoletti</p> 
        </div>
        <br>';

        $string = trim(preg_replace('/\s+/', ' ', $expectedOutput));
        $this->assertEquals($string, $output_string);
    }
}

?>