<?php
/*
 * BbPHP: Blackboard Web Services Library for PHP
 * Copyright (C) 2011 by St. Edward's University (www.stedwards.edu)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 */ 
include "bbphp.php";
?>
<html>
<head>
<title>Example Blackboard Calls and output.</title>
<style>
body {
	padding: 40px 20px 20px 20px;
	margin: 0px 20px 20px 20px;
}

pre {
	background-color: #C8DBDB;
	margin: 20px 20px 20px 20px;
	padding: 20px 20px 20xp 20px;
}
</style>

<link rel="stylesheet" href="http://twitter.github.com/bootstrap/1.3.0/bootstrap.min.css">

</head>
<body>
<?php
//Set the blackboard server your using
$server = "http://bb9test.stedwards.edu";
//Init the Blackboard object
$blackboard = new BbPhp($server);
//Use the information matching a registered Proxy Tool to login
$results = $blackboard->Context("loginTool", array("password"=> "MassiveNinjasEpicSlurpees","clientVendorId"=> "aaron_proxy","clientProgramId"=> "example_tool","loginExtraInfo"=> "", "expectedLifeSeconds" => 5000));

if($results == TRUE){

	//Calling a method WITH required fields.
	$results = $blackboard->Context("getMemberships", array("userid"=> "aaronm"));



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
		$course_detail = $blackboard->Course("getCourse", array("filterType"=> '3', 'ids'=> $course['externalId'] ));
		$course['title'] = $course_detail['name'];
		$course['courseId'] = $course_detail['courseId'];
	}



	foreach($courses as &$course) {
		$results = $blackboard->Content("getFilteredContent", array("courseId" => $course['externalId'], "filter"=>array("filterType"=>5)));
		//echo "getFilteredContent() method.  <br /> Filter Type 5 GET_ROOT_ENTRIES";
		//echo "<pre>".print_r($results, true)."</pre>";
		foreach($results as $result){
			$course['content_groups'][] = array('id'=>$result['id'], 'title'=>$result['title']);
		}
		
		
		foreach($course['content_groups'] as &$content_group){
			$results = $blackboard->Content("getFilteredContent", array("courseId" => $course['externalId'], "filter"=>array("filterType"=>3, "contentId"=>$content_group['id'])));
			foreach($results as $result){
				$content_group['items'][] = array('title' => $result['title'], 'description' => $result['body'], "id" => $result['id'], "contentHandler" => $result['contentHandler']);	
			}
		}
			
	}
	?>
<div class="topbar" > 
      <div class="topbar-inner"> 
        <div class="container"> 
          <a class="brand" href="#">Bb9PHP</a> 
          <ul class="nav"> 
           
            <li><a href="#announce">Announcements</a></li> 
            <li><a href="#assignme">Assignments</a></li> 
  			<li><a href="#classdocs">Class Documents</a></li> 
  				<li><a href="#debug">Debug</a></li> 
          </ul> 
        </div> 
      </div> 
    </div> 	
<div class="container">

<div class="row">
<section id="announce"> 

 <div class="page-header"> 
    <h5>Announcements</h5> 
  </div> 
  
	<?php 
	foreach($courses as $course){
		$course_id = $course['externalId'];
		$results = $blackboard->Announcement("getCourseAnnouncements", array("courseId" => $course_id, "filter"=>array("filterType"=>2, "courseId"=>$course_id )));
		foreach($results as $announcement){
			echo "<h6>".$announcement['title']."</h6><p>".$announcement['body']."</p>";
		}
	}
	

?>
</section>
</div>
<div class="row">
<section id="assignme"> 

 <div class="page-header"> 
    <h5>Assignments</h5> 
  </div> 
  
	<?php 
	foreach($courses as $course){
	foreach($course['content_groups'][0]['items'] as $assignment){
		if((strlen($assignment['title']) > 2) AND $assignment['contentHandler'] != "resource/x-bb-folder" ){
			echo "<h6>".$assignment['title']."</h6><p>".$assignment['description']."</p>"; 
		}
	}
	}

?>
</section>
</div>
<div class="row">
<section id="classdocs"> 
 <div class="page-header"> 
    <h5>Class Documents</h5> 
  </div> 
  
	<?php 
	foreach($courses as $course){
		 $this_course_id = $course['externalId'];
	foreach($course['content_groups'][1]['items'] as $document){
		
		if((strlen($document['title']) > 2) AND (is_string($document['description']))  ){
		echo "<h6>".$document['title']."</h6><p>".$document['description']."</p>"; 
		}
		
		if($document['contentHandler'] == "resource/x-bb-file"){
			$file = $blackboard->Content("getContentFiles", array('courseId' => $this_course_id , 'contentId'=>$document['id']));	
			echo "<h6>".$document['title']."</h6>"; 
			echo '<a href="https://bb9test.stedwards.edu/bbcswebdav/pid-27457-dt-content-rid-44153_1'.$file['strName'].'">Download</a><br />';	
			//echo "<pre>".print_r($document, true)."</pre><br />"; 
			//echo "<pre>".print_r($file, true)."</pre>"; 
			
			
		}
	}
	}

?>
</section>
</div>
<div class="row">
<section id="debug">
<pre>
<?php print_r($courses);?>

</pre>
</section>

</div>


<?php 

}else{
	echo "<div class=\"alert-message block-message warning\">Well this is a problem. The Blackboard server could not be reached. Try again later, we're working on this right now.</div>";
}
	
	
?>
</div>

</body>
</html>
