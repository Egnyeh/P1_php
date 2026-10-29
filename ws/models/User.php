<?php

declare(strict_types=1);

namespace Ws\Models;

use Ws\Interfaces\IToJson;

require_once __DIR__ . '/../interfaces/IToJson.php';

class User implements IToJson
{
    private string $nombre;
    private string $apellidos;
    private string $sexo;
    private string $correo;
    private bool $novedades;
    private bool $condiciones;

    public function __construct(
        string $nombre,
        string $apellidos,
        string $sexo,
        string $correo,
        bool $novedades,
        bool $condiciones
    ) {
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->sexo = $sexo;
        $this->correo = $correo;
        $this->novedades = $novedades;
        $this->condiciones = $condiciones;
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): void
    {
        $this->nombre = $nombre;
    }

    public function getApellidos(): string
    {
        return $this->apellidos;
    }

    public function setApellidos(string $apellidos): void
    {
        $this->apellidos = $apellidos;
    }

    public function getSexo(): string
    {
        return $this->sexo;
    }

    public function setSexo(string $sexo): void
    {
        $this->sexo = $sexo;
    }

    public function getCorreo(): string
    {
        return $this->correo;
    }

    public function setCorreo(string $correo): void
    {
        $this->correo = $correo;
    }

    public function getNovedades(): bool
    {
        return $this->novedades;
    }

    public function setNovedades(bool $novedades): void
    {
        $this->novedades = $novedades;
    }

    public function getCondiciones(): bool
    {
        return $this->condiciones;
    }

    public function setCondiciones(bool $condiciones): void
    {
        $this->condiciones = $condiciones;
    }

    public function toJson(): string
    {
        $datos = [
            'nombre' => $this->nombre,
            'apellidos' => $this->apellidos,
            'sexo' => $this->sexo,
            'correo' => $this->correo,
            'novedades' => $this->novedades,
            'condiciones' => $this->condiciones,
        ];

        return json_encode($datos, JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT);
    }
}