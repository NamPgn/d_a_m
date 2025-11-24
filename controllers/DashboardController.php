<?php
class DashboardController
{
    public function index()
    {
        $title = 'Dashboard';
        $view = 'admin/index.php';
        require_once PATH_VIEW_MAIN;
    }
}