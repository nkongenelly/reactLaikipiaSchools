<head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Hospital Mamnagement</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token()}}">
        <link rel="stylesheet" type="text/css" href="/css/bootstrap/css/bootstrap.min.css" />
        
    </head>
    <body onload = "getVisits()">
        @include('hospital.nav')
        <div class = "container">
                <div id = "inputBillsForm">
                    <form class = "form-horizontal" action = "#" method = "POST" id = "inputBill" name = "billsForm">
                        {{csrf_field()}}
                        <div class = "inputItems">
                            <input type ="hidden" name = "visit_id"/>
                            <input type ="hidden" name = "visitservice_id"/>
                            <label>Service Name</label>
                            <select class="form-control" name="serviceName1" id = "selectService">
                        
                                    <option name = "selectedId" >
                                       
                                    </option>
                            </select>
                            </div>
                        <div class = "inputItems">
                            <label>Quantity</label>
                            <input class = "form-control" type = "number" name = "quantity" required/><br>
                        </div>
                        <div class = "inputItems">
                            <!-- <label><button type = "button" onclick = "calculateAmount">Calculate Amount<button></label> -->
                            <label>Amount</label>
                           <input  class = "form-control" type = "number" name = "amount" /><br>
                        </div>
                        <div class = "inputItems">
                            <input   type = "datetime-local" name = "billTime"/>
                        </div>
                                           
                        <div class = "inputItems">
                            <button class = " btn btn-primary"  type = "submit" name = "saveBill">Submit</button><br>
                            <button class = " btn btn-warning" type = "button" name = "viewVisits"><a href = "/getAllVisits">Back </a></button>
                            
                        </div>
                    </form>
                </div>

                <div id ="updateVisitsForm">
                    <form class = "form-horizontal" action = "#" method = "POST" id = "inputVisits1" name = "visitsForm1">
                        {{csrf_field()}}
                        <div class = "inputItems">
                            <input type ="hidden" name = "visit_id"/>
                            <input type ="hidden" name = "patientsId"/>
                            <label>Name</label>
                            <input class = "form-control" type = "text" name = "fullName" disabled/><br>
                        </div>
                        <div class = "inputItems">
                            <label>Visit Date and time</label>
                            <input class = "form-control" type = "datetime-local" name = "visitDate1" required/><br>
                        </div>
                        <div class = "inputItems">
                            <label>Visit Type</label>
                            <select name = "visitType1">
                                <option value = "1" class = "form-control" type = "text" name = "visitType1">Cash</option>
                                <option value = "2">Insurance</option>
                            </select>
                        </div>
                        <div class = "inputItems">
                            <label>Exit time</label>
                            <input class = "form-control" type = "datetime-local" name = "exitTime1" placeholder = "YYYY-MM-DD, hh-mm-ss" required/><br>
                        </div>
                        <div class = "inputItems">
                            <label>Visit Status</label>
                            <select name = "visitStatus1">
                                <option value = "1" class = "form-control" type = "text">Active</option>
                                <option value = "2">Pending</option>
                            </select>
                            
                        </div>
                        <div class = "inputItems">
                            <button class = " btn btn-primary"  type = "submit" name = "saveVisit">Submit</button><br>
                            <button class = " btn btn-warning" type = "button" name = "viewVisits" onclick ="getVisits()">Back </button>
                            
                        </div>
                    </form>
                </div>

                <div id = "allVisits"></div>



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

                    function getVisits(){
                        createObject(showVisits, methods[0], baseUrl + "getAllVisits");
                        document.getElementById("allVisits").style.display = "block";
                        document.getElementById("inputBillsForm").style.display = "none";
                        document.getElementById("updateVisitsForm").style.display = "none";
                    
                        //alert('okay');
                    }

                     function showVisits(jsonResponse){
                        var responseObj = JSON.parse(jsonResponse);
                        var count = 0,tData;
                        var tableData = "<button class ='btn btn-primary' type = 'button' onclick = 'saveBills()'>Add Visits</button><table class = 'table table-bordered table-striped table-condensed'><tr><th>#</th><th>Name</th><th>Visit Date</th><th>Visit Type</th><th>Exit Time</th><th>Visit Status</th><th colspan ='3'> Action</th></tr>";
                        for (tData in responseObj)
                        {
                            count++;
                            tableData +="<tr><td>" + count + "</td>";
                            tableData +="<td>" + responseObj[tData].full_name + "</td>"; 
                            tableData +="<td>" + responseObj[tData].visit_date+ "</td>";
                                if(responseObj[tData].visit_type == '1'){
                                    tableData +="<td>" + "Cash" + "</td>";
                                }
                                else if(responseObj[tData].visit_type == '2'){
                                    tableData +="<td>" + "Insurance" + "</td>";
                                }
                            tableData +="<td>" + responseObj[tData].exit_time+ "</td>";
                            if(responseObj[tData].visit_status == '1'){
                                    tableData +="<td>" + "Active" + "</td>";
                                }
                                else if(responseObj[tData].visit_status == '2'){
                                    tableData +="<td>" + "Pending" + "</td>";
                                }

                            tableData +="<td><a href = '#' class ='btn btn-info bt-sm' onclick = 'saveBills("+responseObj[tData].visit_id+")'>Set Bill </a></td>" ;
                            //tableData +="<td><a href = '/servicename/"+responseObj[tData].visit_id+"\' class ='btn btn-info bt-sm'>Create Bill </a></td>" ;
                            tableData +="<td><a href = '#' class ='btn btn-info bt-sm' onclick = 'showSingleVisits("+responseObj[tData].visit_id+")'>View </a></td>" ;
                            tableData +="<td><a href = '#' class ='btn btn-success btn-sm' onclick ='editVisits("+responseObj[tData].visit_id+",\""+responseObj[tData].full_name+"\",\""+responseObj[tData].visit_date+"\",\"" +responseObj[tData].visit_type+"\",\"" +responseObj[tData].exit_time+"\",\"" +responseObj[tData].visit_status +"\")'>Edit </a></td>" ;
                            tableData +="<td><a href = '#' class ='btn btn-danger bt-sm' onclick = 'deleteVisits("+responseObj[tData].visit_id+",\"" +responseObj[tData].visit_date+"\")'>Delete </a></td></tr>" ;
                        }
                        tableData += "</table>";
                        document.getElementById("allVisits").innerHTML = tableData;

                    }

                  
                    function saveBills(visit_id){
                        
                        createObject(getOptions, methods[0], baseUrl + "getAllServices");
                        document.getElementById("inputBillsForm").style.display = "block";
                        document.getElementById("allVisits").style.display = "none";
                        document.getElementById("updateVisitsForm").style.display = "none";
                        document.forms["billsForm"]["visit_id"].value = visit_id;

                    }

                    function getOptions(responseTxt){
                        var responseObj = JSON.parse(responseTxt);
                        var tData;
                        for(tData in responseObj){
                            var option = document.createElement('option');
                            option.value = responseObj[tData].service_id;
                            option.textContent = responseObj[tData].service_name;
                            document.getElementById("selectService").appendChild(option);
                            //document.forms["billsForm"]["amount"].value = 
                        }

                    }

                    function calculateAmount(e){
                        //Get values submitted
                        e.preventDefault();
                        
                        var visit_id = document.forms["billsForm"]["visit_id"].value;
                        var serviceName1= document.forms["billsForm"]["serviceName1"].value;
                        var quantity = document.forms["billsForm"]["quantity"].value;
                        var amount = document.forms["billsForm"]["amount"].value;
                        var billTime = document.forms["billsForm"]["billTime"].value;
                        //alert(lessonName + lessonDescription);
                            console.log(sendData);
                        //object to save lessons from form to db 
                        var sendData = "visit_visit_id="+visit_id+"&service_service_id="+serviceName1+"&quantity="+quantity+"&amount="+amount+"&bill_time="+billTime;
                        
                        createObject(displayAmount, methods[1], baseUrl + "saveBills1"+sendData);
                    }

                    function displayAmount(responseTxt, visit_visit_id, service_service_id, quantity, amount){
                        
                        document.getElementById("updateVisitsForm").style.display = "block";
                        document.getElementById("allVisits").style.display = "none";
                        var responseObj = JSON.parse(responseTxt);
                            //var tableData = "<table class = 'table table-bordered table-striped table-condensed'><tr><th>Name</th><th>Visit Date</th><th>Visit Type</th><th>Exit Time</th><<th>Visit Status</th></tr>";
                            for(tdata in responseObj ){
                            //tableData +="<td>" + responseObj.visitId + "</td>";
                            document.forms["billsForm"]["visit_id"].value = responseObj[tdata].visit_visit_id;    
                            document.forms["billsForm"]["serviceName1"].value = responseObj[tdata].service_service_id;
                            document.forms["billsForm"]["quantity"].value = responseObj[tdata].quantity;
                            document.forms["billsForm"]["amount"].value = responseObj[tdata].amount;
                           // document.forms["visitsForm1"]["exitTime1"].value = responseObj[tdata].exit_time; 
                           // tableData +="<button type='button' class= 'btn btn-warning' onclick = 'getVisits()'>Back</button>";
                            }
                    }

                    function submitBill(e){
                        //Get values submitted
                        e.preventDefault();
                        
                        var visit_id = document.forms["billsForm"]["visit_id"].value;
                        var serviceName1= document.forms["billsForm"]["serviceName1"].value;
                        var quantity = document.forms["billsForm"]["quantity"].value;
                        var amount = document.forms["billsForm"]["amount"].value;
                        var billTime = document.forms["billsForm"]["billTime"].value;
                        //alert(lessonName + lessonDescription);
                            console.log(sendData);
                        //object to save lessons from form to db 
                        var sendData = "visit_visit_id="+visit_id+"&service_service_id="+serviceName1+"&quantity="+quantity+"&amount="+amount+"&bill_time="+billTime;
                        createObject(getVisits, methods[1], baseUrl + "saveBills", sendData);
                        
                    
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

                    document.getElementById("inputBill").addEventListener("submit", submitBill);
                    document.getElementById("inputVisits1").addEventListener("submit", submitUpdate);

                </script>
        </div>
    </body>
</html>
