@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')

<div class="product-register">

    <h2 class="product-register__heading">
        商品登録
    </h2>

    <form class="product-register__form" action="/products/register" method="POST" enctype="multipart/form-data">
    @csrf

        <div class="form-group">
            <label for="name">
                商品名
                <span class="required">必須</span>
            </label>

            <input type="text" id="name" name="name"  placeholder="商品名を入力">

            @error('name')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="price">
                値段
                <span class="required">必須</span>
            </label>

            <input type="text" id="price" name="price" placeholder="値段を入力">
            @error('price')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label>
                商品画像
                <span class="required">必須</span>
            </label>

            <div class="product-register__file">
                <input type="file" name="image">
            </div>
            
            @error('image')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label>
                季節
                <span class="required">必須</span>
                <span class="multiple">複数選択可</span>
            </label>

            <div class="season">
                <label>
                    <input type="checkbox" name="season[]" value="1">
                    <span class="season__checkbox"></span>
                    春
                </label>

                <label>
                    <input type="checkbox" name="season[]" value="2">
                    <span class="season__checkbox"></span>
                    夏
                </label>

                <label>
                    <input type="checkbox" name="season[]" value="3">
                    <span class="season__checkbox"></span>
                    秋
                </label>

                <label>
                    <input type="checkbox" name="season[]" value="4">
                    <span class="season__checkbox"></span>
                    冬
                </label>
            </div>

            @error('season')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">
                商品説明
                <span class="required">必須</span>
            </label>

            <textarea id="description" name="description"  placeholder="商品の説明を入力"></textarea>

            @error('description')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <div class="product-register__buttons">
            <a href="/products" class="product-register__back">
                戻る
            </a>

            <button type="submit" class="product-register__submit">
                登録
            </button>
        </div>

    </form>

</div>

@endsection