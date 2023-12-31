<?php

namespace App\Http\Controllers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Task;
class TaskController extends Controller
{
    public function index() {
        return view('home', [
            'task' => Task::getTask(), // Mengambil semua data dari tabel tasks dari user yang sedang login
            'taskNotStarted' => Task::getTaskNotStarted(), // Mengambil semua data dari tabel tasks dari user yang sedang login
            'taskOnProgress' => Task::getTaskOnProgress(), // Mengambil semua data dari tabel tasks dari user yang sedang login
            'taskCompleted' => Task::getTaskCompleted(), // Mengambil semua data dari tabel tasks dari user yang sedang login
            'taskExpired' => Task::getTaskExpired(), // Mengambil semua data dari tabel tasks dari user yang sedang login
            'count_all' => Task::countAll(), // Menghitung jumlah task keseluruhan
            'count_complete' => Task::countComplete(), // Menghitung jumlah task yang sudah selesai
            'count_on_progress' => Task::countOnProgress(), // Menghitung jumlah task yang masih on progress
            'count_expired' => Task::countExpired(), // Menghitung jumlah task yang sudah kadaluarsa
            'count_not_started' => Task::countNotStarted(), // Menghitung jumlah task yang belum dimulai
            'countPerDay' => Task::countCompleteForLast7Days(),
            'user' => auth()->user(), // Mengambil data user yang sedang login
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        // Validate the request...
        $request->validate([
            'task_title' => 'required',
            'task_desc' => 'required',
            'task_deadline' => ['required', 'date', 'after_or_equal:today'],
            'task_priority' => 'required',
            'task_status' => 'required',
        ]);

        // Use ternary operator to set 'finished_at' based on 'task_status'
        $finishedAt = ($request->task_status == 'completed') ? now() : null;
        $deadline = ($request->task_deadline == 'completed') ? null : $request->task_deadline;

        $task = Task::create([
            'title' => $request->task_title,
            'description' => $request->task_desc,
            'deadline' => $deadline,
            'priority' => $request->task_priority,
            'status' => $request->task_status,
            'finished_at' => $finishedAt, // Use the variable here
            'user_id' => auth()->user()->id,
        ]);

        $task->save();

        return redirect('/home');
    }

    public function handleTaskAction(Request $request) : RedirectResponse
    {
        $taskId = $request->input('task_id');
        $action = $request->input('action');

        if ($action === 'markDone') {
            // Logika untuk menyelesaikan tugas
            $task = Task::find($taskId);
            $task->status = 'completed';
            $task->finished_at = now();
            $task->deadline = null;
            $task->save();
        } elseif ($action === 'deleteTask') {
            // Logika untuk menghapus tugas
            $task = Task::find($taskId);
            $task->delete();
        }

        // Redirect atau response lainnya sesuai kebutuhan Anda
        return redirect('/home');
    }

    public function searchTask(Request $request)
    {
        $search = $request->input('search');
        $result = Task::where('user_id', auth()->user()->id)->where('title', 'like', '%' . $search . '%')->get();

        return view('home', [
            'task' => Task::getTask(), // Mengambil semua data dari tabel tasks dari user yang sedang login
            'taskNotStarted' => Task::getTaskNotStarted(), // Mengambil semua data dari tabel tasks dari user yang sedang login
            'taskOnProgress' => Task::getTaskOnProgress(), // Mengambil semua data dari tabel tasks dari user yang sedang login
            'taskCompleted' => Task::getTaskCompleted(), // Mengambil semua data dari tabel tasks dari user yang sedang login
            'taskExpired' => Task::getTaskExpired(), // Mengambil semua data dari tabel tasks dari user yang sedang login
            'count_all' => Task::countAll(), // Menghitung jumlah task keseluruhan
            'count_complete' => Task::countComplete(), // Menghitung jumlah task yang sudah selesai
            'count_on_progress' => Task::countOnProgress(), // Menghitung jumlah task yang masih on progress
            'count_expired' => Task::countExpired(), // Menghitung jumlah task yang sudah kadaluarsa
            'count_not_started' => Task::countNotStarted(), // Menghitung jumlah task yang belum dimulai
            'user' => auth()->user(), // Mengambil data user yang sedang login
            'countPerDay' => Task::countCompleteForLast7Days(),
            'result' => $result,
            'search' => $search,
        ]);
    }
}
