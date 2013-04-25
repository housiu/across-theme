				</div>	<!-- end of contain_footer_wrapper -->
				
			</div> <!-- end #container -->
							
				<footer class="footer" id="footer" role="contentinfo">

					<div id="inner-footer" class="wrap clearfix">
						
						<nav role="navigation">
								<?php bones_footer_links(); ?>
										</nav>

						<?php 
							$themeoptions = get_option('optionsframework_bones');
							/*
							$number_of_footer = 4
							for ($a = 1; $a < 4 ; $a++) {
								$footer_col_name = 'footer' . $a;
								print_r($footer_col_name);
								
							}*/

						?>
						<div class="threecol first">
							<?php echo $themeoptions['footer1']; ?>
						</div>
						<div class="threecol">
							<?php echo $themeoptions['footer2']; ?>
						</div>
						<div class="threecol">
							<?php echo $themeoptions['footer3']; ?>
						</div>
						<div class="threecol">
							<?php echo $themeoptions['footer4']; ?>
						</div>
						
						<div class="twelvecol first footer_trademark">
							<p class="source-org copyright">&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>.</p>
						</div>

					</div> <!-- end #inner-footer -->

				</footer> <!-- end footer -->
			
		<!-- </div> <!-- end #container -->

		<!-- all js scripts are loaded in library/bones.php -->
		<?php wp_footer(); ?>

	</body>

</html> <!-- end page. what a ride! -->
