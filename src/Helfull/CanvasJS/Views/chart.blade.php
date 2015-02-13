@if(Config::get('app.debug'))
	{!! dump($chart) !!}
@endif

<div id="{!!$chart->getID()!!}" {!! HTML::attributes($chart->getAttributes()) !!}></div>
<script type="text/javascript">
	window.onload = function () {
		var {!!$chart->getID()!!} = new CanvasJS.Chart("{!!$chart->getID()!!}",{!!$chart->getChart()!!});
		{!!$chart->getID()!!}.render();
	}
</script>