<?php
// hook into the init action and call create_managment_taxonomies when it fires
add_action( 'init', 'create_managment_taxonomies');

// create taxonomies, for the post type "ask_question"
function create_managment_taxonomies()
{
	
	$labels =  array( 
            'name' => __( 'Stories', SCP_SLUG),
            'singular_name' => __( 'Story',  SCP_SLUG ),
            'add_new_item' => __( 'Add New Story', SCP_SLUG ),
            'edit_item' => __( 'Edit Story',  SCP_SLUG ),
            'new_item' => __( 'New Story', SCP_SLUG ),
            'view_item' => __( 'View Story',  SCP_SLUG ),
            'search_items' => __( 'Search Stories',  SCP_SLUG ),
            'not_found' => __( 'No stories found',  SCP_SLUG ),
            'not_found_in_trash' => __( 'No stories found in Trash',  SCP_SLUG ),
            'menu_name' => __( 'Stories',  SCP_SLUG ),
        );
	
	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'stories' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail' ),
		'register_meta_box_cb' => 'story_custom_metaboxes'
	);
	register_post_type( 'stories', $args );

	$texonomy_array = array(
						'program' => __( 'Program', SCP_SLUG ),
						'state' => 'State',
						'grade_level' => __( 'Level', SCP_SLUG ),
						'characteristics' => 'Community Type',
						'districtsize' => 'District Enrollment',
						'institutionenrollment' => 'Institution Enrollment',
						'institutiontype' => 'Institution Type');

	foreach($texonomy_array as $texonomy_key => $texonomy_value)
	{
		if ($texonomy_key=="program"){
			$labels = array(
				'name'                       => __( 'Program', SCP_SLUG ),
				'singular_name'              => __( 'Program', SCP_SLUG ),
				'search_items'               => __( 'Search Programs', SCP_SLUG ),
				'all_items'                  => __( 'All Programs', SCP_SLUG ),
				'parent_item'                => __( 'Parent Program', SCP_SLUG ),
				'parent_item_colon'          => __( 'Parent Program', SCP_SLUG ),
				'edit_item'                  => __( 'Edit Program', SCP_SLUG ),
				'update_item'                => __( 'Update Program', SCP_SLUG ),
				'add_new_item'               => __( 'Add New Program', SCP_SLUG ),
				'new_item_name'              => __( 'New Program Name', SCP_SLUG ),
				'menu_name'                  => __( 'Program', SCP_SLUG ),
			);
		} elseif ($texonomy_key=="grade_level"){
			$labels = array(
				'name'                       => __( 'Level', SCP_SLUG ),
				'singular_name'              => __( 'Level', SCP_SLUG ),
				'search_items'               => __( 'Search Levels', SCP_SLUG ),
				'all_items'                  => __( 'All Levels', SCP_SLUG ),
				'parent_item'                => __( 'Parent Level', SCP_SLUG ),
				'parent_item_colon'          => __( 'Parent Level', SCP_SLUG ),
				'edit_item'                  => __( 'Edit Level', SCP_SLUG ),
				'update_item'                => __( 'Update Level', SCP_SLUG ),
				'add_new_item'               => __( 'Add New Level', SCP_SLUG ),
				'new_item_name'              => __( 'New Level Name', SCP_SLUG ),
				'menu_name'                  => __( 'Level', SCP_SLUG ),
			);
		} else {
			// Add new taxonomy, hierarchical (like Category)
			$labels = array(
				'name'                       => __( $texonomy_value, SCP_SLUG ),
				'singular_name'              => __( $texonomy_value, SCP_SLUG ),
				'search_items'               => __( 'Search '.$texonomy_value, SCP_SLUG ),
				'all_items'                  => __( 'All '.$texonomy_value, SCP_SLUG ),
				'parent_item'                => __( 'Parent '.$texonomy_value, SCP_SLUG ),
				'parent_item_colon'          => __( 'Parent '.$texonomy_value, SCP_SLUG ),
				'edit_item'                  => __( 'Edit '.$texonomy_value ),
				'update_item'                => __( 'Update '.$texonomy_value ),
				'add_new_item'               => __( 'Add New '.$texonomy_value ),
				'new_item_name'              => __( 'New '.$texonomy_value.' Name' ),
				'menu_name'                  => __( $texonomy_value ),
			);
		}
			$args = array(
				'hierarchical'          => true,
				'labels'                => $labels,
				'show_ui'               => true,
				'show_admin_column'     => true,
				'query_var'             => true,
				'rewrite'               => array( 'slug' => $texonomy_key ),
			);
			register_taxonomy( $texonomy_key, array('stories'), $args );
	}

	$labels = array(
				'name'                       => _x( 'Tags', 'taxonomy general name' ),
				'singular_name'              => _x( 'Tag', 'taxonomy singular name' ),
				'search_items'               => __( 'Search Tags' ),
				'popular_items'              => __( 'Popular Tags' ),
				'all_items'                  => __( 'All Tags' ),
				'parent_item'                => null,
				'parent_item_colon'          => null,
				'edit_item'                  => __( 'Edit Tag' ),
				'update_item'                => __( 'Update Tag' ),
				'add_new_item'               => __( 'Add New Tag' ),
				'new_item_name'              => __( 'New Tag Name' ),
				'separate_items_with_commas' => __( 'Separate Tag with commas' ),
				'add_or_remove_items'        => __( 'Add or remove Tag' ),
				'choose_from_most_used'      => __( 'Choose from the most used Tag' ),
				'not_found'                  => __( 'No found.' ),
				'menu_name'                  => __( 'Tags' ),
			);

			$args = array(
				'hierarchical'          => false,
				'labels'                => $labels,
				'show_ui'               => true,
				'show_admin_column'     => true,
				'update_count_callback' => '_update_post_term_count',
				'query_var'             => true,
				'rewrite'               => array( 'slug' => 'story_tag' ),
			);

			register_taxonomy( 'story_tag', 'stories', $args );
}

function story_custom_metaboxes()
{
	add_meta_box('story_metaid','Additional Fields','create_stories_metabox','stories','advanced');
}

