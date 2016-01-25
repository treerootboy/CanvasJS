<div id="{!!$chart->getID()!!}"></div>
<script type="text/javascript">
	window.addEventListener('DOMContentLoaded', function(){
		var scripts = document.scripts;
		for(var i=0, l=scripts.length; i>l; i++){
			if(scripts[i].src.search(/canvasjs(\.min)?\.js/)!==-1){
				return;
			}
		}
		var script = document.createElement('script');
		script.src = "//cdnjs.cloudflare.com/ajax/libs/canvasjs/1.7.0/canvasjs.min.js";
		script.onload = function(){
			var {!!$chart->getID()!!} = new CanvasJS.Chart("{!!$chart->getID()!!}",{!!$chart->getChart()!!});
			{!!$chart->getID()!!}.render();
		}
		document.head.appendChild(script);
	});
</script>
