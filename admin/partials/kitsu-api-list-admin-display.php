<?php

//get plugin options
$options = get_option($this->plugin_name);

?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="wrap">
    <h2><?php _e('Kitsu Api List customization', $this->plugin_name); ?></h2>

    <form method="post" name="kal_options" action="options.php">
        <?php settings_fields($this->plugin_name); ?>

        <fieldset>
            <label for="<?php echo $this->plugin_name; ?>-kal">
                <span><?php _e('Items per page', $this->plugin_name); ?></span>
                <select id="<?php echo $this->plugin_name; ?>-kal" name="<?php echo $this->plugin_name; ?>[items_per_page]">
                    <?php for ($i=1; $i <= $this::MAX_ITEMS_SHOWN; $i++): ?>
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

        <?php submit_button(__('Save all changes', $this->plugin_name), 'primary', 'submit', TRUE); ?>
    </form>
</div>