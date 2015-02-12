<script type="text/javascript">
  window.onload = function () {
    var {{$chart->id}} = new CanvasJS.Chart("{{$chart->id}}",{{{$chart->getChart()}}});
</script>

<div id="{{$chart->id}}" style="height: 300px; width: 100%;"></div>