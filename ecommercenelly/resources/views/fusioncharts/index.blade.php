@extends('layoutsSeller')

@section('content')

   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.3/js/bootstrap-select.min.js" charset="utf-8"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js" charset="utf-8"></script>
        <script>
        // var url = "{{url('products/chart')}}";
        var methods = ["GET", "POST"];
                var baseUrl = "http://127.0.0.1:8000/";
                //CREATE THE FORM 
                // Dynamic function for calling webservices
                function createObject(readyStateFunction,requestMethod,requestUrl, sendData = null){
                    
                    var obj = new XMLHttpRequest;
                
                    obj.onreadystatechange = function(){
                        if((this.readyState ==4) && (this.status ==200)){
                            readyStateFunction(this.responseText);
                        }
                        
                    };
                    obj.open(requestMethod, requestUrl, true);
                    if (requestMethod == 'POST'){
                        
                        obj.setRequestHeader("Content-type", "application/x-www-form-urlencoded" );
                        obj.setRequestHeader("X-CSRF-Token", document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
                        obj.send(sendData);
                    }
                    else 
                    {
                        obj.send();
                    }
                    }
                    
                    function getProducts(){
                        createObject(productsgrapgh, methods[0], baseUrl + "products/chart");
                    }
                    function productsgrapgh(jsonResponse){alert('jsonResponse');
                        var responseObj = JSON.parse(jsonResponse);
                    
        var Months = new Array();
        var Products = new Array();
        var Prices = new Array();
        $(document).ready(function(){
          $.get(url, function(response){
            response.forEach(function(data){alert("Products");
                Months.push(data.months);
                Products.push(data.product_name);
                Prices.push(data.prices);
            });
            var ctx = document.getElementById("canvas").getContext('2d');
                var myChart = new Chart(ctx, {
                  type: 'bar',
                  data: {
                      labels:Months,
                      datasets: [{
                          label: 'Product Price',
                          data: Prices,
                          borderWidth: 1
                      }]
                  },
                  options: {
                      scales: {
                          yAxes: [{
                              ticks: {
                                  beginAtZero:true
                              }
                          }]
                      }
                  }
              });
          });
        });
                    }
        </script>
@endsection