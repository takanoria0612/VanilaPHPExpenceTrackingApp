<!-- view/DashboardView.php -->

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Expense Reports Dashboard</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <div class="dashboard-container">
        <h1 class="dashboard-title">旅費交通費申請アプリ</h1>

    <!-- view/DashboardView.php 内 -->
    <?php if (isset($_GET['success']) && $_GET['success'] === 'delete'): ?>
        <div class="alert alert-success">
            The expense report has been successfully deleted.
        </div>
    <?php endif; ?>

        <!-- <div class="date-and-new-button"> -->
            <!-- 検索フォームとボタンを横一列に配置 -->
            <div class="controls-row">
                <a href="new_expense.php" class="btn new-expense-btn">new</a>
                <form action="index.php" method="get" class="form-inline">
                    <label for="searchDate" class="form-label">日付:</label>
                    <input type="date" id="searchDate" name="searchDate" class="form-control">
                    <button type="submit" name="search" class="btn btn-primary">検索</button>
                </form>
                <a href="index.php" class="btn btn-secondary">全件取得</a>
            </div>
        <!-- </div> -->
        <div>
            <!-- 検索結果の件数表示 -->
            <?php if (isset($searchResultCount)): ?>
                <p><?php echo htmlspecialchars($formattedDate); ?>には、<?php echo $searchResultCount; ?>件の申請が見つかりました。</p>
            <?php endif; ?>
        </div>
        <div>
            <!-- DashboardView.php -->
            <?php if (isset($warningMessage)): ?>
                <div class="alert alert-warning">
                    <?php echo $warningMessage; ?>
                </div>
            <?php endif; ?>
        </div>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th>申請No.</th>
                    <th>日付</th>
                    <th>経路</th>
                    <th>精算種別</th>
                    <th>金額</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($expenseReports as $report): ?>
                    <tr>
                        <td class="text-center"><?php echo htmlspecialchars($report['applicationNo']); ?></td>
                        <td class="text-center"><?php echo htmlspecialchars($report['date']); ?></td>
                        <td class="text-center"><?php echo htmlspecialchars($report['routeName']); ?></td>
                        <td class="text-center"><?php echo htmlspecialchars($report['applicant']); ?></td>
                        <td class="text-center"><?php echo htmlspecialchars((int)$report['amount']); ?></td>
                        <td class="text-center">
                            <a href="edit_expense.php?applicationNo=<?php echo $report['applicationNo']; ?>" class="btn btn-edit">編集</a>
                            <a href="delete_expense.php?applicationNo=<?php echo $report['applicationNo']; ?>" class="btn btn-delete">削除</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
