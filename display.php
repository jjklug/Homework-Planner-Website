<?php
include 'top.php';
?>
        <main>
            <article>
                <h2>
                    Finished Homework Planners
                </h2>

                <section class="tablesection">
                    <table>
                        <tr> 
                            <th>Net ID</th>
                            <th>Assignment Title</th>
                            <th>Class</th>
                            <th>Length of Assignment</th>
                            <th>Due Date</th>
                            <th>Assignment Description</th>
                        </tr>

                    <?php
                    $sql = 'SELECT fldNetId, fldTitle, fldClass, fldLength, fldDueDate, fldDesc FROM tblHwPlanner ORDER BY fldNetID';

                    $statement = $pdo->prepare($sql);
                    $statement->execute();
                    $records = $statement->fetchAll();
                    $check = false;
                    foreach ($records as $record) {
                        if ($check == true){
                            if ($currNetId != $record['fldNetId']){
                                print '</table>';
                                print '<table>';
                                print '<tr>'; 
                                print '<th class="netId">Net ID</th>';
                                print '<th>Assignment Title</th>';
                                print '<th>Class</th>';
                                print '<th>Length of Assignment</th>';
                                print '<th>Due Date</th>';
                                print '<th class="description">Assignment Description</th>';
                                print '</tr>';
                            }
                        }
                        print '<tr>';
                        print '<td>' . $record['fldNetId'] . '</td>';
                        print '<td>' . $record['fldTitle'] . '</td>';
                        print '<td>' . $record['fldClass'] . '</td>';
                        print '<td>' . $record['fldLength'] . '</td>';
                        print '<td>' . $record['fldDueDate'] . '</td>';
                        print '<td>' . $record['fldDesc'] . '</td>';
                        print '</tr>' . PHP_EOL;
                        $currNetId = $record['fldNetId'];
                        $check = true;
                    }
                    ?>
                    </table>
                </section>
            </article>
        </main>
        <?php include 'footer.php'; ?>
    </body>
</html>
