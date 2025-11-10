<?php
header('Content-Type: application/json; charset=utf-8');

$productos = [
    [
        "id" => 1,
        "imagen" => "niños/satorukId.png",
        "nombre" => "Pasele Joven",
        "coleccion" => "Verano 2025",
        "precio" => 499.99,
        "descripcion" => "Camisa ligera de algodón con estampado tropical."
    ],
    [
        "id" => 2,
        "imagen" => "niños/luffyKid.png",
        "nombre" => "Jeans Slim Fit",
        "coleccion" => "Clásicos",
        "precio" => 799.50,
        "descripcion" => "Jeans denim azul oscuro con corte ajustado."
    ],
    [
        "id" => 3,
        "imagen" => "niños/SpiderKid.png",
        "nombre" => " 4 de Asada",
        "coleccion" => "Edición Limitada",
        "precio" => 1899.00,
        "descripcion" => "Chaqueta de cuero genuino estilo biker."
    ],
    [
        "id" => 4,
        "imagen" => "niños/dragonballKid.png",
        "nombre" => "El rey Taquero",
        "coleccion" => "Sport",
        "precio" => 999.99,
        "descripcion" => "Tenis cómodos y ligeros para correr."
    ],
    [
        "id" => 5,
        "imagen" => "niños/tokitoKid.png",
        "nombre" => "Tenis Deportivos",
        "coleccion" => "Sport",
        "precio" => 999.99,
        "descripcion" => "Tenis cómodos y ligeros para correr."
    ]
    ,
    [
        "id" => 6,
        "imagen" => "niños/ThunderKid.png",
        "nombre" => "Tenis Deportivos",
        "coleccion" => "Sport",
        "precio" => 999.99,
        "descripcion" => "Tenis cómodos y ligeros para correr."
    ],
    [
        "id" => 7,
        "imagen" => "niños/hero_academia.png",
        "nombre" => "Tenis Deportivos",
        "coleccion" => "Sport",
        "precio" => 999.99,
        "descripcion" => "Tenis cómodos y ligeros para correr."
    ],
    [
       "id" => 8,
        "imagen" => "niños/superKid.png",
        "nombre" => "Tenis Deportivos",
        "coleccion" => "Sport",
        "precio" => 999.99,
        "descripcion" => "Tenis cómodos y ligeros para correr." 
    ]
    ,
    [
       "id" => 9,
        "imagen" => "niños/strangerKid.png",
        "nombre" => "Tenis Deportivos",
        "coleccion" => "Sport",
        "precio" => 999.99,
        "descripcion" => "Tenis cómodos y ligeros para correr." 
    ]
    ,
    [
       "id" => 10,
        "imagen" => "niños/shenLong.png",
        "nombre" => "Tenis Deportivos",
        "coleccion" => "Sport",
        "precio" => 999.99,
        "descripcion" => "Tenis cómodos y ligeros para correr." 
    ]
    ,
    [
       "id" => 11,
        "imagen" => "niños/jujutsuKid.png",
        "nombre" => "Tenis Deportivos",
        "coleccion" => "Sport",
        "precio" => 999.99,
        "descripcion" => "Tenis cómodos y ligeros para correr." 
    ]
    ,
    [
       "id" => 12,
        "imagen" => "niños/HulkKid.png",
        "nombre" => "Tenis Deportivos",
        "coleccion" => "Sport",
        "precio" => 999.99,
        "descripcion" => "Tenis cómodos y ligeros para correr." 
    ]
   
    ];

echo json_encode($productos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);