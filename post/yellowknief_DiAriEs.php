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
    $sql_insert = "INSERT INTO `guestbook` (post_id, name, content, created_at) VALUES ('yellowknief', '$name', '$content', '$current_time')";

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
    <title>加拿大黃刀追光之旅 - 👧DiAriEs</title>
    <link rel="stylesheet" href="../style.css">

    <style>
    /* 只處理黃刀鎮「分四類介紹」的三欄表格，不影響其他表格 */
    .place-table {
        width: 100%;
        table-layout: fixed;
    }

    .place-table th:nth-child(1),
    .place-table td:nth-child(1) {
        width: 60px !important;
        min-width: 60px;
        max-width: 60px;
        white-space: nowrap !important;
        text-align: center;
        word-break: normal !important;
        overflow-wrap: normal !important;
    }

    .place-table th:nth-child(2),
    .place-table td:nth-child(2) {
        width: 32%;
        white-space: normal !important;
        word-break: break-word;
        overflow-wrap: anywhere;
    }

    .place-table th:nth-child(3),
    .place-table td:nth-child(3) {
        width: auto;
        white-space: normal !important;
        word-break: break-word;
        overflow-wrap: anywhere;
        text-align: left;
    }

    @media (max-width: 768px) {
        .place-table th:nth-child(1),
        .place-table td:nth-child(1) {
            width: 56px !important;
            min-width: 56px;
            max-width: 56px;
            padding-left: 6px !important;
            padding-right: 6px !important;
        }

        .place-table th:nth-child(2),
        .place-table td:nth-child(2) {
            width: 34%;
        }
    }
    </style>
