@extends('layouts.app')

@section('title', $card->name)

@include('partials.navbar')

@section('content')
  @include('partials.card', ['card' => $card])
@endsection
