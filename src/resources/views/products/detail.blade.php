@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('content')

<div class="product-detail">

    <div class="product-detail__breadcrumb">
        <a href="/products">商品一覧</a> ＞ {{ $product->name }}    
    </div>

    <form class="product-detail__content" method="POST" action="/products/{{ $product->id }}/update" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="product-detail__image-area">

            <div class="product-detail__image">
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
            </div>

            <div class="product-detail__file">
                <input type="file" name="image"> 
            </div>

            @error('image')
                <p class="error-message">{{ $message }}</p>
                @enderror
        </div>

        <div class="product-detail__form">

            <div class="form-group">
                <label for="name">商品名</label>

                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ $product->name }}"
                    placeholder="商品名を入力">

                @error('name')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="price">値段</label>

                <input
                    type="text"
                    id="price"
                    name="price" 
                    value="{{ $product->price }}"
                    placeholder="値段を入力">

                @error('price')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label>季節</label>

                <div class="season">

                    <label>
                        <input
                            type="checkbox" name="season[]" value="1"
                            @if ($product->seasons->contains('id', 1)) checked @endif>
                        <span class="season__checkbox"></span>
                            春
                    </label>

                    <label>
                        <input
                             type="checkbox" name="season[]" value="2"
                            @if ($product->seasons->contains('id', 2)) checked @endif>
                        <span class="season__checkbox"></span>
                            夏
                    </label>

                    <label>
                        <input
                            type="checkbox" name="season[]" value="3"
                            @if ($product->seasons->contains('id', 3)) checked @endif>
                        <span class="season__checkbox"></span>
                            秋
                    </label>

                    <label>
                        <input
                            type="checkbox" name="season[]" value="4"
                            @if ($product->seasons->contains('id', 4)) checked @endif>
                        <span class="season__checkbox"></span>
                            冬
                    </label>

                </div>

                @error('season')
                    <p class="error-message">{{ $message }}</p>
                @enderror

            </div>

        </div>

        <div class="product-detail__description">

            <div class="form-group">
                <label for="description">商品説明</label>

                <textarea
                    id="description"
                    name="description"
                    placeholder="商品の説明を入力">{{ $product->description }}</textarea>

                @error('description')
                    <p class="error-message">{{ $message }}</p>
                @enderror

            </div>
        
        </div>

        <div class="product-detail__buttons">
                
            <a href="/products" class="product-detail__back">
                戻る
            </a>

            <button type="submit" class="product-detail__save">
                変更を保存
            </button>

        </div>

    </form>

    <form class="product-detail__delete-form"action="/products/{{ $product->id }}/delete" method="POST">
        @csrf
        @method('DELETE')

        <button type="submit" class="product-detail__delete">
            🗑
        </button>
    </form>

</div>

@endsection