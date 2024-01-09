<?php
include 'top.php';
?>

<main>
    <article>
        <h2>Create Survey SQL Table</h2>
        <pre>
        CREATE TABLE tblFinalSurvey(
            pmkSurveyId INT AUTO_INCREMENT PRIMARY KEY,
            fldFirstName VARCHAR(40),
            fldLastName VARCHAR(40),
            fldEmailAddress VARCHAR(40),
            fldRating VARCHAR(15),
            fldWhy TEXT,
            fldComments TEXT
        )
        </pre>
        <h2>Sample of Inserting Data into Survey Table</h2>
        <pre>
        INSERT INTO tblFinalSurvey(
            fldFirstName,
            fldLastName,
            fldEmailAddress,
            fldRating,
            fldWhy,
            fldComments
        ) VALUES (
            ?, ?, ?, ?, ?, ?
        )
        </pre>
        <h2>Create Planner SQL Table</h2>
        <pre>
        CREATE TABLE tblHwPlanner(
            pmkPlannerId,
            fldNetId,
            fldTitle,
            fldClass,
            fldLength,
            fldDueDate,
            fldDesc
        )
        </pre>
        <h2>Sample of Inserting Data into Planner Table</h2>
        <pre>
        INSERT INTO tblHwPlanner(
            fldNetId,
            fldTitle,
            fldClass,
            fldLength,
            fldDueDate,
            fldDesc
        ) VALUES(
            ?, ?, ?, ?, ?, ?
        )
        </pre>
        <h2>Select statement for Planner Table</h2>
        <pre>
        SELECT
            pmkPlannerId,
            fldNetId,
            fldTitle,
            fldClass,
            fldLength,
            fldDueDate,
            fldDesc
        FROM tblHwPlanner
        ORDER BY fldNetID
        </pre>
    </article>
</main>
<?php include 'footer.php' ?>
</body>
</html>

