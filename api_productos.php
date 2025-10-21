<?php
header('Content-Type: application/json; charset=utf-8');

$productos = [
    [
        "id" => 1,
        "imagen" => "imagenes/tacos.webp",
        "nombre" => "Pasele Joven",
        "coleccion" => "Verano 2025",
        "precio" => 499.99,
        "descripcion" => "Camisa ligera de algodón con estampado tropical."
    ],
    [
        "id" => 2,
        "imagen" => "imagenes/sacre.webp",
        "nombre" => "Jeans Slim Fit",
        "coleccion" => "Clásicos",
        "precio" => 799.50,
        "descripcion" => "Jeans denim azul oscuro con corte ajustado."
    ],
    [
        "id" => 3,
        "imagen" => "imagenes/four.webp",
        "nombre" => " 4 de Asada",
        "coleccion" => "Edición Limitada",
        "precio" => 1899.00,
        "descripcion" => "Chaqueta de cuero genuino estilo biker."
    ],
    [
        "id" => 4,
        "imagen" => "imagenes/TODO-H.webp",
        "nombre" => "El rey Taquero",
        "coleccion" => "Sport",
        "precio" => 999.99,
        "descripcion" => "Tenis cómodos y ligeros para correr."
    ],
    [
        "id" => 5,
        "imagen" => "imagenes/shooky.webp",
        "nombre" => "SHOOKY",
        "coleccion" => "Sport",
        "precio" => 999.99,
        "descripcion" => "Tenis cómodos y ligeros para correr."
    ]
    ,
    [
        "id" => 6,
        "imagen" => "imagenes/spider.webp",
        "nombre" => "Spiderman",
        "coleccion" => "Sport",
        "precio" => 999.99,
        "descripcion" => "Tenis cómodos y ligeros para correr."
    ],
    [
        "id" => 7,
        "imagen" => "imagenes/pibesierra.webp",
        "nombre" => "ChainSawmAN",
        "coleccion" => "Sport",
        "precio" => 999.99,
        "descripcion" => "Tenis cómodos y ligeros para correr."
    ],
    [
        "id" => 8,
        "imagen" => "imagenes/slinky.png",
        "nombre" => "Slinky Toy",
        "coleccion" => "Toy Story",
        "precio" => 999.99,
        "descripcion" => "Tenis cómodos y ligeros para correr."
    ],
    [
        "id" => 9,
        "imagen" => "imagenes/deadpool.png",
        "nombre" => "Slinky Toy",
        "coleccion" => "Toy Story",
        "precio" => 999.99,
        "descripcion" => "Tenis cómodos y ligeros para correr."
    ],
    [
        "id" => 10,
        "imagen" => "imagenes/daredevil.png",
        "nombre" => "Slinky Toy",
        "coleccion" => "Toy Story",
        "precio" => 999.99,
        "descripcion" => "Tenis cómodos y ligeros para correr."
    ],
    [
        "id" => 11,
        "imagen" => "imagenes/pochita.png",
        "nombre" => "Slinky Toy",
        "coleccion" => "Toy Story",
        "precio" => 999.99,
        "descripcion" => "Tenis cómodos y ligeros para correr."
    ],
    [
        "id" => 12,
        "imagen" => "imagenes/angel.png",
        "nombre" => "Slinky Toy",
        "coleccion" => "Toy Story",
        "precio" => 999.99,
        "descripcion" => "Tenis cómodos y ligeros para correr."
    ],
    [
        "id" => 13,
        "imagen" => "imagenes/Mulan.png",
        "nombre" => "Mulan",
        "coleccion" => "Princesas Disney",
        "precio" => 199.99,
        "descripcion" => "Tenis cómodos y ligeros para correr."
    ],
    [
        "id" => 14,
        "imagen" => "imagenes/minnie_muertos.png",
        "nombre" => "Minnie Sempasuchil",
        "coleccion" => "Dia de Muertos",
        "precio" => 599.99,
        "descripcion" => "Tenis cómodos y ligeros para correr."
    ],
    [
        "id" => 15,
        "imagen" => "imagenes/mickey_muertos.png",
        "nombre" => "Mickey Altar",
        "coleccion" => "Dia de Muertos",
        "precio" => 699.99,
        "descripcion" => "Tenis cómodos y ligeros para correr."
    ],
    [
        "id" => 16,
        "imagen" => "imagenes/Jack_Skellington.png",
        "nombre" => "Jack Skellington",
        "coleccion" => "Halloween",
        "precio" => 999.99,
        "descripcion" => "Tenis cómodos y ligeros para correr."
    ],
    [
        "id" => 17,
        "imagen" => "imagenes/Sid.png",
        "nombre" => "Sid",
        "coleccion" => "Toy Story",
        "precio" => 399.99,
        "descripcion" => "Tenis cómodos y ligeros para correr."
    ],
    [
        "id" => 18,
        "imagen" => "imagenes/deadwolve.png",
        "nombre" => "Amor de Hermanos",
        "coleccion" => "Deadpool & Wolverine",
        "precio" => 499.99,
        "descripcion" => "Tenis cómodos y ligeros para correr."
    ],
    [
        "id" => 19,
        "imagen" => "imagenes/meow_h.png",
        "nombre" => "Gato Japones",
        "coleccion" => "Japon Retro",
        "precio" => 999.99,
        "descripcion" => "Tenis cómodos y ligeros para correr."
    ],
    [
        "id" =>20,
        "imagen" => "imagenes/meow.png",
        "nombre" => "Gata Lunar",
        "coleccion" => "Japon Retro",
        "precio" => 999.99,
        "descripcion" => "Tenis cómodos y ligeros para correr."
    ]
   
    ];

echo json_encode($productos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
