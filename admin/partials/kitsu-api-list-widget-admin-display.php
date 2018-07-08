<p>
    <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' , $this->plugin_name); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
</p>

<p>
    <label for="<?php echo $this->get_field_id( 'items_per_page' ); ?>"><?php _e( 'Items per page:' , $this->plugin_name); ?></label>
    <select id="<?php echo $this->get_field_id( 'items_per_page' ); ?>" name="<?php echo $this->get_field_name( 'items_per_page' ); ?>">
        <?php for ($i=1; $i <= $max_items_per_page; $i++): ?>
            <option
                    value="<?php echo $i; ?>"
                <?php if ( $i == $items_per_page ) echo 'selected' ?>
            >
                <?php echo $i; ?>
            </option>
        <?php endfor; ?>
    </select>
</p>

<p>
    <label for="<?php echo $this->get_field_id( 'search_type' ); ?>"><?php _e( 'Search type:' , $this->plugin_name); ?></label><br />
    <input class="widefat" id="<?php echo $this->get_field_id( 'search_type' ); ?>" name="<?php echo $this->get_field_name( 'search_type' ); ?>" type="radio" value="anime" <?php if ( $search_type == "anime" ) echo 'checked="checked"' ?> /> <?php _e( 'Anime' , $this->plugin_name); ?>
    <input class="widefat" id="<?php echo $this->get_field_id( 'search_type' ); ?>" name="<?php echo $this->get_field_name( 'search_type' ); ?>" type="radio" value="manga" <?php if ( $search_type == "manga" ) echo 'checked="checked"' ?> /> <?php _e( 'Manga' , $this->plugin_name); ?>
</p>

<p>
    <label for="<?php echo $this->get_field_id( 'sort_type' ); ?>"><?php esc_html_e( 'Sort type:' , $this->plugin_name); ?></label><br />
    <input class="widefat" id="<?php echo $this->get_field_id( 'sort_type' ); ?>" name="<?php echo $this->get_field_name( 'sort_type' ); ?>" type="radio" value="averageRating" <?php if ( $sort_type == "averageRating" ) echo 'checked="checked"' ?> /> <?php _e( 'Rating' , $this->plugin_name); ?>
    <input class="widefat" id="<?php echo $this->get_field_id( 'sort_type' ); ?>" name="<?php echo $this->get_field_name( 'sort_type' ); ?>" type="radio" value="popularityRank" <?php if ( $sort_type == "popularityRank" ) echo 'checked="checked"' ?> /> <?php _e( 'Popularity' , $this->plugin_name); ?>
</p>

<p>
    <label for="<?php echo $this->get_field_id( 'order_type' ); ?>"><?php esc_html_e( 'Order type:' , $this->plugin_name); ?></label><br />
    <input class="widefat" id="<?php echo $this->get_field_id( 'order_type' ); ?>" name="<?php echo $this->get_field_name( 'order_type' ); ?>" type="radio" value="asc" <?php if ( $order_type == "asc" ) echo 'checked="checked"' ?> /> <?php _e( 'Ascending' , $this->plugin_name); ?>
    <input class="widefat" id="<?php echo $this->get_field_id( 'order_type' ); ?>" name="<?php echo $this->get_field_name( 'order_type' ); ?>" type="radio" value="desc" <?php if ( $order_type == "desc" ) echo 'checked="checked"' ?> /> <?php _e( 'Descending' , $this->plugin_name); ?>
</p>

<p>
    <label for="<?php echo $this->get_field_id( 'trending' ); ?>"><?php esc_html_e( 'Trending:' , $this->plugin_name); ?></label><br />
    <input class="widefat" id="<?php echo $this->get_field_id( 'trending' ); ?>" name="<?php echo $this->get_field_name( 'trending' ); ?>" type="checkbox" value="1" <?php if ( $trending == 1 ) echo 'checked="checked"' ?> />
</p>