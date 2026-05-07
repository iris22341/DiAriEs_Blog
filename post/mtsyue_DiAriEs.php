<?php
// --- 步驟 1：統一資料庫連線處理 ---

if (getenv("DATABASE_URL")) {
    // ☁️ 雲端環境 (Railway)
    $url = parse_url(getenv("DATABASE_URL"));
    $conn = mysqli_connect($url["host"], $url["user"], $url["pass"], substr($url["path"], 1), $url["port"]);
} else {
    // 💻 本地端環境 (Localhost)
    $conn = mysqli_connect("localhost", "root", "", "diaries");
}

// 檢查連線是否成功
if (!$conn) {
    die("連線失敗：" . mysqli_connect_error());
}

// 確保中文字體正確 (重要！)
mysqli_set_charset($conn, "utf8mb4"); 
?>

<!DOCTYPE html>
<html>
<head>
    <title>雪山東峰單攻 - DiAriEs </title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../style.css">
</head>
<body>



<!-- --- 第二部分：原本的文章與表單 HTML --- -->
<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>雪山東峰單攻紀錄 - 👧DiAriEs</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <header class="nav-bar">
        <a href="../index.html"><span>←</span> 返回 DiAriEs</a>
    </header>

    <article class="content-container">
        <img src="https://lh3.googleusercontent.com/pw/AP1GczPD2QIGGuE8Pg7EEXTUXcd9iIhyCEq0Q_vvbDA93LBQkC5WuxZkGusBKy2RBmybSLwjc4_fAvgjvM-thyXe04JqKD9BoKiUDhGqxkni6YHlBamZGHKE=w1200-h1000-p-k" alt="雪山東峰" class="hero-img">

        <h1>雪山東峰單攻｜百岳新手入門首選 展望+百岳一次收</h1>
        <div class="post-meta">
            我的第 39 座百岳 | 📅 日期：2025/11/23 | ⛰️ 難度：易⭐ | 👤 作者：ㄚ純
        </div>

        <div class="gear-box">
            <h3>目錄 Table of Contents</h3>
            <ul class="toc-list">
                <li><a href="#intro">一、雪山東峰簡介</a></li>
                <li><a href="#plan">二、行程規劃建議</a></li> 
                <li><a href="#actual-trip">三、實際行程紀錄</a></li>
            </ul>
        </div>

        <section class="trip-section">
            <h3 id="intro">一、 雪山東峰簡介</h3>
            <p>雪山東峰海拔 3,201 公尺，位於台中市和平區，為台灣百岳排名第 74。從大水池登山口起登路徑清晰，是許多百岳新手的首選。</p>

            <h3 id="plan">二、 行程規劃建議</h3>
            <p>路線走法多元，志在東峰可選擇單攻，體力好的山友可以考慮一起撿主峰。</p>
            
            <h4 style="color: var(--primary-color);">🟢 雪山東峰新手友善</h4>
            <ul>
                <li>來回約 10k，建議抓 6-7 小時（含休息）。優點：可輕裝出發。</li>
            </ul>

            <h4 style="color: var(--primary-color);">🟡 雪主東進階挑戰</h4>
            <ul>
                <li>來回約 22k，建議抓 15小時（含休息）。凌晨 02:00 起登，12:00 前如果尚未過圈谷，建議撤退，以免摸黑。優點：一次撿完兩座，CP值高。</li>
            </ul>

            <h3 id="actual-trip">三、 實際行程紀錄</h3>
            <p>這次出團動機是上課剛好跟組員們聊到好久沒上山，聽著大家分享近一次的爬山經驗，腳突然癢了起來，便約定等課程結束要一起爬山！也找了之前一起爬塔曼山的朋朋，就這樣成團！</p>

            <h4>01. 行前準備</h4>
            <p><strong>(1) 裝備清單</strong></p>
            <div class="trip-table-wrapper">
                <table class="trip-table">
                    <thead class="column-header">
                        <tr>
                            <th style="width: 33.3%;">必備物品</th>
                            <th style="width: 33.3%;">衣物類</th>
                            <th style="width: 33.3%;">裝備類</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="padding: 15px; line-height: 2; vertical-align: top; font-weight: normal;">
                                身分證/健保卡<br>入山證/入園證<br>丹木斯/紅景天<br>離線地圖 GPX
                            </td>
                            <td style="padding: 15px; line-height: 2; vertical-align: top;">
                                短袖排汗T<br>GORE-TEX 外套<br>羽絨外套<br>Leggings<br>毛帽<br>圓盤帽<br>羊毛襪<br>圍脖
                            </td>
                            <td style="padding: 15px; line-height: 2; vertical-align: top; font-weight: normal;">
                                隨身小包<br>19L MR攻頂包<br>GORE-TEX 登山鞋<br>登山杖<br>雨衣褲<br>頭燈/備用電池<br>行充<br>衛生紙<br>濕紙巾<br>小塑膠袋<br>護唇膏<br>醫藥包<br>主餐<br>1000ml水+500ml熱水<br>行動糧
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <p>一些小建議：</p>
                <ul class="suggestion-list">
                    <li>如果沒有百岳經驗，行前可先吃預防高山症的藥，行前8小時吃一顆，當天開爬前半小時再吃半顆（劑量、多久前要吃還是以藥師告知為主唷），<span style="color: red; font-weight: bold;">丹木斯</span>藥局大多可買到（南部5元/顆，北部10元/顆），有些藥師也會改開<span style="color: red; font-weight: bold;">預防肺水腫/腦水腫功效</span>的藥。</li><br>
                    <li>爬了那麼多座山，圍脖對我來說算是一個蠻好用的小物，除了圍在脖子保暖，有時高海拔冷空氣吸了會不太舒服，就會狂流鼻涕狂吸鼻子，這時圍脖就可以拿來當面罩，還可以當環保衛生紙（開玩笑的）。</li><br>
                    <li>單攻主餐我通常都直接買便利商店的御飯糰或貝果，速吃+補充碳水，追求營養均可以再帶幾顆水煮蛋、切片水果或肉乾。</li><br>
                    <li>行動糧以能放進去隨身小包的能量果膠、巧克力、鹽錠（鹽糖或梅片也行）為主，方便行走時能快速補充熱量。</li>
                </ul>
            

            <p><strong>(2) 申請項目</strong></p>
            <div class="trip-table-wrapper">
                <table class="trip-table">
                    <thead class="column-header">
                        <tr>
                            <th style="width: 40%;">項目</th>
                            <th>是否需要 / 備註</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>入園證</strong></td>
                            <td><span style="color: red; font-weight: bold;">O（雪霸國家公園）</span></td>
                        </tr>
                        <tr>
                            <td><strong>入山證</strong></td>
                            <td>X</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <h4>02. 實際過程</h4>
            <p style="background: #f1f8f1; padding: 15px; border-radius: 8px;">
                👤 <strong>成員：</strong>ㄚ純、Mark、阿巧、阿瑤，共4人<br>
                👣 <strong>距離：</strong>9.35k<br>
                ⌚ <strong>時間：</strong>7:45:00<br>
                🔝 <strong>爬升：</strong>1,027m
            </p>

            <div class="trip-table-wrapper">
                <table class="trip-table">
                    <thead>
                        <tr class="date-header">
                            <th colspan="2">11/22 Day 0</th>
                            <th colspan="2">11/23 Day 1</th>
                        </tr>
                        <tr class="column-header">
                            <th>時間</th>
                            <th>地點</th>
                            <th>時間</th>
                            <th>地點</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>13:30</td>
                            <td>北車集合</td>
                            <td>03:30</td>
                            <td>雪山登山口</td>
                        </tr>
                        <tr>
                            <td>16:00</td>
                            <td>院長牛肉麵</td>
                            <td>04:30</td>
                            <td>七卡山莊</td>
                        </tr>
                        <tr>
                            <td>18:30</td>
                            <td>環清宮</td>
                            <td>06:00</td>
                            <td>哭坡大平台</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>07:30</td>
                            <td>雪山東峰</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>11:30</td>
                            <td>雪山登山口</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <ul class="timeline-list">
                <li>
                    <p><strong>13:30 北車集合</strong>，從宜蘭開往武陵，車程預計4小。中途在院長牛肉麵吃了午晚餐，老闆很好客，看到我們多點一份燙青菜，叫我們不用多點，可以幫我們在牛肉麵裡加菜，但還是收了燙青菜的錢 XD
                    </br>吃飽喝足在附近7-11補給後就直接開往環清宮，沿途趁機打了2朵菇，身為皮克敏資深玩家，荒郊野外的菇不用搶真快樂~
                    </p>
                </li>
                
                <li>
                    <p><strong>18:30 抵達環清宮</strong>，宮內停車場位置已停滿，便停在斜坡下來左前方民宅前的小空地。明天 02:30 要起床，趕緊洗漱整理裝備，20:00 準時躺床睡覺。
                    <br>整體睡眠品質還不錯，雖然有鼾聲也聽得到隔壁間的對話，不過床位乾淨，床跟床之間有獨立簾子可拉上，棉被也有南部陽光的香味，要爬雪霸系列山頭的山友，像是志佳陽、桃山喀拉業等等，環清宮也是不錯的選擇~
                        建議先電話預訂，一晚一人500元現場付現，缺點就是到登山口大概還需要 20分鐘車程，規劃行程記得預留一點時間。
                    <br><strong>02:30 起床，完裝後便出發前往雪山登山口。</strong>
                    </p>
                    <img src="https://lh3.googleusercontent.com/pw/AP1GczP26CGcxKv0OF3LJ5vqaT7lWmVdBnj0ZyBoQw6DLC08JIhjGcdS5dle1-EPkNkN4YtwGr8Wkp08PEqEM5pb_SnZ-fAxGgExV-WbvUEYsasfrpIPvL31=w1200-h1000-p-k" alt="環清宮環境1" class="no-hover">
                    <img src="https://lh3.googleusercontent.com/pw/AP1GczOYlvjA5vMkMGVtQR203PeVJi_opO3d71e7d6f2B2j5wiMTlPf-5-XHAIlnD1xq9wzaEFX8B4bbil0SFDCTxxozXZMKRIL0HMDnlG5jCqAn5I4B_N3X=w1200-h1000-p-k" alt="環清宮環境2" class="no-hover">
                    <figure> 
                        <img src="https://lh3.googleusercontent.com/pw/AP1GczN2w4vdpfCfxYiKLzZyBWCPLZq6GlCA-1Ep3zgXXCx9fpANdd2ymAOfJ6w34mjjuzsuR858qAqJupzWHWc8K4iv40-e0bNam2QBADtUTea-Jn8h96vt=w1200-h1000-p-k" alt="環清宮環境3" class="no-hover">
                        <figcaption>▲ 環清宮前庭有一塊地可停車，一樓有盥洗室，有提供洗髮精、沐浴乳及吹風機。<br>二樓大概有6間房，一間房可住大約25人，為上下舖，每張床有獨立簾子可拉上。</figcaption>
                    </figure>
                </li>

                <li>
                    <p><strong>03:30 抵達停車場</strong>，沿途有看到兩個停車場，不過爬文說有三個，我們停在第一停車場，很幸運還有空位，這是離雪山登山服務站最近的地方，走一小段木棧階梯便來到服務站，大家可能還沒睡醒，3個女孩都沒發現上到男廁，下山才發現走錯棚，溫馨提醒女廁在轉角轉過去那側喔。
                    </br>儀錶板顯示雪山東峰目前3.9度，投遞入園證意外瞥見一旁販售冰淇淋的標誌，但商店還沒開，心凍心動同時，只能等下山再吃惹。
                    </p>
                <figure> 
                    <img src="https://lh3.googleusercontent.com/pw/AP1GczO1klvssXEpd_MjpRG9qBYeVGkGe990vJTRj8i6S0SpAurFCFOchIMBf9Ok8GeREq-bIVjLvFR9saiOZFgT7cyOXdvF7WyvOKrRVRrwfCU2nAPwvcxY=w1200-h1000-p-k" alt="雪山服務站1">
                    <img src="https://lh3.googleusercontent.com/pw/AP1GczP9uBPmbcDyc_hOHzLGqynXpuFnahtpouWRV98RDtgHegPTW6N8UcELIUTL2tr2Vg8BffQo3FKTSBKHZt475xLzEtk1oSSQcW5R44ilcSxceAkN-7Js=w1200-h1000-p-k" alt="雪山服務站2">
                    <figcaption>▲ 天未亮的服務站。</figcaption>
                </figure>
                </li>

                <li>
                    <p><strong>03:50 起登</strong>，沿途標示清楚，都是緩升路況也算好走，跟著標示走基本上不會迷路。
                    </p>
                    <p><strong>04:30 抵達七卡山莊</strong>，星空超美，不過山屋的鼾聲提醒我們得降低音量，小休一下拍個照，便繼續前行。
                    </p>
                <figure> 
                    <img src="https://lh3.googleusercontent.com/pw/AP1GczPdKmwRyEajtQAR0WgiWFp8Eoh0ckE2DaWKCyqydJbQHaFtgnHlXXzLPSsVI6Q-MEHoCxU6ChCDhVghxYnAKpC-b0HEm6CT23_tUU_Q7aNwYxepY88V=w600-h1000-p-k" alt="七卡山莊星空">
                    <figcaption>▲ 在七卡小休一下，一抬頭滿天星星，佐山友的帳篷拍起來很有fu~</figcaption>
                </figure>
                </li>

                <li>
                    <p><strong>05:47 </strong>來到一個展望極佳的路段欣賞雲海及天色漸亮的天空。
                    </p>
                    <p><strong>06:00 抵達哭坡前大平台</strong>，為了等日出，冷到瑟瑟發抖，只能尋覓微弱的陽光，讓身子暖和一點。拍照玩樂的同時，等到紅澄澄的蛋黃冒出來了！這一刻大家似乎默默有了一個共識：日出看到了，到東峰就好 XD
                        在平台遇到一位爬了N遍的大哥，大哥這趟準備撿主東，聽到我們只撿東峰，便開始勸說以我們的腳程撿完主峰再下山綽綽有餘，叫我們跟著他爬，我們很感謝大哥的邀約，只是這一趟我們只想好好享受美景，沒有想讓自己太累哈哈哈。
                    </p>
                    <img src="https://lh3.googleusercontent.com/pw/AP1GczPuoxDcm_ZBszNZrQcc7-5I18LzgYQdVDxNkyM2hktlCQ4j1LScpYMgQpvZKzyrrbta6uy9e9RgDyFOXoPBkMnA0mrVPrr2iSJZ1MhLz3RbH9Jo0P2j=w1200-h1000-p-k" alt="雪山景1">
                    <figure>
                    <img src="https://lh3.googleusercontent.com/pw/AP1GczMjJ_Y7aJ40YYZu74vN2C4ryosJeQWRczHpmOCcf1AjyMUbS8wK7P5bW4-o5y_kSAxWOsUnFBDBZZlYmoPznR_TWspdMmRr-Fa8tvgPkPV0ddUFyXob=w1200-h1000-p-k" alt="雪山景2">
                    <figcaption>▲ 日出佐尖哥，此趟已滿足。</figcaption>
                    </figure>
                </li>

                <li>
                    <p><strong>06:30 離開大平台</strong>，沿途的展望讓人心情愉悅，07:00 經過哭坡的牌子，很意外的是長在地上 XD
                    </p>
                    <img src="https://lh3.googleusercontent.com/pw/AP1GczMo5IsPlT9p_YtDpQbAIKD1WAXOuf2ihrAQZ0iv6tOhC8DEGd3pkAZWO2iZBeV7aaPsI__ztfmRKQT46clpP2yLqvWtNqTLFbG_9um1VkK-erMfpTZp=w1200-h1000-p-k" alt="雪山景3">
                    <figure>
                    <img src="https://lh3.googleusercontent.com/pw/AP1GczNM9DAWkdc7QRjUcLMsxFqGwEq6DoOnSGY0XD3i6yeD6EB3eQb37d9v3QD8g2vMsFdxpa1xHxM3hlEBzUL1_aJJ8-uo_q7mKyZU0KtH4slzDUU3pltU=w1200-h1000-p-k" alt="雪山景4">
                    <figcaption>▲ 長在地上的哭坡牌牌，過牌子後往左邊看是一整片山巒。</figcaption>
                    </figure>
                </li>
                    
                <li>
                    <p><strong>07:35 抵達雪山東峰！</strong>在三角點遇到一位獨攀勇者，無袖+短褲也是要撿主東的山友，山友很專業的指導我們哪些角度拍起來很讚，就這樣在山頂玩了半個小時，身體又冷到瑟瑟發抖。
                    雪山東峰的展望極佳，面對三角點的牌子，由右到左環繞一圈，雪主、雪北、武陵四秀、南胡群峰盡收眼底。回程經過主峰叉路口路牌，雪山主峰、北稜線一覽無遺。
                </p>
                    <figure>
                    <img src="https://lh3.googleusercontent.com/pw/AP1GczO_pffJEsIdXLqJJOZnH9iEwAMXOZs92_mBPsC5SGm6eE2doyZhfLFDJzsyJGrIfXyNbAQsnkZZAwNUt-SyrXvSPqBwhobG17Fb0L_n3Uw1ZjRk020w=w1200-h1000-p-k" alt="雪山東峰山頂">
                    <figcaption>▲ 登頂合照一定要的吧！勇者指揮下拍了有100張，用這張代表就好。</figcaption>
                    </figure>
                        <img src="https://lh3.googleusercontent.com/pw/AP1GczNkLoMlh-l-75J7HTzb30PJZXeGAp8ymG0iBvzjLo0rzWl4zHO8qtg-YniDTPaVhWuyGaDKkm698gi9ORiNg47x2yWoetW2fQmZnAPtvkliC3f4NTnh=w1200-h1000-p-k" alt="雪山景5">
                </li>
                    
                <li>
                    <p><strong>10:00 回到七卡山莊</strong>，進去裡面晃了一圈，只剩下幾個床位還有山友的裝備，在山莊小休補給曬個日光浴，遍繼續往登山口前進。
                    </p>
                    <img src="https://lh3.googleusercontent.com/pw/AP1GczOEsKxiQ2Dq9eppWlSCbs5k6MdxGY1p3fxb5afCJ6PQ_qewR2trRVylKk6YL-HnvPSOEeVEpzwig3nLeQw2OV4HALfnjd5ruQBolcLCZnGz3b3HqDRi=w1200-h1000-p-k" alt="七卡山莊">
                </li>
                
                <li>
                    <p><strong>11:00 抵達服務站</strong>，有別凌晨起登的冷清，大家都把握好天氣出門踏青，黑水池、服務站商店已充滿人潮，我們也不忘初衷，跑去買了冰淇淋，下山後來一口身心舒暢，用冰淇淋結束這回合！
                    </p>
                    <figure>
                    <img src="https://lh3.googleusercontent.com/pw/AP1GczN8BQkSxS5DhBS3Tm_eQTP14M3hVXn-sLbq5AyJpFoPp-IebMjBSRFR0ygSW7QKPTBiqmfzfbtttwsx9Hw8w99oR2KPUQdzX6pU-aW_kcruWHzMXwDi=w600-h1000-p-k" alt="雪山服務站">
                    <figcaption>▲ 冰淇淋一個60元，買了草莓、紅心芭樂、桂花烏龍口味，<br>個人最愛桂花烏龍，茶味很濃，不輸台北的阿洋。</figcaption>
                    </figure>
                </li>
            </ul>

        </section>
    </article>


    <!-- <div class="content-container" style="margin-top: 10px;">
        <h3 style="color: var(--primary-color); border-bottom: 2px solid #eee; padding-bottom: 10px;">
            💬 留言區
        </h3>
        
        <script src="https://giscus.app/client.js"
                data-repo="iris22341/DiAriEs"
                data-repo-id="R_kgDORwJ7pQ"
                data-category="Announcements" 
                data-category-id="DIC_kwDORwJ7pc4C7U-4"
                data-mapping="pathname"
                data-strict="0"
                data-reactions-enabled="1"
                data-emit-metadata="0"
                data-input-position="bottom"
                data-theme="light"
                data-lang="zh-TW"
                crossorigin="anonymous"
                async>
        </script>
    </div> -->


