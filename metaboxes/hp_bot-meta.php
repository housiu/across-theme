<?php 
	add_action('admin_print_footer_scripts','my_admin_print_footer_scripts',99); 
?>


<div class="my_meta_control">

	<img src="<?php echo get_bloginfo('template_url') . '/images/homepage_layout.png'; ?>" width="400" height="300">

	
	<?php
		$row_section = array ('md_group','bt_group');
		foreach ($row_section as $row ) {
	?>
		<?php while($mb->have_fields_and_multi( $row )): ?>
		<?php $mb->the_group_open(); ?>

		<?php
			if ( $row == 'md_group' ) {
				$md_section = array (
					'md_l' => 'Middle Section - Large ',
					'md_s' => 'Middle Section - Small ',
					);
			} elseif ( $row == 'bt_group' ) {
				$md_section = array (
					'bt_l' => 'Bottom Section - Left ',
					'bt_c' => 'Bottom Section - Centre ',
					'bt_r' => 'Bottom Section - Right ',
					);
			}
			foreach ($md_section as $key => $value ) {
				$logo_key = $key . '_logo';
		?>
				<h3><?php echo $value; ?></h3>
				<div>
					<?php $mb->the_field($logo_key); ?>
					<p><?php echo $value . "Label"; ?></p>
					<input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>

					<p><?php echo $value . "Content"; ?></p>
					<div class="customEditor">
						<?php $mb->the_field($key); ?>
						<textarea id="<?php $mb->the_name(); ?>" rows="10" cols="50" name="<?php $mb->the_name(); ?>" rows="3"><?php echo esc_html( wp_richedit_pre($mb->get_the_value()) ); ?></textarea>
					</div>
				</div>
		<?php
			}
		?>

		<?php $mb->the_group_close(); ?>
		<?php endwhile; ?>
	<?php
		} // end of foearch row section group
	?>

	<p class="meta-save"><button type="submit" class="button-primary" name="save"><?php _e('Update');?></button></p>

</div>