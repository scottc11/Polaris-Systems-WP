<?php

// taxonomy toolbox (taxtb)

// set up Settings API
add_action('admin_init', 'taxtb_options_init' );
function taxtb_options_init(){
    register_setting( 'taxtb_options_options', 'taxtb_options', 'taxtb_clean_postdata' );
}

// Add menu item
function taxtb_menu() {
  add_options_page('Taxonomy Toolbox', 'Taxonomy Toolbox', 'update_plugins', 'taxonomy-toolbox', 'taxtb_options');
}
add_action('admin_menu', 'taxtb_menu');

// Add settings link on plugin page
function taxtb_settings_link($links) { 
  $settings_link = '<a href="options-general.php?page=taxonomy-toolbox">Settings</a>'; 
  array_unshift($links, $settings_link); 
  return $links; 
}
add_filter("plugin_action_links_$plugin_basename", 'taxtb_settings_link' );


function taxtb_options() {
	
	if(isset($_GET['action'])){
		switch ($_GET['action']) {
			case 'recount':
				taxtb_update_counts();
				break;
			case 'kill_empty_tags':
				taxtb_delete_empty_terms('post_tag');
				break;
			case 'kill_empty_cats':
				taxtb_delete_empty_terms('category');
				break;
			case 'clean_orphans':
				taxtb_clean_orphan_data('category');
				break;	
			default:
				# code...
				break;
		}
		wp_redirect('options-general.php?page=taxonomy-toolbox');
	}

	taxtb_form();
}


function taxtb_clean_postdata($data){

	// print_r($data)

}


function taxtb_form() {

	echo '<div class="wrap">
	<div id="icon-options-general" class="icon32"><br/></div><h2>Taxonomy Toolbox</h2>

	<!-- Intro -->
	<p>Taxonomy Toolbox allows you to quickly review and update your Categories, Tags and other taxonomies.</p>
	<!-- <p>These tweaks have come up multiple times when developing WordPress sites, 
	so we built this admin panel to make our job simpler, and now we\'re sharing it with you. </p> -->

	<hr/>';

	// show the summary
	echo taxtb_summary_table();

	echo '
	<a name="converting"></a>
	<h3>Converting Categories and Tags</h3>

	<p>While this plugin is Activated you can convert Tags to Categories, or Categories to Tags 
		via the Bulk Actions menu on their respective admin pages.</p>
	
	<p><b><u>Conversion and Parent/Child relationships</u></b></p>
	<p>Categories support being arranged in a hierarchy, while Tags do not. This difference requires the following measures:</p>
	<ol>
	<li>Categories may not be converted while they are the parent of another category.</li>
	<li>Categories with a parent category can be converted to Tags, but the parent relationship is deleted.</li>
	<li>Tags converted to Categories will not have a parent (or child), but will support them after the conversion.</li>
	</ol>

	<p><b><u>Merging Category and Tag Posts</u></b></p>
	<p>If a Tag to be converted already exists as a Category, then the tag\'s posts will be merged with the categorie\'s posts. 
	Any duplicate post relationships will be deleted along with the redundant Tag definition. 
	The same is true for converting Categories to Tags.</p>
	
	<hr>';


	// show the quick fix actions
	echo '

	<h3>Quick-Fix Taxonomy Actions</h3>
	
	<p>Select an action below for a quick taxonomy fix.</p>
	<ul>
		<li> <b>Recalculate Taxonomy Stats</b> : Sometimes the post counts on Categories or Tags get out of sync. This option will force a recount of relationships defined for all taxonomies.</li>
		<li> <b>Delete Tags With No Posts</b> : If you have a lot of tags defined that you are no longer using, this is the quickest way to get rid of them all.</li>
		<li> <b>Delete Categories With No Posts</b> : This is similar to deleting tags, except that Categories can be hierarchical. Any category with a subcategory defined will NOT be deleted.</li>
		<li> <b>Clean Orphan Data</b> : Any taxonomy data where the defined posts, terms or taxonomy not longer exists is erased. Use this sparingly - we recommend you back up your database first (just in case).</li>
	</ul>
	
	<form method="get" action="options-general.php">
		<input type="hidden" name="page" value="taxonomy-toolbox">
		<select name="action">
		<option value="">-- Select An Action --</option>
		<option value="recount">Recalculate Taxonomy Stats</option>
		<option value="kill_empty_tags">Delete Tags With No Posts</option>
		<option value="kill_empty_cats">Delete Categories With No Posts</option>
		<option value="clean_orphans">Clean Orphaned Data</option>
		</select>

		<p class="submit">
			<input type="submit" class="button-primary" value="'.__('Do It Now').'">
		</p>
	</form>

	<hr>';

	// output duplicates table if there are some
	taxtb_dupe_terms();


	echo '</div>';

}

