@extends('layouts.app')

@section('content')

	<div class="dashboard-hotproducts-wrapper">

		<div class="dashboard-hotproducts col-md-10 col-md-offset-1">

			<h1>Hot products</h1>

			<div class="hotproducts-table">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>Place</th>
							<th>Naam</th>
							<th>Prijs</th>
							<th>Descriptie</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						@foreach($hotItems as $hotItem)
							<tr>
								<td>{{ $hotItem->place }}</td>
								<td>{{ $hotItem->product->name }}</td>
								<td>€{{ $hotItem->product->price }}</td>
								<td>{{ $hotItem->product->description }}</td>
								<td>
									<ul>
										<li>
											<a href="{{ url('admindashboard/hotproduct/edit', $hotItem->Product->id) }}" class="btn btn-default" aria-label="Left Align">
											  <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
											</a>
										</li>
										<li>
											<form method="POST" action="{{ url('admindashboard/hotproduct/delete', $hotItem->id) }}">
												{{ csrf_field() }}
												<input type="hidden" name="_method" value="DELETE" />
												<button type="submit" class="btn btn-danger" aria-label="Left Align">
												  <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
												</button>
											</form>
										</li>
									</ul>
								</td>
							</tr>
						@endforeach
					</tbody>

				</table>
			</div>

		</div>

	</div>

@endsection