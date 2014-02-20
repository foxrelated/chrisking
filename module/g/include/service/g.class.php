<?php

/**
 * [PHPFOX_HEADER]
 */
defined('PHPFOX') or exit('No direct script access allowed.');

/**
 *
 *
 * @copyright		Konsort.org
 * @author  		James
 * @package 		G
 */
class G_Service_G extends Phpfox_Service {

	public function __construct()
	{
		
	}


	/**
	 * (d)isplay: Prints an array
	 *
	 * @param array $mInput Array to be printed
	 * @param boolean $bExit Stops script execution after printing and tracing
	 * @param string $sComments Echoed out above array
	 * @param boolean $bKillHtml HtmlEntities used
	 * @param int $iWriteToFile writes /g.html. If bExit is true, echo is suppressed.  $iWriteToFile values:
	 * 		1 = Append
	 * 		2 = New file
	 * 		3 = New file, only output $mInput (raw)
	 * @param boolean $bTrace generates a phpFox error when exiting
	 */
	public function d($mInput, $bExit = true, $sComments = '', $iLineNumber, $sFileName, $bKillHtml = false, $iWriteToFile = 0, $bTrace = false)
	{
		$sOutput = '<div style="text-align:left;font-family:monospace;padding:10px;background:#BBB;font-size:10pt;">DEBUG: Printing array(' . count($mInput) . ')';

		if (strpos($sFileName, 'module/'))
		{
			$sFileName = substr($sFileName, strpos($sFileName, 'module/'));
		}

		if ($bExit)
		{
			$sOutput .= ' and exiting.';
		}
		else
		{
			$sOutput .= '.';
		}
		$sOutput .= '<br><strong>&nbsp;&nbsp;&nbsp;&nbsp;' . $sComments . '</strong><br>';
		$sOutput .='From Line <strong>' . $iLineNumber . '</strong> of ' . dirname($sFileName) . '/<strong>' . basename($sFileName) . '</strong>' . '<pre>';

		if ($bKillHtml)
		{
			$sOutput .= htmlentities(print_r($mInput, true));
		}
		else
		{
			$sOutput .= print_r($mInput, true);
		}

		$sOutput .= '</pre></div>';

		if ($iWriteToFile)
		{
			if ($iWriteToFile == 1)
			{
				$hFile = fopen(PHPFOX_DIR . 'g.html', 'a') or die("can't open file");
			}
			else
			{
				$hFile = fopen(PHPFOX_DIR . 'g.html', 'w') or die("can't open file");
			}

			if ($iWriteToFile == 1 || $iWriteToFile == 2)
			{
				fwrite($hFile, $sOutput);
			}
			else if ($iWriteToFile == 3)
			{
				fwrite($hFile, $mInput);
			}

			fclose($hFile);
		}
		else
		{
			echo $sOutput;
		}

		if ($bExit)
		{
			if ($iWriteToFile)
			{
				echo $sOutput;
			}

			if ($bTrace)
			{
				Phpfox_ERROR::trigger($sComments);
			}
			exit;
		}
	}


	public function c($aArray, $bExit = false, $sComments = '')
	{
		if ($sComments)
		{
			echo '<script type="text/javascript">console.log("' . $sComments . '")</script>';
		}

		echo '<script>console.dir(' . $this->makeJavaScriptArray($aArray) . ')</script>';

		if ($bExit)
		{
			ob_flush();
			exit;
		}
	}


	public function makeJavaScriptArray($aPhpArray)
	{
		$sArrayConstant = '{';
		$sDelimiter = '';

		foreach ($aPhpArray as $sFieldName => $mFieldValue)
		{
			if (is_bool($mFieldValue))
			{
				if ($mFieldValue)
				{
					$mFieldConstant = 'true';
				}
				else
				{
					$mFieldConstant = 'false';
				}
			}
			else if (is_numeric($mFieldValue))
			{
				$mFieldConstant = $mFieldValue;
			}
			else if (is_string($mFieldValue))
			{
				$mFieldConstant = "'" . addSlashes($mFieldValue) . "'";
			}
			else if (is_array($mFieldValue))
			{
				$mFieldConstant = $this->makeJavaScriptArray($mFieldValue);
			}
			else
			{
				$mFieldConstant = '';
			}
			if ($mFieldConstant > '')
			{
				$sArrayConstant .= $sDelimiter . " '$sFieldName': $mFieldConstant";
				$sDelimiter = ',';
			}
		}
		return $sArrayConstant . '}';
	}


}

?>