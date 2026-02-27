@props(['src', 'chapters' => [], 'duration' => null, 'id' => 'audioPlayer'])

<div class="audio-player" id="{{ $id }}" data-sermon-id="{{ $id }}">
    <audio id="{{ $id }}Audio" preload="metadata">
        <source src="{{ $src }}" type="audio/mpeg">
        Your browser does not support the audio element.
    </audio>

    <div class="audio-player-container" style="background: linear-gradient(135deg, #1e293b 0%, #334155 100%); border-radius: 12px; padding: 20px; color: #fff;">
        {{-- Progress Bar with Chapter Markers --}}
        <div class="progress-container" style="position: relative; margin-bottom: 15px;">
            <div class="chapter-markers" style="position: absolute; top: 0; left: 0; right: 0; height: 40px; pointer-events: none;">
                @foreach($chapters as $index => $chapter)
                    @php $leftPercent = ($chapter['time'] ?? 0) > 0 ? ($chapter['time'] / 3600) * 100 : 0; @endphp
                    @if($leftPercent > 0 && $leftPercent < 100)
                        <div class="chapter-marker" style="position: absolute; left: {{ min($leftPercent, 95) }}%; top: 5px; width: 2px; height: 30px; background: rgba(255,255,255,0.3); cursor: pointer; pointer-events: auto;" 
                             title="{{ $chapter['title'] ?? '' }}" 
                             data-time="{{ $chapter['time'] ?? 0 }}"
                             onclick="seekToChapter('{{ $id }}', {{ $chapter['time'] ?? 0 }})">
                        </div>
                    @endif
                @endforeach
            </div>
            <div class="progress-bar-wrapper" style="position: relative; height: 40px; cursor: pointer;" onclick="seekAudio(event, '{{ $id }}')">
                <div class="progress-bar-bg" style="position: absolute; top: 50%; transform: translateY(-50%); left: 0; right: 0; height: 8px; background: rgba(255,255,255,0.2); border-radius: 4px;"></div>
                <div class="progress-bar-fill" id="{{ $id }}Progress" style="position: absolute; top: 50%; transform: translateY(-50%); left: 0; height: 8px; background: linear-gradient(90deg, #3b82f6, #8b5cf6); border-radius: 4px; width: 0%; transition: width 0.1s linear;"></div>
                <div class="progress-handle" id="{{ $id }}Handle" style="position: absolute; top: 50%; transform: translate(-50%, -50%); left: 0; width: 16px; height: 16px; background: #fff; border-radius: 50%; box-shadow: 0 2px 8px rgba(0,0,0,0.3); transition: left 0.1s linear;"></div>
            </div>
        </div>

        {{-- Time Display --}}
        <div class="time-display" style="display: flex; justify-content: space-between; font-size: 12px; color: rgba(255,255,255,0.7); margin-bottom: 15px;">
            <span id="{{ $id }}CurrentTime">0:00</span>
            <span id="{{ $id }}CurrentChapter" style="color: #60a5fa; font-weight: 500;"></span>
            <span id="{{ $id }}Duration">{{ $duration ?? '0:00' }}</span>
        </div>

        {{-- Controls --}}
        <div class="controls" style="display: flex; align-items: center; justify-content: center; gap: 15px;">
            {{-- Skip Backward --}}
            <button class="control-btn" onclick="skipTime('{{ $id }}', -15)" title="Rewind 15s" style="background: none; border: none; color: #fff; cursor: pointer; padding: 8px;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 5V1L7 6l5 5V7c3.31 0 6 2.69 6 6s-2.69 6-6 6-6-2.69-6-6H4c0 4.42 3.58 8 8 8s8-3.58 8-8-3.58-8-8-8z"/>
                    <text x="12" y="15" text-anchor="middle" font-size="6" fill="currentColor">15</text>
                </svg>
            </button>

            {{-- Play/Pause --}}
            <button class="play-btn" id="{{ $id }}PlayBtn" onclick="togglePlay('{{ $id }}')" style="background: #3b82f6; border: none; color: #fff; cursor: pointer; width: 56px; height: 56px; border-radius: 50%; display: flex; align-items: center; justify-content: center; transition: all 0.2s;">
                <svg id="{{ $id }}PlayIcon" width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M8 5v14l11-7z"/>
                </svg>
                <svg id="{{ $id }}PauseIcon" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" style="display: none;">
                    <path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z"/>
                </svg>
            </button>

            {{-- Skip Forward --}}
            <button class="control-btn" onclick="skipTime('{{ $id }}', 30)" title="Forward 30s" style="background: none; border: none; color: #fff; cursor: pointer; padding: 8px;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 5V1l5 5-5 5V7c-3.31 0-6 2.69-6 6s2.69 6 6 6 6-2.69 6-6h2c0 4.42-3.58 8-8 8s-8-3.58-8-8 3.58-8 8-8z"/>
                    <text x="12" y="15" text-anchor="middle" font-size="6" fill="currentColor">30</text>
                </svg>
            </button>

            {{-- Speed --}}
            <div class="speed-control" style="display: flex; align-items: center; gap: 5px;">
                <button class="control-btn" onclick="changeSpeed('{{ $id }}')" id="{{ $id }}SpeedBtn" style="background: rgba(255,255,255,0.1); border: none; color: #fff; cursor: pointer; padding: 6px 12px; border-radius: 4px; font-size: 12px;">
                    1x
                </button>
            </div>

            {{-- Volume --}}
            <div class="volume-control" style="display: flex; align-items: center; gap: 5px;">
                <button class="control-btn" onclick="toggleMute('{{ $id }}')" id="{{ $id }}MuteBtn" style="background: none; border: none; color: #fff; cursor: pointer; padding: 8px;">
                    <svg id="{{ $id }}VolumeIcon" width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M3 9v6h4l5 5V4L7 9H3zm13.5 3c0-1.77-1.02-3.29-2.5-4.03v8.05c1.48-.73 2.5-2.25 2.5-4.02zM14 3.23v2.06c2.89.86 5 3.54 5 6.71s-2.11 5.85-5 6.71v2.06c4.01-.91 7-4.49 7-8.77s-2.99-7.86-7-8.77z"/>
                    </svg>
                    <svg id="{{ $id }}MutedIcon" width="20" height="20" viewBox="0 0 24 24" fill="currentColor" style="display: none;">
                        <path d="M16.5 12c0-1.77-1.02-3.29-2.5-4.03v2.21l2.45 2.45c.03-.2.05-.41.05-.63zm2.5 0c0 .94-.2 1.82-.54 2.64l1.51 1.51C20.63 14.91 21 13.5 21 12c0-4.28-2.99-7.86-7-8.77v2.06c2.89.86 5 3.54 5 6.71zM4.27 3L3 4.27 7.73 9H3v6h4l5 5v-6.73l4.25 4.25c-.67.52-1.42.93-2.25 1.18v2.06c1.38-.31 2.63-.95 3.69-1.81L19.73 21 21 19.73l-9-9L4.27 3zM12 4L9.91 6.09 12 8.18V4z"/>
                    </svg>
                </button>
                <input type="range" id="{{ $id }}Volume" min="0" max="1" step="0.1" value="1" 
                       onchange="setVolume('{{ $id }}', this.value)"
                       style="width: 60px; accent-color: #3b82f6;">
            </div>
        </div>

        {{-- Keyboard Shortcuts Hint --}}
        <div class="shortcuts-hint" style="text-align: center; margin-top: 15px; font-size: 11px; color: rgba(255,255,255,0.5);">
            <span>Space: Play/Pause</span>
            <span style="margin: 0 10px;">|</span>
            <span>← →: Skip</span>
            <span style="margin: 0 10px;">|</span>
            <span>↑ ↓: Volume</span>
        </div>
    </div>

    @if(!empty($chapters))
        {{-- Chapter List --}}
        <div class="chapters-list" style="margin-top: 20px; background: #f8fafc; border-radius: 8px; overflow: hidden;">
            <div class="chapters-header" style="padding: 12px 16px; background: #e2e8f0; font-weight: 600; color: #334155;">
                Chapters
            </div>
            <div class="chapters-items" style="max-height: 250px; overflow-y: auto;">
                @foreach($chapters as $index => $chapter)
                    <div class="chapter-item" id="{{ $id }}Chapter{{ $index }}" 
                         onclick="seekToChapter('{{ $id }}', {{ $chapter['time'] ?? 0 }})"
                         style="padding: 12px 16px; border-bottom: 1px solid #e2e8f0; cursor: pointer; display: flex; justify-content: space-between; align-items: center; transition: background 0.2s;"
                         onmouseover="this.style.background='#f1f5f9'"
                         onmouseout="this.style.background='transparent'">
                        <div>
                            <span class="chapter-number" style="color: #64748b; font-size: 12px; margin-right: 8px;">{{ $index + 1 }}.</span>
                            <span class="chapter-title">{{ $chapter['title'] ?? 'Chapter ' . ($index + 1) }}</span>
                        </div>
                        <span class="chapter-time" style="color: #64748b; font-size: 13px; font-family: monospace;">
                            {{ \App\Models\Sermon::make([])->formatTime($chapter['time'] ?? 0) }}
                        </span>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>

