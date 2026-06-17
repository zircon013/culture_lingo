<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('CultureLingo Dashboard') }}
        </h2>
    </x-slot>

    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    
    <style>
        /* Dark Mode & Glassmorphism voor de Game Area */
        .game-wrapper {
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
            border-radius: 16px;
            padding: 30px;
            color: white;
            box-shadow: 0 20px 40px rgba(0,0,0,0.2);
            margin-bottom: 30px;
        }

        /* De XP en Streak Banner */
        .stats-banner {
            display: flex;
            justify-content: space-around;
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 30px;
        }
        .stat-item {
            text-align: center;
        }
        .stat-value {
            font-size: 2.5rem;
            font-weight: 900;
            color: #818cf8;
            text-shadow: 0 0 15px rgba(129, 140, 248, 0.4);
        }
        .stat-label {
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #94a3b8;
        }

        /* De Grid Blokken */
        .cultures-grid {
            display: grid;
            grid-template-cols: repeat(auto-fill, minmax(220px, 1fr));
            gap: 20px;
        }
        .glass-block {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 16px;
            padding: 30px 20px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .glass-block:hover {
            transform: translateY(-5px);
            background: rgba(255, 255, 255, 0.08);
            border-color: rgba(129, 140, 248, 0.5);
            box-shadow: 0 10px 25px rgba(0,0,0,0.3);
        }
        
        .choice-btn {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: white;
        }
        .choice-btn:hover:not(:disabled) {
            background: rgba(255, 255, 255, 0.1);
        }
    </style>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
        
        @if(Auth::user()->is_admin)
            <div class="admin-card" style="background-color: #eef2ff; border-left: 5px solid #4f46e5; margin-bottom: 30px;">
                <h3 style="color: #1e293b; font-weight: bold; font-size: 1.2rem; margin-bottom: 10px;">Beheerderspaneel</h3>
                <a href="{{ route('cultures.index') }}" class="btn btn-primary">Landen & Vragen Beheren &rarr;</a>
            </div>
        @endif

        <div class="game-wrapper">
            
            <div class="stats-banner">
                <div class="stat-item">
                    <div class="stat-value" id="ui-xp">{{ Auth::user()->xp }}</div>
                    <div class="stat-label">Totaal XP</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value" id="ui-streak">🔥 {{ Auth::user()->streak }}</div>
                    <div class="stat-label">Dagen Streak</div>
                </div>
            </div>

            <div id="home-screen">
                <h3 style="font-size: 1.5rem; font-weight: bold; margin-bottom: 20px;">Kies een missie:</h3>
                <div id="cultures-grid" class="cultures-grid">
                    <p>Missies laden...</p>
                </div>
            </div>

            <div id="game-area" style="display: none;">
                <button onclick="goBack()" class="btn btn-dark" style="margin-bottom: 20px; background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.2);">&larr; Terug</button>
                
                <h2 id="game-title" style="font-size: 2rem; font-weight: bold; margin-bottom: 15px;"></h2>
                
                <div id="lesson-section">
                    <p id="game-description" style="font-size: 1.1rem; line-height: 1.6; color: #cbd5e1; margin-bottom: 25px; white-space: pre-line;"></p>
                    <button onclick="startQuiz()" class="btn btn-primary" style="width: 100%; padding: 15px; font-size: 1.1rem; background: #4f46e5; border: none;">Start de Quiz!</button>
                </div>

                <div id="quiz-section" style="display: none;">
                    <div style="display: flex; justify-content: space-between; color: #94a3b8; font-size: 0.9rem; margin-bottom: 15px;">
                        <span id="question-counter">Vraag 1</span>
                        <span>Potentiële XP: <span id="current-score" style="font-weight: bold; color: #818cf8;">0</span></span>
                    </div>
                    <h3 id="question-text" style="font-size: 1.4rem; font-weight: bold; margin-bottom: 20px;"></h3>
                    <div id="choices-container"></div>
                    
                    <div id="quiz-feedback" style="padding: 15px; border-radius: 8px; margin-top: 15px; display: none; font-weight: bold;"></div>
                    <button id="next-btn" onclick="nextQuestion()" class="btn btn-primary" style="width: 100%; margin-top: 20px; display: none; background: #4f46e5; border: none;">Volgende Vraag &rarr;</button>
                </div>

                <div id="result-section" style="display: none; text-align: center; padding: 20px 0;">
                    <span style="font-size: 5rem;">🏆</span>
                    <h3 style="font-size: 2rem; font-weight: bold; margin: 15px 0;">Missie Voltooid!</h3>
                    <p style="font-size: 1.2rem; color: #cbd5e1; margin-bottom: 10px;">Je behaalde score: <span id="final-score" style="font-weight: bold; color: #818cf8;"></span></p>
                    <p style="font-size: 1.5rem; color: #4ade80; font-weight: bold; margin-bottom: 25px;" id="xp-gained-text"></p>
                    
                    <button onclick="goBack()" class="btn btn-primary" style="background: #4f46e5; border: none;">Naar Missie-overzicht</button>
                </div>
            </div>
        </div>

        <div style="text-align: center;">
            <a href="{{ route('profile.edit') }}" style="color: #6b7280; text-decoration: none; font-size: 0.9rem;">
                Accountinstellingen &bull; Wachtwoord wijzigen &bull; Account verwijderen
            </a>
        </div>
    </div>

    <script>
        // 1. Initialiseer de browser-geluidsstudio
        const audioCtx = new (window.AudioContext || window.webkitAudioContext)();

        // 2. De synthesizer functie
        function playSound(type) {
            // Browsers blokkeren soms geluid tot je klikt. Dit maakt de studio 'wakker'.
            if (audioCtx.state === 'suspended') {
                audioCtx.resume();
            }

            const oscillator = audioCtx.createOscillator();
            const gainNode = audioCtx.createGain();

            oscillator.connect(gainNode);
            gainNode.connect(audioCtx.destination);

            if (type === 'correct') {
                oscillator.type = 'sine'; // Hoge 'Ding'
                oscillator.frequency.setValueAtTime(800, audioCtx.currentTime); 
                oscillator.frequency.exponentialRampToValueAtTime(1200, audioCtx.currentTime + 0.1); 
                gainNode.gain.setValueAtTime(1, audioCtx.currentTime); 
                gainNode.gain.exponentialRampToValueAtTime(0.01, audioCtx.currentTime + 0.3); 
            } else if (type === 'wrong') {
                oscillator.type = 'sawtooth'; // Lage 'Bzzzt'
                oscillator.frequency.setValueAtTime(150, audioCtx.currentTime); 
                gainNode.gain.setValueAtTime(0.5, audioCtx.currentTime); 
                gainNode.gain.exponentialRampToValueAtTime(0.01, audioCtx.currentTime + 0.3); 
            }

            // Start het geluid en stop het na 0.3 seconden
            oscillator.start(audioCtx.currentTime);
            oscillator.stop(audioCtx.currentTime + 0.3);
        }

        let cultures = [];
        let currentCulture = null;
        let currentQuestionIndex = 0;
        let score = 0;


        async function loadCultureData() {
            try {
                const response = await fetch("{{ url('/api/cultures') }}");
                cultures = await response.json();
                renderCultures();
            } catch (error) {
                document.getElementById('cultures-grid').innerHTML = '<p style="color: #ef4444;">Fout bij het laden.</p>';
            }
        }

        function renderCultures() {
            const grid = document.getElementById('cultures-grid');
            grid.innerHTML = '';
            cultures.forEach((culture, index) => {
                const card = document.createElement('div');
                card.className = 'glass-block';
                card.onclick = () => openGame(index);
                card.innerHTML = `
                    <div style="font-size: 4rem; margin-bottom: 15px; filter: drop-shadow(0 4px 6px rgba(0,0,0,0.2));">${culture.emoji}</div>
                    <h4 style="font-size: 1.3rem; font-weight: bold;">${culture.name}</h4>
                `;
                grid.appendChild(card);
            });
        }

        function openGame(index) {
            currentCulture = cultures[index];
            document.getElementById('home-screen').style.display = 'none';
            document.getElementById('game-area').style.display = 'block';
            document.getElementById('lesson-section').style.display = 'block';
            document.getElementById('quiz-section').style.display = 'none';
            document.getElementById('result-section').style.display = 'none';
            document.getElementById('game-title').innerText = currentCulture.emoji + ' ' + currentCulture.name;
            document.getElementById('game-description').innerText = currentCulture.description;
        }

        function startQuiz() {
            document.getElementById('lesson-section').style.display = 'none';
            document.getElementById('quiz-section').style.display = 'block';
            currentQuestionIndex = 0;
            score = 0;
            document.getElementById('current-score').innerText = score * 50; // Laat 50 XP per vraag zien
            showQuestion();
        }

        function showQuestion() {
            const q = currentCulture.quiz[currentQuestionIndex];
            document.getElementById('question-counter').innerText = `Vraag ${currentQuestionIndex + 1} van ${currentCulture.quiz.length}`;
            document.getElementById('question-text').innerText = q.question;
            const container = document.getElementById('choices-container');
            container.innerHTML = '';
            q.choices.forEach((choice, index) => {
                const btn = document.createElement('button');
                btn.className = 'choice-btn';
                btn.style.width = '100%';
                btn.style.marginBottom = '10px';
                btn.style.padding = '15px';
                btn.style.borderRadius = '8px';
                btn.style.textAlign = 'left';
                btn.innerText = choice;
                btn.onclick = () => checkAnswer(index, btn);
                container.appendChild(btn);
            });
            document.getElementById('quiz-feedback').style.display = 'none';
            document.getElementById('next-btn').style.display = 'none';
        }

        function checkAnswer(selectedIndex, button) {
            const q = currentCulture.quiz[currentQuestionIndex];
            const buttons = document.querySelectorAll('.choice-btn');
            
            // Blokkeer alle knoppen
            buttons.forEach(btn => btn.disabled = true);
            const feedback = document.getElementById('quiz-feedback');
            feedback.style.display = 'block';

            if(selectedIndex === q.answer) {
                // Synthesizer geluid afspelen: CORRECT
                playSound('correct');

                button.style.background = 'rgba(34, 197, 94, 0.2)';
                button.style.borderColor = '#22c55e';
                feedback.innerText = '✅ Correct! +50 XP';
                feedback.style.backgroundColor = 'rgba(34, 197, 94, 0.2)';
                feedback.style.color = '#4ade80';
                score++;
                document.getElementById('current-score').innerText = score * 50;
            } else {
                // Synthesizer geluid afspelen: FOUT
                playSound('wrong');

                button.style.background = 'rgba(239, 68, 68, 0.2)';
                button.style.borderColor = '#ef4444';
                buttons[q.answer].style.background = 'rgba(34, 197, 94, 0.2)';
                buttons[q.answer].style.borderColor = '#22c55e';
                feedback.innerText = '❌ Helaas, dat klopt niet.';
                feedback.style.backgroundColor = 'rgba(239, 68, 68, 0.2)';
                feedback.style.color = '#f87171';
            }

            document.getElementById('next-btn').style.display = 'block';
        }

        function nextQuestion() {
            currentQuestionIndex++;
            if(currentQuestionIndex < currentCulture.quiz.length) {
                showQuestion();
            } else {
                finishGame();
            }
        }

        async function finishGame() {
            document.getElementById('quiz-section').style.display = 'none';
            document.getElementById('result-section').style.display = 'block';
            document.getElementById('final-score').innerText = `${score} / ${currentCulture.quiz.length}`;
            
            const xpEarned = score * 50;
            document.getElementById('xp-gained-text').innerText = `+${xpEarned} XP verdiend!`;

            // Stuur de data naar de backend!
            try {
                const response = await fetch("{{ url('/api/update-stats') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}' // Laravel beveiliging
                    },
                    body: JSON.stringify({ xp: xpEarned })
                });
                
                const result = await response.json();
                if(result.success) {
                    // Update de banner live!
                    document.getElementById('ui-xp').innerText = result.xp;
                    document.getElementById('ui-streak').innerText = '🔥 ' + result.streak;
                }
            } catch(e) {
                console.error('Kon XP niet opslaan', e);
            }
        }

        function goBack() {
            document.getElementById('home-screen').style.display = 'block';
            document.getElementById('game-area').style.display = 'none';
        }

        loadCultureData();
    </script>
</x-app-layout>