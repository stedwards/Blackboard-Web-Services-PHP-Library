<?php 
 /*Note: ************************************************************************************************ 
 * 	You need to have a registered tool in place before running any BlackBoard connection scripts.       *
 *  Run the register_tool.php script first. Enter your Proxy-Tool information here. You will need administrator access to the   *
 *  Blackboard server in order to activate the proxy-tool you create. Once you run this script, login   *
 *  to your BB9 server, go to the System Admin tab, Building Blocks > Proxy Tools and select to edit    * 
 *  the new tool to make it available for use.															*
 *******************************************************************************************************/	
include "bbphp.php";
?>
<html>
<head>
<title>Example Blackboard Calls and output.</title>
<style>
body{
padding:20px 20px 20px 20px;
margin:20px 20px 20px 20px;
}

pre{
background-color:#C8DBDB;
margin:20px 20px 20px 20px;
padding:20px 20px 20xp 20px;

}

</style>

</head>
<body>
<?php 
//Set the blackboard server your using
$server = "http://bb9test.stedwards.edu";
//Init the Blackboard object
$blackboard = new BbPhp($server);
echo "An initial blackboard object. <br />";
var_dump($blackboard);


//Use the information matching a registered Proxy Tool to login
$results = $blackboard->loginTool("Context", array("password"=> "MassiveNinjasEpicSlurpees","clientVendorId"=> "aaron_proxy","clientProgramId"=> "example_tool","loginExtraInfo"=> "", "expectedLifeSeconds" => 5000));
echo "Outcome of attempted Login Tool method. <br />";
echo "<pre>".print_r($results, true)."</pre>";

//Calling a method with no required fields. This is a part of the Context object.
$results = $blackboard->getSystemInstallationId("Context");
echo "getSystemInstallationId() method. <br />Calling a method with no required fields. This is a part of the Context object.";
echo "<pre>".print_r($results, true)."</pre>";

//Calling a method with no required fields. This is a part of the Context object.
$results = $blackboard->getServerVersion("Context");
echo "getServerVersion() method. <br />Calling a method with no required fields. This is a part of the Context object.";
echo "<pre>".print_r($results, true)."</pre>";

//Calling a method WITH required fields.
$results = $blackboard->getMemberships("Context", array("userid"=> "aaronm"));
echo "getMemberships() method. <br /> Calling a method <strong>with</strong> required fields. This is a part of the Context object.";
echo "<pre>".print_r($results, true)."</pre>";
$course_id = $results['ax23:externalId'];

//Calling  a method using course id gleamed from the last call
$results = $blackboard->getStaffInfo("Course", array("courseId" => $course_id));
echo "getStaffInfo() method. <br /> Calling a method <strong>with</strong> the course id, $course_id, from previous call.";
echo "<pre>".print_r($results, true)."</pre>";


$results = $blackboard->getCourse("Course", array("filterType"=> '3', 'ids'=> $course_id ));
echo "getCourse() method.  <br /> Using the cFilter, search by course id: $course_id to find a class.";
echo "<pre>".print_r($results, true)."</pre>";

$results = $blackboard->getCourseAnnouncements("Announcement", array("filterType"=> '6'));
echo "getCourseAnnouncements() method.  <br /> Using search by course id: $course_id to find a class.";
echo "<pre>".print_r($results, true)."</pre>";

echo "Perform some soap discovery <br />";
$client = new SoapClient("http://bb9test.stedwards.edu/webapps/ws/services/Announcement.WS?wsdl");
echo "Get functions <br />";
var_dump($client->__getFunctions());
echo "Get Types <br />";
var_dump($client->__getTypes());



?>
</body>
</html>
