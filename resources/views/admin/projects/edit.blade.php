@extends('layouts.app')

@php
    $title = 'Modifica Project #' . $project->id;
@endphp

@section('title', $title)

@section('content')
    <h1>{{ $title }}</h1>

    {{-- Form per la creazione --}}
    <form action="{{ route('admin.projects.update', $project->id) }}" method="POST" enctype="multipart/form-data">
        @csrf()
        @method('put')

        <div class="mb-3">
            <label class="form-label">IMG_COVER</label>
            <input type="file" class="form-control @error('img_cover') is-invalid @enderror" name="img_cover">
            @error('img_cover')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror

            <img src="{{ asset('storage/' . $project->img_cover) }}" alt="" class="img-thumbnail">
        </div>
        </div>

        <div class="mb-3">
            <label class="form-label">NAME</label>
            <textarea name="name" cols="30" rows="5" class="form-control @error('name') is-invalid @enderror">{{ old('name', $project->name) }}</textarea>
            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">DESCRIPTION</label>
            <input type="text" class="form-control @error('description') is-invalid @enderror" name="description"
                value="{{ old('description', $project->description) }}">
            @error('description')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Tipo</label>
            <select class="form-select @error('type_id') is-invalid @enderror" name="type_id">

                @foreach ($types as $singletype)
                    <option value={{ $singletype->id }}>{{ $singletype->typeName }}</option>
                @endforeach
            </select>
            @error('type_id')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            
            @foreach ($technologies as $technology)
              <div class="form-check form-check-inline @error('technologies') is-invalid @enderror">
                
                <input class="form-check-input @error('technologies') is-invalid @enderror" type="checkbox"
                  id="tagCheckbox_{{ $loop->index }}" value="{{ $technology->id }}" name="technologies[]"
                 
                  {{ $project->technologies->contains('id', $technology->id) ? 'checked' : '' }}>
                <label class="form-check-label" for="tagCheckbox_{{ $loop->index }}">{{ $technology->name }} </label>
              </div>
            @endforeach

            @error('technologies')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
          </div>


        <div class="mb-3">
            <label class="form-label">LINK_PROJECTS</label>
            <input type="text" class="form-control @error('link_project') is-invalid @enderror" name="link_project"
                value="{{ old('link_project', $project->link_project) }}">
            @error('link_project')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>



        <div class="mb-3">
            <label class="form-label">CREATION_DATE</label>
            <input type="date" class="form-control @error('creation_date') is-invalid @enderror" name="creation_date"
                value="{{ old('creation_date', $project->creation_date) }}">
            @error('creation_date')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>



        <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary">Annulla</a>
        <button class="btn btn-primary">Salva</button>
    </form>

@endsection
