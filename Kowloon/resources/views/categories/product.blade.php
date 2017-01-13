@extends('layouts.app')

@section('content')

	<div class="product-wrapper clearfix">

		<div class="col-md-10 col-md-offset-1">
			
			<div class="product clearfix">
				@if (session('success'))
	                <div class="alert alert-success">
	                    {{ session('success') }}
	                </div>
	            @endif
				<div class="col-md-6">
					<div class="product-pictures clearfix">
						<div class="main-picture">
							@if(count($product->photos) > 0)
								@foreach($product->photos as $photo)
									<img src="{{ url('uploads/products', $photo->name) }}">
								@endforeach
							@else
								<img src="{{ url('img/Home_img2.png') }}">
							@endif
						</div>
						<div class="other-pictures">
							@if(count($product->photos) > 0)
								@foreach($product->photos as $photo)
									<div class="col-md-4">
										<div class="other-picture">
											<img src="{{ url('uploads/products', $photo->name) }}">
										</div>
									</div>
								@endforeach
							@endif
						</div>
						@if(count($product->photos) < 1)
							<div class="alert alert-info">Er zijn geen foto's voor dit product.</div>
						@endif
					</div>
				</div>

				<div class="col-md-6">
					<div class="product-info">

						<div class="product-tags">
							<ul>
								<li><h2>K</h2></li>
								<li>{{ $category->pluralName }}</li>
								<li>{{ $product->Tag->displayName }}</li>
							</ul>
						</div>

						<h1 class="product-name">{{ strtoupper($product->name) }}</h1>
						<h4 class="product-price">€ {{ $product->price }}</h4>

						<div class="product-colors">
							<h5>{{ Lang::get('product.colors') }}</h5>
							<ul>
								@foreach($product->colors as $color)
									<li>
										<div class="product-color" style="background-color: {{ $color->hexa }};"></div>
									</li>
								@endforeach
							</ul>
						</div>

						<div class="product-description">
							<h5>{{ Lang::get('product.description') }}</h5>
							{{ $product->description }}
						</div>

					</div>
				</div>

				<div class="col-md-12">
					<div class="product-specifications">
						<h5>{{ Lang::get('product.specifications') }}</h5>
						<h6>DIMENSIONS</h6>
						<ul class="product-dimensions">
							<li><strong>S</strong> - 53x16cm</li>
							<li><strong>M</strong> - 53x16cm</li>
							<li><strong>L</strong> - 53x16cm</li>
						</ul>
						<h6>TITEL</h6>
						<ul>
							<li>{{ $product->technicalText }}</li>
						</ul>
					</div>
				</div>

			</div>

			<div class="related-products clearfix">

				<h4>{{ Lang::get('product.related') }}</h4>
				@if(count($products) == 1)
					<div class"alert alert-info">Er zijn geen related producten.</div>
				@endif
				@foreach($products as $relatedProduct)

					@if($product->id != $relatedProduct->id)
						<a href="{{ url('categories', [$category->url, 'product', $relatedProduct->id]) }}">
							<div class="col-md-3">
								<div class="related-product">
									<div class="related-product-picture">
										<img src="{{ url('uploads/products', $relatedProduct->photos[0]->name) }}">
									</div>
									<div class="product-name clearfix"> {{ $relatedProduct->name }}	<div class="pull-right"> €{{ $relatedProduct->price }} </div></div>
								</div>
							</div>
						</a>
					@endif
				@endforeach

			</div>

			<div class="product-FAQ-wrapper clearfix">
				<h4>{{ Lang::get('product.faq') }}</h4>
				@if(count($product->Faqs) == 0)
					<div class="alert alert-info">Er zijn geen FAQs voor dit product.</div>
				@endif
				<div class="product-FAQs">
					@foreach($product->Faqs as $faq)
						<div class="product-FAQ">
							<div class="product-question">
								<h5 class="FAQ-slide-toggle"><strong>{{ $faq->question }}</strong></h5>
							</div>
							<div class="product-answer">
								{{ $faq->answer }}
							</div>
						</div>
					@endforeach
				</div>
				<div class="pull-right">
					<a href="{{ url('FAQ') }}">{{ Lang::get('product.more') }}</a>
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