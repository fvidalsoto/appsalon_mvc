<?php

function debuguear($variable): string
{
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

// Escapa / Sanitizar el HTML
function s($html): string
{
    $s = htmlspecialchars($html);
    return $s;
}

/* Funcion que revisa que el usuario esta autenticado */

function isAuth(): void
{
    if (!isset($_SESSION['login'])) {
        header("Location: /");
    }
}

function esUltimo(string $actual, string $proximo): bool
{
    return ($actual != $proximo);
}

function isAdmin(): void
{
    if (!isset($_SESSION['admin'])) {
        header("Location: /");
    }
}
