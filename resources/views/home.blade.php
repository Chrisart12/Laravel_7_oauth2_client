@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    {{-- {{ dd("eee", auth()->user()->token) }} --}}
                    @if (!auth()->user()->token)
                        <a href="oauth/redirect">Authorize from server</a>
                    @else
                        @foreach ($posts as $post)

                            <div class="card">
                                <div class="card-header">{{ $post['title'] }}</div>
            
                                <div class="card-body">
                                    {{ $post['content'] }}
            
                                </div>
                            </div>
                        
                        @endforeach
                    @endif
                   
                </div>
            </div>

            
           
        </div>
    </div>
</div>
@endsection
