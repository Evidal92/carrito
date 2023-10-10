@extends('layouts.app')

@section('title','Bienvenido')
@section('body-class', 'landing-page sidebar-collapse')
@section('styless')
  <style>
    .row{
      display: -webkit-box;
      display: -webkit-flex;
      display: -ms-flexbox;
      display: flex;
      flex-wrap: wrap;
    }

    .row > [class*='col-']{
      display: flex;
      flex-direction: column;
    }
  </style>
@endsection

@section('content')
  
<!--jumbotron-->
  <div class="page-header header-filter" data-parallax="true" style="background-image: url({{ asset('img/profile_city.jpg') }})">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 class="title">Bienvenido a Ecommerce!</h1>
          <h4>Realiza pedidos en linea</h4>
          <br>
        </div>
      </div>
    </div>
  </div>
  <!-- end jumbotron-->

  <div class="main main-raised">
    <div class="container">
      <div class="section text-center">
        <div class="row">
          <div class="col-md-8 ml-auto mr-auto">
            @if (session('notification'))
              <div class="alert alert-success text-center">
                  {{ session('notification') }}
              </div>
            @endif
        </div>

    <div class="section text-center">
        <h2 class="title">Productos destacados </h2>
        <br>
        <span class="clearfix"></span>
          <form class="form-inline justify-content-center" name="query" method="get" action="{{ url('search') }}">
            <div class="form-group no-border">
            <input type="text" class="form-control" placeholder="¿Que producto buscas?" name="query" id="search">
            </div>
            <button type="submit" class="btn btn-primary btn-just-icon btn-round">
            <i class="material-icons">search</i>
            </button>
          </form>        
          
          <div class="team">
            <div class="row">
                @foreach($allProducts as $product)
                <div class="col-md-4">
                    <div class=" card team-player">
                        <div class="card card-plain">
                            <div class="col-md-6 ml-auto mr-auto">
                                <img src="/images/products/{{ $product->featured_image_url }}" alt="Thumbnail Image" class="img-raised rounded-circle img-fluid">
                            </div>
                            <h4 class="card-title"> <a href=" {{ url('/products/'. $product->id) }}"> {{ $product->name }}  </a>
                                <br>
                                <h4 class="card-description"> <a href=" {{ url('/categories/'. $product->category->id) }}"> {{ $product->category->name }} </a></h4>
                                <br>
                                <small class="card-description text-muted">&dollar; {{ $product->price}}</small>
                            </h4>
                            <div class="card-body">
                                <p class="card-description">{{ $product->description }} </p>
                            </div>
                            <div class="card-footer justify-content-center">
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="text-center">
          <a href="{{ url('/products') }}" type="button" class="btn btn-outline-primary  btn-round">
            <i class="material-icons">add</i> Ver más
          </a>
        </div>
    </div>
  </div>
@endsection

@section('scripts')
  <script src="{{ asset('/js/typeahead.bundle.min.js') }}"> </script>
  <script>
    $(function(){
      var products = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.whitespace,
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        prefetch: '{{ url("/products/json") }}'
      });
     
      $('#search').typeahead({
        hint: true,
        highlight: true,
        minLength: 1
      },{
        name: 'products',
        source:products
      });

    });
  </script>
@endsection