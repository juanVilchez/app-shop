@extends('layouts.app')

@section('title', 'Bienvenido a Shop Sports Radical')

@section('body-class','profile-page')

@section('content')

@section('styles')
    <style>
        .team{
            padding-bottom: 50px;
        }
        .team .row .col-md-4
        {
            margin-bottom: 5em;
        }
        .team .row {
          display: -webkit-box;
          display: -webkit-flex;
          display: -ms-flexbox;
          display:         flex;
          flex-wrap: wrap;
        }
        .row > [class*='col-'] {
          display: flex;
          flex-direction: column;
        }
    </style>
@endsection

<div class="header header-filter" style="background-image: url('/img/examples/city.jpg');"></div>

<div class="main main-raised">
    <div class="profile-content">
        <div class="container">
            <div class="row">
                <div class="profile">
                    <div class="avatar">
                        <img src="{{$category->featured_image_url}}" alt="Imagen representativa de la categoría {{$category->name}}" class="img-circle img-responsive img-raised">
                    </div>

                    <div class="name">
                        <h3 class="title">{{$category->name}}</h3>
                    </div>

                    @if (session('notification'))
                        <div class="alert alert-success">
                            {{ session('notification') }}
                        </div>
                    @endif
                </div>
            </div>
            <div class="description text-center">
                <p>{{$category->description}} </p>
            </div>
            
            <div class="team text-center" >
                <div class="row">
                    @foreach($products as $p)
                    <div class="col-md-4">
                        <div class="team-player">
                            <a href="{{url('/products/'.$p->id)}}"><img src="{{ $p->featured_image_url}}" alt="Thumbnail Image" class="img-raised img-circle"></a>
                            <h4 class="title">
                                <a href="{{url('/products/'.$p->id)}}">{{ $p->name }}</a>
                                <br />
                            </h4>
                            <p class="description">{{ $p->description }}</p>
                            <strong>S./{{ $p->price }}</strong>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="text-center">
                    {{$products->links()}}
                </div>
            </div>
        </div>
    </div>
</div>


@include('includes.footer')
@endsection


