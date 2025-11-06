<?php
// D&D bojova hra - super grafika a vsechno
// Spustit: php -S localhost:3000 game-dnd.php
// Ovladani: pis prikazy (attack defend heal) a enter nebo klikni
// PHP verze: 7.0+
// Autor: Jmeno Prijmeni - student STG

class Nastaveni {
    public static $nazevHry = "D&D Bojova Hra";
    public static $sirkaPlatna = 800;
    public static $vyskaPlatna = 600;
}
?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo Nastaveni::$nazevHry; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=VT323&display=swap');
        
        body {
            margin: 0;
            padding: 0;
            background: #000;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            font-family: 'VT323', 'Courier New', monospace;
            color: #00ff41;
            overflow-y: auto;
            position: relative;
        }
        
        /* Starry night sky background */
        body::before {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: #000;
            z-index: -2;
        }
        
        /* Animated stars with nebula effect */
        body::after {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: 
                /* Nebula clouds */
                radial-gradient(ellipse at 20% 30%, rgba(138, 43, 226, 0.1) 0%, transparent 50%),
                radial-gradient(ellipse at 80% 70%, rgba(0, 255, 65, 0.08) 0%, transparent 40%),
                radial-gradient(ellipse at 50% 20%, rgba(255, 20, 147, 0.06) 0%, transparent 45%),
                /* Large bright stars */
                radial-gradient(4px 4px at 15% 25%, #ffffff, transparent),
                radial-gradient(3px 3px at 85% 15%, #00ff41, transparent),
                radial-gradient(4px 4px at 45% 85%, #ffffff, transparent),
                radial-gradient(3px 3px at 75% 55%, #ff1493, transparent),
                radial-gradient(5px 5px at 25% 75%, #00ffff, transparent),
                /* Medium stars */
                radial-gradient(2px 2px at 20% 30%, #00ff41, transparent),
                radial-gradient(2px 2px at 60% 70%, #00ff41, transparent),
                radial-gradient(2px 2px at 35% 45%, #ffffff, transparent),
                radial-gradient(2px 2px at 80% 25%, #ff69b4, transparent),
                radial-gradient(2px 2px at 10% 85%, #00ff41, transparent),
                radial-gradient(2px 2px at 90% 60%, #ffffff, transparent),
                radial-gradient(2px 2px at 50% 10%, #00ffff, transparent),
                radial-gradient(2px 2px at 70% 90%, #ff1493, transparent),
                /* Small stars */
                radial-gradient(1px 1px at 5% 5%, #ffffff, transparent),
                radial-gradient(1px 1px at 15% 15%, #00ff41, transparent),
                radial-gradient(1px 1px at 25% 25%, #ffffff, transparent),
                radial-gradient(1px 1px at 35% 35%, #ff69b4, transparent),
                radial-gradient(1px 1px at 45% 45%, #00ffff, transparent),
                radial-gradient(1px 1px at 55% 55%, #ffffff, transparent),
                radial-gradient(1px 1px at 65% 65%, #00ff41, transparent),
                radial-gradient(1px 1px at 75% 75%, #ff1493, transparent),
                radial-gradient(1px 1px at 85% 85%, #ffffff, transparent),
                radial-gradient(1px 1px at 95% 95%, #00ff41, transparent),
                /* Tiny scattered stars */
                radial-gradient(1px 1px at 12% 40%, #ffffff, transparent),
                radial-gradient(1px 1px at 28% 60%, #00ff41, transparent),
                radial-gradient(1px 1px at 42% 20%, #ff69b4, transparent),
                radial-gradient(1px 1px at 58% 80%, #00ffff, transparent),
                radial-gradient(1px 1px at 72% 35%, #ffffff, transparent),
                radial-gradient(1px 1px at 88% 65%, #00ff41, transparent),
                radial-gradient(1px 1px at 8% 75%, #ff1493, transparent),
                radial-gradient(1px 1px at 22% 95%, #ffffff, transparent),
                radial-gradient(1px 1px at 38% 8%, #00ff41, transparent),
                radial-gradient(1px 1px at 52% 92%, #ff69b4, transparent),
                radial-gradient(1px 1px at 68% 18%, #00ffff, transparent),
                radial-gradient(1px 1px at 82% 82%, #ffffff, transparent),
                radial-gradient(1px 1px at 92% 28%, #00ff41, transparent),
                radial-gradient(1px 1px at 18% 52%, #ff1493, transparent),
                radial-gradient(1px 1px at 32% 78%, #ffffff, transparent),
                radial-gradient(1px 1px at 48% 12%, #00ff41, transparent),
                radial-gradient(1px 1px at 62% 88%, #ff69b4, transparent),
                radial-gradient(1px 1px at 78% 32%, #00ffff, transparent),
                radial-gradient(1px 1px at 92% 72%, #ffffff, transparent);
            background-size: 400% 400%;
            animation: stars 240s linear infinite, twinkle 3s ease-in-out infinite alternate;
            z-index: -1;
        }
        
        @keyframes stars {
            0% { background-position: 0% 0%; }
            100% { background-position: -400% -400%; }
        }
        
        @keyframes twinkle {
            0% { opacity: 0.8; filter: brightness(1); }
            50% { opacity: 1; filter: brightness(1.2); }
            100% { opacity: 0.9; filter: brightness(1.1); }
        }
        
        /* CRT scanline effect */
        .crt-effect {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: repeating-linear-gradient(
                0deg,
                rgba(0, 255, 65, 0.03),
                rgba(0, 255, 65, 0.03) 1px,
                transparent 1px,
                transparent 2px
            );
            pointer-events: none;
            z-index: 10;
            animation: flicker 0.15s infinite;
        }
        
        @keyframes flicker {
            0% { opacity: 0.97; }
            50% { opacity: 1; }
            100% { opacity: 0.98; }
        }
        .game-container {
            position: relative;
            text-align: center;
            max-width: 900px;
            width: 100%;
            padding: 20px;
            z-index: 2;
            border: 2px solid #00ff41;
            background: linear-gradient(135deg, rgba(0, 0, 0, 0.95), rgba(0, 20, 40, 0.9));
            box-shadow: 
                0 0 30px rgba(0, 255, 65, 0.6),
                0 0 60px rgba(138, 43, 226, 0.3),
                inset 0 0 30px rgba(0, 255, 65, 0.1),
                inset 0 0 60px rgba(138, 43, 226, 0.05);
            backdrop-filter: blur(8px);
            animation: containerGlow 4s ease-in-out infinite alternate;
        }
        
        @keyframes containerGlow {
            0% { box-shadow: 0 0 30px rgba(0, 255, 65, 0.6), 0 0 60px rgba(138, 43, 226, 0.3), inset 0 0 30px rgba(0, 255, 65, 0.1), inset 0 0 60px rgba(138, 43, 226, 0.05); }
            100% { box-shadow: 0 0 40px rgba(0, 255, 65, 0.8), 0 0 80px rgba(138, 43, 226, 0.4), inset 0 0 40px rgba(0, 255, 65, 0.15), inset 0 0 80px rgba(138, 43, 226, 0.08); }
        }
        h1 {
            color: #00ff41;
            text-shadow: 
                0 0 10px #00ff41,
                0 0 20px #00ff41,
                0 0 30px #00ff41,
                2px 2px 0px #00aa2a,
                0 0 40px rgba(138, 43, 226, 0.5);
            margin-bottom: 30px;
            font-size: 3rem;
            font-weight: normal;
            letter-spacing: 6px;
            text-transform: uppercase;
            border: 1px solid #00ff41;
            padding: 15px 25px;
            background: linear-gradient(135deg, rgba(0, 0, 0, 0.9), rgba(138, 43, 226, 0.1));
            display: inline-block;
            animation: glow 2s ease-in-out infinite alternate, titlePulse 3s ease-in-out infinite;
        }
        
        @keyframes titlePulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.02); }
        }
        
        @keyframes glow {
            from { text-shadow: 0 0 10px #00ff41, 0 0 20px #00ff41, 0 0 30px #00ff41, 2px 2px 0px #00aa2a, 0 0 40px rgba(138, 43, 226, 0.5); }
            to { text-shadow: 0 0 15px #00ff41, 0 0 30px #00ff41, 0 0 45px #00ff41, 2px 2px 0px #00aa2a, 0 0 60px rgba(138, 43, 226, 0.7); }
        }
        .character-panel {
            display: flex;
            justify-content: space-around;
            margin-bottom: 30px;
            gap: 20px;
        }
        .character {
            text-align: center;
            background: rgba(0, 0, 0, 0.8);
            padding: 20px;
            border: 1px solid #00ff41;
            width: 45%;
            transition: all 0.3s ease;
            position: relative;
            backdrop-filter: blur(3px);
        }
        .character:hover {
            background: rgba(0, 255, 65, 0.1);
            border-color: #00ff41;
            box-shadow: 
                0 0 15px rgba(0, 255, 65, 0.5),
                inset 0 0 10px rgba(0, 255, 65, 0.1);
        }
        .character img {
            width: 80px;
            height: 80px;
            margin-bottom: 15px;
            border: 1px solid #00ff41;
            background: #000;
            image-rendering: pixelated;
            transition: all 0.3s ease;
            filter: brightness(1.2) contrast(1.1);
        }
        .character:hover img {
            transform: scale(1.05);
            box-shadow: 0 0 15px rgba(0, 255, 65, 0.6);
        }
        .character h3 {
            color: #00ff41;
            margin-bottom: 15px;
            font-size: 1.8rem;
            font-weight: normal;
            text-transform: uppercase;
            letter-spacing: 3px;
            text-shadow: 0 0 5px #00ff41;
        }
        .character p {
            color: #f8f8f2;
            margin: 5px 0;
            font-size: 1.1rem;
            font-weight: 400;
        }
        .character .stat {
            background: rgba(0, 0, 0, 0.7);
            padding: 8px 12px;
            border: 1px solid #00ff41;
            display: inline-block;
            margin: 5px;
            font-weight: normal;
            transition: all 0.3s ease;
            font-size: 1rem;
            letter-spacing: 2px;
            text-transform: uppercase;
        }
        .character .stat:hover {
            background: rgba(0, 255, 65, 0.1);
            box-shadow: 0 0 8px rgba(0, 255, 65, 0.4);
        }
        #combat-log {
            width: 100%;
            max-width: 800px;
            background: rgba(0, 0, 0, 0.9);
            color: #00ff41;
            padding: 20px;
            min-height: 350px;
            max-height: 400px;
            overflow-y: auto;
            font-family: 'VT323', 'Courier New', monospace;
            font-weight: normal;
            box-shadow: 
                0 0 15px rgba(0, 255, 65, 0.3),
                inset 0 0 10px rgba(0, 255, 65, 0.05);
            margin: 20px auto;
            border: 1px solid #00ff41;
            text-align: left;
            font-size: 1.1rem;
            line-height: 1.6;
            backdrop-filter: blur(3px);
        }
        #command-input {
            margin: 20px auto;
            max-width: 600px;
        }
        #commandField {
            background: rgba(0, 0, 0, 0.8);
            border: 1px solid #00ff41;
            color: #00ff41;
            padding: 12px 20px;
            font-size: 1.2rem;
            font-family: 'VT323', 'Courier New', monospace;
            font-weight: normal;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        #commandField:focus {
            background: rgba(0, 255, 65, 0.1);
            border-color: #00ff41;
            box-shadow: 0 0 10px rgba(0, 255, 65, 0.4);
            outline: none;
        }
        #commandField::placeholder {
            color: rgba(0, 255, 65, 0.5);
        }
        .btn {
            padding: 12px 30px;
            font-weight: normal;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            border: 1px solid #00ff41;
            margin: 5px;
            background: rgba(0, 0, 0, 0.8);
            color: #00ff41;
            font-family: 'VT323', 'Courier New', monospace;
            text-transform: uppercase;
            letter-spacing: 2px;
        }
        .btn:hover {
            background: rgba(0, 255, 65, 0.1);
            box-shadow: 0 0 10px rgba(0, 255, 65, 0.4);
            transform: translateY(-2px);
        }
        .btn-primary {
            border-color: #00ff00;
            color: #00ff00;
        }
        .btn-success {
            border-color: #00ff00;
            color: #00ff00;
        }
        .btn-danger {
            border-color: #ff4141;
            color: #ff4141;
        }
        .btn-danger:hover {
            background: rgba(255, 65, 65, 0.1);
            box-shadow: 0 0 10px rgba(255, 65, 65, 0.4);
        }
        .combat-log {
            animation: fadeIn 0.5s ease-in;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        .typing {
            border-right: 2px solid #00ff41;
            animation: blink 1s infinite;
        }
        @keyframes blink {
            0%, 50% { border-color: #00ff41; }
            51%, 100% { border-color: transparent; }
        }
        .damage-flash {
            animation: damageFlash 0.3s ease;
        }
        @keyframes damageFlash {
            0%, 100% { background: rgba(0, 0, 0, 0.8); border-color: #00ff41; }
            50% { background: rgba(255, 65, 65, 0.2); border-color: #ff4141; }
        }
        .heal-flash {
            animation: healFlash 0.3s ease;
        }
        @keyframes healFlash {
            0%, 100% { background: rgba(0, 0, 0, 0.8); border-color: #00ff41; }
            50% { background: rgba(0, 255, 65, 0.2); border-color: #00ff41; box-shadow: 0 0 20px rgba(0, 255, 65, 0.6); }
        }
        .attack-animation {
            animation: attackMove 0.3s ease;
        }
        @keyframes attackMove {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(10px); }
            75% { transform: translateX(-5px); }
        }
        .defend-animation {
            animation: defendShake 0.2s ease;
        }
        @keyframes defendShake {
            0%, 100% { transform: rotate(0deg); }
            50% { transform: rotate(-2deg); }
        }
        .victory-animation {
            animation: victoryBlink 0.5s ease infinite;
        }
        @keyframes victoryBlink {
            0%, 100% { border-color: #00ff41; box-shadow: 0 0 10px rgba(0, 255, 65, 0.6); }
            50% { border-color: #ffffff; box-shadow: 0 0 20px rgba(255, 255, 255, 0.8); }
        }
        .defeat-animation {
            animation: defeatFade 1s ease forwards;
        }
        @keyframes defeatFade {
            0% { opacity: 1; border-color: #00ff41; }
            100% { opacity: 0.5; border-color: #ff4141; }
        }
        .command-buttons {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 15px;
        }
        .command-btn {
            background: rgba(0, 0, 0, 0.8);
            border: 1px solid #00ff41;
            color: #00ff41;
            padding: 8px 16px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 1rem;
            font-family: 'VT323', 'Courier New', monospace;
            font-weight: normal;
            text-transform: uppercase;
            letter-spacing: 2px;
        }
        .command-btn:hover {
            background: rgba(0, 255, 65, 0.1);
            box-shadow: 0 0 8px rgba(0, 255, 65, 0.4);
            transform: translateY(-1px);
        }
        #combat-log::-webkit-scrollbar {
            width: 10px;
        }
        #combat-log::-webkit-scrollbar-track {
            background: rgba(0, 0, 0, 0.5);
            border: 1px solid #00ff41;
        }
        #combat-log::-webkit-scrollbar-thumb {
            background: #00ff41;
            border: 1px solid #00ff41;
        }
        #combat-log::-webkit-scrollbar-thumb:hover {
            background: rgba(0, 255, 65, 0.8);
        }
    </style>
</head>
<body>
    <div class="crt-effect"></div>
    <div class="game-container">
        <h1>⚔️ <?php echo Nastaveni::$nazevHry; ?> ⚔️</h1>
        
        <div class="character-panel">
            <div class="character" id="hero-panel">
                <img src="https://via.placeholder.com/100x100/4A0080/FFFFFF?text=👤" alt="Hero">
                <h3 id="hero-name">Petr</h3>
                <div class="stat">HP: <span id="hero-hp">50</span>/50</div>
                <div class="stat">Obrana: <span id="hero-ac">14</span></div>
                <div class="stat">Utok: +<span id="hero-attack">5</span></div>
                <div class="stat">Zraneni: <span id="hero-damage">1k8+3</span></div>
            </div>
            <div class="character" id="monster-panel">
                <img src="https://via.placeholder.com/100x100/1A0033/FFFFFF?text=👤" alt="Monster">
                <h3 id="monster-name">Pavel</h3>
                <div class="stat">HP: <span id="monster-hp">30</span>/30</div>
                <div class="stat">Obrana: <span id="monster-ac">12</span></div>
                <div class="stat">Utok: +<span id="monster-attack">3</span></div>
                <div class="stat">Zraneni: <span id="monster-damage">1k6+1</span></div>
            </div>
        </div>
        
        <div id="combat-log" class="combat-log"></div>
        
        <div id="command-input" class="mt-3" style="display: none;">
            <div class="input-group">
                <input type="text" id="commandField" class="form-control" placeholder="Zadej prikaz (attack defend heal)" autocomplete="off">
                <button class="btn btn-success" type="button" id="executeCommandBtn">Proveď!</button>
            </div>
            <div class="command-buttons">
                <button class="command-btn" onclick="nastavPrikaz('attack')">⚔️ Attack</button>
                <button class="command-btn" onclick="nastavPrikaz('defend')">🛡️ Defend</button>
                <button class="command-btn" onclick="nastavPrikaz('heal')">💚 Heal</button>
            </div>
        </div>
        
        <div class="mt-4">
            <button id="startCombatBtn" class="btn btn-primary">🎮 Start Combat</button>
            <button id="resetCombatBtn" class="btn btn-danger" style="display: none;">🔄 Reset Combat</button>
        </div>
    </div>

    <script>
        // Statistiky hrdiny
        let hrdina = {
            jmeno: "Petr",
            zivoty: 50,
            maxZivoty: 50,
            obrana: 14,
            bonusUtoku: 5,
            pocetKostek: 1,
            stranaKostky: 8,
            bonusZraneni: 3,
            docasnaObrana: 0
        };

        // Statistiky nestvury
        let nestvura = {
            jmeno: "Pavel",
            zivoty: 30,
            maxZivoty: 30,
            obrana: 12,
            bonusUtoku: 3,
            pocetKostek: 1,
            stranaKostky: 6,
            bonusZraneni: 1
        };

        // Stav hry
        let bojovyDenik = document.getElementById('combat-log');
        let beziBoj = false;
        let kdoHraje = 'hrdina';
        let cisloTahu = 0;
        let piseSe = false;
        let bojSkoncil = false;

        // Texty pro akce hrdiny
        const textyUtoku = [
            "divoce utoci mecem",
            "uderi silnym uderem",
            "provede rychly vypad",
            "utoci s bojovym krikem",
            "vrhne se vpred s obrovskou silou"
        ];
        
        const textyObrany = [
            "kryje se stitem",
            "prijima obrannou pozici",
            "pripravuje se na odrazeni utoku",
            "zpevnuje svou obranu",
            "zveda stit a ceka na utok"
        ];
        
        const textyLeceni = [
            "pouziva lecivy lektvar",
            "zasipta lecive zaklinadlo",
            "obvazuje sve rany",
            "privolava magickou energii",
            "vpije svuj posledni lektvar"
        ];
        
        const textyUtokuNestvury = [
            "utoci svym nozem",
            "vrhne se dopredu s pichnutim",
            "uderi lstivym utokem",
            "pokusi se o rychly vypad",
            "skace a utoci zepredu"
        ];
        
        const komentarePanaJeziska = [
            "Napeti v jeskyni stupa",
            "Boj pokracuje s neuprosnou silou",
            "Kdo zvitezi v tomto souboji",
            "Vzduch je plny prachu a krve",
            "Hrdina se snazi o protiutok",
            "Nestvura je stale nebezpecna",
            "Bitva dosahuje sveho vrcholu",
            "Oba bojovnici jsou odhodlani"
        ];
        
        const defendDescriptions = [
            "se kryje štítem!",
            "přijme obrannou pozici!",
            "se připraví na odražení útoku!",
            "zpevní svou obranu!",
            "zvedne štít a čeká na útok!"
        ];
        
        const healDescriptions = [
            "použije léčivý lektvar!",
            "zašeptá léčivé zaklínadlo!",
            "obvazuje své rány!",
            "přivolá magickou energii pro uzdravení!",
            "vypije svůj poslední lektvar!"
        ];
        
        const monsterAttackDescriptions = [
            "zaútočí svým nožem!",
            "vrhne se dopředu s píchnutím!",
            "udeří lstivým útokem!",
            "pokusí se o rychlý výpad!",
            "skáče a útočí zepředu!"
        ];
        
        const dmComments = [
            "Napětí v jeskyni stoupá!",
            "Boj pokračuje s neúprosnou silou!",
            "Kdo zvítězí v tomto souboji?",
            "Vzduch je plný prachu a krve!",
            "Hrdina se snaží o protiútok!",
            "Příšera je stále nebezpečná!",
            "Bitva dosahuje svého vrcholu!",
            "Oba bojovníci jsou odhodláni!"
        ];

 // Funkce pro postupne psani textu
        function psaniTextu(text, callback) {
            piseSe = true;
            let i = 0;
            let tempDiv = document.createElement('div');
            tempDiv.className = 'typing';
            bojovyDenik.appendChild(tempDiv);
            
            let interval = setInterval(() => {
                if (i < text.length) {
                    tempDiv.innerHTML = text.substring(0, i + 1);
                    i++;
                    bojovyDenik.scrollTop = bojovyDenik.scrollHeight;
                } else {
                    clearInterval(interval);
                    tempDiv.classList.remove('typing');
                    piseSe = false;
                    if (callback) callback();
                }
            }, 25);
        }

        // Pridej text do deniku
        function pridejDoDeniku(text, delay = 0) {
            if (delay > 0) {
                setTimeout(() => pridejDoDeniku(text), delay);
                return;
            }
            
            if (piseSe) {
                setTimeout(() => pridejDoDeniku(text), 100);
                return;
            }
            
            psaniTextu(text, () => {
                bojovyDenik.scrollTop = bojovyDenik.scrollHeight;
            });
        }

 // Aktualizace statistik postav
        function aktualizujStatistiky() {
            document.getElementById('hero-hp').textContent = Math.max(0, hrdina.zivoty);
            document.getElementById('hero-ac').textContent = hrdina.obrana + hrdina.docasnaObrana;
            document.getElementById('monster-hp').textContent = Math.max(0, nestvura.zivoty);
            document.getElementById('monster-ac').textContent = nestvura.obrana;
            
            // Zmena barvy zivotu podle stavu
            const hrdinaZivotyElement = document.getElementById('hero-hp');
            const nestvuraZivotyElement = document.getElementById('monster-hp');
            
            if (hrdina.zivoty <= hrdina.maxZivoty * 0.25) {
                hrdinaZivotyElement.style.color = '#ff6b6b';
            } else if (hrdina.zivoty <= hrdina.maxZivoty * 0.5) {
                hrdinaZivotyElement.style.color = '#ffd93d';
            } else {
                hrdinaZivotyElement.style.color = '#6bcf7f';
            }
            
            if (nestvura.zivoty <= nestvura.maxZivoty * 0.25) {
                nestvuraZivotyElement.style.color = '#ff6b6b';
            } else if (nestvura.zivoty <= nestvura.maxZivoty * 0.5) {
                nestvuraZivotyElement.style.color = '#ffd93d';
            } else {
                nestvuraZivotyElement.style.color = '#6bcf7f';
            }
        }

 // Komentar pana Jeziska (dungeon mastera)
        function panJezisekMluvi(text) {
            pridejDoDeniku(`<span style="color: #ffd700; font-weight: bold;">🎭 Pan Ježíšek:</span> <span style="color: #ffd700;">${text}</span>`);
        }

        // Hod kostkou
        function hodKostkou(pocet, strany) {
            let soucet = 0;
            let hody = [];
            for (let i = 0; i < pocet; i++) {
                let hod = Math.floor(Math.random() * strany) + 1;
                hody.push(hod);
                soucet += hod;
            }
            return { soucet, hody };
        }

 // Provedeni utoku
        function provedUtok(utocnik, obrance, jeNestvura = false) {
            let hodUtoku = hodKostkou(1, 20).soucet + utocnik.bonusUtoku;
            let prirozenyHod = hodUtoku - utocnik.bonusUtoku;
            let popis = jeNestvura ? 
                textyUtokuNestvury[Math.floor(Math.random() * textyUtokuNestvury.length)] : 
                textyUtoku[Math.floor(Math.random() * textyUtoku.length)];
            
            let barva = jeNestvura ? '#6bcf7f' : '#8b4513';
            let zprava = `<span style="color: ${barva}; font-style: italic;">⚔️ ${utocnik.jmeno} ${popis}</span><br>`;
            zprava += `<b>Hod na utok:</b> ${hodUtoku} (D20: ${prirozenyHod} + ${utocnik.bonusUtoku}) vs AC ${obrance.obrana + obrance.docasnaObrana}`;
            
            if (prirozenyHod === 20) {
                zprava += `<br><span style="color: #ffd700; font-weight: bold;">💥 KRITICKY ZASAH</span>`;
                let zraneni = hodKostkou(utocnik.pocetKostek * 2, utocnik.stranaKostky).soucet + utocnik.bonusZraneni;
                zprava += `<br><b>Zraneni:</b> <span style="color: #ff6b6b; font-weight: bold;">${zraneni}</span> (${utocnik.pocetKostek * 2}k${utocnik.stranaKostky} + ${utocnik.bonusZraneni})`;
                return {zasah: true, zraneni: zraneni, zprava: zprava, kriticky: true};
            } else if (prirozenyHod === 1) {
                zprava += `<br><span style="color: #ff6b6b; font-weight: bold;">❌ KRITICKY MINUL</span>`;
                return {zasah: false, zraneni: 0, zprava: zprava, neuspech: true};
            } else if (hodUtoku >= obrance.obrana + obrance.docasnaObrana) {
                let zraneni = hodKostkou(utocnik.pocetKostek, utocnik.stranaKostky).soucet + utocnik.bonusZraneni;
                zprava += `<br><b>Zasah</b> Zraneni: <span style="color: #ff6b6b; font-weight: bold;">${zraneni}</span> (${utocnik.pocetKostek}k${utocnik.stranaKostky} + ${utocnik.bonusZraneni})`;
                return {zasah: true, zraneni: zraneni, zprava: zprava};
            } else {
                zprava += `<br><span style="color: #87ceeb;">Minul</span>`;
                return {zasah: false, zraneni: 0, zprava: zprava};
            }
        }

 // Zacatek souboje
        function zacatekSouboje() {
            bojovyDenik.innerHTML = '';
            bojSkoncil = false;
            panJezisekMluvi('⚔️ Vitejte v dungeonu Souboj zacina ⚔️');
            setTimeout(() => pridejDoDeniku(`<span style="color: #fff; font-weight: bold;">${hrdina.jmeno} (HP: ${hrdina.zivoty}/${hrdina.maxZivoty}) vs ${nestvura.jmeno} (HP: ${nestvura.zivoty}/${nestvura.maxZivoty})</span>`), 2000);
            setTimeout(() => pridejDoDeniku('<span style="color: #87ceeb;"><b>Dostupne prikazy:</b> attack (utok) defend (branit) heal (lecit)</span>'), 3500);
            kdoHraje = 'hrdina';
            cisloTahu = 0;
            hrdina.docasnaObrana = 0;
            document.getElementById('command-input').style.display = 'block';
            document.getElementById('startCombatBtn').style.display = 'none';
            document.getElementById('resetCombatBtn').style.display = 'inline-block';
            aktualizujStatistiky();
        }

 // Nastaveni prikazu
        function nastavPrikaz(prikaz) {
            document.getElementById('commandField').value = prikaz;
            document.getElementById('commandField').focus();
        }

        // Provedeni prikazu
        function provedPrikaz(prikaz) {
            if (!beziBoj || kdoHraje !== 'hrdina' || bojSkoncil) return;

            cisloTahu++;
            panJezisekMluvi(komentarePanaJeziska[Math.floor(Math.random() * komentarePanaJeziska.length)]);
            pridejDoDeniku(`<span style="color: #8b4513; font-weight: bold;">🎯 Tah ${cisloTahu} - ${hrdina.jmeno}</span>`);

            let zprava = '';
            let platnyPrikaz = true;

            if (prikaz.toLowerCase() === 'attack') {
                prehrajZvuk('attack');
                document.getElementById('hero-panel').classList.add('attack-animation');
                setTimeout(() => {
                    document.getElementById('hero-panel').classList.remove('attack-animation');
                }, 600);
                
                let vysledekUtoku = provedUtok(hrdina, nestvura, false);
                zprava = vysledekUtoku.zprava;
                if (vysledekUtoku.zasah) {
                    prehrajZvuk('hit');
                    nestvura.zivoty -= vysledekUtoku.zraneni;
                    if (vysledekUtoku.kriticky) {
                        document.getElementById('monster-panel').classList.add('damage-flash');
                        setTimeout(() => {
                            document.getElementById('monster-panel').classList.remove('damage-flash');
                        }, 500);
                    }
                    zprava += `<br><span style="color: #6bcf7f; font-style: italic;">${nestvura.jmeno} krvari Zbyva ${Math.max(0, nestvura.zivoty)} HP</span>`;
                }
            } else if (prikaz.toLowerCase() === 'defend') {
                document.getElementById('hero-panel').classList.add('defend-animation');
                setTimeout(() => {
                    document.getElementById('hero-panel').classList.remove('defend-animation');
                }, 400);
                
                hrdina.docasnaObrana += 2;
                let popis = textyObrany[Math.floor(Math.random() * textyObrany.length)];
                zprava = `<span style="color: #8b4513; font-style: italic;">🛡️ ${hrdina.jmeno} ${popis}</span><br><span style="color: #87ceeb;"><b>Obrana zvysena o 2 do konce tahu</b></span>`;
            } else if (prikaz.toLowerCase() === 'heal') {
                prehrajZvuk('heal');
                let vysledekLeceni = hodKostkou(1, 8);
                let mnozstviLeceni = vysledekLeceni.soucet + 2;
                let stareZivoty = hrdina.zivoty;
                hrdina.zivoty = Math.min(hrdina.maxZivoty, hrdina.zivoty + mnozstviLeceni);
                let skutecneLeceni = hrdina.zivoty - stareZivoty;
                let popis = textyLeceni[Math.floor(Math.random() * textyLeceni.length)];
                zprava = `<span style="color: #8b4513; font-style: italic;">💚 ${hrdina.jmeno} ${popis}</span><br><span style="color: #6bcf7f;"><b>Obnovil ${skutecneLeceni} HP Nyni ma ${hrdina.zivoty}/${hrdina.maxZivoty} HP</b></span>`;
                
                if (skutecneLeceni > 0) {
                    document.getElementById('hero-panel').classList.add('heal-flash');
                    setTimeout(() => {
                        document.getElementById('hero-panel').classList.remove('heal-flash');
                    }, 500);
                }
            } else {
                zprava = '<span style="color: #ff6b6b;"><b>Neznamy prikaz</b> Pouzij: attack defend heal</span>';
                platnyPrikaz = false;
                cisloTahu--;
            }

            pridejDoDeniku(zprava);
            aktualizujStatistiky();

            if (!platnyPrikaz) return;

            // Tah nestvury
            setTimeout(() => {
                if (bojSkoncil) return;
                
                panJezisekMluvi(komentarePanaJeziska[Math.floor(Math.random() * komentarePanaJeziska.length)]);
                pridejDoDeniku(`<span style="color: #6bcf7f; font-weight: bold;">👹 Tah ${cisloTahu} - ${nestvura.jmeno}</span>`);
                
                prehrajZvuk('attack');
                document.getElementById('monster-panel').classList.add('attack-animation');
                setTimeout(() => {
                    document.getElementById('monster-panel').classList.remove('attack-animation');
                }, 600);
                
                let utokNestvury = provedUtok(nestvura, hrdina, true);
                pridejDoDeniku(utokNestvury.zprava);
                
                if (utokNestvury.zasah) {
                    prehrajZvuk('hit');
                    hrdina.zivoty -= utokNestvury.zraneni;
                    if (utokNestvury.kriticky) {
                        document.getElementById('hero-panel').classList.add('damage-flash');
                        setTimeout(() => {
                            document.getElementById('hero-panel').classList.remove('damage-flash');
                        }, 500);
                    }
                    pridejDoDeniku(`<span style="color: #8b4513; font-style: italic;">${hrdina.jmeno} utrpel zraneni Zbyva ${Math.max(0, hrdina.zivoty)} HP</span>`);
                }
                
                aktualizujStatistiky();

                // Reset docasnych efektu
                hrdina.docasnaObrana = 0;

                // Kontrola konce souboje
                if (hrdina.zivoty <= 0) {
                    bojSkoncil = true;
                    prehrajZvuk('defeat');
                    document.getElementById('hero-panel').classList.add('defeat-animation');
                    document.getElementById('monster-panel').classList.add('victory-animation');
                    panJezisekMluvi(`💀 ${nestvura.jmeno} vyhral bitvu 💀`);
                    pridejDoDeniku(`<span style="color: #ff6b6b; font-size: 1.2rem; font-weight: bold;">${nestvura.jmeno} vyhral bitvu</span>`);
                    konecSouboje();
                } else if (nestvura.zivoty <= 0) {
                    bojSkoncil = true;
                    prehrajZvuk('victory');
                    document.getElementById('hero-panel').classList.add('victory-animation');
                    document.getElementById('monster-panel').classList.add('defeat-animation');
                    panJezisekMluvi(`🎉 ${hrdina.jmeno} vyhral bitvu 🎉`);
                    pridejDoDeniku(`<span style="color: #6bcf7f; font-size: 1.2rem; font-weight: bold;">${hrdina.jmeno} vyhral bitvu</span>`);
                    konecSouboje();
                }
            }, 3000);
        }

        function konecSouboje() {
            beziBoj = false;
            document.getElementById('command-input').style.display = 'none';
            pridejDoDeniku('<span style="color: #ffd700; font-weight: bold;">=== KONEC SOUBOJE ===</span>');
        }

        function resetujSouboj() {
            hrdina.zivoty = hrdina.maxZivoty;
            nestvura.zivoty = nestvura.maxZivoty;
            hrdina.docasnaObrana = 0;
            beziBoj = false;
            bojSkoncil = false;
            document.getElementById('command-input').style.display = 'none';
            document.getElementById('startCombatBtn').style.display = 'inline-block';
            document.getElementById('resetCombatBtn').style.display = 'none';
            bojovyDenik.innerHTML = '<span style="color: #87ceeb;">Souboj resetovan Stisknete Start Combat pro novou hru</span>';
            aktualizujStatistiky();
        }

 // Event listenery pro tlacitka
        document.getElementById('startCombatBtn').addEventListener('click', function() {
            if (!beziBoj) {
                beziBoj = true;
                zacatekSouboje();
            }
        });

        document.getElementById('resetCombatBtn').addEventListener('click', resetujSouboj);

        document.getElementById('executeCommandBtn').addEventListener('click', function() {
            let prikaz = document.getElementById('commandField').value.trim();
            if (prikaz) {
                provedPrikaz(prikaz);
                document.getElementById('commandField').value = '';
            }
        });

        document.getElementById('commandField').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                document.getElementById('executeCommandBtn').click();
            }
        });

 // Zvukove efekty
        function prehrajZvuk(typ) {
            const audioContext = new (window.AudioContext || window.webkitAudioContext)();
            const oscillator = audioContext.createOscillator();
            const gainNode = audioContext.createGain();
            
            oscillator.connect(gainNode);
            gainNode.connect(audioContext.destination);
            
            switch(typ) {
                case 'attack':
                    oscillator.frequency.setValueAtTime(200, audioContext.currentTime);
                    oscillator.frequency.exponentialRampToValueAtTime(100, audioContext.currentTime + 0.1);
                    gainNode.gain.setValueAtTime(0.3, audioContext.currentTime);
                    gainNode.gain.exponentialRampToValueAtTime(0.01, audioContext.currentTime + 0.1);
                    oscillator.start(audioContext.currentTime);
                    oscillator.stop(audioContext.currentTime + 0.1);
                    break;
                case 'hit':
                    oscillator.frequency.setValueAtTime(150, audioContext.currentTime);
                    oscillator.frequency.exponentialRampToValueAtTime(50, audioContext.currentTime + 0.2);
                    gainNode.gain.setValueAtTime(0.4, audioContext.currentTime);
                    gainNode.gain.exponentialRampToValueAtTime(0.01, audioContext.currentTime + 0.2);
                    oscillator.start(audioContext.currentTime);
                    oscillator.stop(audioContext.currentTime + 0.2);
                    break;
                case 'heal':
                    oscillator.frequency.setValueAtTime(400, audioContext.currentTime);
                    oscillator.frequency.exponentialRampToValueAtTime(800, audioContext.currentTime + 0.3);
                    gainNode.gain.setValueAtTime(0.2, audioContext.currentTime);
                    gainNode.gain.exponentialRampToValueAtTime(0.01, audioContext.currentTime + 0.3);
                    oscillator.start(audioContext.currentTime);
                    oscillator.stop(audioContext.currentTime + 0.3);
                    break;
                case 'victory':
                    oscillator.frequency.setValueAtTime(400, audioContext.currentTime);
                    oscillator.frequency.setValueAtTime(500, audioContext.currentTime + 0.1);
                    oscillator.frequency.setValueAtTime(600, audioContext.currentTime + 0.2);
                    gainNode.gain.setValueAtTime(0.3, audioContext.currentTime);
                    gainNode.gain.exponentialRampToValueAtTime(0.01, audioContext.currentTime + 0.5);
                    oscillator.start(audioContext.currentTime);
                    oscillator.stop(audioContext.currentTime + 0.5);
                    break;
                case 'defeat':
                    oscillator.frequency.setValueAtTime(200, audioContext.currentTime);
                    oscillator.frequency.exponentialRampToValueAtTime(50, audioContext.currentTime + 0.5);
                    gainNode.gain.setValueAtTime(0.3, audioContext.currentTime);
                    gainNode.gain.exponentialRampToValueAtTime(0.01, audioContext.currentTime + 0.5);
                    oscillator.start(audioContext.currentTime);
                    oscillator.stop(audioContext.currentTime + 0.5);
                    break;
            }
        }

        // Inicializace hry
        aktualizujStatistiky();
        bojovyDenik.innerHTML = '<span style="color: #00ff41;">[SYSTEM] VITEJTE V D&D BOJOVE HRE STISKNETE START COMBAT PRO ZACATEK</span>';
    </script>
</body>
</html>