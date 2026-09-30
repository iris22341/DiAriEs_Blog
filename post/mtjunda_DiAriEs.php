<?php
// 1. 取得 Railway 連線字串
$db_url = getenv("DATABASE_URL");
if ($db_url) {
    $url = parse_url($db_url);
    $conn = mysqli_connect($url["host"], $url["user"], $url["pass"], substr($url["path"], 1), $url["port"]);
    mysqli_query($conn, "SET time_zone = '+08:00'");
    mysqli_set_charset($conn, "utf8mb4");
}

// 2. 處理表單送出
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_button'])) {
    // 【修正點 1】定義當前台灣時間，否則 SQL 會抓不到資料
    date_default_timezone_set('Asia/Taipei');
    $current_time = date("Y-m-d H:i:s");

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $content = mysqli_real_escape_string($conn, $_POST['content']);

    // 寫入總表 guestbook，並標記為 crufunorth
    $sql_insert = "INSERT INTO `guestbook` (post_id, name, content, created_at) VALUES ('mtjunda', '$name', '$content', '$current_time')";

    if (mysqli_query($conn, $sql_insert)) {
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    } else {
        echo "寫入失敗：" . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>郡大山單攻紀錄 - 👧DiAriEs</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>

    <header class="nav-bar">
        <a href="../index.php"><span>←</span> 返回 DiAriEs</a>
    </header>

    <article class="content-container">
        <img src="https://lh3.googleusercontent.com/pw/AP1GczMkPl6cNdp77GtmxAWePL5jQmehJiL6MwClr1qcJpBP4rqW2O6Gkp_V-RYpNms-e7szsKRH24sKYCffnCvZsY0Jvgkt-p5hLE77BtflHOUtrDz8p-sQ=w1200-h1000-p-k" alt="郡大山個人照" class="hero-img">

        <h1>郡大單攻｜林道開放啦 坐碰碰車逛高山菜市場！？</h1>
        <div class="post-meta">
            我的第 40 座百岳 | 📅 日期：2026/09/27 | ⛰️ 難度：易⭐ | 👤 作者：ㄚ純
        </div>

        <div class="gear-box">
            <h3>目錄 Table of Contents</h3>
            <ul class="toc-list">
                <li><a href="#intro">一、郡大山簡介</a></li>
                <li><a href="#plan">二、行程規劃建議</a></li> 
                <li><a href="#actual-trip">三、實際行程紀錄</a></li>
            </ul>
        </div>

        <section class="trip-section">
            <h3 id="intro">一、 郡大山簡介</h3>
            <p>郡大山海拔 3,277 公尺，得名自布農族的郡大社，位於南投縣信義鄉，玉山國家公園北側，屬於南三段，為台灣百岳排名第 56。
            </p>

            <h3 id="plan">二、 行程規劃建議</h3>
            <p>主要有兩種走法，在林道尚未開放前只能選擇第二種(陡抖抖走法)。</p>
            
            <h4 style="color: var(--primary-color);">🟢 望鄉上新手友善</h4>
            <ul>
                <li>從望鄉工作站進入郡大林道，從林道 32K 處登山口上，來回約 7.2k，爬升約 700m，建議抓 6-7 小時（含休息）。優點：可一天來回、輕裝出發。</li>
            </ul>

            <h4 style="color: var(--primary-color);">🟡 東埔上進階挑戰</h4>
            <ul>
                <li>從東埔上郡大，下開高巷走一個 O 型，來回約 17K，海拔落差約 2,200m，建議安排三天兩夜。優點：無。</li>
            </ul>

            <h3 id="actual-trip">三、 實際行程紀錄</h3>
            <p>中秋有 4 天連假，首選的玉山後四峰因為沒抽到圓峰作罷，其次的無明甘藷，連假前幾周的大雨把橋沖斷也爬不了，只好鬼轉郡大。<br>
            郡大林道已關閉一年多，於 2026/7/31 重新開放，一直是我們的 Plan B，怕又關起來想說趕快出團，這次除固定班底，剛好有同事也想爬山，加上重訓女神及邱軒，評估天氣及體能狀況後，就這樣成團！</p>

            <h4>01. 行前準備</h4>
            <p><strong>(1) 裝備清單</strong></p>
            <div class="trip-table-wrapper">
                <table class="trip-table table-fit">
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
                                身分證/健保卡<br>入山證/入園證<br>丹木斯/紅景天/暈車藥<br>離線地圖 GPX
                            </td>
                            <td style="padding: 15px; line-height: 2; vertical-align: top;">
                                短袖排汗T<br>GORE-TEX 外套<br>羽絨外套<br>Leggings<br>圓盤帽<br>羊毛襪
                            </td>
                            <td style="padding: 15px; line-height: 2; vertical-align: top; font-weight: normal;">
                                隨身小包<br>19L MR攻頂包<br>GORE-TEX 登山鞋<br>登山杖<br>雨衣褲<br>頭燈/備用電池<br>行充<br>衛生紙<br>濕紙巾<br>小塑膠袋<br>護唇膏<br>防曬<br>醫藥包<br>主餐<br>1850ml水<br>行動糧
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <p>一些小建議：</p>
                <ul class="suggestion-list">
                    <li>臨時成團不能爬黑山喔！須於入山前三天完成線上申請，超過期限，可找附近的派出所登記，準備好身分證正反面影本，至派出所填寫資料即可。</li><br>
                    <li>如果沒有百岳經驗，行前記得先吃個預防高山症的藥或是威而鋼。</li><br>
                    <li>謠傳郡大最困難是林道碰碰車，坐車前半小時可先吃個暈車藥。</li><br>
                    <li>郡大林道建議還是找專業接駁，路窄不好會車、路面顛簸也怕傷到車子底盤，還是花錢交給得利卡比較安心。</li>
                </ul>
            

            <p><strong>(2) 申請項目</strong></p>
            <div class="trip-table-wrapper">
                <table class="trip-table table-fit">
                    <thead class="column-header">
                        <tr>
                            <th style="width: 40%;">項目</th>
                            <th>是否需要 / 備註</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>入園證</strong></td>
                            <td>X</td>
                        </tr>
                        <tr>
                            <td><strong>入山證</strong></td>
                            <td><span style="color: red; font-weight: bold;">O</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <h4>02. 實際過程</h4>
            <p style="background: #f1f8f1; padding: 15px; border-radius: 8px;">
                👤 <strong>成員：</strong>ㄚ純、阿鳥、Ben哥、憶璇、邱軒、ASH，共 6人<br>
                👣 <strong>距離：</strong>7.2k<br>
                ⌚ <strong>時間：</strong>5:17:50(不含三角點拍照、休息)<br>
                🔝 <strong>爬升：</strong>690m
            </p>

            <div class="trip-table-wrapper">
                <table class="trip-table table-fit">
                    <thead>
                        <tr class="date-header">
                            <th colspan="2">9/26 Day 0</th>
                            <th colspan="2">9/27 Day 1</th>
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
                            <td>20:00</td>
                            <td>邱軒、Ben哥發車</td>
                            <td>06:00</td>
                            <td>起床</td>
                        </tr>
                        <tr>
                            <td>23:30</td>
                            <td>豐丘派出所兩車會合</td>
                            <td>06:30</td>
                            <td>郡大檢查哨換得利卡接駁</td>
                        </tr>
                        <tr>
                            <td>00:00</td>
                            <td>7-11 信義鄉門市前車宿</td>
                            <td>08:00</td>
                            <td>郡大林道某處上廁所</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>09:00</td>
                            <td>郡大林道 32K 登山口</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>09:30</td>
                            <td>望鄉山三角點 </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10:30</td>
                            <td>岩石拍照點 </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>11:50</td>
                            <td>郡大山三角點 </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>14:45</td>
                            <td>郡大林道 32K 登山口 </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>16:45</td>
                            <td>郡大檢查哨換回車車</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>18:30</td>
                            <td>名間吃晚餐</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>19:40</td>
                            <td>兩車解散回家</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <ul class="timeline-list">
                <li>
                    <p><strong>23:30 豐丘派出所兩車會合</strong>。這次分成兩車，一車是丘軒從台南發車，沿途載客；一車是 Ben哥從台中發車，6個人相約派出所見面。由於是確認颱風不會來攪局才決定出團，當時已來不及線上申請，便直接拿著身分證影本去最近的派出所辦理入山，好險是 24小時營業，不至於讓行程太趕。
                    </br>辦完入山，找了 7-11 停車場作為車宿地點，Ben哥已在後車廂鋪好床，看著舒適的床只能忍痛讓丘軒睡 XD 其他四個女森睡丘軒車上，駕駛座、副駕躺平睡兩人、後座一人平躺、後車箱睡一人，車窗網讓車內不至於太悶，意外地進入深層睡眠。06:00 被陽光+山友對話聲吵醒，一打開後車廂只見人潮聚集在便利商店門口，廁所也已大排長龍，快速整裝、吃完早餐及暈車藥後(謝謝ASH的抖內)，準備前往車程 7 分鐘的檢查哨換接駁！
                    </p>
                    <figure>
                    <img src="https://lh3.googleusercontent.com/pw/AP1GczMuYkjfK9_lV1eMRXx-ve-7LvGDMqFrtg8UUev2jpgf6sr3RIBTf1vd9zew_BnhdOTVirL-ClGk3L4sTo21wEcyCw2Xog5KmXip6AoIMVPSoXbM-lGv=w600-h315-p-k" alt="幸運貓貓" class="no-hover">
                        <figcaption>▲ 員警人很好，借我們上廁所，還很幸運地遇見喵所長。</figcaption>
                    </figure>
                    <figure>
                    <img src="https://lh3.googleusercontent.com/pw/AP1GczPWDoRN6fAOvKWsQLEXx3UeGXc48W_Gdh1_IU3_44y9jQ2d2Y9H7bjCI-muvF8pI55Xo_JsaWuGQMwaqCZwHJzSC6noIGl37wiwviUCV29w4COiEXtB=w600-h315-p-k" alt="車宿環境1" class="no-hover">
                        <figcaption>▲ Ben哥的高級車宿。</figcaption>
                    </figure>
                </li>
                
                <li>
                    <p><strong>06:30 郡大檢查哨換得利卡接駁</strong>，這次是預訂檢查哨附近的專業接駁，附近約有 4 個車位可供一般轎車停放，往鐵皮屋後方開可迴轉停挖土機旁，要注意邊坡是否會有碎石掉落，好險有好心大哥提醒，Ben歌的車車才不至於承受這個風險。
                    <br>接著要開始本趟最困難的部分 - 碰碰車，從郡大林道起點 0km 出發，到廁所前半段多為柏油路，還算平緩，也有可能是一上車就睡著，所以沒什麼特別感覺。一個半小時後來到上廁所的地方，這邊管理員會逐車詢問人數、登記車牌，司機大哥統一回覆完就放我們下車活動，這裡的廁所是可以丟垃圾、沖水跟洗手的文明廁所，上完廁所被眼前的大景震懾住，太久沒上山一整個很興奮，趕緊拿起手機紀錄這一刻。
                    <br>接下來還有一小時的車程才會到郡大林道 32k 登山口處，後面的林道路面沒那麼寬，不易會車，也比較原始，需要高底盤才不易刁車，我們就看到一台福斯卡住，司機們用對講機開玩笑說讓它玩一下，要繳學費才要去救它 XD 看到這個畫面，就覺得我們選對接駁了，司機開車技術也 100分，只是坐最後排的 ASH 頭還是撞到不少次，不過整體算很舒適，至少比閂山鈴鳴的體感舒服很多。</p>
                    <figure> 
                        <img src="https://lh3.googleusercontent.com/pw/AP1GczMMWZw3xcU102-7cDWY1zi9ZuOwXfJ_g2GM4CGt87icccL0jB0W8Db2CyYzWmvNUMt5DeD8v8cPWxBvb23HPnv2T7KwcWgjHSC69-wOmqB5gGQy02Av=w600-h800-p-k" alt="接駁資訊" class="no-hover">
                        <img src="https://lh3.googleusercontent.com/pw/AP1GczPwRJvLzRtV6tvUqrnbfWIZj-7D8z7kn0pz0ELtKg8SpzrNEx-Fw4YQoxdpAMIIzFVR0A_1fRbeuvUW4TecMGWkrGTrbmH0unvWTkmKCm3m5Z9DUMlu=w600-h315-p-k" alt="接駁車車" class="no-hover">
                        <figcaption>▲ 專業接駁推推楊培恩大哥。</figcaption>
                    </figure>
                    <figure> 
                        <img src="https://lh3.googleusercontent.com/pw/AP1GczNVjb3BhlY5pa1g7FcMyVP_1OQY6RkYYvoC7lzoTeOVcW3oAIoPMhZpr8L_sXZfciwRC417Pu_sLxbHsJX9w1bMM6QJ25OuFP3pAdSQM1IBod3PqQgw=w600-h315-p-k" alt="廁所拍拍1" class="no-hover">
                        <figcaption>▲ 天氣超級無敵霹靂好，山巒綿延的樣子清晰可見。</figcaption>
                    </figure>
                </li>

                <li>
                    <p><strong>09:00 郡大林道 32K 登山口起登！</strong>把握連假好天氣上山的山友不少，在登山口就遇到 20人左右，拍完大合照趕緊出發。到望鄉山三角點/望鄉山雨量偵測站半小時的路程都是上坡，稍做休息後，來到一個展望極佳的路段，可遠眺玉山群峰，拍照玩耍一下繼續走。
                    <br>進入樹叢小路前不小心走錯路，聽見後面登山團的大姐大喊：「你不要跟著他們走，他們走錯路了」，提醒走在前方的大哥 and 我們：）然後就開始各種閃躲樹枝、注意反作用力，有一段落差比較大需要拉繩的地形，然後就來到岩石拍照點。
                    </p>
                    <figure> 
                        <img src="https://lh3.googleusercontent.com/pw/AP1GczNA154v5BTWJ-emvlta9rWcXtG-wDXJbxpVlMv4CK9C-ENKPz4jjtLzXjGhpA4EhymE29ZortZKqO_gPRtMK2OQHzWfeYtBfoRBXm2Hfrf2naeVzjO9=w600-h315-p-k" alt="前半段上坡">
                        <img src="https://lh3.googleusercontent.com/pw/AP1GczMV5XbTgLtuHwOsNlbiC0WnVeEdPmDH2iizaZOiRVi67ZULjZfvNcVT_8MTYF4mlx8SCwBBYMCqZSmKTtHOHsanQO-DGcVyQkqXiAbl9IpXotooqn_1=w600-h315-p-k" alt="望鄉山三角點">
                        <img src="https://lh3.googleusercontent.com/pw/AP1GczPaOvpoKc69-q99kAD6-cmKisJTgDmdOmxQcSvTvmx7dfyIOXkOHuOhv6WBpqhJcSR8Ej8E0LdWyZ07pZQnqSw7RojneyvgUm7gi_WzciVptMTiqYUL=w600-h800-p-k" alt="望鄉山三角點指示牌">
                        <figcaption>▲ 前半段的上坡，到望鄉山三角點小休一下。</figcaption>
                    </figure>
                    <figure> 
                        <img src="https://lh3.googleusercontent.com/pw/AP1GczNrebSqvZjWYcdBSfdfprdF8zgFVEE_JCcIakTilA3LQU0l_3xK_GUA823dsLuuqu7mdHGltuB0GvrAYSeCv9IRbozTx-xApE0UFU0tz-qyhvePijB9=w600-h315-p-k" alt="迷路處">
                        <img src="https://lh3.googleusercontent.com/pw/AP1GczOHUJvvhLor0I67TccTR5cQUep8XCzqqNg091l_wtz5ukgy36pSmfOJ8lHp2wmdLJrtYNS_nSxvRRiydkNmeNm5gNcqbYE8Spzf3WGPm6SP3Qqis8eB=w600-h315-p-k" alt="展望極佳的點">
                        <figcaption>▲ 聊著聊著走錯路，正確是左邊的路喔~然後就來到展望極佳的路段，伴隨清晰可見的玉山。</figcaption>
                    </figure>
                </li>
                
                <li>
                    <p><strong>10:30 來到岩石拍照點</strong>，我們決定在這邊補給、小休一下，在這遇到一位獨攀飛空拍機的山友請我幫他拍照，只見他沒有半點恐懼的站到岩石上擺拍，他還問要不要幫我拍，抖抖的我拒絕了 XD 陸續有山友停在此處拍照，我們便繼續趕路。
                    再來走在稜線上，我們很古意的讓下坡的大團登山團先走，結果有些山友不知道我們在讓路，硬生生插隊往前擠，原本路就很窄不好會車，結果整個塞住動彈不得，山友火氣上來，認為下坡大團不應該這麼自私，他們下一波人也要讓上山者上一波，還聽到有山友覺得我們年輕人太老實，其實不用讓。
                    疏通後是一段緩上，再經過一個拉繩地形，不知不覺來到 3k 牌牌，還差 0.6k 就能登頂囉！
                    </p>
                    <figure> 
                        <img src="https://lh3.googleusercontent.com/pw/AP1GczNsSGkPrZnHxOQ1Avr296l68jj-a-WMgxEpeVGdeTtghTp8-a0bGoYqnaYdfUA0O3T_HBz3u5JzuSKITVV9yb3drIUfbmuA-5ur9lPNvPvnYQX1Ggtb=w600-h315-p-k" alt="岩石拍照點的健美選手">
                        <img src="https://lh3.googleusercontent.com/pw/AP1GczM0elSEykkOOgkLL72KcdpgRLrn_C07hwAfu_3YI7YWy5P3FuTJxeJI_v6q1DpCLcCviL9UOyYHVzD5D7DzG7a70_44LXOEnkcNj5zLmbx2kkQz1oY0=w600-h315-p-k" alt="走在稜線上">
                        <figcaption>▲ 幫健美選手與岩石合照後繼續前行，來到稜線，我們變得好渺小。</figcaption>
                    </figure>
                </li>

                <li>
                    <p><strong>11:50 郡大山三角點</strong>。登頂前 0.6k，遠遠就能看見排隊拍照的隊伍，走近一看才發現隊伍比想像中長，在烈日下大家略為不耐煩，有人大聲斥喝：「很多人在排隊，一人拍兩張就好」、有人趁機賣起了啤酒，一瓶 50 收，我們則是一邊排隊一邊解決午餐，還有拍拍彼此登頂的樣子。
                    大概等了 15分鐘，終於輪到我們，先個拍，拍完再到另一個人較少的牌牌拍合照，拍完便速速下山。
                    </p>
                <figure> 
                    <img src="https://lh3.googleusercontent.com/pw/AP1GczNIjAYMUpUICZZ1A7cVqU2EA97eQkegkM-w_Q_lKrruS8GC6gTgjddhHgImdx8JLDAd2WJphztDTD1DrZ2UhVqVf6oMIQ2QFUTox2e3L-mK7kS1iGXU=w600-h315-p-k" alt="排隊拍照的隊伍">
                    <img src="https://lh3.googleusercontent.com/pw/AP1GczOaV502PZAHlQxsszRZOMOSTIafswFmTgj6c5cnopGUwsR-FIne8G-E4jbgZDnmVvYsUvNuD5TpyaIsfkMH3H-vU8EJfxrDZgg5wATLJ-E9lj36rGCa=w600-h315-p-k" alt="登頂合照">
                    <figcaption>▲ 看不到排隊尾巴的隊伍，看大合照時才發現無所不在的健美選手。</figcaption>
                </figure>
                </li>

                <li>
                    <p>下山時玩最久的路段是枯木箭竹林，鞋子也被玩到開口笑，第一雙登山鞋壽終正寢。感謝邱軒用大砲紀錄大家最自然的樣子，不知不覺回到了望鄉山三角點，在這裡遇到有趣的大哥，大哥的拍照姿勢超活潑，值得只會比耶的年輕人學習 XD
                    </p>
                    <figure>
                    <img src="https://lh3.googleusercontent.com/pw/AP1GczOk7lKY7jKTvXJXGFqH4QeC9Sk3jO25eVMyaQ9INWWc554i7PIqDCTCxZIhtMvy_zqm_FAkCKaslcsFjymuXQaGy0S-xP5iKlOk20fWKIcoDJUrdns-=w600-h315-p-k" alt="枯木箭竹林玩耍">
                    <img src="https://lh3.googleusercontent.com/pw/AP1GczMgAwrfh4mTF8dMJfPY2d-ZS7ULud39HbBTVnA2901ayL0yIY0WrumZgtOQ9mMY3Qh6OqpVDhKF6t8Yc84rZdbAsBvSCz9MZQz2dp_JSMubhnSuXd9L=w600-h315-p-k" alt="望鄉山三角點">
                    <figcaption>▲ 在枯木箭竹林聊天的我們，還有不起眼的望鄉山三角點。</figcaption>
                    </figure>
                </li>

                <li>
                    <p><strong>14:45 快樂登出！ </strong>接駁準備了冰冰涼涼的飲料，乾杯慶祝順利下山，還有憶璇的初百岳成功！
                    </p>
                    <img src="https://lh3.googleusercontent.com/pw/AP1GczMsYHbZ7iBoLM52E4WWhCKscSvP3HA9IO8sSPYAg7E3rTwQ4yMN3o8LUFjMIvzH0d-vcY3tPe-4IoMS-I2fuOcgEAaMCFpinUmi1eQfNkePVsnLAswM=w600-h315-p-k" alt="成功登出合照">
                    <figure>
                    <img src="https://lh3.googleusercontent.com/pw/AP1GczM-cRPfmj2ZSCWYcs0HioUE5JfxlCFDLIJMPcvVl_RzsqxfsdcAHgp7zEYO54Ty8ckg2uhW41aaU0gA84NiuPZaz67Q6Whj69PitdJ6oQFtzOtOATqX=w600-h315-p-k" alt="可樂乾杯">
                    <figcaption>▲ 用快樂肥宅水慶祝郡大山大成功。</figcaption>
                    </figure>
                </li>

                <li>
                    <p><strong>16:45 郡大檢查哨換回車車</strong>，回程在接駁車上睡鼠，唯一清醒的時候剛好遇到一台保時捷，林道真的很小條，只有路面寬一點的地方才能會車，只見司機快速倒退，保時捷也緊貼山壁這才成功，然後就很突然的回到 0k 處。
                    </p>
                    <figure>
                    <img src="https://lh3.googleusercontent.com/pw/AP1GczPjSzCX4vYni3D_lsd_7IQ2TPiNa_jgG6hOGteNKa6Cu6zgN_IwD3Unm5Erp1v1EJ98nUVAKXVADPfG3-F33Iazu5cZs5jLhU58LGqx-RonB6_o4wPN=w600-h315-p-k" alt="0k 處">
                    <figcaption>▲ 郡大林道開放時間為每日 08：00 - 17：00，要上山的朋朋記得抓好時間。</figcaption>
                    </figure>
                </li>

                <li>
                    <p><strong>18:30 名間吃晚餐</strong>下山一定要吃個慶功宴吧！找了附近一帶有東西可吃，兩車回家也較順的區域，決定是名間了，是上週西夸路跑的地點，也太有緣了~ 原本想去光顧<a href="https://maps.app.goo.gl/UJiDjarvUg3D11ks8" target="_blank">帥哥老闆的店</a>，結果周日公休 QQ
                    決定吃<a href="https://maps.app.goo.gl/WXLnbGaxtpThQPQi9" target="_blank"> Ho家純手作鮮肉貢丸</a>，結果這家只能外帶冷凍的，經過一波三折，最後決定<a href="https://maps.app.goo.gl/aMWCqC9ovFetJqyX8" target="_blank">阿芳飯麵館</a>。大家等到快餓鼠，每次開門送菜，大家就眼巴巴地盯著菜餚，很像嗷嗷待哺的麻雀，超好笑。原本還要去買豆花，但附近豆花店要打烊，只好改買<a href="https://maps.app.goo.gl/BynaJ4apyD4b1Bq56" target="_blank"> 50嵐</a>，
                    這間也是上周西夸有來買的，名間產茶果然喝起來味道就是不一樣(心理作用占 50%)，吃飽喝足兩車各自解散，結束了充實又快樂的一天。
                    <figure>
                    <img src="https://lh3.googleusercontent.com/pw/AP1GczO58xUfcP92F1kdE3vZgSe694Mi66ko6Kiif8PjYoKHcim7yEhQMKA34aZ3aZzeWFP6MYHDu6cHx5SMenTZZqfpNhA6Gv5MeUKkIGYQHn5k5Ot7z39y=w600-h800-p-k" alt="50嵐">
                    <figcaption>▲ 用 50嵐結束這回合。</figcaption>
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
            $sql_select = "SELECT * FROM guestbook WHERE post_id = 'mtjunda' ORDER BY id DESC"; 
            $result = mysqli_query($conn, $sql_select);

            if ($result && mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<div class='comment-item'>";
                    echo "  <div class='comment-info'>";
                    echo "    <span class='comment-name'>" . htmlspecialchars($row['name']) . "</span> ";
                    // 這裡根據你資料庫的實際時間欄位名稱調整，若不確定可先用 $row['id'] 測試
                    $time_display = !empty($row['created_at']) ? $row['created_at'] : "時間不詳";
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