<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Task;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // タスク一覧を取得
        $tasks = Task::all();  //
                // タスク一覧ビューでそれを表示
        return view('tasks.index', [     // 追加
            'tasks' => $tasks,        // 追加
        ]);                                 // 追加
    
    }
    public function dashboard()
    {
        $data = [];
        if (\Auth::check()) { // 認証済みの場合
            // 認証済みユーザを取得
            $user = \Auth::user();
            // ユーザの投稿の一覧を作成日時の降順で取得
            // （後のChapterで他ユーザの投稿も取得するように変更しますが、現時点ではこのユーザの投稿のみ取得します）
            $tasks = $user->tasks()->orderBy('created_at', 'desc')->paginate(10);
            $data = [
                'user' => $user,
                'tasks' => $tasks,
            ];
        }
        
        // dashboardビューでそれらを表示
        return view('dashboard', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $task = new Task;
        
        // タスク作成ビューを表示
        return view('tasks.create', [
            'tasks' => $task,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // バリデーションを行う
        $request->validate([
        'content' => 'required|max:255',
		'status' => 'required|max:10',
        ]);
        
        // タスクを作成
        $tasks = new Task;
        $tasks->content = $request->content;
        $tasks->status = $request->status;
        $tasks->save();

        // トップページへリダイレクトさせる
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // idの値でタスクを検索して取得
        $tasks = Task::findOrFail($id);

        // タスク詳細ビューでそれを表示
        return view('tasks.show', [
            'tasks' => $tasks,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // idの値でタスクを検索して取得
        $tasks = Task::findOrFail($id);

        // タスク編集ビューでそれを表示
        return view('tasks.edit', [
            'tasks' => $tasks,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // バリデーションを行う
        $request->validate([
        'content' => 'required|max:255',
		'status' => 'required|max:10',
        ]);
        
        // idの値でタスクを検索して取得
        $tasks = Task::findOrFail($id);
        // タスクを更新
        $tasks->content = $request->content;
        $tasks->status = $request->status;
        $tasks->save();
        
        // トップページへリダイレクトさせる
        return redirect('/');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // idの値でタスクを検索して取得
        $tasks = Task::findOrFail($id);
        // タスクを削除
        $tasks->delete();
        
        // トップページへリダイレクトさせる
        return redirect('/');
    }
}
