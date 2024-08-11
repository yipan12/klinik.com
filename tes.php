<!DOCTYPE html>
<html lang="en">
  <head>
<script>
$(document).ready(function() {
$("input[type=checkbox]").change(function(){
  recalculate();
});
function recalculate(){
    var sum = 0;
    $("input[type=checkbox]:checked").each(function(){
      sum += parseInt($(this).attr("rel"));
    });
  //  alert(sum);
$("#output").html(sum);
}
});

</script>
  
  </head>
 
 <body>
 <div id="school">
    <p><input type="checkbox" rel="15">Book</p>
    <p><input type="checkbox" rel="15">Bag</p>
    <p><input type="checkbox" rel="15">Notebook</p>
</div>

<span id="output">p</span>
 
 
 </body>
 
 </html>