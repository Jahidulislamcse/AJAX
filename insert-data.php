<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        #success-message{
            background-color: #DEF1D8; color: green; padding: 10px;
            margin: 10px; display: none; position: absolute; right: 15px; top: 15px; }
        #error-message{
            background-color: #EFDCDD; color: red;padding: 10px;
            margin: 10px; display: none; position: absolute; right: 15px; top: 15px; }
        #header{ background-color: bisque; text-align: center; }
        #table-form{background-color: aquamarine;}
        #table-data{background-color: gainsboro;}
        #studentid{width: 70px;}
        #studentclass{width: 90px;}
        .delete-btn{background-color: red; color: white; padding: 4px 10px; border-radius: 3px;}
    </style>
</head>

<body>
     <table id="main" border="0" >
        <tr>
            <td id="header">
                <h1>INSERT DATA USING AJAX</h1>
            </td>
        </tr>

        <tr>
            <td id="table-form">
                <form id="add-form">
                    ID: <input type="number" id="studentid" >&nbsp;&nbsp;
                    Name: <input type="text" id="studentname" >&nbsp;&nbsp;
                    Class: <input type="number" id="studentclass" >
                    <input type="submit" id="save" value="Save" >
                </form>
            </td>
        </tr>

        <tr>
            <td id="table-data"> </td>
        </tr>        
    </table>

    <div id="error-message"></div>
    <div id="success-message"></div>


    <script type="text/javascript" src="js/jquery.js"></script>

    <script>
        $(document).ready(function(){
            function loadTable(){
                 $.ajax({
                    url : "load-ajax.php",
                    type : "POST",
                    success : function(data){
                        $("#table-data").html(data);
                    }
                });
            }
            loadTable();


            $("#save").on('click', function(e){
                
                e.preventDefault();

                var id = $("#studentid").val();
                var name = $("#studentname").val();
                var studentclass = $("#studentclass").val();

                if(id=="" || name=="" || studentclass==""){
                    $("#error-message").html("All fields are required").slideDown();
                    $("#success-message").slideUp();
                }else{
                     $.ajax({
                    url : "ajax-insert.php",
                    type : "POST",
                    data : {id:id, name:name, studentclass:studentclass},

                    success:  function(data){
                        if(data==1){
                            loadTable();
                            $("#add-form").trigger("reset");
                            $("#success-message").html("Record saved successfully").slideDown();
                            $("#error-message").slideUp();
                        } 
                        else{
                            $("#error-message").html("Can't save record").slideDown();
                            $("#success-message").slideUp();
                        }
                    }
                });
                }
            });
            $(document).on('click', ".delete-btn", function(){
                if(confirm("Are you sure you want to delete this")){

                var studentId = $(this).data("id");
                var element = this;

                $.ajax({
                    url: "ajax-delete.php",
                    type: "POST",
                    data: {id: studentId},
                    success: function(data){
                        if(data == 1){
                            $(element).closest("tr").fadeOut();
                            $("#success-message").html("Record deleted successfully").slideDown();
                        } else {
                            $("#error-message").html("Can't delete record").slideDown();
                            $("#success-message").slideUp();
                        }
                    }
                });
              };
            });
        });

         
        
    </script>
</body>
</html>