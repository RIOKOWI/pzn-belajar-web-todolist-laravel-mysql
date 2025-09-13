<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Services\TodolistService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Assert;

class TodolistServiceTest extends TestCase
{
    private  TodolistService $todolistSetvice;

    public function setUp():void
    {
        parent::setUp();
        DB::delete('delete from todos');
        $this->todolistSetvice = $this->app->make(TodolistService::class);
    }

    public function testTodolistNotNull()
    {
        self::assertNotNull($this->todolistSetvice);
    }

    public function testSaveTodo()
    {
        $this->todolistSetvice->saveTodo("1", "rio");

        $todolist = $this->todolistSetvice->getTodolist();
        foreach($todolist as $value){
            self::assertEquals("1", $value['id']);
            self::assertEquals("rio", $value['todo']);
        }
    }

    public function testGetTodolistEmpty()
    {
        self::assertEquals([], $this->todolistSetvice->getTodolist());
    }

    public function testGetTodolistNotEmpty()
    {
        $expected = [
            [
                'id' => '1',
                'todo' => 'rio',
            ],
            [
                'id' => '2',
                'todo' => 'achyar'
            ]
        ];
        $this->todolistSetvice->saveTodo('1', 'rio');
        $this->todolistSetvice->saveTodo('2', 'achyar');

        Assert::assertArraySubset($expected, $this->todolistSetvice->getTodolist());

    }

    public function testRemoveTodo()
    {
        $this->todolistSetvice->saveTodo('1', 'rio');
        $this->todolistSetvice->saveTodo('2', 'achyar');

        self::assertEquals(2, sizeof($this->todolistSetvice->getTodolist()));
        // cek ada berapa todo
        
        $this->todolistSetvice->removeTodo(3);
        //hapus todo
        
        self::assertEquals(2, sizeof($this->todolistSetvice->getTodolist()));
        
        $this->todolistSetvice->removeTodo(1);
        
        self::assertEquals(1, sizeof($this->todolistSetvice->getTodolist()));
        
        $this->todolistSetvice->removeTodo(2);
        
        self::assertEquals(0, sizeof($this->todolistSetvice->getTodolist()));
    }
}
