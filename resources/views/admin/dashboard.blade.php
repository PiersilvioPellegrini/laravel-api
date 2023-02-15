@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mt-5">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body ">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('You are logged in!') }}
                    </div>
                </div>

                @if (Auth::user())
                    <h1 class="text text-center mb-5 mt-5 "> Gli utenti presenti nel database sono :</h1>
                    <div class="card">
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nome</th>
                                        <th>Email</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $singleUser)
                                        <tr>
                                            <td>{{ $singleUser->id }}</td>
                                            <td>{{ $singleUser->name }}</td>
                                            <td>{{ $singleUser->email }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
            </div>
            <div class="buttonarea mt-5 ">
                <a href="{{route("admin.projects.index")}}"><button class="project btn btn-primary">I TUOI PROGETTI</button></a>
            </div>
        </div>
    </div>
@endsection
