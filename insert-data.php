<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
     <table id="main" border="0" >
        <tr>
            <td id="header">
                <h1>INSERT DATA USING AJAX</h1>
            </td>
        </tr>

        <tr>
            ID: <input type="number" id="studentid" >&nbsp;&nbsp;
            Name: <input type="text" id="studentname" >&nbsp;&nbsp;
            Class: <input type="number" id="studentclass" >
            <input type="submit" id="save" value="Save" >
        </tr>

        <tr>
            <td id="table-data"> </td>
        </tr>        
    </table>

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

                $.ajax({
                    url : "ajax-insert.php",
                    type : "POST",
                    data : {id:id, name:name, studentclass:studentclass},

                    success:  function(data){
                        if(data==1){
                            loadTable();
                        } else{
                            alert("could not insert");
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>