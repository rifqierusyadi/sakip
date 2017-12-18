<script src="<?php echo base_url(); ?>asset/plugins/tableexport/js-xlsx/xlsx.core.min.js"></script>
<script src="<?php echo base_url(); ?>asset/plugins/tableexport/Blob.js"></script>
<script src="<?php echo base_url(); ?>asset/plugins/tableexport/FileSaver.min.js"></script>
<script src="<?php echo base_url(); ?>asset/plugins/tableexport/dist/js/tableexport.js"></script>
<script src="<?php echo base_url(); ?>asset/plugins/tableexport/dist/js/tableexport.js"></script>
<script type="text/javascript">
com_github_culmat_jsTreeTable.register(this)
treeTable($('#tableIDX'))
</script>
<script>
$(function () {

e = $("#tableIDX").tableExport({
        bootstrap: true,
        formats: ["xlsx","txt"],
        position: "top",
        fileName: "PETA-<?php echo date('dmyyyy'); ?>",
    });

table = $('#tableIDX').DataTable({
    "paging": false,
    "searching": false,
    "ordering": false,
    "info": false,
    "autoWidth": true,
    "responsive" :true,
    "columnDefs":[{
        "searchable" : false,
        "orderable" : false,
        "targets" : 0
    },
    { "visible": 'false', "targets": 1 }],
    "drawCallback": function ( settings ) {
            var api = this.api();
            var rows = api.rows( {page:'current'} ).nodes();
            var last=null;
 
            api.column(1, {page:'current'} ).data().each( function ( group, i ) {
                if ( last !== group ) {
                    $(rows).eq( i ).before(
                        '<tr class="group" ><td colspan="11"><strong>'+group+'</strong></td></tr>'
                    );
                    last = group;
                }
            } );
        }
	});
});
</script>

<script type='text/javascript'>//<![CDATA[
$(window).load(function () {
	var options = new primitives.orgdiagram.Config();	
	<?php if($pohon): ?>
	var items = [
		<?php foreach($pohon as $row): ?>
	        new primitives.orgdiagram.ItemConfig({
			id: '<?php echo $row->id; ?>',
			parent: '<?php echo $row->parent_id; ?>',
			title: "Kinerja Utama",
			description: "<?php echo $row->sasaran; ?>",
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
	// options.pageFitMode = primitives.common.PageFitMode.None;
	// options.childrenPlacementType = primitives.common.ChildrenPlacementType.Horizontal;
	// options.leavesPlacementType = primitives.common.ChildrenPlacementType.Vertical;
	// options.normalItemsInterval= 10;
	// options.normalLevelShift=10;
	// options.dotLevelShift=10;
	// options.lineLevelShift=10;
	// options.graphicsType= primitives.common.GraphicsType.Canvas;
	// options.scale= 1.0;
	// options.navigationMode= primitives.common.NavigationMode.Inactive,
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

			var fields = ["title", "description","image"];
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
		result.itemSize = new primitives.common.Size(280, 120);
		result.minimizedItemSize = new primitives.common.Size(3, 3);
		result.highlightPadding = new primitives.common.Thickness(3, 3, 3, 3);


		var itemTemplate = jQuery(
		  '<div class="bp-item bp-corner-all bt-item-frame">' + '<div name="title" class="bp-item" style="text-align:center; top: 10px; left: 10px; right: 10px; font-size: 13px;"></div>'
			+ '<div name="description" class="bp-item" style="text-align:left; top: 30px; left: 10px; right: 10px; font-size: 11px;"></div>'
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