function taxtb_summary_table(){

	global $wpdb;

	$taxonomies = get_taxonomies(array(),'objects');
	$summary_data = array();

	foreach($taxonomies as $tax) {
		$summary_data[$tax->name] = array(
			'name' => $tax->label,
			'slug' => $tax->name, 
			'type' => $tax->_builtin ? 'WordPress' : 'Custom', 
			'terms' => 0, 
			'objects' => 0, 
			'empty' => 0, 
			'maximum' => 0, 
			'avgposts' => 0,
			'avgterms' => 0
		);
	}


	$sql = "SELECT taxonomy, count(*) as terms, 
				sum(count) as objects, max(count) as maximum, 
				avg(count) as average, sum(count=0) as empty
			FROM {$wpdb->term_taxonomy} 
			GROUP BY taxonomy
			ORDER BY terms DESC";

	$tax_stats = $wpdb->get_results($sql);
	foreach($tax_stats as $tax){
		if(isset($summary_data[$tax->taxonomy])){
			$summary_data[$tax->taxonomy]['terms'] = $tax->terms;
			$summary_data[$tax->taxonomy]['objects'] = $tax->objects;
			$summary_data[$tax->taxonomy]['empty'] = $tax->empty;
			$summary_data[$tax->taxonomy]['maximum'] = $tax->maximum;
			$summary_data[$tax->taxonomy]['avgposts'] = $tax->average;
		}
	}



	$sql = "SELECT tt.taxonomy, 
	count(distinct object_id) as posts , count(*) as terms
			FROM {$wpdb->term_relationships} tr
				INNER JOIN {$wpdb->term_taxonomy} tt 
				ON tr.term_taxonomy_id = tt.term_taxonomy_id 
			GROUP BY tt.taxonomy
			ORDER BY  tt.taxonomy";

	$tax_stats = $wpdb->get_results($sql);
	foreach($tax_stats as $tax){
		if(isset($summary_data[$tax->taxonomy])){
			$summary_data[$tax->taxonomy]['avgterms'] = ($tax->terms/$tax->posts);
		}
	}		



	echo '<h3>Taxonomy Summary</h3>';

	$table = '<table class="widefat fixed">';
	$table .= '<thead><tr valign="left">
		<th align="left">Taxonomy</th>
		<th align="left">Source</th>
		<th>Terms Defined</th>
		<th>Objects Linked</th>
		<th>Unused Terms</th>
		<th>Most Posts/Term</th>
		<th>Average Posts/Term</th>
		<th>Average Terms/Post</th>
		</tr></thead>';

	$row_class = 'alternate';
	foreach($summary_data as $tax) {
		// hide Nav Menu and Link Category 
		if($tax['slug']!='nav_menu' && $tax['slug']!='link_category') {

			$admin_link = '/wp-admin/edit-tags.php?taxonomy='.$tax['slug'];
			// if($tax['slug']=='nav_menu') { $admin_link = '/wp-admin/nav-menus.php'; }

			$table .= '<tr class="'.$row_class.'" align="left">
			<td  align="left"><a href="'.$admin_link.'">'.$tax['name'].'</a></td>
			<td  align="left">'.$tax['type'].'</td>
			<td>'.number_format($tax['terms']).'</td>
			<td>'.number_format($tax['objects']).'</td>
			<td>'.number_format($tax['empty']).'</td>
			<td>'.number_format($tax['maximum']).'</td>
			<td>'.number_format($tax['avgposts'],1).'</td>
			<td>'.number_format($tax['avgterms'],1).'</td>
			</tr>';
			$row_class = ($row_class=='') ? 'alternate' : '';
		}
	}

	$table .= '</table>';

	echo $table;

	echo '

	<p>Note: <i>Nav Menu items and Link Categories are also stored in the WordPress Taxonomy tables, 
	but are not displayed in this summary as Nav Menus have a dedicated <a href="/wp-admin/nav-menus.php">admin page</a>, 
	and Link Categories are no longer part of the WordPress core functionality.</i></p>

	<hr/>';

}


