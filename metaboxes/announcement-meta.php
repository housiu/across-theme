<div class="pp_option">
	<?php
	$args = array(
			'orderby' => 'name',
			'order' => 'ASC',
			'hide_empty' => 0,
			'hierarchical' => 0,
			'taxonomy' => 'announcement_type'
		);
		$categories = get_categories( $args );
		//print_r($categories);
	?>
	<?php $mb->the_field('select_announcement_type'); ?>

	<?php $select_announcement_type = $mb->get_the_value(); ?>
	<p>
	<label>Select Announcement Type</label><br/>
	<select name="<?php $mb->the_name(); ?>">
		<option value=""></option>
		<?php
			foreach ($categories as $cat) {
				$catname = $cat->cat_name;
				$catslug = $cat->slug;
				?>
					<option value="<?php echo $catslug; ?>"<?php $mb->the_select_state($catslug); ?>><?php echo $catname; ?></option>
				<?php
			}
			
		?>
		
	</select>
	</p>

</div>