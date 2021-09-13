<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

get_header();
error_reporting(0);
?>

<main id="site-content" role="main">

	<?php

	$archive_title    = '';
	$archive_subtitle = '';

	$query = get_search_query();
	$custom_query = false;
	if (substr($query, 0, 6) === "status" || substr($query, 0, 6) === "uptime") {
		$custom_query = true;
	}

	if ( is_search() && !$custom_query ) {
		global $wp_query;

		$archive_title = sprintf(
			'%1$s %2$s',
			'<span class="color-accent">' . __( 'Search:', 'twentytwenty' ) . '</span>',
			'&ldquo;' . get_search_query() . '&rdquo;'
		);

		if ( $wp_query->found_posts ) {
			$archive_subtitle = sprintf(
				/* translators: %s: Number of search results. */
				_n(
					'We found %s result for your search.',
					'We found %s results for your search.',
					$wp_query->found_posts,
					'twentytwenty'
				),
				number_format_i18n( $wp_query->found_posts )
			);
		} else {
			$archive_subtitle = __( 'We could not find any results for your search. You can give it another try through the search form below.', 'twentytwenty' );
		}

	} elseif ( ! is_home() ) {
		$archive_title    = get_the_archive_title();
		$archive_subtitle = get_the_archive_description();
	}

	if ( ( $archive_title || $archive_subtitle ) && !$custom_query ) {
		?>

		<header class="archive-header has-text-align-center header-footer-group">

			<div class="archive-header-inner section-inner medium">

				<?php if ( $archive_title ) { ?>
					<h1 class="archive-title"><?php echo wp_kses_post( $archive_title ); ?></h1>
				<?php } ?>

				<?php if ( $archive_subtitle ) { ?>
					<div class="archive-subtitle section-inner thin max-percentage intro-text"><?php echo wp_kses_post( wpautop( $archive_subtitle ) ); ?></div>
				<?php } ?>
			</div><!-- .archive-header-inner -->

		</header><!-- .archive-header -->

		<?php
	} elseif ($custom_query) {
		$params = explode(" ", $query);
		$filtered = [];
		$local = in_array("local", $params);
		$err = false;
		foreach ($params as $key => $value) {
			if (strlen($value) > 1 && !in_array($value, ["of", "for", "uptime", "status", "local"])) {
				array_push($filtered, $value);
			}
		}

		if (count($filtered) < 1) {
			$err = "Cannot parse query. Please try again.";
		} else {
			$target = $filtered[0];
		}

		$aliases["cc_sys_ram"] = ["ram", "memory"];
		$aliases["cc_sys_disk"] = ["disk", "drive", "space", "hdd", "ssd", "storage"];
		$aliases["cc_sys_cpu"] = ["cpu", "processor", "usage"];

		echo '<header class="archive-header has-text-align-center header-footer-group">';
		echo '<div class="archive-header-inner section-inner medium">';
		echo '<h1 class="archive-title">CentiCorp Monitor &reg;</h1>';

		if ($err) {
			// Cannot parse query
			echo '<div class="archive-subtitle section-inner thin max-percentage intro-text">'.$err.'</div>';

		} elseif (!$local) {
			// Look up information for monitored sites
			echo '<div class="archive-subtitle section-inner thin max-percentage intro-text">Status for <i>'.$target.'</i></div>';

			// Get uptime from CentiCorp servers
			$result = $rpc->sync('uptime', [$target]);

			if ($result["err"]) {
				echo '<div class="archive-subtitle section-inner thin max-percentage intro-text">Host cannot be resolved. Please check your query and try again.</div>';
			} else {
				echo '<div class="archive-subtitle section-inner thin max-percentage intro-text">Current status: '.($result["up"] ? "up" : "down").'</div>';
				echo '<table><tr><th>Period</th><th>Uptime %</th></tr>';
				foreach ($result["uptime"] as $key => $value) {
					echo '<tr><td>'.$value[0].'</td><td>'.$value[1].'</td></tr>';
				}
			}

		} else {
			// Local
			echo '<div class="archive-subtitle section-inner thin max-percentage intro-text">Status for <i>CentiCorp Server</i></div>';
			$lookup = $target;
			foreach ($aliases as $key => $value) {
				if (in_array($target, $value)) {
					$lookup = $key;
				}
			}
			if (array_key_exists($lookup, $_STATUS)) {
				echo '<div class="archive-subtitle section-inner thin max-percentage intro-text">'.$lookup.': '.$_STATUS[$lookup].'</div>';
			} else {
				echo '<div class="archive-subtitle section-inner thin max-percentage intro-text">System status variable not found.</div>';
			}
		}
		echo '</table>';
		echo '</div>';
		echo '</header>';
	}

	if ( have_posts() ) {

		$i = 0;

		while ( have_posts() ) {
			$i++;
			if ( $i > 1 ) {
				echo '<hr class="post-separator styled-separator is-style-wide section-inner" aria-hidden="true" />';
			}
			the_post();

			get_template_part( 'template-parts/content', get_post_type() );

		}
	} elseif ( is_search() ) {
		?>

		<div class="no-search-results-form section-inner thin">

			<?php
			get_search_form(
				array(
					'label' => __( 'search again', 'twentytwenty' ),
				)
			);
			?>

		</div><!-- .no-search-results -->

		<?php
	}
	?>

	<?php get_template_part( 'template-parts/pagination' ); ?>

</main><!-- #site-content -->

<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>

<?php
get_footer();