function taxtb_dupe_terms(){

	global $wpdb;

	// Find terms defined for both tags and cats
 	$sql = "SELECT terms.*, count(*), sum(count) taxonomies 
		FROM {$wpdb->term_taxonomy} as tt INNER JOIN {$wpdb->terms} as terms ON tt.term_id = terms.term_id
		WHERE tt.taxonomy = 'category' OR tt.taxonomy = 'post_tag'
		GROUP BY terms.term_id HAVING count(*) > 1 ORDER BY name ";
	$term_stats = $wpdb->get_results($sql);	

	if(empty($term_stats)) { return; }

	echo '<h3>Duplicated Terms in Categories and Tags</h3>';

	echo '<p>There are '.count($term_stats).' terms defined in BOTH categories and tags.</p>
	<p>Although it is sometimes appropriate, usually terms should be either a category <i>or</i> a tag, but not both.
		We recommend you use the conversion tools to merge the data into one taxonomy whenever possible.</p>
	<p>To merge Tag data in to a Category, go to the Tags admin page and find the tag to merge, 
		click the checkbox and then select "Convert to Category" in the Bulk Actions menu and click Apply.
		<i>See the <a href="#converting">Converting Categories and Tags</a> section above for more info about merging.</i>
	</p>';

	$table = '<table class="widefat fixed">';
	$table .= '<thead><tr>
		<th>Name</th>
		<th>Slug</th>
		<th>Category Posts</th>
		<th>Tag Posts</th>
		<th>Common Posts</th>
		<th>Unique Posts</th>
		</tr></thead>';

	$row_class = 'alternate';
	foreach($term_stats as $row) {

		$sql = "SELECT sum(taxonomy='category') as cat_posts, 
				sum(taxonomy='post_tag') as tag_posts, 
				count(distinct object_id) as uniques
			FROM {$wpdb->term_relationships} tr INNER JOIN {$wpdb->term_taxonomy} tt 
				ON tr.term_taxonomy_id = tt.term_taxonomy_id
			WHERE tt.term_id = {$row->term_id}
				AND (tt.taxonomy = 'category' OR tt.taxonomy = 'post_tag')";
		$counts = $wpdb->get_row($sql);

		$duplicates = ($counts->cat_posts + $counts->tag_posts) - $counts->uniques;

		$table .= '<tr class="'.$row_class.'" align="left">
			<td  align="left">'.$row->name.'</a></td>
			<td  align="left">'.$row->slug.'</td>
			<td><a href="/wp-admin/edit.php?category_name='.$row->slug.'">'.number_format($counts->cat_posts).'</a></td>
			<td><a href="/wp-admin/edit.php?tag='.$row->slug.'">'.number_format($counts->tag_posts).'</a></td>
			<td>'.number_format($duplicates).'</td>
			<td>'.number_format($counts->uniques).'</td>
			</tr>';
		$row_class = ($row_class=='') ? 'alternate' : '';
	}

	$table .= '</table> <hr/>';

	echo $table;



}


function taxtb_update_counts() {

 	global $wpdb;

 	$sql = "UPDATE {$wpdb->term_taxonomy} tt 
			INNER JOIN (
				SELECT tr.term_taxonomy_id, COUNT(object_id) total 
				FROM {$wpdb->term_relationships} tr 
				GROUP BY tr.term_taxonomy_id) as tt_total 
			ON tt.term_taxonomy_id = tt_total.term_taxonomy_id
			SET tt.count = tt_total.total";

	$wpdb->query($sql);
 }


function taxtb_delete_empty_terms($taxonomy) {

	taxtb_update_counts();  // make sure we're up to date

	global $wpdb;

	$sql = "DELETE FROM {$wpdb->term_taxonomy} WHERE count = 0 AND taxonomy='$taxonomy' ";

	if($taxonomy=='category'){
		$sql .= " AND term_id NOT IN ( SELECT id FROM ( 
					SELECT parent as id FROM {$wpdb->term_taxonomy} 
					WHERE taxonomy='$taxonomy' AND parent!=0 ) as parents
				) ";
	}

	$wpdb->query($sql);

}


function taxtb_clean_orphan_data() {
	
	global $wpdb;
	// just clean terms for now
	$sql = "DELETE FROM {$wpdb->terms} 
			WHERE term_id NOT IN (Select distinct(term_id) as id from {$wpdb->term_taxonomy} as used_terms) ";
	$wpdb->query($sql);

}


function taxtb_is_parent($term_id, $taxonomy){

	global $wpdb;
	$sql = "SELECT COUNT(*) FROM {$wpdb->term_taxonomy} WHERE parent = $term_id AND taxonomy = '$taxonomy'";
	$result = $wpdb->get_var( $sql );
	return $result > 0;

}




// Here's the nasty kludge to added our bulk actions
// refer to https://www.skyverge.com/blog/add-custom-bulk-action/
// might be worth looking at https://www.skyverge.com/blog/add-custom-bulk-action/#comment-310 (Andrew)


add_action('admin_footer-edit-tags.php', 'taxtb_bulk_admin_footer');
 
function taxtb_bulk_admin_footer() {

	global $taxonomy;

	$option_text = '';
	if($taxonomy == 'post_tag') { $option_text = 'Convert to Category'; }
	if($taxonomy == 'category') { $option_text = 'Convert to Tag'; }

	if($option_text != '') {	
	?>
	<script type="text/javascript">
	jQuery(document).ready(function() {
	jQuery('<option>').val('convert').text('<?php _e($option_text)?>').appendTo("select[name='action']");
	jQuery('<option>').val('convert').text('<?php _e($option_text)?>').appendTo("select[name='action2']");
	});
	</script>
	<?php
	}
}


