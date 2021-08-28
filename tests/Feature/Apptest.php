<?php

namespace Tests\Feature;

use PHPUnit\Framework\TestCase;

class Apptest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->visit('/')->see("Hello");
    }
}
