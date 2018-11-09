<nav class="navbar navbar-expand-lg navbar-light bg-light nav-pills">     
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="navbar-brand" href="/patients"><button type ="button"> Patients</button></a>
            </li>
            <li class="nav-item">
                <a class="navbar-brand" href="/services"><button type ="button">Services</button></a>
            </li>
            <li class="nav-item">
            <a class="navbar-brand" href="/visits"><button type ="button">Visits</button></a>
            </li>
            <li class="nav-item">
            <a class="navbar-brand" href="/bills"><button type ="button">Bills</button></a>
            </li>
          

            <li class="nav-item">
            <a class="navbar-brand" href="/webservice"><button type ="button" >Kaizala</button></a>
            </li>
            <li class="nav-item dropdown">
            <li class="nav-item">
            <a class="navbar-brand" href="/time"><button type ="button" >Time Reports</button></a>
            </li>
            <li class="nav-item">
            <a class="navbar-brand" href="/revenue"><button type ="button" >Revenue Reports</button></a>
            </li>
                <!-- <select>
                    <div><label>Reports</label>  
                        
                        <option value = "time"><a class="dropdown-item" href="/time" onclick = "findTime()">Time Reports</a></option>
                        <option value = "report"><a class="dropdown-item" href="/revenue" onclick = "findTime()">Revenue Reports</a></option>
                </select> -->
            </li>

            </ul>
           

            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>

       
           
        </div>
        </nav>
       
        <script type="text/javascript">
//               /* When the user clicks on the button, 
// toggle between hiding and showing the dropdown content */
//             function myFunction() {
//                 document.getElementById("myDropdown").classList.toggle("show");
//             }

//             // Close the dropdown if the user clicks outside of it
//             window.onclick = function(event) {
//             if (!event.target.matches('.dropbtn')) {

//                 var dropdowns = document.getElementsByClassName("dropdown-content");
//                 var i;
//                 for (i = 0; i < dropdowns.length; i++) {
//                 var openDropdown = dropdowns[i];
//                 if (openDropdown.classList.contains('show')) {
//                     openDropdown.classList.remove('show');
//                 }
//                 }
//             }
//             }

            function findTime(){
                if(document.getElementsByTagName("select")[0].value == 'time'){
                    var showTime = "";
                    showTime +="<a href ='/time'></a>";
                }
                else if(document.getElementsByTagName("select")[0].value == 'revenue'){
                    showTime +="<a href ='/revenue'></a>";
                }
            }
        </script>