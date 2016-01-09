<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
 	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php
$page_title = '';
if(isset($title))
{
    $page_title .= $title . ' - ';
}
$page_title .= $this->config->item('site_name');
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" style="height:100%;">
	<head>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<title><?php echo $page_title; ?></title>
<?php

//Carabiner
$this->carabiner->config(array(
    'script_dir' => 'static/js/', 
    'style_dir'  => 'static/styles/',
    'cache_dir'  => 'static/asset/',
    'base_uri'	 => base_url(),
    'combine'	 => true,
    'dev'		 => !$this->config->item('combine_assets'),
));

// CSS
//$this->carabiner->css('reset.css');
$this->carabiner->css('fonts.css');
$this->carabiner->css('main.css');
$this->carabiner->css('embed.css');

$this->carabiner->display('css');

?>
	<script type="text/javascript">
	//<![CDATA[
	var base_url = '<?php echo base_url(); ?>';
	//]]>
	</script>
	</head>
	<body style="height:100%;">

<?php

$this->carabiner->config(array(
    'script_dir' => 'themes/stikkedizr/js/',
    'style_dir'  => 'themes/stikkedizr/css/',
    'cache_dir'  => 'static/asset/',
    'base_uri'	 => base_url(),
    'combine'	 => true,
    'dev'		 => !$this->config->item('combine_assets'),
));
$this->carabiner->js('jquery.js');
$this->carabiner->js('bootstrap.min.js');
$this->carabiner->js('jquery.timers.js');
$this->carabiner->js('src/ace.js');
$this->carabiner->js('src/ext-modelist.js');

$this->carabiner->display('js');
?>
<div class="paste" style="height:100%;">
    <p><a href="<?php echo site_url('view/' . $pid); ?>" target="_blank">This paste</a> brought to you by <a href="<?php echo base_url(); ?>" target="_blank"><?php echo $this->config->item('site_name'); ?></a>. <a class="right" href="<?php echo site_url('view/' . $pid); ?>" target="_blank">View</a></p>
	<div class="text_formatted" style="height:100%;">
		<div class="container" style="height:100%;">
			<pre id="pasteView" ace-mode="ace/mode/c_cpp" ace-theme="ace/theme/Dawn" data-readonly="true" style="height:100%;">
<?php echo $raw; ?>
				</pre>
		</div>
	</div>
</div>

<script type="text/javascript">
var editor = ace.edit('pasteView');
editor.setReadOnly(true);
editor.setAutoScrollEditorIntoView(true);
//editor.setOption("minLines", <?php echo substr_count( $raw, "\n" )+1; ?>);
editor.setOptions({fontSize :"10pt"});

set_language = function(mode) {
	editor.session.setMode("ace/mode/"+mode);
};

set_language("<?php echo $lang_code; ?>");
</script>

<?php

//stats
$this->load->view('defaults/stats');

?>
<script>
</script>
	</body>
</html>
