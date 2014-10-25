<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php $aContent = '// If this is a DVS (bOverrideOpenGraph is set), change the value of the following meta tags:
if (isset($this->_aVars[\'bOverrideOpenGraph\']))
{
	if ($sMeta == \'og:site_name\')
	{
		$sMetaValue = $oPhpfoxParseOutput->shorten($oPhpfoxParseOutput->clean($this->_aVars[\'aDvs\'][\'phrase_overrides\'][(empty($this->_aVars[\'aOverrideVideo\']) ? \'override_open_graph_site_name_meta\' : \'override_open_graph_site_name_meta_video_specified\')]), Phpfox::getParam(\'core.meta_description_limit\'));
	}

	if ($sMeta == \'og:title\')
	{
		$sMetaValue = $oPhpfoxParseOutput->shorten($oPhpfoxParseOutput->clean($this->_aVars[\'aDvs\'][\'phrase_overrides\'][(empty($this->_aVars[\'aOverrideVideo\']) ? \'override_open_graph_title_meta\' : \'override_open_graph_title_meta_video_specified\')]), Phpfox::getParam(\'core.meta_description_limit\'));
	}

	if ($sMeta == \'og:description\')
	{
		$sMetaValue = $oPhpfoxParseOutput->shorten($oPhpfoxParseOutput->clean($this->_aVars[\'aDvs\'][\'phrase_overrides\'][(empty($this->_aVars[\'aOverrideVideo\']) ? \'override_open_graph_description_meta\' : \'override_open_graph_description_meta_video_specified\')]), Phpfox::getParam(\'core.meta_description_limit\'));
	}
} '; ?>