<form action="" method="get">
    <div class="left-sidebar">
        <h2>Categories</h2>
        <div class="panel-group category-products" id="accordian"><!--category-productsr-->
            @foreach ($data_categories as $record)
                @if(request()->get('filter_category')==$record->category_id)
                    <div class="form-check">
                        <input id="category_id_{{ $record->category_id }}" class="form-check-input" name="filter_category" type="radio" value="{{ $record->category_id }}" id="flexCheckDefault" checked="true">
                        <label for="category_id_{{ $record->category_id }}" class="form-check-label" for="flexCheckDefault">
                            {{ $record->category_name }}
                        </label>
                    </div>
                @else
                    <div class="form-check">
                        <input id="category_id_{{ $record->category_id }}" class="form-check-input" name="filter_category" type="radio" value="{{ $record->category_id }}" id="flexCheckDefault" >
                        <label for="category_id_{{ $record->category_id }}" class="form-check-label" for="flexCheckDefault">
                            {{ $record->category_name }}
                        </label>
                    </div>
                @endif
            @endforeach
        </div><!--/category-products-->

        <div class="brands_products"><!--brands_products-->
            <h2>Brands</h2>
            <div class="brands-name">
                @foreach ($data_brands as $record1)
                    @if(request()->get('filter_brand')==$record1->brand_id)
                        <ul class="nav nav-pills nav-stacked">
                            <div class="form-check">
                                <input id="brand_id_{{ $record1->brand_id }}" class="form-check-input" name="filter_brand" type="radio" value="{{ $record1->brand_id }}" id="flexCheckDefault" checked="true">
                                <label for="brand_id_{{ $record1->brand_id }}" class="form-check-label" for="flexCheckDefault">
                                    {{ $record1->brand_name }}
                                </label>
                            </div>
                        </ul>
                    @else
                        <ul class="nav nav-pills nav-stacked">
                            <div class="form-check">
                                <input id="brand_id_{{ $record1->brand_id }}" class="form-check-input" name="filter_brand" type="radio" value="{{ $record1->brand_id }}" id="flexCheckDefault" >
                                <label for="brand_id_{{ $record1->brand_id }}" class="form-check-label" for="flexCheckDefault">
                                    {{ $record1->brand_name }}
                                </label>
                            </div>
                        </ul>
                    @endif
                @endforeach
                <input value="{{request()->old('keywords')}}" type="text" id="keywords" name="keywords" class="form-control" placeholder="Search Product">
            </div>
        </div><!--/brands_products-->
    </div>
    @csrf
    <button type="submit" data-url="{{ route('search') }}" class="btn btn-block btn-success btn_search">Search</button>
</form>


