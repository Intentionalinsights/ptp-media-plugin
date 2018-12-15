<h1>Media Management</h1>

<p>
    <a class="btn btn-primary" href="?page=ptp_media&ptp-action=newMedia">Add New Media Entry</a>
</p>

<table class="table ptp-media-admin-table" id="ptpMediaListAdminTable">

    <thead>
        <tr>
            <th>&nbsp;</th>
            <th>Title</th>
            <th>Link</th>
            <th>Date</th>
            <th>Active</th>
        </tr>
    </thead>

    <?php foreach ($entries as $entry): ?>

        <tr>
            <td><a href="?page=ptp_media&ptp-action=editMedia&media-id=<?php echo (int) $entry->id; ?>" class="btn btn-primary btn-sm">Edit</a></td>
            <td><?php echo $entry->title; ?></td>
            <td><a href="<?php echo $entry->url; ?>" target="_blank"><?php echo $entry->url; ?></a></td>
            <td><?php echo date('m/d/Y', strtotime($entry->date)); ?></td>
            <td><input type="checkbox" disabled <?php echo ($entry->active) ? "checked" : ""; ?>></td>
        </tr>

    <?php endforeach; ?>

</table>
