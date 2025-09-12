<?php

namespace App\Http\Controllers;

use App\Services\TodolistService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TodolistController extends Controller
{
    private TodolistService $todoListService;

    public function __construct(TodolistService $todoListService)
    {
        $this->todoListService = $todoListService;
    }

    public function todoList(Request $request): Response
    {
        $todoList = $this->todoListService->getTodolist();
        return response()->view('todo.index', [
            'title' => 'To do List',
            'todoList' => $todoList
        ]);
    }

    public function addTodo(Request $request)
    {
        $todo = $request->input('todo');

        if(empty($todo)){
            $todoList = $this->todoListService->getTodolist();
            return response()->view('todo.index', [
            'title' => 'To do List',
            'todoList' => $todoList,
            'error' => 'Todo Harus di Isi'
            ]);
        }

        $this->todoListService->saveTodo(uniqid(), $todo);
        return redirect()->action([TodolistController::class, 'todoList']);
    }

    public function removeTodo(Request $request, string $todoId): RedirectResponse
    {
        $this->todoListService->removeTodo($todoId);
        return redirect()->action([TodolistController::class, 'todoList']);
    }
}
