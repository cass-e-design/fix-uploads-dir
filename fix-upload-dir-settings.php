<?php

class fix_upload_dir_settings {
	static $settings_page = 'fix_upload_dir_settings';
	static $dir_slug = 'fix_upload_dir';
	
	public static function hooks() {
		add_action('admin_menu', array(__class__, 'menu'));
		add_action('admin_init', array(__class__, 'register'));
		
        add_filter( 'plugin_action_links_' . FIX_UPLOAD_DIR_BASE, array( __CLASS__, 'action_links' ) );
	}
	
	public static function register() {
		add_settings_section(
			self::$dir_slug, //slug
			'Directory', //title
			array( __class__, 'section'), //callback
			self::$settings_page //page
		);
		
		add_settings_field(
			self::$dir_slug, //id
			'Directory', //title
			array(__class__,  'field'), //callback,
			self::$settings_page, //page
			'fix_upload_dir' //section
		);
		register_setting(self::$dir_slug, self::$dir_slug, array(__class__, 'validate'));
	}
	
	public static function action_links($links) {
        array_unshift( $links, '<a href="'. esc_url( admin_url( 'options-general.php?page='.self::$settings_page) ) .'">Settings</a>' );
        return $links;
	}
	
	public static function validate($input) {
		$input = rtrim($input, '/');
		$input = ltrim($input, '/');
		if (!isset($input) || $input == null || $input == '') {
			$input = 'wp-content/uploads';
		}
		return $input;
	}
	
	public static function menu() {
		add_options_page(__('Fix Upload Directory'), __('Fix Upload Dir'), 'manage_options', self::$settings_page, array(__class__, 'page'));
	}
	
	public static function page() {
		$dir = get_option(self::$dir_slug);
		if (!isset($dir) || $dir == '' || $dir == null)
			$dir = 'wp-content/uploads';
		
		?>
		<div class="wrap">
			<div class="icon32" id="icon-options-general"></div>
			<h2><?php echo "UPLOADS" ?></h2>
			<p><?php echo defined('UPLOADS') ? 'UPLOADS current value: <code>'.UPLOADS.'</code>' : 'UPLOADS does not appear to be defined'; ?></p>
			 
			<form action="options.php" method="post">
				<?php settings_fields(self::$dir_slug); ?>
				<label for="fix_upload_dir"><?php echo __('Upload Directory from ABSPATH. Do not include a following or preceeding slash')?></label><br>
				<input type="text" name="fix_upload_dir" id="fix_upload_dir" value="<?php echo htmlspecialchars($dir); ?>" placeholder="<?php echo 'wp-content/uploads'; ?>">
				<?php submit_button(); ?>
			</form>
		</div><!-- wrap -->
		<?php 
	}
	
	public static function section($section) {
		var_dump($section);
	}
	
	public static function field() {
		
	}
}
fix_upload_dir_settings::hooks();