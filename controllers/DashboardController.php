<?php
class DashboardController
{
    public function index()
    {
        $title = 'Dashboard';
        $view = 'admin/index.php';
        if ($_SESSION['user']['role'] !== 1) {
            header('Location: ' . BASE_URL . '?action=login');
            exit;
        }
        require_once PATH_VIEW_MAIN;
    }
}