<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <title>Laravel 11 crud</title>
</head>

<body>
  <div class="bg-dark py-3">
    <h3 class="text-white text-center">Laravel 11 Crud </h3>
  </div>

  <div class="container">
    <div class="row justify-content-center mt-4">
      <div class="col-md-10 d-flex justify-content-end">
        <a href="{{route('products.create')}}" class=" btn btn-dark">Create</a>
      </div>
    </div>
    <div class="row d-flex justify-content-center">
      @if(Session::has('success'))
      <div class="col-md-10 mt-4">
        <div class="alert alert-success">
          {{Session::get('success')}}
        </div>
      </div>
      @endif

      <div class="col-md-10">
        <div class="card border-0 shadow-lg my-4">
          <div class="card-header bg-dark text-white">
            <h3>Products</h3>
          </div>
          <div class="card-body">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">#ID</th>
                  <th scope="col"></th>
                  <th scope="col">Name</th>
                  <th scope="col">Sku</th>
                  <th scope="col">Price</th>
                  <th scope="col">Created At</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                @if ($products->isNotEmpty())
                @foreach($products as $product)
                <tr>
                  <th scope="row">{{$product->id}}</th>
                  <td>
                    @if($product->image !="")
                    <img src="{{asset('uploads/products/'.$product->image)}}" alt="" width="50">
                    @endif
                  </td>
                  <td>{{$product->name}}</td>
                  <td>{{$product->sku}}</td>
                  <td>{{$product->price}}</td>
                  <td>{{\Carbon\Carbon::parse($product->created_at)->format('d M, Y')}}</td>
                  <td>
                    <a href="{{route('products.edit',$product->id)}}" class="btn btn-dark">Edit</a>
                    <a href="#" onclick="deleteProduct({{ $product->id }});" class="btn btn-danger">Delete</a>
                    <form action="{{route('products.destroy',$product->id)}}" id="delete-product-form-{{$product->id}}"
                      method="post">
                      @csrf
                      @method('delete')
                    </form>
                  </td>

                </tr>
                @endforeach
                @endif



              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
  </script>
</body>

</html>
<script>
function deleteProduct(id) {
  if (confirm("Are you sure,you want to delete ?")) {
    document.getElementById("delete-product-form-" + id).submit();
  }
}
</script>