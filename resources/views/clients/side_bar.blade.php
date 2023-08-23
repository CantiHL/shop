<form action="" method="get">
    <div class="left-sidebar">
        <h2>Categories</h2>
        <div class="panel-group category-products" id="accordian"><!--category-productsr-->
            @foreach ($data_categories as $record)
                @if(request()->get('filter_category')==$record->id)
                    <div class="form-check">
                        <input id="id_{{ $record->id }}" class="form-check-input" name="filter_category" type="radio" value="{{ $record->id }}" id="flexCheckDefault" checked="true">
                        <label for="id_{{ $record->id }}" class="form-check-label" for="flexCheckDefault">
                            {{ $record->name }}
                        </label>
                    </div>
                @else
                    <div class="form-check">
                        <input id="id_{{ $record->id }}" class="form-check-input" name="filter_category" type="radio" value="{{ $record->id }}" id="flexCheckDefault" >
                        <label for="id_{{ $record->id }}" class="form-check-label" for="flexCheckDefault">
                            {{ $record->name }}
                        </label>
                    </div>
                @endif
            @endforeach
        </div><!--/category-products-->

        <div class="brands_products"><!--brands_products-->
            <h2>Brands</h2>
            <div class="brands-name">
                @foreach ($data_brands as $record1)
                    @if(request()->get('filter_brand')==$record1->id)
                        <ul class="nav nav-pills nav-stacked">
                            <div class="form-check">
                                <input id="id_{{ $record1->id }}" class="form-check-input" name="filter_brand" type="radio" value="{{ $record1->id }}" id="flexCheckDefault" checked="true">
                                <label for="id_{{ $record1->id }}" class="form-check-label" for="flexCheckDefault">
                                    {{ $record1->name }}
                                </label>
                            </div>
                        </ul>
                    @else
                        <ul class="nav nav-pills nav-stacked">
                            <div class="form-check">
                                <input id="id_{{ $record1->id }}" class="form-check-input" name="filter_brand" type="radio" value="{{ $record1->id }}" id="flexCheckDefault" >
                                <label for="id_{{ $record1->id }}" class="form-check-label" for="flexCheckDefault">
                                    {{ $record1->name }}
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