function create_stories_metabox()
{
	global $post, $characteristics, $districtsize;
	$story_team_lead 	= get_post_meta($post->ID, "story_team_lead", true);
	$story_logic_model 	= get_post_meta($post->ID, "story_logic_model", true);
	$story_video 		= get_post_meta($post->ID, "story_video", true);
	$story_video_host 	= get_post_meta($post->ID, "story_video_host", true);
	$story_highlight 	= get_post_meta($post->ID, "story_highlight", true);
	$story_district 	= get_post_meta($post->ID, "story_district", true);
	$story_school 		= get_post_meta($post->ID, "story_school", true);
	$story_institution 	= get_post_meta($post->ID, "story_institution", true);
	$story_mapaddress 	= get_post_meta($post->ID, "story_mapaddress", true);
	$story_zipcode 		= get_post_meta($post->ID, "story_zipcode", true);
	$story_sidebar_content = get_post_meta($post->ID, "story_sidebar_content", true);

	$return = '';
		//Team Lead Metabox
		$return .= '<div class="scp_adtnalflds">';
			$return .= '<div class="wrprtext">Team Lead</div>';
			$return .= '<div class="wrprfld"><input type="text" name="story_team_lead" value="'.$story_team_lead.'" /></div>';
		$return .= '</div>';
		
		//Logic Model Metabox
		$return .= '<div class="scp_adtnalflds">';
			$return .= '<div class="wrprtext">Logic Model</div>';
			$return .= '<div class="wrprfld"><input type="text" name="story_logic_model" value="'.$story_logic_model.'" /></div>';
		$return .= '</div>';
		
		$return .= '<div class="scp_adtnalflds">';
			$return .= '<div class="wrprtext">Video ID</div>';
			$return .= '<div class="wrprfld"><input type="text" name="story_video" value="'.$story_video.'" /></div>';
		$return .= '</div>';

		$return .= '<div class="scp_adtnalflds">';
			$return .= '<div class="wrprtext">Video Host</div>';
			$return .= '<div class="wrprfld">
					<select name="story_video_host">
						<option value="0">Select Video Host</option>';
			$status = ($story_video_host=="1")?"selected":"";
			$return .=		'<option value="1" '.$status.'>YouTube</option>';
			$status = ($story_video_host=="2")?"selected":"";
			$return .=		'<option value="2" '.$status.'>Vimeo</option>';
			$return .=	'</select>
					</div>';
		$return .= '</div>';

		$return .= '<div class="scp_adtnalflds">';
			$return .= '<div class="wrprtext">Highlight</div>';
			$return .= '<div class="wrprfld">';
					$return .= '<div>';
						if($story_highlight == "true"){ $status = 'checked="checked"';}else{ $status = '';}
						$return .= '<input type="radio" name="story_highlight" value="true" '. $status .' >';
						$return .= '<label>True</label>';
					$return .= '</div>';
					$return .= '<div>';
						if($story_highlight == "false"){ $status = 'checked="checked"';}else{ $status = '';}
						$return .= '<input type="radio" name="story_highlight" value="false" '. $status .' >';
						$return .= '<label>False</label>';
					$return .= '</div>';
			$return .= '</div>';
		$return .= '</div>';

		$return .= '<div class="scp_adtnalflds">';
			$return .= '<div class="wrprtext">Location</div>';
			$return .= '<div class="wrprfld">
							<span>District</span>
							<input type="text" name="story_district" value="'. $story_district .'" />
							<span>School</span>
							<input type="text" name="story_school" value="'. $story_school .'" />
							<span>Institution</span>
							<input type="text" name="story_institution" value="'. $story_institution .'" />
							<span>Map Address</span>
							<input type="text" name="story_mapaddress" value="'. $story_mapaddress .'" />
							<span>Zipcode</span>
							<input type="text" name="story_zipcode" value="'. $story_zipcode .'" />
						</div>';
		$return .= '</div>';

		$return .= '<div class="scp_adtnalflds">';
			$return .= '<div class="wrprtext">Additional Sidebar Content</div>';
			$return .= '<div class="wrprfld">
							<textarea name="story_sidebar_content">'.$story_sidebar_content.'</textarea>
						</div>';
		$return .= '</div>';

	echo $return;
}

add_action('save_post', 'save_askquestion_metabox');
function save_askquestion_metabox()
{
	global $post;
	
	if(isset($_POST['story_team_lead']))
	{
		update_post_meta($post->ID, "story_team_lead", $_POST['story_team_lead']);
	}
	
	if(isset($_POST['story_logic_model']))
	{
		update_post_meta($post->ID, "story_logic_model", $_POST['story_logic_model']);
	}

	if(isset($_POST['story_video']))
	{
		update_post_meta($post->ID, "story_video", $_POST['story_video']);
	}

	if(isset($_POST['story_video_host']) && !empty($_POST['story_video_host']))
	{
		update_post_meta($post->ID, "story_video_host", $_POST['story_video_host']);
	}

	if(isset($_POST['story_highlight']) && !empty($_POST['story_highlight']))
	{
		update_post_meta($post->ID, "story_highlight", $_POST['story_highlight']);
	}

	if(isset($_POST['story_district']) && !empty($_POST['story_district']))
	{
		update_post_meta($post->ID, "story_district", $_POST['story_district']);
	}

	if(isset($_POST['story_school']) && !empty($_POST['story_school']))
	{
		update_post_meta($post->ID, "story_school", $_POST['story_school']);
	}
	
	if(isset($_POST['story_institution']) && !empty($_POST['story_institution']))
	{
		update_post_meta($post->ID, "story_institution", $_POST['story_institution']);
	}

	if(isset($_POST['story_zipcode']) && !empty($_POST['story_zipcode']))
	{
		update_post_meta($post->ID, "story_zipcode", $_POST['story_zipcode']);
	}

	if(isset($_POST['story_districtsize']) && !empty($_POST['story_districtsize']))
	{
		update_post_meta($post->ID, "story_districtsize", $_POST['story_districtsize']);
	}

	if(isset($_POST['story_mapaddress']) && !empty($_POST['story_mapaddress']))
	{
		update_post_meta($post->ID, "story_mapaddress", $_POST['story_mapaddress']);
		$latlong = get_latitude_longitude($_POST['story_mapaddress']);
		if($latlong)
		{
        	$map = explode(',' ,$latlong);
        	$mapLatitude = $map[0];
        	$mapLongitude = $map[1];
			save_metadata($post->ID, $mapLatitude, $mapLongitude);
		}
	}

	if(isset($_POST['story_sidebar_content']))
	{
		$story_characteristic = serialize($_POST['story_characteristic']);
		update_post_meta($post->ID, "story_characteristic", $story_characteristic);
	}
	else
	{
		$story_characteristic = serialize(array());
		update_post_meta($post->ID, "story_characteristic", $story_characteristic);
	}

	if(isset($_POST['story_sidebar_content']) && !empty($_POST['story_sidebar_content']))
	{
		update_post_meta($post->ID, "story_sidebar_content", $_POST['story_sidebar_content']);
	}

}
//Save Data
function save_metadata($postid, $mapLatitude, $mapLongitude)
{
	global $wpdb;
	$table_name = $wpdb->prefix . "scp_stories";

	$post = get_post($postid);
	$title= $post->post_title;
	$content =  substr(preg_replace('/[^A-Za-z0-9\-\(\) ]/', '', strip_tags($post->post_content)), 0, 100);
	$image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );

	if($wpdb->get_results("select id from $table_name where postid=$postid"))
	{
		$wpdb->get_results("UPDATE $table_name SET title='$title', content='$content', image='$image', longitude='$mapLongitude', latitude='$mapLatitude' where postid=$postid");
	}
	else
	{
		$wpdb->get_results("INSERT into $table_name (postid, title, content, image, longitude, latitude) VALUES ($postid, '$title', '$content', '$image', '$mapLongitude', '$mapLatitude')");
	}
}
//function for get longitude and latitude
function get_latitude_longitude($address)
{
	global $_googleapikey;

    $address = str_replace(" ", "+", $address);

    $json = file_get_contents("http://maps.google.com/maps/api/geocode/json?address=$address&sensor=false");

    $json = json_decode($json);
	if(!empty($json))
	{
    	$lat = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
    	$long = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};
    	return $lat.','.$long;
	}
	else
	{
		return false;
	}
}

