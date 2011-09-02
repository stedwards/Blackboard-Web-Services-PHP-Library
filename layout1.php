<?php
include "bbphp.php";
?>
<html>
<head>
<title>Example Blackboard Calls and output.</title>
<style>
body {
	padding: 20px 20px 20px 20px;
	margin: 20px 20px 20px 20px;
}

pre {
	background-color: #C8DBDB;
	margin: 20px 20px 20px 20px;
	padding: 20px 20px 20xp 20px;
}
</style>

</head>
<body>
<?php
//Set the blackboard server your using
$server = "http://bb9test.stedwards.edu";
//Init the Blackboard object
$blackboard = new BbPhp($server);
//Use the information matching a registered Proxy Tool to login
$results = $blackboard->loginTool("Context", array("password"=> "MassiveNinjasEpicSlurpees","clientVendorId"=> "aaron_proxy","clientProgramId"=> "example_tool","loginExtraInfo"=> "", "expectedLifeSeconds" => 5000));

if($results == TRUE){

	//Calling a method WITH required fields.
	$results = $blackboard->getMemberships("Context", array("userid"=> "aaronm"));



	/**
	 * Blackboard returns a multidimensional array, unless user has only one course, the its singular.
	 * We fix this, because it is annoying.  Start a list of the users courses with the course external id.
	 *
	 */
	$courses = array();
	if (count($results) == count($results, COUNT_RECURSIVE))
	{
		$courses[0]['externalId'] = $results['externalId'];

	}
	else
	{
		foreach($results as $result){
			$courses[]['externalId'] = $result['externalId'];
		}

	}

	//Add some detail to the class list...
	$course_list = array();
	foreach($courses as &$course){
		$course_detail = $blackboard->getCourse("Course", array("filterType"=> '3', 'ids'=> $course['externalId'] ));
		$course['title'] = $course_detail['name'];
		$course['courseId'] = $course_detail['courseId'];
	}



	foreach($courses as &$course) {
		$results = $blackboard->getFilteredContent("Content", array("courseId" => $course['externalId'], "filter"=>array("filterType"=>5)));
		//echo "getFilteredContent() method.  <br /> Filter Type 5 GET_ROOT_ENTRIES";
		//echo "<pre>".print_r($results, true)."</pre>";
		foreach($results as $result){
			$course['content_groups'][] = array('id'=>$result['id'], 'title'=>$result['title']);
		}
		
		
		foreach($course['content_groups'] as &$content_group){
			$results = $blackboard->getFilteredContent("Content", array("courseId" => $course['externalId'], "filter"=>array("filterType"=>3, "contentId"=>$content_group['id'])));
			foreach($results as $result){
				$content_group['items'][] = array('title' => $result['title'], 'description' => $result['body'], "id" => $result['id'], "contentHandler" => $result['contentHandler']);	
			}
		}
			
	}
	echo "<pre>".print_r($courses, true)."</pre>";



}else{

	echo "Well this is a problem. The Blackboard server could not be reached. Try again later, we're working on this right now.";

}

?>
</body>
</html>
