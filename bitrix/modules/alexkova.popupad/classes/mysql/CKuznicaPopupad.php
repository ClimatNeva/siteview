<?
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/alexkova.popupad/classes/general/CKuznicaPopupadGeneral.php");
IncludeModuleLangFile(__FILE__);
class CKuznicaPopupad extends CKuznicaPopupadGeneral
{
    function GetList($arSort = Array("SORT"=>"ASC"),$arFilter=Array(),$arSelect = Array())
    {
        if(is_array($arSelect))
        {
            if(empty($arSelect))
                $arSelect = array("ID","NAME","ACTIVE","WEIGHT","SHOW_COUNT","SID","SHOW_TYPE");
        }
        else
            $arSelect = array("ID","NAME");

        if(!is_array($arSort) || empty($arSort))
            $arSort = array("SORT"=>"ASC");
        foreach($arSort as $order=>$by)
        {
            $order = $order." ".$by;
            break;
        }

        $selectFields = implode(",", $arSelect);

        if(is_array($arFilter) && count($arFilter)>0)
        {
            foreach ($arFilter as $colName => $colValue)
            {
                if(substr($colName, 0, 1) == "!")
                {
                    $eq = "<>";
                    $colName = str_replace("!", "", $colName);
                }
                else
                    $eq = "=";
                $whereFields[]= "$colName $eq '$colValue'";
            }
            if(count($whereFields)>0)
                $where = implode(" AND ", $whereFields);
        }
        $sql = "SELECT $selectFields FROM kznc_popupad_banner";
        if(strlen($where)>0)
            $sql .= " WHERE $where";
        if(strlen($order)>0)
            $sql .= " ORDER BY $order";
        global $DB;
        return $DB->Query($sql,false);

    }

    function GetByID($ID)
    {
        $ID = intval($ID);
        if($ID>0)
        {
            $sql = "
				SELECT
					ID,NAME,ACTIVE,SHOW_FROM,SHOW_TO, IMAGE_ID, URL, SHOW_TYPE, WEIGHT,
					CODE,CODE_TYPE, FLASH_TRANSPARENT, SHOW_ON, SHOW_OFF, SID, INFO, SHOW_COUNT
				FROM kznc_popupad_banner WHERE ID=".$ID
            ;
            global $DB;
            return $DB->Query($sql,false);
        }
    }

    function Add(&$arFields)
    {
        global $DB;

        if(!$this->CheckFields($arFields))
        {
            return false;
        }
        else
        {
            if($arFields["SHOW_TYPE"] != "html")
                $arFields["IMAGE_ID"] = $this->SaveFile($arFields["IMAGE_ID"]);
            $this->SetLeftCount($arFields);
            return $ID = $DB->Add("kznc_popupad_banner",$arFields);
        }
    }

    function Update($ID,$arFields)
    {
        global $DB;
        $ID = intval($ID);
        if(!$this->CheckFields($arFields,$ID))
            return false;
        else
        {
            switch ($arFields["SHOW_TYPE"])
            {
                case "html":
                    $arFields["URL"] = "";
                    $arFields["FLASH_TRANSPARENT"] = "";
                    $arFields["IMAGE_ID"]["del"] = "Y";
                    $arFields["IMAGE_ID"] = $this->SaveFile($arFields["IMAGE_ID"],$ID);
                    break;
                case "flash":
                case "image":
                    $arFields["CODE"] = "";
                    $arFields["IMAGE_ID"] = $this->SaveFile($arFields["IMAGE_ID"],$ID);
                    break;
                default :
                    break;
            }
            $this->SetLeftCount($arFields,$ID);
            $strUpdate = $DB->PrepareUpdate("kznc_popupad_banner", $arFields);
            if($strUpdate!="")
            {
                $strSql = "UPDATE kznc_popupad_banner SET ".$strUpdate." WHERE ID=".$ID;
                $DB->Query($strSql, false, "File: ".__FILE__."<br>Line: ".__LINE__);
            }
            return true;
        }
    }
    function SetActive($ID,$value ='Y')
    {
        global $DB;
        if(intval($ID)>0)
            $strSql = "UPDATE kznc_popupad_banner SET ACTIVE='{$value}' WHERE ID='{$ID}'";
        if($DB->Query($strSql, false, "File: ".__FILE__."<br>Line: ".__LINE__))
            return true;
    }

    function Delete($ID)
    {
        global $DB,$strError;
        $ID = intval($ID);
        if($ID>0)
        {
            $sql = "SELECT ID,IMAGE_ID FROM kznc_popupad_banner WHERE ID = '$ID'";
            $rsBanner = $DB->Query($sql, false, "File: ".__FILE__."<br/>Line:".__LINE__);
            if ($arBanner = $rsBanner->Fetch())
            {
                if($arBanner["IMAGE_ID"]>0)
                    CFile::Delete($arBanner["IMAGE_ID"]);
                $strSql = "DELETE FROM kznc_popupad_banner WHERE ID = '{$arBanner["ID"]}'";
                $DB->Query($strSql, false, "File: ".__FILE__."<br>Line: ".__LINE__);
                return true;
            }
        }
        return false;

    }

