<?php

namespace Tests\Feature;

use Tests\TestCase;
use Database\Seeders\UserSeeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserControllerTest extends TestCase
{
    
    public function setUp(): void
    {
        parent::setUp();
        DB::delete('delete from users');
    }

    public function testLogin()
    {
        $this->get('login')->assertSeeText('Login Bang');
    }

    public function testLoginSucces()
    {
        $this->seed(UserSeeder::class);
        $this->post('/login', [
            "user" => "rio@gmail.com",
            "password" => "rio"
        ])->assertRedirect("/")
        ->assertSessionHas("user", "rio@gmail.com");
    }

    public function testLoginFieldKosong()
    {
        $this->post('/login', [
            "user" => "rio",
            "password" => ""
        ])->assertStatus(200)
        ->assertSeeText("User or Password is required");
    }

    public function testLoginFieldKosong2()
    {
        $this->post('/login', [])
        ->assertSeeText("User or Password is required");
    }

    public function testLoginFailed()
    {
        $this->post('/login', [
            "user" => "failed",
            "password" => "failed",
        ])->assertSeeText("Username or Password are wrong")
        ->assertSessionMissing('user');
    }

    

    public function testLoginPageForMember()
    {
        $this->withSession([
            "user" => "rio",
        ])->get('/login')->assertRedirect("/");
    }

    public function testAlreadyLogin()
    {
        $this->withSession(["user" => "rio"])
        ->post('/login')
        ->assertRedirect("/");
    }

    public function testLogout()
    {
        $this->withSession([
            "user" => "rio"
        ])->post('/logout')
        ->assertRedirect('/')
        ->assertSessionMissing("user");
    }

    public function testLogoutGuest()
    {
        $this->post('/logout')
        ->assertRedirect('/');
    }

}
