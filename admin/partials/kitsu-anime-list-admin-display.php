<?php
//TODO: change to another place if possible
$max_items = 5;
$options = get_option($this->plugin_name);

?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="wrap">
    <h2>Kitsu Anime List customization</h2>

    <form method="post" name="kal_options" action="options.php">
        <?php settings_fields($this->plugin_name); ?>

        <fieldset>
            <label for="<?php echo $this->plugin_name; ?>-kal">
                <!-- TODO internationalization -->
                <span><?php esc_attr_e('Items per page', $this->plugin_name); ?></span>
                <select id="<?php echo $this->plugin_name; ?>-kal" name="<?php echo $this->plugin_name; ?>[items_per_page]">
                    <?php for ($i=1; $i <= $max_items; $i++): ?>
                        <option
                            value="<?php echo $i; ?>"
                            <?php if($i == $options['items_per_page']) echo 'selected' ?>
                        >
                            <?php echo $i; ?>
                        </option>
                    <?php endfor; ?>
                </select>
            </label>
        </fieldset>

        <!-- TODO internationalization -->
        <?php submit_button('Save all changes', 'primary', 'submit', TRUE); ?>
    </form>
</div>