function generate_state_dropdown($id, $taxonomy, $taxonomy_name, $level = null) {
	//Get State IDs
	$args = array(
			'orderby'   	=> 	'name',
			'order'     	=> 	'ASC',
			'fields'	=>	'ids',
			'hide_empty'	=> 	false);
	$state_ids = get_terms('state', $args);
	
	if ($level=="P-12")
		$grade_level = array("Early Childhood Education","P-12");
	else
		$grade_level = array("Higher Education","Postsecondary");
	
	//Get story ids based on state and grade_level
	$args2 = array(
		'post_type' => 'stories',
		'posts_per_page' => -1,
		'tax_query' => array(
				'relation' => 'AND',
				array(
					'taxonomy' => 'grade_level',
					'field' => 'name',
					'terms' => $grade_level
				),
				array(
					'taxonomy' => 'state',
					'field' => 'id',
					'terms' => $state_ids
				)
			),
		'fields' => 'ids'
		);
	$sposts = get_posts($args2);
	
	$states = wp_get_object_terms($sposts, 'state');
	
	//Enable State
	if(isset($states) && !empty($states))
	{
		if(isset($taxonomy) && !empty($taxonomy) && $taxonomy == 'state'): $display = 'block'; else: $display = 'none'; endif;
		$stateoption = '<div class="tglelemnt" style="display:'. $display.'">';
		$stateoption .= '<select name="state" id="'.$id.'" data-post-ids="'.json_encode($sposts).'">';
		$stateoption .= '<option value="">Browse by State</option>';
		foreach($states as $state)
		{
			$count = get_count_by_state_level($grade_level, $state->term_id, $sposts);
			if(isset($taxonomy_name) && !empty($taxonomy_name) && $state->slug == $taxonomy_name):
				$check = 'selected="selected"';
			else:
				$check = '';
			endif;
			$stateoption .= '<option '.$check.' value="'.site_url().'/stories/state/'.$state->slug.'">'.$state->name.' ('.$count.')</option>';
		}
		$stateoption .= '</select></div>';
	}
	return $stateoption;
}

//Get state count by level
function get_count_by_state_level($level, $state_id, $object_ids) {
	$count = 0;
	
	//Get story ids based on state and grade_level
	$args = array(
		'post_type' => 'stories',
		'posts_per_page' => -1,
		'posts__in' => $object_ids,
		'tax_query' => array(
				'relation' => 'AND',
				array(
					'taxonomy' => 'grade_level',
					'field' => 'name',
					'terms' => $level
				),
				array(
					'taxonomy' => 'state',
					'field' => 'term_id',
					'terms' => $state_id
				)
			),
		'fields' => 'id'
		);
	$results = get_posts($args);
	
	if ($results)
		$count = count($results);
		
	return $count;
}