@push('scripts')
<script>
(function() {
    const playerId = '{{ $id }}';
    const audio = document.getElementById(playerId + 'Audio');
    if (!audio) return;

    const progress = document.getElementById(playerId + 'Progress');
    const handle = document.getElementById(playerId + 'Handle');
    const currentTimeEl = document.getElementById(playerId + 'CurrentTime');
    const durationEl = document.getElementById(playerId + 'Duration');
    const playIcon = document.getElementById(playerId + 'PlayIcon');
    const pauseIcon = document.getElementById(playerId + 'PauseIcon');
    const currentChapterEl = document.getElementById(playerId + 'CurrentChapter');
    const chapters = @json($chapters);

    // Restore saved position
    const savedPosition = localStorage.getItem('sermon_position_' + playerId);
    if (savedPosition) {
        audio.currentTime = parseFloat(savedPosition);
    }

    // Speed cycling
    const speeds = [0.5, 0.75, 1, 1.25, 1.5, 1.75, 2];
    let currentSpeedIndex = speeds.indexOf(1);

    audio.addEventListener('loadedmetadata', function() {
        if (!('{{ $duration }}')) {
            durationEl.textContent = formatTime(audio.duration);
        }
    });

    audio.addEventListener('timeupdate', function() {
        const percent = (audio.currentTime / audio.duration) * 100;
        progress.style.width = percent + '%';
        handle.style.left = percent + '%';
        currentTimeEl.textContent = formatTime(audio.currentTime);
        
        // Save position
        localStorage.setItem('sermon_position_' + playerId, audio.currentTime);
        
        // Update current chapter
        updateCurrentChapter();
    });

    audio.addEventListener('play', function() {
        playIcon.style.display = 'none';
        pauseIcon.style.display = 'block';
    });

    audio.addEventListener('pause', function() {
        playIcon.style.display = 'block';
        pauseIcon.style.display = 'none';
    });

    audio.addEventListener('ended', function() {
        localStorage.removeItem('sermon_position_' + playerId);
    });

    function updateCurrentChapter() {
        if (!chapters || chapters.length === 0) return;
        
        let currentChapter = null;
        for (let i = chapters.length - 1; i >= 0; i--) {
            if (audio.currentTime >= (chapters[i].time || 0)) {
                currentChapter = chapters[i];
                // Highlight chapter in list
                document.querySelectorAll('.chapter-item').forEach((el, idx) => {
                    el.style.background = idx === i ? '#dbeafe' : 'transparent';
                    el.style.fontWeight = idx === i ? '600' : 'normal';
                });
                break;
            }
        }
        
        if (currentChapter) {
            currentChapterEl.textContent = currentChapter.title || '';
        }
    }

    window.togglePlay = function(id) {
        if (id !== playerId) return;
        if (audio.paused) {
            audio.play();
        } else {
            audio.pause();
        }
    };

    window.skipTime = function(id, seconds) {
        if (id !== playerId) return;
        audio.currentTime = Math.max(0, Math.min(audio.duration, audio.currentTime + seconds));
    };

    window.changeSpeed = function(id) {
        if (id !== playerId) return;
        currentSpeedIndex = (currentSpeedIndex + 1) % speeds.length;
        audio.playbackRate = speeds[currentSpeedIndex];
        document.getElementById(playerId + 'SpeedBtn').textContent = speeds[currentSpeedIndex] + 'x';
    };

    window.setVolume = function(id, value) {
        if (id !== playerId) return;
        audio.volume = value;
        updateVolumeIcon();
    };

    window.toggleMute = function(id) {
        if (id !== playerId) return;
        audio.muted = !audio.muted;
        updateVolumeIcon();
    };

    window.seekAudio = function(event, id) {
        if (id !== playerId) return;
        const wrapper = event.currentTarget;
        const rect = wrapper.getBoundingClientRect();
        const percent = (event.clientX - rect.left) / rect.width;
        audio.currentTime = percent * audio.duration;
    };

    window.seekToChapter = function(id, time) {
        if (id !== playerId) return;
        audio.currentTime = time;
        if (audio.paused) {
            audio.play();
        }
    };

    function updateVolumeIcon() {
        const volumeIcon = document.getElementById(playerId + 'VolumeIcon');
        const mutedIcon = document.getElementById(playerId + 'MutedIcon');
        if (audio.muted || audio.volume === 0) {
            volumeIcon.style.display = 'none';
            mutedIcon.style.display = 'block';
        } else {
            volumeIcon.style.display = 'block';
            mutedIcon.style.display = 'none';
        }
    }

    function formatTime(seconds) {
        if (isNaN(seconds)) return '0:00';
        const h = Math.floor(seconds / 3600);
        const m = Math.floor((seconds % 3600) / 60);
        const s = Math.floor(seconds % 60);
        if (h > 0) {
            return h + ':' + (m < 10 ? '0' : '') + m + ':' + (s < 10 ? '0' : '') + s;
        }
        return m + ':' + (s < 10 ? '0' : '') + s;
    }

    // Keyboard shortcuts
    document.addEventListener('keydown', function(e) {
        if (e.target.tagName === 'INPUT' || e.target.tagName === 'TEXTAREA') return;
        
        switch(e.key) {
            case ' ':
                e.preventDefault();
                togglePlay(playerId);
                break;
            case 'ArrowLeft':
                skipTime(playerId, -15);
                break;
            case 'ArrowRight':
                skipTime(playerId, 30);
                break;
            case 'ArrowUp':
                e.preventDefault();
                audio.volume = Math.min(1, audio.volume + 0.1);
                document.getElementById(playerId + 'Volume').value = audio.volume;
                break;
            case 'ArrowDown':
                e.preventDefault();
                audio.volume = Math.max(0, audio.volume - 0.1);
                document.getElementById(playerId + 'Volume').value = audio.volume;
                break;
            case 'm':
            case 'M':
                toggleMute(playerId);
                break;
        }
    });
})();
</script>
@endpush
