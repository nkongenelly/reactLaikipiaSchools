<head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Hospital Mamnagement</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token()}}">
        <link rel="stylesheet" type="text/css" href="/css/bootstrap/css/bootstrap.min.css" />
        
    </head>
    <body onload = "getServices()">
        @include('hospital.nav')
        <div class = "container">
                <div id = "inputServices">
                    <form class = "form-horizontal" action = "#" method = "POST" id = "inputService" name = "servicesForm">
                        {{csrf_field()}}
                        <div class = "inputItems">
                            <label>Service Name</label>
                            <select name = "serviceName" >
                            <option value = "consultation" id = "consultation">consultation </option>
                            <option value = "lab" id = "lab">lab </option>
                            <option value = "xray" id = "xray">xray </option>
                            <option value = "dental" id = "dental">dental </option>
                            <option value = "maternity" id = "maternity">maternity </option>
                            <option value = "general" id = "general">general</option>
                            <option value = "vaccines" id = "vaccines">vaccines </option>
                            </select>
                        </div>
                        <div class = "inputItems">
                            <label>Service Amount</label>
                            <input class = "form-control" type = "text" name ="amount"/>
                        </div>
                        <div class = "inputItems">
                            <button class = " btn btn-primary" type = "submit" name = "saveService">Submit</button>
                            <button class = " btn btn-warning" type = "button" name = "viewAllServices" onclick ="getServices()">Back </button>
                        </div>
                    </form>
                </div>

                <div id ="updateServicesForm">
                    <form class = "form-horizontal" action = "#" method = "POST" id = "inputService1" name = "servicesForm1">
                        {{csrf_field()}}
                        <div class = "inputItems">
                            <input type ="hidden" name = "serviceId"/>
                            <label>Service Name</label>
                            <select name = "serviceName1" >
                            <option value = "consultation" id = "consultation">consultation </option>
                            <option value = "lab" id = "lab">lab </option>
                            <option value = "xray" id = "xray">xray </option>
                            <option value = "dental" id = "dental">dental </option>
                            <option value = "maternity" id = "maternity">maternity </option>
                            <option value = "general" id = "general">general</option>
                            <option value = "vaccines" id = "vaccines">vaccines </option>
                            </select>
                        </div>
                        <div class = "inputItems">
                            <label>Service Amount</label>
                            <input class = "form-control" type = "text" name ="amount1"/>
                        </div>
                        <div class = "inputItems">
                            <button class = " btn btn-primary" type = "submit" name = "saveService">Update</button>
                            <button class = " btn btn-warning" type = "button" name = "viewAllServices" onclick ="getServices()">Back </button>
                        </div>
                    </form>
                </div>

                <div id = "allServices"></div>



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

                    function getServices(){
                        createObject(showServices, methods[0], baseUrl + "getAllServices");
                        document.getElementById("allServices").style.display = "block";
                        document.getElementById("inputServices").style.display = "none";
                        document.getElementById("updateServicesForm").style.display = "none";
                    }

                    function showServices(jsonResponse){
                        var responseObj = JSON.parse(jsonResponse);
                        var count = 0,tData;
                        var tableData = "<button class ='btn btn-primary' type = 'button' onclick = 'showServiceForm()'>Add Service</button><table class = 'table table-bordered table-striped table-condensed'><tr><th>#</th><th>Name</th><th>Description</th><th colspan ='3'> Action</th></tr>";
                        for (tData in responseObj)
                        {
                            count++;
                            tableData +="<tr><td>" + count + "</td>";
                            
                            tableData +="<td>" + responseObj[tData].service_name+ "</td>";
                            tableData +="<td>" + responseObj[tData].amount + "</td>";

                            tableData +="<td><a href = '#' class ='btn btn-info bt-sm' onclick = 'showSingleService("+responseObj[tData].service_id+")'>View </a></td>" ;
                            tableData +="<td><a href = '#' class ='btn btn-success btn-sm' onclick ='editService("+responseObj[tData].service_id+",\""+responseObj[tData].service_name+"\",\"" +responseObj[tData].amount +"\")'>Edit </a></td>" ;
                            tableData +="<td><a href = '#' class ='btn btn-danger bt-sm' onclick = 'deleteService("+responseObj[tData].patient_id+",\"" +responseObj[tData].name +"\")'>Delete </a></td></tr>" ;
                        }
                        tableData += "</table>";
                        document.getElementById("allServices").innerHTML = tableData;

                    }
                        
                        function showServiceForm(){
                        document.getElementById("inputServices").style.display = "block";
                        document.getElementById("allServices").style.display = "none";
                        document.getElementById("updateServicesForm").style.display = "none";
                    
                    }

                    function submitServices(e){
                        //Get values submitted
                        e.preventDefault();
                        var serviceName = document.forms["servicesForm"]["serviceName"].value;
                        var amount = document.forms["servicesForm"]["amount"].value;
                        //alert(lessonName + lessonDescription);

                        //object to save lessons from form to db 
                        var sendData = "service_name="+serviceName+"&amount="+amount;
                        createObject(getServices, methods[1], baseUrl + "saveServices", sendData);
                        
                    
                        //insert or send to server
                        //alert("working");
                        return false;
                    }
      
                    function showSingleService (service_id){
                        createObject(displaySingleService, methods[0], baseUrl + "getSingleService/"+service_id);
                        return false;
                    }

                    function displaySingleService (responseTxt){
                        var responseObj = JSON.parse(responseTxt);
                            var tableData = "";
                                
                            tableData +="<h1>" + responseObj.service_name + "</h1>";
                            tableData +="<p>" + responseObj.amount + "</p>";
                            tableData +="<button type='button' class= 'btn btn-warning' onclick = 'getServices()'>Back</button>";
                            
                            document.getElementById("allServices").innerHTML = tableData;
                    }

                    function editService (service_id, service_name, amount){
                        
                        document.getElementById("updateServicesForm").style.display = "block";
                        document.getElementById("allServices").style.display = "none";
                        
                        document.forms["servicesForm1"]["serviceId"].value = service_id;
                        document.forms["servicesForm1"]["serviceName1"].value = service_name;
                        document.forms["servicesForm1"]["amount1"].value = amount;

                    }

                    function submitUpdate(e){
                        //Get values submitted
                        e.preventDefault();
                        var serviceId = document.forms["servicesForm1"]["serviceId"].value;
                        var serviceName = document.forms["servicesForm1"]["serviceName1"].value;
                        var amount = document.forms["servicesForm1"]["amount1"].value;
                        //alert(lessonName + lessonDescription);
                        
                        //object to save lessons from form to db 
                        var sendData = "service_name="+serviceName+"&amount="+amount+"&service_id="+serviceId;
                        createObject(getServices, methods[1], baseUrl + "updateServices", sendData);
                        
                        //insert or send to server
                        //alert("working");
                        return false;
                    }
                    
                    function deleteService(service_id, service_name, amount){
                        
                        var r = confirm("Do you want to delete?");
                        if (r == true) {
                            createObject(getServices, methods[0], baseUrl + "deleteService/"+service_id);
                            alert("You have successfully deleted " + service_name);
                        } else {
                            
                            getServices();
                        } 

                    }

                    document.getElementById("inputService").addEventListener("submit", submitServices);
                    document.getElementById("inputService1").addEventListener("submit", submitUpdate);

                </script>
        </div>
    </body>
</html>
