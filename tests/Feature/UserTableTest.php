<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTableTest extends TestCase
{
    use RefreshDatabase;
    public function test_users_cannot_access_dashboard()
    {
        $this->get(route('home'))->assertStatus(302);
    }
}
