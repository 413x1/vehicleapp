@extends('layouts.app')
@section('content')

<div class="col-12">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Vehicle Order Chart</h5>
			<canvas id="myChart"></canvas>
        </div>
    </div>
</div>

@stop

@section('jscode')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
	<script>
		const jsonData = <?php echo $data_json ?>;
		const stringJson = JSON.stringify(jsonData);
		const arrJson = JSON.parse(stringJson);

		const name_list = [];
		const count_list = [];

		arrJson.forEach(item => {
			name_list.push(item.name);
			count_list.push(item.orders_count);
		});

		new Chart(
			document.getElementById('myChart'),
			{
			type: 'bar',
			options: {
				animation: false,
				plugins: {
					legend: {
						display: false
					},
					tooltip: {
						enabled: false
					}
				}
			},
			data: {
				labels: name_list,
				datasets: [
					{
						label: 'Acquisitions by year',
						data: count_list,
					}
				]
			}
			}
		);
	</script>
@stop