<head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Hospital Mamnagement</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token()}}">
        <link rel="stylesheet" type="text/css" href="/css/bootstrap/css/bootstrap.min.css" />
        
    </head>
    <body onload = "getTimeReport()">
        @include('hospital.nav')
        <div class = "container">
            <div id = "allTimeReport"></div>


        <script>
           var methods = ["GET", "POST"];
                    var baseUrl = "http://localhost:8000/";

                    //CREATE THE FORM 
                    // Dynamic function for calling webservices
                    function createObject(readyStateFunction = null,requestMethod,requestUrl, sendData = null){
                        
                        var obj = new XMLHttpRequest;
                    
                        obj.onreadystatechange = function(){
                            if((this.readyState ==4) && (this.status ==200)){
                                readyStateFunction(this.responseText);
                            }
                            
                        };
                        obj.open(requestMethod , requestUrl, true);
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

            function getTimeReport(){
                createObject(timeReport, methods[0], baseUrl + "getTimeReports");
            }

            function timeReport(jsonResponse){
                var responseObj = JSON.parse(jsonResponse);
                console.log(responseObj);
                var count = 0,tData;
                var tableData = "<table class = 'table table-bordered table-striped table-condensed'><tr><th>#</th><th>Cash</th><th>Insurance</th><th>TOTAL</th>tr>";
                for (tData in responseObj)
                {
                    count++;
                    tableData +="<tr><td>" + count + "</td>";
                    tableData +="<td>" + responseObj[tData].cash + "</td></tr>"; 
                    tableData +="<tr><td>" + responseObj[tData].insurance+ "</td></tr>";
                    tableData +="<td>" "</td>";
                }
                tableData +="<td>" + responseObj[tData].cashTotal+ "</td>";
                tableData += "</table>";

                 var tableData = "<table class = 'table table-bordered table-striped table-condensed'><tr><th>TOTAL</th><th></th><th></th><th></th></tr>";
                for (tData in responseObj)
                {
                    count++;
                    tableData +="<tr><td>" + count + "</td>";
                    tableData +="<td>" + responseObj[tData].cashTotal + "</td>"; 
                    tableData +="<td>" + responseObj[tData].insuranceTotal+ "</td>";
                    tableData +="<td>" + responseObj[tData].TOTAL+ "</td>";
  }
                tableData +="<td>" + responseObj[tData].cashTotal+ "</td>";
                tableData += "</table>";
                document.getElementById("allTimeReport").innerHTML = tableData;

            }


        </script>
    </body>
</html>