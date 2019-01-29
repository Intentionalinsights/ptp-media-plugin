<style type="text/css">

.ptp-media-entry .panel {
    min-height: 350px;
}

.ptp-media-entry .panel-header {
    text-align: center;
    padding: 3px;
    border-bottom: 1px solid #ddd;
}

.ptp-media-entry img {
    max-width: 100%;
}

.ptp-media-entry .panel-footer a {
    display: block;
}

</style>

<div class="row">

    <?php foreach ($entries as $entry): ?>

        <div class="col-xs-6 col-md-4 col-lg-3 ptp-media-entry">

            <div class="panel panel-default">

                <div class="panel-heading">
                    <h3 class="panel-title">
                        <a href="<?php echo $entry->url; ?>" target="_blank">
                            <?php echo \PTP\Media\escape($entry->title); ?>
                        </a>
                    </h3>
                </div>
                <div class="panel-body">
                    <?php echo \PTP\Media\escape($entry->description); ?>
                </div>
            </div>

        </div>

    <?php endforeach; ?>

</div>
