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
                <h1>AJAX with PHP</h1>
            </td>
        </tr>

        <tr>
            <td id="load-table">
                <input type="button" id="load-button" value="Load Data">
                <input type="button" id="erase" value="Erase Data">

            </td>
        </tr>
        <tr>
            <td id="table-data">
                <table border="1" width="100%">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                    </tr>
                </table>
            </td>
        </tr>        
    </table>

    <script type="text/javascript" src="js/jquery.js"></script>
    <script>
        $(document).ready(function(){
            $("#load-button").on("click", function(e){
                $.ajax({
                    url : "load-ajax.php",
                    type : "POST",
                    success : function(data){
                        $("#table-data").html(data);
                    }
                })
            });

            $("#erase").on("click", function(e){
                        $("#table-data").html("");
            });
        });
    </script>

</body>
</html>