    function GetKoef($ID=0)
    {
        $k=0;
        global $DB;
        $sql = "
			SELECT ID,WEIGHT,LEFT_COUNT FROM kznc_popupad_banner
			WHERE ACTIVE='Y'
			AND (SHOW_FROM < NOW() OR SHOW_FROM IS NULL)
			AND (SHOW_TO>NOW() OR SHOW_TO IS NULL)
			AND (SHOW_FIRST>UNIX_TIMESTAMP(SHOW_FROM) OR SHOW_FROM IS NULL)
		";
        if($ID>0)
            $sql .= " AND ID !='$ID'";
        $res = $DB->Query($sql,false,"<b>Error in </b><br/>File: ".__FILE__."<br/>Line: ".__LINE__."<br/>");
        $sum_weight = 0;
        $sum_left_count = 0;
        while($ar_res = $res->Fetch())
        {
            $sum_weight += $ar_res["WEIGHT"];
            $sum_left_count += $ar_res["LEFT_COUNT"];
        }
        if($sum_weight == 0 || $sum_left_count == 0)
            $k=1;
        else
            $k = $sum_left_count/$sum_weight;
        return $k;
    }
    function SetLeftCount(&$arFields,$ID=0)
    {
        $k = $this->GetKoef($ID);
        $arFields["LEFT_COUNT"] = round($k*$arFields["WEIGHT"]);
        $arFields["SHOW_FIRST"] = time();
    }
    function UpdateLeftCount($ID,$value)
    {
        $value = intval($value);
        global $DB;
        $sql = "UPDATE kznc_popupad_banner SET LEFT_COUNT=$value, SHOW_FIRST=UNIX_TIMESTAMP(NOW()) WHERE ID='$ID'";
        if($res = $DB->Query($sql,false,"<b>Error in </b><br/>File: ".__FILE__."<br/>Line: ".__LINE__."<br/>"))
            return true;
        else
            return false;
    }
    function GetBannersList($limit = 0)
    {
        global $APPLICATION,$DB;
        $limit= intval($limit);
        $sql = "
			SELECT A.*,UNIX_TIMESTAMP(A.SHOW_FROM)as SHOW_FROM_X
			FROM kznc_popupad_banner A
			WHERE A.ACTIVE='Y'
				AND (A.SHOW_FROM < NOW() OR A.SHOW_FROM IS NULL)
				AND (A.SHOW_TO > NOW() OR A.SHOW_TO IS NULL)
				AND A.SID LIKE '%".SITE_ID."%'
			";
        if($limit>0)
            $sql .=" LIMIT $limit ";
        $res = $DB->Query($sql,false,"<b>Error in </b><br/>File: ".__FILE__."<br/>Line: ".__LINE__."<br/>");
        return $res;
    }
    function OnPrologHandler()
    {
        $_SESSION["POPUPAD"]["BANNERS"] = array();

    }

    function BannerEpilogStart(){
        global $APPLICATION;
        if(
            isset($_SERVER['HTTP_X_REQUESTED_WITH'])
            && !empty($_SERVER['HTTP_X_REQUESTED_WITH'])
            && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
            || $_REQUEST["PULL_AJAX_CALL"] == "Y"
            || $_REQUEST["ajax"] == "y"
        )
        {
            return false;
        }

        if (!CModule::IncludeModule('alexkova.popupad'))
            return false;
        if(defined("ADMIN_SECTION") && ADMIN_SECTION == true)
            return false;

        $POPUP_HIDE_FANCY = COption::GetOptionString(self::MODULE_ID, "POPUP_HIDE_FANCY", '');
        $POPUP_HIDE_ICON = COption::GetOptionString(self::MODULE_ID, "POPUP_HIDE_ICON", '');
        if($POPUP_HIDE_FANCY == "Y" && $POPUP_HIDE_ICON == "Y")
            return false;

        $POPUP_VERSION_2_ON = COption::GetOptionString(self::MODULE_ID, "POPUP_VERSION_2_ON", '1');
        if($POPUP_VERSION_2_ON)
        {
            $APPLICATION->IncludeComponent(
                "kuznica:banner.popup",
                "icons",
                Array("ONLY_INIT" => "Y"),
                false,
                array("HIDE_ICONS" => "Y")
            );
            $scriptPath = "/bitrix/js/".self::MODULE_ID."/run_popup.js";
            $GLOBALS["APPLICATION"]->AddHeadString('<script src="'.$scriptPath.'"></script>');
        }
        else
        {
            $APPLICATION->IncludeComponent(
                "kuznica:banner.popup",
                "icons",
                Array(),
                false,
                array("HIDE_ICONS" => "Y")
            );
        }
    }
}
?>