</body>
</html>

<div class="container">
        <h2>留言板</h2>
        <form method="POST" action="">
            <label>暱稱：</label>
            <input type="text" name="name" required>
            <label>留言內容：</label>
            <textarea name="content" rows="4" required></textarea>
            <input type="submit" name="submit_button" value="送出留言">
        </form>

        <div class="comment-list">
            <h3>看看大家怎麼說</h3>
            <?php
            // --- 步驟 2：讀取留言 ---
            $sql_select = "SELECT * FROM guestbook ORDER BY id DESC"; 
            $result = mysqli_query($conn, $sql_select);

            if ($result && mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<div class='comment-item'>";
                    echo "  <div class='comment-info'>";
                    echo "    <span class='comment-name'>" . htmlspecialchars($row['name']) . "</span> ";
                    // 這裡根據你資料庫的實際時間欄位名稱調整，若不確定可先用 $row['id'] 測試
                    $time_display = isset($row['created_date']) ? $row['created_date'] : (isset($row['created_date']) ? $row['created_date'] : "時間不詳");
                    echo "    於 " . $time_display . " 留言：";
                    echo "  </div>";
                    echo "  <div class='comment-text'>" . nl2br(htmlspecialchars($row['content'])) . "</div>";
                    echo "</div>";
                }
            } else {
                echo "<p>目前還沒有留言，快來當第一個吧！</p>";
                if (!$result) echo "錯誤原因：" . mysqli_error($conn);
            }
            mysqli_close($conn);
            ?>
        </div>
    </div>

	    <footer>
            <p>© 2026 DiAriEs' Blog | Capturing every moment of dopamine.</p>
            <div class="ig-link-container">
                <a href="https://www.instagram.com/agirlwholovesexercise?utm_source=blog&utm_medium=footer&utm_campaign=trip1_xueshan" target="_blank" class="ig-link-wrapper">
                    <img src="https://lh3.googleusercontent.com/pw/AP1GczPmOjN3BxndCtx_6bwZ1Q6EESKQ4tesXBBEUNjHnby4eU6z_SQYLVOqOtHhRVCOJbda40wzWgHfuqyVNrzyd789_xtk4-_KzXhzQjoukWjGDOFpLMtS=w30-h30-p-k" alt="Instagram Icon" class="ig-icon">
                    <span class="ig-link">Follow me on Instagram</span>
                </a>
            </div>
        </footer>

</body>
</html>
