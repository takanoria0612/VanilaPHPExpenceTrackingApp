<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>旅費交通費申請書</title>
    <link rel="stylesheet" href="../css/print.css">
</head>

<body>
    <div class="application-form">
        <h1>旅費交通費申請書</h1>
        <form>
            <div class="section approval-section">
                <!-- 承認欄と申請日・申請者の情報を横一列に並べるためのコンテナ -->
                    <div class="approval-number-container">
                        <span class="approval-number">申請 №</span>
                    </div>
                    <div class="approval-dates-container">
                        <table class="approval-table">
                            <!-- 承認欄のテーブル内容 -->
                            <tr class="signature-space">
                                <th colspan="3" class="approval-title">承認欄</th>
                            </tr>
                            <tr class="signature-space">
                                <td class="signature-space">社長</td>
                                <td class="signature-space">経理</td>
                                <td class="signature-space"></td> <!-- 空欄のセルを追加 -->
                            </tr>
                            <tr class="empty-row">
                                <td></td>
                                <td></td>
                                <td></td> <!-- 新しい空欄の行を追加 -->
                            </tr>
                        </table>
                        <table class="dates-table">
                            <!-- 申請日と申請者のテーブル内容 -->
                            <tr>
                                <th>申請日</th>
                                <td>令和 6 年 3 月 28 日</td>
                            </tr>
                            <tr>
                                <th>申請者</th>
                                <td>山田 太郎 印</td>
                            </tr>
                        </table>
                    </div>
            </div>

            <div class="section purpose-section">
                <p>1. 申請目的</p>
                <div class="checkboxes">
                    <label><input type="checkbox"> 交通費精算</label>
                    <label><input type="checkbox"> 出張旅費精算</label>
                    <label><input type="checkbox"> 定期代精算</label>
                    <label>その他（<input type="text">）</label>
                </div>
            </div>

            <div class="section detail-section">
                <p>2. 内訳明細</p>
                <table>
                    <tr>
                        <th>日付</th>
                        <th>路線名等</th>
                        <th>駅名</th>
                        <th>駅名</th>
                        <th>金額</th>
                        <th>備考</th>
                    </tr>
                    <tr>
                        <td>3月1日</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>¥1,000</td>
                        <td></td>
                    </tr>
                    <!-- その他の明細行 -->
                </table>
                <div class="total-amount">
                    <span>合計金額</span>
                    <span>¥1,000</span>
                </div>
            </div>

            <div class="section seal-section">
                <p>受領印</p>
            </div>
        </form>
    </div>
</body>
</html>
