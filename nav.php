<nav>
    <a class = "<?php 
        if($path_parts['filename'] == 'index'){
            print 'activePage';
        }
    ?>" href="index.php">Home</a>

    <a class = "<?php 
        if($path_parts['filename'] == 'planner'){
            print 'activePage';
        }
    ?>" href="planner.php">Enter Assignments</a>

    <a class = "<?php 
        if($path_parts['filename'] == 'display'){
            print 'activePage';
        }
    ?>" href="display.php">Planner</a>

    <a class = "<?php 
        if($path_parts['filename'] == 'survey'){
            print 'activePage';
        }
    ?>" href="survey.php">Survey</a>
</nav>