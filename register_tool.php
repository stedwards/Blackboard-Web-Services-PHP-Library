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

$results = $blackboard->registerTool("Context", 
										array(
											"clientVendorId"=>'aaron_proxy', 
											'clientProgramId'=>'example_tool',
											'registrationPassword'=>"hilltopper",
											"description"=>"Example Tool Registration",
											"initialSharedSecret"=>"MassiveNinjasEpicSlurpees", 
											"requiredToolMethods" => 
													array(
														"Context.WS:login", 
														"Context.WS:loginTool", 
														"Context.WS:emulateUser", 
														"Context.WS:extendSessionLife", 
														"Context.WS:getMemberships", 
														"Context.WS:getMyMemberships",
														"Context.WS:initialize",
														"Course.WS:changeCourseBatchUid",
														"Course.WS:changeCourseCategoryBatchUid",
														"Course.WS:changeCourseDataSourceId",
														"Course.WS:changeOrgBatchUid",
														"Course.WS:changeOrgCategoryBatchUid",
														"Course.WS:changeOrgDataSourceId",
														"Course.WS:createCourse",
														"Course.WS:createOrg",
														"Course.WS:deleteCartridge",
														"Course.WS:deleteCourse",
														"Course.WS:deleteCourseCategory",
														"Course.WS:deleteCourseCategoryMembership",
														"Course.WS:deleteGroup",
														"Course.WS:deleteOrg",
														"Course.WS:getAvailableGroupTools",
														"Course.WS:getCartridge",
														"Course.WS:getCategories",
														"Course.WS:getClassifications",
														"Course.WS:getCourse",
														"Course.WS:getCourseCategoryMembership",
														"Course.WS:getGroup",
														"Course.WS:getOrg",
														"Course.WS:getOrgCategoryMembership",
														"Course.WS:getServerVersion",
														"Course.WS:getStaffInfo",
														"Course.WS:initializeCourse",
														"Course.WS:saveCartridge",
														"Course.WS:saveCourse",
														"Course.WS:saveCourseCategory",
														"Course.WS:saveGroup",
														"Course.WS:saveOrgCategory",
														"Course.WS:saveOrgCategoryMembership",
														"Course.WS:saveStaffInfo",
														"Course.WS:setCourseBannerImage",
														"Course.WS:updateCourse",
														"Course.WS:updateOrg"
													)
										)
										);

var_dump($results);
?>
</body>
</html>
