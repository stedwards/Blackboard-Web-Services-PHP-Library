<?php 
/*
 * BbPHP: Blackboard Web Services Library for PHP
 * Copyright (C) 2011 by St. Edward's University (www.stedwards.edu)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 * 
 * Note: ************************************************************************************************ 
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
$results = $blackboard->Context("loginTool", array("password"=> "MassiveNinjasEpicSlurpees","clientVendorId"=> "aaron_proxy","clientProgramId"=> "example_tool","loginExtraInfo"=> "", "expectedLifeSeconds" => 5000));
echo "Outcome of attempted Login Tool method. <br />";
echo "<pre>".print_r($results, true)."</pre>";

//Calling a method with no required fields. This is a part of the Context object.
$results = $blackboard->Context("getSystemInstallationId");
echo "getSystemInstallationId() method. <br />Calling a method with no required fields. This is a part of the Context object.";
echo "<pre>".print_r($results, true)."</pre>";

//Calling a method with no required fields. This is a part of the Context object.
$results = $blackboard->Context("getServerVersion");
echo "getServerVersion() method. <br />Calling a method with no required fields. This is a part of the Context object.";
echo "<pre>".print_r($results, true)."</pre>";

//Calling a method WITH required fields.
$results = $blackboard->Context("getMemberships", array("userid"=> "aaronm"));
echo "getMemberships() method. <br /> Calling a method <strong>with</strong> required fields. This is a part of the Context object.";
echo "<pre>".print_r($results, true)."</pre>";
$course_id = $results['externalId'];

//Calling  a method using course id gleamed from the last call
$results = $blackboard->Course("getStaffInfo", array("courseId" => $course_id));
echo "getStaffInfo() method. <br /> Calling a method <strong>with</strong> the course id, $course_id, from previous call.";
echo "<pre>".print_r($results, true)."</pre>";

//Calling methods with complex types.
$results = $blackboard->Course("getCourse", array("filterType"=> '3', 'ids'=> $course_id ));
echo "getCourse() method.  <br /> Using the cFilter, search by course id: $course_id to find a class.";
echo "<pre>".print_r($results, true)."</pre>";

$results = $blackboard->Announcement("getCourseAnnouncements", array("courseId" => $course_id, "filter"=>array("filterType"=>2, "courseId"=>$course_id )));
echo "getCourseAnnouncements() method.  <br /> Using search by course id: $course_id to find a class.";
echo "<pre>".print_r($results, true)."</pre>";


$results = $blackboard->Content("getTOCsByCourseId", array("courseId" => $course_id));
echo "getTOCsByCourseId() method.  <br /> Using search by course id: $course_id to find a class.";
echo "<pre>".print_r($results, true)."</pre>";

/**
 * Lets test different filter types... 
 * 
 * 1 : GET_BY_CONTENTID : contentId 
 * 2 : GET_IMMEDIATE_CHILDREN_BY_CONTENTID : contentId 
 * 3 : GET_CHILDREN_BY_CONTENTID : contentId 
 * 4 : GET_ANCESTOR_BY_CONTENTID : contentId 
 * 5 : GET_ROOT_ENTRIES : (none) 
 * 6 : GET_REVIEWABLE_ENTRIES : (none) 
 * 7 : GET_ROOT_ENTRIES_BY_USERID : userId 
 * 8 : GET_MODIFIEDSINCE_BY_USERID : userId, modifiedSinceDate 
 * 9 : GET_CHILDREN_BY_CONTENTID_AND_USERID : contentId, userId 
 * 10 : GET_BY_TOCID : tocId NOTE: Results for some of the filters will not return fully populated ContentVO objects. 
 * Filter 6 (reviewable entries) will not include the body field 
 * Filter 7 (root entries by userid) will only return these fields: id, title, position, parent_id, reviewable, sequential, content-handler 
 * Filter 8 (modified-since-by-userid) will only return these fields: id, title, position, content handler, parent_id
 * 
 * @var unknown_type
 */
echo "<strong>Testing different filter Types.</strong> <br />";


$results = $blackboard->Content("getContentFiles", array("courseId" => $course_id, "contentId" => '_27446_1'));
echo "getContentFiles() method.  <br />";
echo "<pre>".print_r($results, true)."</pre>";

$results = $blackboard->Content("getFilteredContent", array("courseId" => $course_id, "filter"=>array("filterType"=>1, "contentId"=>'_27446_1')));
echo "getFilteredContent() method.  <br /> Filter Type 1 GET_BY_CONTENT_ID";
echo "<pre>".print_r($results, true)."</pre>";

$results = $blackboard->Content("getFilteredContent", array("courseId" => $course_id, "filter"=>array("filterType"=>2, "contentId"=>'_27446_1')));
echo "getFilteredContent() method.  <br /> Filter Type 2 GET_IMMEDIATE_CHILDREN_BY_CONTENTID";
echo "<pre>".print_r($results, true)."</pre>";

$results = $blackboard->Content("getFilteredContent", array("courseId" => $course_id, "filter"=>array("filterType"=>3, "contentId"=>'_27446_1')));
echo "getFilteredContent() method.  <br /> Filter Type 3 GET_CHILDREN_BY_CONTENTID : contentId";
echo "<pre>".print_r($results, true)."</pre>";

$results = $blackboard->Content("getFilteredContent", array("courseId" => $course_id, "filter"=>array("filterType"=>4, "contentId"=>'_27446_1')));
echo "getFilteredContent() method.  <br /> Filter Type 4 GET_ANCESTOR_BY_CONTENTID";
echo "<pre>".print_r($results, true)."</pre>";


$results = $blackboard->Content("getFilteredContent", array("courseId" => $course_id, "filter"=>array("filterType"=>5)));
echo "getFilteredContent() method.  <br /> Filter Type 5 GET_ROOT_ENTRIES";
echo "<pre>".print_r($results, true)."</pre>";

$results = $blackboard->Content("getFilteredContent", array("courseId" => $course_id, "filter"=>array("filterType"=>6)));
echo "getFilteredContent() method.  <br /> Filter Type 6.";
echo "<pre>".print_r($results, true)."</pre>";










?>
</body>
</html>
