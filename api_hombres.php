<?php
header('Content-Type: application/json; charset=utf-8');

$productos = [
    [
        "id" => 11,
        "imagen" => "hombre/luffy.webp",
        "nombre" => "Pasele Joven",
        "coleccion" => "Verano 2025",
        "precio" => 499.99,
        "descripcion" => "Camisa ligera de algodón con estampado tropical."
    ],
    [
        "id" => 12,
        "imagen" => "hombre/magneto.webp",
        "nombre" => "Jeans Slim Fit",
        "coleccion" => "Clásicos",
        "precio" => 799.50,
        "descripcion" => "Jeans denim azul oscuro con corte ajustado."
    ],
    [
        "id" => 13,
        "imagen" => "hombre/super.webp",
        "nombre" => " 4 de Asada",
        "coleccion" => "Edición Limitada",
        "precio" => 1899.00,
        "descripcion" => "Chaqueta de cuero genuino estilo biker."
    ],
    [
        "id" => 14,
        "imagen" => "hombre/superr.webp",
        "nombre" => "El rey Taquero",
        "coleccion" => "Sport",
        "precio" => 999.99,
        "descripcion" => "Tenis cómodos y ligeros para correr."
    ],
    [
        "id" => 15,
        "imagen" => "hombre/vegeta.webp",
        "nombre" => "Tenis Deportivos",
        "coleccion" => "Sport",
        "precio" => 999.99,
        "descripcion" => "Tenis cómodos y ligeros para correr."
    ]
    ,
    [
        "id" => 16,
        "imagen" => "hombre/naruto.jpg",
        "nombre" => "Tenis Deportivos",
        "coleccion" => "Sport",
        "precio" => 999.99,
        "descripcion" => "Tenis cómodos y ligeros para correr."
    ],
    [
        "id" => 17,
        "imagen" => "hombre/tanjiro.jpg",
        "nombre" => "Tenis Deportivos",
        "coleccion" => "Sport",
        "precio" => 999.99,
        "descripcion" => "Tenis cómodos y ligeros para correr."
    ]
   
    ];

echo json_encode($productos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
