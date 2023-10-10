@extends('layouts.app')

@section('title','Bienvenido')
@section('body-class', 'profile-page sidebar-collapse')

@section('content')
  <!--jumbotron-->
  <div class="page-header header-filter" data-parallax="true" style="background-image: url({{ asset('img/profile_city.jpg') }})">
  </div>
  <!-- end jumbotron-->

  <!-- contenido del perfil -->
  <div class="main main-raised">
    <div class="profile-content">
      <div class="container">
        <div class="row">
          <div class="col-md-6 ml-auto mr-auto">
            <div class="profile">

              <div class="avatar">
                <img src="/images/products/{{ $product->featured_image_url }}" alt="Circle Image" class="img-raised rounded-circle img-fluid">
              </div>

              <div class="name">
                <h3 class="title">{{ $product->name }}</h3>
                <h4><a href=" {{ url('/categories/'. $product->category->id) }}"> {{ $product->category->name }} </a></h4>
              </div>
              @if(session('notification'))
                <div class="alert alert-success text-center">
                  {{ session('notification') }}
                </div>
              @endif

              @if(session('error'))
                <div class="alert alert-warning text-center">
                  {{ session('error') }}
                </div>
              @endif
            </div>
          </div>
        </div>

        <div class="description text-center">
          <p>{{ $product->description_details }}</p>
        </div>
        <div class="description text-center">
          <h3> &dollar; {{ $product->price }}</h3>
        </div>

        <div class="row">
          <div class="col-md-8 ml-auto mr-auto">
            <div class="profile-tabs"> 
              <div class="text-center">
                @guest
                @else
                  <button class="btn btn-outline-primary  btn-round" data-toggle="modal" data-target="#modalAddToCart">
                      <i class="material-icons">add</i> Añadir al carrito
                  </button>
                @endguest
                
                <a href="{{ url('/products') }}" type="button" class="btn btn-btn-outline-light btn-round">
                    <i class="material-icons">arrow_back</i> Regresar
                </a>
              </div>
              <div class="tab-content">
                <div class="tab-pane active text-center gallery" id="studio">
                  <div class="row">
                    <div class="col-md-4 ml-auto">
                        @foreach( $imagesLeft as $image)
                          <img src="/images/products/{{ $image->url }}" class="rounded">
                        @endforeach
                    </div>
                    
                    <div class="col-md-6 mr-auto">
                      @foreach( $imagesRight as $image)
                        <img src="/images/products/{{ $image->url }}" class="rounded">
                      @endforeach
                    </div>           
                  </div>
                </div>
              </div>
            </div>    
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="modalAddToCart" tabindex="-1" role="dialog" aria-labelledby="modalAddToCart" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Indica la cantidad de productos</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        
        <form method="post" action="{{ url('/cart') }}">
          {{ csrf_field() }}
          <input type="hidden" name="product_id" value="{{ $product->id }}">

          <div class="modal-body">
            <input type="number" name="quantity" class="form-control" value="1">
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary">Añadir</button>
          </div>
        </form>
        
      </div>
    </div>
  </div>
@endsection