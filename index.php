<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
     <table id="main" border="0" >
        <tr>
            <td id="header">
                <h1>PHP WITH JQUERY AND AJAX</h1>
            </td>
        </tr>

         <div id="search-bar">
                <label for="">Search</label>
                <input type="text" id="search" autocomplete="off">
        </div>

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

    <div id="modal">
        <div id="modal-form">
            <h2>Edit Form</h2>
            <table cellpadding="10px" width="100%"> </table>
            <div id="close-btn">X</div>
        </div>
    </div>

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

            //Add Operation
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

            //Delete Operation
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

            //Show Modal Box
            $(document).on('click', ".edit-btn", function(){
               $("#modal").show();
               var studentId = $(this).data("eid");
               
               $.ajax({
                url: "load-update-form.php",
                method: "POST",
                data: {id: studentId},
                success: function(data){
                    $("#modal-form table").html(data);
                }
               });
            });

            //Hide Modal Box
            $("#close-btn").on('click', function(){
                $("#modal").hide();
            });


            //Save Updated form 
             $(document).on('click', "#edit-submit", function(){
                var studentId = $("#studentId").val();
                var studentName = $("#edit-name").val();
                var studentClass = $("#edit-class").val();
                $.ajax ({
                   url: "ajax-update-form.php",
                   type: "POST",
                   data: {id: studentId, name: studentName, class: studentClass},
                   
                   success: function(data){
                    if(data==1){
                    $("#modal").hide();
                    $("#success-message").html("Record updated successfully").slideDown();
                    loadTable();
                    }
                    else{
                        $("#error-message").html("Can't update record").slideDown();
                        $("#success-message").slideUp();
                    }
                   }

                });
                });

                $("#search").on('keyup', function(){
                    var search_item = $(this).val();

                    $.ajax({
                        url: "ajax-live-search.php",
                        type: "POST",
                        data: {search: search_item},

                        success: function(data){
                            $("#table-data").html(data);
                        }
                    });
                });
        });

         
        
    </script>
</body>
</html>