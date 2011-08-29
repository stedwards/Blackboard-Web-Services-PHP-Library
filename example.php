<?php 
/**
 * Note: You need to have a registered tool in place before running any BlackBoard connection scripts.
 *  
 *  This is a basic example script showing how to connect to blackboard and useing the BbPhp class.
 * 
 */
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

//$filter = $blackboard->CourseFilter();

//var_dump($filter);

//$results = $filter->getAvailable();
//echo "<pre>".print_r($results, true)."</pre>";

//Calling a method using the cFilter --returns MANY results, greedy.
$results = $blackboard->getCourse("Course", array("cFilter" => 'python'));
echo "getCourse() method.  <br /> Using the cFilter, search by keyword 'python' to find a class.";
echo "<pre>".print_r($results, true)."</pre>";







//$results = $blackboard->getCourseAnnouncements("Announcement");
//echo "<pre>".print_r($results, true)."</pre>";

//not working
//$results = $blackboard->getUser("User", array("UserFilter"=>"aaronm"));
//echo "<pre>".print_r($results, true)."</pre>";

?>
</body>
</html>
