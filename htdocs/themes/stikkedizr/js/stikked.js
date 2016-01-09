var ST = window.ST || {};

ST.init = function() {
	ST.show_embed();
};

ST.show_embed = function() {
	$embed_field = $('#embed_field');
    var lang_showcode = $embed_field.data('lang-showcode');
	$embed_field.hide();
	$embed_field.after('<a id="show_code" href="#">' + lang_showcode + '</a>');
	$('#show_code').on('click', function(e) {
		e.preventDefault();
		$(this).hide();
		$embed_field.show().select();
	});
	$embed_field.on("blur", function() {
		$(this).hide();
		$('#show_code').show();
	});
};

var ACE = {
	init: function () {
		modes = $.parseJSON($('#ace_modes').text());
		modeslist = ace.require('ace/ext/modelist');
	
		var editor = ace.edit("Editor");
		

		editor.setTheme("ace/theme/Dawn");
	    editor.setAutoScrollEditorIntoView(true);
	    editor.getSession().setUseWrapMode(true);
	    editor.setOption("maxLines", 25);
	    editor.setOption("minLines", 20);
	    editor.setOptions({fontSize :"13pt"});
	
		$('#lang').change(function() {
				set_language();
		});
		
		var input = $('#codeBox');
		//input.hide();

    	$('#pasteForm').submit(function() {
    		input.val(editor.getValue());
    	})

		set_syntax = function(mode) {
			editor.session.setMode("ace/mode/"+mode);
		};

		check = function(mode) {
			if (modeslist.modesByName[mode] == undefined) {
				console.log(mode + " doesn't exist!!");
				return 0;
			}
			return 1;
		}
	
		set_language = function() {
			var lang = $('#lang').val();
			mode = modes[lang];
			if (check(mode)) set_syntax(mode);
			else set_syntax("text");
		};
	
		set_language();
	}
};

$(document).ready(function() {
	ST.init();
	ACE.init();
});
