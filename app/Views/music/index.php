<br />
<div class="row">
<div class="col-md-12">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Music</h1>
    </div>
</div>
</div>
<br />

<div class="row">
    <div class="col-md-6">
        <h3 style="color: #212121"><strong>Listening Activity</strong></h3>
        <br />
        <?php
            if (!empty($todaysTracks)) {
                foreach ($todaysTracks as $todaysTrack) {
                    ?>
                    <div class="media custom-track-media shadow">
                        <img src="<?= $todaysTrack->image ?>" class="mr-3" alt="<?= $todaysTrack->name ?>" height="64" width="64" />
                        <div class="media-body">
                            <div><p><?= $todaysTrack->artists ?></p></div>
                            <div><p><strong><?= $todaysTrack->name ?></strong></p></div>
                            <div><p><?= date('H:i', $todaysTrack->playedAt) ?></p></div>
                        </div>
                    </div>
                    <br />
                    <?php
                }
            }
        ?>
    </div>
</div>