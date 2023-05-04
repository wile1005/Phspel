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

    ["wood pickaxe","workbench",
    ["wood",5]],

    ["wood wall","workbench",
    ["plank",2]],

    ["torch","workbench",
    ["coal",2],
    ["wood",2]]
    ]',true);
?>