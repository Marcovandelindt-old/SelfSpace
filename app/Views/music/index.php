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
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Plays Today</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                           <?= count($todaysTracks) ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fab fa-spotify fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Different Artists Today</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                           <?= $todaysArtists ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-dark shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Different Albums Today</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                           6
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-record-vinyl fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Time Spent Listening Today</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                           <?= $totalListeningTime ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clock fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
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