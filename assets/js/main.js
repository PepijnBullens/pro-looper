const startBtn = document.querySelector('#startBtn');
const stopBtn = document.querySelector('#stopBtn');
const beats = document.querySelector('#beats');
const bpm = document.querySelector('#bpm');
const audioInputSelect = document.querySelector('#audioInput');
const metronome = document.querySelector('.metronome');

setBeats(beats.value);
setBpm(bpm.value);

let repeatMetronome = false;

let mediaRecorder;
let audioChunks = [];

// Populate the dropdown with audio input devices
navigator.mediaDevices.enumerateDevices().then(devices => {
  devices.forEach(device => {
    if (device.kind === 'audioinput') {
      const option = document.createElement('option');
      option.value = device.deviceId;
      option.text = device.label || `Microphone ${audioInputSelect.length + 1}`;
      audioInputSelect.appendChild(option);
    }
  });
});

beats.addEventListener('input', () => {
  setBeats(beats.value);
});

function setBeats(beats) {
  document.querySelectorAll('.looper .beat').forEach(beat => beat.remove());

  for (let i = 0; i < beats - 1; i++) {
    const beat = document.createElement('div');
    beat.classList.add('beat');
    document.querySelector('.looper').appendChild(beat);
  }
}

bpm.addEventListener('input', () => {
  setBpm(bpm.value);

  metronomeFunc();
});

function setBpm(bpm) {
  document.querySelector('.looper .stick').style.animationDuration = `${60 / bpm * beats.value}s`;
}

function toggleMetronome() {
  repeatMetronome = !repeatMetronome;

  if (repeatMetronome) {
    metronomeFunc();
  }
}

function metronomeFunc() {
  setTimeout(() => {
    metronome.currentTime = 0;
    metronome.play();

    const stick = document.querySelector('.looper .stick');
    stick.classList.add('reset');
    stick.style.left = '0';
    stick.classList.remove('reset');

    if (repeatMetronome) {
      metronomeFunc();
    }
  }, 60000 / bpm.value);
}

startBtn.addEventListener('click', async () => {
  const selectedDeviceId = audioInputSelect.value;
  const stream = await navigator.mediaDevices.getUserMedia({
    audio: {
      deviceId: selectedDeviceId ? {
        exact: selectedDeviceId
      } : undefined
    }
  });

  mediaRecorder = new MediaRecorder(stream);

  mediaRecorder.ondataavailable = event => {
    audioChunks.push(event.data);
  };

  mediaRecorder.onstop = () => {
    const audioBlob = new Blob(audioChunks, {
      type: 'audio/wav'
    });
    const audioUrl = URL.createObjectURL(audioBlob);
    audioPlayback.src = audioUrl;

    // You can also save the file or upload it to a server
    const link = document.createElement('a');
    link.href = audioUrl;
    link.download = 'recording.wav';
    link.click();

    audioChunks = [];
  };

  mediaRecorder.start();
  startBtn.disabled = true;
  stopBtn.disabled = false;
});

stopBtn.addEventListener('click', () => {
  mediaRecorder.stop();
  startBtn.disabled = false;
  stopBtn.disabled = true;
});