//Story Search
function get_stories_side_nav($taxonomy=NULL, $taxonomy_name=NULL, $search_text=NULL, $active_level = "all")
{
	global $wpdb, $_filters;

	$args = array( 'orderby'   => 'term_order',
				  'order'     => 'ASC',
				  'hide_empty'=> false);

	$state_args = array( 'orderby'   => 'name',
				  'order'     => 'ASC',
				  'hide_empty'=> false);
				  
	$states = get_terms('state', $state_args);
	$grades = get_terms('grade_level', $args);
	$characteristics = get_terms('characteristics', $args);
	$districtsize = get_terms('districtsize', $args);
	$institutionenrollment = get_terms('institutionenrollment', $args);
	$institutiontype = get_terms('institutiontype', $args);
	$tags = get_terms('story_tag', $args);	
	
	//Enable State
	if(isset($states) && !empty($states))
	{
		/*if(isset($taxonomy) && !empty($taxonomy) && $taxonomy == 'state'): $display = 'block'; else: $display = 'none'; endif;
		$stateoption = '<div class="tglelemnt" style="display:'. $display.'">';
		foreach($states as $state)
		{
			if(isset($taxonomy_name) && !empty($taxonomy_name) && $state->slug == $taxonomy_name):
				$check = 'checked';
			else:
				$check = '';
			endif;
			$stateoption .= '<li class="'.$check.'">
								<a href="'.site_url().'/stories/state/'.$state->slug.'">'.$state->name.' ('.$state->count.')</a>
							</li>';
		}
		$stateoption .= '</div>';*/
		if(isset($taxonomy) && !empty($taxonomy) && $taxonomy == 'state'): $display = 'block'; else: $display = 'none'; endif;
		$stateoption = '<div class="tglelemnt" style="display:'. $display.'">';
		$stateoption .= '<select name="state" id="statedropdown">';
		$stateoption .= '<option value="">Browse by State</option>';
		foreach($states as $state)
		{
			if(isset($taxonomy_name) && !empty($taxonomy_name) && $state->slug == $taxonomy_name):
				$check = 'selected="selected"';
			else:
				$check = '';
			endif;
			$stateoption .= '<option '.$check.' value="'.site_url().'/stories/state/'.$state->slug.'">'.$state->name.' ('.$state->count.')</option>';
		}
		$stateoption .= '</select></div>';
	}

	if(isset($grades) && !empty($grades))
	{
		if(isset($taxonomy) && !empty($taxonomy) && $taxonomy == 'grade_level'): $display = 'block'; else: $display = 'none'; endif;
		$gradeoption = '<div class="tglelemnt" style="display:'. $display.'">';
		foreach($grades as $grade)
		{
			if(isset($taxonomy_name) && !empty($taxonomy_name) && $grade->slug == $taxonomy_name):
				$check = 'checked';
			else:
				$check = '';
			endif;
			$gradeoption .= '<li class="'.$check.'">
								<a href="'.site_url().'/stories/grade_level/'.$grade->slug.'">'.$grade->name.' ('.$grade->count.')</a>
							</li>';
		}
		$gradeoption .= '</div>';
	}

	if(isset($characteristics) && !empty($characteristics))
	{
		if(isset($taxonomy) && !empty($taxonomy) && $taxonomy == 'characteristics'): $display = 'block'; else: $display = 'none'; endif;
		$district_locationoption = '<div class="tglelemnt" style="display:'. $display.'">';
		foreach($characteristics as $characteristic)
		{
			if(isset($taxonomy_name) && !empty($taxonomy_name) && $characteristic->slug == $taxonomy_name):
				$check = 'checked';
			else:
				$check = '';
			endif;
			$district_locationoption .= '<li class="'.$check.'">
											<a href="'.site_url().'/stories/characteristics/'.$characteristic->slug.'">
												'.$characteristic->name.' ('.$characteristic->count.')
											</a>
										</li>';
		}
		$district_locationoption .= '</div>';
	}

	if(isset($districtsize) && !empty($districtsize))
	{
		if(isset($taxonomy) && !empty($taxonomy) && $taxonomy == 'districtsize'): $display = 'block'; else: $display = 'none'; endif;
		$district_sizeoption = '<div class="tglelemnt" style="display:'. $display.'">';
		foreach($districtsize as $size)
		{
			if(isset($taxonomy_name) && !empty($taxonomy_name) && $size->slug == $taxonomy_name):
				$check = 'checked';
			else:
				$check = '';
			endif;
			$district_sizeoption .= '<li class="'.$check.'">
										<a href="'.site_url().'/stories/districtsize/'.$size->slug.'">'.$size->name.' ('.$size->count.')</a>
									</li>';
		}
		$district_sizeoption .= '</div>';
	}
	
	/** Institution Enrollment **/
	if(isset($institutionenrollment) && !empty($institutionenrollment))
	{
		if(isset($taxonomy) && !empty($taxonomy) && $taxonomy == 'institutionenrollment'): $display = 'block'; else: $display = 'none'; endif;
		$institution_option = '<div class="tglelemnt" style="display:'. $display.'">';
		foreach($institutionenrollment as $institution)
		{
			if(isset($taxonomy_name) && !empty($taxonomy_name) && $institution->slug == $taxonomy_name):
				$check = 'checked';
			else:
				$check = '';
			endif;
			$institution_option .= '<li class="'.$check.'">
							<a href="'.site_url().'/stories/institutionenrollment/'.$institution->slug.'">'.$institution->name.' ('.$institution->count.')</a>
						</li>';
		}
		$institution_option .= '</div>';
	}
	
	/** Institution Type **/
	if(isset($institutiontype) && !empty($institutiontype))
	{
		if(isset($taxonomy) && !empty($taxonomy) && $taxonomy == 'institutiontype'): $display = 'block'; else: $display = 'none'; endif;
		$institutiontype_option = '<div class="tglelemnt" style="display:'. $display.'">';
		foreach($institutiontype as $type)
		{
			if(isset($taxonomy_name) && !empty($taxonomy_name) && $type->slug == $taxonomy_name):
				$check = 'checked';
			else:
				$check = '';
			endif;
			$institutiontype_option .= '<li class="'.$check.'">
							<a href="'.site_url().'/stories/institutiontype/'.$type->slug.'">'.$type->name.' ('.$type->count.')</a>
						</li>';
		}
		$institutiontype_option .= '</div>';
	}

	$stories_home_URL = site_url().'/stories/';
	?>
    	<aside class="search_widget stry_srch_frm">
	    <?php if (!(title_can_be_hidden())): ?>
            <h3>
            	<?php if($_SERVER["REQUEST_URI"] != $stories_home_URL) { echo '<a href="'.$stories_home_URL.'">'; } ?>
            	<?php _e( "Stories of EdTech Innovation", SCP_SLUG); ?>
            	<?php if($_SERVER["REQUEST_URI"] != $stories_home_URL) { echo '</a>'; } ?>
            </h3>
	    <?php endif; ?>
            <p class="stry_srch_desc">
            	<?php _e( "Use this tool to browse stories of innovation happening in schools across the nation. By sharing these stories, we hope to connect districts, schools, and educators trying similar things so that they can learn from each other's experiences.", SCP_SLUG); ?>
            </p>

            <h4 class="hdng_mtr brdr_mrgn_none stry_browse_header"><?php _e( "Browse Stories", SCP_SLUG); ?></h4>
	    <div id="story-tabs">
	<?php
		//Define array $tabs
		$tabs = array(
			array( "name" => _x( "All" , SCP_SLUG ), "anchor" => "all" ),
			array( "name" => _x( "P-12" , SCP_SLUG ) , "anchor" => "p12") ,
			array( "name" => _x( "Postsecondary", SCP_SLUG ), "anchor" => "postsecondary" )
			);
		
		if (!empty($tabs)) {
			echo '<ul class="tabs">';
			foreach ($tabs as $tab) {
				if(in_array($taxonomy,array('state','grade_level')) && $tab['anchor']=="all") {
					$active = 'class="active"';
				} elseif (in_array($taxonomy,array('characteristics','districtsize')) && $tab['anchor']=="p12"){
					$active = 'class="active"';
				}  elseif (in_array($taxonomy,array('institutionenrollment','institutiontype')) && $tab['anchor']=="postsecondary"){
					$active = 'class="active"';
				} else {
					$active = "";
				}
				
				echo '<li class="'.$tab['anchor'].'"><a href="#'.$tab['anchor'].'" '.$active.'>'.$tab['name'].'</a></li>';
			}
			echo '</ul>';
		}
	?>
		<!-- All Tab -->
		<div id="all" class="story-tab">
			<?php if ($_filters['state']==1): ?>
			<div class="srchtrmbxs">
			    <ul class="cstmaccordian">
				    <div class="cstmaccordiandv">
				    <?php
								    if(isset($taxonomy) && !empty($taxonomy) && $taxonomy == 'state'):
									    $class = 'fa-caret-down';
									    $accordian_title = 'Collapse';
								    else:
									    $class = 'fa-caret-right';
									    $accordian_title = 'Expand';
								    endif;
							    ?>
				    <i class="fa <?php echo $class; ?>"></i>
				    <a tabindex="0" title="<?php echo $accordian_title; ?> State Menu" class="accordian_section_title">State</a>
				</div>
				<?php echo $stateoption; ?>
			    </ul>
			</div>
			<?php endif; ?>
			<?php if ($_filters['grade_level']==1): ?>
			<div class="srchtrmbxs">
			    <ul class="cstmaccordian">
				    <div class="cstmaccordiandv">
				    <?php
								    if(isset($taxonomy) && !empty($taxonomy) && $taxonomy == 'grade_level'):
									    $class = 'fa-caret-down';
									    $accordian_title = 'Collapse';
								    else:
									    $class = 'fa-caret-right';
									    $accordian_title = 'Expand';
								    endif;
							    ?>
				    <i class="fa <?php echo $class; ?>"></i>
				    <a tabindex="0" title="<?php echo $accordian_title; ?> Grade Menu" class="accordian_section_title">Level</a>
				</div>
				<?php echo $gradeoption; ?>
			    </ul>
			</div>
			<?php endif; ?>
		</div>
	    
		<!-- P-12 Tab -->
		<div id="p12" class="story-tab">
			<?php if ($_filters['state']==1): ?>
			<?php $state2option = generate_state_dropdown('statedropdown2', $taxonomy, $taxonomy_name, "P-12"); ?>
			<div class="srchtrmbxs">
			    <ul class="cstmaccordian">
				    <div class="cstmaccordiandv">
				    <?php
								    if(isset($taxonomy) && !empty($taxonomy) && $taxonomy == 'state'):
									    $class = 'fa-caret-down';
									    $accordian_title = 'Collapse';
								    else:
									    $class = 'fa-caret-right';
									    $accordian_title = 'Expand';
								    endif;
							    ?>
				    <i class="fa <?php echo $class; ?>"></i>
				    <a tabindex="0" title="<?php echo $accordian_title; ?> State Menu" class="accordian_section_title">State</a>
				</div>
				<?php echo $state2option; ?>
			    </ul>
			</div>
			<?php endif; ?>
			
			<?php if ($_filters['characteristics']==1): ?>
			<div class="srchtrmbxs">
				<ul class="cstmaccordian">
					<div class="cstmaccordiandv">
					<?php
									if(isset($taxonomy) && !empty($taxonomy) && $taxonomy == 'characteristics'):
										$class = 'fa-caret-down';
										$accordian_title = 'Collapse';
									else:
										$class = 'fa-caret-right';
										$accordian_title = 'Expand';
									endif;
								?>
					<i class="fa <?php echo $class; ?>"></i>
					<a tabindex="0" title="<?php echo $accordian_title; ?> Community Type Menu" class="accordian_section_title">Community Type</a>
				    </div>
				    <?php echo $district_locationoption; ?>
				</ul>
			</div>
			<?php endif; ?>
			
			<?php if ($_filters['district_size']==1): ?>
			<div class="srchtrmbxs">
				<ul class="cstmaccordian">
				    <div class="cstmaccordiandv">
					<?php
									if(isset($taxonomy) && !empty($taxonomy) && $taxonomy == 'districtsize'):
										$class = 'fa-caret-down';
										$accordian_title = 'Collapse';
									else:
										$class = 'fa-caret-right';
										$accordian_title = 'Expand';
									endif;
								?>
					<i class="fa <?php echo $class; ?>"></i>
					<a tabindex="0" title="<?php echo $accordian_title; ?> District Enrollment Menu" class="accordian_section_title">District Enrollment</a>
				    </div>
				    <?php echo $district_sizeoption; ?>
				</ul>
			</div>
			<?php endif; ?>
		</div>
		
		<!-- Post Secondary Tab -->
		<div id="postsecondary" class="story-tab">
			<?php if ($_filters['state']==1): ?>
			<?php $state3option = generate_state_dropdown('statedropdown3', $taxonomy, $taxonomy_name, "Postsecondary"); ?>
			<div class="srchtrmbxs">
			    <ul class="cstmaccordian">
				    <div class="cstmaccordiandv">
				    <?php
								    if(isset($taxonomy) && !empty($taxonomy) && $taxonomy == 'state'):
									    $class = 'fa-caret-down';
									    $accordian_title = 'Collapse';
								    else:
									    $class = 'fa-caret-right';
									    $accordian_title = 'Expand';
								    endif;
							    ?>
				    <i class="fa <?php echo $class; ?>"></i>
				    <a tabindex="0" title="<?php echo $accordian_title; ?> State Menu" class="accordian_section_title">State</a>
				</div>
				<?php echo $state3option; ?>
			    </ul>
			</div>
			<?php endif; ?>
			
			
			<?php if ($_filters['institutiontype']==1): ?>
			<div class="srchtrmbxs">
				<ul class="cstmaccordian">
				    <div class="cstmaccordiandv">
					<?php
						if(isset($taxonomy) && !empty($taxonomy) && $taxonomy == 'institutiontype'):
							$class = 'fa-caret-down';
							$accordian_title = 'Collapse';
						else:
							$class = 'fa-caret-right';
							$accordian_title = 'Expand';
						endif;
					?>
					<i class="fa <?php echo $class; ?>"></i>
					<a tabindex="0" title="<?php echo $accordian_title; ?> Institution Type Menu" class="accordian_section_title">Institution Type</a>
				    </div>
				    <?php echo $institutiontype_option; ?>
				</ul>
			</div>
			<?php endif; ?>
			
			<?php if ($_filters['institutionenrollment']==1): ?>
			<div class="srchtrmbxs">
				<ul class="cstmaccordian">
				    <div class="cstmaccordiandv">
					<?php
						if(isset($taxonomy) && !empty($taxonomy) && $taxonomy == 'institutionenrollment'):
							$class = 'fa-caret-down';
							$accordian_title = 'Collapse';
						else:
							$class = 'fa-caret-right';
							$accordian_title = 'Expand';
						endif;
					?>
					<i class="fa <?php echo $class; ?>"></i>
					<a tabindex="0" title="<?php echo $accordian_title; ?> Institution Enrollment Menu" class="accordian_section_title">Institution Enrollment</a>
				    </div>
				    <?php echo $institution_option; ?>
				</ul>
			</div>
			<?php endif; ?>
		</div>
		<input type="hidden" name="active_level" id="active_level" value="<?php echo $active_level; ?>" />
		</div>    
		
		<?php echo get_story_search($search_text, $taxonomy, $taxonomy_name); ?>
		<?php echo get_top_topics_nav($taxonomy, $taxonomy_name) ?>

		<div class="showallstories">
		    <a class="btn_dwnld" href="<?php echo site_url();?>/stories/?action=showall"><?php _e( "Browse All Stories", SCP_SLUG); ?></a>
		</div>

        </aside>
    <?php
}

