<?php
header('Content-Type: application/json; charset=utf-8');

$productos = [
    [
        "id" =>1,
        "imagen" => "hombre/Homer.png",
        "nombre" => "Nos Vemos",
        "coleccion" => "The simpsons",
        "precio" => 499.99,
        "descripcion" => "Camisa ligera de algodón con estampado tropical."
    ],
    [
        "id" =>2,
        "imagen" => "hombre/magneto.webp",
        "nombre" => "Magneto",
        "coleccion" => "Clásicos",
        "precio" => 799.50,
        "descripcion" => "Jeans denim azul oscuro con corte ajustado."
    ],
    [
        "id" =>3,
        "imagen" => "hombre/super.webp",
        "nombre" => "Superman",
        "coleccion" => "DC",
        "precio" => 299.00,
        "descripcion" => "Chaqueta de cuero genuino estilo biker."
    ],
    [
        "id" =>4,
        "imagen" => "hombre/superr.webp",
        "nombre" => "Superman 2",
        "coleccion" => "DC",
        "precio" => 299.99,
        "descripcion" => "Tenis cómodos y ligeros para correr."
    ],
    [
        "id" =>5,
        "imagen" => "hombre/Muñeca_squids.png",
        "nombre" => "Tenis Deportivos",
        "coleccion" => "Squids Games",
        "precio" => 999.99,
        "descripcion" => "Tenis cómodos y ligeros para correr."
    ]
    ,
    [
        "id" =>6,
        "imagen" => "hombre/Games_squidsmex.png",
        "nombre" => "Squids Games",
        "coleccion" => "Squids Games",
        "precio" => 999.99,
        "descripcion" => "Tenis cómodos y ligeros para correr."
    ],
    [
        "id" =>7,
        "imagen" => "hombre/Jefes_squids.png",
        "nombre" => "Tenis Deportivos",
        "coleccion" => "Squids Games",
        "precio" => 999.99,
        "descripcion" => "Tenis cómodos y ligeros para correr."
    ],
    [
        "id" =>8,
        "imagen" => "hombre/Sueter_squidsgames.png",
        "nombre" => "Squids Games",
        "coleccion" => "Sport",
        "precio" => 999.99,
        "descripcion" => "Tenis cómodos y ligeros para correr."
    ],
    [
        "id" =>9,
        "imagen" => "hombre/familia_fantastica.png",
        "nombre" => "La Familia Fantastica",
        "coleccion" => "Los 4 Fanatsticos",
        "precio" => 999.99,
        "descripcion" => "Tenis cómodos y ligeros para correr."
    ],
    [
        "id" =>10,
        "imagen" => "hombre/mr_fantastic.png",
        "nombre" => "Mr Fantastico",
        "coleccion" => "Los 4 Fanatsticos",
        "precio" => 999.99,
        "descripcion" => "Tenis cómodos y ligeros para correr."
    ],
    [
        "id" =>11,
        "imagen" => "hombre/Mujer_Invisible.png",
        "nombre" => "La Mujer Invisible",
        "coleccion" => "Los 4 Fanatsticos",
        "precio" => 999.99,
        "descripcion" => "Tenis cómodos y ligeros para correr."
    ],
    [
        "id" =>12,
        "imagen" => "hombre/the_thing.png",
        "nombre" => "The Thing",
        "coleccion" => "Los 4 Fanatsticos",
        "precio" => 999.99,
        "descripcion" => "Tenis cómodos y ligeros para correr."
    ],
    [
        "id" =>13,
        "imagen" => "hombre/sueter_cap_4.png",
        "nombre" => "Capitan America",
        "coleccion" => "Brave New world",
        "precio" => 499.99,
        "descripcion" => "Tenis cómodos y ligeros para correr."
    ],
    [
        "id" =>14,
        "imagen" => "hombre/baby_grogu.png",
        "nombre" => "Grogu",
        "coleccion" => "The Mnadalorian",
        "precio" => 199.99,
        "descripcion" => "Tenis cómodos y ligeros para correr."
    ],
    [
        "id" =>15,
        "imagen" => "hombre/Imperial.png",
        "nombre" => "Grogu",
        "coleccion" => "The Mnadalorian",
        "precio" => 199.99,
        "descripcion" => "Tenis cómodos y ligeros para correr."
    ],
    [
        "id" =>16,
        "imagen" => "hombre/La_fuerza.png",
        "nombre" => "Grogu",
        "coleccion" => "The Mnadalorian",
        "precio" => 199.99,
        "descripcion" => "Tenis cómodos y ligeros para correr."
    ]
   
    ];

echo json_encode($productos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
