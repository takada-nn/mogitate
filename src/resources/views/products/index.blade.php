@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')

<div class="products">

    <div class="products__header">

        <h2 class="products__heading">
            商品一覧
        </h2>

        <a class="products__add-button" href="/products/register">
            ＋ 商品を追加
        </a>

    </div>


    <div class="products__body">

        <aside class="products__sidebar">

            <form class="products__search" action="/products/search" method="GET">

                <div class="products__search-item">
                    <input
                        class="products__search-input"
                        type="text"
                        name="keyword"
                        value="{{ request('keyword') }}"
                        placeholder="商品名で検索"
                    >

                    @if (request('sort'))
                        <input
                        type="hidden"
                        name="sort"
                        value="{{ request('sort') }}"
                        >
                    @endif

                </div>

                <div class="products__search-button">
                    <button
                        class="products__search-button-submit"
                        type="submit"
                    >
                        検索
                    </button>
                </div>

            </form>


            <div class="products__sort">

                <h3 class="products__sort-heading">
                    価格順で表示
                </h3>

                <form class="products__sort-form" method="GET" action="{{ request('keyword') ? '/products/search' : '/products' }}"
                >

                    <input type="hidden"
                    name="keyword"
                    value="{{ request('keyword') }}"
                    >

                    <select            class="products__sort-select" name="sort"
                    onchange="if (this.value === '') {
                    window.location.href = '{{ request('keyword') ? '/products/search?keyword=' . urlencode(request('keyword')) : '/products' }}';
                    } else {
                        this.form.submit();
                    }">

                    <option value="" {{ $sort === '' || $sort === null ? 'selected' : '' }}>
                        価格で並び替え
                    </option>

                    <option value="desc" {{ $sort === 'desc' ? 'selected' : '' }}>
                        高い順に表示
                    </option>

                    <option value="asc" {{ $sort === 'asc' ? 'selected' : '' }}>
                        低い順に表示
                    </option>
                    
                    </select>

                    @if ($sort === 'desc')
                        <div class="products__sort-selected">
                            高い順に表示
                            
                            @if (request('keyword'))
                                <a href="/products/search?keyword={{ urlencode(request('keyword')) }}" class="products__sort-reset">×</a>
                            @else
                                <a href="/products" class="products__sort-reset">×</a>
                            @endif

                        </div>

                    @elseif ($sort === 'asc')
                        <div class="products__sort-selected">
                            低い順に表示
                            
                            @if (request('keyword'))
                                <a href="/products/search?keyword={{ urlencode(request('keyword')) }}" class="products__sort-reset">×</a>
                            @else
                                <a href="/products" class="products__sort-reset">×</a>
                            @endif
                        </div>
                    @endif
                </form>

            </div>

        </aside>


        <section class="products__content">

            <div class="products__list">

                @foreach ($products as $product)

                    <a href="/products/detail/{{ $product->id }}" class="product-card">

                        <div class="product-card__image">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                        </div>

                        <div class="product-card__info">

                            <p class="product-card__name">
                            {{ $product->name }}
                            </p>

                            <p class="product-card__price">
                            ¥{{ number_format($product->price) }}
                            </p>

                        </div>

                    </a>

                @endforeach

            </div>

            <div class="products__pagination">
                {{ $products->links('vendor.pagination.custom') }}
            </div>  

        </section>

    </div>

</div>

@endsection