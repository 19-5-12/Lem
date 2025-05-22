@extends('layouts.app')

@section('content')
<!-- 🔒 Fullscreen Countdown Overlay -->
<div id="countdownOverlay" style="position:fixed; top:0; left:0; width:100%; height:100%; background:#fff8fc; z-index:9999; display:flex; flex-direction:column; align-items:center; justify-content:center; text-align:center;">
    <!-- 🔐 Secret Bypass Button (Top-right corner) -->
    <button onclick="unlockNow()" style="position:absolute; top:10px; right:10px; width:20px; height:20px; background:none; border:none; cursor:pointer; opacity:0.01;" title="Secret Unlock"></button>

    <h1 class="display-4 fw-bold text-pink">🎁 Unlocking Soon... mwehehehe </h1>
    <p class="lead text-muted static-text">This birthday surprise will be revealed in:</p>
    <div id="countdown" class="fw-bold fs-2 text-primary"></div>
</div>

<!-- 🎀 Main Content Hidden Initially -->
<div id="mainContent" style="display:none;">
    <div class="text-center mb-5">
        <!-- This H1 gets floating animation via JavaScript's applyFloatingAnimation -->
        <h1 id="typewriter" class="display-5 fw-bold text-pink mb-3">🎂 HAPPY BIRTHDAY LABLAB KOOO!!!</h1>
        <!-- This P gets floating animation via JavaScript's applyFloatingAnimation -->
        <p id="description" class="lead text-muted animate__animated animate__fadeInUp">This is the website I made to celebrate your birthday baby ko mweheheh 💖</p>

        <!-- Reveal Button -->
        <div class="text-center my-5">
            <button id="startJourneyBtn" class="btn btn-lg btn-pink shadow floating-button">
                💫 Start the Journey
            </button>
        </div>
    </div>

    <!-- Hidden Sweet Content -->
    <div id="journeyContent" style="display: none;" class="animate__animated animate__fadeIn">
        <div class="row">
            <div class="col-md-6">
                <h4 class="mb-3 floating text-center">📸 Our Sweet Memories</h4>
                @if($memories->count() > 0)
                    @foreach($memories as $memory)
                        <div class="mb-4 text-center">
                            @if($memory->image_paths)
                                <div class="caption-bubble mb-3">
                                    <span class="caption-text">{{ $memory->caption }}</span>
                                </div>
                                <div class="d-flex flex-wrap justify-content-center gap-3">
                                    @php
                                        $imagePaths = is_array($memory->image_paths) ? $memory->image_paths : json_decode($memory->image_paths);
                                    @endphp
                                    @foreach($imagePaths as $path)
                                        <div class="polaroid border border-pink p-2 rounded shadow-sm bg-white memory-card" style="width: 200px;">
                                            <img src="{{ asset('storage/' . $path) }}" 
                                                 class="img-fluid rounded memory-image" 
                                                 alt="Memory image"
                                                 onclick="zoomImage(this)">
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @endforeach
                @else
                    <p class="text-muted text-center">No memories yet — soon! 💕</p>
                @endif
            </div>

            <div class="col-md-6">
                <h4 class="mb-3 floating text-center">💌 Sweet Messages</h4>
                @if($messages->count() > 0)
                    @foreach($messages as $message)
                        <div class="alert alert-info mx-auto mt-4 message-card" style="max-width: 600px;">
                            <strong>{{ $message->title }}</strong>
                            <p>{{ $message->body }}</p>
                        </div>
                    @endforeach
                @else
                     <p class="text-muted text-center">No messages yet — soon! 💌</p>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>
<script>
const titleText = document.getElementById('typewriter').textContent;
const descriptionElement = document.getElementById('description');
const descriptionText = descriptionElement.textContent;

// Function to apply floating animation to text by wrapping characters in spans
function applyFloatingAnimation(element, text, delayMultiplier = 0.1) {
    if (!element) return;

    element.textContent = ''; // Clear original text

    // Use Array.from() to handle multi-character emojis correctly
    Array.from(text).forEach((char, index) => {
        const span = document.createElement('span');
        span.className = 'floating-letter';
        span.style.animationDelay = (index * delayMultiplier) + 's';
        span.textContent = char === ' ' ? '\u00A0' : char; // Preserve spaces with non-breaking space
        element.appendChild(span);
    });
}

