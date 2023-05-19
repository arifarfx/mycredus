// Add admin menu
add_action('admin_menu', 'gamiwall_add_admin_menu');
function gamiwall_add_admin_menu() {
    add_menu_page('GamiPress Offerwall', 'GamiPress Offerwall', 'manage_options', 'gamiwall-settings', 'gamiwall_settings_page', 'dashicons-money');
}

// Register settings
add_action('admin_init', 'gamiwall_register_settings');
function gamiwall_register_settings() {
    register_setting('gamiwall_settings_page', 'point_type');
}

// Fungsi untuk mengambil jenis poin GamiPress
function get_gamipress_points_type() {
    // Menggunakan fungsi gamipress_get_points_types() untuk mengambil semua jenis poin yang tersedia
    $points_types = gamipress_get_points_types();
    // Mengembalikan hasil
    return $points_types;
}

function gamiwall_settings_page() { ?>
    <form action="options.php" method="post">
        <?php settings_fields('gamiwall_settings_page'); ?>
        <?php do_settings_sections('gamiwall_settings_page'); ?>
        <class="form-table">
<h1>GamiWall Main Settings</h1>
<tr valign="top">
	<th scope="row">Point Type</th>
	<td>
	<select name="point_type">
	<?php
	$args = ["post_type" => "points-type", "posts_per_page" => -1];
	$points_types = get_posts($args);
	$selected_point_type = get_option("point_type");
	if (!empty($points_types)) {
    foreach ($points_types as $points_type) {
        $points_type_title = $points_type->post_title;
        $points_type_slug = get_post_meta(
            $points_type->ID,
            "points_type_slug",
            true
        );
        $selected =
            $selected_point_type === $points_type_slug ? "selected" : "";
        echo "<option value='{$points_type_slug}' {$selected}>{$points_type_title}</option>";
    }
} else {
    echo '<option value="">Tidak ada point type yang ditemukan</option>';
}
?>
</select>
</td>
</tr>
</table>
<?php submit_button(); ?>
</form>
</div>
    <?php
}
