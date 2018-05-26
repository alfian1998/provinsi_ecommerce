<!-- include summernote css/js-->
<link href="<?=base_url()?>assets/plugins/wysiwyg/summernote.css" rel="stylesheet">
<script src="<?=base_url()?>assets/plugins/wysiwyg/summernote.js"></script>
<script type="text/javascript">
$(function() {
	$('#product_desc').summernote({
	  height: 250,                 // set editor height
	  minHeight: null,             // set minimum height of editor
	  maxHeight: null,             // set maximum height of editor
	  toolbar: [
	    // [groupName, [list of button]]
	    ['style', ['bold', 'italic', 'underline']],
	    //['font', ['strikethrough', 'superscript']],
	    ['fontsize', ['fontsize']],
	    ['color', ['color']],
	    ['para', ['ul', 'ol', 'paragraph']],
	    ['table', ['table']],
    	['insert', ['link', 'picture', 'video', 'help']]
	  ]
	});
	$('.note-editor .modal').remove();
});
$(function() {
	$('#text').summernote({
	  height: 100,                 // set editor height
	  minHeight: null,             // set minimum height of editor
	  maxHeight: null,             // set maximum height of editor
	  toolbar: [
	    // [groupName, [list of button]]
	    ['style', ['bold', 'italic', 'underline']],
	    //['font', ['strikethrough', 'superscript']],
	    ['fontsize', ['fontsize']],
	    ['color', ['color']],
	    ['para', ['ul', 'ol', 'paragraph']],
	    ['table', ['table']],
    	['insert', ['link', 'picture', 'video', 'help']]
	  ]
	});
	$('.note-editor .modal').remove();
});
$(function() {
	$('#rincian_tindakan').summernote({
	  height: 180,                 // set editor height
	  minHeight: null,             // set minimum height of editor
	  maxHeight: null,             // set maximum height of editor
	  toolbar: [
	    // [groupName, [list of button]]
	    ['style', ['bold', 'italic', 'underline']],
	    //['font', ['strikethrough', 'superscript']],
	    ['fontsize', ['fontsize']],
	    ['color', ['color']],
	    ['para', ['ul', 'ol', 'paragraph']],
	    ['table', ['table']],
    	['insert', ['link', 'picture', 'video', 'help']]
	  ]
	});
	$('.note-editor .modal').remove();
});
$(function() {
	$('#saran_keterangan').summernote({
	  height: 100,                 // set editor height
	  minHeight: null,             // set minimum height of editor
	  maxHeight: null,             // set maximum height of editor
	  toolbar: [
	    // [groupName, [list of button]]
	    ['style', ['bold', 'italic', 'underline']],
	    //['font', ['strikethrough', 'superscript']],
	    ['fontsize', ['fontsize']],
	    ['color', ['color']],
	    ['para', ['ul', 'ol', 'paragraph']],
	    ['table', ['table']],
    	['insert', ['link', 'picture', 'video', 'help']]
	  ]
	});
	$('.note-editor .modal').remove();
});
</script>