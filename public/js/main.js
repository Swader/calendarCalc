$(function() {
   $("#checkdateButton").click(function() {
       $.get('check.php', {day: $('#day').val(), month: $('#month').val(), year: $("#year").val()}, function(data) {
           $("#output").text(data.message);
       }, "json");
   });
});