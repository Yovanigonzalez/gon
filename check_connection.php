<?php
    function is_connected() {
        $connected = @fsockopen("www.example.com", 80); 
        if ($connected){
            fclose($connected);
            return true; 
        }
        return false;
    }

    if (!is_connected()) {
        header('Location: offline'); // Redirige a tu página personalizada
        exit;
    }
?>
