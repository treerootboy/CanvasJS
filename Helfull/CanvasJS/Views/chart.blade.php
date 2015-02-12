<script type="text/javascript">
  window.onload = function () {
    var {{$chart->id}} = new CanvasJS.Chart("{{$chart->id}}",{{$chart}});
</script>

<div id="{{$chart->id}}" style="height: 300px; width: 100%;"></div>