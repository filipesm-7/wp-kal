<?php $count_type = ( $instance['search_type'] == "anime" ) ? "episodeCount" : "volumeCount"; ?>

<div class="kitsu-api-list">
    <h2 class="widget-title"><?php echo $instance['title']; ?></h2>

    <ul>
        <?php foreach( $list as $item ): ?>
            <li class="item">
                <p>
                    <!-- TODO get endpoint config from class -->
                    <a href="https://kitsu.io/<?php echo $instance['search_type']; ?>/<?php echo $item['attributes']['slug'] ?>" target="_blank">
                        <img class="kitsu-api-list-image" src="<?php echo $item['attributes']['posterImage']['tiny']; ?>" alt="<?php echo $item['attributes']['canonicalTitle']; ?>" title="<?php echo $item['attributes']['canonicalTitle']; ?>" />
                    </a>
                </p>
                <a href="https://kitsu.io/<?php echo $instance['search_type']; ?>/<?php echo $item['attributes']['slug'] ?>" class="title" target="_blank"><?php echo $item['attributes']['canonicalTitle']; ?></a>
                <span><?php echo $item['attributes']['subtype']; ?>,
                    <?php echo ( !empty( $item['attributes'][$count_type] ) ) ? $item['attributes'][$count_type] : __( "n/a", $this->plugin_name ); ?>,
                    <?php echo $item['attributes']['status']; ?>
                </span>
                <span><?php echo $item['attributes']['averageRating']; ?> <?php _e( 'rating', $this->plugin_name ) ?></span>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

