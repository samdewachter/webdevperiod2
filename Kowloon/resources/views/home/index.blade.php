@extends('layouts.app')

@section('content')

    <div class="carousel-wrapper">

        <div class="slider-wrapper" id="slick1">
            <div class="header-photos">
                <div class="image-wrapper"></div>
                <div class="image-wrapper2"></div>
                <div class="image-wrapper3"></div>
            </div>
        </div>
        <div class="slider-progress">
            <div class="progress"></div>
        </div>
    </div>
    <div class="content-wrapper clearfix">
        <div class="col-md-10 col-md-offset-1">
            <div class="info">
                <p>{{ Lang::get('info.intro') }}</p>
            </div>

            <div class="categories clearfix">

                @foreach($categories as $category)
                    <div class="category col-md-2 divider-vertical">
                        <a href="{{ url('categories', $category->url) }}">
                            <img src="{{ url('img/categories', $category->colorPhoto) }}">
                            <p>{{ $category->name }}</p>
                        </a>
                    </div>

                @endforeach
            </div>

            <div class="hot-items-wrapper clearfix">
                <h1>HOT ITEMS</h1>

                <div class="hot-items">

                    @foreach($hotItems as $hotItem)
                        <a href="{{ url('categories', [$hotItem->product->category->url, 'product' ,$hotItem->product_id]) }}">
                            <div class="col-md-3">
                                <div class="hot-item">
                                    <div class="photo">
                                        @if(count($hotItem->product->photos) > 1)
                                            <div class="product-count-photos"> {{ count($hotItem->product->photos) }} </div>
                                        @endif
                                        @if(count($hotItem->product->Photos) >= 1)<img src="{{ url('uploads/products', [$hotItem->product->Photos[0]->name]) }}">@endif
                                    </div>
                                    <div class="hot-item-info clearfix">
                                        <div class="pull-left">
                                            {{$hotItem->Product->name}}
                                        </div>
                                        <div class="pull-right">
                                            {{$hotItem->Product->price}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                    
                </div>
            </div>

            <div class="subscribe-wrapper">

                <div class="subscribe-info col-md-8">
                    <h1><strong>{{ Lang::get('subscribe.deals') }}</strong></h1>
                    <h4>{{ Lang::get('subscribe.only') }}</h4>
                </div>

                <div class="subscribe-form-wrapper col-md-4">
                    <div class="susbcribe-form">
                        <h4>{{ Lang::get('subscribe.subscribe') }}</h4>
                        Lorum ipsum dolor sit amet...
                        <form method="POST" action="{{ url('/subscribe') }}" class="subscribe">
                            {{ csrf_field() }}
                            <input type="text" name="email" value="{{old('email')}}"><button class="btn-primary btn-subscribe">OK</button>
                            <br>
                            @if ($errors->has('email'))
                                <span class="form-validation"><strong>{{ $errors->first('email') }}</strong></span>
                            @endif
                        </form>
                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection
