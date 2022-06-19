<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">
    <script rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #F4F9F9;
        }

        .welcome_product_card {
            display: flex;
            flex-flow: row wrap;
            align-content: space-between;
            justify-content: start;
        }

        .welcome_product_card>a>div {
            margin: 0.5rem 1rem 0.5rem 1rem;
        }
        .originalPrice {
            font-size: 16px;
            text-decoration: line-through;
        }
        .offerPrice {
            font-size: 18px;
        }

        .product_card{
            transition: box-shadow 2s;
        }

        .product_card:hover {
            color: blueviolet;
            box-shadow: 10px 10px 5px #AAAAAA;
            cursor: pointer;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body class="antialiased">
    <div class="header">
        <div class="flex justify-content-between px-4 py-4">
            <h1><a href="{{ url('/') }}" class="text-decoration-none text-white"><i class="fa-solid fa-bullhorn"></i> See&Buy</a></h1>
            <h1><a href="{{ url('cart') }}" class="text-decoration-none text-white"><i class="fa-solid fa-cart-shopping text-white"></i><span class="badge badge-pill badge-danger">{{ count((array) session('cart')) }}</span></a></h1>
        </div>
        <div class="relative flex items-top py-4 sm:pt-0 justify-content-end">
            <div class="hidden top-0 right-0 px-6 py-4 sm:block">
                @if(Auth::guard('web')->check())
                <div class="flex">
                    <p class="text-l text-white-700 dark:text-white-500 p-2">{{Auth::user()->name}} </p>
                    <p class="p-2"><a href="{{ Auth::guard('web')->logout() }}" class=" text-white"><i class="fa-solid fa-arrow-right-from-bracket"></i>Logout</a> </p>
                </div>
                @else
                    <a href="{{ route('login') }}" class="text-m text-white-700 dark:text-white-500">Login</a>
                    <a href="{{ route('register') }}" class="ml-4 text-m text-white-700 dark:text-white-500">Register </a>
                    <a href="{{ route('vendor.login') }}" class="ml-4 text-m text-white-700 white:text-white-500 "> Login As Vendor</a>
                    <a href="{{ route('vendor.register') }}" class="ml-4 text-m text-white-700 white:text-white-500 ">Register As Vendor</a>
                @endif
            </div>
    
            <!-- <div class="max-w-2xl">
                
            </div> -->
        </div>
    </div>

    <h1 class="px-1">All Products</h1>
    <div class="welcome_product_card">
        @foreach($allProducts as $product)
        <a href="{{ url('view-product-details/').'/'.$product->id }}">
            <div class="card product_card" style="width: 18rem;">
                <img class="card-img-top" src="{{asset('product/images/').'/'.$product->image }}" alt="Card image cap" height="200px" width="200px">
                <div class="card-body">
                    <h5 class="card-title textWrap">{{ $product->title }}</h5>
                    <p class="card-text textWrap">{{ $product->desc }}</p>
                    <div class="d-flex justify-content-start">
                        <p class="card-text text-dark p-2 offerPrice"><b>₹ {{ $product->offer_price }} </b></p>
                        <p class="card-text text-black-50 originalPrice p-2">₹ {{ $product->original_price }}</p>
                        <p class="card-text text-success p-2">{{ 100-floor(($product->offer_price/$product->original_price)*100) }} % off</p>
                    </div>
                </div>
            </div>
        </a>
        @endforeach
    </div>
</body>

</html>