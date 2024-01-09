<?php
include 'top.php';
?>
<?php
//Initialization
$dataIsGood = false;
$firstName = '';
$lastName = '';
$email = '';
$rating = '';
$why = '';
$comments = '';

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
    return (preg_match ("/^([[:alnum:]]|-|\.| |\'|&|;|#)+$/", $testString));
}
?>
        <main>
            <article class="grid-layout">
                <h2 class = "heading">Feedback</h2>
                <section class="debug">
                </section>
                    <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $dataIsGood = true;
                        
                        //Sanitization
                        //textboxes
                        $firstName = getData("txtFirstName");
                        $lastName = getData("txtLastName");
                        $email = filter_var($_POST['txtEmailAddress'], FILTER_SANITIZE_EMAIL);
                        
                        //radio buttons
                        $rating = getData("radRating");
                        
                        //text areas
                        $why = getData("txtWhy");
                        $comments = getData("txtComments");

                        //Server side Validation
                        if($firstName ==''){
                            print '<p class="mistake">Please tell us your first name.</p>';
                            $dataIsGood = false;
                        } elseif (!verifyAlphaNum($firstName)){
                            print '<p class="mistake">Your explanation appears to have extra characters that are not allowed. Please use letters and numbers only.</p>';
                            $dataIsGood = false;
                        }

                        if($lastName ==''){
                            print '<p class="mistake">Please tell us your last name.</p>';
                            $dataIsGood = false;
                        } elseif (!verifyAlphaNum($lastName)){
                            print '<p class="mistake">Your input appears to have extra characters that are not allowed. Please use letters and numbers only!</p>';
                            $dataIsGood = false;
                        }

                        if ($email == "") {
                            print '<p class="mistake">Please enter your email address.</p>';
                            $dataIsGood = false;
                        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                            print '<p class="mistake">Your email address appears to be incorrect.</p>';
                            $dataIsGood = false;
                        }

                        if ($rating != 'Great' AND $rating != 'Good' AND $rating != 'Ok' AND $rating != 'Bad' AND $rating != 'Terrible'){
                            print '<p class="mistake">Please choose a rating.</p>';
                            $dataIsGood = false;
                        }

                        if($why ==''){
                            print '<p class="mistake">Please tell us why you rated us in that way.</p>';
                            $dataIsGood = false;
                        } elseif (!verifyAlphaNum($why)){
                            print '<p class="mistake">Your explanation appears to have extra characters that are not allowed. Please use letters and numbers only!</p>';
                            $dataIsGood = false;
                        }

                        if($comments ==''){
                            print '<p class="mistake">Please give us some more commentation on our site.</p>';
                            $dataIsGood = false;
                        } elseif (!verifyAlphaNum($comments)){
                            print '<p class="mistake">Your input appears to have extra characters that are not allowed. Please use letters and numbers only!</p>';
                            $dataIsGood = false;
                        }
                        //save the data

                        
                        if ($dataIsGood) {
                            try {
                                $sql = 'INSERT INTO tblFinalSurvey
                                (fldFirstName, fldLastName, fldEmailAddress, fldRating, fldWhy, fldComments) VALUES
                                (?, ?, ?, ?, ?, ?)';
                                $statement = $pdo->prepare($sql);
                                $params = array($firstName, $lastName, $email, $rating, $why, $comments);

                                if ($statement->execute($params)) {
                                    print '<p>Thank you for the rating, your form was submitted.</p>';
                                } else {
                                    print '<p>There was a server problem, please try again later</p>';
                                }
                            } catch (PDOException $e) {
                                print '<p>Couldn\'t insert the record, please contact someone. </p>';
                            }
                        }
                        
                        $to = $email;

                        $subject = 'Thanks for giving us a rating!';

                        $headers = "From: jjklug@uvm.edu\r\n";
                        $headers .= "Reply-To: jjklug@uvm.edu\r\n";
                        $headers .= "MIME-Version: 1.0\r\n";
                        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
                             
                        $message = '<html><body>';
                        $message .= '<h1>Thanks for Visiting Bradon and Jack\'s Homework Planner!!</h1>';
                        $message .= '<p>Dear Website User, ';
                        $message .= '<p>We love to see that people are taking advantage of our website and the homework planner tool we have created. We truly hope that this tool is beneficial and is helping students with their week as they juggle all their classes and assignments. We especially appreciate that you have taken the time to fill out our survey and give us a rating. Since you have come this far, we simply ask that you could tell all your friends about our tool. We hope you use the Homework Planner again.</p>';
                        $message .= '<p></p>';
                        $message .= '<p>Thanks again,</p>';
                        $message .= '<h2>Jack and Bradon</h2>';
                        $message .= '</body></html>';

                        mail($to, $subject, $message, $headers);
                    } 
                ?>

                <form class="form" action=# method="POST">
                    <fieldset>
                        <legend>Contact Information</legend>
                        <p class="noIndent">
                            <label for="txtFirstName">First Name:</label>
                            <input type="text" name="txtFirstName" id="txtFirstName" value = "<?php print $firstName; ?>" required>
                        </p>
                        <p class="noIndent">
                            <label for="txtLastName">Last Name:</label>
                            <input type="text" name="txtLastName" id="txtLastName" value = "<?php print $lastName; ?>" required>
                        </p>
                        <p class="noIndent">
                            <label for="txtEmailAddress">Email Address:</label>
                            <input type="email" name="txtEmailAddress" id="txtEmailAddress" value = "<?php print $email; ?>" required>
                        </p>
                    </fieldset>

                    <fieldset>
                        <legend>Rate Our Site!</legend>
                        <p class="noIndent">
                            <input type="radio" name="radRating" id="radRatingGreat" value = "Great" <?php if ($rating == "Great") print 'checked'; ?> required>
                            <label for="radRatingGreat">Great</label>
                        </p>
                        <p class="noIndent">
                            <input type="radio" name="radRating" id="radRatingGood" value = "Good" <?php if ($rating == "Good") print 'checked'; ?> required>
                            <label for="radRatingGood">Good</label>
                        </p>
                        <p class="noIndent">
                            <input type="radio" name="radRating" id="radRatingOk" value = "Ok"
                            <?php if ($rating == "Ok") print 'checked'; ?> required>
                            <label for="radRatingOk">Ok</label>
                        </p>
                        <p class="noIndent">
                            <input type="radio" name="radRating" id="radRatingBad" value = "Bad"
                            <?php if ($rating == "Bad") print 'checked'; ?> required>
                            <label for="radRatingBad">Bad</label>
                        </p>
                        <p class="noIndent">
                            <input type="radio" name="radRating" id="radRatingTerrible" value = "Terrible"
                            <?php if ($rating == "Terrible") print 'checked'; ?> required>
                            <label for="radRatingTerrible">Terrible</label>
                        </p>
                    </fieldset>

                    <fieldset>
                        <legend>Why did you give us the above rating?</legend>
                        <p class="noIndent">
                            <textarea name="txtWhy" rows="4" cols="50"><?php print $why; ?></textarea>
                        </p>
                    </fieldset>

                    <fieldset>
                        <legend>Any other comments, concerns, or suggestions for improvement: </legend>
                        <p class="noIndent">
                            <textarea name="txtComments" rows="4" cols="50"><?php print $comments; ?></textarea>
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
