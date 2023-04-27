<?php
    //kollar om tilen kan bli slagen
    function hit(&$map, $playerX, $playerY, &$inventory, $num, $background)
    {
        $itemfound = false;
        $inventory_size=count($inventory);
        if ($map[$playerX][$playerY]==2)
        {
            //tree hit
            background_return($map,$playerX,$playerY,$background);
            for($i=0; $i < $inventory_size; $i++)
            {
                if($inventory[$i][0]=="log")
                {
                    $itemfound = true;
                    $inventory[$i][1]++;
                }
            }
            if ($itemfound == false)
            {
                array_push($inventory,array("log",1));
            }
        }elseif ($map[$playerX][$playerY]==5)
        {
            //stone hit
            if($inventory[$num]=="wood_pickaxe")
            {
                background_return($map,$playerX,$playerY,$background);
                for($i=0; $i < $inventory_size; $i++)
                {
                    if($inventory[$i][0]=="stone")
                    {
                        $itemfound = true;
                        $inventory[$i][1]++;
                    }
                }
                if ($itemfound == false)
                {
                    array_push($inventory,array("stone",1));
                }
            }
        }elseif ($map[$playerX][$playerY]==6)
        {
            //iron hit
            if($inventory[$num]=="stone_pickaxe")
            {
                background_return($map,$playerX,$playerY,$background);
                for($i=0; $i < $inventory_size; $i++)
                {
                    if($inventory[$i][0]=="raw_iron")
                    {
                        $itemfound = true;
                        $inventory[$i][1]++;
                    }
                }
                if ($itemfound == false)
                {
                    array_push($inventory,array("raw_iron",1));
                }
            }
        }elseif ($map[$playerX][$playerY]==7)
        {
            //redstone ore hit
            if($inventory[$num]=="iron_pickaxe")
            {
                background_return($map,$playerX,$playerY,$background);
                for($i=0; $i < $inventory_size; $i++)
                {
                    if($inventory[$i][0]=="redstone")
                    {
                        $itemfound = true;
                        $inventory[$i][1]++;
                    }
                }
                if ($itemfound == false)
                {
                    array_push($inventory,array("redstone",1));
                }
            }
        }elseif ($map[$playerX][$playerY]==13)
        {
            //coal ore hit
            if($inventory[$num]=="Wood_pickaxe"||"stone_pickaxe"||"iron_pickaxe")
            {
                background_return($map,$playerX,$playerY,$background);
                for($i=0; $i < $inventory_size; $i++)
                {
                    if($inventory[$i][0]=="coal")
                    {
                        $itemfound = true;
                        $inventory[$i][1]++;
                    }
                }
                if ($itemfound == false)
                {
                    array_push($inventory,array("coal",1));
                }
            }
        }if ($map[$playerX][$playerY]==14)
        {
            //wall hit
            if($inventory[$num]=="axe")
            {
                background_return($map,$playerX,$playerY,$background);
                for($i=0; $i < $inventory_size; $i++)
                {
                    if($inventory[$i][0]=="plank")
                    {
                        $itemfound = true;
                        $inventory[$i][1]++;
                    }
                }
                if ($itemfound == false)
                {
                    array_push($inventory,array("plank",1));
                }
            }
        }
    }
?>