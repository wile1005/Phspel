<?php
    $tiles = json_decode('
    {
        "0":
        {
            "name":"air",
            "texture":"air.png",
            "drops":[],
            "solid":"no",
            "hardness":0,
            "mineable":"no",
            "tool":"none"
        },
        "1":
        {
            "name":"grass",
            "texture":"grass.png",
            "drops":[],
            "solid":"no",
            "mineable":"no",
            "hardness":0,
            "tool":"none"
        },
        "2":
        {
            "name":"tree",
            "texture":"tree.png",
            "drops":[["log"],["log"],["log"]],
            "solid":"yes",
            "mineable":"yes",
            "hardness":0,
            "tool":"none"
        },
        "3":
        {
            "name":"workbench",
            "texture":"workbench.png",
            "drops":[["workbench"]],
            "solid":"no",
            "mineable":"no",
            "hardness":0,
            "tool":"none"
        },
        "5":
        {
            "name":"stone",
            "texture":"stone.png",
            "drops":[["stone"],["stone"]],
            "solid":"yes",
            "mineable":"yes",
            "hardness":1,
            "tool":"pickaxe"
        },
        "6":
        {
            "name":"iron_ore",
            "texture":"iron_ore.png",
            "drops":[["iron_ore"],["iron_ore"],["iron_ore"]],
            "solid":"yes",
            "mineable":"yes",
            "hardness":2,
            "tool":"pickaxe"
        },
        "7":
        {
            "name":"redstone_ore",
            "texture":"redstone_ore.png",
            "drops":[["redstone_ore"],["redstone_ore"],["redstone_ore"]],
            "solid":"yes",
            "mineable":"yes",
            "hardness":3,
            "tool":"pickaxe"
        },
        "8":
        {
            "name":"bedrock",
            "texture":"bedrock.png",
            "drops":[],
            "solid":"yes",
            "mineable":"no",
            "hardness":0,
            "tool":"none"
        },
        "9":
        {
            "name":"furnace",
            "texture":"furnace.png",
            "drops":[],
            "solid":"no",
            "mineable":"no",
            "hardness":0,
            "tool":"none"
        }
    }
    ',true);
?>