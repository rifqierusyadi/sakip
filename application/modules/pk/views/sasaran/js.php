<script>
$(function () {
$('.select2').select2();
});

tinymce.init({
selector:'textarea',
plugins: "fullscreen, table, image",
setup: function (editor) {
editor.on('change', function () {
tinymce.triggerSave();
});
}
});

var key = $("#key").text();
var table;

$(function () {
var process = window.location.href+'/ajax_list';
table = $('#tableIDX').DataTable({
processing:true,
serverSide:true,
ajax:{
url: process,
type: "POST",
data : {tokensys:key}
},
paging: true,
lengthChange: false,
searching: true,
ordering: true,
info: true,
autoWidth: true,
language: {
lengthMenu: "Tampilkan _MENU_ Baris",
zeroRecords: "Maaf - Data Tidak Ditemukan",
info: "Lihat Halaman _PAGE_ Dari _PAGES_",
infoEmpty: "Tidak Ada Data Tersedia",
infoFiltered: "(filtered from _MAX_ total records)",
paginate: {
first:"Awal",
last:"Akhir",
next:"Lanjut",
previous:"Sebelum"
},
search:"Pencarian:",
},
responsive: true,
"order": [[ 0, 'asc' ]],
columnDefs: [
	{
	targets:[ 1], visible: false, className: 'never',
	}
],
drawCallback: function ( settings ) {
	var api = this.api();
	var rows = api.rows( {page:'current'} ).nodes();
	var last=null;
	api.column(1, {page:'current'} ).data().each( function ( visi, i ) {
		if ( last !== visi ) {
			$(rows).eq( i ).before(
			'<tr class="bg-light-blue color-palette disabled" ><td colspan="7"><b>'+visi+'</b></td></tr>'
			);
			last = visi;
		}
	});
},

});
});


$("#periode_id").change(function(){
var periode_id = $("#periode_id").val();
if(periode_id){
$.ajax({
type: "POST",
async: false,
url : "<?php echo site_url('rpjmd/sasaran/get_visi')?>",
data: {
'periode_id': periode_id,
'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
},
success: function(msg){
$('#visi_id').html(msg);
}
});
}
});

$("#visi_id").change(function(){
var periode_id = $("#periode_id").val();
var visi_id = $("#visi_id").val();
if(visi_id){
$.ajax({
type: "POST",
async: false,
url : "<?php echo site_url('rpjmd/sasaran/get_misi')?>",
data: {
'periode_id': periode_id,
'visi_id': visi_id,
'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
},
success: function(msg){
$('#misi_id').html(msg);
}
});
}
});

$("#misi_id").change(function(){
var periode_id = $("#periode_id").val();
var visi_id = $("#visi_id").val();
var misi_id = $("#misi_id").val();
if(misi_id){
$.ajax({
type: "POST",
async: false,
url : "<?php echo site_url('rpjmd/sasaran/get_tujuan')?>",
data: {
'periode_id': periode_id,
'visi_id': visi_id,
'misi_id': misi_id,
'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
},
success: function(msg){
$('#tujuan').html(msg);
}
});
}
});

//ready
$("#periode_idx").ready(function(){
var periode_id = $("#periode_idx").val();
if(periode_id){
$.ajax({
type: "POST",
async: false,
url : "<?php echo site_url('rpjmd/sasaran/get_visi/'.$this->uri->segment(4)); ?>",
data: {
'periode_id': periode_id,
'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
},
success: function(msg){
$('#visi_id').html(msg);
}
});
}
});

$("#misi_idx").ready(function(){
var periode_id = $("#periode_id").val();
var visi_id = $("#visi_idx").val();
if(visi_id){
$.ajax({
type: "POST",
async: false,
url : "<?php echo site_url('rpjmd/sasaran/get_misi/'.$this->uri->segment(4))?>",
data: {
'periode_id': periode_id,
'visi_id': visi_id,
'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
},
success: function(msg){
$('#misi_id').html(msg);
}
});
}
});

$("#tujuan_idx").ready(function(){
var periode_id = $("#periode_id").val();
var visi_id = $("#visi_id").val();
var misi_id = $("#misi_id").val();
var tujuan_idx = $("#tujuan_idx").val();
if(tujuan_idx){
$.ajax({
type: "POST",
async: false,
url : "<?php echo site_url('rpjmd/sasaran/get_tujuan_edit/'.$this->uri->segment(4))?>",
data: {
'periode_id': periode_id,
'visi_id': visi_id,
'misi_id': misi_id,
'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
},
success: function(msg){
$('#tujuan_id').html(msg);
}
});
}
});
</script>
<script>
//function add button
$(function(){
	var maxField = 20; //Input fields increment limitation
    var addButton = $('.add-button'); //Add button selector
    var wrapper = $('.field-wrapper'); //Input field wrapper
	var fieldHTML = $('#hidden-template').html();
	
	var x = 1; //Initial field counter is 1
    $(addButton).click(function(){ //Once add button is clicked
        if(x < maxField){ //Check maximum number of input fields
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); // Add field html
        }
    });
	
    $(wrapper).on('click', '.remove-button', function(e){ //Once remove button is clicked
        e.preventDefault();
        $(this).closest('.child').remove(); //Remove field html
		//$(wrapper).find('.parent').remove();
        x--; //Decrement field counter
    });
});
</script>

<script id="hidden-template" type="text/x-custom-template">
	<div class="child">
	<div class="form-group <?php echo form_error('sasaran') ? 'has-error' : null; ?>">
		<div class="input-group input-group">  
		  <?php
		  $data = array('class'=>'form-control','name'=>'sasaran[]','id'=>'sasaran','type'=>'text','value'=>set_value('sasaran[]'));
		  echo form_input($data);
		  ?>
		  <div class="input-group-btn">
			<button class="btn btn-danger btn-flat remove-button" type="button"><i class="fa fa-minus"></i></button>
		  </div>
		</div>
		<?php
		  echo form_error('sasaran') ? form_error('sasaran', '<p class="help-block">','</p>') : '';
		?>
	</div>
	</div>
</script>