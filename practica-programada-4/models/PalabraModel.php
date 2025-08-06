<?php
require_once __DIR__ . '/../config/database.php';

class PalabraModel {
    public static function guardar($palabra, $definicion, $ejemplo, $audio_url) {
        $db = Database::conectar();
        $stmt = $db->prepare("INSERT INTO palabras (palabra, definicion, ejemplo, audio_url) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$palabra, $definicion, $ejemplo, $audio_url]);
    }
}
