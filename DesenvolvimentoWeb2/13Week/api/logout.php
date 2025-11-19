<?php
require '../db.php';
session_destroy();
echo json_encode(['sucesso' => 'Logout realizado']);