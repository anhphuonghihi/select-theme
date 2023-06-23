<?php
// Product Screen: Màn hình chỉnh sửa/thêm mới sản phẩm
//Đăng ký meta box cho sản phẩm
function wporg_add_custom_box() {
	$screens = [ 'product' ];
	foreach ( $screens as $screen ) {
		add_meta_box(
			'wporg_box_id',
			'Chọn theme',
			'select_theme_custom_box_html',
			$screen
		);
	}
}
add_action( 'add_meta_boxes', 'wporg_add_custom_box' );

function select_theme_custom_box_html( $post ) {
	$value = get_post_meta( $post->ID, '_wporg_meta_key', true );
	?>
	<select name="hc_select_field" id="hc_select_field" class="postbox">
		<option value="">Chọn theme</option>
		<option value="theme1" <?php selected( $value, 'theme1' ); ?>>Theme1</option>
		<option value="theme2" <?php selected( $value, 'theme2' ); ?>>Theme2</option>
	</select>
	<?php
}
function select_theme_save_postdata( $post_id ) {
	if ( array_key_exists( 'hc_select_field', $_POST ) ) {
		update_post_meta(
			$post_id,
			'_wporg_meta_key',
			$_POST['hc_select_field']
		);
	}
    // print_r($_REQUEST);
    // die();
}
add_action( 'save_post', 'select_theme_save_postdata' );