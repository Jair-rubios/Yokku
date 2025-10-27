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
        "precio" => 499.99,
        "descripcion" => "Jeans denim azul oscuro con corte ajustado."
    ],
    [
        "id" => 3,
        "imagen" => "mujer/chimmy.webp",
        "nombre" => "CHIMMY",
         "coleccion" => "Verano BT21",
        "precio" => 199.00,
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
    ],

    [
        "id" => 9,
        "imagen" => "mujer/Ariel.png",
        "nombre" => "COOKY",
         "coleccion" => "Verano BT21",
        "precio" => 999.99,
        "descripcion" => "Tenis cómodos y ligeros para correr."
    ],

    [
        "id" => 10,
        "imagen" => "mujer/Sudadera_Stich.png",
        "nombre" => "Ariel",
         "coleccion" => "Disney Winter",
        "precio" => 999.99,
        "descripcion" => "Tenis cómodos y ligeros para correr."
    ],

    [
        "id" => 11,
        "imagen" => "mujer/Sueter Stich.png",
        "nombre" => "COOKY",
         "coleccion" => "Verano BT21",
        "precio" => 999.99,
        "descripcion" => "Tenis cómodos y ligeros para correr."
    ],

    [
        "id" => 12,
        "imagen" => "mujer/Taquibara.png",
        "nombre" => "El Taquibara",
        "coleccion" => "Capibara",
        "precio" => 999.99,
        "descripcion" => "Pasele guerita, cuantas camisas le damos porque hay de todas tallas y colores mi jovenaza"
    ],

    [
        "id" => 13,
        "imagen" => "mujer/Marge_Mujer.png",
        "nombre" => "COOKY",
        "coleccion" => "The simpsons",
        "precio" => 149.99,
        "descripcion" => "Marge"
    ],

    [
        "id" => 14,
        "imagen" => "mujer/Homer_Mujer.png",
        "nombre" => "Homer love",
        "coleccion" => "The simpsons",
        "precio" => 249.99,
        "descripcion" => "Enamora con este estilo y rosquillas"
    ],

    [
        "id" => 15,
        "imagen" => "mujer/rey_leon.png",
        "nombre" => "Simba",
        "coleccion" => "El rey Leon",
        "precio" => 349.99,
        "descripcion" => "Se la reina que todas desean ser"
    ],

    [
        "id" => 16,
        "imagen" => "mujer/hakuna_matata.png",
        "nombre" => "Hakuna Matata",
        "coleccion" => "El rey Leon",
        "precio" => 299.99,
        "descripcion" => "Hakuna Matata un forma de ser"
    ],

    [
        "id" => 17,
        "imagen" => "mujer/espiritu.png",
        "nombre" => "ZERO",
         "coleccion" => "Jack Sellington",
        "precio" => 199.99,
        "descripcion" => "Ponte al estilo de Halloween."
    ]
   ,

    [
        "id" => 18,
        "imagen" => "mujer/ohana.png",
        "nombre" => "OHANA",
         "coleccion" => "Lilo y Stich",
        "precio" => 199.99,
        "descripcion" => "A bailar el ULA ULA."
    ]
   ,

    [
        "id" => 19,
        "imagen" => "mujer/reina_malvada.png",
        "nombre" => "The Evil Queen",
         "coleccion" => "Villanos",
        "precio" => 399.99,
        "descripcion" => "Espejito Espejito quien tiene la camisa mas hermosa de todas?."
    ]
   ,

    [
        "id" => 20,
        "imagen" => "mujer/monsters_university.png",
        "nombre" => "MONSTER",
         "coleccion" => "Monsters University",
        "precio" => 299.99,
        "descripcion" => "Se parte de la Universidad mas prestigiosa de los Monstruos."
    ]
   
   
    ];

echo json_encode($productos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);