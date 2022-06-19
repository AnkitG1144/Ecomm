<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">
    <script rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
</head>

<body>
    <div class="header">
        <div class="flex justify-content-between px-4 py-4">
            <h1><a href="{{ url('/') }}"  class="text-decoration-none text-white"><i class="fa-solid fa-bullhorn"></i> See&Buy </a></h1>
            @if(Auth::guard('web')->check())
            <div class="flex">
                <p class="text-l text-white-700 dark:text-white-500 p-2">{{Auth::user()->name}} </p>
                <p class="p-2"><a href="{{ Auth::guard('web')->logout() }}" class=" text-white"><i class="fa-solid fa-arrow-right-from-bracket"></i>Logout</a> </p>
            </div>
            @endif
        </div>
    </div>
    @if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
    @elseif(session()->has('danger'))
    <div class="alert alert-danger">
        {{ session()->get('danger') }}
    </div>
    @endif

    <table id="cart" class="table table-hover table-condensed">
        <thead>
            <tr>
                <th style="width:50%">Product</th>
                <th style="width:10%">Price</th>
                <th style="width:8%">Quantity</th>
                <th style="width:22%" class="text-center">Subtotal</th>
                <th style="width:10%"></th>
            </tr>
        </thead>
        <tbody>

            <?php $total = 0 ?>

            @if(session('cart'))
            @foreach(session('cart') as $id => $details)

            <?php $total += $details['original_price'] * $details['quantity'] ?>

            <tr>
                <td data-th="Product">
                    <div class="row">
                        <div class="col-sm-3 hidden-xs"><img src="{{ asset('product/images').'/'. $details['photo'] }}" width="100" height="100" class="img-responsive" /></div>
                        <div class="col-sm-9">
                            <h4 class="nomargin">{{ $details['name'] }}</h4>
                        </div>
                    </div>
                </td>
                <td data-th="Price">₹ {{ $details['original_price'] }}</td>
                <td data-th="Quantity">
                    <p>{{ $details['quantity'] }}</p>
                </td>
                <td data-th="Subtotal" class="text-center">₹ {{ $details['original_price'] * $details['quantity'] }}</td>
                <td class="actions" data-th="">
                    <a class="btn btn-danger btn-sm remove-from-cart" href="{{ url('delete-cart').'/'.$id }}"><i class="fa-solid fa-trash"></i></a>
                </td>
            </tr>
            @endforeach
            @endif

        </tbody>
        <tfoot>
            <tr>
                <td class="hidden-xs text-center"><strong>Total ₹ {{ $total }}</strong></td>
                <td colspan="2" class="hidden-xs"></td>
                <td>
                    <a href="{{ url('/') }}" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a>
                    <a href="{{  url('buy-now') }}" class="btn btn-success">Buy Now</a>
                </td>
            </tr>
        </tfoot>
    </table>

</body>

</html>