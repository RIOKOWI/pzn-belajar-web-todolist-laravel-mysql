<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodolistControllerTest extends TestCase
{
    
    public function testView()
    {
        $this->withSession([
            'user' => 'rio',
            'todolist' => [
                'id' => '1',
                'todo' => 'ding ding ding ngoding'
            ]
        ])->get('/todolist')->assertSeeText('To do List')->assertSeeText('1')->assertSeeText('ding ding ding ngoding');
    }


    public function testAddTodoFailed()
    {
        $this->withSession([
            'user' => 'rio'
        ])->post('/todolist', [])
        ->assertSeeText('Todo Harus di Isi');
    }

    public function testAddTodoSucces()
    {
        $this->withSession([
            'user' => 'rio'
        ])->post('/todolist', [
            'id' => '1',
            'todo' => 'embut'
        ])
        ->assertRedirect('/todolist');
    }

    public function testRemoveTodo(){
        $this->withSession([
            'user' => 'rio',
            'todolist' => [
            [
                'id' => '1',
                'todo' => 'oke'
            ],
            [
                'id' => '2',
                'todo' => 'eko'
            ]
        ]
        ])->post('/todolist/1/delete')->assertRedirect('/todolist');
    }
}
