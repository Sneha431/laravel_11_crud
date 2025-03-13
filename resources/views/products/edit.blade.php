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
        <a href="{{route('products.index')}}" class=" btn btn-dark">Back</a>
      </div>
    </div>
    <div class="row d-flex justify-content-center">
      <div class="col-md-10">
        <div class="card border-0 shadow-lg my-4">
          <div class="card-header bg-dark text-white">
            <h3>Edit Product</h3>
          </div>
          <form action="{{ route('products.update',$product->id) }}" method="POST" enctype="multipart/form-data">
            @method('put')
            @csrf
            <div class="card-body">
              <div class="mb-3">
                <label for="" class="form-label h5">Name</label>
                <input type="text" value="{{old('name',$product->name)}}"
                  class="form-control form-control-md @error('name') is-invalid @enderror" placeholder="Name"
                  name="name">
                @error('name')
                <p class="invalid-feedback">{{$message}}</p>
                @enderror
              </div>
              <div class="mb-3">
                <label for="" class="form-label h5">Sku</label>
                <input type="text" value="{{old('sku',$product->sku)}}"
                  class="form-control form-control-md @error('sku') is-invalid @enderror" placeholder="Sku" name="sku">
                @error('sku')
                <p class="invalid-feedback">{{$message}}</p>
                @enderror
              </div>
              <div class="mb-3">

                <label for="" class="form-label h5">Price</label>
                <input type="text" class="form-control form-control-md @error('price') is-invalid @enderror"
                  placeholder="Price" name="price" value="{{old('price',$product->price)}}">
                @error('price')
                <p class="invalid-feedback">{{$message}}</p>
                @enderror
              </div>
              <div class="mb-3">
                <!-- //old() helper is used to retrieve the previously submitted input (from a failed form submission) 
                after a validation error. This is useful in situations where you want to 
                //retain user input in a form field when validation fails, 
                //allowing the user to correct the data without losing what they have already entered. 
                
                When a form submission fails due to validation, Laravel automatically stores the previous input in the session, and you can retrieve it using the old() function. This is most commonly used in a form to repopulate the fields 
                with the data the user entered before the validation error occurred.
                -->
                <label for="" class="form-label h5">Description</label>
                <textarea name="description" id="" cols="30" rows="5" class="form-control"
                  placeholder="Description">{{ old('description',$product->description) }}</textarea>
              </div>
              <div class="mb-3">

                <label for="" class="form-label h5">Image</label>
                <input type="file" class="form-control form-control-md" placeholder="Image" name="image">
                @if($product->image!="")
                <img src="{{asset('uploads/products/'.$product->image)}}" alt="" class="w-50 my-2">
                @endif
              </div>
              <div class="d-grid">
                <button class="btn btn-lg btn-primary">Update</button>
              </div>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
  <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
  </script>
</body>

</html>