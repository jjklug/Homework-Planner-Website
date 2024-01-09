<?php
include 'top.php';
?>
<?php
//Initialization
$dataIsGood = false;
$netId = ''; 
$title = '';
$class = '';
$length = '';
$date = '';
$desc = '';

//Sanitation
function getData($field) {
    if (!isset($_POST[$field])) {
        $data = "";
    } else {
        $data = trim($_POST[$field]);
        $data = htmlspecialchars($data);
    }
    return $data;
}

function verifyAlphaNum($testString) {
    return (preg_match ("/^([[:alnum:]]|-|:|\|.| |\'|&|;|#)+$/", $testString));
}
?>
        <main>
            <article class="grid-layout">
                <h2 class = "heading"> Homework Planner </h2>

                <section class="howTo">
                    <h2>How do you use the Homework Planner Tool?</h2>
                    
                    <p>Our Homework Planner tool is extremely simple and requires little to no effort. In just a few keystrokes, you will have a neat, organized table with all your assignments printed on it. For each assignment you must enter a few things: NetID, title of assignment, the class the assignment is for, length of assignment, due date, and a description. After entering in these things you will have your first entry to your assignment table. Once you have entered all your assignments you will have an organized table available for viewing on our <a href="https://jjklug.w3.uvm.edu/cs008/final/display.php">display</a> page. Thanks again for visiting our site!</p>
                </section>
                <section class="debug">
                
                    <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $dataIsGood = true;
                        
                        //Sanitization
                        //textboxes
                        $netId = getData("txtNetId");
                        $title = getData("txtTitle");
                        $class = getData("txtClass");
                        
                        //radio buttons
                        $length = getData("radLength");
                        
                        //date/time picker
                        $date = getData("dtDue");

                        //text areas
                        $desc = getData("txtDescription");

                        //Server side Validation
                        if($netId ==''){
                            print '<p class="mistake">Please tell us the assignment title.</p>';
                            $dataIsGood = false;
                        } elseif (!verifyAlphaNum($netId)){
                            print '<p class="mistake">Your input appears to have extra characters that are not allowed. Please use letters and numbers only.</p>';
                            $dataIsGood = false;
                        }

                        if($title ==''){
                            print '<p class="mistake">Please tell us the assignment title.</p>';
                            $dataIsGood = false;
                        } elseif (!verifyAlphaNum($title)){
                            print '<p class="mistake">Your input appears to have extra characters that are not allowed. Please use letters and numbers only.</p>';
                            $dataIsGood = false;
                        }

                        if($class ==''){
                            print '<p class="mistake">Please tell us the class the assignment is for.</p>';
                            $dataIsGood = false;
                        } elseif (!verifyAlphaNum($class)){
                            print '<p class="mistake">Your input appears to have extra characters that are not allowed. Please use letters and numbers only!</p>';
                            $dataIsGood = false;
                        }
                        
                        if ($length != 'Less than 30 minutes' AND $length != '30 minutes to an hour' AND $length != 'Longer than an hour'){
                            print '<p class="mistake">Please choose an assignment length.</p>';
                            $dataIsGood = false;
                        }

                        if($date ==''){
                            print '<p class="mistake">Please tell us the date the assignment is due.</p>';
                            $dataIsGood = false;
                        }elseif (!verifyAlphaNum($date)){
                            print '<p class="mistake">Your input appears to have extra characters that are not allowed. Please use letters and numbers only!</p>';
                            $dataIsGood = false;
                        }

                        if($desc ==''){
                            print '<p class="mistake">Please give a description about your assignment.</p>';
                            $dataIsGood = false;
                        } elseif (!verifyAlphaNum($desc)){
                            print '<p class="mistake">Your input appears to have extra characters that are not allowed. Please use letters and numbers only!</p>';
                            $dataIsGood = false;
                        }
                        //save the data
                    
                    
                        if ($dataIsGood) {
                            try {
                                $sql = 'INSERT INTO tblHwPlanner
                                (fldNetId, fldTitle, fldClass, fldLength, fldDueDate, fldDesc) VALUES
                                (?, ?, ?, ?, ?, ?)';
                                $statement = $pdo->prepare($sql);
                                $params = array($netId, $title, $class, $length, $date, $desc);

                                if ($statement->execute($params)) {
                                    print '<p>Your assignment entry was recieved.</p>';
                                } else {
                                    print '<p>There was a server problem, please try again later.</p>';
                                }
                            } catch (PDOException $e) {
                                print '<p>Couldn\'t insert the record, please contact someone. </p>';
                            }
                        }
                    } ?>
                </section>
                <form class="form" action=# method="POST">
                    <fieldset>
                        <legend>Personal Info</legend>
                        <p class="noIndent">
                            <label for="txtNetId">NetID:</label>
                            <input type="text" name="txtNetId" id="txtNetId" value="<?php print $netId; ?>" required>
                        </p>
                    </fieldset>

                    <fieldset>
                        <legend>Assignment Info</legend>
                        <p class="noIndent">
                            <label for="txtTitle">Title:</label>
                            <input type="text" name="txtTitle" id="txtTitle" value = "<?php print $title; ?>" required>
                        </p>
                        <p class="noIndent">
                            <label for="txtClass">Class:</label>
                            <input type="text" name="txtClass" id="txtClass" value = "<?php print $class; ?>" required>
                        </p>
                    </fieldset>

                    <fieldset>
                        <legend>Estimated Length of Assignment</legend>
                        <p class="noIndent">
                            <input type="radio" name="radLength" id="radLengthLessThan30" value = "Less than 30 minutes" <?php if ($length == "Less than 30 minutes") print 'checked'; ?> required>
                            <label for="radLengthLessThan30">Less than 30 minutes</label>
                        </p>
                        <p class="noIndent">
                            <input type="radio" name="radLength" id="radLength30to60" value = "30 minutes to an hour" <?php if ($length == "30 minutes to an hour") print 'checked'; ?> required>
                            <label for="radLength30to60">30 minutes to an hour</label>
                        </p>
                        <p class="noIndent">
                            <input type="radio" name="radLength" id="radLengthGreaterThan60" value = "Longer than an hour" <?php if ($length == "Longer than an hour") print 'checked'; ?> required>
                            <label for="radLengthGreaterThan60">Longer than an hour</label>
                        </p>
                    </fieldset>
                    
                    <fieldset>
                        <legend>Due Date</legend>
                        <p class="noIndent">
                            <input type="datetime-local" name="dtDue" id="dtDue" value="<?php print $date;?>" required>
                        </p>
                    </fieldset>

                    <fieldset>
                        <legend>Assignment Description</legend>
                        <p class="noIndent">
                            <textarea name="txtDescription" rows="4" cols="50"><?php print $desc; ?></textarea>
                        </p>
                    </fieldset>

                    <fieldset class="submit">
                        <p class="noIndent">
                            <input id="btnSubmit" name="btnSubmit" type="submit">
                        </p>
                    </fieldset>
                </form>
            </article>
        </main>
        <?php include 'footer.php'; ?>
    </body>
</html>
