<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Simple Laravel CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <div class="bg-dark py-3 ">
        <h3 class="text-white text-center">Simple Laravel CRUD</h3>
    </div>
    <div class="container">
        <div class="row justify-center mt-4">
            <div class="col-md-10 d-flex">
                <a href="{{route('products.index')}}" class="btn btn-dark text-white ms-auto">
                    Back
                </a>
            </div>
        </div>
        <div class="row d-flex justity-center">
            <div class="col-md-10">
                <div class="card border-0 shadow-lg my-4">
                    <div class="card-header bg-dark">
                        <h3 class="text-white text-center">Edit Product</h3>
                    </div>
                    <form enctype="multipart/form-data" action="{{route('products.update', $product->id)}}"
                        method="post">
                        @method('put')
                        @csrf
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="" class="form-label h5">Name</label>
                                <input value="{{old('name', $product->name)}}" type="text"
                                    class="form-control form-control-md @error('name') is-invalid @enderror"
                                    placeholder="Name" name="name">
                                @error('name')
                                    <p class="invalid-feedback">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label h5">SKU</label>
                                <input value="{{old('sku', $product->sku)}}" type="text"
                                    class="form-control form-control-md @error('sku') is-invalid @enderror"
                                    placeholder="SKU" name="sku">
                                @error('sku')
                                    <p class="invalid-feedback">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label h5">Price</label>
                                <input value="{{old('price', $product->price)}}" type="text"
                                    class="form-control form-control-md @error('price') is-invalid @enderror"
                                    placeholder="Price" name="price">
                                @error('price')
                                    <p class="invalid-feedback">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label h5">Description</label>
                                <textarea class="form-control" value="{{old('description', $product->description)}}"
                                    placeholder="Description" name="description" cols="30" rows="5"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label h5">Image</label>
                                <input type="file" class="form-control form-control-md" placeholder="Image"
                                    name="image">
                                @if ($product->image != "")
                                    <img class="w-50 my-3" src="{{asset('uploads/products/' . $product->image)}}"
                                        alt="image">

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




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>

</body>

</html>