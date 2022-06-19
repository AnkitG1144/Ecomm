<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Product</title>
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #F4F9F9;
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">
    <script rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="header ">
        <div class="flex justify-content-between px-4 py-4">
            <h1><a href="{{ url('/') }}" class="text-decoration-none text-white"><i class="fa-solid fa-bullhorn"></i> See&Buy</a></h1>
            <h1><a href="{{ url('cart') }}" class="text-decoration-none text-white"><i class="fa-solid fa-cart-shopping text-white"></i><span class="badge badge-pill badge-danger ">{{ count((array) session('cart')) }}</span></a></h1>
        </div>
        @if(Auth::guard('web')->check())
            <div class="flex justify-content-end">
                <p class="text-l text-white-700 dark:text-white-500 p-2">{{Auth::user()->name}} </p>
                <p class="p-2"><a href="{{ Auth::guard('web')->logout() }}"><i class="fa-solid fa-arrow-right-from-bracket"></i>Logout</a> </p>
            </div>
        @endif
    </div>
    @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif
    <section class="productDetail">
        <div class="section-1">
            <img src="{{ asset('product/images').'/'.$productDetail->image}}" alt="" srcset="">
        </div>
        <div class="section-2">
            <h1 class="productTitle">{{$productDetail->title}}</h1>
            <div class="d-flex justify-content-start productPrice">
                <p class="card-text text-dark fs-3 p-2"><b>₹ {{ $productDetail->offer_price }} </b></p>
                <p class="card-text text-black-50 fs-5 p-2 originalPrice">₹ {{ $productDetail->original_price }}</p>
                <p class="card-text text-success fs-6 p-2">{{ 100-floor(($productDetail->offer_price/$productDetail->original_price)*100) }} % off</p>
            </div>
            <div class="productionDesc">
                <h4>Product Description</h4>
                <p><i class="fa-solid fa-tag text-success"></i> {{$productDetail->desc}}</p>
            </div>
            <a href="{{ url('add-to-cart').'/'.$productDetail->id }}" class="btn btn-warning buyNowBtn"><i class="fa-solid fa-bolt"></i> Add To Cart</a>
        </div>
    </section>
</body>
</html>