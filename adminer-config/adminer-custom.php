<?php
// Incluye Adminer original
include "adminer.php";
function adminer_object() {
    // Clase personalizada
    class AdminerCustom extends Adminer {
        function login($login, $password) {
            // Guarda las conexiones recientes en un archivo
            $file = '/var/lib/adminer/connections.log';
            $connection = date('Y-m-d H:i:s') . " | " . $_POST['server'] . " | " . $_POST['username'] . "\n";
            file_put_contents($file, $connection, FILE_APPEND | LOCK_EX);
            return true;
        }

        function loginForm() {
            echo "<h2>Recent Connections:</h2>";
            $file = '/var/lib/adminer/connections.log';
            if (file_exists($file)) {
                echo "<pre>" . htmlspecialchars(file_get_contents($file)) . "</pre>";
            }
            parent::loginForm();
        }
    }
    return new AdminerCustom;
}


