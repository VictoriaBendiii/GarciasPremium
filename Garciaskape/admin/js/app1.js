$(document).ready(function(){
  $.ajax({
    url: "http://localhost/Garciaskape6/admin/monitoring/query1.php",
    method: "GET",
    success: function(data) {
      console.log(data);
      var productname = [];
      var quantity = [];

      for(var i in data) {
        productname.push(" " + data[i].productname);
        quantity.push(data[i].quantity);
      }

      var chartdata = {

        labels: productname,
        datasets : [
          {
            label: 'Kgs',
            backgroundColor: 'rgba(170, 100, 40, 0.75)',
            borderColor: 'rgba(200, 200, 200, 0.75)',
            hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
            hoverBorderColor: 'rgba(200, 200, 200, 1)',
            data: quantity
          }
        ]
      };

      var ctx = $("#mycanvas");

      var barGraph = new Chart(ctx, {
        type: 'bar',
        data: chartdata
      });
    },
    error: function(data) {
      console.log(data);
    }
  });
});