<script> 
   var chirs = {!! json_encode($tables_chairs) !!};
   var tables_count = parseInt("{{ $place->tables_count }}")

   for (let index = 1; index <= tables_count; index++) {
      var num_chairs = parseInt(chirs[index]);
      var div = 360 / num_chairs;
      if(num_chairs >= 20) var radius = num_chairs * 15;
      else var radius = num_chairs * 30;
      
      var container_table = document.getElementsByClassName('container_table_' + index)[0];
      var table = document.getElementsByClassName('table_ch_' + index)[0];
      table.style.width = `${radius}px`;
      table.style.height = `${radius}px`;
      container_table.style.height = `${radius * 3}px`;
      
      var offsetToParentCenter = parseInt(table.offsetWidth / 2);
      var totalOffset = offsetToParentCenter - 40;
      
      $('.table_ch_' + index).find('.chair').each(function(index, obj2) {
         var y = Math.sin((div * index) * (Math.PI / 180)) * radius;
         var x = Math.cos((div * index) * (Math.PI / 180)) * radius;
         obj2.style.top = (y + totalOffset).toString() + "px";
         obj2.style.left = (x + totalOffset).toString() + "px";
      });
      $('.table_ch_' + index).append(`<span>${index}</span>`);
   }
</script>