<div id="{!!$chart->getID()!!}"></div>
<script type="text/javascript">
	window.onload = function () {
		var {!!$chart->getID()!!} = new CanvasJS.Chart("{!!$chart->getID()!!}",{!!$chart->getChart()!!});
		{!!$chart->getID()!!}.render();
	}
</script>