function get_top_topics_nav($taxonomy=NULL, $taxonomy_name=NULL)
{
	global $wpdb;
	$args = array('orderby' => 'count', 'order' => 'DESC', 'number' => 10);
	$tags = get_terms('story_tag', $args);
	$topic_nav = '';

	$topic_nav .= '<div class="topic_sidebar"><h4 class="hdng_mtr brdr_mrgn_none stry_topics_header">Topics :</h4><ul>';

	foreach($tags as $tag)
	{
		if(isset($taxonomy_name) && !empty($taxonomy_name) && $taxonomy_name == $tag->slug):
			$class = "checkedtag";
		else:
			$class = '';
		endif;
		$topic_nav .= '<li class="'.$class.'">
			  			 <a href="'.site_url().'/stories/story_tag/'.$tag->slug.'">'.ucfirst($tag->name).'
			  			 <span>('.$tag->count.')</span></a>
		  			   </li>';
	}

	$topic_nav .= '</ul></div>';
	return $topic_nav;
}

function get_counts($termid, $searchresult)
{
	global $wpdb;
	$taxon_tablename = $wpdb->prefix."term_taxonomy";
	$term_rel_tablename = $wpdb->prefix."term_relationships";
	$posts_tablename = $wpdb->prefx."posts";
	$query = "SELECT object_id from $term_rel_tablename where term_taxonomy_id=(SELECT term_taxonomy_id from $taxon_tablename where term_id=$termid)";
	$data = $wpdb->get_results($query, OBJECT_K);
	if(!empty($data) && !empty($searchresult))
	{
		$data = array_keys($data);
		$result = array_intersect($searchresult, $data);
		$count = count($result);
	}
	else
	{
		$count = 0;
	}
	return $count;
}

