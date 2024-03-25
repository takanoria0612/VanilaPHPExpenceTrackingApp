<?php
require_once '../model/UserModel.php';

class LoginController {
    private $userModel;

    public function __construct($db) {
        $this->userModel = new UserModel($db);
    }

    public function login($username, $password) {
        // ユーザー認証を試みる
        $userId = $this->userModel->authenticate($username, $password);

        if ($userId) {
            // 認証成功：セッションにユーザーIDをセット
            session_start();
            $_SESSION['user_id'] = $userId;

            // ダッシュボードへリダイレクト
            header('Location: index.php');
            exit;
        } else {
            // 認証失敗：ログインページにエラーメッセージを表示
            // エラーメッセージをセッションまたは別の方法で渡す
            session_start();
            $_SESSION['error_message'] = 'ユーザー名またはパスワードが間違っています。';

            // ログインページへリダイレクト
            header('Location: ../view/404.php');
            exit;
        }
    }

    // ログアウト処理
    public function logout() {
        // セッションを破棄
        session_start();
        session_unset();
        session_destroy();

        // ログインページへリダイレクト
        header('Location: login.php');
        exit;
    }
}
