<?php

namespace App\Http\Controllers;

use App\Mail\TaskCompleted;
use App\Models\Task;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class TaskController extends Controller
{
    public function index(): View
    {
        return view('tasks.index', ['tasks' => Task::where('is_archived', false)->latest()->paginate(10)]);
    }

    public function create(): View { return view('tasks.create'); }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);
        Task::create($data + ['status' => 'pending', 'is_archived' => false]);
        return to_route('tasks.index')->with('status', 'Task created.');
    }

    public function show(Task $task): View
    {
        abort_if($task->is_archived, 404);
        return view('tasks.show', compact('task'));
    }

    public function edit(Task $task): View
    {
        abort_if($task->is_archived, 404);
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task): RedirectResponse
    {
        abort_if($task->is_archived, 404);
        $wasDone = $task->status === 'done';
        $data = $this->validated($request);
        $task->update($data);

        if (! $wasDone && $task->status === 'done') {
            Mail::to(config('mail.task_notification_recipient'))->queue(new TaskCompleted($task));
        }

        return to_route('tasks.index')->with('status', 'Task updated.');
    }

    public function destroy(Task $task): RedirectResponse
    {
        $task->update(['is_archived' => true]);
        return to_route('tasks.index')->with('status', 'Task archived.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:2000'],
            'status' => ['sometimes', 'required', 'in:pending,in_progress,done'],
            'due_date' => ['nullable', 'date'],
        ]);
    }
}
