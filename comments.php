<h3 id="comments">
	<?php comments_number( esc_html__( 'no responses' ,'less-reimagined' ), esc_html__( 'one response' ,'less-reimagined' ), esc_html__( '% responses' ,'less-reimagined' ) ); esc_html_e( ' for ' ,'less-reimagined'); the_title(); ?>
</h3>
<?php the_comments_pagination( array(
	'prev_text' => '<span class="screen-reader-text">' . __( 'Previous', 'less-reimagined' ) . '</span>',
	'next_text' => '<span class="screen-reader-text">' . __( 'Next', 'less-reimagined' ) . '</span>',
) );
?>
<ol class="commentlist">
	<?php wp_list_comments(); ?>
	<?php comment_form(); ?>
</ol>