</head>
<body>


    <header class="nav-bar">
        <a href="../index.php"><span>←</span> 返回 DiAriEs</a>
    </header>

    <article class="content-container">
        <img src="https://lh3.googleusercontent.com/pw/AP1GczOvpv919s4-5Vdgq2kEcUs-PNuD811W23l6KMwDm3c3pxtqum05wrzl8RCKvYdUdmMnCQED74nzJktiuxvpdeidMy7oduY-1xUd4PiY-xz7nCjjaJd2=w1200-h800-p-k" alt="極光&昀的合照" class="hero-img">

        <h1>✨加拿大黃刀解鎖極光夢｜10 萬元、7 天假 暢玩追光成功機率最高的小鎮</h1>
        <div class="post-meta">
            📅 日期：2025/2/22-3/3 | 👤 作者：ㄚ純
        </div>

        <div class="gear-box">
            <h3>目錄 Table of Contents</h3>
            <ul class="toc-list">
                <li><a href="#intro">一、追光大小事</a></li>
                <li><a href="#inform">二、黃刀追光規劃建議</a></li>
                <li><a href="#actual-trip">三、實際行程紀錄</a></li> 
            </ul>
        </div>


        <section class="trip-section">
            <h3 id="intro">一、 追光大小事</h3>
            <h4>01. 極光是什麼？為什麼很稀有？</h4>
            <p>請點影片觀賞 ▼
                <br><small>（資料來源：U.S Department of War）</small></p>
            <iframe src="https://www.dvidshub.net/video/embed/160925" style="width: 100%; max-width: 800px; height: 450px;" frameborder="0" allowtransparency allowfullscreen></iframe>
                <ul>
                <li>
                    <strong>極光如何生成？</strong>太陽黑子活動時，太陽高溫表面噴發高能帶電粒子，形成太陽風。
                    地球靠近太陽一側的磁場受到太陽風擠壓，造成地磁線被壓縮得很密，遠離太陽一側的磁場則被拉出地磁線稀疏的磁層尾，
                    當太陽風帶電粒子抵達，磁場尾的磁粒線因高度扭曲而重組，帶電粒子被重組的地磁線牽引至南北兩極附近上空的大氣層裡，
                    帶電粒子進入南北極附近上空的大氣層時，與大氣層的氣體分子、原子碰撞釋放出光，便形成南/北極光，較常見的是北極光。
                </li>
                <li>
                    <strong>至於為什麼遇見極光很碰運氣？</strong> 太陽風能量要充足、噴發方向要與地球磁場方向匹，除上述環境條件滿足，人還需要在極光圈附近，多種要素缺一不可，使得極光可遇不可求。
                    根據報導，太陽黑子活動在 2024 年底到 2025 年達到頂峰，這也是我們決定 2025年出發前往追光，
                    不過能量釋放極大期並非一個短暫的點，將持續 2 到 3 年，因此想解鎖這項人生清單的朋友，現在訂機票還來得及，否則得再等上 11 年才能遇到能量極大期！
                </li>
            </ul>
            </p>
            
            <h4>02.極光的顏色？</h4>
            極光顏色取決於帶電粒子的能量強度、碰撞大氣層的高度以及碰撞分子的種類。幸運遇到大爆發是可以看到黃綠 + 藍紫 + 淡粉極光。
                <ul>
                    <li>60 - 100 公里大氣層：能量極強的帶電粒子碰撞氮分子，產生淡淡的粉色邊緣。</li>
                    <li>100 - 240 公里大氣層（最常見區域）：帶電粒子碰撞氧原子，會產生黃綠色；碰撞氮分子會產生藍紫色。</li>
                    <li>240 - 600 公里大氣層：空氣稀薄且碰撞頻率低，大氣以氧原子為主，會產生暗紅色。</li>
                </ul>
            <figure>
                <img src="https://lh3.googleusercontent.com/pw/AP1GczNzyO7Busluz9XOXS-bX8nhWOF-8-mfFDu4J5CNaKipAHjmRA6Qq2W5UMob9EgTTV8yg5RGFz5VVoSK5kTL4XCxPnEv_UgAWV0asPAQTF6vWO2evwEZ=w600-h315-p-k" alt="幸運極光" class="hero-img">
                <figcaption>▲ 這趟追光旅程最後一晚，在 Vee Lake 遇到極光爆發！
                    <br>濃豔黃綠光束與星空交界處有層淡淡的藍紫色，光束底下森林交界有層淡淡粉色。
                </figcaption>
            </figure>


            <h4>03. 追光地點選擇？</h4>
            <p>※ 圖示說明：</p>
                <ul>
                    <li>平均氣溫：🥶 最冷會到 -5°C； 🥶🥶 最冷會到 -20°C； 🥶🥶🥶 最冷會到 -40°C。</li>
                    <li> 平均航班時間：😴 16 - 25 小； 😴😴 20 - 29 小； 😴😴😴 25 - 30+ 小。</li>
                    <li> 平均機票價格（NTD）：💰 35 - 58 w； 💰💰 40 - 65 w； 💰💰💰 70 - 100 w。</li>
                </ul>
                </p>
            <div class="trip-table-wrapper">
                <table class="trip-table">
                    <thead class="column-header">
                        <tr>
                            <th style="width: 8%; border: 1px solid #ddd; padding: 10px; background-color: #f9f9f9;"></th>
                            <th style="width: 11.5%; border: 1px solid #ddd; padding: 10px; background-color: #2c3e50; color: white;">阿拉斯加費爾班 Fairbanks, Alaska</th>
                            <th style="width: 11.5%; border: 1px solid #ddd; padding: 10px; background-color: #2c3e50; color: white;">加拿大黃刀鎮 Yellowknife, Canada</th>
                            <th style="width: 11.5%; border: 1px solid #ddd; padding: 10px; background-color: #2c3e50; color: white;">冰島 Iceland</th>
                            <th style="width: 11.5%; border: 1px solid #ddd; padding: 10px; background-color: #2c3e50; color: white;">挪威特羅姆瑟 Tromsø, Norway</th>
                            <th style="width: 11.5%; border: 1px solid #ddd; padding: 10px; background-color: #2c3e50; color: white;">芬蘭拉普蘭 Lapland, Finland</th>
                            <th style="width: 11.5%; border: 1px solid #ddd; padding: 10px; background-color: #2c3e50; color: white;">瑞典阿比斯庫 Abisko, Sweden</th>
                            <th style="width: 11.5%; border: 1px solid #ddd; padding: 10px; background-color: #2c3e50; color: white;">格陵蘭 Greenland</th>
                            <th style="width: 11.5%; border: 1px solid #ddd; padding: 10px; background-color: #2c3e50; color: white;">俄羅斯斯摩爾曼斯克 Murmansk, Russia</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="text-align: center; font-weight: bold;">
                            <td style="border: 1px solid #ddd; padding: 8px; background-color: #f9f9f9;">所屬區域</td>
                            <td colspan="2" style="border: 1px solid #ddd; padding: 8px;">北美</td>
                            <td colspan="4" style="border: 1px solid #ddd; padding: 8px;">北歐</td>
                            <td colspan="2" style="border: 1px solid #ddd; padding: 8px;">其他</td>
                        </tr>
                        <tr style="text-align: center;">
                            <td style="border: 1px solid #ddd; padding: 8px; font-weight: bold; background-color: #f9f9f9;">適合季節</td>
                            <td colspan="8" style="border: 1px solid #ddd; padding: 8px; font-weight: bold;">
                                每年 9 月至次年 3 月
                            </td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid #ddd; padding: 8px; font-weight: bold; background-color: #f9f9f9;">平均氣溫</td>
                            <td style="border: 1px solid #ddd; padding: 8px;">🥶🥶🥶</td>
                            <td style="border: 1px solid #ddd; padding: 8px;">🥶🥶🥶</td>
                            <td style="border: 1px solid #ddd; padding: 8px;">🥶</td>
                            <td style="border: 1px solid #ddd; padding: 8px;">🥶</td>
                            <td style="border: 1px solid #ddd; padding: 8px;">🥶🥶</td>
                            <td style="border: 1px solid #ddd; padding: 8px;">🥶🥶</td>
                            <td style="border: 1px solid #ddd; padding: 8px;">🥶🥶</td>
                            <td style="border: 1px solid #ddd; padding: 8px;">🥶</td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid #ddd; padding: 8px; font-weight: bold; background-color: #f9f9f9;">航程時間（從台灣飛）</td>
                            <td style="border: 1px solid #ddd; padding: 8px;">😴</td>
                            <td style="border: 1px solid #ddd; padding: 8px;">😴</td>
                            <td style="border: 1px solid #ddd; padding: 8px;">😴</td>
                            <td style="border: 1px solid #ddd; padding: 8px;">😴</td>
                            <td style="border: 1px solid #ddd; padding: 8px;">😴</td>
                            <td style="border: 1px solid #ddd; padding: 8px;">😴😴</td>
                            <td style="border: 1px solid #ddd; padding: 8px;">😴😴😴</td>
                            <td style="border: 1px solid #ddd; padding: 8px;">😴😴😴</td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid #ddd; padding: 8px; font-weight: bold;">機票價格</td>
                            <td style="border: 1px solid #ddd; padding: 8px;">💰💰</td>
                            <td style="border: 1px solid #ddd; padding: 8px;">💰</td>
                            <td style="border: 1px solid #ddd; padding: 8px;">💰</td>
                            <td style="border: 1px solid #ddd; padding: 8px;">💰💰</td>
                            <td style="border: 1px solid #ddd; padding: 8px;">💰</td>
                            <td style="border: 1px solid #ddd; padding: 8px;">💰</td>
                            <td style="border: 1px solid #ddd; padding: 8px;">💰💰💰</td>
                            <td style="border: 1px solid #ddd; padding: 8px;">💰</td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid #ddd; padding: 8px; font-weight: bold;">特色</td>
                            <td style="border: 1px solid #ddd; padding: 8px;"></td>
                            <td style="border: 1px solid #ddd; padding: 8px;">看見極光機率最高，適合以目的為導向的朋友</td>
                            <td colspan="4" style="border: 1px solid #ddd; padding: 8px;">適合想自駕冒險、享受旅遊、拍景的朋友</td>
                            <td style="border: 1px solid #ddd; padding: 8px;">成本高</td>
                            <td style="border: 1px solid #ddd; padding: 8px;">需考量國際因素（政治、戰爭）</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <h4>04. 判斷追光成功機率？</h4>
            <p>判斷極光爆發程度的指標為 Kp 值，數值介於 0 到 9，越大代表看到極光大爆發的機率越高。一般看到綠色主光束 Kp 值大約落在 3，至於在 Vee Lake 拍攝的極光大概是 Kp 值 6 的時候，可以看到微微的極光舞動。
                <br>出發前可先透過極光預測網站、 App 查詢，除 NASA、美國國家海洋暨大氣管理局網站外，下面這些小工具也很方便：
                <ul>
                    <li><a href="https://www.gi.alaska.edu/AuroraForecast" target="_blank">阿拉斯加大學極光預測網站</a></li>
                    <li><a href="https://hfradio.org/aurora_globe.html" target="_blank">極光預測線上即時更新</a></li>
                    <li><a href="https://play.google.com/store/apps/details?id=com.jrustonapps.myauroraforecast&pcampaignid=web_share" target="_blank">Aurora App</a>（這趟去黃刀主要用這個）</li>
                    <li><a href="https://play.google.com/store/apps/details?id=aurora.forecast.alerts&pcampaignid=web_share" target="_blank">Aurora Forecast & Alerts App</a></li>
                </ul>

            <h3 id="inform">二、黃刀追光規劃建議</h3>
            <h4> 01. 旅行社比較 </h4>
            <div class="trip-table-wrapper">
                <table class="trip-table">
                    <thead class="column-header">
                            <th style="background-color: #2c3e50; width: 12%; border: 1px solid #ddd; padding: 12px;"> </th>
                            <th style="background-color: #2c3e50; width: 22%; border: 1px solid #ddd; padding: 23px;"><a href="https://www.auroradreamtours.com/home-ct" target="_blank" style="color: white; text-decoration: underline;">Aurora Dream</a></th>
                            <th style="background-color: #2c3e50; width: 22%; border: 1px solid #ddd; padding: 23px;"><a href="https://auroravillage.com/#auroraviewing" target="_blank" style="color: white; text-decoration: underline;">Aurora Village</a></th>
                            <th style="background-color: #2c3e50; width: 22%; border: 1px solid #ddd; padding: 27px;"><a href="https://www.xccanada.com/" target="_blank" style="color: white; text-decoration: underline;">Morning Star</a></th>
                            <th style="background-color: #2c3e50; width: 22%; border: 1px solid #ddd; padding: 15px;"><a href="https://narwal.ca/spring-and-summer/" target="_blank" style="color: white; text-decoration: underline;">Narwal</a></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="border: 1px solid #ddd; padding: 10px; font-weight: bold; background-color: #f9f9f9;">聯繫管道</td>
                            <td style="border: 1px solid #ddd; padding: 10px;">LINE<br><small>回覆速度快</td>
                            <td style="border: 1px solid #ddd; padding: 10px;">信件<br><small>回覆速度慢，寄第二封信才回，故未列入考慮</small></td>
                            <td style="border: 1px solid #ddd; padding: 10px;">IG<br><small>回覆速度快，直接加導遊 IG</td>
                            <td style="border: 1px solid #ddd; padding: 10px;">官網<br><small>主要為白天活動，未列入考慮</small></td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid #ddd; padding: 10px; font-weight: bold; background-color: #f9f9f9;">價格（五天四夜）</td>
                            <td style="border: 1px solid #ddd; padding: 10px; text-align: center;">$920 CAD/人</td>
                            <td style="border: 1px solid #ddd; padding: 10px; text-align: center;">$483 CAD/人</td>
                            <td style="border: 1px solid #ddd; padding: 10px; text-align: center;">$576 CAD/人</td>
                            <td style="border: 1px solid #ddd; padding: 10px; text-align: center;">-</td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid #ddd; padding: 10px; font-weight: bold; background-color: #f9f9f9;">其他補充</td>
                            <td style="border: 1px solid #ddd; padding: 10px;">用藍色外套辨識，客人以日、韓為主</td>
                            <td style="border: 1px solid #ddd; padding: 10px;">-</td>
                            <td style="border: 1px solid #ddd; padding: 10px;">用紅色外套辨識，客人以台灣、中國為主</td>
                            <td style="border: 1px solid #ddd; padding: 10px;">-</td>
                        </tr>
                    </tbody>
                </table>
            </div>
                考慮聯繫過程的態度、方便性以及價格，最後我們選擇<span style="color: red;"> Morning Star 星辰旅遊</span>！
            
            <h4>02. Check List</h4>
            <div class="trip-table-wrapper">
                <table class="trip-table">
                    <thead class="column-header">
                        <tr>
                            <th style="width: 15%;">項目</th>
                            <th style="width: 15%; text-align: center;">完成時間</th>
                            <th style="width: 70%; text-align: center;">備註</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="padding: 15px; line-height: 2; vertical-align: middle; font-weight: normal;">
                            機票 - 台灣到溫哥華 & 溫哥華到耶洛奈夫（來回）
                            </td>
                            <td style="padding: 15px; line-height: 2; vertical-align: middle;">
                            2024/8/27
                            </td>
                            <td style="padding: 15px; line-height: 2; vertical-align: middle; word-break: break-word; text-align: left;">
                           <br>需分兩段買，一段是台灣到溫哥華（國際線）、另一段是溫哥華到耶洛奈夫（國內線）。
                           <br>兩段都可選擇直飛或轉機，由於直飛班機時間不優（到溫哥華/耶洛奈夫為半夜），加上此次為長途航班，飛行時間約 18 小時，若有中繼站可休息也不錯，因此我們選擇先飛到香港，再從香港飛溫哥華；國內線則是中間停 Calgary。
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 15px; line-height: 2; vertical-align: middle; font-weight: normal;">
                            黃刀鎮住宿 - Nova Inn（五天四夜）
                            </td>
                            <td style="padding: 15px; line-height: 2; vertical-align: middle;">
                            2024/8/31
                            </td>
                            <td style="padding: 15px; line-height: 2; vertical-align: middle; word-break: break-word; text-align: left;">
                            我們認為比起溫哥華住宿，得優先找黃刀鎮落腳處。
                            <br>那時沒有考慮旅行社的極光＋住宿套裝組合，給旅行社處理，同樣都是三星飯店，一晚大概貴 $65 CAD /人。
                            <br>不過同團成員有人訂民宿，跟室友 Share 費用＋自煮其實更省，訂行程也可以問問旅行社是否有推薦民宿，以及是否有缺室友。
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 15px; line-height: 2; vertical-align: middle; font-weight: normal;">
                            極光行程 - Morning Star
                            </td>
                            <td style="padding: 15px; line-height: 2; vertical-align: middle;">
                            2024/9/1 ~ 2024/11/7
                            </td>
                            <td style="padding: 15px; line-height: 2; vertical-align: middle; word-break: break-word; text-align: left;">
                            先確定要參加五天四夜追極光行程，中間跟導遊討論加購項目跟禦寒衣物租借（原先跟 <a href ="https://www.instagram.com/cat56511?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" target="_blank">Tinny</a> 聯繫，不過我們去黃刀時她已離職，到當地是由 Evon 帶團），導遊超可愛還跟我們說雪地健行 Cp 值低不推 XD
                            <br>確定後先付訂金（總價 30%），可加幣或台幣轉帳，我是用即時匯率換算成台幣，但我覺得旅行社也沒有很認真算。
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 15px; line-height: 2; vertical-align: middle; font-weight: normal;">
                            排行程
                            <br>保險
                            <br>加拿大線上簽（eTA）
                            <br>換加幣
                            <br>訂機場接駁
                            </td>
                            <td style="padding: 15px; line-height: 2; vertical-align: middle;">
                            ~ 2024/12/31
                            </td>
                            <td style="padding: 15px; line-height: 2; vertical-align: middle; word-break: break-word; text-align: left;">
                                確認香港轉機這段不需申請港簽，因此只辦加拿大線上簽（eTA），申請教學可參考<a href="https://www.hellostudy.com.tw/why-hello-study/resources/documents/4883/canada-eta-full-tutorial/" target="_blank">網頁</a>。
                                <br>加幣兌換是先換到外幣帳戶，匯率約 23.2 ，再至臨櫃提領現鈔。
                                <br>接駁是房東推薦的，從台北大安區到機場共 $900 NTD。
                            </td>
                        </tr>
                         <tr>
                            <td style="padding: 15px; line-height: 2; vertical-align: middle; font-weight: normal;">整理行李
                            </td>
                            <td style="padding: 15px; line-height: 2; vertical-align: middle;">
                            ~ 2025/02/21
                            </td>
                            <td style="padding: 15px; line-height: 2; vertical-align: middle; word-break: break-word; text-align: left;">
                                發熱衣/發熱褲各 2 件、毛衣/保暖外衣 3 件、牛仔褲/外褲 3 件、內衣褲 3 套、毛帽 1 頂、圍巾 1 條、
                                輕羽絨 1 件、羊毛大衣 1 件（完全沒穿到^ ^）、長襪 2 雙、羊毛襪 2 雙、Dr.Martin 靴子、
                                盥洗用品、化妝包、真空壓縮袋，總重 14 kg，32 吋行李箱還有一半空間能裝。
                            </td>
                        </tr>             
                    </tbody>
                </table>
            </div>

            <h3 id="actual-trip">三、 實際行程紀錄</h3>
            <h4>01. 總花費</h4>
            <ul>
                <li>單純追光的話，五天四夜行程，如項目 1 - 10 加總除以 2（表格價錢為 2 人費用），共<span style="color: red;"> $83,239 </span> NTD/人。</li>
                <li>此趟總費用，追光五天四夜行程再加上餐費、紀念品、溫哥華花費等，共<span style="color: red;"> $112,590 </span>NTD/人。</li>
            </ul>
                <div class="trip-table-wrapper">
                <table class="trip-table">
                    <thead class="column-header">
                        <tr>
                            <th style="width: 15%;">編號</th>
                            <th style="width: 30%;">價錢（NTD）</th>
                            <th style="width: 55%;">項目</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="border: 1px solid #ddd; padding: 15px;">1</td>
                            <td style="border: 1px solid #ddd; padding: 15px; line-height: 2; vertical-align: middle; text-align: center;">$50,292</td>
                            <td style="border: 1px solid #ddd; padding: 15px; line-height: 2; vertical-align: middle; word-break: break-word;">機票 - 台北到溫哥華（來回）</td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid #ddd; padding: 15px;">2</td>
                            <td style="border: 1px solid #ddd; padding: 15px; line-height: 2; vertical-align: middle; text-align: center;">$42,766</td>
                            <td style="border: 1px solid #ddd; padding: 15px; line-height: 2; vertical-align: middle; word-break: break-word;">機票 - 溫哥華到耶洛奈夫（來回）</td> 
                        </tr>
                        <tr>
                            <td style="border: 1px solid #ddd; padding: 15px;">3</td>
                            <td style="border: 1px solid #ddd; padding: 15px; line-height: 2; vertical-align: middle; text-align: center;">$17,154</td>
                            <td style="border: 1px solid #ddd; padding: 15px; line-height: 2; vertical-align: middle; word-break: break-word;">黃刀鎮住宿 - Nova Inn（五天四夜）</td> 
                        </tr>
                        <tr>
                            <td style="border: 1px solid #ddd; padding: 15px;">4</td>
                            <td style="border: 1px solid #ddd; padding: 15px; line-height: 2; vertical-align: middle; text-align: center;">$25,254<br><span style="color: #ddd;">（$1,098 CAD）</span></td>
                            <td style="border: 1px solid #ddd; padding: 15px; line-height: 2; vertical-align: middle; word-break: break-word;">Morning Star 極光行程 - 五天四夜基本套裝</td> 
                        </tr>
                        <tr>
                            <td style="border: 1px solid #ddd; padding: 15px;">5</td>
                            <td style="border: 1px solid #ddd; padding: 15px; line-height: 2; vertical-align: middle; text-align: center;">$6,118<br><span style="color: #ddd;">（$266 CAD）</span></td>
                            <td style="border: 1px solid #ddd; padding: 15px; line-height: 2; vertical-align: middle; word-break: break-word;">Morning Star 極光行程 - 禦寒服租借（四晚）</td> 
                        </tr>
                        <tr>
                            <td style="border: 1px solid #ddd; padding: 15px;">6</td>
                            <td style="border: 1px solid #ddd; padding: 15px; line-height: 2; vertical-align: middle; text-align: center;">$5,244<br><span style="color: #ddd;">（$228 CAD）</span></td>
                            <td style="border: 1px solid #ddd; padding: 15px; line-height: 2; vertical-align: middle; word-break: break-word;">Morning Star 極光行程 - 雪地摩托車（2人1車）</td> 
                        </tr>
                        <tr>
                            <td style="border: 1px solid #ddd; padding: 15px;">7</td>
                            <td style="border: 1px solid #ddd; padding: 15px; line-height: 2; vertical-align: middle; text-align: center;">$5,244<br><span style="color: #ddd;">（$228 CAD）</span></td>
                            <td style="border: 1px solid #ddd; padding: 15px; line-height: 2; vertical-align: middle; word-break: break-word;">Morning Star 極光行程 - 冰上捕魚</td> 
                        </tr>
                        <tr>
                            <td style="border: 1px solid #ddd; padding: 15px;">8</td>
                            <td style="border: 1px solid #ddd; padding: 15px; line-height: 2; vertical-align: middle; text-align: center;">$5,658<br><span style="color: #ddd;">（$246 CAD）</span></td>
                            <td style="border: 1px solid #ddd; padding: 15px; line-height: 2; vertical-align: middle; word-break: break-word;">Morning Star 極光行程 - 狗拉雪橇</td> 
                        </tr>
                        <tr>
                            <td style="border: 1px solid #ddd; padding: 15px;">9</td>
                            <td style="border: 1px solid #ddd; padding: 15px; line-height: 2; vertical-align: middle; text-align: center;">$2,392<br><span style="color: #ddd;">（$104 CAD）</span></td>
                            <td style="border: 1px solid #ddd; padding: 15px; line-height: 2; vertical-align: middle; word-break: break-word;">Morning Star 極光行程 - 5% GST</td> 
                        </tr>
                        <tr>
                            <td style="border: 1px solid #ddd; padding: 15px;">10</td>
                            <td style="border: 1px solid #ddd; padding: 15px; line-height: 2; vertical-align: middle; text-align: center;">$11,600</td>
                            <td style="border: 1px solid #ddd; padding: 15px; line-height: 2; vertical-align: middle; word-break: break-word;">換$500 CAD</td> 
                        </tr>
                        <tr>
                            <td style="border: 1px solid #ddd; padding: 15px;">11</td>
                            <td style="border: 1px solid #ddd; padding: 15px; line-height: 2; vertical-align: middle; text-align: center;">$4,730</td>
                            <td style="border: 1px solid #ddd; padding: 15px; line-height: 2; vertical-align: middle; word-break: break-word;">溫哥華住宿</td> 
                        </tr>
                        <tr>
                            <td style="border: 1px solid #ddd; padding: 15px;">12</td>
                            <td style="border: 1px solid #ddd; padding: 15px; line-height: 2; vertical-align: middle; text-align: center;">$2,155</td>
                            <td style="border: 1px solid #ddd; padding: 15px; line-height: 2; vertical-align: middle; word-break: break-word;">黃刀餐費</td> 
                        </tr>
                        <tr>
                            <td style="border: 1px solid #ddd; padding: 15px;">13</td>
                            <td style="border: 1px solid #ddd; padding: 15px; line-height: 2; vertical-align: middle; text-align: center;">$9,582</td>
                            <td style="border: 1px solid #ddd; padding: 15px; line-height: 2; vertical-align: middle; word-break: break-word;">黃刀其他消費</td> 
                        </tr>
                        <tr>
                            <td style="border: 1px solid #ddd; padding: 15px;">14</td>
                            <td style="border: 1px solid #ddd; padding: 15px; line-height: 2; vertical-align: middle; text-align: center;">$12,884</td>
                            <td style="border: 1px solid #ddd; padding: 15px; line-height: 2; vertical-align: middle; word-break: break-word;">溫哥華消費</td> 
                        </tr>
                    </tbody>
                </table>
            </div>

            <h4>02. 實際行程</h4>
            <div style="background: #f1f8f1; padding: 20px; border-radius: 8px; line-height: 1.8; color: #333;">
                <div>👤 <strong>成員：</strong>丫純、昀姐姐，共 2 人</div>
                <div style="margin-bottom: 10px;">⌚ <strong>時間安排：</strong>2/22-3/3，共十天</div>
                
                <div style="padding-left: 28px; font-size: 0.95em; color: #555;">
                    2/22-2/23 中午：坐飛機 + 溫哥華晃晃 + 夜宿溫哥華機場<br>
                    2/23 下午-2/27 下午：黃刀鎮<br>
                    2/27 晚上-3/1：溫哥華<br>
                    3/2-3/3：坐飛機
                </div>
            </div>
            <p><span style="color: blue;"> ※ 藍字為旅行社行程。</span></p>
            <div class="trip-table-wrapper" style="overflow-x: auto;">
            <table class="trip-table" cellspacing="1" style="width: 100%; border-collapse: separate; text-layout: left; table-layout: fixed; min-width: 1400px; border: 1px solid #ddd;">
                <thead>
                    <tr class="date-header" style="background-color: #2c3e50; color: white;">
                        <th style="width: 10%; border: 1px solid #ddd; padding: 10px;"></th> 
                        <th style="width: 9%; border: 1px solid #ddd; padding: 10px;">02/22<br>Day 1</th>
                        <th style="width: 9%; border: 1px solid #ddd; padding: 10px;">02/23<br>Day 2</th>
                        <th style="width: 9%; border: 1px solid #ddd; padding: 10px;">02/24<br>Day 3</th>
                        <th style="width: 9%; border: 1px solid #ddd; padding: 10px;">02/25<br>Day 4</th>
                        <th style="width: 9%; border: 1px solid #ddd; padding: 10px;">02/26<br>Day 5</th>
                        <th style="width: 9%; border: 1px solid #ddd; padding: 10px;">02/27<br>Day 6</th>
                        <th style="width: 9%; border: 1px solid #ddd; padding: 10px;">02/28<br>Day 7</th>
                        <th style="width: 9%; border: 1px solid #ddd; padding: 10px;">03/01<br>Day 8</th>
                        <th style="width: 9%; border: 1px solid #ddd; padding: 10px;">03/02<br>Day 9</th>
                        <th style="width: 9%; border: 1px solid #ddd; padding: 10px;">03/03<br>Day 10</th>
                    </tr>
                    <tr class="column-header">
                        <th style="border: 1px solid #ddd; padding: 10px; background-color: #f2f2f2; font-weight: bold;">時段</th>
                        <th colspan="10" style="border: 1px solid #ddd; padding: 10px; background-color: #f2f2f2; font-weight: bold; text-align: center;">地點</th>
                    </tr>
                </thead>
            <tbody>
                <tr>
                    <td style="border: 1px solid #ddd; padding: 10px; font-weight: bold; background-color: #f9f9f9;">早上</td>
                    <td style="border: 1px solid #ddd; padding: 10px;">08:20 台灣飛<br>10:30 到香港</td>
                    <td style="border: 1px solid #ddd; padding: 10px;"><small>（原行程 05:55 溫哥華飛 08:29 到卡加利）</small><br>09:00 溫哥華飛<br>11:41 艾德蒙頓</td>
                    <td style="border: 1px solid #ddd; padding: 10px;">09:30 市議會<br>10:30 郵局<br>11:00 買明信片</td>
                    <td style="border: 1px solid #ddd; padding: 10px;">10:00 郵局<br>10:30 鑽石館<br>11:00 紀念品店</td>
                    <td style="border: 1px solid #ddd; padding: 10px;">10:00 市政廳<br>10:30 紀念品店</td>
                    <td style="border: 1px solid #ddd; padding: 10px;">10:00 博物館</td>
                    <td style="border: 1px solid #ddd; padding: 10px;">10:00 Stanley Park</td>
                    <td style="border: 1px solid #ddd; padding: 10px;"></td>
                    <td style="border: 1px solid #ddd; padding: 10px;">00:05 溫哥華飛</td>
                    <td style="border: 1px solid #ddd; padding: 10px;">06:35 到香港<br>08:00 香港飛<br>09:45 到台灣</td>
                </tr>
                    <tr>
                        <td style="border: 1px solid #ddd; padding: 10px; font-weight: bold; background-color: #f9f9f9;">中午</td>
                        <td>香港機場晃晃＋吃午餐</td>
                        <td><small>（原行程 11:15 卡加利飛 13:28 耶洛奈夫）</small><br>12:30 艾德蒙頓<br>14:30 耶洛奈夫</td>
                        <td>11:30 遊客中心<br>回飯店吃午餐</td>
                        <td>回飯店吃午餐</td>
                        <td>回飯店吃午餐<br><span style="color: blue;"> 11:20 極光團 - 一日導覽 </span></td>
                        <td>回飯店收行李</td>
                        <td>12:00 市區購物</td>
                        <td>12:00 Granville island<br>14:00 Yale town</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid #ddd; padding: 10px; font-weight: bold; background-color: #f9f9f9;">下午</td>
                        <td>15:30 香港飛<br>11:00 到溫哥華</td>
                        <td>逛超市</td>
                        <td><span style="color: blue;"> 13:30 極光團 - 雪上摩托車 </span><br>回飯店吃晚餐、寫明信片</td>
                        <td><span style="color: blue;">12:30 極光團 - 狗拉雪橇 </span><br>16:30 Bullock's Bistro 吃晚餐</td>
                        <td><span style="color: blue;">14:05 極光團 - 冰上捕魚</span><br><span style="color: blue;">15:30 極光團 - 原住民區導覽</span></td>
                        <td>14:30 黃刀飛<br>16:42 到卡加利</td>
                        <td>14:00 gass town ＋買紀念品</td>
                        <td>18:00 溫哥華 Outlet</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid #ddd; padding: 10px; font-weight: bold; background-color: #f9f9f9;">晚上</td>
                        <td>溫哥華晃晃＋睡機場</td>
                        <td><span style="color: blue;">21:25 極光團 - 飯店接駁<br>02:00 結束追光</span></td>
                        <td><span style="color: blue;">22:15 極光團 - 飯店接駁<br>02:00 結束追光</span></td>
                        <td><span style="color: blue;">21:45 極光團 - 飯店接駁<br>02:30 結束追光</span></td>
                        <td><span style="color: blue;">20:30 極光團 - 飯店接駁<br>02:30 結束追光</span></td>
                        <td>18:00 飛<br>18:41 到溫哥華<br>回飯店休息</td>
                        <td>20:00 回飯店休息</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>

            <ul class="timeline-list">
                <li>
                    <p><strong>D1 台灣 - 香港 - 溫哥華</strong><br>
                    03:50 機場接駁車已在樓下，睡眼惺忪拖著行李箱下樓，5:00 就到二航，等到 5:30 國泰航空才開放報到，前往北美的民眾不多，大概 6:00 完成報到手續，等 7:50 登機。
                    <br>這是我們第一次的長途航班，怕身體不適應加上班機時間考量，所以中途先在香港轉機，再飛溫哥華。
                    <br>08:20 從台灣出發，10:30 抵達香港，想不到這一段也有供餐（炒麵），不過離飛往溫哥華的班機還有 5 個小時，就先去香港機場的麥當勞吃午餐、 Disney 商店幫妹妹買貝爾，還很幸運的看到限定表演，意外獲得很有質感的飛機行李吊牌。
                    </p>
                        <figure>
                        <img src="https://lh3.googleusercontent.com/pw/AP1GczPFM6HHnWSBUiFIuZmRCiJqUZYdRZeCuHjBBzJi6d7maKtkdwaqrmrmw3gnx0SYjIHia8PdaHgk8DsHko8qyNgH6tIRXR2g1RJQ0rw2aF2iaOunIVxv=w600-h400-p-k" alt="玉子將軍" class="no-hover">
                            <figcaption>▲ 點了香港機場麥當勞才有的玉子將軍堡跟抹茶派。</figcaption>
                        <img src="https://lh3.googleusercontent.com/pw/AP1GczOJyzpk3nl_tnSwv-ENZsQH3VYFzwvDk3qNeljh5jP0CJNmOM4v3R2KyYHDmF-HFEd1hanpRV5OGIYYJK3Nm5sSVWPx4PetQh4AyVP18BxjNwZr8Egu=w600-h400-p-k" alt="舞者表演" class="no-hover">
                            <figcaption>▲ 限定表演，舞者還會時不時跟民眾互動，超有活力的。</figcaption>
                        <img src="https://lh3.googleusercontent.com/pw/AP1GczOqNUjMTgGSxw1OnE4Vk7siK1dfHQVap8uDBYUDE5W4gMMOwZaA3m8gnI0DR--5fYc2F5W5oYa4NLHiuuUcbc3mK8BxtDkglkmTfFzmDoGx92eknGnn=w600-h400-p-k" alt="飛機行李吊牌" class="no-hover">
                            <figcaption>▲ 看表演填問卷就可以獲得飛機行李吊牌，有金色、粉色、藍色可以選。</figcaption>
                        </figure>
                    <p>15:30 從香港出發，在飛機上斷斷續續的睡，吃了兩頓飛機餐，上了一次廁所，飛了 13 個小時終於抵達溫哥華！
                    </p>
                        <figure>
                        <img src="https://lh3.googleusercontent.com/pw/AP1GczNhSwdJ960HDGus_N6KQQUFJXofOJ2ZHEqEH6x5-OW7Ck-fNKPBMqoWnio4miELXa-uBCLBgB7ckrXzPKxOBGBaPv6kLobsPpb2uU4IZuu6HQ2-qSKs=w600-h400-p-k" alt="飛機餐1" class="no-hover">
                        <img src="https://lh3.googleusercontent.com/pw/AP1GczP9WhTZ8cLiohYuygIs2wmb0cn6HDZQP3tKRrJOsU4S6tykD9ToNSSTO1-RqM5FK3Gs8nmxiPJ0TbTmWRAUtN2I-n59r-yt4EE1bwKGK0jLP0YgG4tr=w600-h400-p-k" alt="飛機餐2" class="no-hover">
                            <figcaption>▲ 第一餐我選雞肉（另一個是梅菜蒸豬肉），第二餐選蔬菜蛋（另一個是港點）。</figcaption>
                        </figure>
                    <p>溫哥華比台灣慢 16 小時，抵達時是當地時間 2/22 11:00，第一站先去寄放行李，位於機場 2F Tim Hortons 旁，可事先準備好護照、機票及完成線上表單填寫再去寄放，營業時間是 7:00 - 22:00，我們寄放約 10 小，費用是 $14 CAD/人（$321 NTD）。
                    <br>放完行李，預計搭 SkyTrain 到溫哥華 Outlet、市區晃晃，考量在溫哥華會待 2-3 天，比起單程購買，刷 Compass Card 比較便宜，就在進站前先買了一張。
                    </p>
                        <figure>
                        <img src="https://lh3.googleusercontent.com/pw/AP1GczNPg3yGIgMahB9e29sEAa5aZ1YA5DuyKOHcG4dnvt4FeDMajq9tJLNC2XWej-10v-YL11u7mZuVmctuEFq1H1g-EqmqoqaxLJBU0rOXla0EtzLq4BEs=w600-h800-p-k" alt="買 Comapss 的機台" class="no-hover">
                        <img src="https://lh3.googleusercontent.com/pw/AP1GczNgbFrYoFJHfvzywE18zbuDTathBxgtKSRhesURRtcrYoJ-TEU2AV6OzIRhsIfN2hZ6P16BjSjlorQO44FCizdwMP8CMyL04eW8ceXa0gtxIpdtun2F=w600-h400-p-k" alt="SkyTrain地圖" class="no-hover">
                            <figcaption>▲ SkyTrain 計費方式會以跨區範圍來看基本費，看都在 Zone 1，還是有跨到 Zone 2、Zone 3，而基本費又會根據付費方式有所不同，
                                以成人來說，Compass Card 會比單趟現金/刷卡還便宜，不過購買空卡須付 $6 CAD/人，另外從機場區的三站出發也會再加收費用，Compass Card 可以直接操作機台購買。</figcaption>
                        </figure>
                    <p>我們先從 YVR Airport 站 到 Templeton 站逛 Outlet，費用是 Compass Card Zone 1 + 機場站費，很幸運一進站就有一班列車，不過開門時間比想像中短，昀姐姐來不及上車門就關了，車上的乘客看著我們被分開也是哭笑不得，
                    好險過一站就到目的地，因為回國前還會來購物，所以只快速掃了一下 The North Face、Gap 的價差。這裡又發生了一個插曲，就是我把手機忘在廁所，等我想起來回去找時手機已經不見了，
                    好險昀姐姐有想到先到服務中心問問，剛好遇到幫忙送去櫃檯的老夫妻，原本想說買個甜食感謝他們，殊不知等我們回來，老夫妻已走遠 QQ
                    <figure>
                        <img src="https://lh3.googleusercontent.com/pw/AP1GczNqCq374zHl8nm_I2hOCm9QzEw0oeLVadthLEG7lenj8SUEro3cB55r2BZTRjUjO2GyySKuKJVbOMN01n9scuM8kP96stvwBVNZT9RXu2LHOt9R0fH3=w600-h800-p-k" alt="機場 Outlet" class="no-hover">
                    </figure>
                    <p>逛完 Outlet 再來要到市區晃晃、看蒸汽鐘，得從 Templeton 站搭到 Waterfront 站，費用是 Compass Card Zone 2 + 機場站費，我們先到 Ignite Pizzeria Gastown 吃 pizza，逛了超市、紀念品店，
                    受不了空氣中瀰漫的大麻味，加上兩個人走到有點疲憊，便搭車回 YVR Airport 領行李，隨後在機場大廳找了個舒適的位置休息，等明天的班機。
                    </p>
                        <figure>
                        <img src="https://lh3.googleusercontent.com/pw/AP1GczP_mu6CO2l0e9bj5VdcW-k4alDIjOsXO6dMcZwpV53Gp4q6C2dXcZs5Zc7nSvTKZ6IjXm9Uug3wISvYwX3jroHrHylFLCA6lYMsCh_scoUglox5ZaVI=w600-h400-p-k" alt="Pizza" class="no-hover">
                            <figcaption>▲ Pizza 是薄皮的，口味選擇多，邊緣的餅皮吃起來脆脆的，蠻好吃的，推推瑪格莉特、臘腸。</figcaption>
                        <br><img src="https://lh3.googleusercontent.com/pw/AP1GczPSo1_2NOyuiypnDMeF1DUgoTZuQepuzeyPSVmFwQIc63J1g1mlletsGq58p9uR8fgaIQm6n3G4NnqN-eRhpZ-pqMP9jHbXS8I0nF8AIx0rYPQe95Ld=w600-h900-p-k" alt="蒸汽鐘" class="no-hover">
                            <figcaption>▲ 蒸汽鐘整點會有下課鐘響的音樂 XD</figcaption>
                        </figure>
                </li>
                <li>
                    <p><strong>D2 溫哥華 - 艾德蒙頓（原卡加利，航班被取消） - 耶洛奈夫</strong><br>
                    機場太難睡，大概 3:30 就往報到櫃台移動，一看發現航班被取消，很緊張的問了櫃檯，櫃台可能遇過很多次因大雪、氣候因素停飛的狀況（但我們這次是 Operation 因素），
                    很淡定在原本機票後寫了一個航班及列印出新的機票，比原先航班晚 4 小時出發，不過抵達耶洛奈夫的時間沒有差很多。航空公司有給 $15 CAD 補償費，登機前可以去美食區兌換餐點，我換了一個熱狗堡，味道還不錯。
                    </p>
                        <figure>
                        <img src="https://lh3.googleusercontent.com/pw/AP1GczMn0VHAgei4KJtdiua7g8cGv85mWOL3pg5aSqcA2VsrKlUgldlxmVlPEjcOtcTiGABWdRBFGgR7xfozTgAoBe2dVycPenZWSpL7DYfNBz9cLa_of9Kk=w600-h400-p-k" alt="手寫航班" class="no-hover">
                            <figcaption>▲ 一開始收到手寫的航班資訊，緊張了一下，想說不可能這麼陽春吧，<br>過了 20 分鐘櫃台人員才拿給我們打印出來新的機票。</figcaption>
                        <br><img src="https://lh3.googleusercontent.com/pw/AP1GczNh_gfn16COEesWCpnScZQ_a_fSoOSfkjC5UUnABMcf5LmP3n37GSSVBeiiR7Pq7F9a-x5ISuNN9XJOqDP7QphG49sP-qytLJFwgnB9vZwEvFEhVWKM=w600-h900-p-k" alt="JAPADOG" class="no-hover">
                            <figcaption>▲ $15 CAD 補償費換得 JAPADOG。</figcaption>
                        </figure>
                    <p>
                    <br>終於等到登機時間，9:00 從溫哥華出發，11:41 到艾德蒙頓，比起卡加利機場，艾德蒙頓能逛的商店比較少，想說就直接去登機門等。
                    <br>12:30 從艾德蒙頓出發，大約 14:30 抵達耶洛奈夫，耶洛奈夫是個小機場，下飛機後沒有連接大廳的陸橋，直接走在冰天雪地中，地勤人員還會很兇的斥喝不要拿手機出來，趕快走！！
                    <br>進到機場大廳可以看到聳立在領行李區的北極熊雕像，領隊 Evon 已在這等候多時，等同團的大家領完行李，便搭接駁車前往各自的飯店，Evon 沿途介紹我們位在哪、哪邊有好吃的餐廳以及購物的地點，已經開始期待接下來的旅程。
                    </p>
                        <figure>
                        <img src="https://lh3.googleusercontent.com/pw/AP1GczOGASYRgiTzqoWfb-05bUlLHx80MGurHr394CXC2x6qoFKcZJ0UvI35iFlT1TQZ2Ek3mrg08tSJyip2Ft0lPVSlsllAp8TIN_hJiMmG9SrOhz9tfhdV=w600-h400-p-k" alt="沒有陸橋" class="no-hover">
                            <figcaption>▲ 一下飛機皮膚接觸到 -20 度的空氣，直接起雞皮疙瘩。</figcaption>
                        <br><img src="https://lh3.googleusercontent.com/pw/AP1GczOUngOR91EmG5fC5H2S3Q_b9_DNCrGGQN3oXy0d0GXdCQxH-MW_DHHMrDnO14Ck7AKpbUqJqz57pTTFaTrfgTpUwBQbggwo860I3k8ahX4QueOGhiye=w600-h400-p-k" alt="北極熊" class="no-hover">
                            <figcaption>▲ 很有特色的機場。</figcaption>
                        </figure>
                </li>
                <li>
                    <p><strong>D3 - D6 黃刀鎮</strong><br>
                    先送離市中心較遠的團員至飯店，倒數第二站來到我們住的地方 Nova INN，一踏到地 Evon 就提醒我們很滑要小心走，比起滑，腳底發寒更讓我想趕快進到室內。
                    先到櫃台 Check in，除了住宿費還有先收一筆 $250 CAD 的費用，退房時飯店確認設備完好無缺後會再退還，一樓直走到底的第二間就是我們接下來要入住的地方，
                    一開門直接被熱氣暖到，只穿發熱衣也會出汗，特別的是房間內有微波爐可以使用，因此強烈建議正餐可以到超市採買回來加熱，不然三餐都外食費用會很驚人。
                    </p>
                        <figure>
                        <img src="https://lh3.googleusercontent.com/pw/AP1GczPWI9k_U_RPg4pHPaLZ7D_ZbX0c-aAt7K2TYMnOYkSTPCXg1RKKYuokl59XjRscNDtN0_Lbzk6qTrRcXIMaHGacenWzgyGMKIkXD63fWeZZj1dU2seR=w600-h400-p-k" alt="Room tour" class="no-hover">
                            <figcaption>▲ Nova INN 房間空間蠻大的，兩個行李箱平放走道還有空間可以行走。</figcaption>
                        </figure>
                    <p>
                    <P><span style="color: red;">在黃刀鎮的 5 天，白天基本上以走路可到的點為主</span>，主要聚集在往市區的方向，另外往原住民保留區的方向也有幾個點，不過須走比較久（約 40 分鐘到 1 小時），以下分四類介紹。
                        <br><strong>● 第一類：景點</strong>
                    </p>
                        <div class="trip-table-wrapper" style="overflow-x: auto;">
                            <table class="trip-table table-fit place-table">
                                <thead>
                                        <tr class="date-header" style="background-color: #2c3e50; color: white;">
                                            <th>NO.</th> 
                                            <th>地點</th>
                                            <th>memo</th>
                                        </tr>
                                    </thead>
                                <tbody>
                                    <tr>
                                        <td style="border: 1px solid #ddd; padding: 10px; font-weight: bold; background-color: #f9f9f9;">01.</td>
                                        <td style="border: 1px solid #ddd; padding: 10px;"><a href="https://maps.app.goo.gl/ghwZ8d5JrQDG2tRJ8" target="_blank">Prince of Wales Northern Heritage Centre</a></td>
                                        <td style="border: 1px solid #ddd; padding: 10px; text-align: left;">營業時間：10:00 - 17:00（以官方資訊為主）
                                            <br>星期日休息，館內介紹黃刀鎮的歷史演變、生態環境及野生動物。</td>
                                    </tr>
                                    <tr>
                                        <td style="border: 1px solid #ddd; padding: 10px; font-weight: bold; background-color: #f9f9f9;">02.</td>
                                        <td style="border: 1px solid #ddd; padding: 10px;"><a href="https://maps.app.goo.gl/VnRcA8tYBb3BvSPG6" target="_blank">Legislative Assembly of the Northwest Territories</a></td>
                                        <td style="border: 1px solid #ddd; padding: 10px; text-align: left;">營業時間：07:00 - 18:00（以官方資訊為主）
                                            <br>議事廳內鋪設的北極熊皮極具當地特色，環形的設計理念源自原住民採共識決的傳統。</td>
                                    </tr>
                                    <tr>
                                        <td style="border: 1px solid #ddd; padding: 10px; font-weight: bold; background-color: #f9f9f9;">03.</td>
                                        <td style="border: 1px solid #ddd; padding: 10px;"><a href="https://maps.app.goo.gl/eYSbaaHaynChi3gc6" target="_blank">Canada Post</a></td>
                                        <td style="border: 1px solid #ddd; padding: 10px; text-align: left;">營業時間：09:00 - 17:30（以官方資訊為主）
                                            <br>出國旅遊一定要寄張明信片的吧！目前只剩這家郵局有營業，貼完郵票拿給櫃檯人員蓋<span style="color: red;">北極熊郵戳</span>就大功告成，當然也可以自行投入外面郵筒寄出。</td>
                                    </tr>
                                    <tr>
                                        <td style="border: 1px solid #ddd; padding: 10px; font-weight: bold; background-color: #f9f9f9;">04.</td>
                                        <td style="border: 1px solid #ddd; padding: 10px;"><a href="https://maps.app.goo.gl/iy5x2XGh61kHsZ7n9" target="_blank">Yellowknife Visitor Centre</a></td>
                                        <td style="border: 1px solid #ddd; padding: 10px; text-align: left;">營業時間：10:00 - 18:00（以官方資訊為主）
                                            <br>如果有買旅行社的極光基本套裝行程，就會送一日黃刀鎮導覽，其中包含此點，如果不想走太多路，也可等一日導覽再前往參觀。
                                            只要踏入這，<span style="color: red;">不管有沒有看到極光，都可以領紀念品</span>。此外，牆面也有介紹當地的原住民文化及極光小知識。</td>
                                    </tr>
                                    <tr>
                                        <td style="border: 1px solid #ddd; padding: 10px; font-weight: bold; background-color: #f9f9f9;">05.</td>
                                        <td style="border: 1px solid #ddd; padding: 10px;"><a href="https://maps.app.goo.gl/wnVU8QzwafC8FmBh7" target="_blank">NWT Diamond and Jewellery Centre</a></td>
                                        <td style="border: 1px solid #ddd; padding: 10px; text-align: left;">營業時間：10:00 - 17:30（以官方資訊為主）
                                            <br>黃刀鎮除了是追光勝地外，也是世界鑽石重要產地，主要從周遭的億萬年岩層（金伯利岩）開採，館內有個小院廳，員工會給一個 VR 眼鏡，播放鑽石開採、切割及打磨過程，讓遊客身歷其境，
                                            牆面亦展示了開採歷史與過程，還有介紹鑽石種類，參觀完後也有鑽石墜飾可供購買，在月亮與北極熊造型猶豫，考量是要送給媽媽，最後選了月亮的，一條約 $6,000 NTD。</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                            <figure>
                            <img src="https://lh3.googleusercontent.com/pw/AP1GczNVcZOTI_dCyybuobJzgCVi8SivX_QW78sOzPEZ7hiKr7x1onwHB2YwgK8UdTh9f14aoyZsy5NEO7V_cjg-1dvOp0TbIthbGwgy_rk3qfotsMAa4P_k=w600-h400-p-k" alt="Prince of Wales Northern Heritage Centre(1)" class="no-hover">
                            <img src="https://lh3.googleusercontent.com/pw/AP1GczN0cNFpX-j_KlP5K_W1VmuN0mS-4aV0o0mIuNsv-S_-wOrg3Aa3mabaRLLT1rk89R60E4j9OrfZrte0ZtPAnXgE5TbV2unxWRMYensxesujGbqX6nkc=w600-h900-p-k" alt="Prince of Wales Northern Heritage Centre(2)" class="no-hover">
                            <img src="https://lh3.googleusercontent.com/pw/AP1GczOLAoVoVTVmnqKRGZCpZhskV32K-FVF5AHwYKfhTm_MElJUbpLXYlbwsVzF__vAWhIX2Fc4neRxhRCW8eZAF9rn5H4ljm_5wFqFlTn5P7vbMvWyN0GF=w600-h900-p-k" alt="Prince of Wales Northern Heritage Centre(3)" class="no-hover">
                                <figcaption>▲ 博物館資訊很豐富，建議至少安排 2 小時。</figcaption>
                            <br><img src="https://lh3.googleusercontent.com/pw/AP1GczPCH1c1SjFQ4MKhV_XjCcSqhIOvabx7CzesPEgMR8wGHpprI6yOs7g-9za-MTWR_yd6Gqv4W_mSmN5CCFj7YgVizTvDLNYlsTCm2iF1CV7wHeSJwrZw=w600-h400-p-k" alt="Legislative Assembly of the Northwest Territories" class="no-hover">
                                <figcaption>▲ 一進大門會有人員引導，從右手邊開始參觀，到 2F 往下看整片北極熊地毯有夠咄咄逼人。</figcaption>
                            <br><img src="https://lh3.googleusercontent.com/pw/AP1GczPUrr2j4fT0NqKg8XR5qXXH6A4fvs5YV--gyZKSSw2rBrJlfVpNPlu15LyxQ6UafZ0U1ZXmLSWe1S0iWS7zaHnBUHeU_JD0bgqegx2fR_Z_Svn1d8T7=w600-h400-p-k" alt="Canada Post" class="no-hover">
                                <img src="https://lh3.googleusercontent.com/pw/AP1GczO-7l0SSDhjroZPM7DRZ1oM1OhHf79Co1HozNZnaUty_JSUv1Z7uHO04Gl7m_sQA1kBZ705K3iJnTb3T240HfvmmWSdq8CoXm98Lu0tRHqaPcKEszWH=w600-h400-p-k" alt="北極熊車牌" class="no-hover">
                                <figcaption>▲ 黃刀僅存的郵局，順帶一提這裡的車牌是北極熊造型，超可愛！</figcaption>
                            <br><img src="https://lh3.googleusercontent.com/pw/AP1GczOUykFJXu_cXV_D7FX3oEXtOz8d1niIk3I9Y7hdcfxHlC2vCQ6pU92s_PZEigCQYIpxMnjY5zWbitt88YSqQIdTBIGTvZ39J6bM-maRqFJemgQaaTkT=w600-h400-p-k" alt="Yellowknife Visitor Centre" class="no-hover">
                                <img src="https://lh3.googleusercontent.com/pw/AP1GczO75KZitHV6tMdZaqHrkyfpFtsiUgEnA1NtIkzIQFM3kP2LzD56XS38hGjYt6O-OScYNapHhBg9kRgAoCL7L7fC8w6PoPuxfgi7mgvMKfZACJ7e7xlG=w600-h900-p-k" alt="Yellowknife Visitor Centre(2)" class="no-hover">
                                <img src="https://lh3.googleusercontent.com/pw/AP1GczOv1INCJwz2rOjE-DWHlfE04aPncVtoQFGlnB4xGcxzbP6kAV2d0AwGH3Cj-6ZTx0-nyqW3CeXR4VwFz9sCOXViefzY0ggSW61RPDWrLCdvAayfKfVu=w600-h400-p-k" alt="Yellowknife Visitor Centre(3)" class="no-hover">
                                <figcaption>▲ 一張北緯 66.5 度追光證書及一把小黃刀徽章別針，還有特色印章任你蓋。還有預測當天極光爆發程度儀器，及可讓遊客留言紀念的本子，極具紀念價值！。</figcaption>
                            </figure>

                        <P><br><strong>● 第二類：超市</strong>
                        </p>
                        <div class="trip-table-wrapper" style="overflow-x: auto;">
                            <table class="trip-table table-fit place-table">
                                <thead>
                                        <tr class="date-header" style="background-color: #2c3e50; color: white;">
                                            <th>NO.</th> 
                                            <th>地點</th>
                                            <th>memo</th>
                                        </tr>
                                    </thead>
                                <tbody>
                                    <tr>
                                        <td style="border: 1px solid #ddd; padding: 10px; font-weight: bold; background-color: #f9f9f9;">01.</td>
                                        <td style="border: 1px solid #ddd; padding: 10px;"><a href="https://maps.app.goo.gl/LM7Uv7MVbBbAkgQL6" target="_blank">Houcine's Your Independent Grocer Yellowknife 50th Ave</a></td>
                                        <td style="border: 1px solid #ddd; padding: 10px; text-align: left;">營業時間：08:00 - 21:00（以官方資訊為主）
                                            <br>黃刀唯二的大型超市，有生鮮蔬果、肉品、冷凍食品、餅乾、泡麵、飲料、民生用品等等，距離結帳櫃台最遠那區也有販售熟食，我們沒事就會來逛逛補貨，如果住的地方有廚房，可以買蔬菜、肉品回去自己煮，吃得好有生活感也更省！</td>
                                    </tr>
                                    <tr>
                                        <td style="border: 1px solid #ddd; padding: 10px; font-weight: bold; background-color: #f9f9f9;">02.</td>
                                        <td style="border: 1px solid #ddd; padding: 10px;"><a href="https://maps.app.goo.gl/MTS7DwY2fivmX9VD6" target="_blank">Shoppers Drug Mart</a></td>
                                        <td style="border: 1px solid #ddd; padding: 10px; text-align: left;">營業時間：08:00 - 21:00（以官方資訊為主）
                                            <br>另一間大型超市，民生食物可以去 Independent 採買，如果要買保養/化妝品、藥品這間超市較齊全。</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                            <figure>
                            <img src="https://lh3.googleusercontent.com/pw/AP1GczMaRBA-KuOZT7U6NL4r0bipzMzO_-dCWuZeJGVEnQxYa0s8OleoZ1RNao4thL4zAXSR6bIc3A2Ni6yWhulGs-D9OBXGdXQT9jF6zxUf_ZPpCvRXHC6w=w600-h400-p-k" alt="超市(1)" class="no-hover">
                            <img src="https://lh3.googleusercontent.com/pw/AP1GczPwExuJvLabdOBlHFCavqB-hcAeDIuEkmeUzRNLYzTsZ5j4x3fedjfVri8LJ9PpAHERrP8fUkNBziAK_EH2aZdVTfYJDc81pdmYG_Sjgx901KORiB3v=w600-h400-p-k" alt="超市(2)" class="no-hover">
                                <figcaption>▲ 在黃刀的三餐幾乎都是在 Independent 超市買微波食品解決。</figcaption>
                            </figure>

                        <P><br><strong>● 第三類：紀念品店</strong>
                        </p>
                        <div class="trip-table-wrapper" style="overflow-x: auto;">
                            <table class="trip-table table-fit place-table">
                                <thead>
                                        <tr class="date-header" style="background-color: #2c3e50; color: white;">
                                            <th>NO.</th> 
                                            <th>地點</th>
                                            <th>memo</th>
                                        </tr>
                                    </thead>
                                <tbody>
                                    <tr>
                                        <td style="border: 1px solid #ddd; padding: 10px; font-weight: bold; background-color: #f9f9f9;">01.</td>
                                        <td style="border: 1px solid #ddd; padding: 10px;"><a href="https://maps.app.goo.gl/t5SQhh8GKKQW1tq18" target="_blank">YK Centre Mall</a></td>
                                        <td style="border: 1px solid #ddd; padding: 10px; text-align: left;">營業時間：08:00 - 18:00（以官方資訊為主）
                                            <br>位於商辦大樓 1F，裡面有各種小店，明信片就是在其中一家購入，建議多比價才不會買貴。有一個入口可通往 Independent 超市，看 Google Map 超市位在 2F，我們又找不到樓梯，便搭電梯，結果來到人家公司門口，後來回到 1F，有熱心的民眾詢問我們是否需要幫忙，我們很不好意思的感謝他，後來逛了幾次後就找到通往超市的入口 XD</td>
                                    </tr>
                                    <tr>
                                        <td style="border: 1px solid #ddd; padding: 10px; font-weight: bold; background-color: #f9f9f9;">02.</td>
                                        <td style="border: 1px solid #ddd; padding: 10px;"><a href="https://maps.app.goo.gl/3dsBRtVakFrXN7FS8" target="_blank">Centre Square Mall</a></td>
                                        <td style="border: 1px solid #ddd; padding: 10px; text-align: left;">營業時間：09:30 - 18:00（以官方資訊為主）
                                            <br>跟 YK Centre Mall 配置很像，裡面也有多間店家，不過印象中我在這只買了 Tim Hortons ，彌補在溫哥華機場沒買的遺憾 XD</td>
                                    </tr>
                                    <tr>
                                        <td style="border: 1px solid #ddd; padding: 10px; font-weight: bold; background-color: #f9f9f9;">03.</td>
                                        <td style="border: 1px solid #ddd; padding: 10px;"><a href="https://maps.app.goo.gl/2HhxSbCzkXXUgAbq8" target="_blank">Northern Souvenirs & Gifts</a></td>
                                        <td style="border: 1px solid #ddd; padding: 10px; text-align: left;">營業時間：10:00 - 18:00（以官方資訊為主）
                                            <br>紀念用品店賣的東西大同小異，以楓糖餅乾/棒棒糖、糖漿為最經典的伴手禮，推薦可購買北極熊車牌跟黃刀造型的磁鐵/徽章別針給朋友，實用又有特色。</td>
                                    </tr>
                                    <tr>
                                        <td style="border: 1px solid #ddd; padding: 10px; font-weight: bold; background-color: #f9f9f9;">04.</td>
                                        <td style="border: 1px solid #ddd; padding: 10px;"><a href="https://maps.app.goo.gl/rub58Z7YFKJW2pd38" target="_blank">Loony Gallery</a></td>
                                        <td style="border: 1px solid #ddd; padding: 10px; text-align: left;">營業時間：10:00 - 18:00（以官方資訊為主）</td>
                                    </tr>
                                    <tr>
                                        <td style="border: 1px solid #ddd; padding: 10px; font-weight: bold; background-color: #f9f9f9;">05.</td>
                                        <td style="border: 1px solid #ddd; padding: 10px;"><a href="https://maps.app.goo.gl/E4W5jVSVVefZd5oKA" target="_blank">The Salvation Army Yellowknife Thrift Store</a></td>
                                        <td style="border: 1px solid #ddd; padding: 10px; text-align: left;">營業時間：10:00 - 18:00（以官方資訊為主）
                                            <br>位在飯店對面，以二手商品為主。</td>
                                    </tr>
                                    <tr>
                                        <td style="border: 1px solid #ddd; padding: 10px; font-weight: bold; background-color: #f9f9f9;">06.</td>
                                        <td style="border: 1px solid #ddd; padding: 10px;"><a href="https://maps.app.goo.gl/QgtePv3svkrXEnzTA" target="_blank">Weaver & Devore Trading Ltd</a></td>
                                        <td style="border: 1px solid #ddd; padding: 10px; text-align: left;">營業時間：9:00 - 18:00（以官方資訊為主）
                                            <br>位在 Bullock's Bistro 網美魚餐廳對面，可以趁候位時先去逛，店家 2F 有販售各種禦寒用品，像是雪鞋、手套、兩側可罩住耳朵的帽子、大衣等。</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                            <figure>
                            <img src="https://lh3.googleusercontent.com/pw/AP1GczOl392IDYsXyH_mjyaYhyEllSs-JP7i2VPCibkxcS6CBZIbmY2-gG6wt24CKg4Fi3QVcf-tRaDffyqTN3eUBx5dxDhCad9n1w6Kpxcq-s_HdGk5PPXo=w600-h400-p-k" alt="Canada goose" class="no-hover">
                                <figcaption>▲ 最特別非 Bullock's Bistro 對面商店莫屬，竟然有賣 Canada Goose 禦寒外套，<br>一件大約 $20,000 NTD。</figcaption>
                            </figure>

                        <P><br><strong>● 第四類：餐廳</strong>
                        </p>
                        <div class="trip-table-wrapper" style="overflow-x: auto;">
                            <table class="trip-table table-fit place-table">
                                <thead>
                                        <tr class="date-header" style="background-color: #2c3e50; color: white;">
                                            <th>NO.</th> 
                                            <th>地點</th>
                                            <th>memo</th>
                                        </tr>
                                    </thead>
                                <tbody>
                                    <tr>
                                        <td style="border: 1px solid #ddd; padding: 10px; font-weight: bold; background-color: #f9f9f9;">01.</td>
                                        <td style="border: 1px solid #ddd; padding: 10px;"><a href="https://maps.app.goo.gl/QQgk3EKDKkGHi9i8A" target="_blank">The Vietnamese Noodle House</a></td>
                                        <td style="border: 1px solid #ddd; padding: 10px; text-align: left;">營業時間：11:00 - 20:00（以官方資訊為主）
                                            <br>販賣越式料理，這是我們唯二有吃的餐廳，不過會吃這間是因為旅行社冰上捕魚有配合料理當日捕撈到的新鮮魚貨。</td>
                                    </tr>
                                    <tr>
                                        <td style="border: 1px solid #ddd; padding: 10px; font-weight: bold; background-color: #f9f9f9;">02.</td>
                                        <td style="border: 1px solid #ddd; padding: 10px;"><a href="https://maps.app.goo.gl/dmkPejS5A7eaLPBz9" target="_blank">Bullock's Bistro</a></td>
                                        <td style="border: 1px solid #ddd; padding: 10px; text-align: left;">營業時間：11:30 - 20:00（以官方資訊為主）
                                            <br>第二間有吃的餐廳，網路推薦必吃，用餐時段去真的都要排隊，我們有先打電話去問，店家建議我們直接到現場等，大約 16:30 過去，等了 30 分鐘，
                                            太晚去經典炸白魚已賣完。菜單上會有不同種類的魚跟廚師搭配的煮法，我跟昀姐姐分別點了 Whitefish （煎的）、Great Slave Cod（炸的），魚肉都處理得很好，也吃得出魚的鮮味，排隊等待很值得。
                                           </td>
                                    </tr>
                                    <tr>
                                        <td style="border: 1px solid #ddd; padding: 10px; font-weight: bold; background-color: #f9f9f9;">03.</td>
                                        <td style="border: 1px solid #ddd; padding: 10px;"><a href="https://maps.app.goo.gl/M5E2rVBSQ3xWyZ1F7" target="_blank">Sushi North Inc</a></td>
                                        <td style="border: 1px solid #ddd; padding: 10px; text-align: left;">營業時間：11:30 - 19:00（以官方資訊為主）
                                            <br>這是第一天抵達黃刀，Evon 在飯店接駁路程推薦的。</td>
                                    </tr>
                                    <tr>
                                        <td style="border: 1px solid #ddd; padding: 10px; font-weight: bold; background-color: #f9f9f9;">04.</td>
                                        <td style="border: 1px solid #ddd; padding: 10px;"><a href="https://maps.app.goo.gl/1M5vDLt5n6b46foN6" target="_blank">Gold Range Bistro</a></td>
                                        <td style="border: 1px solid #ddd; padding: 10px; text-align: left;">營業時間：9:30 - 21:00（以官方資訊為主）
                                            <br>這也是 Evon 在飯店接駁路程推薦的。</td>
                                    </tr>
                                    <tr>
                                        <td style="border: 1px solid #ddd; padding: 10px; font-weight: bold; background-color: #f9f9f9;">05.</td>
                                        <td style="border: 1px solid #ddd; padding: 10px;"><a href="https://maps.app.goo.gl/R6N8z9VTfQ6dcaYp8" target="_blank">Zehabesha Traditional Ethiopian Restaurant</a></td>
                                        <td style="border: 1px solid #ddd; padding: 10px; text-align: left;">營業時間：11:30 - 20:00（以官方資訊為主）
                                            <br>行前做功課存的。</td>
                                    </tr>
                                    <tr>
                                        <td style="border: 1px solid #ddd; padding: 10px; font-weight: bold; background-color: #f9f9f9;">06.</td>
                                        <td style="border: 1px solid #ddd; padding: 10px;"><a href="https://maps.app.goo.gl/jkpxwcYYad5FGjwk8" target="_blank">Yk Wood Fired Pizzeria</a></td>
                                        <td style="border: 1px solid #ddd; padding: 10px; text-align: left;">營業時間：11:30 - 00:00（以官方資訊為主）
                                            <br>行前做功課存的。</td>
                                    </tr>
                                    <tr>
                                        <td style="border: 1px solid #ddd; padding: 10px; font-weight: bold; background-color: #f9f9f9;">07.</td>
                                        <td style="border: 1px solid #ddd; padding: 10px;"><a href="https://maps.app.goo.gl/U73bzxWzj983gHUY7" target="_blank">NWT Brewing Company / The Woodyard Brewhouse & Eatery</a></td>
                                        <td style="border: 1px solid #ddd; padding: 10px; text-align: left;">營業時間：12:00 - 00:00（以官方資訊為主）
                                            <br>走路經過看見前面停滿車，感覺是很厲害、很道地的餐酒館。</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                            <figure>
                            <img src="https://lh3.googleusercontent.com/pw/AP1GczPLohyLJ4137XNujwip_78DLXu3sSWVkeQ5fxZfdeW33M-YgwB2sknmE--PHp15h3M3VUezG2UA_0pbnPTVz6q3AtPH3eSx9aBMbh4uMgNVsuy6Jgg1=w600-h400-p-k" alt="The Vietnamese Noodle House" class="no-hover">
                            <img src="https://lh3.googleusercontent.com/pw/AP1GczOlrT07ODvO0rtDs1ZVpehwjRWTBI4J2WIeSGtEksbFX4fEeG38xVO1VN55b8l7Pz2kymdOqsQm5n6QsmlCzYcOvUukzPCuO46ow2X_0YJ7wOTXENzP=w600-h400-p-k" alt="The Vietnamese Noodle House(2)" class="no-hover">
                                <figcaption>▲ 現撈的魚變炸魚排，還有生菜跟濃湯都可免費續，在冰天雪地能喝到熱湯就是幸福。</figcaption>
                            <br><img src="https://lh3.googleusercontent.com/pw/AP1GczMOWNfueoScRke34873w3fRK-86RcfCsl0U5VwSTqfgkAT1ewflkbY1mnKL6P00-K9gBHFQ0vtJ5NFuu4Tkm_fhzSU3X4Fw3KX4OgQa7Ng5QiBCMf4F=w600-h900-p-k" alt="Bullock's Bistro Menu" class="no-hover">
                            <img src="https://lh3.googleusercontent.com/pw/AP1GczO_Z8ldnUN0LJ9oX06Qm-KUA6fIfxNNrKkYOZ19VbWglG141gN44zYZhH7Cgh7wvsz-dMyAMYHggeqL--_ZoGJWdfhA2iKwtQAmUzqZa8r9IisZO051=w600-h400-p-k" alt="Bullock's Bistro wall" class="no-hover">
                            <img src="https://lh3.googleusercontent.com/pw/AP1GczPsNmsoT1qiUKx7pR4hYaj-f70SEz3h3CP1rkkgWTj96W1Vdl4h1nquMUq4c3LKruUFrPq6qemaw8FX68rpZHrBQx86iR0-U-ilViiGRkonJQIp6sHe=w600-h400-p-k" alt="Bullock's Bistro 昀姐姐點的" class="no-hover">
                                <figcaption>▲ 菜單簡潔，先選魚再選料理方式，牆面上有遊客來訪的紀念，像手寫簽名、各國貨幣，很有異國風味。<br>
                                因為 Great Slave Cod 看起來比較可口，魚肉也比較大，就只放昀姐姐點的。</figcaption>
                            </figure>
                <li>
                    <p>白天我們安排的點大致如上，旅行社也會附免費的是一日市區導覽，所以不用擔心沒有交通工具無法抵達較遠的點。
                        <span style="color: red;">另外如果想體驗當地才有的活動，也可以跟旅行社加購，我們加購了雪上摩托車、狗拉雪橇、冰上捕魚</span>，加購的行程安排以旅行社告知為主，可能是出發前一天甚至到當地才會知道，建議自己排行程先不用排得太緊湊。</p>
                        <br><p><strong>雪上摩托車</strong>
                            <br>此行程安排在抵達黃刀第二天的 13:30，旅行社會安排接駁車（沒有導遊陪伴），只需要準時在飯店門口等候就行，沿途會載其他有報名的團員上車。
                            一開始教練會先進行車輛操作說明，如何讓機車啟動、催油門、煞車，還有防止面罩起霧，接下來先在空曠結冰的 Kam Lake 湖面繞繞，讓大家熟悉，體感覺得轉彎多了一股阻力，直線就跟一般騎機車差不多，繞得差不多就往 Meg Lake 騎，
                            中間經過森林，有別湖面的平緩，這一段根本像在坐雲霄飛車，後座的昀姐姐完全沒辦法錄影。大約 40 分鐘後回來原來的湖面，剩下時間教練讓我們自由活動，我們開始嘗試在平坦的湖面加速、享受甩尾離心力的刺激，也趁這個時候紀錄美麗壯觀的畫面。
                            <br>我們這次是買兩人一台的方案，不過如果兩人都想感受馳騁在森林裡的快感，會建議各騎一台，因為過程中很難臨時交換座位，不過價格就會貴一點。</p>
                                <figure>
                                <img src="https://lh3.googleusercontent.com/pw/AP1GczMAO9HrSfl6_XOAaiqeAd9HpMxlLX0dfq1rRW9t7glH_M-vNqVdQ3osXtRzL0Wt4M3osODzuUc_dP-rB8PE1MRPQeoacjzN6J_3ny4qihZ4104vWjzU=w600-h400-p-k" alt="雪地摩托車 Kam Lake" class="no-hover">
                                <img src="https://lh3.googleusercontent.com/pw/AP1GczPKCozvas5BvZsRrb2Y0Zb9DHPSXvIIxnH5iyZsRuypfdDmlcsN7nX5wbAJGtZjeoxnpxHwxvr8uNdKTMBEav4cWdDuP9Yg6gWziSuckakpsgMd_bnu=w600-h400-p-k" alt="雪地摩托車奔馳" class="no-hover">
                                    <figcaption>▲ 結冰的 Kam Lake 佐夕陽 ft. 帥氣的昀姐姐。</figcaption>
                                </figure>
                        <br><p><strong>狗拉雪橇</strong>
                            <br>此行程安排在抵達黃刀第三天的 12:30，旅行社也有安排接駁車，這次有導遊陪伴，也是準時在飯店門口等候即可，沿途會載其他有報名的團員上車。
                            <br>抵達 Aurora Village 園區，一下車導遊先帶我們到小木屋取暖，順便發狗拉雪橇的號碼牌，一趟可載 4 人，我們跟另一對情侶組團。小木屋裡面有提供熱水，也有咖啡包、巧克粉可以沖泡，也提供糖果餅乾，走累玩累了可以進來休息，隨身包可以先放在這，因為等活動結束後會再回來集合。
                            接著導遊就帶我們來到一個溜滑梯，較建議兩兩一組進行，最累的是必需先拖著 8 字輪胎走樓梯，不過真的很好玩，滑下來的瞬間是會騰空的那種，我們一人大概都玩了 3 次以上。邊玩邊等待雪橇叫號，終於輪到我們！
                            <br>狗拉雪橇的乘坐入口在溜滑梯滑下來後往前走約 800 公尺，會繞 Aurora Village 一圈，我們是最後一批，看著哈士奇們體力微微不支的模樣其實蠻心疼，不過老闆說適當活動對狗狗們來說是好的，叫我們不用擔心。
                        </p>
                                <figure>
                                <img src="https://lh3.googleusercontent.com/pw/AP1GczPND-ArLWdV4NVaUNcyhYKBoeYd-rf_YnbEcY5DMMBZecM24UVb0lpehky-gPeBNN1rytbnDHhUJK_3UyCxMmSJLfueHI57RTFzXXy9Jx04o03FHoNk=w600-h400-p-k" alt="Aurora Village" class="no-hover">
                                <img src="https://lh3.googleusercontent.com/pw/AP1GczOUsY2J4inp4YhrKJk4g0NyVPqJofByxOZ0J9vm-iGF8Easx6SfvNmtnwNccW43dyQfHi6HcLtIjiKG8hVYtoqW9YtHueGoPhstnMkEtP82C-uB_QOQ=w600-h400-p-k" alt="溜滑梯" class="no-hover">
                                <img src="https://lh3.googleusercontent.com/pw/AP1GczPyk4sKAeOYki2UJnsfi7NYwkmYiCO6SpICtfDgpRPmdFPwNnlNio8fYg9hwbMdcZ9JaSnwz2VKNgvGXpy-2wqGZ4seyKeB9liEblA9usasVTGA00le=w600-h400-p-k" alt="烤棉花糖" class="no-hover">
                                    <figcaption>▲ Aurora Village 很大，小屋外有箭頭導引各地方，其中最好玩的是斜度 60 度的溜滑梯，
                                        <br>滑梯旁有升火可以取暖 & 烤棉花糖。
                                    </figcaption>
                                <br><img src="https://lh3.googleusercontent.com/pw/AP1GczObsgSyI-FigWedkurPDARm66S0Z0OmY4U2tSse1nWl1TDDJclZpo_tCH4zbcl-sWHJs9dbSE1CqvOdnOlQ8NDmwD1thkcptHsXlLDVD8ndgLUK25IP=w600-h400-p-k" alt="狗拉雪橇" class="no-hover">
                                <img src="https://lh3.googleusercontent.com/pw/AP1GczMc03YsGfZQS-WD4plNHOl3HTbljUIdyXMEh5x8fjZGjTzV_vL_G8zXccNU3n_zv0zBu8HZ5L0DB45n2vnfHdvCWada-cu5248JyVeY9F38t16LkX_H=w600-h400-p-k" alt="狗拉雪橇(2)" class="no-hover">
                                    <figcaption>▲ 雪橇行進過程可以感覺到部分狗狗的體力已消耗殆盡，跑一跑就會停下來休息，
                                        <br>或是吃旁邊的雪補充水分，還有邊跑邊排泄的狗狗 XD
                                        <br>真的辛苦狗狗們，不過園區還蠻照顧牠們的，記得每隻狗狗的名字，<br>完成後也都會拍拍牠們，給予鼓勵。
                                    </figcaption>
                                </figure> 
                        <br><p><strong>冰上捕魚</strong>
                            <br>此行程安排在抵達黃刀第四天的 14:05，有接駁，也有導遊陪伴，是在靠近 Willow Flats 那一帶的 Yellowknief Bay 進行，
                            下車迎接我們的是一位帥老闆，只見老闆往結冰的湖面走去，湖面有一個小冰堡，供漁夫們放工具、處理漁貨、簡易烹煮還有休息使用，
                            老闆與兩位漁夫拿完工具後，只見利用工具把雪地撬開一個洞，10 分鐘後只見老闆與漁夫合力將洞口的漁網往上拉，先是幾條小魚，後來出現一條大魚，大家開心的發出驚呼聲，
                            後來小魚被丟棄當下次的誘餌，大魚則被大家捧著輪流拍照 XD
                            <br>捕完魚，老闆帶我們到下車處前方的一個斜坡，只見他動作流利拿板、趴下、往下滑，就滑到剛才捕魚的地方，我們也跟著體驗，殊不知蠻好玩的，一玩又上癮 XD
                        </p>                    
                        </div>
                            <figure>
                            <img src="https://lh3.googleusercontent.com/pw/AP1GczPdRwAsxyJWfq_v9h8-S45UFyT3ZXyS1rWafDtWYRGDIa3IG_pyKmKIuPZCKGmaYtpRTtHdc63OiWTKVl0wwIGhLBadDj-uQo6mnlkaELk85ur6j_f7=w600-h400-p-k" alt="冰上捕魚" class="no-hover">
                            <img src="https://lh3.googleusercontent.com/pw/AP1GczPzHoERcXWqK-_BnOrXnMZdbpB8dtwqCUxGZaHokxO5pujOsSSnmdt3TLEILdXoxe3uYTNSeFxI7rXwRuMYf0_HGW017FIgdKcucZs1ChKmWc0Y7j01=w600-h400-p-k" alt="冰上捕魚(2)" class="no-hover">
                                <figcaption>▲ 前天已部署好的洞口，捕到的大魚跟我的手臂一樣長。</figcaption>
                            <br><img src="https://lh3.googleusercontent.com/pw/AP1GczOOD5dmD2OPdXox4akYVzRmhwWiDkIG5LtV_usB8PdV4QObPk5M42sVu5ybKcBg9th49PXEMJbbGIeMr9DSLMYnslbxNRpcCktGdtfI1bRx4Yz3wncy=w600-h400-p-k" alt="冰上捕魚滑板" class="no-hover">
                                <figcaption>▲ 又是一個配角搶走主角光環的點 XD 近距離與帥老闆接觸的一刻。</figcaption>
                            </figure>

                        <p><strong>一日市區導覽</strong>
                            <br><p>免費導覽安排在第四天，11:20 等到接駁，第一站先到 Bristol Monument 看第一架降落在北極圈的飛機，飛機位在一個小山丘上，拍完飛機別忘記跟 Welcome Yellowknife Sign 拍照。
                                第二個點來到 Yellowknife Visitor Centre ，讓大家領證書、以及小黃刀徽章別針。
                                第三個點來到 Dettah Ice Road，能將 Dettah 前往市區的路程從 2 小時縮短至 20 分鐘，結冰的湖面很滑，真的要小心。
                                第四個點來到舊城區，此區為原住民居住區，原則上不能隨意進入，因為有事先申請因此可搭車遊覽（有申請甚至只能在車上看不能下來走），這邊的房子也不是一般人想買就能買，只能說血統很重要 XD Evon 說這邊判斷各家水源是否充沛的依據是住家外的燈管顏色，亮綠燈代表水足夠，亮紅燈代表缺水。 
                                最後一個點來到全鎮最高的據點 Bush Pilots Monument，雖然只有海拔 181 m，但冬天走結冰的階梯還是得走個半小時，上去的展望還不錯，可以一覽黃刀鎮的風貌。
                                結束後可以選擇去 Bullock's Bistro 用餐，或是搭接駁車回飯店。
                            </p>
                        </div>
                            <figure>
                            <img src="https://lh3.googleusercontent.com/pw/AP1GczM14I1f9o2him024grCWHk6YPjb45klKAbF3Vpr_pXfzsw8ddwRZzi3G2QnNIF8CKCeb9unbsqVYrhMo66mPpkS6Ve2TTLzokmSKQOxvm2Pl74JeNPa=w600-h400-p-k" alt="Bristol Monument" class="no-hover">
                            <img src="https://lh3.googleusercontent.com/pw/AP1GczN1iLRf1RdzrqQ2YGfJgPLaVeOD8Ac6pYAt62XN87xN2G9R3sWnxhKF__Hpu5zkQS32oQ8_96fDAusIKu3JskQqUhy7FnnN1vtIO4Uc-ECg4pQGPVFv=w600-h400-p-k" alt="Welcome Yellowknife Sign" class="no-hover">
                                <figcaption>▲ 來黃刀鎮一定要拍的紀念碑及第一架降落在北極圈的飛機。</figcaption>
                            <br><img src="https://lh3.googleusercontent.com/pw/AP1GczMB-3YuBtj4Gatt1LxEuwHgQLcJu6ZLkD5k3a0IRpkszRp9Dq5dCjUtmsBHnxQZQCBuXBtEQLW_3Q4WRvivqe-XmAU0B0B3WuDUxDdM5WvgzBhNhfV0=w600-h400-p-k" alt="Dettah Ice Road" class="no-hover">
                            <img src="https://lh3.googleusercontent.com/pw/AP1GczO54cmkAIfdi3cRTGd4yGO-5Ghj-AxoQitw9efiFEiVyByl6FCshnofOUekMTd1rOVJt2E4WjvQMZ9Dt7h6nHcFh6qZyvrT7m8dgM32CqKbr7DbU2SS=w600-h400-p-k" alt="Dettah Ice Road(2)" class="no-hover">
                            <img src="https://lh3.googleusercontent.com/pw/AP1GczPWMhy-WzqQ3nnE1WQMhLTMrsdqKwjg_f-tlKl1L1neC4BGoonRxzOjas3cY2amJWs86hRCxMg-FEWg0ya5qx_k8naUsRSit0WImRVsE73cQeHQLmJQ=w600-h400-p-k" alt="Dettah Ice Road(3)" class="no-hover">
                                <figcaption>▲ 冬天的大奴湖結冰變成一條冰路，可承重 30,000 公斤，放眼望去很壯觀，<br>載我們的大車在湖面上整個變得很渺小。</figcaption>
                            </figure>
                </li>
                <li>
                    <p>晚上行程就是我們這一趟的重點！！！追極光！！！很幸運的，我們每晚都有看到，除了前兩晚較淡，其他幾晚都是爆發，尤其第三晚極光微微舞動的樣子，令人印象深刻。
                        每晚的追光模式相同，旅行社會先至各飯店接駁，沿著 Ingraham Trail 往東邊開，在車上簡單說明當天天氣狀況，以及哪個點追光成功機率較高，到地點後導遊會先下去場勘，聽到尖叫聲或是導遊很興奮的跑回來車上，就表示出現爆發，
                        大家就會下車拍照，如果要給導遊拍，就須排隊，但我跟昀姐姐很常自己在旁邊用手機、腳架拍照，通常在外面待上 30 分鐘，皮膚就會感到刺痛，但我們兩個很常一玩就一小時過去，甚至大爆發那晚，全車的人都上車，我們還跟導遊在外面享受大爆發的興奮。
                        <br>印象比較深刻的追光地點有 3 個，分別在帳篷營地、Prosperous Lake、Vee Lake。
                    </p>
                        <br><p><strong>帳篷營地</strong>
                            <br>每天追光結束都會回來，此地屬於當地原住民領土，必須獲批准才得進入，營地帳棚主要是旅行社與當地原住民一同經營。
                            <br>還記得第一晚，原先看近郊 KP 值不高，想說開到 Prelude Lake Territorial Park 進入極光可視範圍高的地方，還是沒看到，便失望的回營地帳篷，殊不知在帳篷等了 1 個小時，Evon 突然進來跟我們說天空開始出現淡淡的極光，我們便快速的跑出去，用肉眼看其實是一條白白的帶子，用手機照才出現綠光，
                            不久開始伴隨黃色、紅色的光，只記得我們一值哇哇哇的發出驚嘆聲，也忘記 -30 度的寒冷，脫下手套捕捉這令人興奮的一刻。</p>
                                <figure>
                                <img src="https://lh3.googleusercontent.com/pw/AP1GczNkbkDfU3HoPHm0ddMI_FqrkrGad-R3sJ4TvvL_mhyDTD_bMfPq0num9eMKapkkSWif3__8UWcDu70t80RVmh3SomuDdWlSNrrw9Uf2Rtc5JdQL4gXC=w600-h400-p-k" alt="帳篷營地環境" class="no-hover">
                                <img src="https://lh3.googleusercontent.com/pw/AP1GczOS3Pl_t7q9p0r90fQfvn27Ps24GoawrjJreclAusR468q0U7BE5bERWI6SuBoiE1EZVet-TQjIj3pSovNDg1h7u7lTXKMis_t_ARWs5GJZhP7WlAgJ=w600-h400-p-k" alt="帳篷營地環境(2)" class="no-hover">
                                    <figcaption>▲ 帳篷裡約可容納 20-30 人左右，裡面有暖爐可供取暖，熱水沖泡熱飲、泡麵，還有糖果餅乾可果腹，也可看到牆面掛著各式動物的毛皮，這些都是當地原住民合法獵捕，是真的！</figcaption>
                                <br><img src="https://lh3.googleusercontent.com/pw/AP1GczOB7JT775kDqhiulJ_raLO0J9gA3QsMqfPAZ9qYUaPSFvRmRYWIoNUHDIJRxr1j3VpYNEgrRMGe5B5fCn_IXbQTOa_U4I81ISyl1GDOyIt2EKv9agij=w600-h400-p-k" alt="帳篷營地第一天極光" class="no-hover">
                                <img src="https://lh3.googleusercontent.com/pw/AP1GczM0d_uFz6iYTQ2PhFOV_pFs3u5tcDXcYh7aBm45BkGeh10Chg9CQ9Q1tPeC_q80PvQq4zT_nBurdRgXxmUYQt1143KeUdAC99ACujqt2ewVgsfuX1vz=w600-h400-p-k" alt="帳篷營地大爆發" class="no-hover">
                                    <figcaption>▲ 第一晚在帳篷營地看到的極光，佐帳篷拍起來真的很美~還有其他天大爆發的照片。</figcaption>
                                </figure>
                        <p><strong>Prosperous Lake</strong>
                            <br>第二晚、第三晚的追光地，終於在第三晚看到極光大爆發。</p>
                                <figure>
                                <img src="https://lh3.googleusercontent.com/pw/AP1GczPt60Bs-deJW9OovlehythAEUI_lVqwio6CPktRyi_4GqmVvRFh06ioNFEHUmM-ladDltP3g3vB8dRv7-pmTcl_v3X4rgWry7_CMoQVerYS3gYN0hcI=w600-h400-p-k" alt="Prosperous Lake 極光" class="no-hover">
                                <img src="https://lh3.googleusercontent.com/pw/AP1GczMDOYJGpm2Ums6g7UqRggwhDUnaXWRQEaro66SQSEmSZ1s4IjO1aBVceI-VMOsv3KWnlI8ZZWmD5uN2A3TELuQWt_NZtgUCuQaerw5iyuQPOi_8ycyE=w600-h400-p-k" alt="Prosperous Lake 極光(2)" class="no-hover">
                                    <figcaption>▲ 這兩張切換會看到微微舞動的極光。</figcaption>
                                <br><img src="https://lh3.googleusercontent.com/pw/AP1GczPx1Umjh7Uj0KTd_OHAEJpQk4nkWdM0qAa76NZ8SouS7IWvfV8NUtExGgdXMKw6pFfA3DiLX9XUgOS137-es2aMqm1_BLC7la7ZjfXmv7EkOLszZM8a=w600-h400-p-k" alt="Prosperous Lake 極光(3)" class="no-hover">
                                    <figcaption>▲ 鋪蓋一整片天空的極光。</figcaption>
                                </figure>

                        <p><strong>Vee Lake</strong>
                            <br>第四晚極光一樣有爆發，在追光途中還遇到一個小插曲，有一輛突然停在接駁車旁，一個看起來很像有呼麻（?）的男生下車，那時只剩我、昀姐姐還有 Evon 在外頭，遠處還有另一團星辰的追光團，那個男生問了幾個很莫名其妙的問題，司機下來解救 Evon，看見有壯丁那個男生便離開開往樹林，
                            另一團的導遊馬上走過來問 Evon 發生什麼事，還抱怨那台車的燈害他們無法好好追光、拍照，只見所有人都覺得很莫名其妙，好險當時有司機在，他才不敢亂來，因為追光都在深夜，如果是自由行還是要隨時注意周遭狀況。</p>
                                <figure>
                                <img src="https://lh3.googleusercontent.com/pw/AP1GczNbnumXJMyfNj6XyV_9YO6iBiGfzkSuOXIWX34rYUiMaxby1-wBMXpZu7R7Rf8DrkRWO5k4PWosMFQm13S6o_WW_h3DID9JOklY2V_XcDLjjyaIDUjq=w600-h400-p-k" alt="Vee Lake 極光" class="no-hover">
                                <img src="https://lh3.googleusercontent.com/pw/AP1GczP2VXI3PS6zEzNKvpok3P3FBO80jtnaFdhu6a1Sb6wyE-AkMJZhGYqb0g1DviAKc_fMl3t_Sswr2dzgIQHjIisLa_BCXS_PXghzfKcJftdOMv7UbfWn=w600-h400-p-k" alt="Vee Lake 極光(2)" class="no-hover">
                                <img src="https://lh3.googleusercontent.com/pw/AP1GczPa0ZAX7xs_VFa8sRpSg7cEpm81M4KK2fCaWsfSZKqepvS44ISBkRC0Xs4gvyqqhclgdhCGQW6aqPjdJ-ZnBerDR4HhdaN4A9ukmTK4SLlrV8Wfo3V0=w600-h400-p-k" alt="我與極光的合照" class="no-hover">
                                <img src="https://lh3.googleusercontent.com/pw/AP1GczNfSVr0EZrz-r0snRXdEF3iYQzh2cG9v-8uLpmdLZVfIwTkLDoCn70vVkxobe7GlCgNRkyJbAW5pYWLq9ot6rF71_djXhxlVmpuVouaizv5SPrv9jAu=w600-h400-p-k" alt="與Evon的合照" class="no-hover">
                                    <figcaption>▲ 最後追光日，獲得此趟與極光最可愛的合照 ft. 冷到伸不出來的手手 XD 
                                        <br>這一趟黃刀之旅也非常感謝 Evon 的照顧，後會有期！</figcaption>
                                </figure>
                </li>
                <li>
                    <p>在黃刀的最後一個早上，我們又去逛了一次博物館，把之前沒好好參觀的部分補起來，順路買了些紀念品，便趕緊回飯店整理行李。
                        <br>12:00 在飯店門口等候接駁車送我們去機場，結果來的是粉紅吉普車，真的是又驚又喜，車上還有 2 位小夥伴，是前幾天追光認識的朋朋，只能說黃刀鎮很小，只要是那段時間前往追光的人，很難不認識 XD 
                        <br>行李託運完，機場有 2 間小店可以逛，可以消磨個半小時，逛完距離登機還有 1.5 小時，我們先去過安檢，就這麼剛好我被攔下，地勤一臉嚴肅，不過只是翻了我的包，確認此趟目的，就放我走，但我們進入大廳有聽到一個日本人跟安檢人員起衝突，只能說黃刀鎮的安檢人員不好惹。</p>
                                <figure>
                                <img src="https://lh3.googleusercontent.com/pw/AP1GczNVIwggF8cn6xXP65P1mBVGrMxkf5zfMqE5t07_qRuWkB1Iw6kgaTfxkXJIVv0vkxLgFapl6gydIt79gU3Rxv8nCeat_Ojx4Hg6rJ8ATb23D4AOGS1z=w600-h400-p-k" alt="粉紅吉普車" class="no-hover">
                                    <figcaption>▲ 聽說粉紅吉普車出一趟極光要價不斐，何其幸運能被他載到！</figcaption>
                                <br><img src="https://lh3.googleusercontent.com/pw/AP1GczNQxU245JRyk8MRAc3dHDpEXSBWqrfq5nrSPjF-thJ7jRtvSnq5GVc2Xe-4b39IToAvbtWeYBVfTc7yA6JecAH04k3K0daWj4Tx6NBtI1BRPwi8lcHH=w600-h400-p-k" alt="YK 行李托運" class="no-hover">
                                <img src="https://lh3.googleusercontent.com/pw/AP1GczNKvI4doMlBxfmrVaYS8AvSiUMXkZ-JHQSPI8sHOUTwKlPAVqKM8nH6qETtbZMqS1FG6Pxa1NVOn2JCCqw7I7SoGfpfYgyYNldBOdJLdHgKRELegT-G=w600-h400-p-k" alt="YK 過安檢" class="no-hover">
                                    <figcaption>▲ 黃刀鎮的行李托運櫃台以及安檢的地方，黃刀鎮安檢很嚴格，會檢查很仔細，隊伍移動速度緩慢。</figcaption>
                                </figure>
                </li>
                <li>
                    <p>14:30 搭上前往卡加利的飛機，在卡加利轉機後，18:41 抵達溫哥華。領到行李後，一樣搭乘 Sky Train 來到我們接下來兩晚住的旅館 Cambie Seymour Hostel。旅館樓下是一間酒吧，原本擔心會很吵，好險房間隔音還行。
                        洗澡、上廁所須至公共空間，男女衛浴個別位於 2F 走道兩側底端，進去廁所前需要先解鎖，算是讓人小小安心的地方。經歷舟車勞頓，洗完澡便早早休息。</p>
                                <figure>           
                                    <img src="https://lh3.googleusercontent.com/pw/AP1GczNoRoaZW8tUka1xsiIt_5KaK82q_y1KcYc3BVr1uwTsi5rxwcU-yACUMAMq8igs0eTO8UaVH-WJvhGgz2hz4gNtpLmeyE5a1pX1Iv13kADUnJ4pqc6I=w600-h400-p-k" alt="Cambie Seymour Hostel" class="no-hover">
                                    <figcaption>▲ 最後三天在溫哥華住的旅館，空間非常小，兩個行李箱無法在地上同時攤平，昀姐姐只好在桌上開箱。</figcaption>
                                </figure>
                </li>
                <li>
                    <p><strong>D6 - D8 溫哥華</strong>
                        <br>早上是安排到 Stanley Park 騎腳踏車，從飯店走過去約半小，我們先在 Spokes Bicycle Rentals 租腳踏車，車款是 City Hybird 一小時是 $ 50 CAD，我們各租了 2 小時）。 
                        總共騎了 11k，沿途風景超美，空氣很好，也有很多人在跑步，如果有來溫哥華，非常推薦到此處走走。
                        </p>
                        <figure>
                                <img src="https://lh3.googleusercontent.com/pw/AP1GczNn_F0fBEcShuSwGNg_xMqeoV2JxsaHVoIoXvRAUmAoojhEqP7XuzKka-BIiBiTfE0uYUuNY8Oetz73zjn3VPRhXI2ulj0DLGKCOFpXSXJvh55p1MOG=w600-h400-p-k" alt="租腳踏車" class="no-hover">
                                <img src="https://lh3.googleusercontent.com/pw/AP1GczOdAzUd1_I7-3mG6DD2OXBpqWKsvh_EGQ035VZsudfVWvMhWlsjFGZ7qeBeCFJmJAaep_wzEcWZXDyEwh4b1Wwlq6n1PDKvaaDJzpw12u3LFpFzXg-8=w600-h400-p-k" alt="map" class="no-hover">
                                <img src="https://lh3.googleusercontent.com/pw/AP1GczPZj3fsIt2IWwGzEpj2RQ0tqupVgWxoyt67MOFbH51Smw33Ag5jjLQ_YbEOZPVsM_7E95khL-15Q5riKrUmqZMopt27OvGCd-rqsRSF728d_VJnVU1F=w600-h500-p-k" alt="start" class="no-hover">
                                <img src="https://lh3.googleusercontent.com/pw/AP1GczPsgWu0booORKVhEdYxZ8fRcll8W_jw8IYdEmr_0ggqnXM0FsyICMj2Mvcu4k9Ji8UCWRp6OsqlloCVIjmwBardJ0GND0zbR-cWno67nRULjTEiAvs9=w600-h400-p-k" alt="start(2)" class="no-hover">
                                <img src="https://lh3.googleusercontent.com/pw/AP1GczPAsmJJVI_hoxsQmM1qKnGIoYwLzkZVEBY_MHHu8pQR8Mt1-O-06qFCJJbbhfrwLBAFJioD9biOj0ZJjcfIr1Xis0mtL42AU576M7TtA89r6Kt27dAe=w600-h400-p-k" alt="start(3)" class="no-hover">
                                <img src="https://lh3.googleusercontent.com/pw/AP1GczPgxVhSX0aB1OiQe9AgV1VymJ5VtN0H27-pEbKYtotpWhnkL5u81Au4SfOyeSWwQZy_jq9w4AmCkW8vJ_X8vFt69V63adasuCC9kOrrvb-LWxTpvt1n=w600-h400-p-k" alt="start(4)" class="no-hover">
                                <img src="https://lh3.googleusercontent.com/pw/AP1GczNwyBZ1JsMwCnBFjNFt2nRCZQoJgXQrFtQcbMEKQBSwJdp5PS_94y3perUv7-kldtRAdxZawSjOlKD6wR1m88qSCpPyGEC2Gj2m2mkvuNGanZq21OEv=w600-h400-p-k" alt="start(5)" class="no-hover">
                                <img src="https://lh3.googleusercontent.com/pw/AP1GczOKiIF9IACvLPe_HkEhqWvpI11FdbvhVe2kgzPYHTKjlb6xp6kxhpodAIM1CK4pNnj2gck_FModnxsSZGlLrgmjjofBKdvRxnuQnlxjmKxL4ghJfhjR=w600-h400-p-k" alt="start(6)" class="no-hover">
                                <img src="https://lh3.googleusercontent.com/pw/AP1GczM6iIeco-B7l4qlBJpigFhXkS_DUTEDBNd--xM-dRCojzhz2GsBXqHuF0VO2DvF9-YZe4OT9ZX4ds6XD0uI7QTC2jnQefSLRWpbyOKMSZWpLHOiQSVy=w600-h400-p-k" alt="start(7)" class="no-hover">
                                <img src="https://lh3.googleusercontent.com/pw/AP1GczPhy4NicWL_u7jExG-_9ooqqgzMMGMyYS3YIgThQv1i0OBSc2yjTmq6Y9QE0oniMZnrR2WpcDK_oQu2Jmp4kSH1kZ6olBsGBb5ODacG3_GA70z9mJcN=w600-h400-p-k" alt="start(8)" class="no-hover">
                                <img src="https://lh3.googleusercontent.com/pw/AP1GczN4ToZBPJQBsAlS0ED-1NmgzR8UBeRaZKZTfyaFmI3UmbwBpZLWh-W6qQVWNWFTG6YziCAZZVihBiKctKV8irnPizlyrGomUqj9FMka56kPVfbqeiIx=w600-h400-p-k" alt="start(9)" class="no-hover">
                                <img src="https://lh3.googleusercontent.com/pw/AP1GczNqMdjimsdim6aDPorTEz480NAl2NBRlR5Zho7zgdPlTK4K9cSnHREbZQrg058fkjyPV2x2yZu6eKKMsBQ5R2jJbhlZCI8ZkYUH8r5wXYcxl002KJNe=w600-h400-p-k" alt="start(10)" class="no-hover">
                                    <figcaption>▲ 從 Devonian Lagoon 開始騎，逆時針繞，沿途有大肥鴨、原住民圖騰、紀念品店，
                                        <br>還可以遠眺 Lions gate bridge 以及 Grouse Mountain，中間一段接 Beaver Lake 的地方切西瓜，
                                        <br>這半邊天氣好不得了，拍照都睜不開眼，接續來到天空步道，要往 Downtown Vancouvar 方向騎，過天空步道，另一邊開始起霧，沿途都霧茫茫的，接起點時才又出現太陽。</figcaption>
                        </figure>        
                </li>
                <li>
                    <p>下午是逛街行程，小憩後便前往布勒街、洛遜街一帶逛逛，這一趟本來就有預計去 Arc’teryx、Root，Arc’teryx Gortex 外套跟台灣價差約 $ 1,000 NTD，沒有差太多就沒買，Root 則是買了溫哥華限定款 T 恤跟帽 T 給家人。
                        在 Root 跟昀姐姐會合後，去星巴克買了城市杯，一起去 gass town 逛紀念品店，晚餐在唐人街的超市解決，但唐人街的環境有點可怕，如果是獨旅，建議不要晚上過去。 </p>                
                        <figure>        
                                <img src="https://lh3.googleusercontent.com/pw/AP1GczMFX6JN1cyFsVzv7vTctH2DxB3mqDNje9lT8g0f5cd_DW5BQBQ0nh_Q5IXuYq4sr1oDRoovuUJTLudmcl0KyrccIMHWMLHFhvTVLoJOwEr6HkYqk5_5=w600-h400-p-k" alt="溫哥華街景" class="no-hover">
                                <img src="https://lh3.googleusercontent.com/pw/AP1GczN6jDe_EpKvIr0aNbGX6X8Ugs5usfCiFbRZ_gTcmfAzhAMoWFrKf8mxmzcMOFcPmIplHdeHqOtKn8c0gJnMz0FKtgvigjWL7on3i49mIoSZqtPGyeRh=w600-h400-p-k" alt="Roots" class="no-hover">
                                    <figcaption>▲ 在黃刀追光第二晚就有點感冒，到溫哥華喉嚨超痛甚至沒聲音，騎完腳踏車就先去買藥，回飯店休息順便充手機，所以先跟昀姐姐分開各自逛，感謝這段時間昀姐姐捕捉的街景照、商店照。</figcaption>
                                <br><img src="https://lh3.googleusercontent.com/pw/AP1GczM47GXdgwXcLwVqedb5jgJ1Ukhi3PqVh5hlJ7Wo1K8YNaMSh0bgyIdyZs0fXs2X_QYB9uRjjETkcbGjn1ES18UWG_1N8eoXAoULL4wox_ZmxGPeXWEd=w600-h400-p-k" alt="唐人街" class="no-hover">
                                    <figcaption>▲ 唐人街的街景。</figcaption>
                        </figure>
                </li>
                <li>
                    <p>在溫哥華的第二天，11:00 check out 後，先把行李寄放在飯店，想說碰碰運氣去 Jam Cafe，看到那個排隊人潮便作罷，前往 Southbound Cambie St 搭車。
                        下午是先安排到 Granville island 晃晃，劃分服飾、市場等區域，商店很多元，有賣紀念品、服飾、糖果、酒等，我們到 Public Market 買了一碗 Fish 濃湯、酥皮濃湯，還有朋友推薦一定要吃的可麗露，悠閒坐在碼頭欣賞風景、表演及肥肥的海鷗（？）。
                        <br>大約 14:00 離開 Granville island，走去公車站搭車去 Yale town。先去 Roundhouse Community Arts & Recreation Centre 看加拿大太平洋鐵路 374 號蒸汽機車，人可以走上去還可以鳴笛，蠻有趣的，接著走去很有名的 Angus T Bakery 買可頌，
                        隔著透明玻璃看可頌的形成過程好療癒，我點了杏仁可頌，酥脆的口感加杏仁糖粉的鹹甜，好幸福啊~吃飽喝足，散步回飯店，拿好行李大約 17:00 準備前往機場 Outlet。
                    </p>
                        <figure>
                                <img src="https://lh3.googleusercontent.com/pw/AP1GczMk2MfoYkdi9d1EUM-banWv3Fqg77xxfR4A3ws0P8QQJfM72f_PRZxBujZt-gB5fGMEP5SHS60IMzYiYxQZSvW5LAokT0GSFgQvBIrHwJY6jT3gRftD=w600-h400-p-k" alt="溫哥華公車" class="no-hover">
                                    <figcaption>▲ 解鎖第一次在溫哥華搭公車，內裝跟嘉義 BRT 很像 XD。</figcaption>
                                <br><img src="https://lh3.googleusercontent.com/pw/AP1GczOuTNt9rmNdgCnS9JmGvvYgYoTnJ6vFvuh07CzqMZ6fve7o9RLjM7AJERgHmAMCHsOTjnY8I8cR6vlzhctC5raCHm_uZAUryIvb7jLcjZvn9NaI1YSD=w600-h400-p-k" alt="Granville island gate" class="no-hover">
                                <img src="https://lh3.googleusercontent.com/pw/AP1GczOcqUjyeC-eQbHJTOCpuq8EuD90fHBFPkNo1BhaLV__07J1Et_whTEcmN_cC-Oe5AWTarib1XWvScvsxPUjMY2bV5kcjas-YKVQCrVed1nXnaDHlCOZ=w600-h400-p-k" alt="Public market" class="no-hover">
                                <img src="https://lh3.googleusercontent.com/pw/AP1GczMHJ7TXPFLV1Cz09Iomr2xNLse1XwrGyd-HZIoG5zC38FsygHz2QE6QzxD4ka9sSP-XBeBV89nqDDwktAWNQlwqr2miBQVMuFM1QbOtSQA6vLvp-SZH=w600-h400-p-k" alt="濃湯" class="no-hover">
                                <img src="https://lh3.googleusercontent.com/pw/AP1GczMScpfddLN2wFEBW_dl_00gyunCz-J5MwlJzNPV7k4_MPzbRcgZ5JjOdHzQTGDsjy622FtYUk_MToVSg0YNebdg07A1-YalHlROh7a-GdB7tVFFy9B9=w600-h400-p-k"" alt="酥皮濃湯" class="no-hover">
                                    <figcaption>▲ 濃湯有三種口味，個人覺得口味偏鹹，但洋蔥味濃郁也看得到蔬菜渣，喝得出來燉煮很久。</figcaption>
                                <br><img src="https://lh3.googleusercontent.com/pw/AP1GczOWnxhsFw2w4m9-PXIX1w3feDyyq8AVwGUJNfAnADMv9MZwwch8G3RGl_eMYlT72YYWp6_CRmEUjBtBLxJ7i6HslDyTuDENYIXa1u8aLejQWSPVzd0t=w600-h400-p-k" alt="可麗露" class="no-hover">
                                <img src="https://lh3.googleusercontent.com/pw/AP1GczN6xq8dUsRbxrvai09a8VNbbtb095uYF5Kavv7fpa-fwgJY0pDJvk95vbh6El15kMIn5v6x1w2U_KPO6i9CUWjsWq97vL2aSmLWNIt_r2VAw1k6WJz2=w600-h400-p-k" alt="可麗露口味" class="no-hover">
                                    <figcaption>▲ 可麗露口味選擇很多，我點了檸檬口味，到碼頭想說幫可麗露拍張照，一拿高一隻海鷗迎面而來，一口咬住我的可麗露，大概奮鬥三秒我怕被牠強而有力的嘴鉗咬到，就放手了，於是只剩包裝紙與風景的合照... 不死心一定要吃到這間可麗露的我便去買了第二顆，這次學乖了，不給手機吃，直接塞進嘴巴。</figcaption>
                        </figure>
                </li>
                <li>
                    <p>此趟加拿大行最後一個行程又回到機場 Outlet 購物，比價後決定買 The North Face，補完貨 20:00 便前往機場，在上飛機前又去買了 JAPAGOG，到底奪愛哈哈哈。
                        <br>0:05 飛往香港的飛機，一上飛機吃完喉糖後便開睡，中間也是吃了兩餐飛機餐，於當地時間 3/3 6:35 抵達香港，中間在飛機上又吃了炒麵，大約 8:00 抵達台灣，結束了此趟追光之旅。
                        <br>這趟戰利品雖然不多，但身心靈得到很多滿足，回來再讀了一次<span style="color: red;">貝琪梨的《追逐，幻舞極光：貝琪梨的追光紀事》</span>有不同體悟，推薦給追光者們，祝大家都能追光成功★★★
                    </p>
                        <figure>
                                <img src="https://lh3.googleusercontent.com/pw/AP1GczPxoUtNHBUpmj95_WqucOyV0ul3vs-Yn729LH1gUD_FsLWPqsMVYEuxZSwk_2TCBM75_sb6dFyShrn6pBCAJI0EuuzQp4VzuyAnkzXIk8yYaMg9CkXF=w600-h400-p-k" alt="戰利品" class="no-hover">
                                    <figcaption>▲ 用此趟的戰利品結束這回合。</figcaption>
                        </figure>
                </li>
            </ul>
        </section>
    </article>


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
        // 3. 讀取留言：只抓出這篇文章的內容
        $sql_select = "SELECT * FROM guestbook WHERE post_id = 'yellowknief' ORDER BY id DESC"; 
        $result = mysqli_query($conn, $sql_select);

        if ($result && mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                echo "<div class='comment-item'>";
                echo "<div class='comment-info'>";
                echo "<span class='comment-name'>" . htmlspecialchars($row['name']) . "</span> ";
                
                // 【修正點 2】確保名稱與 Railway 欄位名稱 created_at 一致
                $time_display = !empty($row['created_at']) ? $row['created_at'] : "時間不詳";
                
                echo "於 " . $time_display . " 留言：";
                echo "</div>";
                echo "<div class='comment-text'>" . nl2br(htmlspecialchars($row['content'])) . "</div>";
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
