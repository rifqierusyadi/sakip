<script>
$(function () {
$('.select2').select2();
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
});
});

</script>
<script type="text/javascript">
//$('input#nilai').number(true);
//$('input#total').number(true);
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
			$('.select2').select2();
        }
    });
	
    $(wrapper).on('click', '.remove-button', function(e){ //Once remove button is clicked
        e.preventDefault();
        $(this).closest('.child').remove(); //Remove field html
		//$(wrapper).find('.parent').remove();
        x--; //Decrement field counter
    });
});


$("#periode_id").change(function(){
var periode_id = $("#periode_id").val();
if(periode_id){
$.ajax({
type: "POST",
async: false,
url : "<?php echo site_url('sopd/program/get_tahun')?>",
data: {
'periode_id': periode_id,
'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
},
success: function(msg){
$('#tahun').html(msg);
}
});
}
});

$("#total").focus(function() {
    var arr = document.getElementsByName('nilai[]');
    var tot=0;
	var sum=0;
    for(var i=0;i<arr.length;i++){
        if(parseInt(arr[i].value))
			//sum[i] = arr[i].replace(/,/g , '');
			tot += parseInt(arr[i].value);
    }
	console.log(tot);
	//$('#total').val(tot);
	//document.getElementsByName('total').value = tot;
	$('#total').val(tot);
});
</script>

<script id="hidden-template" type="text/x-custom-template">
<div class="child">
<div class="row">
	<div class="col-md-2">
		<div class="form-group <?php echo form_error('rekening') ? 'has-error' : null; ?>">
			<?php
			echo form_label('Kode Rekening','rekening');
			$data = array('class'=>'form-control','name'=>'rekening[]','id'=>'rekening','type'=>'text','value'=>set_value('rekening'));
			echo form_input($data);
			echo form_error('rekening') ? form_error('rekening', '<p class="help-block">','</p>') : '';
			?>
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group <?php echo form_error('kegiatan') ? 'has-error' : null; ?>">
			<?php
			echo form_label('Kegiatan','kegiatan');
			$data = array('class'=>'form-control','name'=>'kegiatan[]','id'=>'kegiatan','type'=>'text','value'=>set_value('kegiatan'));
			echo form_input($data);
			echo form_error('kegiatan') ? form_error('kegiatan', '<p class="help-block">','</p>') : '';
			?>
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group <?php echo form_error('tahun') ? 'has-error' : null; ?>">
			<?php
			echo form_label('Penanggung Jawab Kegiatan','tahun');
			$selected = set_value('tahun', $record->periode_id);
			echo form_dropdown('tahun', $jabatan, $selected, "class='form-control select2' name='tahun' id='tahun'");
			echo form_error('tahun') ? form_error('tahun', '<p class="help-block">','</p>') : '';
			?>
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group <?php echo form_error('nilai') ? 'has-error' : null; ?>">
			<?php
				echo form_label('Nilai Kegiatan','nilai');
			?>
			
			<div class="input-group input-group">  
			<?php
			$data = array('class'=>'form-control','name'=>'nilai[]','id'=>'nilai','type'=>'text','value'=>set_value('nilai'));
			echo form_input($data);
			?>
			<div class="input-group-btn">
			<button class="btn btn-danger btn-flat remove-button" type="button"><i class="fa fa-minus"></i></button>
			</div>
			</div>
			<?php
			echo form_error('nilai') ? form_error('nilai', '<p class="help-block">','</p>') : '';
			?>
		</div>
	</div>
</div>
</div>
</script>
</script>
