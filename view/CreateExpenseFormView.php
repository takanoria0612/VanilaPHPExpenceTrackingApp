<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>新規経費報告</title>
    <!-- スタイルシートのリンクをここに追加 -->
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <h1>新規経費報告</h1>
    <link rel="stylesheet" href="css/styles.css">
    <?php if(isset($error_message)): ?>
        <p class="error"><?php echo $error_message; ?></p>
    <?php endif; ?>
    <form action="new_expense.php" method="post">
                <!-- 申請日のセクションを追加 -->
        <div class="form-group">
            <label for="applicationDate2">申請日:</label>
            <input type="date" id="applicationDate" name="applicationDate2" value="<?php echo date('Y-m-d'); ?>" required>
        </div>
        <div class="form-group">
            <label for="date">日付:</label>
            <input type="date" id="date" name="date" required>
        </div>
        <div class="form-group">
            <label for="routeName">経路名:</label>
            <input type="text" id="routeName" name="routeName" required>
        </div>
        <div class="form-group">
            <label for="applicant">精算種別:</label>
            <select id="applicant" name="applicant" required>
                <option value="交通費精算">交通費精算</option>
                <option value="出張旅費精算">出張旅費精算</option>
                <option value="定期代精算">定期代精算</option>
                <option value="その他">その他</option>
            </select>

        </div>
        <div class="form-group">
            <label for="stationName1">駅名１:</label>
            <input type="text" id="stationName1" name="stationName1">
        </div>
        <div class="form-group">
            <label for="stationName2">駅名２:</label>
            <input type="text" id="stationName2" name="stationName2">
        </div>
        <div class="form-group">
            <label for="amount">金額:</label>
            <input type="number" id="amount" name="amount" required>
        </div>
        <div class="form-group">
            <label for="remarks">備考:</label>
            <textarea id="remarks" name="remarks"></textarea>
        </div>
        <div class="form-group">
            <input type="submit" value="報告を作成">
        </div>
    </form>
</body>
</html>

