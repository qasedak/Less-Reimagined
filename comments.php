<h3 id="comments">
	<?php comments_number( esc_html__( 'no responses' ,'moreOrLess' ), esc_html__( 'one response' ,'moreOrLess' ), esc_html__( '% responses' ,'moreOrLess' ) ); esc_html_e( ' for ' ,'moreOrLess'); the_title(); ?>
</h3>
<?php the_comments_pagination( array(
	'prev_text' => '<span class="screen-reader-text">' . __( 'Previous', 'moreOrLess' ) . '</span>',
	'next_text' => '<span class="screen-reader-text">' . __( 'Next', 'moreOrLess' ) . '</span>',
) );
?>
<ol class="commentlist">
	<?php wp_list_comments(); ?>
	<?php comment_form(); ?>
</ol>