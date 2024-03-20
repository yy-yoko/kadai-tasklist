<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Task;

class TasksController extends Controller
{
    public function index()
    {
        $data = [];
        if (\Auth::check()) { // 認証済みの場合
            // 認証済みユーザを取得
            $user = \Auth::user();
            // ユーザの投稿の一覧を作成日時の降順で取得
            // このユーザの投稿のみ取得
            $tasks = $user->tasks()->orderBy('created_at', 'desc')->paginate(10);
            $data = [
                'user' => $user,
                'tasks' => $tasks,
            ];
        }
            // dashboardビューでそれらを表示
            return view('dashboard', $data); 
    }

    public function create()
    {
        
        $task = new Task;

        // タスク作成ビューを表示
        return view('tasks.create', [
            'tasks' => $task,
        ]);
        
    }

    public function store(Request $request)
    {
        // バリデーションを行う
        $request->validate([
        'content' => 'required|max:255',
        ]);
        
        // 認証済みユーザの投稿として作成
        $request->user()->tasks()->create([
            'content' => $request->content,
            'status' => $request->status,
        ]);
        
        // トップページへリダイレクトさせる
       return redirect('/');
    
    }

    public function show($id)
    {
        // idの値でタスクを検索して取得
        $tasks = Task::findOrFail($id);
        
        if (\Auth::check()) { // 認証済みの場合
            // 認証済みユーザを取得
            $user = \Auth::user();
            // タスク詳細ビューでそれを表示
            return view('tasks.show', [
                'tasks' => $tasks,
            ]);
        } else {
        
            // トップページへリダイレクトさせる
            return redirect('/');
        }
    }

    public function edit($id)
    {
        // idの値でタスクを検索して取得
        $task = Task::findOrFail($id);
        
        if (\Auth::check()) { // 認証済みの場合
            // 認証済みユーザを取得
            $user = \Auth::user();
            return view('tasks.edit', [
                'task' => $task,
            ]);
        } else {
            // トップページへリダイレクトさせる
            return redirect('/');
        }
    }

    public function update(Request $request, $id)
    {
        // バリデーションを行う
        $request->validate([
            'content' => 'required|max:255',
		    'status' => 'required|max:10',
        ]);
        
        // idの値でタスクを検索して取得
        $tasks = Task::findOrFail($id);
        
        if (\Auth::check()) { // 認証済みの場合
            // 認証済みユーザを取得
            $user = \Auth::user();
            // タスクを更新
            $tasks->content = $request->content;
            $tasks->status = $request->status;
            $tasks->save();
        } else {
            // トップページへリダイレクトさせる
            return redirect('/');
        }
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
        
        if (\Auth::check()) { // 認証済みの場合
        // 認証済みユーザを取得
        $user = \Auth::user();
        
        // タスクを削除
        $tasks->delete();
        } else {
        // トップページへリダイレクトさせる
        return redirect('/');
        }
    }
    
}
