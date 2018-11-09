<head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Hospital Mamnagement</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token()}}">
        <link rel="stylesheet" type="text/css" href="/css/bootstrap/css/bootstrap.min.css" />
        
    </head>
    <body onload = "getBills()">
        @include('hospital.nav')
        <div id = "container">
<div id = "inputBillsForm">
                    <form class = "form-horizontal" action = "#" method = "POST" id = "inputBill" name = "billsForm">
                        {{csrf_field()}}
                        <div class = "inputItems">
                            <input type ="hidden" value="{{$visit_id}}" name = "visit_id"/>
                            <input type ="hidden" name = "service_id"/>
                            <label>Service Name</label>
                            <select class="form-control" name="serviceName1" id="service1" >
                            @if (empty($servicename)) 
                            Whoops! Something went terribly wrong
        
                            @else
                                @foreach($servicename as $a)
                                    <option name = "selectedId" value="{{ $a->service_id }}" data-amount = "{{ $a->amount }}">
                                        {{ $a->service_name }} </option>
                                        @endforeach
                                        @endif
                            </select></div>
                            <input type ="hidden"  name = "serviceAmount2" id = "serviceAmount2"/>
                        <div class = "inputItems">
                            <label>Quantity</label>
                            <input class = "form-control" type = "number" name = "quantity" required/><br>
                        </div>
                        <div class = "inputItems">
                        <input  class = "form-control" type = "hidden" name = "amount" /><br>
                            <input type ="hidden"  name = "billTime"/>
                            <!-- <label><button type = "button" name = "buttonBill" onclick = "calculateAmount()">Calculate Amount</button></label> -->
                        </div>
                        <div class = "inputItems">
                            <button class = " btn btn-primary"  type = "submit" name = "saveBill">Submit</button><br>
                            <button class = " btn btn-warning" type = "button" name = "viewVisits"><a href = "/getAllVisits">Back </a></button>
                            
                        </div>
                    </div>

                <div id ="allBills">
                </div>


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

                    function getBills(){
                        createObject(showBills, methods[0], baseUrl + "getBills");
                       // document.getElementById("inputBillsForm").style.display = "block";
                       document.getElementById("allBills").style.display = "block";
                       //alert('okay');
                    }

                    function showBills(jsonResponse){
                        var responseObj = JSON.parse(jsonResponse);
                        var count = 0,tData;
                        var tableData = "<button class ='btn btn-primary' type = 'button' onclick = 'saveBills()'>Add Visits</button><table class = 'table table-bordered table-striped table-condensed'><tr><th>#</th><th>Name</th><th>Visit Date</th><th>Visit Type</th><th>Exit Time</th><th>Visit Status</th><th colspan ='3'> Action</th></tr>";
                        for (tData in responseObj)
                        {
                            count++;
                            tableData +="<tr><td>" + count + "</td>";
                            tableData +="<td>" + responseObj[tData].service_name + "</td>"; 
                            tableData +="<td>" + responseObj[tData].quantity+ "</td>";
                            tableData +="<td>" + responseObj[tData].amount + "</td>";
                            tableData +="<td>" + responseObj[tData].bill_time+ "</td>";

                           // tableData +="<td><a href = '/servicename/"+responseObj[tData].visit_id+"\' class ='btn btn-info bt-sm'>Set Bill </a></td>" ;
                            tableData +="<td><a href = '#' class ='btn btn-info bt-sm' onclick = 'showSingleVisits("+responseObj[tData].visit_id+")'>View </a></td>" ;
                            tableData +="<td><a href = '#' class ='btn btn-success btn-sm' onclick ='editVisits("+responseObj[tData].visit_id+",\""+responseObj[tData].full_name+"\",\""+responseObj[tData].visit_date+"\",\"" +responseObj[tData].visit_type+"\",\"" +responseObj[tData].exit_time+"\",\"" +responseObj[tData].visit_status +"\")'>Edit </a></td>" ;
                            tableData +="<td><a href = '#' class ='btn btn-danger bt-sm' onclick = 'deleteVisits("+responseObj[tData].visit_id+",\"" +responseObj[tData].visit_date+"\")'>Delete </a></td></tr>" ;
                        }
                        tableData += "</table>";
                        document.getElementById("allVisits").innerHTML = tableData;

                    }
                    // function saveBills(){
                        
                    //     createObject(billForm, methods[0], baseUrl + "servicename");
                    // }
  
                    // function billForm(visit_id, responseTxt){
                    //     var responseObj = JSON.parse(responseTxt);
                    //     document.getElementById("inputBillsForm").style.display = "block";
                    //     document.getElementById("allVisits").style.display = "none";
                    //     document.getElementById("updateVisitsForm").style.display = "none";
                    //     document.forms["billsForm"]["serviceName1"].value = visit_id;
                    
                    // }

                    function submitBill(e){
                        //Get values submitted
                        e.preventDefault();
                        
                        var visit_id = document.forms["billsForm"]["visitId"].value;
                        var serviceName1 = document.forms["billsForm"]["serviceName1"].value;
                        var quantity = document.forms["billsForm"]["quantity"].value;
                        var amount = document.forms["billsForm"]["amount"].value;
                        //alert(lessonName + lessonDescription);

                        //object to save lessons from form to db 
                        var sendData = "visit_visit_id="+visit_id+"&service_name="+serviceName1+"&quantity="+quantity+"&amount="+amount;
                        createObject(displayVisits, methods[1], baseUrl + "saveBills", sendData);
                        
                    
                        //insert or send to server
                        //alert("working");
                        return false;
                    }

                    function displayVisits(){
                        alert('Patient\'s details successfully recorded', createObject(showVisits, methods[0], baseUrl + "getAllVisits"));
                    }
      
                    function showSingleVisits (visit_id){
                        createObject(displaySingleVisits, methods[0], baseUrl + "getSingleVisit/"+visit_id);
                        return false;
                    }

                    function displaySingleVisits (responseTxt){
                        var responseObj = JSON.parse(responseTxt);
                            var tableData = "<table class = 'table table-bordered table-striped table-condensed'><tr><th>Name</th><th>Visit Date</th><th>Visit Type</th><th>Exit Time</th><<th>Visit Status</th></tr>";
                            for(tdata in responseObj ){
                            //tableData +="<td>" + responseObj.visitId + "</td>";
                            tableData +="<td>" + responseObj[tdata].full_name + "</td>";    
                            tableData +="<td>" + responseObj[tdata].visit_date + "</td>";
                            tableData +="<td>" + responseObj[tdata].visit_type + "</td>";
                            tableData +="<td>" + responseObj[tdata].exit_time + "</td>";
                            tableData +="<td>" + responseObj[tdata].visit_status + "</td>";
                            tableData +="<button type='button' class= 'btn btn-warning' onclick = 'getVisits()'>Back</button>";
                    }
                            tableData +="</table>";
                            document.getElementById("allVisits").innerHTML = tableData;
                    }

                    function editVisits(visit_id){
                    createObject(editOneVisits, methods[0], baseUrl + "getSingleVisit/"+visit_id);

                    }

                    function editOneVisits (responseTxt, full_name, visit_id, visit_date, visit_type, exit_time, visit_status){
                        
                        document.getElementById("updateVisitsForm").style.display = "block";
                        document.getElementById("allVisits").style.display = "none";
                        var responseObj = JSON.parse(responseTxt);
                            //var tableData = "<table class = 'table table-bordered table-striped table-condensed'><tr><th>Name</th><th>Visit Date</th><th>Visit Type</th><th>Exit Time</th><<th>Visit Status</th></tr>";
                            for(tdata in responseObj ){
                            //tableData +="<td>" + responseObj.visitId + "</td>";
                            document.forms["visitsForm1"]["fullName"].value = responseObj[tdata].full_name;    
                            document.forms["visitsForm1"]["visitsId"].value = responseObj[tdata].visit_id;
                            document.forms["visitsForm1"]["visitDate1"].value = responseObj[tdata].visit_date;
                            document.forms["visitsForm1"]["visitType1"].value = responseObj[tdata].visit_type;
                            document.forms["visitsForm1"]["exitTime1"].value = responseObj[tdata].exit_time;
                            document.forms["visitsForm1"]["visitStatus1"].value =responseObj[tdata].visit_status; 
                           // tableData +="<button type='button' class= 'btn btn-warning' onclick = 'getVisits()'>Back</button>";
                            }
                    }
                    //         tableData +="</table>";
                    //         document.getElementById("allVisits").innerHTML = tableData;
                    
                        
                    //     document.forms["visitsForm1"]["fullName"].value = full_name;
                    //     document.forms["visitsForm1"]["visitsId"].value = visit_id;
                    //     document.forms["visitsForm1"]["visitDate1"].value = visit_date;
                    //     document.forms["visitsForm1"]["visitType1"].value = visit_type;
                    //     document.forms["visitsForm1"]["exitTime1"].value = exit_time;
                    //     document.forms["visitsForm1"]["visitStatus1"].value = visit_status;

               

                    function submitUpdate(e){
                        //Get values submitted
                        e.preventDefault();
                        //var full_name = document.forms["visitsForm1"]["fullName"].value;
                        var visitsId = document.forms["visitsForm1"]["visitsId"].value;
                        var visitDate = document.forms["visitsForm1"]["visitDate1"].value;
                        var visitType = document.forms["visitsForm1"]["visitType1"].value;
                        var exitTime = document.forms["visitsForm1"]["exitTime1"].value;
                        var visitStatus = document.forms["visitsForm1"]["visitStatus1"].value;
                        //alert(lessonName + lessonDescription);
                        
                        //object to save lessons from form to db 
                        var sendData = "visit_id="+visitsId+"&visit_date="+visitDate+"&visit_type="+visitType+"&exit_time="+exitTime+"&visit_status="+visitStatus;
                        createObject(getVisits, methods[1], baseUrl + "updateVisits", sendData);
                        
                        //insert or send to server
                        //alert("working");
                        return false;
                    }
                    
                    function deleteVisits(visit_id, visit_date, visit_type, exit_time, visit_status){
                        
                        var r = confirm("Do you want to delete?");
                        if (r == true) {
                            createObject(getVisits, methods[0], baseUrl + "deleteVisits/"+visit_id);
                            alert("You have successfully deleted " + visit_type);
                        } else {
                            
                            getVisits();
                        } 

                    }

                   // document.getElementById("inputVisits").addEventListener("submit", submitBill);
                   // document.getElementById("inputVisits1").addEventListener("submit", submitUpdate);

                </script>
        </div>
    </body>
</html>
