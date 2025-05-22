<!DOCTYPE html>
<html>
<head>
    <title>Happy Birthday 🎉</title>
    <style>
        body {
            text-align: center;
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #ffe4ec, #ffd1dc);
            min-height: 100vh;
            margin: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }

        .container {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 1s ease, transform 1s ease;
        }

        .container.show {
            opacity: 1;
            transform: translateY(0);
        }

        h1 {
            color: #ff4d6d;
            font-size: 2.5em;
            margin-bottom: 20px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
        }

        .start-button {
            background: #ff4d6d;
            color: white;
            border: none;
            padding: 15px 30px;
            font-size: 1.2em;
            border-radius: 25px;
            cursor: pointer;
            margin: 20px 0;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 4px 15px rgba(255, 77, 109, 0.3);
        }

        .start-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(255, 77, 109, 0.4);
        }

        .links {
            display: none;
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 1s ease, transform 1s ease;
        }

        .links.show {
            display: block;
            opacity: 1;
            transform: translateY(0);
        }

        .link {
            display: inline-block;
            margin: 10px;
            padding: 10px 20px;
            background: white;
            color: #ff4d6d;
            text-decoration: none;
            border-radius: 20px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .link:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.15);
        }

        .floating {
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .heart {
            position: absolute;
            font-size: 20px;
            animation: float 3s ease-in-out infinite;
            opacity: 0.6;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="floating">🎂 HAPPY BIRTHDAY LABLAB KOOO!! 🎉</h1>
        <button class="start-button" onclick="startJourney()">Start the Journey ✨</button>
        <div class="links">
            <a href="/messages" class="link">💌 Sweet Messages</a>
            <a href="/memories" class="link">📸 Our Memories</a>
        </div>
    </div>

    <script>
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

        // Show container with animation
        window.onload = function() {
            setTimeout(() => {
                document.querySelector('.container').classList.add('show');
            }, 500);
        }

        // Start journey function
        function startJourney() {
            document.querySelector('.links').classList.add('show');
            document.querySelector('.start-button').style.display = 'none';
        }
    </script>
</body>
</html>
