<?php
add_action('wp_ajax_addfield_call','get_dimensions');
function get_dimensions()
{
	if(isset($_POST['editorid']) && !empty($_POST['editorid']))
	{
		//$editor_id = generateRandomString();
		//$editor_id = $editor_id.'_'.$_POST['editorid'];
		$order = '<a href="javascript:" class="order_anch up" data-order="up" onclick="orderchange(this)"></a>
        		  <a href="javascript:" class="order_anch" data-order="down" onclick="orderchange(this)"></a>';
		$count = $_POST['count'];
	}
	else
	{
		//$editor_id = generateRandomString();
		$order = '<a href="javascript:" class="order_anch" data-order="up" onclick="orderchange(this)"></a>
        		  <a href="javascript:" class="order_anch" data-order="down" onclick="orderchange(this)"></a>';
		$count = 1;
	}
	?>
    	<div class="gat_dimention_wrpr">
        	<div class="gat_cntrlr_wrpr">
            	<span class="count"><?php echo $count; ?>.</span>
                <div class="action">
                	<a href="javascript:" onclick="delete_dimension(this)" class="button button-primary">Delete</a>
                </div>
                <div class="order">
                	<?php echo $order; ?>
                </div>
            </div>
            <div class="gat_inside_wrpr">
            	<div class="gat_fldwrpr">
                	<input type="text" name="dimension_title[]" autocomplete="off" spellcheck="true" value="" class="wp_title" />
                </div>
                <div class="gat_fldwrpr">
                 	<textarea rows="5" name="dimension_content[]" style="display: none" class="gat_editabletextarea"></textarea>
                    <div class="gat_editablediv" onclick="initareaodoo();"></div>
                </div>
                <div class="gat_fldwrpr">
                	<div class="gat_fldtopwrpr">
                    	<label>Associated Videos : </label>
                        <p><a href="javascript:" onclick="add_video(this)" class="button button-primary" data-count="<?php echo $count; ?>" >Add +</a></p>
                    </div>
                    <div class="gat_fldinsidewrpr">
                    	<table class="wp-list-table widefat fixed gat_table">
                        	<thead>
                            	<tr>
                                	<th>Label</th>
                                    <th>YouTube Id</th>
                                    <th>1</th>
                                    <th>2</th>
                                    <th>3</th>
                                    <th>4</th>
                                    <th>Remove</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    <?php
	die;
}
add_action('wp_ajax_delete_domain','delete_domain_function');
function delete_domain_function()
{
	global $wpdb;
	$dimensiontable = PLUGIN_PREFIX . "dimensions";
	$videotable = PLUGIN_PREFIX . "videos";
	extract($_POST);
	wp_delete_post($domainid);
	$wpdb->query("DELETE FROM $dimensiontable WHERE domain_id=$domainid");
	$wpdb->query("DELETE FROM $videotable WHERE domain_id=$domainid");
	die;
}
add_action('wp_ajax_save_assessment','save_assessment_function');
function save_assessment_function()
{
	global $wpdb;
	extract($_POST);
	$dimensiontable = PLUGIN_PREFIX . "dimensions";
	$results_table = PLUGIN_PREFIX . "results";
	
	$data = $wpdb->get_results( "SELECT COUNT(*) FROM $dimensiontable where assessment_id=$assessment_id", OBJECT_K );
	$data = array_keys($data);
	$total_dimension = $data[0];
	
	$ratingcount = 0;
	for($i=0; $i < count($dimension_id); $i++)
	{
		$dimensionid = $dimension_id[$i];
		$rating = ${'rating_' . $dimensionid};
		$filtered = array_filter($rating, 'filter_callback');
		if(!empty($filtered))
		{
			$ratingcount++;
		}
	}
	$dimension_id = implode(",", $dimension_id);
	
	$data = $wpdb->get_results( "SELECT count(*) AS cnt FROM $results_table WHERE assessment_id =$assessment_id && token='$token' &&( rating_scale != NULL
OR rating_scale != '' ) && dimension_id NOT IN ($dimension_id) ", OBJECT_K );
	$data = array_keys($data);
	$total_rated = $data[0];
	
	echo $progress = (($total_rated+$ratingcount)/$total_dimension)*100;
	die;
}
?>