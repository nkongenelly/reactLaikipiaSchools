@extends('layoutsBuyer')

@section('content')

    <!-- Page Content -->
    <div class="container">

      <div class="row">

        <div class="col-lg-3">

          <h1 class="my-4">Shop By</h1>
          <div class="list-group">
              @include('sidebar')
          </div>

        </div>
        <!-- /.col-lg-3 -->

        <div class="col-lg-9">

          <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
            <ol class="carousel-indicators">
              <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner" role="listbox">
              <div class="carousel-item active">
                <img class="d-block img-fluid" src="http://placehold.it/900x350" alt="First slide">
              </div>
              <div class="carousel-item">
                <img class="d-block img-fluid" src="http://placehold.it/900x350" alt="Second slide">
              </div>
              <div class="carousel-item">
                <img class="d-block img-fluid" src="http://placehold.it/900x350" alt="Third slide">
              </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>

          <div class="row">
          @foreach($products as $product)
            <div class="col-lg-4 col-md-6 mb-4">
              <div class="card h-100">
                <a href="#"><img class="card-img-top" src="/images/{{ $product->product_image }}" alt=""></a>
                <div class="card-body">
                  <h4 class="card-title">
                    <a href="#">{{ $product->product_name }} | {{ $product->product_price }}</a>
                  </h4>
                  <h5>{{ $product->product_price }}</h5>
                  <p class="card-text">{{ $product->product_description }}</p>
                </div>
                <div class="card-footer">
                  <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                </div>
                @if($product->product_status == "2")
                           
                  <a href="#" class="btn btn-success disabled" title="Out of Stock">View</a>
              
                  <a href="#" class="btn btn-success disabled" title="Out of Stock">Add to Cart</a>
                
                <a href="/reviewsbuyer/{{ $product->id }}" class="btn btn-outline-success my-2 my-sm-0" >Review</a>
                @else
                
                    <a href="/orderbuyerview/{{ $product->id }}" class="btn btn-outline-success my-2 my-sm-0" >View Features</a>
                
                    <a href="/orderbuyerview/{{ $product->id }}" class="btn btn-outline-success my-2 my-sm-0" >Add to Cart</a>
                
                
                    <a href="/reviewsbuyer/{{ $product->id }}" class="btn btn-outline-success my-2 my-sm-0" >Review</a>

                @endif
              </div>
            </div>
            @endforeach


          </div>
          <!-- /.row -->

        </div>
        <!-- /.col-lg-9 -->

      </div>
      <!-- /.row -->

    </div>
    <!-- /.container -->

    <!-- Footer -->
    <footer class="py-5 bg-dark">
      <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Jarabu Designs 2017</p>
      </div>
      <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    @endsection
