<?php 

function html_page_start()
{
	echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
	echo '<html xmlns="http://www.w3.org/1999/xhtml">';
}

function html_header($title)
{
	echo '<head>';
		echo '<meta charset="utf-8">';
		echo '<meta http-equiv="X-UA-Compatible" content="IE=edge">';
		echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
		echo '<meta name="description" content="">';
		echo '<meta name="author" content="">';
		
		
		
		echo '<title>'.$title.'</title>';
		
		
		foreach($GLOBALS['css'] as $key => $value)
		{
			echo "<link rel='stylesheet' href='" . $value['source'] . "' media='" . $value['media'] . "' type='text/css' />";
		}
		
		//ie fixes
		echo <<<EOF
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
<![endif]-->
EOF;
		
		echo '<style>.main-content {margin-top: 60px;}</style>';
		
		if(is_array($GLOBALS['js_external']))
		{
			foreach($GLOBALS['js_external'] as $value) 
			{
				echo "<script src='".$value."'></script>\r\n";
			}
		}
		
		foreach($GLOBALS['js'] as $value)
		{
			echo "<script src='".$value."'></script>\r\n";
		}
		
	echo '</head>';
}

function html_body($content)
{
	echo <<<EOF
<body>
	<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<div class="navbar-brand" >
					<a href="http://wheelstvnetwork.com/" >
						<img src="/vseo/wheelstv-b2b-logo.png" style="height: 40px; margin-top: -10px;" class="img-rounded"/>
					</a>
					<a style="color: white;" href="./"> VSEO Tool </a>
				</div>
			</div>
			<div class="collapse navbar-collapse">
				<ul class="nav navbar-nav">
					<!-- 
					<li class="active"><a href="#">Home</a></li>
					<li><a href="#about">About</a></li>
					<li><a href="#contact">Contact</a></li>
					--> 
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="http://www.jamesjnadeau.com/">by James Nadeau</a></li>
				</ul>
			</div>
		</div>
	</div>
	
	<div class="container">
		<div class="main-content">
			$content
		</div>
	</div><!-- /.container -->
	

	
</body>
EOF;
}

function html_page_end()
{
	echo '</html>';
}

function debug($output)
{
	$backtrace = debug_backtrace();
	echo '<pre>';
		echo '### DEBUG ###';
		echo 'this can be turned off in '.__FILE__ ."\r\n";
		echo 'line '.$backtrace[0]['line'].' '.$backtrace[0]['file']."\r\n";
		//echo print_r(, true)."\r\n";
		if($output != NULL)
			echo print_r($output, true);
		else
			echo 'NULL';
	echo '</pre>';
}
