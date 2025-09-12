<?php

namespace Tests\Feature;

use App\Services\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    private UserService $userService;

    protected function setUp():void
    {
        parent::setUp();

        $this->userService = $this->app->make(UserService::class);
    }

    
    public function testUserService()
    {
        self::assertTrue(true);
    }

    public function testLoginSucces()
    {
        self::assertTrue($this->userService->login("rio", "achyar"));
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