function get_metacounts($meta, $searchresult)
{
	global $wpdb;
	$tablename = $wpdb->prefix."postmeta";
	$query = "SELECT post_id from $tablename where meta_value LIKE '%$meta%'";
	$data = $wpdb->get_results($query, OBJECT_K);
	if(!empty($data) && !empty($searchresult))
	{
		$result = array_intersect_key($searchresult, $data);
		$count = count($result);
	}
	else
	{
		$count = 0;
	}
	return $count;
}

//Functions for load template
function get_story_template_part( $slug, $name = null )
{
	do_action( "get_story_template_part_{$slug}", $slug, $name );

	$templates = array();
	$name = (string) $name;
	if ( '' !== $name )
		$templates[] = "{$slug}-{$name}.php";

	$templates[] = "{$slug}.php";

	locate_story_template($templates, true, false);
}
function locate_story_template($template_names, $load = false, $require_once = true )
{
	$located = '';
	foreach ( (array) $template_names as $template_name )
	{
		if ( !$template_name )
			continue;
		if ( file_exists(SCP_PATH . 'templates/' . $template_name))
		{
			$located = SCP_PATH . 'templates/' . $template_name;
			break;
		}
	}

	if ( $load && '' != $located )
		load_story_template( $located, $require_once );

	return $located;
}
function load_story_template( $_template_file, $require_once = true )
{
	global $posts, $post, $wp_did_header, $wp_query, $wp_rewrite, $wpdb, $wp_version, $wp, $id, $comment, $user_ID;

	if ( is_array( $wp_query->query_vars ) )
		extract( $wp_query->query_vars, EXTR_SKIP );

	if ( $require_once )
		require_once( $_template_file );
	else
		require( $_template_file );
}

//simply return Story or Stories depending on count
function story_plural( $count = null )
{
	if (!empty($count) && ($count > 1))
		return __('Stories', SCP_SLUG);
	else
		return __('Story', SCP_SLUG);
}

function display_story_content($post_id, $limit = 200) {
	$story = "";

	$post = get_post($post_id);

	if ($post->post_excerpt) {
		$story =  $post->post_excerpt;
	} else {
		$content = strip_tags(get_the_content($post_id));
		$story = substr($content, 0, $limit)."...";
	}
	return $story;
}

/** Text-based search on the sidebar **/
function get_story_search($search_text=NULL, $taxonomy=NULL, $taxonomy_name=NULL) {
	$search_value="";

	if (isset($search_text))
		$search_value=' value="'.$search_text.'"';

	$search_form = '<div class="srchtrmbxs">
				<form action="'.site_url().'/stories/" class="search-form searchform clearfix" method="get" _lpchecked="1">
					<div class="search-wrap">
						<input type="hidden" name="action" value="search">
						<input type="text" placeholder="Search stories..." class="s field" name="search_text"'. $search_value .'>
						<button class="search-icon" type="submit"></button>
					</div>
				</form><!-- .searchform -->
			</div>';
	return $search_form;
}

/**
 * Top Heading
 **/
function get_top_heading() {
	?>
	<div class="col-md-12 col-sm-12 col-xs-12 profile-heading">
	<?php if (!(title_can_be_hidden())): ?>
            <h1>
            	<?php _e( "View All Profiles", SCP_SLUG); ?>
            </h1>
	    <?php endif; ?>
            <h5 class="stry_srch_desc">
            	<?php _e( "Across the country, we're helping create engaging classrooms, focused schools, and strategic school systems and states.", SCP_SLUG); ?>
            </h5>
	</div>
<?php
}

function get_top_topics_dropdown($taxonomy=NULL, $taxonomy_name=NULL)
{
	global $wpdb;
	$args = array('orderby' => 'count', 'order' => 'DESC', 'number' => 10);
	$tags = get_terms('story_tag', $args);
	$topic_nav = '';

	//$topic_nav .= '<div class="topic_sidebar"><h4 class="hdng_mtr brdr_mrgn_none stry_topics_header">Topics :</h4><ul>';

	$topic_nav = '<div class="tglelemnt">';
	$topic_nav .= '<h5>Topics:</h5>';
	$topic_nav .= '<select name="story_tag" id="story_tag_dropdown">';
	$topic_nav .= '<option value="">Browse by Topic</option>';
	foreach($tags as $tag)
	{
		if(isset($taxonomy_name) && !empty($taxonomy_name) && $taxonomy_name == $tag->slug):
			$check = 'selected="selected"';
		else:
			$check = '';
		endif;
		$topic_nav .= '<option '.$check.' value="'.site_url().'/stories/story_tag/'.$tag->slug.'">'.ucfirst($tag->name).'</option>';
	}

	$topic_nav .= '</select></div>';
	return $topic_nav;
}

/**
 * Display Profile Filters
 **/
