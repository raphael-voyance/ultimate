<?php

namespace App\Concern;

use Illuminate\Support\Str;

class Invoice
{
    private string $token;
    private int $user_id;

    public function __construct(int $user_id)
    {
        $this->token = '';
        $this->user_id = $user_id;
    }

    public function get_token(): string
    {
        $random = Str::random(40);
        $timestamp = time();

        $this->token = $random . '_' . $timestamp . '_' . $this->user_id; // Combinez le jeton aléatoire avec l'horodatage

        return $this->token; // Retourne le jeton combiné
    }

    public function get_ref(): string
    {
        $prefixe = "FACT"; // Préfixe de la référence de facture
        $timestamp = time(); // Timestamp actuel
        $microtime = microtime(true); // Microsecondes actuelles
        $microtime_part = substr(str_replace('.', '', $microtime), 6); // Extraire les microsecondes sans la virgule

        $reference = $prefixe . "_" . $timestamp . "_" . $microtime_part . "_" . $this->user_id;

        return $reference;
    }
}