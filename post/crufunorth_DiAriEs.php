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
    $sql_insert = "INSERT INTO `guestbook` (post_id, name, content, created_at) VALUES ('crufunorth', '$name', '$content', '$current_time')";

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
    <title>2026 CRUFU RUN 北台灣站 - 👧DiAriEs</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../style.css">
</head>
<body>

    <header class="nav-bar">
        <a href="../index.php"><span>←</span> 返回 DiAriEs</a>
    </header>

    <article class="content-container">
        <img src="https://lh3.googleusercontent.com/pw/AP1GczOlZB-QH9GavRWw3rHb79jTA-47u9Hq8mIQ1a3YpLhIZu0zt7wMLD0vXrSP6RRjNMPVx31t_zng38N__Fwh4QkST5vTLceJrn0CsKrj7zhE-q50uRWy=w1300-h1000-p-k" alt="CRUFU RUN" class="hero-img">

        <h1>挑戰拚一個台灣第三站｜2026 夸父追日北台灣站 從蘇澳跑到淡水 熱累盈眶！</h1>
        <div class="post-meta">
            📅 日期：2026/4/11-4/12 | 👤 作者：ㄚ純
        </div>

        <div class="gear-box">
            <h3>目錄 Table of Contents</h3>
            <ul class="toc-list">
                <li><a href="#intro">一、賽事簡介</a></li>
                <li><a href="#plan">二、行前規劃</a></li> 
                <li><a href="#actual-trip">三、實際行程紀錄</a></li>
            </ul>
        </div>

        <section class="trip-section">
            <h3 id="intro">一、 賽事簡介</h3>
            <p>2026 夸父追日北台灣站是第七屆 CRUFU RUN 系列賽事的第二場，起點是宜蘭蘇澳的武荖坑風景區，終點是新北淡水漁人碼頭，總長約 210 km，路線<a href="https://www.google.com/maps/d/u/0/viewer?hl=en&mid=14B20fqLkgBoQm_a_WkC3HHTKhhU&ll=24.943945291756176%2C121.70586499999997&z=9" target="_blank">點我看</a>。<br>
                <br>組別有 1 人組、2 人組、5 人組以及 10 人組，我們是報 10 人組，會拆成兩台車 CAR1、CAR2 移動，1 Round 一台車 5 人輪流接力，共跑 6 Round 總共 30 棒，<span style="color: red; font-weight: bold;">一人跑 3 棒，一棒大約 7 k</span>。<br>
                <br>有鑑上次南夸 CAR1 、CAR2 連跑 3 Round 模式（也就是111222），跑日棒的隊友們跑到快中暑，夜棒也是體力消耗殆盡，這次改跑 112212 模式，保留讓兩車有充分休息的時間，也讓日、夜棒能平均分配。
            </p>

            <h3 id="plan">二、 行前規劃</h3>
            <p><strong>※ 賽事開始日為 T</strong></p>
            <div class="trip-table-wrapper">
                <table class="trip-table">
                    <thead class="column-header">
                        <tr>
                            <th style="width: 15%;">預計時間</th>
                            <th style="width: 15%; text-align: left;">項目</th>
                            <th style="width: 70%; text-align: left;">備註</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="padding: 15px; line-height: 2; vertical-align: middle; font-weight: normal;">
                            T-6 個月
                            </td>
                            <td style="padding: 15px; line-height: 2; vertical-align: middle;">
                            報名
                            </td>
                            <td style="padding: 15px; line-height: 2; vertical-align: middle; word-break: break-word;">
                            1. 隊長到活動報名網頁創一個隊伍，隊員先填自己，再把報名連結分享給隊友們各自填資料<span style="color: red; font-weight: bold;">（建議用這個方式較方便）</span><br>
                            2. 建一個隊友資訊的 Google sheet，由隊長統一報名
                            </td>
                        </tr>
                        <tr>
                            <td class="time-cell">T-2 個月
                            </td>
                            <td style="padding: 15px; line-height: 2; vertical-align: middle; text-align: left;">官方行前線上說明會+活動資訊給隊友們
                            </td>
                            <td style="padding: 15px; line-height: 2; vertical-align: middle; text-align: justify; word-break: break-word;">
                                隊長上線即可，若有隊員想一同上線，一隊以 3 人為限，不然怕影響會議品質
                            </td>
                        </tr>
                        <tr>
                            <td class="time-cell">T-2 個月
                            </td>
                            <td style="padding: 15px; line-height: 2; vertical-align: middle; text-align: left;">組內調查問卷
                            </td>
                            <td style="padding: 15px; line-height: 2; vertical-align: middle; text-align: justify; word-break: break-word;">
                                這是我們的習慣，主要會調查大家賽前一天的住宿、抵達時間跟偏好的棒次等等，問卷內容長這樣，<a href="https://forms.gle/ZYZyJpWRqGWs1P5L8" target="_blank">請點我看</a>
                                <br>（順便看看大家是不是都在狀況內 XD）
                            </td>
                        </tr>
                        <tr>
                            <td class="time-cell">T-1.5 個月
                            </td>
                            <td style="padding: 15px; line-height: 2; vertical-align: middle; text-align: left;">訂 D0、D1 住宿、租車
                            </td>
                            <td style="padding: 15px; line-height: 2; vertical-align: middle; text-align: justify; word-break: break-word;">
                                依之前經驗，報名後便可開始找住宿，住宿通常很快就額滿
                            </td>
                        </tr>
                        <tr>
                            <td class="time-cell">T-1.5 個月
                            </td>
                            <td style="padding: 15px; line-height: 2; vertical-align: middle; text-align: left;">繳交棒次表給大會
                            </td>
                            <td style="padding: 15px; line-height: 2; vertical-align: middle; text-align: justify; word-break: break-word;">
                                1. 回填線上 Google 表單，有調整的話再重填一次，大會會抓最新一筆<span style="color: red; font-weight: bold;">（建議用這個方式較方便）</span>
                                <br>2. 下載空白棒次表寄信給大會
                            </td>
                        </tr>
                        <tr>
                            <td class="time-cell">T-1 個月
                            </td>
                            <td style="padding: 15px; line-height: 2; vertical-align: middle; text-align: left;">組內行前會
                            </td>
                            <td style="padding: 15px; line-height: 2; vertical-align: middle; text-align: justify; word-break: break-word;">
                                1. 確認待辦事項，包含 D0 集合時間地點、住宿、交通、必備物品分配、沖澡區、慶功宴餐廳等等
                                <br>2. 賽事重點提醒
                            </td>
                        </tr>
                        <tr>
                            <td class="time-cell">T-2 週
                            </td>
                            <td style="padding: 15px; line-height: 2; vertical-align: middle; text-align: left;">確認是否收到大會郵寄物資
                            </td>
                            <td style="padding: 15px; line-height: 2; vertical-align: middle; text-align: justify; word-break: break-word;">
                                1. 衣服、毛巾/包包、實體手冊會先用郵寄方式寄出，建議收件地址以離會場近或有車可載的隊友代收
                                <br>2. 其他補給物資通常在賽事前一天便會開放至會場領取
                                <br>（資訊以官方公告為主）
                            </td>
                        </tr>
                        <tr>
                            <td class="time-cell">T-1 天
                            </td>
                            <td style="padding: 15px; line-height: 2; vertical-align: middle; text-align: left;">至會場領取補給物資
                            </td>
                            <td style="padding: 15px; line-height: 2; vertical-align: middle; text-align: justify; word-break: break-word;">
                                通常會有 2 箱礦泉水、2 箱運動飲料、2 包餅乾、2 串香蕉、10 張選手號碼布、4 張車貼、紋身貼紙、10 張餐券
                                <br><span style="color: red; font-weight: bold;">（建議前一天就先過去領，賽事當天才不會手忙腳亂）</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="time-cell">T
                            </td>
                            <td style="padding: 15px; line-height: 2; vertical-align: middle; text-align: left;">賽事DD
                            </td>
                            <td style="padding: 15px; line-height: 2; vertical-align: middle; text-align: justify; word-break: break-word;">
                                1. 確認開跑梯次，並提前 40 分至會場，開跑前大會會幫忙拍團體照
                                <br>2. 開跑後就靠隊友們凱瑞惹
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <h3 id="actual-trip">三、 實際行程紀錄</h3>
                <p style="background: #f1f8f1; padding: 15px; border-radius: 8px; line-height: 1.8; color: #333;">
                    <span style="display: flex;">
                        <span style="white-space: nowrap;">👤 <strong>成員：</strong></span>
                        <span>
                            CAR1 ㄚ純、Emma、達哥、陳律、Hugo<br>
                            CAR2 Spncer、Amber、Lion、Sam、小萬，共 10 人
                        </span>
                    </span>
                    <span>👣 <strong>總距離：</strong>210 k</span><br>
                    <span>⌚ <strong>總時間：</strong>32:32:32</span>
                </p>

            <div class="actual-trip-details">
                <div class="trip-table-wrapper" style="margin-bottom: 40px;">
                    <h4 style="border-left: 5px solid #2e7d32; padding-left: 10px; color: #2e7d32; margin-bottom: 15px;">
                        🚩 第01 - 10 棒 (蘇澳 ➔ 福隆)
                    </h4>
                    <table class="trip-table">
                        <thead>
                            <tr class="column-header">
								<th style="width: 10%;">棒次</th>
					            <th style="width: 10%;">距離</th>
					            <th style="width: 10%;">升降</th>
					            <th style="width: 15%;">選手</th>
					            <th style="width: 15%;">時間</th>
					            <th style="width: 40%;">地點</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr><td>01</td><td>6.7 k</td><td>+67/-87</td><td>陳律</td><td>04/11<br>04:30</td><td>宜蘭蘇澳武荖坑</td></tr>
                            <tr><td>02</td><td>7.7 k</td><td>+23/-29</td><td>ㄚ純</td><td></td><td></td></tr>
                            <tr><td>03</td><td>6.6 k</td><td>+19/-199</td><td>Emma</td><td></td><td></td></tr>
                            <tr><td>04</td><td>7.1 k</td><td>+24/-25</td><td>Hugo</td><td></td><td></td></tr>
                            <tr><td>05</td><td>6.2 k</td><td>+37/-36</td><td>達哥</td><td>07:22</td><td>宜蘭頭城</td></tr>
                            <tr><td>06</td><td>6.2 k</td><td>+38/-36</td><td>陳律</td><td>08:19</td><td>宜蘭頭城</td></tr>
                            <tr><td>07</td><td>6.2 k</td><td>+39/-39</td><td>Emma</td><td></td><td></td></tr>
                            <tr><td>08</td><td>7.2 k</td><td>+67/-49</td><td>ㄚ純</td><td></td><td></td></tr>
                            <tr><td>09</td><td>6.8 k</td><td>+82/-81</td><td>達哥</td><td></td><td></td></tr>
                            <tr><td>10</td><td>8.2 k</td><td>+75/-96</td><td>Hugo</td><td>11:32-12:23</td><td>新北福隆</td></tr>
                        </tbody>
                    </table>
                </div>

                <div class="trip-table-wrapper" style="margin-bottom: 40px;">
                    <h4 style="border-left: 5px solid #2e7d32; padding-left: 10px; color: #2e7d32; margin-bottom: 15px;">
                        🚩 第11 - 20 棒 (福隆 ➔ 金山)
                    </h4>
                    <table class="trip-table">
                        <thead>
                            <tr class="column-header">
                                <th>棒次</th><th>距離</th><th>升降</th><th>選手</th><th>時間</th><th>地點</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr><td>11</td><td>7.4 k</td><td>+108/-94</td><td>Lion</td><td>13:02</td><td>新北福隆</td></tr>
                            <tr><td>12</td><td>6.4 k</td><td>+112/-43</td><td>Spencer</td><td></td><td></td></tr>
                            <tr><td>13</td><td>6.6 k</td><td>+355/-188</td><td>小萬</td><td></td><td></td></tr>
                            <tr><td>14</td><td>8.2 k</td><td>+107/-303</td><td>Sam</td><td></td><td></td></tr>
                            <tr><td>15</td><td>6.7 k</td><td>+66/-107</td><td>Amber</td><td>16:22-17:05</td><td>基隆八斗子</td></tr>
                            <tr><td>16</td><td>5.4 k</td><td>+87/-85</td><td>Lion</td><td>18:22</td><td>基隆八斗子</td></tr>
                            <tr><td>17</td><td>6.7 k</td><td>+97/-90</td><td>小萬</td><td></td><td></td></tr>
                            <tr><td>18</td><td>7.3 k</td><td>+98/-107</td><td>Sam</td><td></td><td></td></tr>
                            <tr><td>19</td><td>6.6 k</td><td>+208/-39</td><td>Spencer</td><td></td><td></td></tr>
                            <tr><td>20</td><td>7.1 k</td><td>+106/-286</td><td>Amber</td><td>20:29</td><td>新北金山</td></tr>
                        </tbody>
                    </table>
                </div>

                <div class="trip-table-wrapper" style="margin-bottom: 40px;">
                    <h4 style="border-left: 5px solid #2e7d32; padding-left: 10px; color: #2e7d32; margin-bottom: 15px;">
                        🚩 第21 - 30 棒 (金山 ➔ 淡水)
                    </h4>
                    <table class="trip-table">
                        <thead>
                            <tr class="column-header">
                                <th>棒次</th><th>距離</th><th>升降</th><th>選手</th><th>時間</th><th>地點</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr><td>21</td><td>6.6 k</td><td>+102/-41</td><td>ㄚ純</td><td>23:58</td><td>新北金山</td></tr>
                            <tr><td>22</td><td>6.9 k</td><td>+284/-102</td><td>Hugo</td><td>04/12<br>00:58</td><td></td></tr>
                            <tr><td>23</td><td>7.6 k</td><td>+64/-306</td><td>陳律</td><td></td><td></td></tr>
                            <tr><td>24</td><td>7.0 k</td><td>+295/-50</td><td>達哥</td><td></td><td></td></tr>
                            <tr><td>25</td><td>7.1 k</td><td>+50/-292</td><td>Emma</td><td>03:37-04:38</td><td>新北石門</td></tr>
                            <tr><td>26</td><td>7.0 k</td><td>+95/-98</td><td>小萬</td><td>05:12</td><td>新北石門</td></tr>
                            <tr><td>27</td><td>7.6 k</td><td>+319/-11</td><td>Sam</td><td></td><td></td></tr>
                            <tr><td>28</td><td>6.7 k</td><td>+4/-314</td><td>Spencer</td><td></td><td></td></tr>
                            <tr><td>29</td><td>8.7 k</td><td>+121/-85</td><td>Lion</td><td></td><td></td></tr>
                            <tr><td>30</td><td>5.4 k</td><td>+19/-51</td><td>Amber</td><td>10:00</td><td>新北淡水魚人碼頭</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>


        <!--三個表格併排 <div class="tables-parallel-container" style="display: flex; gap: 20px; overflow-x: auto;">
            
            <div class="trip-table-wrapper" style="flex: 1; min-width: 400px;">
                <table class="trip-table">
                    <thead>
                        <tr class="column-header">
                            <th>棒次</th><th>距離</th><th>升降</th><th>選手</th><th>時間</th><th>地點</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr><td>01</td><td>6.7 k</td><td>+67/-87</td><td>陳律</td><td>04:30</td><td>宜蘭蘇澳武荖坑</td></tr>
                        <tr><td>02</td><td>7.7 k</td><td>+23/-29</td><td>ㄚ純</td><td></td><td></td></tr>
                        <tr><td>03</td><td>6.6 k</td><td>+19/-199</td><td>Emma</td><td></td><td></td></tr>
                        <tr><td>04</td><td>7.1 k</td><td>+24/-25</td><td>Hugo</td><td></td><td></td></tr>
                        <tr><td>05</td><td>6.2 k</td><td>+37/-36</td><td>達哥</td><td>4/11 7:22</td><td>宜蘭頭城</td></tr>
                        <tr><td>06</td><td>6.2 k</td><td>+38/-36</td><td>陳律</td><td>4/11 8:19</td><td>宜蘭頭城</td></tr>
                        <tr><td>07</td><td>6.2 k</td><td>+39/-39</td><td>Emma</td><td></td><td></td></tr>
                        <tr><td>08</td><td>7.2 k</td><td>+67/-49</td><td>ㄚ純</td><td></td><td></td></tr>
                        <tr><td>09</td><td>6.8 k</td><td>+82/-81</td><td>達哥</td><td></td><td></td></tr>
                        <tr><td>10</td><td>8.2 k</td><td>+75/-96</td><td>Hugo</td><td>11:32-12:23</td><td>新北福隆</td></tr>
                    </tbody>
                </table>
            </div>

            <div class="trip-table-wrapper" style="flex: 1; min-width: 400px;">
                <table class="trip-table">
                    <thead>
                        <tr class="column-header">
                            <th>棒次</th><th>距離</th><th>升降</th><th>選手</th><th>時間</th><th>地點</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr><td>11</td><td>7.4 k</td><td>+108/-94</td><td>Lion</td><td>13:02</td><td>新北福隆</td></tr>
                        <tr><td>12</td><td>6.4 k</td><td>+112/-43</td><td>Spencer</td><td></td><td></td></tr>
                        <tr><td>13</td><td>6.6 k</td><td>+355/-188</td><td>小萬</td><td></td><td></td></tr>
                        <tr><td>14</td><td>8.2 k</td><td>+107/-303</td><td>Sam</td><td></td><td></td></tr>
                        <tr><td>15</td><td>6.7 k</td><td>+66/-107</td><td>Amber</td><td>16:22-17:05</td><td>基隆八斗子</td></tr>
                        <tr><td>16</td><td>5.4 k</td><td>+87/-85</td><td>Lion</td><td>18:22</td><td>基隆八斗子</td></tr>
                        <tr><td>17</td><td>6.7 k</td><td>+97/-90</td><td>小萬</td><td></td><td></td></tr>
                        <tr><td>18</td><td>7.3 k</td><td>+98/-107</td><td>Sam</td><td></td><td></td></tr>
                        <tr><td>19</td><td>6.6 k</td><td>+208/-39</td><td>Spencer</td><td></td><td></td></tr>
                        <tr><td>20</td><td>7.1 k</td><td>+106/-286</td><td>Amber</td><td>20:29</td><td>新北金山</td></tr>
                    </tbody>
                </table>
            </div>
            <div class="trip-table-wrapper" style="flex: 1; min-width: 400px;">
                <table class="trip-table">
                    <thead>
                        <tr class="column-header">
                            <th>棒次</th><th>距離</th><th>升降</th><th>選手</th><th>時間</th><th>地點</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr><td>21</td><td>6.6 k</td><td>+102/-41</td><td>ㄚ純</td><td>23:58</td><td>新北金山</td></tr>
                        <tr><td>22</td><td>6.9 k</td><td>+284/-102</td><td>Hugo</td><td>4/12 00:58</td><td></td></tr>
                        <tr><td>23</td><td>7.6 k</td><td>+64/-306</td><td>陳律</td><td></td><td></td></tr>
                        <tr><td>24</td><td>7.0 k</td><td>+295/-50</td><td>達哥</td><td></td><td></td></tr>
                        <tr><td>25</td><td>7.1 k</td><td>+50/-292</td><td>Emma</td><td>03:37-04:38</td><td>新北石門</td></tr>
                        <tr><td>26</td><td>7.0 k</td><td>+95/-98</td><td>小萬</td><td>05:12</td><td>新北石門</td></tr>
                        <tr><td>27</td><td>7.6 k</td><td>+319/-11</td><td>Sam</td><td></td><td></td></tr>
                        <tr><td>28</td><td>6.7 k</td><td>+4/-314</td><td>Spencer</td><td></td><td></td></tr>
                        <tr><td>29</td><td>8.7 k</td><td>+121/-85</td><td>Lion</td><td></td><td></td></tr>
                        <tr><td>30</td><td>5.4 k</td><td>+19/-51</td><td>Amber</td><td>10:00</td><td>新北淡水魚人碼頭</td></tr>
                    </tbody>
                </table>
            </div>
        </div> -->

            <ul class="timeline-list">
                <li>
                    <p><strong>04/10 19:30 陸續抵達民宿。</strong>
                    <br>由於我們是 04/11 4:30 起跑梯次，所以前一晚就先訂了武荖坑附近的民宿。<br>
                    民宿大概在行前會開完就開始找，打了三間都被訂完，意外接到一通電話，老闆娘說還有另一棟<a href="https://maps.app.goo.gl/QAJbAnZzWKBJChBV6" target="_blank">愛幸福小棧</a>可優先留給我們，包棟 5,600 元，這麼佛的價格先答應再說。
                    </br>房間配置是一間 5 人房、3 人房以及 2 人房，後來老闆娘還有在 5 人房幫我們加床，整體空間寬敞、乾淨，女生們住 3 人房，兩張床床頭都有插頭，浴室有提供沐浴乳、洗髮精，還有一個小冰箱，床躺起來蠻舒服的，大概 23:30 大家已躺平。
                    </p>
                </li>
                
                <li>
                    <p><strong> 04/11 02:50 起床，03:30 集合準備前往會場。</strong>
                        <br>因為出發梯次算早，到會場時還沒有什麼人潮，移動動線、停車還算順利。
                        <br>兩車集合後，開始在會場東拍西拍，這次團隊有很多台大砲跟相機，真的都是大片~還蹭了幾張大會攝影師的團體照。
                        <br>很快就叫到 1036，我們大概 04:20 就拍完官方的拱門大合照，不過這次只拍了兩張（之前會拍三張），最後看官方相簿甚至只有一張，難怪這次沒讓我們選放在證書的照片QQ
                        <br>等待起跑的第一棒先來著裝，<span style="color: red; font-weight: bold;"> 大會規定 7:00 前、17:00 後都需要穿反光背心、頭燈跟尾燈 </span>，也可以再備一個會發光的東西在身上喔~
                        <br>趁著空檔也來認識一下新隊友，發現大家都是大 E 人呢，偷偷在旁邊觀察大家的互動也蠻有趣 XD
                    </p>
                    <img src="https://lh3.googleusercontent.com/pw/AP1GczOqo0VBEeMXic_dkhODjza3pEOFCMgEXYqpzWBtxd2knYrD_vTEIywsnMmjqVzn8HiXjET8C1xDuSdxmRHM122UeL3G_iczmxT5v0YoTM2T-YhqUgY-=w1300-h1000-p-k" alt="會場環境1" class="no-hover">
                    <img src="https://lh3.googleusercontent.com/pw/AP1GczNHYefZMYX-w0sH8O1F7MqQVfUTII3pI3zM0KqZM8s6APZzsqLk2FIqYGRGEXJCEn_7xScZrENCk2L5-rZ1aRHnu16IQOJPrH-rsuwjzs1_4R66sIh_=w1200-h1000-p-k" alt="會場環境2" class="no-hover">
                    <img src="https://lh3.googleusercontent.com/pw/AP1GczM5nLmKXQEajDVkXDrbRC50gMKVXQaVBYBEhE9DaF5UwRErypdHHv0KerNPT0IFnyn-hFqnD4ED-nztwf0MxGDPJyCRHMtu2NwV9WMKLMFbIdkEiU8M=w1200-h1000-p-k" alt="會場團照" class="no-hover">
                    <figure> 
                        <img src="https://lh3.googleusercontent.com/pw/AP1GczOlZB-QH9GavRWw3rHb79jTA-47u9Hq8mIQ1a3YpLhIZu0zt7wMLD0vXrSP6RRjNMPVx31t_zng38N__Fwh4QkST5vTLceJrn0CsKrj7zhE-q50uRWy=w1200-h600-p-k" alt="會場拱門起跑照" class="no-hover">
                        <figcaption>▲ 會場代表 CRUFU RUN 的背板、裝飾都很值得拍，還有大會攝影師幫拍的合照以及拱門合照，也是這次唯一的官方起跑團體照 QQ</figcaption>
                    </figure>
                </li>

                <li>
                    <p><strong>04:30 第一棒出花。</strong>
                        <br>因為我在 CAR1，所以接下來的紀錄以 CAR1 為主，主要也是 CAR2 奮戰的時候我們都在補眠 XD
                        <br>第一棒都還在蘇澳，想說在上天橋前幫陳律補給，結果遠遠看都沒亮光，原來是太熱把頭燈摘了...爬完很喘的樓梯後很快就來到第一接力區。
                    </p>
                <figure> 
                    <img src="https://lh3.googleusercontent.com/pw/AP1GczNyRtlSWcsg6Ilm2fljcMwbSX6tQGS0kbdCTQRB4IRFHh5bWiJiH_JKyU1OqcWwuliHe8VzLkmsbRzkCx64TC3TPKENr4hEgH_xoykbJNch0-bx8Gji=w1200-h1000-p-k" alt="第一接力區">
                    <figcaption>▲ 交給第二棒ㄚ純。</figcaption>
                </figure>
                </li>

                <li>
                    <p><strong>05:18 第二棒出花</strong>。
                        <br>印象中就是緊跟一位肌肉男，因為停下來補給，肌肉男就不見了...開始靠皮克敏 & 隊友的精神幹話撐下去，還不知道從哪生出喇叭。
                        <br>太陽還沒升起，整段跑起來蠻舒服的，意外跑出 5:27 配速，雖然體感還好也能講話但回頭看心率還是飆到 Zone 4。
                <figure> 
                    <img src="https://lh3.googleusercontent.com/pw/AP1GczOnWV30HyUs3VwL4k2l_qPrycXkBmDxjGgMO5H5JKJYLUQ7FwLPnkQLy9PXMf2sfoAiuIVpXbMZT3StAy804EuYevmQBAShK3UDqCUB-LJtrLm7KdpG=w1200-h1000-p-k" alt="第二接力區">
                    <figcaption>▲ 交給第三棒 Emma。</figcaption>
                </figure>
                </li>

                <li>
                    <p><strong>06:00 第三棒出花</strong>。
                        <br>Emma 開始盡情種花，行前一直打預防針說她跑不快，沒關係那就讓大家一起慢：）
                        <br>陳律出的鬼點子，霹靂卡霹靂拉拉波波莉娜卡皮巴拉，直接請各位跑友吹泡泡，跑得氣喘吁吁還要吹泡泡，這招真狠，意外地跑友們很配合，還有人錯過後繞回來吹一口，在一旁真的笑到歪掉 XD
                    </p>
                    <figure>
                    <img src="https://lh3.googleusercontent.com/pw/AP1GczMOK-5a86pUA87bysrgoZcGEPrstFwu6ozGl8GfXGrWFA9fuV6YRvFvkylZClY2QMFRip-e6PDQYfwG-6YSXWjbSLH11Tn1Q2upeS-VxwrzQQYIKfTZ=w1200-h1000-p-k" alt="Emma 玩泡泡">
                    <figcaption>▲ 聰明如 Emma，不用吹的用撥的 XD。</figcaption>
                    </figure>
                    <figure>
                    <img src="https://lh3.googleusercontent.com/pw/AP1GczOp5brqTEhHYNnK-HMCBxnj6OeOAzsO92TN7W4hyUK7zu9iXGLY9ctXHK2DzDx7gN_z7e5NENGkn6TcUqLVnsJbzTtj2PqO6dnOOCBZuURgRmt_mHTM=w1200-h1000-p-k" alt="跑友吹泡泡">
                    <figcaption>▲ 跑過頭還掉頭回來吹泡泡的跑友，重點人家跑的是 5 人組...完全 Respect。</figcaption>
                    </figure>
                    <figure>
                    <img src="https://lh3.googleusercontent.com/pw/AP1GczPouJr0zc5FzzH-1DrwKr6VOkj6m9g7Nub7snKtYDbDl7ES_oLiblBuRbUQGcGTwoaKj68AOSr35X2dh4lISoFy-VEin0ALf11eYgQqKnHpRSOtbjv7=w1200-h1000-p-k" alt="第三接力區">
                    <figcaption>▲ 交給第四棒 Hugo。竟然沒拍到交接照，只能用拍拍尺代替。</figcaption>
                    </figure>
                </li>

                <li>
                    <p><strong>06:45 第四棒出花</strong>。
                        <br>根本跟火箭一樣，完全看不到車尾燈，陳律還開玩笑說我們在玩尋找 Hugo 遊戲。
                        <br>這一棒跑太快，補給車追不上，在車上太無聊只能猛傳大便貼圖攻擊，順帶一提我們是下載<a href="https://apps.apple.com/tw/app/whoo-%E9%81%87%E8%A6%8B%E4%BD%A0%E7%9A%84%E5%A5%BD%E5%8F%8B/id6444837964" target="_blank"> whoo APP </a>，可以<span style="color: red; font-weight: bold;">看隊友定位</span>，也可以適時的傳貼圖鼓勵^^
                    </p>
                    <figure>
                    <img src="https://lh3.googleusercontent.com/pw/AP1GczNA_WMR_V6x1KsCtFAY_FeJg0DlYa3DbS5yxMMpuRoZnYibkaSDvkeA965n7BYcPoDAJj6S7qBEwVI12olOkSdqRVWVY2JfzzkXvghHqFV3GQsKmrOo=w1200-h1000-p-k" alt="大便貼圖攻擊">
                    <figcaption>▲ 滿滿的大便貼圖攻擊。</figcaption>    
                    </figure>
                    <figure>
                    <img src="https://lh3.googleusercontent.com/pw/AP1GczOMRCMATog94SWgmkT6tSc-u_k3NnIrIo6gRo4VlaH-3Bj8aD5nBjgK9-OlSgLdEaWEXoOs0x5BLm2U2d5MQWXYB8NTBANj0dqPgGqQ2lmG7NfBEiU3=w1200-h1000-p-k" alt="第四接力區">
                    <figcaption>▲ 交給第五棒達哥，第 1 Round 要結束囉。</figcaption>
                    </figure>
                </li>

                <li>
                    <p><strong>07:22 第五棒出花</strong>。
                        <br>達哥路上巧遇朋朋，邊跑邊聊天跑得很愜意，不得不說達哥真的是社交大王，不管走到哪都有認識的人。
                        <br>第 1 Round Done！再來是眾所期待的達哥出汁秀，雖然上次南夸見識過了，現場再看一次還是很震撼，滿滿的濃縮原汁（太震撼就不附圖ㄌ）。
                    </p>
                    <figure>
                    <img src="https://lh3.googleusercontent.com/pw/AP1GczNvrPRqVQgXh2A-296Ybulra3F5jZDZpRh9IEE0MHTvpVsJWWgrGFnerPMoZNQVXugrsk1S8v42IEcQ1SZXwBtuH9gnGOViHB5-frXY5P3naDVP1LJe=w1200-h1000-p-k" alt="達哥與朋朋">
                    <figcaption>▲ 跟朋朋邊跑邊聊天的達哥。</figcaption>    
                    </figure>
                    <figure>
                    <img src="https://lh3.googleusercontent.com/pw/AP1GczPAnBAE7dA6wM2i0SmO2pkqM2Bd9LZenG8mE4203DAhIMA6s8TVVB0kWOYw-XMw2nTESz-Cnjug57Tbl4ddK3HVV0AXPswaVQwKqHwcLu7H3iNBK5wv=w1200-h1000-p-k" alt="第五接力區">
                    <figcaption>▲ 交給第六棒陳律。</figcaption>
                    </figure>
                </li>

                <li>
                    <p><strong>08:19 第六棒出花</strong>。
                        <br>太陽出來了，接下來的路段肯定很難熬，必須瘋狂<span style="color: red; font-weight: bold;"></span>幫隊友補水降溫</span>。
                        <br>陳律中間走了一小段，最後跟著妹子一起跑回來，還在第七接力區巧遇高中同學，高中同學是妹子的隊友，同隊的竟然還有悅悅欲試！！直接變粉絲見面會~
                    </p>
                    <figure>
                    <img src="https://lh3.googleusercontent.com/pw/AP1GczOy6ZoF_0u318qzQ7PZPDVtXivHrH-DsIrG6IR6jNLXEp03gYTjDxRdu5NUxXciaigYvmu8IGWa35Yr3Egb4HIw9iQej_JoN6aI30HhMj6cf1d2syd2=w1200-h1000-p-k" alt="陳律與朋朋">
                    <figcaption>▲ 粉絲見面會。</figcaption>    
                    </figure>
                    <figure>
                    <img src="https://lh3.googleusercontent.com/pw/AP1GczNkXsIS5oq_kTQHxcrog8QB_2GPOYXKJtq9q-bfI5DDUByH3Y7CAqbwSqZ79vQ-1X-fIJQwR4n96w2kRu_M3ZbPsvGycXYSOBcXKZVDdB-y9brD_esx=w1200-h1000-p-k" alt="第六接力區">
                    <figcaption>▲ 交給第七棒 Emma。</figcaption>
                    </figure>
                </li>

                <li>
                    <p><strong>09:00 第七棒出花</strong>。
                        <br>這次防曬做最足非 Emma 莫屬，整個包得密不透風 XD 但在烈日摧殘下還是跑到鞋底快起火。
                        <br>後面一小段跟著 Emma 跑，路人也幫忙信心喊話，終於來到第七接力區，趁隊友還沒來先幫 Emma 拍張與海的合照。
                    </p>
                    <figure>
                    <img src="https://lh3.googleusercontent.com/pw/AP1GczPISV_RvwifbpllwDSDhcisgHCRDz4FxcqFGd3UGxuufgCxms8vj8wGLmuwpIeHGkJszjswWg-esmDIbQ1zwQJt-tXLkoNmfL0MnMFNOPCeVrfyoE6o=w1200-h1000-p-k" alt="光腳 Emma">
                    <figcaption>▲ 跑完馬上脫鞋的 Emma。</figcaption>
                    </figure>
                    <figure>
                    <img src="https://lh3.googleusercontent.com/pw/AP1GczNcjyIg9gH4LLl8ZBvySG3Mxbwuz47dPwINdYoZ_bSsegTMmrSIVrlKOqdcHpFtrdooBl3IDN7crwCTD6AexxPd2L4s4yofvGdw4DpZB9KMTQ4HaBCC=w1200-h1000-p-k" alt="第七接力區">
                    <figcaption>▲ 交給第八棒 ㄚ純。</figcaption>
                    </figure>
                </li>

                <li>
                    <p><strong>09:55 第八棒出花</strong>。
                        <br>熱到花轟，灑水器水花太小，直接拿冰水往自己身上灑。最後一段階梯爬完，第八棒結束哩。
                    </p>
                    <figure>
                    <img src="https://lh3.googleusercontent.com/pw/AP1GczO7vRya2ZC9VG5Z9Jv61BEyW7vrTbwHMCIxMHn3RJQGCNoiQHO6DGp0zZsWyGQiL65DYLxF5pTvNRqOT8HbfIvdapspI8fYEeGMR3c-h4P8zYzSJRXw=w1200-h1000-p-k" alt="身體補給中">
                    <figcaption>▲ 身體補水中。</figcaption>
                    </figure>
                    <figure>
                    <img src="https://lh3.googleusercontent.com/pw/AP1GczOJoU8eOYBZ2kNwoZmKEZ5xtKJBMX6oEVg4ZbkhQx0gAA-KZOiG8h241VwDuATY4BS9VFwZ66pdxP8vJTeMzsk8yOTOkIAKFyZCQGQJLCUFsburMnd6=w1200-h1000-p-k" alt="第八接力區">
                    <figcaption>▲ 交給第九棒達哥。</figcaption>
                    </figure>
                </li>

                <li>
                    <p><strong>10:37 第九棒出花</strong>。
                        <br>沿途幾乎沒遮蔭，還有人車共道，車子是腳踏車 XD 不難想像達哥跑完會有多溼：）
                    </p>
                    <figure>
                    <img src="https://lh3.googleusercontent.com/pw/AP1GczMr3JKw_Vek0NhBM3Adb2ovcr8_-uGHXSUVQEBVBzC_TlZuoFwgVb54ZhT36ozGQvw-5YIIep9527hZDKxvszC-WjedlGkpnvBcLvCeEvj_6mkt0tYk=w1200-h1000-p-k" alt="人比車快">
                    <figcaption>▲ 比腳踏車還快的男人。</figcaption>
                    </figure>
                    <figure>
                    <img src="https://lh3.googleusercontent.com/pw/AP1GczPCOC5VZb72Iz1F2vUTaP7whjtvRAWwCW1NjpriuknDAiW78bs3-0O8Tb1th7TgZtU12SrOjgEmmzEoNhpCKpezfcx0839G6CphtHcQ0lTTdITUCf3G=w1200-h1000-p-k" alt="第九接力區">
                    <figcaption>▲ 交給第十棒 Hugo，第 2 Round 要結束囉。</figcaption>
                    </figure>
                </li>

                <li>
                    <p><strong>11:32 第十棒出花</strong>。
                        <br>又是一段幾乎沒遮蔭的路段，但更艱難的是到福隆海水浴場找車位...
                        <br>12:23 CAR1 完成！等 CAR2 同時，先來去一旁的東興幸福食堂補充熱量。老闆說今天生意很好，賣到只剩水餃跟石花凍。
                    </p>
                    <figure>
                    <img src="https://lh3.googleusercontent.com/pw/AP1GczOhr3HQIsIqjdnNcfPPa8PAXDNqbAiQ-GmVXWRhd-AfRiZiDAdc6L0bKeGjlW2fk1qrpFmleqOBUebhbSkckdNSZgVyAhO2HKDz961TyECyOkgPWAJa=w1200-h1000-p-k" alt="第十接力區">
                    <figcaption>▲ 12:23 CAR1 結束，等 CAR2 來會合。</figcaption>
                    </figure>
                    <figure>
                    <img src="https://lh3.googleusercontent.com/pw/AP1GczO2iybo-ml_kAC1YJHxACyvkNHGdZwtFBXmhQn5XsHFtWLTC18AHbko9KO7FYXirs6zq8KF8-K-STi9vWi_XjxNkFfoF3nVjY-kOSBHPZjeCPcK3SYm=w1200-h1000-p-k" alt="石花凍">
                    <figcaption>▲ 買個石花凍消消暑。</figcaption>
                    </figure>
                </li>

                <li>
                    <p><strong>13:00 終於跟 CAR2 的朋朋見面！</strong>
                        <br>拍完大合照，13:02 第十一棒 Lion 出花，正式交接給 CAR2，CAR1 則前往基隆海科館附近的民宿休息。
                    </p>
                    <figure>
                    <img src="https://lh3.googleusercontent.com/pw/AP1GczPj2CeO7fMySTrLHEtig_Up_93cRG46IYPyhY7w593R7uB4PsfO4EpMnE2tWlI1BeBmKthC8-jjDZVO_Ps8u6lniTFtRub7jn74AP8w9_8GG0nUVmBe=w1200-h1000-p-k" alt="第十接力區大合照">
                    <img src="https://lh3.googleusercontent.com/pw/AP1GczN2o9yd2xyEx4G9b0XQm-EKi3WZbfNtJMIakAnXdpRUCVPA2jxOYlpW4_5GfGeQfMemr8E6n7uzl85-A6GcwU3gCCOOicOwo_YoKtChzkjb5nreGR8v=w1200-h1000-p-k" alt="東興宮前大合照">
                    <figcaption>▲ 兩車終於見面，繼起跑後久違的大合照。</figcaption>
                    </figure>
                </li>

                <li>
                    <p><strong>（根據群組訊息跟照片時間，簡單紀錄 CAR2 朋朋們的狀況）</strong>
                        <br>14:44 來到第十三棒難中之王，這次由小萬扛下，真男人真的帥！邊跑邊玩但速度不掉的 CAR2，一整個很享受。
                        <br>17:05 第十五棒 Amber 抵達基隆八斗子。CAR1 大概在第十七棒時全員睡醒，決定提早去幫 CAR2 加油。抵達時剛好是第十九棒 Spncer 交接給 Amber，
                        在朱銘美術館迎來第三次兩車會合，在這邊拍照毛毛的，就不放合照嚇大家（其實是合照消失，更毛...）。因為二十棒路段很暗，兩車沿途幫 Amber 加油。
                    </p>
                    <figure>
                    <img src="https://lh3.googleusercontent.com/pw/AP1GczNdj0OC0F5VJVTRoUbwyfeQeUCD1TTJmxZldRIQvJOrDBKx8Iw6eIEZksEy-PN9gaNDuNdtoHqf78kpxnL52ghXSp2YI0BU-FjY2SdZym8pQh_yiUtj=w1200-h1000-p-k" alt="難中之王">
                    <figcaption>▲ 一肩扛下難中之王的小萬，有夠帥。</figcaption>
                    </figure>
                    <figure>
                    <img src="https://lh3.googleusercontent.com/pw/AP1GczP1f9obZgNvicm4AYPj6mt7Hut55Jgj-vKK_YEMqI4wKNI_Q_dFXLhVAKLToU_MlMy62L6l8NuJ_FavUyzsq_XWpfJBKJo2KjxaE87KVrUiOlSfwlrJ=w1200-h1000-p-k" alt="CAR2-Spencer">
                    <img src="https://lh3.googleusercontent.com/pw/AP1GczNGLCtYx9x5DK3vXY3CCk9RNp0AgOZ8YMvlJAqAUQteedrEEqHq97CEbxRO7e4V5Y7HUcG9t1xwQDjWuAnOq_ZrjE9O5Dw4W6tz-eYDnqD5xbN5T3ty=w1200-h1000-p-k" alt="CAR2-Sam">
                    <img src="https://lh3.googleusercontent.com/pw/AP1GczOg32IHDXm2sN6jKS0k9MYrWJ0tfTX54hdMhtjiyORGKXZcBIYtGHGRn42e7_WKZo1LQGJmgc-Czfzq_hTRyyZhvxIs5_JVpia_EKqjEM6E76iuCS7a=w1200-h1000-p-k" alt="CAR2-Lion">
                    <img src="https://lh3.googleusercontent.com/pw/AP1GczPtgwF-C2fSOGYMoP-gksjPovlZCxggMjaZZQY-owdN-5fa7pZ1FPIoI1tmrRVQBnUGxOFNVzWi_Cckuh16AvB9ArDlrcUb1mTv30kjCvuIGsyUII0N=w1200-h1000-p-k" alt="CAR2-Amber">
                    <img src="https://lh3.googleusercontent.com/pw/AP1GczMm66-cz_AEL275u2kWThavncnYv6zusJJyJgW93fm6UO6d-8TGl8W-KZv64ej4ZYty-ZlGdlEeU3HojGhDjR727a-KQ17BFue9L2kI9mq0Fcs7V3Xc=w1200-h1000-p-k" alt="CAR2-小萬">
                    <figcaption>▲ Run hard play hard，跑去正濱漁港拍照的 CAR2 朋朋們，照片太好看。</figcaption>
                    </figure>  
                    <figure>
                    <img src="https://lh3.googleusercontent.com/pw/AP1GczOFl3VAiQ4SfKasKL12a7Lx8bwa_O8C7FlKVCgia-fj9gNn07eYSEfah9i7Vja51BQZ6ThDwn8ltdZqiYx9w_N6-T4YYoBnn2NWhLPtvl7KnxI22PvL=w1200-h1000-p-k" alt="幫 Amber 加油">
                    <figcaption>▲ 夜裡最亮的美麗星星 Amber。</figcaption>
                    </figure>
                </li>               
                    
                <li>
                    <p><strong>20:20 抵達第二十接力區</strong>。
                        <br>換 CAR2 休息，CAR1 接力奮戰。<span style="color: red; font-weight: bold;">第二十接力區有設控，23:50 才開門</span>，CAR1 決定先去買麥當勞。
                        <br>在這中間有個小插曲，我知道大家很累，想休息也合乎常理，不過說出不想幫隊友補給，這玩笑有點開過頭，畢竟活動就是要團隊合作，沒遇過這個狀況加上有點情緒，便先讓自己冷靜一下順便去上廁所，結果回來已開門，還錯過可以去找高中同學拍照的時機 Orz
                        <br>後續隊友們還是有給予滿滿情緒價值 & 補給，<span style="color: red; font-weight: bold;">參加這活動隊友就是撐下去的力量！</span>
                    </p>
                    <figure>
                    <img src="https://lh3.googleusercontent.com/pw/AP1GczO320-qxXpQtH2FDCnjzkL0OxXSvh2zwvuxIvS4JjDz3qV6fIlC9I4elKFJ_I7CRBDzaWe1ZTnxWq2ql2Jbk4xZhRI2Yspe3NxQ4au8PvynEiWTMWEr=w1200-h1000-p-k" alt="第二十接力區合照">
                    <img src="https://lh3.googleusercontent.com/pw/AP1GczMdQaczHMbZdjwwe_z9laZlggUQRBbJ4ujOaBR8gAIg7IwYsIeYqq-XXv9TWklobaX_UiF4JK2Yq5UQP1iQpxpJ6w1zsA32oqDsLAJ0iDGYlRcPZROM=w1200-h1000-p-k" alt="第二十接力區">
                    <figcaption>▲ Car2 結束惹，交接給第二十一棒 ㄚ純，換 CAR1 奮戰。</figcaption>
                    </figure>
                </li>

                <li>
                    <p><strong>23:58 第二十一棒出花</strong>。
                        <br>晚出發意外遇到東夸隊友，還被官方攝影師攔下拍照，竟然被剪進影片，好榮幸 XD
                        <br>出發不久遇到 Ben哥跟柏倉哥，兩個都嚇一跳，一個想說我怎麼在這、一個覺得我消瘦一圈，就這樣跟著他們跑。來到上坡段，全部的車塞成一團，有種上次南夸難中之王的既視感，經過補給車後，不久後來到也塞成一團的二十一接力區，等了 15 分鐘隊友終於出現，ㄚ純成為團隊中第一個正式下班的人！
                    </p>
                    <figure>
                    <img src="https://lh3.googleusercontent.com/pw/AP1GczMr63hnnLaOp6aL4NB0dbCyhLku2e-7sFqFlkBXVvDKqn6y40K25T_YYoQeeDqJjJMlTqJDrsqopnCKnrd56plr0kv4MFMFE6AHnfQkiKino66peMLX=w1200-h1000-p-k" alt="第二十一接力區">
                    <figcaption>▲ 交接給第二十二棒 Hugo。</figcaption>
                    </figure>
                </li>

                <li>
                    <p><strong>04/12 00:58 第二十二棒出花</strong>。
                        <br>又到了尋找 Hugo 遊戲，前面大塞車，加上此段路難會車，又增加遊戲困難度...
                        <br>好險 Hugo 有先見之明帶著水跑，暫時不用擔心 Hugo 會渴鼠，只需要擔心來不及接人，最終在 2k 之前趕上，Hugo 成為第二個正式下班的人。
                    </p>
                    <figure>
                    <img src="https://lh3.googleusercontent.com/pw/AP1GczO_QFt5GCucthEWXrRHMWIk51DNTepOFHgVPBQmpts01wZ5RxyDULtY2DmA_kuSguoYZfVbYTNA8fDENCw-KDFA-xw7YedVb4uwJ8RNr9Ok9I5NWYdZ=w1200-h1000-p-k" alt="第二十二接力區">
                    <figcaption>▲ 交接給第二十三棒 陳律。</figcaption>
                    </figure>
                </li>

                <li>
                    <p><strong>01:45 第二十三棒出花</strong>。
                        <br>第一次補給後 Hugo 便跟著陳律跑，我們是到接力區才得知陳律下坡滑倒，好險只有擦傷，人沒大礙，
                        但鞋子挺有事的，底整個磨平，真的該換一雙新鞋，但也恭喜陳律夸父初體驗成功，是第三個正式下班的人。
                    </p>
                    <figure>
                    <img src="https://lh3.googleusercontent.com/pw/AP1GczMwohmYA7h3CYFwt3L1tDjwHTA4-8AT4TjD5pUS8TsL9b9qEETehcJbBLZho5iwZ0ZZhanB5r4JZw5qoqVTW1IFXc60dZPItYbbqcM5wRro4qfWIH2V=w1200-h1000-p-k" alt="第二十三接力區">
                    <figcaption>▲ 交接給第二十四棒達哥。</figcaption>
                    </figure>
                </li>

                <li>
                    <p><strong>02:38 第二十四棒出花</strong>。
                        <br>又開始進入精神不濟的狀態，印象很深刻是某個路段要幫達哥補給，黑暗中很難認人，我都靠側邊反光條+壯腿辨識，結果陳律問說是這個嗎，我看了一下說不是，結果遠遠傳來是啦，是達哥本人無誤：）
                        <br>在半夢半醒中，達哥成為第四個正式下班的人。
                    </p>
                    <figure>
                    <img src="https://lh3.googleusercontent.com/pw/AP1GczMasI6KEzdLPk9oHFn3rxKH4zWzxsfPz_y0tkTHgh9CdS6aZDrtHH6VK0t8q3FoffiyTUjOsksVl8H0VqeNWusAsUyKqDPpvCIm8Ti5Gn8IDQcKvAm3=w1200-h1000-p-k" alt="第二十四接力區">
                    <figcaption>▲ 交接給第二十五棒 Emma，CAR1 準備收工囉。</figcaption>
                    </figure>
                </li>

                <li>
                    <p><strong>03:37 第二十五棒出花</strong>。
                        <br>大家跑太快，等不到日出的 Emma 一氣之下（?）在下坡路段也是狂飆。天色未亮想說可以陪 Emma 跑，結果 Emma 指定陳律也要陪跑，就這樣三個人邊跑邊玩 Pikmin，花種好種滿。
                        <br>04:38 來到第二十五接力區，Emma 成為第五個正式下班的人， CAR1 安全下庄！在石門等 CAR2 朋朋來接棒，等著等著太累直接在木地板睡著 XD
                        <br>05:12 交給第二十六棒小萬，達哥剛好有朋友住這附近，說可以讓我們用廁所（達哥真是朋友王），換了乾淨衣服，CAR1 準備前往沙崙海水浴場補眠。
                    </p>
                    <figure>
                    <img src="https://lh3.googleusercontent.com/pw/AP1GczPTFyOdObTH_a6ff_-ESRDa5zWLraM01eUSRokbHlvZDViem9vfaC83q5QGBFsdV9AFDc2hUEO4FHxxM9hIN_Evid1PtzypI3MIxQlyZWbCFKzKQf1P=w1200-h1000-p-k" alt="陪跑陳律">
                    </figure>
                    <figure>
                    <img src="https://lh3.googleusercontent.com/pw/AP1GczNTuq5U5iZKjCugbLYVaeIzdYw2R9IG0RI1-hVpY1_07HnRcH_xDTlNySQxBC6m5hATEfeNQg4TletNTRrkfSPIKDvChzkxJl855-WkJ4WXwMkRg1Ee=w1200-h1000-p-k" alt="第二十五接力區">
                    <figcaption>▲ CAR1 收工！</figcaption>
                    </figure>
                </li>

                <li>
                    <p><strong>05:45 一到沙崙海水浴場，直接開睡</strong>。
                        <br>大概睡到 7:30 被熱醒，想說問一下快腿高中同學到哪，結果他們已經在終點拱門迎接第三十棒，趁空檔過去找他聊天，這次忘記合照啦 QQ
                        <br><span style="color: red; font-weight: bold;">等隊友同時，也可以先至熟食區、周圍景點晃晃</span>，或是到便利商店、Subway 吹冷氣。<span style="color: red; font-weight: bold;"></span>官方有提供餐券（領物資時發的）</span>，趁還沒那麼多人可以先去覓食，<span style="color: red; font-weight: bold;"></span>一張餐券限換一份熟食</span>。
                    </p>
                </li>
                <li>
                    <p><strong>第三十棒 Amber 抵達終點（撒花），排隊等拍衝線照！</strong>
                        <br>排隊時發現，前後隊伍都是之前跑東夸、南夸的隊友，也太巧！
                        <br>終於等到我們衝線，衝線那一刻也表示這次北夸順利結束了！<span style="color: red; font-weight: bold;">拍完衝線照接著就是拿著拍拍尺到證書、獎牌區領取</span>，證書由於是現場列印，大概要等一個多小時。
                        <br>有別過往，這次有提供郵寄服務，趕時間的隊伍也可以選此種方式，只是需要有一個人先收，考量工作很忙不確定近期有沒有時間拿給大家，思考同時，先來跟北夸立牌拍團照，剛好 CAR2 朋朋還想多待一會，便請他們幫忙領。
                        <br>原本還有訂慶功宴，但烈日當頭，真的是被曬到咪咪卯卯，食慾全沒只想趕快回家休息，最後在會場兩車道別後，北夸就此畫上句點。
                    </p>
                    <figure>
                    <img src="https://lh3.googleusercontent.com/pw/AP1GczPC-VLEQptErJCzHQXM4s_frwb4dJ4bkj_L2pheQf5bY_xijVkrjmvg6ZHcb2U9lIeb1lCe935HQaDkyYeLoVDm1DbkXHCSweQCx-4Z_eaZV63tEkV1=w1200-h1000-p-k" alt="衝線照">
                    <figcaption>▲ 在烈日下等了半小時的衝線照。</figcaption>
                    </figure>
                    <figure>
                    <img src="https://lh3.googleusercontent.com/pw/AP1GczPY_GdBbr4m50bT7_YZaB4CsJGRs8CjOIFPXZ4TtOZP9rJaYDrDmBIBWsW3Gt0VpKOmaoHEkaq-Ac8xfKpCXnQR8CRrVaGYNZfVDf-e5Lzzr76A2_IY=w1200-h1000-p-k" alt="終點立牌團照1">
                    <img src="https://lh3.googleusercontent.com/pw/AP1GczPq7w1ZxtZdkn9mUGK_WctJZAR8MFgXoFu9M3Xg6q3y8S-EPPIRL3zzlPm5Na2FIhX6PPIcuF53qLFlMVW6J8nKsEkNNGF4haPBNjnqiDdjhagvUNTk=w1200-h1000-p-k" alt="終點立牌團照2">
                    <figcaption>▲ 終點與立牌的合照們，北夸圓滿落幕！</figcaption>
                    </figure>
                </li>
        </ul>
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
        $sql_select = "SELECT * FROM guestbook WHERE post_id = 'crufunorth' ORDER BY id DESC"; 
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
