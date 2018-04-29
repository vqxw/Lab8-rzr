<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>AJAX: Sign Up Page</title>

        <script src="https://code.jquery.com/jquery-3.1.0.js"></script>
    
        <script>
            function validateForm() {

                return false;

            }
        </script>

        <script>
            $(document).ready( function() {

                $("#username").change( function() {
                    //alert("Enter things");

                    $.ajax({

                        type: "GET",
                        url: "checkUsername.php",
                        dataType: "json",
                        data: { "username": $("#username").val() },
                        success: function(data,status) {

                            //alert(data.password);

                            if (!data) { //data == false
                                $("#user").html("username is AVAILABLE");
                            }

                            else {
                                $("#user").html("username is NOT AVAILABLE");
                                $("#user").css("color", "red");
                            }

                        },
                        complete: function(data,status) { //optional, used for debugging purposes
                        //alert(status);
                        }

                    });//ajax

                });

                $("#state").change( function() {
                    //alert ("hello");

                    // access value of state
                    //alert($("#state").val());

                    $.ajax({

                        type: "GET",
                        url: "http://itcdland.csumb.edu/~milara/ajax/countyList.php",
                        dataType: "json",
                        data: { "state": $("#state").val() },
                        success: function(data,status) {

                            //display county in alert message
                           // alert(data[0].county);

                           $("#county").html("<option> - Select one - </option>");
                           for (var i = 0; i < data.length; i++) {
                               $("#county").append("<option>" + data[i].county + "</option>");
                           }

                           //accessing id
                           //$("#county").html("<options>" + data[0].county + "</options>");

                        },
                        complete: function(data,status) { //optional, used for debugging purposes
                        //alert(status);
                        }

                    }); //ajax

                });

                $("#zipcode").change( function() {

                    //alert( $("#zipcode").val() );     } );

                    $.ajax({

                        type: "GET",
                        url: "http://itcdland.csumb.edu/~milara/ajax/cityInfoByZip.php",
                        dataType: "json",
                        data: { "zip": $("#zipcode").val()    },
                        success: function(data,status) {

                            if (!data) { //data == false
                                $("#zip").html("Zipcode not found");
                                $("#zip").css("color", "red");
                            }

                            else {
                                $("#zip").html("");
                                $("#city").html(data.city);
                                $("#latitude").html(data.latitude);
                                $("#longitude").html(data.longitude);
                            }

                        },

                        complete: function(data,status) { //optional, used for debugging purposes
                        //alert(status);
                        }

                    }); //ajax
    
                });
                
                $("#sub").click(function() {
                    
                    if ($("#pass1").val() == $("#pass2").val()) { 
                        $("#passText").html("Passwords match. GOOD JOB")
                    }
                            
                    else  { 
                        $("#passText").html("Passwords don't match. FIX THIS")
                    }

                });

            }); // documentReady
        </script>

    </head>

    <body>
    
       <h1> Sign Up Form </h1>

        <form onsubmit="return validateForm()">
            <fieldset>
               <legend>Sign Up</legend>
                First Name:  <input type="text"><br> 
                Last Name:   <input type="text"><br> 
                Email:       <input type="text"><br> 
                Phone Number:<input type="text"><br><br>
                Zip Code:    <input type="text" id = "zipcode" span id = "zip"><br>
                City:        <span id = "city"></span>
                <br>
                Latitude:    <span id = "latitude"></span>
                <br>
                Longitude:   <span id = "longitude"></span>
                <br><br>
                State:       <span id = "state"></span>
                <select id = "stateMenu">
                    <option value="">Select One</option>
                    <option value="ca"> California</option>
                    <option value="ny"> New York</option>
                    <option value="tx"> Texas</option>
                    <option value="va"> Virginia</option>
                </select><br />

                Select a County:
                <select id = "county">

                </select><br>

                Desired Username: <input type="text" id = "username" span id = "user"><br>

                Password: <input type="password" id = "pass1"><br>

                Type Password Again: <input type="password" id = "pass2"> <span id = "passText"></span> <br>

                <input type="submit" value="Sign up!" id = "sub">
            </fieldset>
        </form>

    </body>

</html>