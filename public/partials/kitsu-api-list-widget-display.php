<div class="kitsu-api-list">
    <h2 class="widget-title"><?php echo $instance['title']; ?></h2>

    <ul>
        <?php foreach( $list as $anime ): ?>
            <li class="item">
                <p>
                    <!-- TODO get endpoint config from class -->
                    <a href="https://kitsu.io/anime/<?php echo $anime['attributes']['slug'] ?>" target="_blank">
                        <img class="kitsu-api-list-image" src="<?php echo $anime['attributes']['posterImage']['tiny']; ?>" alt="<?php echo $anime['attributes']['canonicalTitle']; ?>" title="<?php echo $anime['attributes']['canonicalTitle']; ?>" />
                    </a>
                </p>
                <a href="https://kitsu.io/anime/<?php echo $anime['attributes']['slug'] ?>" class="title" target="_blank"><?php echo $anime['attributes']['canonicalTitle']; ?></a>
                <span><?php echo $anime['attributes']['subtype'] . ', ' . $anime['attributes']['episodeCount'] . ', ' . $anime['attributes']['status'] ; ?></span>
                <span><?php echo $anime['attributes']['averageRating']; ?> rating</span>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

