<?php
use function PTP\Media\escape;
use function PTP\Media\outputErrors;

wp_enqueue_media();

$errors = (isset($errors)) ? $errors : [];
?>

<h1><?php echo $titleAction; ?> Media Entry</h1>

<hr>

<?php
if (!$entry) {

    echo "<h3>Invalid entry</h3>";

    return;
}
?>

<?php echo outputErrors('save', $errors); ?>

<form action="?page=ptp_media&ptp-action=saveMedia&media-id=<?php echo $entry->id; ?>" method="POST">

    <div class="row">

        <div class="col-12 col-sm-6">

            <input type="hidden" name="id" id="id" value="<?php echo escape($entry->id); ?>">

            <div class="form-group">
                <label for="title"
                       class="<?php echo (isset($errors['title'])) ? "text-danger" : ""; ?>"
                >Title:</label>
                <input class="form-control" required type="text" name="title" id="title" value="<?php echo escape($entry->title); ?>" placeholder="Title">
                <?php echo outputErrors('title', $errors); ?>
            </div>

            <div class="form-group">
                <label for="url"
                       class="<?php echo (isset($errors['url'])) ? "text-danger" : ""; ?>"
                >URL:</label>
                <input class="form-control" required type="url" name="url" id="url" value="<?php echo escape($entry->url); ?>" placeholder="https://">
                <?php echo outputErrors('url', $errors); ?>
            </div>

            <div class="form-group">
                <label for="date"
                       class="<?php echo (isset($errors['date'])) ? "text-danger" : ""; ?>"
                >Date:</label> <small class="text-muted">mm/dd/yyyy</small>
                <input class="form-control" required type="date" name="date" id="date" value="<?php echo escape($entry->date); ?>" placeholder="mm/dd/yyyy">
                <?php echo outputErrors('date', $errors); ?>
            </div>

            <div class="form-group">
                <label for="description">Description:</label>
                <textarea class="form-control" name="description" id="description" placeholder="Provide some background, summary, etc"><?php echo escape($entry->description); ?></textarea>
            </div>

            <div class="checkbox">
                <label for="active">
                    <input type="checkbox" name="active" id="active" value="1" <?php echo ($entry->active) ? "checked" : ""; ?>>
                    &nbsp; <strong>Active</strong> <small class="text-muted">- uncheck to prevent the media entry from being listed</small>
                </label>
            </div>


        </div>

        <div class="col-12 col-sm-6">

            <input type="hidden" name="image_url" id="image_url" value="<?php echo escape($entry->image_url); ?>">

            <img src="<?php echo escape($entry->image_url); ?>" alt="Media Image" id="media_image" class="media-image">

            <hr>

            <button type="button" class="upload_image_button">Update Image</button>

        </div>

    </div>

    <hr>

    <button class="btn btn-primary" type="submit">
        Save
    </button>

    <a class="btn btn-sm btn-default" href="?page=ptp_media">Cancel</a>

</form>
