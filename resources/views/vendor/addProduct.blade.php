<x-vendor-layout>
    <x-slot name="header">
        
        
        <div class="vendor_dashboard_position">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Add Product') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <form action="{{ route('vendor.add-product') }}" method="post" enctype="multipart/form-data">
                @csrf
                    <div class="form-group row p-2">
                        <label for="inputProcutTitle" class="col-sm-2 col-form-label">Product Title</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" name="productTitle" id="inputProcutTitle" placeholder="Product Title">
                        </div>
                    </div>
                    <div class="form-group row p-2">
                        <label for="inputProcutDescription" class="col-sm-2 col-form-label">Product Description</label>
                        <div class="col-sm-10">
                            <textarea rows="4" class="form-control" name="productDescription" id="inputProcutDescription" placeholder="Product Description"></textarea>
                        </div>
                    </div>
                    <div class="form-group row p-2 custom-file">
                        <label for="inputProcutImage" class="col-sm-2 col-form-label">Product Image</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control custom-file-input" id="inputProcutImage" name="image" required>
                        </div>
                    </div>
                    <div class="form-group row p-2">
                        <label for="inputProdcutprice" class="col-sm-2 col-form-label">Original Price</label>
                        <div class="col-sm-4">
                        <input type="number" class="form-control" name="productprice" id="inputProdcutprice" placeholder="Product Price">
                        </div>
                        <label for="inputProdcutOfferPrice" class="col-sm-2 col-form-label">Offer Price</label>
                        <div class="col-sm-4">
                        <input type="number" class="form-control" name="productOfferPrice" id="inputProdcutOfferPrice" placeholder="Product Offer Price">
                        </div>
                    </div>
                    <div class="form-group row p-2">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-10 flex justify-end">
                            <a href="#" class="btn btn-outline-dark m-2">Back</a>
                            <button type="submit" class="btn btn-primary m-2">Add Product</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-vendor-layout>