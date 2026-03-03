@extends('layouts.admin')

@section('content')
    <h1>Add Sermon</h1>

    @if ($errors->any())
        <div style="padding:10px;background:#fee2e2;border:1px solid #fca5a5;margin-bottom:16px;color:#7f1d1d;">
            <ul style="margin:0;padding-left:18px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.sermons.store') }}" method="POST" id="sermonForm" enctype="multipart/form-data">
        @csrf

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:24px;">
            <div>
                <div style="margin-bottom:16px;">
                    <label style="display:block;margin-bottom:4px;font-weight:500;">Title *</label>
                    <input type="text" name="title" value="{{ old('title') }}" style="width:100%;padding:8px;border:1px solid #d1d5db;border-radius:4px;" required>
                </div>

                <div style="margin-bottom:16px;">
                    <label style="display:block;margin-bottom:4px;font-weight:500;">Description</label>
                    <textarea name="content" style="width:100%;padding:8px;border:1px solid #d1d5db;border-radius:4px;" rows="4">{{ old('content') }}</textarea>
                </div>

                <div style="display:flex;gap:16px;margin-bottom:16px;">
                    <div style="flex:1;">
                        <label style="display:block;margin-bottom:4px;font-weight:500;">Date Preached *</label>
                        <input type="date" name="date_preached" value="{{ old('date_preached') }}" style="width:100%;padding:8px;border:1px solid #d1d5db;border-radius:4px;" required>
                    </div>
                    <div style="flex:1;">
                        <label style="display:block;margin-bottom:4px;font-weight:500;">Pastor</label>
                        <select name="pastor_id" style="width:100%;padding:8px;border:1px solid #d1d5db;border-radius:4px;">
                            <option value="">Select a pastor</option>
                            @foreach ($pastors as $pastor)
                                <option value="{{ $pastor->id }}" {{ old('pastor_id', $selectedPastorId ?? '') == $pastor->id ? 'selected' : '' }}>
                                    {{ $pastor->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div style="margin-bottom:16px;">
                    <label style="display:block;margin-bottom:4px;font-weight:500;">Bible Passage</label>
                    <input type="text" name="bible_passage" value="{{ old('bible_passage') }}" style="width:100%;padding:8px;border:1px solid #d1d5db;border-radius:4px;" placeholder="e.g., John 3:16-21">
                </div>

                <div style="display:flex;gap:16px;margin-bottom:16px;">
                    <div style="flex:1;">
                        <label style="display:block;margin-bottom:4px;font-weight:500;">Series</label>
                        <select name="series_id" style="width:100%;padding:8px;border:1px solid #d1d5db;border-radius:4px;">
                            <option value="">No Series</option>
                            @foreach ($series as $s)
                                <option value="{{ $s->id }}" {{ old('series_id') == $s->id ? 'selected' : '' }}>
                                    {{ $s->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div style="width:100px;">
                        <label style="display:block;margin-bottom:4px;font-weight:500;">Order</label>
                        <input type="number" name="series_order" value="{{ old('series_order') }}" min="1" style="width:100%;padding:8px;border:1px solid #d1d5db;border-radius:4px;">
                    </div>
                </div>
            </div>

            <div>
                <div style="margin-bottom:16px;">
                    <label style="display:block;margin-bottom:4px;font-weight:500;">Video URL</label>
                    <input type="url" name="video_url" value="{{ old('video_url') }}" style="width:100%;padding:8px;border:1px solid #d1d5db;border-radius:4px;" placeholder="https://youtube.com/...">
                </div>

                <div style="margin-bottom:16px;">
                    <label style="display:block;margin-bottom:4px;font-weight:500;">Video URL</label>
                    <input type="url" name="video_url" value="{{ old('video_url') }}" style="width:100%;padding:8px;border:1px solid #d1d5db;border-radius:4px;" placeholder="https://youtube.com/...">
                </div>

                <div style="margin-bottom:16px;">
                    <label style="display:block;margin-bottom:4px;font-weight:500;">Image (optional)</label>
                    <input type="file" name="image" style="width:100%;">
                </div>

                <div style="display:flex;gap:16px;margin-bottom:16px;">
                    <div style="flex:1;">
                        <label style="display:block;margin-bottom:4px;font-weight:500;">Duration</label>
                        <input type="text" name="duration" value="{{ old('duration') }}" style="width:100%;padding:8px;border:1px solid #d1d5db;border-radius:4px;" placeholder="45:30">
                    </div>
                    <div style="flex:1;">
                        <label style="display:block;margin-bottom:4px;font-weight:500;">Thumbnail URL</label>
                        <input type="url" name="thumbnail" value="{{ old('thumbnail') }}" style="width:100%;padding:8px;border:1px solid #d1d5db;border-radius:4px;" placeholder="https://...">
                    </div>
                </div>

                {{-- Chapters Section --}}
                <div style="background:#f8fafc;border:1px solid #e2e8f0;border-radius:8px;padding:16px;">
                    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:12px;">
                        <label style="font-weight:500;margin:0;">Audio Chapters</label>
                        <button type="button" onclick="addChapter()" style="padding:6px 12px;background:#3b82f6;color:#fff;border:none;border-radius:4px;cursor:pointer;font-size:13px;">+ Add Chapter</button>
                    </div>
                    <p style="font-size:13px;color:#64748b;margin-bottom:12px;">Add chapter markers to help listeners navigate the sermon.</p>
                    
                    <div id="chaptersContainer" style="max-height:300px;overflow-y:auto;">
                        @php $chapters = old('chapters') ? json_decode(old('chapters'), true) : []; @endphp
                        @foreach($chapters as $index => $chapter)
                            <div class="chapter-row" style="display:flex;gap:8px;margin-bottom:8px;align-items:center;">
                                <input type="text" class="chapter-time" value="{{ $chapter['time'] ?? 0 }}" placeholder="0:00" style="width:70px;padding:6px;border:1px solid #d1d5db;border-radius:4px;font-family:monospace;">
                                <input type="text" class="chapter-title" value="{{ $chapter['title'] ?? '' }}" placeholder="Chapter title" style="flex:1;padding:6px;border:1px solid #d1d5db;border-radius:4px;">
                                <button type="button" onclick="removeChapter(this)" style="padding:6px 8px;background:#fee2e2;color:#dc2626;border:none;border-radius:4px;cursor:pointer;">×</button>
                            </div>
                        @endforeach
                    </div>

                    <input type="hidden" name="chapters" id="chaptersInput" value="{{ old('chapters', '[]') }}">
                </div>
            </div>
        </div>

        <div style="margin-top:24px;">
            <button type="submit" style="padding:10px 20px;background:#1e293b;color:#fff;border:none;border-radius:4px;cursor:pointer;">Create Sermon</button>
            <a href="{{ route('admin.sermons.index') }}" style="margin-left:12px;color:#6b7280;text-decoration:none;">Cancel</a>
        </div>
    </form>

    <script>
    let chapterIndex = {{ count($chapters) }};

    function addChapter() {
        const container = document.getElementById('chaptersContainer');
        const row = document.createElement('div');
        row.className = 'chapter-row';
        row.style.cssText = 'display:flex;gap:8px;margin-bottom:8px;align-items:center;';
        row.innerHTML = `
            <input type="text" class="chapter-time" placeholder="0:00" style="width:70px;padding:6px;border:1px solid #d1d5db;border-radius:4px;font-family:monospace;">
            <input type="text" class="chapter-title" placeholder="Chapter title" style="flex:1;padding:6px;border:1px solid #d1d5db;border-radius:4px;">
            <button type="button" onclick="removeChapter(this)" style="padding:6px 8px;background:#fee2e2;color:#dc2626;border:none;border-radius:4px;cursor:pointer;">×</button>
        `;
        container.appendChild(row);
        chapterIndex++;
        updateChaptersInput();
    }

    function removeChapter(btn) {
        btn.parentElement.remove();
        updateChaptersInput();
    }

    function parseTime(timeStr) {
        const parts = timeStr.split(':').map(Number);
        if (parts.length === 2) {
            return parts[0] * 60 + parts[1];
        } else if (parts.length === 3) {
            return parts[0] * 3600 + parts[1] * 60 + parts[2];
        }
        return parseInt(timeStr) || 0;
    }

    function updateChaptersInput() {
        const rows = document.querySelectorAll('.chapter-row');
        const chapters = [];
        rows.forEach(row => {
            const timeStr = row.querySelector('.chapter-time').value;
            const title = row.querySelector('.chapter-title').value;
            if (timeStr || title) {
                chapters.push({
                    time: parseTime(timeStr),
                    title: title
                });
            }
        });
        chapters.sort((a, b) => a.time - b.time);
        document.getElementById('chaptersInput').value = JSON.stringify(chapters);
    }

    document.getElementById('chaptersContainer').addEventListener('input', updateChaptersInput);
    document.getElementById('sermonForm').addEventListener('submit', updateChaptersInput);
    </script>
@endsection
