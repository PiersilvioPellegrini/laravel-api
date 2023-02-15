
@extends('layouts.app')

@php
    $title = 'Projects #' . $project->id;
@endphp

@section('content')
<h1>{{ $title }}</h1>

<div class="card">
    {{-- Se cover_img esiste, mostra un tag img, altrimenti nulla --}}

    <img src="{{ asset('storage/'. $project['img_cover'])}}" alt="" class="card-img-top">


    <div class="card-body">
        <div class="card-title">{{ $project->name }}</div>
        <p class="card-text">{{ $project->description }}</p>
        <p class="card-text">{{ $project->type ? $project->type->typeName : ' ' }}</p>
        <div class="card-text">Technologies:
            @foreach ($project->technologies as $technology)
              <span class="badge rounded-pill text-bg-primary">{{ $technology->name }}</span>
            @endforeach
          </div>
        <p class="card-text">{{ $project->link_project }}</p>
        <p class="card-text">{{ $project->creation_date }}</p>

    </div>
</div>

<a href="{{ route('admin.projects.index') }}" class="btn btn-danger mb-5 mt-5"><i class="fas fa-eye"></i>Torna alla Home </a>

@endsection