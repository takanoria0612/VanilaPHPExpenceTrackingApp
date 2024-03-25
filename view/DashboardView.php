<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Expense Reports Dashboard</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="dashboard-container">
        <h1>旅費交通費申請アプリ</h1>
        <a href="new_expense.php" class="btn new-expense-btn">new</a>
        <table>
            <thead>
                <tr>
                    <th>申請No.</th>
                    <th>日付</th>
                    <th>経路</th>
                    <th>申請者</th>
                    <th>金額</th>
                    <th>編集</th>
                    <th>削除</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($expenseReports as $report): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($report['applicationNo']); ?></td>
                        <td><?php echo htmlspecialchars($report['date']); ?></td>
                        <td><?php echo htmlspecialchars($report['routeName']); ?></td>
                        <td><?php echo htmlspecialchars($report['applicant']); ?></td>
                        <td><?php echo htmlspecialchars($report['amount']); ?></td>
                        <td><a href="edit_expense.php?applicationNo=<?php echo $report['applicationNo']; ?>">編集</a></td>
                        <td><a href="delete_expense.php?applicationNo=<?php echo $report['applicationNo']; ?>">削除</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
