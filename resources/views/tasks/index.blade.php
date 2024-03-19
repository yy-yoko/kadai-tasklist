@extends('layouts.app')

@section('content')
@if (Auth::check())
    @if (isset($tasks))
    <div class="prose ml-4">
        <h2>タスク 一覧</h2>
    </div>

    
        <table class="table table-zebra w-full my-4">
            <thead>
                <tr>
                    <th>id</th>
                    <th>タスク</th>
                    <th>ステータス</th>
                </tr>
            </thead>
            <tbody>    
                @foreach ($tasks as $task)
                <tr>
                    <td><a class="link link-hover text-info" href="{{ route('tasks.show', $task->id) }}">{{ $task->id }}</a></td>
                    <td>{{ $task->content }}</td>
                    <td>{{ $task->status }}</td>
                </tr>
                @endforeach
    </tbody>
        </table>
            {{-- タスク作成ページへのリンク --}}                                                   
    <a class="btn btn-primary" href="{{ route('tasks.create') }}">新規タスクの投稿</a>       
    @endif
   
@endsection
