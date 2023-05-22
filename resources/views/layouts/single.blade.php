@extends('layouts.layout')

@section('content')
    <h1>{{$post->title}}</h1>
    <ul>
        @foreach ($comments as $item)
            <li>
                {{$item->text}}
            </li>
        @endforeach
    </ul>
@endsection
