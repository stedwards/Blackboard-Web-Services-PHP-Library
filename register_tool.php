<?php
/*
 * BbPHP: Blackboard Web Services Library for PHP
 * Copyright (C) 2011 by St. Edward's University (www.stedwards.edu)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 */ 
 /*Note: ************************************************************************************************ 
 * 	You need to have a registered tool in place before running any BlackBoard connection scripts.       *
 *  Run this first. Enter your Proxy-Tool information here. You will need administrator access to the   *
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
$server = "http://YOUR.SERVER.NAME";
//Init the Blackboard object
$blackboard = new BbPhp($server);
echo "An initial blackboard object. <br />";
var_dump($blackboard);

$results = $blackboard->Context("registerTool",
	array(
		"clientVendorId"=>'VENDORNAME', 
		'clientProgramId'=>'CLIENTNAME',
		'registrationPassword'=>"PASSWORD",
		"description"=>"Example Tool Registration",
		"initialSharedSecret"=>"SECRET", 
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
				"Course.WS:updateOrg",
				"Announcement.WS:getCourseAnnouncements",
				"Announcement.WS:getOrgAnnouncements",
				"Announcement.WS:getSystemAnnouncements",
				"Announcement.WS:initializeAnnouncementWS",
				"Announcement.WS:createCourseAnnouncements",
				"Announcement.WS:createOrgAnnouncements",
				"Announcement.WS:createSystemAnnouncements",
				"Announcement.WS:updateCourseAnnouncements",
				"Announcement.WS:updateOrgAnnouncements",
				"Announcement.WS:updateSystemAnnouncements",
				"Announcement.WS:getServerVersion",
				"Gradebook.WS:getAttempts",
				"Gradebook.WS:getGradebookColumns",
				"Gradebook.WS:getGradebookTypes",
				"Gradebook.WS:getGrades",
				"Gradebook.WS:getGradingSchemas",
				"Gradebook.WS:getRequiredEntitlements",
				"Gradebook.WS:getServerVersion",
				"Gradebook.WS:initializeGradebookWS",
				"Gradebook.WS:saveAttempts",
				"Gradebook.WS:saveColumns",
				"Gradebook.WS:saveGradebookTypes",
				"Gradebook.WS:saveGrades",
				"Gradebook.WS:saveGradingSchemas",
				"CourseMembership.WS:getCourseMembership",
				"CourseMembership.WS:getCourseRoles",
				"CourseMembership.WS:getGroupMembership",
				"CourseMembership.WS:getServerVersion",
				"CourseMembership.WS:initializeCourseMembershipWS",
				"Content.WS:addContentFile",
				"Content.WS:updateContentFileLinkName",
				"Content.WS:getContentFiles",
				"Content.WS:getFilteredContent",
				"Content.WS:getReviewStatusByCourseId",
				"Content.WS:getFilteredCourseStatus",
				"Content.WS:getLinksByReferrerType",
				"Content.WS:getLinksByReferredToType",
				"Content.WS:getTOCsByCourseId",
				"Content.WS:initializeContentWS",
				"Content.WS:initializeVersion2ContentWS",
				"Content.WS:getRequiredEntitlements",
				"Content.WS:saveContent",
				"Content.WS:saveCourseTOC",
				"Content.WS:saveContentsReviewed",
				"NotificationDistributorOperations.WS:getServerVersion",
				"NotificationDistributorOperations.WS:initializeNotificationDistributorOperationsWS",
				"NotificationDistributorOperations.WS:setDistributorAvailabilityForUser",
				"NotificationDistributorOperations.WS:registerDistributorResults",
				"NotificationDistributorOperations.WS:",
				"User.WS:getServerVersion",
				"User.WS:initializeUserWS",
				"User.WS:saveUser",
				"User.WS:saveObserverAssociation",
				"User.WS:saveAddressBookEntry",
				"User.WS:getUser",
				"User.WS:getAddressBookEntry",
				"User.WS:getObservee",
				"User.WS:changeUserBatchUid",
				"User.WS:changeUserDataSourceId",
				"User.WS:getSystemRoles",
				"User.WS:getInstitutionRoles",
				"User.WS:getUserInstitutionRoles",
				"Calendar.WS:initializeCalendarWS",
				"Calendar.WS:createPersonalCalendarItem",
				"Calendar.WS:createCourseCalendarItem",
				"Calendar.WS:createInstitutionCalendarItem",
				"Calendar.WS:updatePersonalCalendarItem",
				"Calendar.WS:updateCourseCalendarItem",
				"Calendar.WS:updateInstitutionCalendarItem",
				"Calendar.WS:savePersonalCalendarItem",
				"Calendar.WS:saveCourseCalendarItem",
				"Calendar.WS:saveInstitutionCalendarItem",
				"Calendar.WS:getCalendarItem",
				"Calendar.WS:canUpdatePersonalCalendarItem",
				"Calendar.WS:canUpdateCourseCalendarItem",
				"Calendar.WS:canUpdateInstitutionCalendarItem",
				"Util.WS:initializeUtilWS",
				"Util.WS:getRequiredEntitlements",
				"Util.WS:checkEntitlement",
				"Util.WS:saveSetting",
				"Util.WS:loadSetting",
				"Util.WS:deleteSetting",
				"Util.WS:getDataSources")
)
);

var_dump($results);
?>
</body>
</html>
