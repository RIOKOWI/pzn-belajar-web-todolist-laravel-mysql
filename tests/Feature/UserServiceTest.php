<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Services\UserService;
use Database\Seeders\UserSeeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserServiceTest extends TestCase
{
    private UserService $userService;

    protected function setUp():void
    {
        parent::setUp();
        DB::delete('delete from users');
        $this->userService = $this->app->make(UserService::class);
    }

    
    public function testUserService()
    {
        self::assertTrue(true);
    }

    public function testLoginSucces()
    {
        $this->seed(UserSeeder::class);
        self::assertTrue($this->userService->login("rio@gmail.com", "rio"));
    }

    public function testLoginFailed()
    {
        self::assertFalse($this->userService->login("mbud", "123"));
    }

    public function testLoginFailedWrongPass()
    {
        self::assertFalse($this->userService->login("udin", "123"));
    }


}
