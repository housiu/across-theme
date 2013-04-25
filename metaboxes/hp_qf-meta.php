<?php add_action('admin_print_footer_scripts','my_admin_print_footer_scripts',99); ?>

<div class="my_meta_control">

	<h3>Quick Feature Boxes</h3>
	
	<?php while($mb->have_fields_and_multi('qf_group')): ?>
	<?php $mb->the_group_open(); ?>

	<?php
		$qfeatures = array (
			'top_qf' => 'Top Box ',
			'mid_qf' => 'Middle Box ',
			'bot_qf' => 'Bottom Box ',
			);
		foreach ($qfeatures as $key => $value ) {
			$logo_key = $key . '_logo';
	?>
			<?php $mb->the_field($logo_key); ?>
			<p><?php echo $value . "Label"; ?>
			<input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>

			<p><?php echo $value . "Content"; ?></p>
			<div class="customEditor">
				<?php $mb->the_field($key); ?>
				<textarea id="<?php $mb->the_name(); ?>" rows="10" cols="50" name="<?php $mb->the_name(); ?>" rows="3"><?php echo esc_html( wp_richedit_pre($mb->get_the_value()) ); ?></textarea>
			</div>
	<?php
		}
	?>

	<?php $mb->the_group_close(); ?>
	<?php endwhile; ?>

	<p class="meta-save"><button type="submit" class="button-primary" name="save"><?php _e('Update');?></button></p>

</div>