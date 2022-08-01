<?

// Функция строкового представления массивов
function showVarDump($var,$level = 0,$rowsep = "\n") {
	$strsep = ($rowsep=="\n"?"\t":"<br>");
	$strOut = "";
	if (is_array($var)) {
		foreach ($var as $key=>$val) {
			$strOut .= $rowsep;
			for ($i=0;$i<$level;$i++) {
				$strOut .= $strsep;
			}
			$strOut .= strval($key);
			if (is_array($val)) {
				$strOut .= showVarDump($val, $level+1);
			} else {
				if (is_bool($val))
					$strOut .= ($val ? ' = true' : ' = false');
				else
					$strOut .= " => ".json_decode(json_encode($val),true);
			}
		}
	} else {
		if (is_bool($var))
			$strOut .= ($var ? ' = true' : ' = false');
		else
			$strOut .= " => ".(string)$var;
	}
	return $strOut;
}

// Функция сохранения переменной в файл для лога
function save2log($vars, $varName = 'undefined') {
	$log = fopen($_SERVER['DOCUMENT_ROOT'].'/file.log','a+');
	fwrite($log, "\n\n\n=========================\nNew record: ".date('d.m.Y H:i:s')."\nVar name: ".$varName."\n\n");
	fwrite($log, showVarDump($vars));
	fclose($log);
}

// Вспомогательная функция вывода на экран параметров и/или результатов компонентов
function showResult($showResult) {
	echo "<pre>",print_r($showResult),"</pre>";
}
