<?php
    function filter(&$message)
    {
        $filter = array
        (
            "Suger", "dålig", "dåligt", "damark", "sämst",
            "Fuck", "Asshole", "Shit", "Bitch", "Cunt",
            "Jävla", "Knulla", "Skitstövel", "Fan", "Helvete",
            "Idiot", "Svartskalle", "Hora", "Kuk", "Skit",
            "Snorunge", "Dumbass", "Dickhead", "Whore", "Bloody hell",
            "Fitta", "Skitstövel", "Äckel", "Dra åt helvete", "Piss off",
            "Fucking", "Ass", "Cocksucker", "Motherfucker", "Bastard",
            "Dumhuvud", "Skithög", "Slynig", "Satans", "Förbannad",
            "Knäppgök", "Kräk", "Trasdocka", "Jävla skitstövel", "Fåntratt",
            "Kackhög", "Skitunge", "Svin", "Bajskorv", "Fuljävel",
            "Twat", "Son of a bitch", "Wanker", "Arse", "Pisshead",
            "Tönt", "Slemmig", "Kärring", "Rövhål", "Usch",
            "Muppet", "Suck", "Surkärring", "Sopa", "Hårdrockare",
            "Djävul", "Trasig", "Förlorare", "Värdelös", "Suck",
            "Tattare", "Jävla mongo", "Ko", "Styggelse", "Vansinne",
            "Tjockis", "Usling", "Nidbild", "Bedrövlig", "Förbannelse",
            "Kräkstjärt", "Skräphög", "Fånge", "Gris", "Smuts",
            "Pajas", "Skäms", "Slemäckel", "Skitnödig", "Ulv i fårakläder",
            "Fulhet", "Sump", "Slusk", "Olycksfågel", "Uppstoppad kråka",
            "vatsug","neger","nigger","kys","ful","full","retard","reject","keyboard",
            "unalive","post user","4chan","roblox","reddit","minecraft","terraria","clon",
            "hate","i hate xijinping","minicraft","pixelcraft","hypixel","live","die",
            "obama","<",">"
        );
        foreach($filter as $search_string)
        {
            if(preg_match("/".$search_string."/i",$message))
            {
                $message = "****";
            }
        }
        
    }
?>