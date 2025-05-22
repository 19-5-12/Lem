<!DOCTYPE html>
<html>
<head>
    <title>Happy Birthday 🎉</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <style>
        body {
            background-image: linear-gradient(120deg, #ffd1dc 0%, #ffe4ec 100%);
            background-attachment: fixed;
            background-size: cover;
        }
        .fade-enter {
            animation: fadeIn 1s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .polaroid {
            background: #fff0f5;
            border: 3px dashed #ffb6c1;
            padding: 10px;
            border-radius: 15px;
            transition: transform 0.3s;
        }
        .polaroid:hover {
            transform: scale(1.05) rotate(-1deg);
        }
        .btn-pink {
            background-color: #ff69b4;
            color: white;
            border-radius: 30px;
            font-weight: bold;
            padding: 12px 24px;
            transition: all 0.3s ease;
        }
        .btn-pink:hover {
            background-color: #ff85c1;
            transform: scale(1.05);
        }
        .memory-card {
            position: relative;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
        }
        .memory-card:hover {
            transform: translateY(-5px) scale(1.02);
            box-shadow: 0 8px 20px rgba(255, 77, 109, 0.2) !important;
        }
        .memory-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            transition: transform 0.5s ease;
            cursor: pointer;
        }
        .memory-image.zoomed {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            transform: none;
            max-width: 100vw;
            max-height: 100vh;
            z-index: 1001;
            object-fit: contain;
            cursor: default;
        }
        .zoom-overlay,
        .zoom-overlay.show {
            display: none !important;
        }
        .floating {
            animation: float 3s ease-in-out infinite;
        }
        .floating-button {
            animation: float 2s ease-in-out infinite;
        }
        .floating-letter {
            display: inline-block;
            animation: float 2s ease-in-out infinite;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
        .message-card {
            transition: transform 0.3s ease;
        }
        .message-card:hover {
            transform: translateY(-3px);
        }
        .heart {
            position: fixed;
            font-size: 20px;
            animation: float 3s ease-in-out infinite;
            opacity: 0.6;
            pointer-events: none;
            z-index: 9998;
        }
        .caption-bubble {
            background: linear-gradient(135deg, #ff9a9e 0%, #fecfef 99%, #fecfef 100%);
            border-radius: 20px;
            padding: 15px 25px;
            display: inline-block;
            margin: 15px auto;
            max-width: 600px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            animation: pulse 1.5s infinite ease-in-out;
        }
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.03); }
            100% { transform: scale(1); }
        }
        .caption-text {
            font-size: 1.1rem;
            color: #4a4a4a;
            font-weight: 600;
            text-shadow: 1px 1px 2px rgba(255, 255, 255, 0.5);
        }
        .close-button {
            position: fixed;
            top: 20px;
            right: 20px;
            font-size: 30px;
            color: white;
            cursor: pointer;
            z-index: 1040;
            background: rgba(0, 0, 0, 0.5);
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            line-height: 1;
            transition: background 0.3s ease;
        }
        .close-button:hover {
            background: rgba(0, 0, 0, 0.7);
        }
    </style>
</head>
<body class="fade-enter">
    <!-- 🌸 Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
        <div class="container">
            <a class="navbar-brand" href="/">🎂 Happy Birthday!</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="/messages">💌 Messages</a></li>
                    <li class="nav-item"><a class="nav-link" href="/memories">📸 Memories</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container py-4">
        @yield('content')
    </div>

    <!-- Background Music -->
    <audio autoplay loop hidden>
        <source src="{{ asset('music/happy-birthday.mp3') }}" type="audio/mpeg">
        Your browser does not support the audio element.
    </audio>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
