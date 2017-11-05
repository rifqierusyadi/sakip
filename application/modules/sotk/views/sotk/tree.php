<div class="row">
	<div class="col-md-12">
		<div id="message"></div>
		<div class="box box-success box-solid">
			<div class="box-header with-border">
				<h3 class="box-title"><?= isset($head) ? $head : ''; ?></h3>
				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
					<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
				</div>
			</div>
			<!-- box-body -->
			<div class="box-body">
				<div class="row">
					<div class="col-md-12">
						<?php echo get_ol($satker); ?>
					</div>
				</div>
			</div>
			<!-- ./box-body -->
		</div>
	</div>
</div>
<?php

function get_ol($array, $child = FALSE)
{
    $str = '';
	
    if(count($array)){
        $str .= $child == FALSE ? '<ul class="sortable">' : '<ul>';
        foreach($array as $item){
            $str .= '<li id="item_'.$item['id'].'">';
            $str .= '<div>'. $item['satker'] .'</div>';
            
            if(isset($item['children']) && count($item['children'])){
                $str .= get_ol($item['children'], TRUE);
            }
            
            $str .= '</li>' . PHP_EOL;
        }
        
        $str .= '</ul>' . PHP_EOL;
    }else{
        $str = '<ul class="sortable">';
        $str .= $child == FALSE ? '<li>' :'';
        $str .= $child == FALSE ? '<div>Beranda</div>' : '';
        $str .= $child == FALSE ? '<hr>' : '';
        $str .= '</ul>';
    }
    
    return $str;
}

?>