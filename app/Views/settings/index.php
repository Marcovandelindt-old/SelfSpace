<br />
<div class="col-md-12">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Settings</h1>
    </div>
</div>

<br />
<div class="col-md-9">
    <form method="POST">
        <div class="form-section">
            <div class="form-section-heading">
                <h4><strong>Weather</strong></h4>
            </div>
            <div class="form-group row">
                <label for="openWeatherApiKey" class="col-sm-2 col-form-label">OpenWeather API Key</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="setting[openWeatherApiKey]" id="openWeatherApiKey" value="<?= $setting->getByName('openWeatherApiKey')->value ?>" />
                </div>
            </div>
            <div class="form-group row">
                <label for="weatherLocation" class="col-sm-2 col-form-label">Location</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="setting[weatherLocation]" id="weatherLocation" value="<?= $setting->getByName('weatherLocation')->value ?>" />
                </div>
            </div>
        </div>
        <br />
        <div class="form-section">
            <div class="form-section-heading">
                <h4><strong>Music</strong></h4>
            </div>
            <div class="form-group row">
                <label for="spotifyClientId" class="col-sm-2 col-form-label">Spotify Client ID</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="setting[spotifyClientId]" id="spotifyClientId" value="<?= $setting->getByName('spotifyClientId')->value ?>" />
                </div>
            </div>
            <div class="form-group row">
                <label for="spotifyClientSecret" class="col-sm-2 col-form-label">Spotify Client Secret</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="setting[spotifyClientSecret]" id="spotifyClientSecret" value="<?= $setting->getByName('spotifyClientSecret')->value ?>" />
                </div>
            </div>
            <div class="form-group row">
                <label for="spotifyRedirectURI" class="col-sm-2 col-form-label">Spotify Redirect URI</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="setting[spotifyRedirectURI]" id="spotifyRedirectURI" value="<?= $setting->getByName('spotifyRedirectURI')->value ?>" />
                </div>
            </div>
        </div>
        <br />
        <div class="form-section">
            <input type="submit" name="saveSettings" value="Save settings" class="btn btn-success shadow" />
        </div>
    </form>
</div>