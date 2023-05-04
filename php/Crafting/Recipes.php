<?php
    $recipes2 = array
    (
        "plank",//recept här?
        "workbench",
        "wood pickaxe"
    );
    $recipes = json_decode('[
    ["plank","none",
    ["wood",1]],

    ["workbench","none",
    ["wood",10]],

    ["wood wall","none",
    ["plank",2]],

    ["torch","none",
    ["coal",2],
    ["wood",2]],

    ["wood pickaxe","workbench",
    ["wood",5]],

    ["wood axe","workbench",
    ["wood",5]],

    ["wood shovel","workbench",
    ["wood",5]],

    ["stone pickaxe","workbench",
    ["wood",5],
    ["stone",5]]

    ]',true);
?>