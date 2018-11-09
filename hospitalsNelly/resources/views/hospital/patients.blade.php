<head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Hospital Mamnagement</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token()}}">
        <link rel="stylesheet" type="text/css" href="/css/bootstrap/css/bootstrap.min.css" />
        
    </head>
    <body onload = "getPatients()">
        @include('hospital.nav')
        <div class = "container">
            <div id = "inputForm">
            <form class = "form-horizontal" action = "#" method = "POST" id = "inputPatients" name = "patientsForm">
                {{csrf_field()}}
                <div class = "inputItems">
                    <label>Full Name</label>
                    <input type = "text" name = "fullName" required/><br>
                </div>
                <div class = "inputItems">
                    <label>National ID</label>
                    <input class = "form-control" type = "text" name = "nationalId" max = "8" required/><br>
                </div>
                <div class = "inputItems" class="custom-control custom-radio custom-control-inline">
                    <label>Gender</label><br>
                    

                <div class="custom-control custom-radio">
                <input type="radio" id="male" name="gender" class="custom-control-input" value="1">
                <label class="custom-control-label" for="male">Male</label>
                </div>
                <div class="custom-control custom-radio">
                <input type="radio" id="female" name="gender" class="custom-control-input" value="2">
                <label class="custom-control-label" for="female">Female</label>
                </div>
                </div>

                <div class = "inputItems">
                    <label>Date of Birth</label>
                    <input class = "form-control" type = "date" name = "dateOfBirth" placeholder = "YYYY-MM-DD" required/><br>
                </div><hr>
                <div class = "inputItems">
                    <button class = " btn btn-primary" type = "submit" name = "savePatient">Submit</button><br>
                    <button class = " btn btn-warning" type = "button" name = "makeVisits" onclick ="createVisits()">Create Visits </button>
                    <button class = " btn btn-primary" type = "button" name = "viewAllPatient" onclick ="getPatients()">Back </button>
                </div>
            </form>
        </div>
        <div>
            <button class="btn btn-outline-secondary" dusk="moresend">Remove</button>
        </div>

        <div id = "updatePatientForm">
            <form class = "form-horizontal" action = "#" method = "POST" id = "inputPatients1" name = "patientsForm1">
                {{csrf_field()}}
                <div class = "inputItems">
                    <input type ="hidden" name = "patientId"/>
                    <label>Full Name</label>
                    <input class = "form-control" type = "text" name = "fullName1" required/><br>
                </div>
                <div class = "inputItems">
                    <label>National ID</label>
                    <input class = "form-control" type = "text" name = "nationalId1" max = "8" required/><br>
                </div>
                <div class = "inputItems" class="custom-control custom-radio custom-control-inline">
                    <label>Gender</label>
                    <input class = "custom-control-input" type="radio" name="gender" value="1"/>Male
                    <input class = "custom-control-input" type="radio" name="gender" value="2"/>Female <br>
                </div>

                <div class = "inputItems">
                    <label>Date of Birth</label>
                    <input class = "form-control" type = "date" name = "dateOfBirth1" placeholder = "YYYY-MM-DD" required/><br>
                </div><hr>
                <div class = "inputItems">
                    <button class = " btn btn-primary" type = "submit" name = "savePatient">Update</button><br>
                    <button class = " btn btn-warning" type = "button" name = "makeVisits" onclick ="createVisits()">Create Visits </button>
                    <button class = " btn btn-primary" type = "button" name = "viewAllPatient" onclick ="getPatients()">Back </button>
                </div>
            </form>
        </div>

        <div id = "allVisitsForm">
             {{csrf_field()}}
            <form class = "form-horizontal" action = "#" method = "POST" id = "inputVisits" name = "visitsForm">
                <div class = "inputItems">

                    <input class = "form-control" type ="hidden" name = "patientId"/>
                    <input class = "form-control" type ="hidden" name = "visitId"/>
                    <label>Visit Date and time</label>
                    <input class = "form-control" type = "datetime-local" name = "visitDate" required/><br>
                </div>
                <div class = "inputItems">
                    <label>Visit Type</label>
                    <select name = "visitType1">
                        <option value = "1" >Cash</option>
                        <option value = "2">Insurance</option>
                    </select>
                </div>
                <div class = "inputItems">
                    <label>Exit time</label>
                    <input class = "form-control" type = "datetime-local" name = "exitTime" placeholder = "YYYY-MM-DD, hh-mm-ss" required/><br>
                </div>
                <div class = "inputItems">
                    <label>Visit Status</label>
                    <select name = "visitStatus1" id = "active">
                        <option value = "1" >Active</option>
                        <option value = "2">Pending</option>
                    </select>
                            
                </div>
                <div class = "inputItems">
                    <button class = " btn btn-primary" type = "submit" name = "saveVisit">Submit</button><br>
                    <button class = " btn btn-warning" type = "button" name = "viewPatient" onclick ="getPatients()">Back </button>
                    
                </div>
            </form>
        </div>

        <div id = "allPatients"></div>



            <script>
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

                    function getPatients(){
                        createObject(showPatients, methods[0], baseUrl + "getAllPatients");
                        document.getElementById("inputForm").style.display = "none";
                        document.getElementById("allPatients").style.display = "block";
                        document.getElementById("allVisitsForm").style.display = "none";
                        document.getElementById("updatePatientForm").style.display = "none";

                    }


                    function submitPatient(e){
                        //Get values submitted
                        e.preventDefault();
                        var fullName = document.forms["patientsForm"]["fullName"].value;
                        var nationalId = document.forms["patientsForm"]["nationalId"].value;
                        var gender = document.forms["patientsForm"]["gender"].value;
                        var dateOfBirth = document.forms["patientsForm"]["dateOfBirth"].value;
                        //alert(lessonName + lessonDescription);

                        //object to save lessons from form to db 
                        var sendData = "full_name="+fullName+"&national_id="+nationalId+"&gender="+gender+"&date_of_birth="+
                        dateOfBirth;
                        createObject(getPatients, methods[1], baseUrl + "savePatients", sendData);
                        
                    
                        //insert or send to server
                        //alert("working");
                        return false;
                    }

                    
                    function submitVisits(e){
                        //Get values submitted
                        e.preventDefault();
                        
                        var patientId = document.forms["visitsForm"]["patientId"].value;
                        var visitDate = document.forms["visitsForm"]["visitDate"].value;
                        var visitType = document.forms["visitsForm"]["visitType"].value;
                        var exitTime = document.forms["visitsForm"]["exitTime"].value;
                        var visitStatus = document.forms["visitsForm"]["visitStatus"].value;
                        //alert(lessonName + lessonDescription);

                        //object to save lessons from form to db 
                        var sendData ="patient_patient_id="+ patientId+"&visit_date="+visitDate+"&visit_type="+visitType+"&exit_time="+exitTime+"&visit_status="+visitStatus;
                        createObject(getPatients, methods[1], baseUrl + "saveVisits", sendData);
                        
                    
                        //insert or send to server
                        //alert("working");
                        return false;
                    }

                    function displayPatients(){
                        alert('Patient\'s details successfully recorded');
                    }

                    function showPatients(jsonResponse){
                        // alert('showpatients');
                        var responseObj = JSON.parse(jsonResponse);
                        var count = 0,tData;
                        var tableData = "<button class ='btn btn-primary' type = 'button' onclick = 'showPatientForm()'>New Patient Form</button><table class = 'table table-bordered table-striped table-condensed'><tr><th>#</th><th>Name</th><th>National ID</th><th>Date of Birth</th><th>Gender</th><th colspan ='4'> Action</th></tr>";
                        var gender1;
                        for (tData in responseObj)
                        {
                            
                            count++;
                            tableData +="<tr><td>" + count + "</td>";
                            tableData +="<td>" + responseObj[tData].full_name + "</td>";
                            tableData +="<td>" + responseObj[tData].national_id + "</td>";
                            tableData +="<td>" + responseObj[tData].date_of_birth+ "</td>";
                                if(responseObj[tData].gender == "1"){
                                    tableData +="<td>" + "Male" + "</td>";
                                }
                                else if(responseObj[tData].gender == "2")
                                {
                                    tableData +="<td>" + "Female" + "</td>";
                                }
                            //tableData +="<td>" + responseObj[tData].gender1 + "</td>";
                            tableData +="<td><a href = '#' class ='btn btn-info bt-sm' onclick = 'submitVisitsForm("+responseObj[tData].patient_id+")'>New Visit</a></td>" ;
                            tableData +="<td><a href = '#' class ='btn btn-info bt-sm' onclick = 'showSinglePatient("+responseObj[tData].patient_id+")'>View </a></td>" ;
                            tableData +="<td><a href = '#' class ='btn btn-success btn-sm' onclick ='editPatient("+responseObj[tData].patient_id+",\""+responseObj[tData].full_name+"\",\"" +responseObj[tData].national_id+"\",\"" +responseObj[tData].gender+"\",\"" +responseObj[tData].date_of_birth +"\")'>Edit </a></td>" ;
                            tableData +="<td><a href = '#' class ='btn btn-danger bt-sm' onclick = 'deletePatient("+responseObj[tData].patient_id+",\"" +responseObj[tData].name +"\")'>Delete </a></td></tr>" ;
                        }
                        tableData += "</table>";
                        document.getElementById("allPatients").innerHTML = tableData;

                    }

                    function submitVisitsForm(patient_id){
                        document.getElementById("inputForm").style.display = "none";
                        document.getElementById("allPatients").style.display = "none";
                        document.getElementById("updatePatientForm").style.display = "none";
                        document.getElementById("allVisitsForm").style.display = "block";
                       // console.log(patient_id);
                        document.forms["visitsForm"]["patientId"].value = patient_id;
                    
                    }

                    function showPatientForm(){
                        document.getElementById("inputForm").style.display = "block";
                        document.getElementById("allPatients").style.display = "none";
                        document.getElementById("updatePatientForm").style.display = "none";
                        document.getElementById("allVisitsForm").style.display = "none";
                    
                    }

                    function showSinglePatient (patient_id){
                        createObject(displaySinglePatient, methods[0], baseUrl + "getSinglePatient/"+patient_id);
                        return false;
                    }

                    function displaySinglePatient (responseTxt){
                        var responseObj = JSON.parse(responseTxt);
                            var tableData = "";
                                
                            
                            tableData +="<h1>" + responseObj.full_name + "</h1>";
                            tableData +="<p>" + responseObj.national_id + "</p>";
                            tableData +="<h1>" + responseObj.gender + "</h1>";
                            tableData +="<p>" + responseObj.date_of_birth + "</p>";
                            tableData +="<button type='button' class= 'btn btn-warning' onclick = 'getPatients()'>Back</button>";
                            
                            document.getElementById("allPatients").innerHTML = tableData;
                    }

                    function editPatient (patient_id, national_id, full_name, gender, date_of_birth){
                        
                        document.getElementById("updatePatientForm").style.display = "block";
                        document.getElementById("allPatients").style.display = "none";
                        
                        document.forms["patientsForm1"]["patientId"].value = patient_id;
                        document.forms["patientsForm1"]["fullName1"].value = full_name;
                        document.forms["patientsForm1"]["nationalId1"].value = national_id;
                        document.forms["patientsForm1"]["gender"].value = gender;
                        document.forms["patientsForm1"]["dateOfBirth1"].value = date_of_birth;

                    }

                    
                    function submitUpdate(e){
                        //Get values submitted
                        e.preventDefault();
                        var patientId = document.forms["patientsForm1"]["patientId"].value;
                        var fullName = document.forms["patientsForm1"]["fullName1"].value;
                        var nationalId = document.forms["patientsForm1"]["nationalId1"].value;
                        var gender = document.forms["patientsForm1"]["gender"].value;
                        var dateOfBirth = document.forms["patientsForm1"]["dateOfBirth1"].value;
                        //alert(lessonName + lessonDescription);
                        
                        //object to save lessons from form to db 
                        var sendData = "full_name="+fullName+"&national_id="+nationalId+"&gender="+gender+"&date_of_birth="+
                        dateOfBirth+"&patient_id="+patientId;
                        createObject(getPatients, methods[1], baseUrl + "updatePatients", sendData);
                        
                        //insert or send to server
                        //alert("working");
                        return false;
                    }

                    function deletePatient(patient_id, national_id, full_name, gender, date_of_birth){
                        
                        var r = confirm("Do you want to delete?");
                        if (r == true) {
                            createObject(getPatients, methods[0], baseUrl + "deletePatient/"+patient_id);
                            alert("You have successfully deleted " + full_name);
                        } else {
                            
                            getPatients();
                        } 
                    

                
                        
                        return false;
                    }

                    



                    document.getElementById("inputPatients").addEventListener("submit", submitPatient);
                    document.getElementById("inputVisits").addEventListener("submit", submitVisits);
                    document.getElementById("inputPatients1").addEventListener("submit", submitUpdate);
            
            </script>
        </div>

    </body>
</html>

