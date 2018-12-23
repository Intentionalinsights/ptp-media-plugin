<style type="text/css">

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
                    <h3 class="panel-title"><?php echo \PTP\Media\escape($entry->title); ?></h3>
                </div>

                <div class="panel-header">
                    <img src="<?php echo $entry->image_url; ?>" alt="Preview image for the media entry">
                </div>

                <div class="panel-body">

                    <?php echo \PTP\Media\escape($entry->description); ?>

                </div>

                <div class="panel-footer">
                    <a href="<?php echo $entry->url; ?>" target="_blank">
                        <span class="glyphicon glyphicon-new-window"></span> See more
                    </a>
                </div>
            </div>

        </div>

    <?php endforeach; ?>

</div>
