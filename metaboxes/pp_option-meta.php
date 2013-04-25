<div class="pp_option">
	<h1>Test h1</h1>
	<h2>Test h2</h2>
	<h3>Test h3</h3>
	<h4>Test h4</h4>
	<h5>Test h5</h5>
	<h6>Test h6</h6>
	<?php
		
		$args = array(
			'orderby' => 'name',
			'order' => 'ASC',
			'hide_empty' => 0,
			'hierarchical' => 0,
			'taxonomy' => 'program_name'
		);
		$categories = get_categories( $args );
		//print_r($categories);
	?>
	<?php $mb->the_field('select_program_name'); ?>

	<?php $select_program_name = $mb->get_the_value(); ?>
	<p>
	<label>Select Program Name</label><br/>
	<select name="<?php $mb->the_name(); ?>">
		<option value="">NO PROGRAM</option>
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
	
	<label>Select Additional Pages</label><br/>
	
	<?php while($mb->have_fields_and_multi('general_page_group')): ?>
	<?php $mb->the_group_open(); ?>

		<?php

		$query_args = array(
			'post_type' => 'program',
			'tax_query' => array(
				array(
					'taxonomy' => 'program_name',
					'field' => 'slug',
					'terms' => $select_program_name,
				)
			)
		);
		$list_post = new WP_Query( $query_args );
		
		$mb->the_field('gen_page');
		?>
			
			<select name="<?php $mb->the_name(); ?>">
				<option value=""></option>
		<?php
			while ( $list_post->have_posts() ) : $list_post->the_post();
				$postid = get_the_ID();
				$postname = get_the_title();
				$postupdatetime = get_post_modified_time();
				$formatedpostupdatetime = date('Y/m/d \a\t g:i A',$postupdatetime);
				?>
					<option value="<?php echo $postid; ?>" <?php $mb->the_select_state($postid); ?>><?php echo $postname; ?> ---- Last Modified Date: <?php echo $formatedpostupdatetime; ?> </option>;
					
				<?php 
			endwhile;
			wp_reset_query();
		?>
			</select>
			<a href="#" class="dodelete button">Remove</a>
			<br/>

	<?php $mb->the_group_close(); ?>
	<?php endwhile; ?>

	<p><a href="#" class="docopy-general_page_group button">Add</a></p>


	<!-- Beginning of Gallery Display Options-->

	<label>Select Gallery Posts to display in the Gallery tab.</label><br/>

	<p>You can leave all the select box blank to not show Gallery tab.</p>

	<?php while($mb->have_fields_and_multi('pp_flickr_set_group')): ?>
	<?php $mb->the_group_open(); ?>
	<?php
		$query_args = array(
			'post_type' => 'gallery',
			'tax_query' => array(
				array(
					'taxonomy' => 'program_name',
					'field' => 'slug',
					'terms' => $select_program_name,
				)
			)
		);
		$list_post = new WP_Query( $query_args );
		
		$mb->the_field('pp_flickr_set');
		?>
			
			<select name="<?php $mb->the_name(); ?>">
				<option value=""></option>
		<?php
			while ( $list_post->have_posts() ) : $list_post->the_post();
				$postid = get_the_ID();
				$postname = get_the_title();
				$postupdatetime = get_post_modified_time();
				$formatedpostupdatetime = date('Y/m/d \a\t g:i A',$postupdatetime);
				?>
					<option value="<?php echo $postid; ?>" <?php $mb->the_select_state($postid); ?>><?php echo $postname; ?> ---- Last Modified Date: <?php echo $formatedpostupdatetime; ?> </option>;
					
				<?php 
			endwhile;
			wp_reset_query();
		?>
			</select>
			<a href="#" class="dodelete button">Remove</a>
			<br/>
	<?php $mb->the_group_close(); ?>
	<?php endwhile; ?>

	<p><a href="#" class="docopy-pp_flickr_set_group button">Add</a></p>
	<!-- End of Gallery Display Options-->

</div>