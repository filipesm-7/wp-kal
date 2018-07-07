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
                <span><?php echo $item['attributes']['subtype']; ?>, <?php echo ( $instance['search_type'] == "anime" ) ? $item['attributes']['episodeCount'] : $item['attributes']['volumeCount']; ?>, <?php echo $item['attributes']['status']; ?></span>
                <span><?php echo $item['attributes']['averageRating']; ?> rating</span>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

