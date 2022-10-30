@extends('layout.layout')
@section('main-content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="row mt-4 mr-2">
                <div class="col-md-12 text-right" title="Back to Onboarding List">
                    <a href="/user/product" class="btn-primary btn-sm">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
            <div class="card-body">
                <h3 class="card-title mb-4">Product Details</h3>

                <form action="{{$action}}" method="post" name="product" id="product">
                    @csrf
                    @if($actionBit)
                        @method('PUT')
                    @endif
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name" class="required">Name</label>
                                <input type="text" name="name" class="form-control" id="name" data-rule-required="true" data-msg-required="You must enter product's name" autocomplete="off" value="{{ $product->name??''}}">
                                <span class="text-muted">(Type product name)</span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="category" class="required">Category</label>
                                <select name="category" class="form-control" id="category" data-rule-required="true" data-msg-required="You must select category">
                                    @isset($product)
                                        <option value="{{$product->category_id??''}}">{{$product->category->name}}</option>
                                    @endisset
                                </select>
                                <span class="text-muted">(Select product category)</span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="price" class="required">Price</label>
                                <input type="number" name="price" class="form-control" id="price" data-rule-required="true" data-msg-required="You must enter price" aria-invalid="false" value="{{$product->price??''}}">
                                <span class="text-muted">(Type price)</span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="quantity" class="required">Quantity</label>
                                <input type="number" name="quantity" class="form-control" id="quantity" data-rule-required="true" data-msg-required="You must enter quantity" aria-invalid="false" value="{{$product->quantity??''}}">
                                <span class="text-muted">(Type quantity)</span>
                            </div>
                        </div>
                    </div>

                    <div class="float-right">
                        <button type="submit" class="btn btn-outline-success  waves-effect waves-light mr-4 px-5" id="onboarding-form-submit">Submit</button>
                        <button type="reset" class="btn btn-outline-danger  waves-effect waves-light px-5" id="onboarding-form-reset">Reset</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function() {
        $('form[name="product"]').validate();
        $( "#price" ).blur(function() {
            this.value = parseFloat(this.value).toFixed(2);
        });
        $('#category').select2({
            placeholder: 'Select a Category',
            allowClear: true,
            ajax: {
                url: "{{route('category.list')}}",
                dataType: 'json',
                data: function(params) {
                    return {
                        term: params.term || '',
                        page: params.page || 1
                    }
                },
                cache: true,
                processResults: function(data) {
                    let results = [];
                    $.each(data.results, function(key, value) {
                        let temp = {};
                        temp.id = value.id;
                        temp.text = value.name;
                        results.push(temp);
                    });
                    return {
                        results: results,
                        pagination: {
                            more: data.pagination.more
                        }
                    }
                }
            }
        });
    });
</script>
@endsection
