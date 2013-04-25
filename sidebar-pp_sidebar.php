				<div id="pp_sidebar" class="sidebar threecol first clearfix" role="complementary">

					<?php if ( is_active_sidebar( 'pp_sidebar' ) ) : ?>

						<?php dynamic_sidebar( 'pp_sidebar' ); ?>

					<?php else : ?>

						<!-- This content shows up if there are no widgets defined in the backend. -->

						<div class="alert alert-help">
							<p><?php _e("Please activate some Widgets.", "bonestheme");  ?></p>
						</div>

					<?php endif; ?>

				</div>