// Apply floating animation to title on unlock
function typeWriter() {
    const titleElement = document.getElementById('typewriter');
    applyFloatingAnimation(titleElement, titleText, 0.1);
}

// Apply floating animation to description on load
document.addEventListener('DOMContentLoaded', function() {
    applyFloatingAnimation(descriptionElement, descriptionText, 0.05);
});

// Create floating hearts
function createHeart() {
    const heart = document.createElement('div');
    heart.innerHTML = '❤️';
    heart.className = 'heart';
    heart.style.left = Math.random() * 100 + 'vw';
    heart.style.animationDuration = (Math.random() * 3 + 2) + 's';
    document.body.appendChild(heart);
    
    // Remove heart after animation
    setTimeout(() => {
        heart.remove();
    }, 5000);
}

// Create hearts periodically
setInterval(createHeart, 300);

// ⏳ Countdown Lock until September 10 (Philippines time)
function updateCountdown() {
    const now = new Date();
    const utc8Now = new Date(now.toLocaleString("en-US", { timeZone: "Asia/Manila" }));
    const target = new Date("September 10, " + utc8Now.getFullYear() + " 00:00:00 GMT+0800");
    const diff = target - utc8Now;

    if (diff <= 0) {
        unlockNow();
        return;
    }

    const days = Math.floor(diff / (1000 * 60 * 60 * 24));
    const hours = Math.floor((diff / (1000 * 60 * 60)) % 24);
    const mins = Math.floor((diff / (1000 * 60)) % 60);
    const secs = Math.floor((diff / 1000) % 60);

    let output = '';
    if (days > 0) output += `${days}d `;
    output += `${hours}h ${mins}m ${secs}s`;

    document.getElementById("countdown").textContent = output;
}

function unlockNow() {
    document.getElementById("countdownOverlay").style.display = 'none';
    document.getElementById("mainContent").style.display = 'block';
    setTimeout(() => {
        confetti({ particleCount: 200, spread: 90, origin: { y: 0.6 } });
    }, 500);
    typeWriter(); // Call the function to apply floating animation to the title
}

setInterval(updateCountdown, 1000);
updateCountdown();

document.getElementById('startJourneyBtn').addEventListener('click', function () {
    document.getElementById('journeyContent').style.display = 'block';
    this.style.display = 'none';
    // Add extra confetti when starting journey
    confetti({ particleCount: 100, spread: 70, origin: { y: 0.6 } });
});

function zoomImage(img) {
    // Remove any previously zoomed image classes and close button
    const currentlyZoomed = document.querySelector('.memory-image.zoomed');
    if (currentlyZoomed) {
        closeZoom(currentlyZoomed);
    }

    img.classList.add('zoomed');

    // Force a reflow/repaint to potentially fix rendering glitches
    void img.offsetWidth;

    // Create and append close button
    const closeButton = document.createElement('div');
    closeButton.className = 'close-button';
    closeButton.innerHTML = '&times;'; // '×' character
    document.body.appendChild(closeButton);

    // Add click listener to close button
    closeButton.addEventListener('click', closeZoom);

    // Remove click listener from image (it's handled by the button now)
    img.removeEventListener('click', closeZoom);

    // Do NOT prevent body scrolling
    // document.body.style.overflow = 'hidden';
}

// Pass the image element to closeZoom
function closeZoom(img) {
    // If img is not provided, find the currently zoomed image
    const zoomedImg = img && img.classList && img.classList.contains('zoomed') ? img : document.querySelector('.memory-image.zoomed');
    const closeButton = document.querySelector('.close-button');

    if (zoomedImg) {
        zoomedImg.classList.remove('zoomed');
        // Re-add the click listener to the thumbnail for zooming again
        zoomedImg.addEventListener('click', zoomImage);
    }

    if (closeButton) {
        closeButton.removeEventListener('click', closeZoom);
        closeButton.remove();
    }

    // Re-enable body scrolling (this line is no longer strictly needed as we removed the disable line, but keeping for clarity/symmetry)
    document.body.style.overflow = '';
}

// Close zoom on escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeZoom();
    }
});
</script>
@endsection
