<?php $this->load->view('defaults/header');

$seg3 = $this->uri->segment(3);

if($seg3 != 'diff'){
    $page_url = $url;
}else{
    $page_url = $url . '/diff';
}

if(isset($insert)){
	echo $insert;
}?>

<section>
	<div class="row">
		<div class="col-12 col-sm-12 col-lg-12">
			<div class="page-header">
				<h1 class="pagetitle right"><?php echo $title; ?></h1>
			</div>
			<div class="row">
				<div class="col-8 col-sm-12 col-lg-8">
					<div class="detail by"><?php echo lang('paste_from'); ?> <?php echo $name; ?>, <?php $p = explode(',', timespan($created, time())); echo sprintf($this->lang->line('paste_ago'),$p[0]); ?>, <?php echo lang('paste_writtenin'); ?> <?php echo $lang; ?>.</div>
				
					<div class="detail"><span class="item"><?php echo lang('paste_url'); ?> </span><a href="<?php echo $url; ?>"><?php echo $url; ?></a></div>
					<?php if(!empty($snipurl)){?>
						<div class="detail"><div class="item"><?php echo lang('paste_shorturl');?> </div><a href="<?php echo $snipurl; ?>"><?php echo htmlspecialchars($snipurl) ?></a></div>
					<?php }?>
					<div class="detail"><span class="item"><?php echo lang('paste_embed'); ?> </span><input data-lang-showcode="<?php echo lang('paste_showcode'); ?>" id="embed_field" type="text" value="<?php echo htmlspecialchars('<iframe src="' . site_url('view/embed/' . $pid) . '" style="border:none;width:100%;min-height:300px;"></iframe>'); ?>" /></div>

					<div class="detail">
<?php if($seg3 != 'diff'){ ?>
                    <a class="control" href="<?php echo site_url("view/download/".$pid); ?>"><?php echo lang('paste_download'); ?></a> <?php echo lang('paste_or'); ?> <a class="control" href="<?php echo site_url("view/raw/".$pid); ?>"><?php echo lang('paste_viewraw'); ?></a></div>
<?php }else{ ?>
                    <?php echo lang('paste_viewdiffs'); ?> <a href="<?php echo $inreply['url']?>"><?php echo $inreply['title']; ?></a> <?php echo lang('paste_and'); ?> <a href="<?php echo $url; ?>"><?php echo $title; ?></a>
<?php } ?>
				</div>
				<div class="col-4 col-sm-12 col-lg-4">
					<!--<img src="<?php echo site_url('view/qr/' . $pid ); ?>">-->
				</div>
			</div>
		</div>
	</div>
</section>

<section>
	<div class="row">
		<div class="col-12 col-sm-12 col-lg-12">
			<!--<blockquote style="padding:0px; border-left:0; font-size:14px">-->
				<pre id="pasteView" ace-mode="ace/mode/c_cpp" ace-theme="ace/theme/Dawn" data-readonly="true">
<?php echo $raw; ?>
				</pre>
			<!--</blockquote>-->
		</div>
	</div>
<script type="text/javascript">
var editor = ace.edit('pasteView');
editor.setReadOnly(true);
editor.setAutoScrollEditorIntoView(true);
editor.setOptions({fontSize :"11pt"});

set_language = function(mode) {
	editor.session.setMode("ace/mode/"+mode);
};

set_language("<?php echo $lang_code; ?>");

var cell = $("div.ace_gutter-cell");
var h = $('div.ace_gutter-cell').height();
var totalH = h * (editor.getSession().getValue().split('\n').length + 1);
console.log(h);
if(totalH < 300) {
	totalH = 300;
}
var oldHeight = $('#pasteView').height();
$('#pasteView').height(totalH);
editor.renderer.onResize(true);
</script>
</section>

<section>
<?php

function checkNum($num){
	return ($num%2) ? TRUE : FALSE;
}
?>


<?php $this->load->view('view/view_footer'); ?>
