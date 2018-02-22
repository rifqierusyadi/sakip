<script src="<?= base_url('asset/plugins/tableexport/jquery.min.js'); ?>"></script>
<script src="<?= base_url('asset/plugins/jQuery/jquery-2.2.3.min.js'); ?>"></script>
<script src="<?= base_url('asset/bootstrap/js/bootstrap.min.js'); ?>"></script>
<script src="<?= base_url('asset/plugins/datatables/jquery.dataTables.min.js'); ?>"></script>
<script src="<?= base_url('asset/plugins/datatables/dataTables.bootstrap.min.js'); ?>"></script>
<script src="<?= base_url('asset/plugins/tableexport/js-xlsx/xlsx.core.min.js'); ?>"></script>
<script src="<?= base_url('asset/plugins/tableexport/Blob.js'); ?>"></script>
<script src="<?= base_url('asset/plugins/tableexport/FileSaver.min.js'); ?>"></script>
<script src="<?= base_url('asset/plugins/tableexport/dist/js/tableexport.js'); ?>"></script>
<script src="<?= base_url('asset/plugins/pace/pace.min.js'); ?>"></script>
<script src="<?= base_url('asset/plugins/select2/select2.full.min.js'); ?>"></script>
<!-- PRIMITIVE DIAGRAM -->
<script src="<?php echo base_url('asset/primitives/js/jquery/jquery-ui-1.10.2.custom.min.js'); ?>"></script>
<script src="<?php echo base_url('asset/primitives/js/primitives.min.js'); ?>"></script>
<script src="<?php echo base_url('asset/primitives/js/pdfkit/pdfkit.js'); ?>"></script>
<script src="<?php echo base_url('asset/primitives/js/pdfkit/blob-stream.js'); ?>"></script>
<script src="<?php echo base_url('asset/primitives/FileSaver.js/FileSaver.min.js'); ?>"></script>
<script type="text/javascript">
$(function () {
$('.select2').select2();

e = $("#tableID").tableExport({
        bootstrap: true,
        formats: ["xlsx"],
        position: "bottom",
        fileName: "POHON-<?php echo date('dmy'); ?>",
    });

$('#tableID').DataTable({
    "paging": false,
    "searching": false,
    "ordering": false,
    "info": false,
    "autoWidth": true,
    "responsive" :true
});
});

$("#filter").on('click', function(){
	var periode = $("#periode").val();
	var satker = $("#satker").val();
	var options = new primitives.orgdiagram.Config();	
	if(periode){
		window.location.href = "<?= site_url('laporan/pohon/result/'); ?>"+periode+'/'+satker;
	}else{
		alert('Silahkan Periode Terlebih Dahulu');
	}
});

//<![CDATA[
$(window).load(function () {
	var options = new primitives.orgdiagram.Config();	
	<?php if($record): ?>
	var items = [
		<?php foreach($record as $row): ?>
	        new primitives.orgdiagram.ItemConfig({
			id: '<?php echo $row->id; ?>',
			parent: '<?php echo $row->parent_id; ?>',
			title: "KINERJA UTAMA",
			sasaran: "<?php echo $row->sasaran; ?>",
			indikator: "<?php if($data = pohon_indikator($row->sasaran_id)){
				foreach($data as $x){
					echo ucwords(strtolower($x->indikator));
					echo '; ';
				}
			}  ?>",
			image: null,
	        templateName: "Template1"
		}),
		<?php endforeach; ?>
	];
	<?php else: ?>
	    var items = [];
	<?php endif; ?>

	options.items = items;
	options.cursorItem = 0;
	options.templates = [getTemplate()];
	options.onItemRender = onTemplateRender;
	options.hasSelectorCheckbox = primitives.common.Enabled.False;
	options.pageFitMode = primitives.common.PageFitMode.None;
	options.childrenPlacementType = primitives.common.ChildrenPlacementType.Horizontal;
	options.leavesPlacementType = primitives.common.ChildrenPlacementType.Vertical;
	// options.normalItemsInterval= 10;
	// options.normalLevelShift=10;
	// options.dotLevelShift=10;
	// options.lineLevelShift=10;
	options.graphicsType= primitives.common.GraphicsType.Canvas;
	options.scale= 1.0;
	options.navigationMode= primitives.common.NavigationMode.Inactive,
	jQuery("#basicdiagram").orgDiagram(options);

	function onTemplateRender(event, data) {
		switch (data.renderingMode) {
			case primitives.common.RenderingMode.Create:
				/* Initialize widgets here */
				break;
			case primitives.common.RenderingMode.Update:
				/* Update widgets here */
				break;
		}

		var itemConfig = data.context;

		if (data.templateName == "Template1") {
			data.element.find("[name=photo]").attr({ "src": itemConfig.image, "alt": itemConfig.title });
			data.element.find("[name=titleBackground]").css({ "background": itemConfig.itemTitleColor });

			var fields = ["title", "sasaran","indikator", "image"];
			for (var index = 0; index < fields.length; index++) {
				var field = fields[index];

				var element = data.element.find("[name=" + field + "]");
				if (element.text() != itemConfig[field]) {
					element.text(itemConfig[field]);
				}
			}
		} 
	}

	function getTemplate() {
		var result = new primitives.orgdiagram.TemplateConfig();
		result.name = "Template1";
		result.itemSize = new primitives.common.Size(300, 180);
		result.minimizedItemSize = new primitives.common.Size(3, 3);
		result.highlightPadding = new primitives.common.Thickness(3, 3, 3, 3);


		var itemTemplate = jQuery(
		  '<div class="bp-item bp-corner-all bt-item-frame">' + '<div name="title" class="bp-item" style="text-align:center; top: 10px; left: 10px; right: 10px; font-size: 13px;"></div>'
			+ '<div name="sasaran" class="bp-item" style="text-align:left; top: 40px; left: 10px; right: 10px; font-size: 11px;"></div>' + '<div name="indikator" class="bp-item" style="text-align:left; top: 115px; left: 10px; right: 10px; font-size: 11px;"></div>'
		+ '</div>'
		).css({
			width: result.itemSize.width + "px",
			height: result.itemSize.height + "px"
		}).addClass("bp-item bp-corner-all bt-item-frame");
		result.itemTemplate = itemTemplate.wrap('<div>').parent().html();
		return result;
	}
});//]]>
</script>
