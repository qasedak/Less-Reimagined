<h3 id="comments">
	<?php comments_number( esc_html__( 'no responses' ,'lessReimagined' ), esc_html__( 'one response' ,'lessReimagined' ), esc_html__( '% responses' ,'lessReimagined' ) ); esc_html_e( ' for ' ,'lessReimagined'); the_title(); ?>
</h3>
<?php the_comments_pagination( array(
	'prev_text' => '<span class="screen-reader-text">' . __( 'Previous', 'lessReimagined' ) . '</span>',
	'next_text' => '<span class="screen-reader-text">' . __( 'Next', 'lessReimagined' ) . '</span>',
) );
?>
<ol class="commentlist">
	<?php wp_list_comments(); ?>
	<?php comment_form(); ?>
</ol>