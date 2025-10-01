<?php
header('Content-Type: application/json; charset=utf-8');

$productos = [
    [
        "id" => 1,
        "imagen" => "mujer/bt21.webp",
        "nombre" => "BT21 Family",
        "coleccion" => "Verano BT21",
        "precio" => 499.99,
        "descripcion" => "Camisa ligera de algodón con estampado tropical."
    ],
    [
        "id" => 2,
        "imagen" => "mujer/mang.webp",
        "nombre" => "MANG",
         "coleccion" => "Verano BT21",
        "precio" => 799.50,
        "descripcion" => "Jeans denim azul oscuro con corte ajustado."
    ],
    [
        "id" => 3,
        "imagen" => "mujer/chimmy.webp",
        "nombre" => "CHIMMY",
         "coleccion" => "Verano BT21",
        "precio" => 1899.00,
        "descripcion" => "Chaqueta de cuero genuino estilo biker."
    ],
    [
        "id" => 4,
        "imagen" => "mujer/koya.webp",
        "nombre" => "KOYA",
         "coleccion" => "Verano BT21",
        "precio" => 999.99,
        "descripcion" => "Tenis cómodos y ligeros para correr."
    ],
    [
        "id" => 5,
        "imagen" => "mujer/RJ.webp",
        "nombre" => "RJ",
         "coleccion" => "Verano BT21",
        "precio" => 999.99,
        "descripcion" => "Tenis cómodos y ligeros para correr."
    ]
    ,
    [
        "id" => 6,
        "imagen" => "mujer/shooky.webp",
        "nombre" => "SHOOKY",
         "coleccion" => "Verano BT21",
        "precio" => 999.99,
        "descripcion" => "Tenis cómodos y ligeros para correr."
    ],
    [
        "id" => 7,
        "imagen" => "mujer/tata.webp",
        "nombre" => "TATA",
         "coleccion" => "Verano BT21",
        "precio" => 999.99,
        "descripcion" => "Tenis cómodos y ligeros para correr."
    ],
    [
        "id" => 8,
        "imagen" => "mujer/cooky.webp",
        "nombre" => "COOKY",
         "coleccion" => "Verano BT21",
        "precio" => 999.99,
        "descripcion" => "Tenis cómodos y ligeros para correr."
    ]
   
    ];

echo json_encode($productos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);