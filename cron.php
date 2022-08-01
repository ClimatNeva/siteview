<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
?>

<?
COption::SetOptionString("main", "agents_use_crontab", "N"); 
echo COption::GetOptionString("main", "agents_use_crontab", "N"); 

COption::SetOptionString("main", "check_agents", "N"); 
echo COption::GetOptionString("main", "check_agents", "Y");
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>