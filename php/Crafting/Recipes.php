<?php
    $recipes = array
    (
        "plank",//recept här?
        "workbench",
        "wood pickaxe"
    );
    $recipes2 = json_decode('[
    ["plank","none",
    ["wood",1]],

    ["workbench","none",
    ["wood",10]],

    ["wood pickaxe","workbench",
    ["wood",5]],

    ["torch","workbench",
    ["coal",2],
    ["wood",2]]
    ]',true);
?>