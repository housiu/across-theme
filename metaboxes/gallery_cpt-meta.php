<div class="pp_properties">
 
	<!--- Beginning Flickr Set associate to post -->

	<label>Select Flickr Set asssoicate to this Gallery post</label><br/>

	<?php $mb->the_field('pp_flickr_set'); ?>


	<?php
		require_once( dirname(__DIR__) . '/library/phpFlickr.php' );

		//get Flickr setting from the option page
		$themeoption = get_option('optionsframework_bones');
		$api_key = $themeoption['flickrapikey'];
		$user_id = $themeoption['flickrid'];
		$flickr_choice = $themeoption['flickrset'];
	
		$f = new phpFlickr($api_key);
		
		switch($flickr_choice) {
			case 'collection' :
				/*
				$flickr_data = $f->galleries_getList($user_id, 50, 1);
				if (is_array($flickr_data) && !empty($flickr_data)) {
					?>
			<select name="flickr_set_id" id="flickr_set_id" style="width:100px;" multiple size="10">
			<?php
					foreach($flickr_data['galleries']['gallery'] as $key => $flickr) {
						?>
				<option value="<?php echo $flickr['id']; ?>" <?php selected( $selected , $flickr['id'] ); ?>><?php echo $flickr['title']; ?></option>
						<?php
					}
					echo '</select>';
				} else {
					?>
						<p><?php _e('There are no Flickr galleries available for user ID'); ?> <?php echo $user_id; ?> <?php _e('or there is a problem with API KEY'); ?> <?php echo $api_key; ?></p>
					<?php
				}
				*/
				?>
					<h4>Flickr Collections option is not available yet.</h4> 
					<p>
						Please change to "Set" instead of "Collection" in the <strong><i>Set</i></strong> option under
						<a href="<?php echo get_admin_url() . 'themes.php?page=options-framework'; ?>">Theme Options Page</a>.
					</p>
				<?php
				break;
			// Flickr Set option is set to "SET"
			default :
				$flickr_data = $f->photosets_getList($user_id, 50, 1);
				$flick_data_set = $flickr_data['photoset'];
				if (is_array($flickr_data) && !empty($flickr_data)) {
					?>
					<select name="<?php echo $mb->the_name(); ?>" id="<?php echo $mb->the_name(); ?>" >
						<option value=""></option>
					<?php
						foreach($flick_data_set as $key => $flickr) {							
							?>
							<option value="<?php echo $flickr['id']; ?>" <?php $mb->the_select_state($flickr['id']); ?> ><?php echo $flickr['title']; ?></option>
							<?php
						}
					echo '</select>';
				}	
				else {
					?>
						<h4>No Flickr Set found.</h4> 
						<p>
							Please double check the <strong><i>Flickr API Key, User Id, and Set </i></strong>options under
							<a href="<?php echo get_admin_url() . 'themes.php?page=options-framework'; ?>">Theme Options Page</a>.
						</p>
					<?php
				}							
			break;
		}
	?>
	<!-- End of Gallery Display Options-->

</div>