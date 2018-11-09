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
        <div class = "container">
            <div id = "updateBillsForm">
                <form class = "form-horizontal" action = "#" method = "POST" id = "inputBill" name = "billsForm">
                    {{csrf_field()}}
                    <div class = "inputItems">
                    <input type ="hidden" name = "visitserviceId"/>
                        <input type ="hidden" name = "visit_id"/>
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
        <div id = "allBills">
    </div>

                <div id = "allBills"></div>

                

                <script>
                    var methods = ["GET", "POST"];
                    var baseUrl = "http://localhost:8000/";

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

                    function getBills(){
                        createObject(displayBills, methods[0], baseUrl + "getAllBills");
                        document.getElementById("updateBillsForm").style.display = "none";
                        document.getElementById("allBills").style.display = "block";
                        //alert('okay');
                    }

                    

                    // function saveBill(e){
                    //     //Get values submitted
                    //     e.preventDefault();
                    //     var visitId = document.forms["billsForm"]["visit_id"].value;
                    //     var serviceId = document.forms["billsForm"]["serviceName1"].value;
                    //     var quantity = document.forms["billsForm"]["quantity"].value;
                    //     //var amount1 = document.forms["billsForm"]["serviceName1"]["selectAmount"].value;
                        
                    //     //var amount = document.forms["billsForm"]["amount"].value;
                    //     //var billTime = document.forms["billsForm"]["billTime"].value;
                    //     //alert(lessonName + lessonDescription);
                    //     console.log(amount);
                    //     //object to save lessons  form to db 
                    //     var sendData = "visit_visit_id="+visitId+"&service_service_id="+serviceId+
                    //     "&quantity="+quantity;
                    //     createObject(displayBills1, methods[1], baseUrl + "saveBills1", sendData);
                        
                    
                    //     //insert or send to server
                    //     //alert("working");
                    //     return false;
                    // }

                    // function displayBills1(){
                    //     document.getElementById("inputBillsForm").style.display = "none";
                    //     document.getElementById("allBills").style.display = "block";
                    //     createObject(showBills, methods[0], baseUrl + "getBills", sendData);
                    // }

                    function displayBills(jsonResponse){
                        var responseObj = JSON.parse(jsonResponse);
                        var count = 0,tData;
                        var tableData = "<table class = 'table table-bordered table-striped table-condensed'><tr><th>#</th><th>VisitService ID<th>Name</th><th>Service Name</th><th>Quantity</th><th>Price</th><th>Total</th><th colspan ='3'> Action</th></tr>";
                        for (tData in responseObj)
                        {
                            count++;
                            tableData +="<tr><td>" + count + "</td>";
                            tableData +="<td type = 'hidden'>" + responseObj[tData].visitservice_id + "</td>";
                            tableData +="<td>" + responseObj[tData].full_name + "</td>"; 
                            tableData +="<td>" + responseObj[tData].service_name + "</td>"; 
                            tableData +="<td>" + responseObj[tData].quantity+ "</td>";
                            tableData +="<td>" + responseObj[tData].amount + "</td>";
                            tableData +="<td>" + responseObj[tData].TOTAL+ "</td>";
                            //console.log(responseObj[tData].visitservice_id);
                            //tableData +="<td><a href = '/servicename/"+responseObj[tData].visit_id+"\' class ='btn btn-info bt-sm'>Set Bill </a></td>" ;
                            tableData +="<td><a href = '#' class ='btn btn-info bt-sm' onclick = 'showSingleBill("+responseObj[tData].visitservice_id+")'>View </a></td>" ;
                            tableData +="<td><a href = '#' class ='btn btn-success btn-sm' onclick ='editBill("+responseObj[tData].visitservice_id+",\""+responseObj[tData].service_name+"\",\"" +responseObj[tData].quantity+"\",\"" +responseObj[tData].amount+"\",\"" +responseObj[tData].billTIme +"\")'>Edit </a></td>" ;
                            tableData +="<td><a href = '#' class ='btn btn-danger bt-sm' onclick = 'deleteVisits("+responseObj[tData].visit_id+",\"" +responseObj[tData].visit_date+"\")'>Delete </a></td></tr>" ;
                        }
                        tableData += "</table>";
                        document.getElementById("allBills").innerHTML = tableData;

                    }
                    

                    function showSingleBill(visitservice_id){
                        createObject(displaySingleBill, methods[0], baseUrl + "getSingleBill/"+visitservice_id);
                        return false;
                    }

                    function displaySingleBill(responseTxt){
                        var responseObj = JSON.parse(responseTxt);
                        var tData,tableData = "";
                        
                        for(tData in responseObj ){
                            //tableData +="<td>" + responseObj.visitId + "</td>";
                            tableData +="<h1>" + responseObj[tData].full_name + "</h1>";    
                            tableData +="<h1>" + responseObj[tData].service_name + "</h1>";
                            tableData +="<p>" + responseObj[tData].quantity + "</p>";
                            tableData +="<p>" + responseObj[tData].amount + "</h1>";
                            tableData +="<h1>" + responseObj[tData].TOTAL + "</h1>";
                            tableData +="<button type='button' class= 'btn btn-warning' onclick = 'getBills()'>Back</button>";
                        }
                            document.getElementById("allBills").innerHTML = tableData;
          
                    }
      
                    function editBill(visitservice_id)
                    {
                        createObject(editBill1, methods[0], baseUrl + "getSingleBill/"+visitservice_id);

                    }

                    function editBill1(responseTxt, visitservice_id, service_name, quantity, amount, billTime)
                    {
                        document.getElementById("updateBillsForm").style.display = "block";
                        document.getElementById("inputBill").style.display = "none";
                        var responseObj = JSON.parse(responseTxt);
                        console.log(responseObj);
                            //var tableData = "<table class = 'table table-bordered table-striped table-condensed'><tr><th>Name</th><th>Visit Date</th><th>Visit Type</th><th>Exit Time</th><<th>Visit Status</th></tr>";
                            for(tdata in responseObj ){
                                var option = document.createElement('option');
                            option.value = responseObj[tdata].service_id;
                            option.textContent = responseObj[tdata].service_name;
                            document.getElementById("selectService").appendChild(option);

                            document.forms["billsForm"]["visitserviceId"].value = responseObj[tdata].visitservice_id;
                            document.forms["billsForm"]["serviceName1"].value = responseObj[tdata].service_name;
                            document.forms["billsForm"]["quantity"].value = responseObj[tdata].quantity;
                            document.forms["billsForm"]["amount"].value = responseObj[tdata].amount;
                            document.forms["billsForm"]["billTime"].value = responseObj[tdata].billTime;
                                }

                    }

                    function editOneVisits(e){
                        //Get values submitted
                        e.preventDefault();
                        var visitserviceId = document.forms["billsForm"]["visitserviceId"].value;
                        var serviceName1 = document.forms["billsForm"]["serviceName1"].value;
                        var quantity = document.forms["billsForm"]["quantity"].value;
                        var amount = document.forms["billsForm"]["amount"].value;
                        var billTime = document.forms["billsForm"]["billTime"].value;
                        //alert(lessonName + lessonDescription);
                        
                        //object to save lessons from form to db 
                        var sendData = "visitservice_id="+visitserviceId+"&service_name="+serviceName1+"&quantity="+quantity+"&amount="+
                        amount+"&bill_time="+billTime;
                        createObject(getBills, methods[1], baseUrl + "updateBill", sendData);
                        
                        //insert or send to server
                        //alert("working");
                        return false;


                    }


                     function deleteBills(visitservice_id, full_name, service_name, amount, quantity, TOTAL){
                        
                        var r = confirm("Do you want to delete?");
                        if (r == true) {
                            createObject(getBills, methods[0], baseUrl + "deleteBill/"+visitservice_id);
                            alert("You have successfully deleted " + full_name);
                        } else {
                            
                            getBills();
                        } 
                     }
                   

                    // document.getElementById("inputBill").addEventListener("submit", saveBill);  
                    document.getElementById("updateBillsForm").addEventListener("submit", editOneVisits);


                </script>
        </div>
    </body>
</html>
