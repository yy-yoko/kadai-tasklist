@extends('layouts.app')

@section('content')
@if (Auth::check())
    <div class="prose ml-4">
        <h2>id = {{ $tasks->id }} のタスク詳細ページ</h2>
    </div>

    <table class="table w-full my-4">
        <tr>
            <th>id</th>
            <td>{{ $tasks->id }}</td>
        </tr>

        <tr>
            <th>タスク</th>
            <td>{{ $tasks->content }}</td>
        </tr>
        <tr>
            <th>ステータス</th>
            <td>{{ $tasks->status }}</td>
        </tr>
    </table>
     {{-- タスク編集ページへのリンク --}}
    <a class="btn btn-outline" href="{{ route('tasks.edit', $tasks->id) }}">このタスクを編集</a>
    
    {{-- タスク削除フォーム --}}
    <form method="POST" action="{{ route('tasks.destroy', $tasks->id) }}" class="my-2">
        @csrf
        @method('DELETE')
        
        <button type="submit" class="btn btn-error btn-outline" 
            onclick="return confirm('id = {{ $tasks->id }} のタスクを削除します。よろしいですか？')">削除</button>
    </form>
    @else
        <div class="center jumbotron">
            <div class="navbar-brand d-flex flex-row-reverse bd-highlight">
                Welcome to the Microposts
            </div>
        </div>
    @endif
@endsection
