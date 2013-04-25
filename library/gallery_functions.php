<?php
	function get_flickr_photo( $set_id , $per_page , $pagination_enable = false , $pg_tf = '' ) { 
		
		//get Flickr setting from the option page
		$themeoption = get_option('optionsframework_bones');
		$api_key = $themeoption['flickrapikey'];
		$user_id = $themeoption['flickrid'];
		$flickr_choice = $themeoption['flickrset'];

		$request_uri = $GLOBALS['HTTP_SERVER_VARS']['REQUEST_URI'];
			
		if ($request_uri == '' || !$request_uri) $request_uri = $_SERVER['REQUEST_URI'];			

		$cur_page = 1;
		$cur_page_url = ( isset($_SERVER['HTTPS']) && (strtolower($_SERVER['HTTPS'] == 'on') || $_SERVER['HTTPS'] == '1') ) ? "https://".$_SERVER['SERVER_NAME'].$request_uri : "http://".$_SERVER['SERVER_NAME'].$request_uri;
		$cur_page_url = preg_replace("/hilbert-in.com/", "pkhs.nl", $cur_page_url);
		preg_match("/page_ids=(?P<page_ids>\d+)/", $cur_page_url, $matches);
						
		if ($matches) {
			$cur_page = ($matches['page_ids']);
			$match_pos = strpos($cur_page_url, "page_ids=$cur_page") - 1;
			$cur_page_url = substr($cur_page_url, 0, $match_pos);
			if(function_exists('qtrans_convertURL')) {
				$cur_page_url = qtrans_convertURL($cur_page_url);
			}
		}
			
		if (strpos($cur_page_url,'?') === false) $url_separator = '?';
		else $url_separator = '&';
		
		// Check if an set or gallery ID exists
		if ( isset($set_id) ) {

			// Require phpFlickr
			require_once( dirname(__DIR__) . '/library/phpFlickr.php' );
			$f = new phpFlickr($api_key);
			
			// Enable phpFlickr caching
			$f->enableCache("fs", dirname(__DIR__) . '/cache');
		
			// Get all data based on Flickr ID (set or gallery)
			switch ($flickr_choice) {
				case 'set':
					$photos = $f->photosets_getPhotos($set_id,NULL,NULL,$per_page,$cur_page);
					$photo_set_info = $f->photosets_getInfo($set_id);
					$total_photos = $photo_set_info['count_photos'];
					$ghtml .= '<div class="highslide-gallery">';
					$ghtml .=  '<ul>';
					foreach ($photos['photoset']['photo'] as $photo) {
						if ($gallery_link != NULL) {
							$ghtml .=  '<li><a href="'. $gallery_link . '">';
						} else {
							$ghtml .=  '<li><a class="highslide" href="'. $f->buildPhotoURL($photo, 'large') .'" onclick="return hs.expand(this)">';
						}
						$ghtml .=  '<img class="'.$pg_tf.'" src="'. $f->buildPhotoURL($photo, 'square_150') .'" /></a></li>';

					}
					$ghtml .=  '</ul>';
					$ghtml .=  '</div>';
				break;
				
				case 'galleries':
					$photos = $f->galleries_getPhotos($set_id);
					
					foreach ($photos['photos']['photo'] as $photo) {
						$ghtml .=  '<a href="'. $f->buildPhotoURL($photo, 'square_150') .'"><img src="'. $f->buildPhotoURL($photo, 'square_150') .'"></a>';
					}
				break;
			}
		}
		// Pagination
		if ($pagination_enable == true) {
			$number_of_page = $total_photos / $per_page;
			$modular = $total % $per_page;

			if ($modular != 0) { $number_of_page++;}

			$total_number_of_page = ceil($number_of_page);
			$ghtml .= "<div class='gallery-pagination'>";
			$ghtml .= "<br />";
			
			if ($cur_page == 1) {
				$ghtml .="<font class='gallery-page'>&nbsp;&#171; prev&nbsp;</font>&nbsp;&nbsp;&nbsp;&nbsp;";
				$ghtml .="<font class='gallery-cur-page'> 1 </font>&nbsp;";
			} else {
				$prev_page = $cur_page - 1;
				$ghtml .= "<a class='gallery-page' href='{$cur_page_url}{$url_separator}page_ids=$prev_page' title='Prev Page'>&nbsp;&#171; prev </a>&nbsp;&nbsp;&nbsp;&nbsp;";
				$ghtml .= "<a class='gallery-page' href='{$cur_page_url}{$url_separator}page_ids=1' title='Page 1'> 1 </a>&nbsp;";
			}
			
			if ($cur_page - 2 > 2) {
				$start_page = $cur_page - 2;
				$end_page = $cur_page + 2;
				$ghtml .= " ... ";
			} else {
				$start_page = 2;
				$end_page = 6;
			}
			
			for ($count = $start_page; $count <= $end_page; $count += 1) {
				if ($count > $total_number_of_page) break;
				if ($cur_page == $count)
					$ghtml .= "<font class='gallery-cur-page'>&nbsp;{$count}&nbsp;</font>&nbsp;";
				else
					$ghtml .= "<a class='gallery-page' href='{$cur_page_url}{$url_separator}page_ids={$count}' title='Page {$count}'>&nbsp;{$count} </a>&nbsp;";
			}

			if ($count < $total_number_of_page) $ghtml .= " ... ";

			if ($count <= $total_number_of_page)
				$ghtml .= "<a class='gallery-page' href='{$cur_page_url}{$url_separator}page_ids={$total_number_of_page}' title='Page {$total_number_of_page}'>&nbsp;{$total_number_of_page} </a>&nbsp;";

			if ($cur_page == $total_number_of_page) 
				$ghtml .= "&nbsp;&nbsp;&nbsp;<font class='gallery-page'>&nbsp;next &#187;&nbsp;</font>";
		else {
			$next_page = $cur_page + 1;
			$ghtml .= "&nbsp;&nbsp;&nbsp;<a class='gallery-page' href='{$cur_page_url}{$url_separator}page_ids=$next_page' title='Next Page'> next &#187; </a>&nbsp;";
		}
		$ghtml .= "<br />({$total_photos} Photos)";
		$ghtml .= "</div>";
		}
		return $ghtml;
	}

?>