function get_story_filters($taxonomy=NULL, $taxonomy_name=NULL) {
	global $wpdb, $_filters;

	$args = array( 'orderby'   => 'term_order',
				  'order'     => 'ASC',
				  'hide_empty'=> false);

	$state_args = array( 'orderby'   => 'name',
				  'order'     => 'ASC',
				  'hide_empty'=> false);
				  
	$states = get_terms('state', $state_args);
	$grades = get_terms('grade_level', $args);
	$programs = get_terms('program', $args);
	$tags = get_terms('story_tag', $args);	
	
	//Enable State
	if(isset($states) && !empty($states))
	{
		if(isset($taxonomy) && !empty($taxonomy) && $taxonomy == 'state'): $display = 'block'; else: $display = 'none'; endif;
		$stateoption = '<div class="tglelemnt">';
		$stateoption .= '<h5>State:</h5>';
		$stateoption .= '<select name="state" id="statedropdown">';
		$stateoption .= '<option value="">Browse by State</option>';
		foreach($states as $state)
		{
			if(isset($taxonomy_name) && !empty($taxonomy_name) && $state->slug == $taxonomy_name):
				$check = 'selected="selected"';
			else:
				$check = '';
			endif;
			$stateoption .= '<option '.$check.' value="'.site_url().'/stories/state/'.$state->slug.'">'.$state->name.'</option>';
		}
		$stateoption .= '</select></div>';
	}
	
	if(isset($grades) && !empty($grades))
	{
		$gradeoption = '<div class="tglelemnt">';
		$gradeoption .= '<h5>School Type:</h5>';
		$gradeoption .= '<select name="grade_level" id="grade_level_dropdown">';
		$gradeoption .= '<option value="">Browse by School Type</option>';
		foreach($grades as $grade)
		{
			if(isset($taxonomy_name) && !empty($taxonomy_name) && $grade->slug == $taxonomy_name):
				$check =  'selected="selected"';
			else:
				$check = '';
			endif;
			$gradeoption .= '<option '.$check.' value="'.site_url().'/stories/grade_level/'.$grade->slug.'">'.$grade->name.'</option>';
		}
		$gradeoption .= '</select></div>';
	}

	//Summit
	if(isset($programs) && !empty($programs))
	{
		$programoption = '<div class="tglelemnt">';
		$programoption .= '<h5>Summit:</h5>';
		$programoption .= '<select name="program" id="programdropdown">';
		$programoption .= '<option value="">Browse by Summit</option>';
		foreach($programs as $program)
		{
			if(isset($taxonomy_name) && !empty($taxonomy_name) && $program->slug == $taxonomy_name):
				$check =  'selected="selected"';
			else:
				$check = '';
			endif;
			$programoption .= '<option '.$check.' value="'.site_url().'/stories/program/'.$program->slug.'">'.$program->name.'</option>';
		}
		$programoption .= '</select></div>';
	}
	$stories_home_URL = site_url().'/stories/';
	?>
    	<div class="search_widget stry_srch_frm profile-search-form">
	    <div id="story-tabs">
		<div class="srchtrmbxs col-md-3 col-sm-12 col-xs-12">
			<?php echo $programoption; ?>
		</div>
		<?php if ($_filters['state']==1): ?>
		<div class="srchtrmbxs col-md-3 col-sm-12 col-xs-12">
			<?php echo $stateoption; ?>
		</div>
		<?php endif; ?>
		<?php if ($_filters['grade_level']==1): ?>
		<div class="srchtrmbxs col-md-3 col-sm-12 col-xs-12">
			<?php echo $gradeoption; ?>
		</div>
		<?php endif; ?>
		
		<div class="srchtrmbxs col-md-3 col-sm-12 col-xs-12">
			<?php echo get_top_topics_dropdown($taxonomy, $taxonomy_name) ?>
		</div>
		</div>
	</div>
    <?php
}
//Story Search
/* disabling search for now. Just going to use browse Navigation
function get_story_search($searchresult=NULL, $searchtext=NULL, $taxonomy_state=NULL, $taxonomy_program=NULL, $taxonomy_grade_level=NULL, $district_location=NULL, $district_size=NULL,$taxonomy_tags=NULL)
{
	global $wpdb, $characteristics, $districtsize;

	$args = array('orderby'   => 'term_order',
				  'order'     => 'ASC',
				  'hide_empty'=> false);

	$states = get_terms('state', $args);
	//$programs = get_terms('program', $args);
	$grades = get_terms('grade_level', $args);
	$tags = get_terms('story_tag', $args);

	if(isset($states) && !empty($states))
	{
		if(isset($taxonomy_state) && !empty($taxonomy_state)): $display = 'block'; else: $display = 'none'; endif;
		$stateoption .= '<div class="tglelemnt" style="display:'. $display.'">';
		foreach($states as $state)
		{
			$count = get_counts($state->term_id, $searchresult);
			if(in_array($state->slug, $taxonomy_state)): $check = 'checked="checked"'; else: $check = ''; endif;
			$stateoption .= '<li>
								<input type="checkbox" name="taxonomy_state[]" '.$check.' value="'.$state->slug.'" id="state'.$state->term_id.'">
								<label for="state'.$state->term_id.'">'.$state->name.'</label>
								<span>('. $count.')</span>
							</li>';
		}
		$stateoption .= '</div>';
	}
	// removing programs from search for now
	if(isset($programs) && !empty($programs))
	{
		if(isset($taxonomy_program) && !empty($taxonomy_program)): $display = 'block'; else: $display = 'none'; endif;
		$programoption .= '<div class="tglelemnt" style="display:'. $display.'">';
		foreach($programs as $program)
		{
			$count = get_counts($program->term_id, $searchresult);
			if(in_array($program->slug, $taxonomy_program)): $check = 'checked="checked"'; else: $check = ''; endif;
			$programoption .= '<li>
								<input type="checkbox" name="taxonomy_program[]" '.$check.' value="'.$program->slug.'" id="prog'.$program->term_id.'">
								<label for="prog'.$program->term_id.'">'.$program->name.'</label>
								<span>('. $count.')</span>
							  </li>';
		}
		$programoption .= '</div>';
	}

	if(isset($grades) && !empty($grades))
	{
		if(isset($taxonomy_grade_level) && !empty($taxonomy_grade_level)): $display = 'block'; else: $display = 'none'; endif;
		$gradeoption .= '<div class="tglelemnt" style="display:'. $display.'">';
		foreach($grades as $grade)
		{
			$count = get_counts($grade->term_id, $searchresult);
			if(in_array($grade->slug, $taxonomy_grade_level)): $check = 'checked="checked"'; else: $check = ''; endif;
			$gradeoption .= '<li>
								<input type="checkbox" name="taxonomy_grade_level[]" '.$check.' value="'.$grade->slug.'" id="grade'.$grade->term_id.'">
								<label for="grade'.$grade->term_id.'">'.$grade->name.'</label>
								<span>('. $count.')</span>
							</li>';
		}
		$gradeoption .= '</div>';
	}
	if(isset($characteristics) && !empty($characteristics))
	{
		if(isset($district_location) && !empty($district_location)): $display = 'block'; else: $display = 'none'; endif;
		$district_locationoption .= '<div class="tglelemnt" style="display:'. $display.'">';
		foreach($characteristics as $characteristic)
		{
			$count = get_metacounts($characteristic, $searchresult);
			if(in_array($characteristic, $district_location)): $check = 'checked="checked"'; else: $check = ''; endif;
			$district_locationoption .= '<li>
											<input type="checkbox" name="district_location[]" '.$check.' value="'.$characteristic.'" id="char'.$characteristic.'">
											<label for="char'.$characteristic.'">'.$characteristic.'</label>
											<span>('. $count.')</span>
										</li>';
		}
		$district_locationoption .= '</div>';
	}
	if(isset($districtsize) && !empty($districtsize))
	{
		if(isset($district_size) && !empty($district_size)): $display = 'block'; else: $display = 'none'; endif;
		$district_sizeoption .= '<div class="tglelemnt" style="display:'. $display.'">';
		foreach($districtsize as $size)
		{
			$count = get_metacounts($size, $searchresult);
			if(in_array($size, $district_size)): $check = 'checked="checked"'; else: $check = ''; endif;
			$district_sizeoption .= '<li>
										<input type="checkbox" name="district_size[]" '.$check.' value="'.$size.'" id="size'.$size.'">
										<label for="size'.$size.'">'.$size.'</label>
										<span>('. $count.')</span>
									</li>';
		}
		$district_sizeoption .= '</div>';
	}

	?>
    	<aside class="search_widget stry_srch_frm">
            <h3>Stories of EdTech Innovation</h3>
            <p class="stry_srch_desc">Use this tool to browse stories of innovation happening in schools across the nation. By sharing these stories, we hope to connect districts, schools, and educators trying similar things so that they can learn from each other's experiences.</p>
            <form method="get">
                <input type="text" name="searchtext" value="<?php echo $searchtext; ?>" />
                <div class="srchtrmbxs">
                    <ul class="cstmaccordian">
                        <div class="cstmaccordiandv">
                            <i class="fa fa-caret-right"></i>
                            <h5>State</h5>
                        </div>
                        <?php echo $stateoption; ?>
                    </ul>
                </div>
                <div class="srchtrmbxs">
                    <ul class="cstmaccordian">
                    	<div class="cstmaccordiandv">
                            <i class="fa fa-caret-right"></i>
                            <h5>Grade</h5>
                        </div>
                        <?php echo $gradeoption; ?>
                    </ul>
                </div>
                <div class="srchtrmbxs">
                    <ul class="cstmaccordian">
                    	<div class="cstmaccordiandv">
                            <i class="fa fa-caret-right"></i>
                            <h5>Community Type</h5>
                        </div>
                        <?php echo $district_locationoption; ?>
                    </ul>
                </div>
                <div class="srchtrmbxs">
                    <ul class="cstmaccordian">
                        <div class="cstmaccordiandv">
                            <i class="fa fa-caret-right"></i>
                            <h5>District Size</h5>
                        </div>
                        <?php echo $district_sizeoption; ?>
                    </ul>
                </div>
                <!--<select name="taxonomy_program">
                    <?php //echo $programoption; ?>
                </select>-->
				<?php if( isset($searchtext) ): ?>
	            <div class="pplrstorytags">
                	<h5>Topics</h5>
                    <ul>
						<?php
							foreach($tags as $tag)
							{
								$count = get_counts($tag->term_id, $searchresult);
								if(in_array( $tag->slug, $taxonomy_tags )): $check = 'checked="checked"'; else: $check = ''; endif;
								echo '<li>
										<input type="checkbox" '.$check.' name="story_tags[]" value="'.$tag->slug.'">
										<label>'.$tag->name.'</label>
										<span>('. $count.')</span>
									 </li>';
							}
                        ?>
                    </ul>
                </div>
                <?php endif; ?>
                <div class="showallstories">
                    <a href="<?php echo site_url();?>/stories/?action=showall">Show All Examples</a>
                </div>
                <input type="submit" name="action" value="Search" />
            </form>
        </aside>
    <?php
}
*/

