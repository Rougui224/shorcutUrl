<?php
    require_once('./models/ManagerUrl.php');
    function urlShortcut(){
        $urlManager = new ManagerUrl;
        if(!empty($_POST['url'])){
            $urlManager->PostShorcut($_POST['url']);
        }
        if(!empty($_GET['q'])) {
            $urlManager->redirectShortcut($_GET['q']);
        }
        require_once('./views/viewHome.php');
    }