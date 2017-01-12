@extends('layouts.app')

@section('content')

	<div class="dashboard-hotproducts-wrapper">

		<div class="dashboard-hotproducts col-md-10 col-md-offset-1">

			<h1>Nieuw product</h1> 

			<div class="new-product">

				<form method="POST" action="{{ url('admindashboard/hotproduct/edit', $product->id) }}">
					{{ csrf_field() }}
					<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
						<label>Plaats</label>
						<select name="place" class="form-control">
							<option @if($product->id == $hotItems[0]->product_id) selected @endif value="1">1: @if($hotItems[0] != null) {{ $hotItems[0]->Product->name }} @else geen hot item @endif</option>
							<option @if($product->id == $hotItems[1]->product_id) selected @endif value="2">2: @if($hotItems[1] != null) {{ $hotItems[1]->Product->name }} @else geen hot item @endif</option>
							<option @if($product->id == $hotItems[2]->product_id) selected @endif value="3">3: @if($hotItems[2] != null) {{ $hotItems[2]->Product->name }} @else geen hot item @endif</option>
							<option @if($product->id == $hotItems[3]->product_id) selected @endif value="4">4: @if($hotItems[3] != null) {{ $hotItems[3]->Product->name }} @else geen hot item @endif</option>
						</select>
						@if ($errors->has('name'))
							<span class="help-block"><strong>{{ $errors->first('name') }}</strong></span>
						@endif
					</div>

					<button type="submit" class="btn btn-primary">Verstuur</button>

				</form>

			</div>

		</div>

	</div>

@endsection