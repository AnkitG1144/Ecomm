<x-vendor-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <table class="table productTable">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Product Image</th>
                            <th scope="col">Product Title</th>
                            <th scope="col">Product Description</th>
                            <th scope="col">Original Price</th>
                            <th scope="col">Offer Price</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($allProducts as $key => $product)
                            <tr>
                                <th scope="row">{{ $key + 1  }}</th>
                                <td><img src="{{ asset('product/images').'/'.$product->image }}" alt="product image" srcset=""></td>
                                <td>{{ $product->title }}</td>
                                <td>{{ $product->desc }}</td>
                                <td>{{ $product->original_price }}</td>
                                <td>{{ $product->offer_price }}</td>
                                <td>@if($product->is_active) <p class="text-primary">Active</p> @else  <p class="text-danger">Deactive </p> @endif</td>
                                <td>
                                    @if($product->is_active)
                                        <a href="{{ url('vendor/product-deactivate/0/') .'/'.$product->id }}" class="btn btn-danger">Deactivate</a>
                                    @else
                                        <a href="{{ url('vendor/product-deactivate/1/') .'/'. $product->id }}" class="btn btn-success">Activate</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-vendor-layout>