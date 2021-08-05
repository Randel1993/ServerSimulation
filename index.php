<html>
<head>
    <title>Server Class Test</title>
</head>
<body>
    <?php 
        include 'server.php';
        include 'source.php';
        include 'destination.php';
        include 'group.php';

        // create group objects
        $group1 = new Group(1, "US");
        $group2 = new Group(2, "Kids");
        $group3 = new Group(3, "Gaming");
        $group4 = new Group(4, "Social");
        $group5 = new Group(5, "News");
        $group6 = new Group(6, "Health");

        // create destinations and set inclusions and exclusions
        $destination1 = new Destination(1, "US Election Campaign");
        $destination1->add_inclusion($group1);
        $destination1->add_exclusion($group2);
        $destination1->add_exclusion($group3);
        $destination1->add_exclusion($group4);
        $destination1->add_exclusion($group5);
        $destination1->add_exclusion($group6);

        $destination2 = new Destination(2, "Credit Card");
        $destination2->add_inclusion($group1);
        $destination2->add_inclusion($group3);
        $destination2->add_inclusion($group6);
        $destination2->add_inclusion($group5);
        $destination2->add_exclusion($group2);

        $destination3 = new Destination(3, "Travel");
        $destination3->add_inclusion($group1);
        $destination3->add_inclusion($group2);
        $destination3->add_inclusion($group3);
        $destination3->add_inclusion($group4);

        $destination4 = new Destination(4, "Covid 19");
        $destination4->add_inclusion($group1);
        $destination4->add_inclusion($group1);
        $destination4->add_inclusion($group6);
        $destination4->add_exclusion($group5);
        $destination4->add_exclusion($group2);


        // source
        $source1 = new Source(1, "Poker");
        $source1->add_group($group3);
        $source1->add_group($group4);

        $source2 = new Source(2, "Trump vs Biden");
        $source2->add_group($group1);

        $source3 = new Source(3, "Sinovac");
        $source3->add_group($group1);
        $source3->add_group($group5);
        $source3->add_group($group6);

        $source4 = new Source(4, "New Processor");
        $source4->add_group($group1);
        $source4->add_group($group3);
        $source4->add_group($group5);

        $sources = [$source1, $source2, $source3, $source4];

        $destinations = [$destination1, $destination2, $destination3, $destination4];

        $server = new Server($sources, $destinations);


        // test check_destination() for source1
        if ($server->check_destination($source1, $destination1)) {
            echo sprintf("Source <B>%s</B>  can go to <B>%s</B>. <br>",$source1->get_description(),$destination1->get_description());
        } else {
            echo sprintf("Source <B>%s</B>   cannot go to <B>%s</B>. <br>",$source1->get_description(),$destination1->get_description());
        }

        if ($server->check_destination($source1, $destination2)) {
            echo sprintf("Source <B>%s</B>  can go to <B>%s</B>. <br>",$source1->get_description(),$destination2->get_description());
        } else {
            echo sprintf("Source <B>%s</B>   cannot go to <B>%s</B>. <br>",$source1->get_description(),$destination2->get_description());
        }

        // test get_sources()
         echo sprintf("Destination: <B>%s</B> excluded: <B>%s</B> included: <B>%s</B> <br>",
            $destination2->get_description(),
            $server->get_sources($destination2)['excluded'],
            $server->get_sources($destination2)['included']);

        echo sprintf("Destination: <B>%s</B> excluded: <B>%s</B> included: <B>%s</B> <br>",
            $destination1->get_description(),
            $server->get_sources($destination1)['excluded'],
            $server->get_sources($destination1)['included']);

        // get_best_destination()
        echo sprintf("Best Destination for <B>%s</B> is <B>%s</B> <br>",
            $source1->get_description(),
            $server->get_best_destination($source1)->get_description());

        echo sprintf("Best Destination for <B>%s</B> is <B>%s</B> <br>",
            $source2->get_description(),
            $server->get_best_destination($source2)->get_description());

        echo sprintf("Best Destination for <B>%s</B> is <B>%s</B> <br>",
            $source3->get_description(),
            $server->get_best_destination($source3)->get_description());
    ?>
</body>
</html>