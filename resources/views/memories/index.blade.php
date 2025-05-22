@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="text-center mb-4">Photo Memories 📸</h2>

    <form action="{{ route('memories.store') }}" method="POST" enctype="multipart/form-data" class="mb-5">
        @csrf
        <div class="mb-3">
            <label for="caption" class="form-label">Caption</label>
            <input type="text" name="caption" id="caption" class="form-control" placeholder="A sweet moment...">
        </div>
        <div class="mb-3">
            <label for="images" class="form-label">Upload Photos</label>
            <input type="file" name="images[]" id="images" class="form-control" multiple required>
        </div>
        <button type="submit" class="btn btn-primary">Save Memory</button>
    </form>

    <div class="row g-4">
        @foreach ($memories as $memory)
            @if($memory->image_paths)
                @php
                    $imagePaths = is_array($memory->image_paths) ? $memory->image_paths : json_decode($memory->image_paths);
                    if (!is_array($imagePaths)) {
                        $imagePaths = [];
                    }
                @endphp
                @foreach ($imagePaths as $imagePath)
                    <div class="col-md-4 col-sm-6">
                        <div class="memory-card">
                            <img src="{{ asset('storage/' . $imagePath) }}" 
                                 class="memory-image" 
                                 alt="{{ $memory->caption }}"
                                 data-caption="{{ $memory->caption }}"
                                 onclick="openFullscreen(this)">
                            <div class="memory-caption">{{ $memory->caption }}</div>
                        </div>
                    </div>
                @endforeach
            @endif
        @endforeach
    </div>
</div>

<!-- Fullscreen Modal -->
<div id="fullscreenModal" class="modal-fullscreen" onclick="closeFullscreen()">
    <div class="modal-content">
        <img id="fullscreenImage" src="" alt="">
        <div id="fullscreenCaption" class="caption"></div>
        <button class="close-button" onclick="closeFullscreen()">&times;</button>
    </div>
</div>

<style>
.memory-card {
    position: relative;
    overflow: hidden;
    border-radius: 12px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    transition: transform 0.3s ease;
}

.memory-card:hover {
    transform: translateY(-5px);
}

.memory-image {
    width: 100%;
    height: 250px;
    object-fit: cover;
    cursor: pointer;
    animation: gentleBounce 3s infinite;
}

.memory-caption {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background: rgba(0,0,0,0.7);
    color: white;
    padding: 8px;
    font-size: 0.9rem;
    text-align: center;
}

@keyframes gentleBounce {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.02); }
}

.modal-fullscreen {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.9);
    z-index: 1000;
    cursor: pointer;
}

.modal-content {
    position: relative;
    max-width: 90%;
    max-height: 90%;
    margin: auto;
    top: 50%;
    transform: translateY(-50%);
}

.modal-content img {
    max-width: 100%;
    max-height: 80vh;
    object-fit: contain;
}

.caption {
    color: white;
    text-align: center;
    padding: 10px;
    font-size: 1.2rem;
}

.close-button {
    position: absolute;
    top: -40px;
    right: 0;
    color: white;
    font-size: 30px;
    background: none;
    border: none;
    cursor: pointer;
}
</style>

<script>
function openFullscreen(img) {
    const modal = document.getElementById('fullscreenModal');
    const fullscreenImg = document.getElementById('fullscreenImage');
    const caption = document.getElementById('fullscreenCaption');
    
    fullscreenImg.src = img.src;
    caption.textContent = img.dataset.caption;
    modal.style.display = 'block';
    document.body.style.overflow = 'hidden';
}

function closeFullscreen() {
    const modal = document.getElementById('fullscreenModal');
    modal.style.display = 'none';
    document.body.style.overflow = 'auto';
}

// Close modal with escape key
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        closeFullscreen();
    }
});
</script>
@endsection
