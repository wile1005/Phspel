<?php
    $recipes2 = array
    (
        "plank",//recept här?
        "workbench",
        "wood pickaxe"
    );
    $recipes = json_decode('[
    ["plank","none",2,
    ["wood",1]],

    ["workbench","none",1,
    ["wood",10]],

    ["wood wall","none",1,
    ["plank",2]],

    ["wood door","none",1,
    ["plank",5]],

    ["torch","none",4,
    ["coal",2],
    ["wood",2]],

    ["furnace","workbench",1,
    ["stone",20]],

    ["wood sword","workbench",1,
    ["wood",5]],

    ["wood hoe","workbench",1,
    ["wood",5]],

    ["wood pickaxe","workbench",1,
    ["wood",5]],

    ["wood axe","workbench",1,
    ["wood",5]],

    ["wood shovel","workbench",1,
    ["wood",5]],

    ["stone pickaxe","workbench",1,
    ["wood",5],
    ["stone",5]],

    ["anvil","workbench",1,
    ["iron",5]],

    ["iron","furnace",1,
    ["iron ore",4],
    ["coal",1]]

    ]',true);
?>