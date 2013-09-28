<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>App42 PaaS Sample Php-Couch Application</title>
<link href="css/style-User-Input-Form.css" rel="stylesheet" type="text/css">
</head>

<body>
	<div class="App42PaaS_header_wrapper">
    	<div class="App42PaaS_header_inner">
        	<div class="App42PaaS_header">  
                <div class="logo"> 
                    <a href="http://app42paas.shephertz.com"><img border="0" alt="App42PaaS" src="images/logo.png"></img></a>
                 </div>     
            </div> 
    	</div>
	</div>
<!------------------------------------Header Closed------------------------------------------->
	<div class="App42PaaS_body_wrapper">
    	<div class="App42PaaS_body">
        	<div class="App42PaaS_body_inner">
            <div class="contactPage_title">
            	<table>
                	<thead class="table-head">
                    	<tr>
                        <td>Id</td>
                        <td>Result</td>
                        </tr>
                	</thead><tbody>
<?php 
require_once "DBManager.php";

$client = new DBManager();

try {
	$response = $client->getAllDocs();
	foreach ($response as $row ) {
     echo "<tr><td>" . $row->id. "</td>";
     echo "<td>" ;
	 print_r($client->getDocById($row->id));
	 echo "</td></tr>";
	 
 }

} catch (Exception $ex) {
	echo "<h1>No Data Found</h1>";
	echo($ex);
}

?>
</tbody>
         </table>
			<div align="left"></div><br/><br/><a href="index.php">Create Post</a>
            </div>
            </div>
    	</div>
    </div>
</body>
</html>