add_action('load-edit-tags.php', 'taxtb_bulk_actions');
 
function taxtb_bulk_actions() {
 
 	global $wpdb;
	// 1. get the action
	$wp_list_table = _get_list_table('WP_Terms_List_Table');
	$action = $wp_list_table->current_action();

	if($action){

		switch($action) {
		case 'convert':

			// 2. security check
			check_admin_referer('bulk-tags');

			// if we set up user permissions/capabilities, the code might look like:
			//if ( !current_user_can($post_type_object->cap->export_post, $post_id) )
	  		//  pp_die( __('You are not allowed to export this post.') );	 	

	 		// 3. Perform the action
			global $taxonomy;

	    	$converted = 0;
	    	$failed = 0;
	    	$merged = 0;

	    	$paged = intval($_POST['paged']);
	    	$term_ids = $_POST['delete_tags'];
	    	$target_taxonomy = ($taxonomy=='category') ? 'post_tag' : 'category';

			foreach( $term_ids as $term_id ) {
				$term = get_term( $term_id, $taxonomy);
				$target_term = get_term( $term_id, $target_taxonomy);
				if(!empty($term)) {

					error_log(print_r($term,1));
					if(taxtb_is_parent($term_id,$taxonomy) ) {
						// This item is a parent of other things 
						// so we will not touch it at this stage
						$failed++;
					}

					elseif(!empty($target_term)) {

						// the term already exists for target taxonomy
						// so we must merge (move new items and delete duplicates)

						// move any non-duplicated relationships to new taxonomy
						$old_termtax_id = $term->term_taxonomy_id;
						$new_termtax_id = $target_term->term_taxonomy_id;
						$sql = "UPDATE {$wpdb->term_relationships} 
						SET term_taxonomy_id = $new_termtax_id 
						WHERE term_taxonomy_id = $old_termtax_id 
						AND object_id NOT IN (
							SELECT id FROM 
								(SELECT object_id as id FROM {$wpdb->term_relationships} 
									WHERE term_taxonomy_id = $new_termtax_id
								) as existing
							)
						";
						$result = $wpdb->query($sql);

						if(FALSE  === $result) {
							$failed++;
						} else {
							// delete the redundant term_taxonomy and any duplicate realtionships left
							wp_delete_term( $term_id, $taxonomy );
							$merged++;
						}

					} else {

						// super simple conversion
						// no potential orphans or term collisions
						$sql = "UPDATE {$wpdb->term_taxonomy} 
							SET taxonomy = '$target_taxonomy' 						
							WHERE term_id = $term_id 
								AND taxonomy = '$taxonomy'";
						error_log($sql);
						$result = $wpdb->query($sql);
						if(FALSE === $result){
							$failed++;
						} else {
							$converted++;
						}

					}
					
				}
			}

			// update counts for each 
			taxtb_update_counts();

			// build the redirect url
			$q_args = array( 'taxonomy' => $taxonomy );
			if( $paged > 1) { $q_args['paged'] = $paged; };
			// if(isset($_POST['s'])) { $q_args['s'] = $_POST['s']; };
			$q_args['converted'] = $converted;
			$q_args['merged'] = $merged;
			$q_args['failed'] = $failed;
			$q_args['ids'] = join(',', $term_ids);

			$sendback = add_query_arg( $q_args, '' );

			break;
		default: 
			return;
		} 	
 
		// 4. Redirect client
		wp_redirect($sendback);
		exit();
	}
}


add_action('admin_notices', 'taxtb_bulk_admin_notices');
 
function taxtb_bulk_admin_notices() {
 
	global $pagenow, $taxonomy;

	if( isset($_REQUEST['converted']) ) {

		$converted =  (int) $_REQUEST['converted'] ;
		$merged = (int) $_REQUEST['merged'];
		$failed = (int) $_REQUEST['failed'];

		if($pagenow == 'edit-tags.php'){ 
			if($converted) {
				$message = sprintf( _n( '1 Item converted.', '%s items converted.', $converted ), number_format_i18n( $converted ) );
				echo "<div class=\"updated\"><p>{$message}</p></div>";
			}
			// check for merges here...
			if($merged){
				$message = sprintf( _n( '1 Item merged.', '%s items merged.', $merged ), number_format_i18n( $merged ) );
				echo "<div class=\"updated\"><p>{$message}</p></div>";
			}
			if($failed){
				$message = sprintf( _n( '1 Item failed to be converted.', '%s items failed to be converted.', $failed ), number_format_i18n( $failed ) );
				echo "<div class=\"updated\"><p>{$message}</p></div>";
			}
			
		}
	}
}