/* not needed for OET. Should pull the Spacious parts out (or use function_exists) before enabling again

function story_entry_meta() {
   if ( 'stories' == get_post_type() ) :
      echo '<footer class="entry-meta-bar clearfix">';
      echo '<div class="entry-meta clearfix">';
      ?>

      <span class="by-author author vcard"><a class="url fn n" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author(); ?></a></span>

      <?php
      $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
      if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
         $time_string .= '<time class="updated" datetime="%3$s">%4$s</time>';
      }
      $time_string = sprintf( $time_string,
         esc_attr( get_the_date( 'c' ) ),
         esc_html( get_the_date() ),
         esc_attr( get_the_modified_date( 'c' ) ),
         esc_html( get_the_modified_date() )
      );
      printf( __( '<span class="date"><a href="%1$s" title="%2$s" rel="bookmark">%3$s</a></span>', 'spacious' ),
         esc_url( get_permalink() ),
         esc_attr( get_the_time() ),
         $time_string
      ); ?>

      <?php if( has_category() ) { ?>
         <span class="category"><?php the_category(', '); ?></span>
      <?php } ?>

      <?php if ( comments_open() ) { ?>
         <span class="comments"><?php comments_popup_link( __( 'No Comments', 'spacious' ), __( '1 Comment', 'spacious' ), __( '% Comments', 'spacious' ), '', __( 'Comments Off', 'spacious' ) ); ?></span>
      <?php } ?>

      <?php edit_post_link( __( 'Edit', 'spacious' ), '<span class="edit-link">', '</span>' ); ?>

      <?php if ( ( spacious_options( 'spacious_archive_display_type', 'blog_large' ) != 'blog_full_content' ) && !is_single() ) { ?>
         <span class="read-more-link"><a class="read-more" href="<?php the_permalink(); ?>"><?php _e( 'Read more', 'spacious' ); ?></a></span>
      <?php } ?>

      <?php
      echo '</div>';
      echo '</footer>';
   endif;
}
*/

function get_sort_box($post_ids=null){
	global $scp_session;
	
	if (!isset($scp_session))
		$scp_session = WP_Session::get_instance();
	
	$sort = 0;
	if (isset($scp_session['story_sort']))
		$sort = (int)$scp_session['story_sort'];
	?>
	<div class="sort-box">
		<span class="sortoption"></span>
		<span class="sort-story" title="Sort stories"><i class="fa fa-sort" aria-hidden="true"></i></span>
		<div class="sort-options">
			<ul>
				<li data-value="0"<?php if ($sort==0): ?> class="cs-selected"<?php endif; ?>><a href="javascript:void(0);"><span>Newest</span></a></li>
				<li data-value="1"<?php if ($sort==1): ?> class="cs-selected"<?php endif; ?>><a href="javascript:void(0);"><span>Oldest</span></a></li>
				<li data-value="2"<?php if ($sort==2): ?> class="cs-selected"<?php endif; ?>><a href="javascript:void(0);"><span>A-Z</span></a></li>
				<li data-value="3"<?php if ($sort==3): ?> class="cs-selected"<?php endif; ?>><a href="javascript:void(0);"><span>Z-A</span></a></li>
			</ul>
		</div>
		<select class="sort-selectbox" data-posts="<?php echo json_encode($post_ids); ?>">
			<option value="0"<?php if ($sort==0): ?>  selected<?php endif; ?>>Newest</option>
			<option value="1"<?php if ($sort==1): ?>  selected<?php endif; ?>>Oldest</option>
			<option value="2"<?php if ($sort==2): ?>  selected<?php endif; ?>>A-Z</option>
			<option value="3"<?php if ($sort==3): ?>  selected<?php endif; ?>>Z-A</option>
		</select>
	</div>
	 <?php
}

function apply_sort_args($args){
	global $scp_session;
	
	if (!isset($scp_session))
		$scp_session = WP_Session::get_instance();
	
	$sort = 0;
	if (isset($scp_session['story_sort']))
		$sort = (int)$scp_session['story_sort'];

	switch($sort){
		case 0:
			$args['orderby'] = 'post_date';
			$args['order'] = 'DESC';
			break;
		case 1:
			$args['orderby'] = 'post_date';
			$args['order'] = 'ASC';
			break;
		case 2:
			$args['orderby'] = 'post_title';
			$args['order'] = 'ASC';
			break;
		case 3:
			$args['orderby'] = 'post_title';
			$args['order'] = 'DESC';
			break;
	}
	return $args;
}
?>
