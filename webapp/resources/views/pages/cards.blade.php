@extends('layouts.app')

@section('title', 'Cards')

@include('partials.navbar')

@section('content')

<section id="cards">
  @each('partials.card', $cards, 'card')
  <article class="card">
    <form class="new_card">
      <input type="text" name="name" placeholder="new card">
    </form>
  </article>


  <div class="container">
  <div class="row align-items-start">
    <div class="col">
      One of three columns
    </div>
    <div class="col">
      One of three columns
    </div>
    <div class="col">
      One of three columns
    </div>
  </div>
  <div class="row align-items-center">
    <div class="col">
      One of three columns
    </div>
    <div class="col">
      One of three columns
    </div>
    <div class="col">
      One of three columns
    </div>
  </div>
  <div class="row align-items-end">
    <div class="col">
      One of three columns
    </div>
    <div class="col">
      One of three columns
    </div>
    <div class="col">
      One of three columns
    </div>
  </div>
</div>

</section>

@endsection
