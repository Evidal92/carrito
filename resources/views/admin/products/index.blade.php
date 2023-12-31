@extends('layouts.app')

@section('title','Productos')
@section('body-class', 'profile-page sidebar-collapse')
@section('content')
  
<!--jumbotron-->
  <div class="page-header header-filter" data-parallax="true" style="background-image: url({{ asset('img/profile_city.jpg') }})">
  </div>
  <!-- end jumbotron-->

  <div class="main main-raised">
    <div class="container">
      <div class="section text-center">
        <h2 class="title">Listado de productos </h2>
        <div class="team">
            <div class="row">
              <a href="{{ url('admin/products/create') }}" class="btn btn-primary btn-round">Agregar Producto</a>              
              <table class="table">
                  <thead>
                      <tr>
                        <th class="col-md-2 text-center"> Nombre</th>
                        <th class="col-md-2 text-center"> Descripción</th>
                        <th class="text-center"> Categoría</th>
                        <th class="text-right">Precio</th>
                        <th class="text-rigth">Acciones</th>
                        </tr>
                  </thead>
                  <tbody>
                      @foreach($allProducts as $product)
                      <tr>
                        <td>{{ $product->name }}</td>
                          <td class="col-md-4"> {{ $product->description }}</td>
                          <td>{{ $product->category->name  }}</td>
                          <td class="td-actions text-right">&dollar; {{ $product->price }} </td>
                          <td class="td-actions text-right col-md-4">
                              <form method="POST" action="{{ url('/admin/products/'.$product->id.'') }}">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <a href="{{ url('products/'.$product->id) }}" rel="tooltip" title="Ver producto" class="btn btn-info btn-simple btn-xs">
                                    <i class="material-icons">info</i>
                                </a>
                                <a href="{{ url('/admin/products/'.$product->id.'/edit') }}" type="button" rel="tooltip" title="Editar" class="btn btn-success
                                btn-simple btn-xs">
                                    <i class="material-icons">edit</i>
                                </a>
                                <a href="{{ url('/admin/products/'.$product->id.'/images') }}" type="button" rel="tooltip" title="Imagenes" class="btn btn-warning
                                btn-simple btn-xs">
                                    <i class="material-icons">image</i>
                                </a>
                                <button type="submit" rel="tooltip" title="Eliminar" class="btn btn-danger
                                btn-simple btn-xs">
                                    <i class="fa fa-times"></i>
                                </button>
                              </form>
                          </td>
                      </tr>
                      @endforeach
                  </tbody>
              </table>

              <div class="center-block">
                {{ $allProducts->links("pagination::bootstrap-4") }}
              </div>
            </div>
        </div>
    </div>
    </div>
  </div>
  <!--end principal content-->
@endsection