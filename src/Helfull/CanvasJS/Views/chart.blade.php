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

		var option = {!!$chart->getChart()!!}
				, id = "{!!$chart->getID()!!}";

		script.onload = function(){
			option.legend = {
				cursor:"pointer",
				itemclick : function(e) {
					if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible ){
						e.dataSeries.visible = false;
					} 
					else {
						e.dataSeries.visible = true;
					}
					{!!$chart->getID()!!}.render();
					resize();
				}
			};
			var {!!$chart->getID()!!} = new CanvasJS.Chart(id, option);
			{!!$chart->getID()!!}.render();
			resize();
		}
		var resize = function(){
			var container = document.querySelector('#'+id);
			var canvas = document.querySelector('#'+id+' canvas');
			container.style.height = canvas.height+'px';
		}
		document.head.appendChild(script);
	});
</script>
