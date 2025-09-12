<?php

namespace App\Services\Impl;

use App\Services\TodolistService;
use Illuminate\Support\Facades\Session;

class TodolistServiceImpl implements TodolistService
{
    public function saveTodo(string $id, string $todo): void
    {
        if(!Session::exists('todolist')){
            Session::put('todolist', []);
            //cara bacanya "kalau tidak ada data todolist akan dikirim array kosong"
        }

        // masukkan data ke session
        Session::push('todolist', [
            'id' => $id,
            'todo' => $todo,
        ]);
    }

    public function getTodolist(): array
    {
        return Session::get('todolist', []);
    }

    public function removeTodo(string $todoId)
    {
        $todoList = Session::get('todolist');

        foreach($todoList as $index => $value){
            if($value['id'] == $todoId){
                unset($todoList[$index]);
                break;
            }
        }
        Session::put('todolist', $todoList);
    }
}
