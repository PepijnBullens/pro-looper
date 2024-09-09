<h1>Record Guitar with JavaScript</h1>

<!-- Dropdown to select audio input -->
<label for="audioInput">Select Audio Input:</label>
<select id="audioInput"></select>

<button id="startBtn">Start Recording</button>
<button id="stopBtn" disabled>Stop Recording</button>
<input type="number" name="beats" id="beats" value="4">
<input type="number" name="bpm" id="bpm" value="140">


<div class="looper">
    <audio class="metronome" src="<?= $env['BASE_URL'] ?>assets/sounds/metronome.wav" preload="auto"></audio>
    <div class="stick"></div>
</div>