<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->assertTrue(true);
    }
}


// class ForeignPassenger extends TestCase
// {
//     /**
//      * Test reload path
//      *
//      * @return void
//      */
//     public function test_ReloadPathExecution()
//     {
//         $response = $this->call('POST', '/api/reload-local');
//         $this->assertEquals(200, $response->status());
//     }

//     /**
//      * Test reload path
//      *
//      * @return void
//      */
//     // public function test_setForiegnReload(){
//     //     $this->json('POST', '/api/reload-local', ["passport"=>"N197896321","tot_amount" => 1500.00])
//     //          ->assertTrue(true);
//     // }

// }