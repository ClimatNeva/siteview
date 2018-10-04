<?
define("ADMIN_SECTION",false);
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
$bError = true;
if (CModule::IncludeModule("alexkova.rklite"))
{
	$ID = intval($ID);
	if($ID>0)
	{
		$rsBanner = CKuznica_rklite::GetByID($ID);
		if($arBanner = $rsBanner->Fetch())
		{
			$bError = false;
			$arINFO = unserialize(htmlspecialchars_decode($arBanner["INFO"]));
			if($arINFO["INC_CLICK_COUNT"] == "Y")
			{
				if($arINFO["BANNER_USHOW"] == "Y")
				{
					switch($arINFO["BANNER_USHOW_TYPE"])
					{
						case "S":
							$banSess = $USER->GetParam("RKLITE_CLICK_{$arBanner["ID"]}");
							if(!$banSess)
							{
								CKuznica_rklite::ChangeStat($arBanner["ID"],array("CLICK"=>1));
								$USER->SetParam("RKLITE_CLICK_{$arBanner["ID"]}",$arBanner["ID"]);
							}
							break;
						case "C":
							$banCookie = $APPLICATION->get_cookie("RKLITE_CLICK_{$arBanner["ID"]}");
							if(!$banCookie)
							{
								CKuznica_rklite::ChangeStat($arBanner["ID"],array("CLICK"=>1));
								$APPLICATION->set_cookie("RKLITE_CLICK_{$arBanner["ID"]}",$arBanner["ID"],time()+$arINFO["BANNER_USHOW_COOKIE_TIME"]);
							}
							break;
					}
				}
				else
					CKuznica_rklite::ChangeStat($arBanner["ID"],array("CLICK"=>1));
			}
			$ignoreSecurityOption = COption::GetOptionString("alexkova.rklite", "DONT_IGNORE_SECURITY","");
			$forceRedirectFlag = $ignoreSecurityOption == 'Y'?false:true;
			LocalRedirect($arBanner["URL"],$forceRedirectFlag);
			exit();
		}
	}
}
if($bError && $_REQUEST["backurl"])
{
	LocalRedirect($_REQUEST["backurl"]);
	exit();
}
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");
?>