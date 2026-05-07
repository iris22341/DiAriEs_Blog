<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>👧 DiAriEs - 愛運動女孩ㄉ凹兜日誌</title>
    <style>
        :root {
            --sidebar-width: 250px;
            --sidebar-collapsed-width: 70px;
            --primary-green: #2d5a27;
            --light-green: #f4f7f1;
        }

        body {
            display: flex;
            margin: 0;
            background-color: var(--light-green);
            font-family: "PingFang TC", "Microsoft JhengHei", sans-serif;
            transition: all 0.3s ease;
        }

        /* 1. 左側選單 */
        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            background: var(--primary-green);
            color: white;
            position: fixed;
            left: 0; top: 0;
            transition: all 0.3s ease;
            overflow-x: hidden;
            z-index: 1000;
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
        }

        .sidebar.collapsed { width: var(--sidebar-collapsed-width); }

        .toggle-btn {
            background: none; border: none; color: white;
            font-size: 24px; cursor: pointer; padding: 20px;
            width: 100%; text-align: left; display: block; outline: none;
        }

        .sidebar-inner {
            padding: 0 20px 30px 20px;
            transition: opacity 0.2s;
            white-space: nowrap;
        }

        .sidebar.collapsed .sidebar-inner { opacity: 0; pointer-events: none; }

        .sidebar h2 { 
            font-size: 1.2em; margin-bottom: 30px; 
            border-bottom: 1px solid rgba(255,255,255,0.2); padding-bottom: 10px; 
        }

        .sidebar-menu { list-style: none; padding: 0; margin: 0; }
        .sidebar-menu li { margin: 25px 0; }
        .sidebar-menu a {
            color: rgba(255,255,255,0.8);
            text-decoration: none; font-weight: 500;
            transition: 0.3s; display: block; cursor: pointer;
        }
        .sidebar-menu a:hover, .sidebar-menu a.active { color: white; padding-left: 10px; font-weight: bold; }

        /* 2. 右側主要內容區 */
        .main-content {
            margin-left: var(--sidebar-width);
            flex-grow: 1;
            padding: 40px;
            transition: all 0.3s ease;
            max-width: 1100px;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .main-content.expanded { margin-left: var(--sidebar-collapsed-width); }

        /* 自介區塊 */
        header {
            margin-bottom: 40px;
            background: white;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            display: flex;
            gap: 30px;
            align-items: center;
        }

        .header-text { flex: 1; border-left: 5px solid var(--primary-green); padding-left: 20px; }
        header h1 { color: var(--primary-green); margin: 0 0 15px 0; font-size: 1.8em; }
        .header-bio { color: #555; line-height: 1.8; font-size: 1em; }

        /* 自介照片牆 */
        .header-photos {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
            width: 300px;
        }
        .header-photos img {
            width: 100%;
            height: 100px;
            object-fit: cover;
            border-radius: 10px;
            transition: transform 0.3s;
        }
        .header-photos img:hover { transform: scale(1.05); }

        /* 文章區塊 (移除 Banner 後) */
        .category-section {
            display: block;
            background: white; border-radius: 20px;
            margin-bottom: 30px; 
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            animation: fadeIn 0.5s;
        }

        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }

        .category-info { padding: 30px; }
        .category-info h3 { color: var(--primary-green); margin-top: 0; font-size: 1.3em; border-bottom: 2px solid var(--light-green); padding-bottom: 10px;}

        /* 文章列表與連結底線 */
        .article-list { list-style: none; padding: 0; margin-top: 15px; }
        .article-list li {
            padding: 15px 0; border-bottom: 1px solid #f0f0f0;
            display: flex; justify-content: space-between; align-items: center;
        }
        .article-list a { 
            text-decoration: underline;
            text-underline-offset: 4px;
            color: #333; font-size: 1.1em; font-weight: 500;
            transition: 0.3s;
        }
        .article-list a:hover { color: var(--primary-green); background-color: rgba(45, 90, 39, 0.05); }

        .article-date { color: #aaa; font-size: 0.9em; }

        /* 頁尾 IG 樣式優化 */
        footer {
            margin-top: auto;
            padding: 40px 0 20px 0;
            text-align: center;
            color: #888;
            font-size: 0.9em;
        }
        .ig-link-container {
            margin-top: 15px;
            display: flex;
            justify-content: center;
        }
        .ig-link-wrapper {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            transition: transform 0.2s ease;
        }
        .ig-link-wrapper:hover {
            transform: scale(1.05);
        }
        .ig-icon {
            width: 10px;
            height: 10px;
            object-fit: contain;
        }
        .ig-link {
            color: var(--primary-green);
            font-weight: bold;
            font-size: 1.1em;
        }

        /* 📱 手機版專屬優化 */
        @media (max-width: 768px) {
            body { flex-direction: column; }
            .sidebar {
                width: 100% !important; height: auto; position: sticky; top: 0;
                background: var(--primary-green);
            }
            .toggle-btn, .sidebar h2, .sidebar hr { display: none; }
            .sidebar-inner { padding: 10px; overflow-x: auto; }
            .sidebar-menu { display: flex; gap: 10px; }
            .sidebar-menu li { margin: 0; }
            .sidebar-menu a { padding: 8px 12px; background: rgba(255,255,255,0.1); border-radius: 15px; font-size: 0.85em; }
            .sidebar-menu a.active { background: white; color: var(--primary-green); }

            .main-content { margin-left: 0 !important; padding: 15px; }
            
            header { flex-direction: column; align-items: flex-start; padding: 20px; }
            .header-photos { width: 100%; grid-template-columns: repeat(4, 1fr); margin-top: 20px; }
            .header-photos img { height: 70px; }

            .article-list li { flex-direction: column; align-items: flex-start; gap: 5px; }
        }
    </style>
</head>
<body>

<nav class="sidebar" id="mySidebar">
    <button class="toggle-btn" onclick="toggleNav()">☰</button>
    <div class="sidebar-inner">
        <h2>DiAriEs 分類</h2>
        <ul class="sidebar-menu">
            <li><a onclick="showCategory('mountain')" class="menu-item">⛰️ 爬山</a></li>
            <li><a onclick="showCategory('sea')" class="menu-item">🌊 潛水</a></li>
            <li><a onclick="showCategory('run')" class="menu-item">🏃 跑步</a></li>
            <li><a onclick="showCategory('travel')" class="menu-item">✈️ 旅行</a></li>
            <li><a onclick="showAll()" class="menu-item active">🏠 全部</a></li>
        </ul>
    </div>
</nav>

<main class="main-content" id="mainSection">
    <header>
        <div class="header-text">
            <h1>👧 DiAriEs - 凹兜日誌</h1>
            <div class="header-bio"> 
                喜歡跑河濱 > 跑操場 >>> 跑步機 <br/>
                佛系完百，享受山頭不同時期的美<br/>
                山、海都愛，目前還是山系女子<br/>
                目標每年安排一次出國 (●'◡'●)
            </div>
        </div>
        <div class="header-photos">
            <img src="https://lh3.googleusercontent.com/pw/AP1GczO2nUhiDzlexeRRzpUdAosQEtnUTqWpINVOU_i3rEKv9exu8ALsTcMONayUYLDUdbIBCYKW1QKA9KEvRBS54pllOGugbwuSZ6mZvHPkMubVKO8LQcRA=w1200-h1000-p-k" alt="品池單攻">
            <img src="https://lh3.googleusercontent.com/pw/AP1GczNxG1KTGjZpvvSeW_fotRngMWYQebfv31vN3XEjjiG1xVEtLdTuUgAF-kMAZ5ZrcSlDuCj55m3fC_lou89oS_6I-o9Nt2Yv8UtM0q7i00JnMzvK18Nq=w1200-h1000-p-k" alt="嘉明湖景">
            <img src="https://lh3.googleusercontent.com/pw/AP1GczPTfQpTYsw3TAca_hSlf3D0Q-QnQl0Nb6_C6ccB34OH43clKh8qOuRK2EBVjlzDrh5-LmKpwLd3STEXmHYU9EqQiULOgjg59PxJchPJi-IfQ5CJG8go=w1200-h1000-p-k" alt="花蓮景">
            <img src="https://lh3.googleusercontent.com/pw/AP1GczMCrcdgf0vtQEdJ5uyPjbW5WMLv2rzxSICbEBatcKkAnDOwDuJwuGe88-P5oqBPuu2xfxiclp3JXOu76zZviEPLR1gprCmx4i-3Kx0H20QiWOMGbsqu=w1200-h1000-p-k" alt="極光">
        </div>
    </header>
    
    <section id="mountain" class="category-section">
        <div class="category-info">
            <h3>⛰️ DiAriEs about 爬山</h3>
            <ul class="article-list">
                <li><a href="/post/mtsyue_DiArIEs.php">雪山東峰單攻紀錄</a><span class="article-date">2025/11/23</span></li>
                <li><p>To be continued......</p></li>
            </ul>
        </div>
    </section>

    <section id="sea" class="category-section">
        <div class="category-info">
            <h3>🌊 DiAriEs about 潛水</h3>
            <ul class="article-list">
                <li><p>To be continued......</p></li>
            </ul>
        </div>
    </section>

    <section id="run" class="category-section">
        <div class="category-info">
            <h3>🏃 DiAriEs about 跑步</h3>
            <ul class="article-list">
                <li><a href="https://iris22341.github.io/DiAriEs/articles/crufunorth_DiAriEs.html?utm_source=web&utm_medium=display&utm_campaign=crufunorth_DiAriEs" target="_blank" rel="noopener noreferrer">2026 CRUFU RUN 北台灣站</a><span class="article-date">2026/04/11-04/12</span></li>
                <li><p>To be continued......</p></li>
            </ul>
        </div>
    </section>

    <section id="travel" class="category-section">
        <div class="category-info">
            <h3>✈️ DiAriEs about 旅行</h3>
            <ul class="article-list">
                <li><p>To be continued......</p></li>
        </div>
    </section>

    <footer>
        <p>© 2026 DiAriEs' Blog | Capturing every moment of dopamine.</p>
        <div class="ig-link-container">
            <a href="https://www.instagram.com/agirlwholovesexercise?igsh=MXA2OG84ZHV3NGRhMg%3D%3D&utm_source=qr" target="_blank" class="ig-link-wrapper">
                <img src="https://lh3.googleusercontent.com/pw/AP1GczPmOjN3BxndCtx_6bwZ1Q6EESKQ4tesXBBEUNjHnby4eU6z_SQYLVOqOtHhRVCOJbda40wzWgHfuqyVNrzyd789_xtk4-_KzXhzQjoukWjGDOFpLMtS=w30-h30-p-k" alt="Instagram Icon">
                <span class="ig-link">Follow me on Instagram</span>
            </a>
        </div>
    </footer>
</main>

<script>
    function toggleNav() {
        document.getElementById("mySidebar").classList.toggle("collapsed");
        document.getElementById("mainSection").classList.toggle("expanded");
    }

    function showCategory(categoryId) {
        const sections = document.querySelectorAll('.category-section');
        sections.forEach(sec => {
            sec.style.display = (sec.id === categoryId) ? 'block' : 'none';
        });
        const menuItems = document.querySelectorAll('.menu-item');
        menuItems.forEach(item => item.classList.remove('active'));
        if (event) event.currentTarget.classList.add('active');
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    function showAll() {
        const sections = document.querySelectorAll('.category-section');
        sections.forEach(sec => sec.style.display = 'block');
        const menuItems = document.querySelectorAll('.menu-item');
        menuItems.forEach(item => item.classList.remove('active'));
        if (event) event.currentTarget.classList.add('active');
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }
</script>

</body>
</html>
