<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Expense Report Form</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <h1>経費報告編集</h1>
        <form action="update_expense.php" method="post">
        <!-- applicationNo は変更不可の隠しフィールドとして送信 -->
            <input type="hidden" name="applicationNo" value="<?php echo htmlspecialchars($expenseReport['applicationNo']); ?>">
        
            <div class="form-group">
                <label for="date">日付:</label>
                <input type="date" id="date" name="date" value="<?php echo $expenseReport['date'] ?? ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="routeName">路線名:</label>
                <input type="text" id="routeName" name="routeName" value="<?php echo $expenseReport['routeName'] ?? ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="applicant">申請者:</label>
                <input type="text" id="applicant" name="applicant" value="<?php echo $expenseReport['applicant'] ?? ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="stationName1">駅名(出発):</label>
                <input type="text" id="stationName1" name="stationName1" value="<?php echo $expenseReport['stationName1'] ?? ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="stationName2">駅名(到着):</label>
                <input type="text" id="stationName2" name="stationName2" value="<?php echo $expenseReport['stationName2'] ?? ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="amount">金額:</label>
                <input type="number" id="amount" name="amount" value="<?php echo $expenseReport['amount'] ?? ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="remarks">備考:</label>
                <textarea id="remarks" name="remarks"><?php echo $expenseReport['remarks'] ?? ''; ?></textarea>
            </div>
            <div class="form-group">
                <input type="submit" value="変更を保存">
            </div>
        </form>
    </div>
</body>
</html>
