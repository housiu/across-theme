<div class="my_meta_control">
 
	<h3>Select Slider Order</h3>

	<p><strong>Beginning</strong></p>
	<?php while($mb->have_fields_and_multi('slider_option_group')): ?>
	<?php $mb->the_group_open(); ?>
 
		<?php $mb->the_field('slider_option'); ?>
		
		<select name="<?php $mb->the_name(); ?>">
			<option value=""></option>
			<?php 
				$slider_option_obj = get_posts( array( 'post_type' => 'slider', ));
				foreach ($slider_option_obj as $slider) {
					//print_r($slider);
					$modifieddate = $slider->post_modified;
					?>
					<option value="<?php echo $slider->ID; ?>" <?php $mb->the_select_state($slider->ID); ?>><?php echo $slider->post_title; ?> --> Last Modified Date: <?php echo $slider->post_modified; ?></option>
					<?php
				}
			?>
		</select>
		<br/>
		<?php $mb->the_field('slider_url'); ?>
		<p>
			Enter the URL to redirect to: 
			<input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
			<a href="#" class="dodelete button">Remove</a>
		</p>

		<?php $mb->the_field('slider_caption'); ?>
		<p>
			Enter the Caption to for the slider: 
			<input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
			<a href="#" class="dodelete button">Remove</a>
		</p>
 
	<?php $mb->the_group_close(); ?>
	<?php endwhile; ?>
		<p><strong>End</strong</p>
	<p><a href="#" class="docopy-slider_option_group button">Add</a></p>
	
	<p class="meta-save"><button type="submit" class="button-primary" name="save"><?php _e('Update');?></button></p>

</div>