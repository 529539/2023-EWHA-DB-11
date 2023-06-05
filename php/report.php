<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>분석 보고서</title>
        <link rel="stylesheet" href="../style/report.css">
    </head>
    <body>
        <?php
            $conn = mysqli_connect("localhost", "root", "", "hospital");
            if (!$conn) {
                echo "DATA BASE CONNECTION ERROR!";
            } else {
                if (mysqli_connect_errno()) {
                echo "Could not connect: " . mysqli_connect_error();
                exit();
                }
                // 10대
                $query_allcount_1 =
                    "SELECT COUNT(*) AS tuple_count FROM CHART AS C
                    JOIN PATIENT AS P ON C.PATIENTID = P.PATIENTID
                    JOIN DIAGNOSIS AS DI ON C.DIAID = DI.DIAID
                    JOIN DOCTOR AS D ON C.DOCTORID = D.DOCTORID
                    WHERE (D.MS = '내과' OR D.MS = '정형외과' OR D.MS = '소아과' OR D.MS = '피부과')
                    AND SUBSTRING(RRN, 1, 2) BETWEEN '05' AND '14';";
                $result_allcount_1 = $conn->query($query_allcount_1);
                $query_countMS1_1 =
                    "SELECT COUNT(*) AS tuple_count FROM CHART AS C
                    JOIN PATIENT AS P ON C.PATIENTID = P.PATIENTID
                    JOIN DIAGNOSIS AS DI ON C.DIAID = DI.DIAID
                    JOIN DOCTOR AS D ON C.DOCTORID = D.DOCTORID
                    WHERE D.MS='내과' AND SUBSTRING(P.RRN, 1, 2) BETWEEN '05' AND '14';";
                $result_countMS1_1 = $conn->query($query_countMS1_1);
                $query_countMS2_1 =
                    "SELECT COUNT(*) AS tuple_count FROM CHART AS C
                    JOIN PATIENT AS P ON C.PATIENTID = P.PATIENTID
                    JOIN DIAGNOSIS AS DI ON C.DIAID = DI.DIAID
                    JOIN DOCTOR AS D ON C.DOCTORID = D.DOCTORID
                    WHERE D.MS='정형외과' AND SUBSTRING(P.RRN, 1, 2) BETWEEN '05' AND '14';";
                $result_countMS2_1 = $conn->query($query_countMS2_1);
                $query_countMS3_1 =
                    "SELECT COUNT(*) AS tuple_count FROM CHART AS C
                    JOIN PATIENT AS P ON C.PATIENTID = P.PATIENTID
                    JOIN DIAGNOSIS AS DI ON C.DIAID = DI.DIAID
                    JOIN DOCTOR AS D ON C.DOCTORID = D.DOCTORID
                    WHERE D.MS='소아과' AND SUBSTRING(P.RRN, 1, 2) BETWEEN '05' AND '14';";
                $result_countMS3_1 = $conn->query($query_countMS3_1);
                $query_countMS4_1 =
                    "SELECT COUNT(*) AS tuple_count FROM CHART AS C
                    JOIN PATIENT AS P ON C.PATIENTID = P.PATIENTID
                    JOIN DIAGNOSIS AS DI ON C.DIAID = DI.DIAID
                    JOIN DOCTOR AS D ON C.DOCTORID = D.DOCTORID
                    WHERE D.MS='피부과' AND SUBSTRING(P.RRN, 1, 2) BETWEEN '05' AND '14';";
                $result_countMS4_1 = $conn->query($query_countMS4_1);
                $query_table_1 = 
                    "SELECT P.*, D.MS, DI.CONTENT, C.CHARTID FROM CHART AS C
                    JOIN PATIENT AS P ON C.PATIENTID = P.PATIENTID
                    JOIN DIAGNOSIS AS DI ON C.DIAID = DI.DIAID
                    JOIN DOCTOR AS D ON C.DOCTORID = D.DOCTORID
                    WHERE SUBSTRING(P.RRN, 1, 2) BETWEEN '05' AND '14';";
                $result_table_1 = $conn->query($query_table_1);

                // 20대
                $query_allcount_2 =
                    "SELECT COUNT(*) AS tuple_count FROM CHART AS C
                    JOIN PATIENT AS P ON C.PATIENTID = P.PATIENTID
                    JOIN DIAGNOSIS AS DI ON C.DIAID = DI.DIAID
                    JOIN DOCTOR AS D ON C.DOCTORID = D.DOCTORID
                    WHERE (D.MS = '내과' OR D.MS = '정형외과' OR D.MS = '소아과' OR D.MS = '피부과') AND (
                        (SUBSTRING(RRN, 1, 2) BETWEEN '95' AND '99') OR
                        (SUBSTRING(RRN, 1, 2) BETWEEN '00' AND '04')
                    );";
                $result_allcount_2 = $conn->query($query_allcount_2);
                $query_countMS1_2 =
                    "SELECT COUNT(*) AS tuple_count FROM CHART AS C
                    JOIN PATIENT AS P ON C.PATIENTID = P.PATIENTID
                    JOIN DIAGNOSIS AS DI ON C.DIAID = DI.DIAID
                    JOIN DOCTOR AS D ON C.DOCTORID = D.DOCTORID
                    WHERE (D.MS = '내과') AND (
                        (SUBSTRING(RRN, 1, 2) BETWEEN '95' AND '99') OR
                        (SUBSTRING(RRN, 1, 2) BETWEEN '00' AND '04')
                    );";
                $result_countMS1_2 = $conn->query($query_countMS1_2);
                $query_countMS2_2=
                    "SELECT COUNT(*) AS tuple_count FROM CHART AS C
                    JOIN PATIENT AS P ON C.PATIENTID = P.PATIENTID
                    JOIN DIAGNOSIS AS DI ON C.DIAID = DI.DIAID
                    JOIN DOCTOR AS D ON C.DOCTORID = D.DOCTORID
                    WHERE (D.MS = '정형외과') AND (
                        (SUBSTRING(RRN, 1, 2) BETWEEN '95' AND '99') OR
                        (SUBSTRING(RRN, 1, 2) BETWEEN '00' AND '04')
                    );";
                $result_countMS2_2 = $conn->query($query_countMS2_2);
                $query_countMS3_2 =
                    "SELECT COUNT(*) AS tuple_count FROM CHART AS C
                    JOIN PATIENT AS P ON C.PATIENTID = P.PATIENTID
                    JOIN DIAGNOSIS AS DI ON C.DIAID = DI.DIAID
                    JOIN DOCTOR AS D ON C.DOCTORID = D.DOCTORID
                    WHERE (D.MS = '소아과') AND (
                        (SUBSTRING(RRN, 1, 2) BETWEEN '95' AND '99') OR
                        (SUBSTRING(RRN, 1, 2) BETWEEN '00' AND '04')
                    );";
                $result_countMS3_2 = $conn->query($query_countMS3_2);
                $query_countMS4_2 =
                    "SELECT COUNT(*) AS tuple_count FROM CHART AS C
                    JOIN PATIENT AS P ON C.PATIENTID = P.PATIENTID
                    JOIN DIAGNOSIS AS DI ON C.DIAID = DI.DIAID
                    JOIN DOCTOR AS D ON C.DOCTORID = D.DOCTORID
                    WHERE (D.MS = '피부과') AND (
                        (SUBSTRING(RRN, 1, 2) BETWEEN '95' AND '99') OR
                        (SUBSTRING(RRN, 1, 2) BETWEEN '00' AND '04')
                    );";
                $result_countMS4_2 = $conn->query($query_countMS4_2);
                $query_table_2 = 
                    "SELECT P.*, D.MS, DI.CONTENT, C.CHARTID FROM CHART AS C
                    JOIN PATIENT AS P ON C.PATIENTID = P.PATIENTID
                    JOIN DIAGNOSIS AS DI ON C.DIAID = DI.DIAID
                    JOIN DOCTOR AS D ON C.DOCTORID = D.DOCTORID
                    WHERE SUBSTRING(RRN, 1, 2) BETWEEN '95' AND '99'
                    OR SUBSTRING(RRN, 1, 2) BETWEEN '00' AND '04';";
                $result_table_2 = $conn->query($query_table_2);

                // 30대
                $query_allcount_3 =
                    "SELECT COUNT(*) AS tuple_count FROM CHART AS C
                    JOIN PATIENT AS P ON C.PATIENTID = P.PATIENTID
                    JOIN DIAGNOSIS AS DI ON C.DIAID = DI.DIAID
                    JOIN DOCTOR AS D ON C.DOCTORID = D.DOCTORID
                    WHERE (D.MS = '내과' OR D.MS = '정형외과' OR D.MS = '소아과' OR D.MS = '피부과')
                    AND SUBSTRING(RRN, 1, 2) BETWEEN '85' AND '94';";
                $result_allcount_3 = $conn->query($query_allcount_3);
                $query_countMS1_3 =
                    "SELECT COUNT(*) AS tuple_count FROM CHART AS C
                    JOIN PATIENT AS P ON C.PATIENTID = P.PATIENTID
                    JOIN DIAGNOSIS AS DI ON C.DIAID = DI.DIAID
                    JOIN DOCTOR AS D ON C.DOCTORID = D.DOCTORID
                    WHERE D.MS='내과' AND SUBSTRING(P.RRN, 1, 2) BETWEEN '85' AND '94';";
                $result_countMS1_3 = $conn->query($query_countMS1_3);
                $query_countMS2_3 =
                    "SELECT COUNT(*) AS tuple_count FROM CHART AS C
                    JOIN PATIENT AS P ON C.PATIENTID = P.PATIENTID
                    JOIN DIAGNOSIS AS DI ON C.DIAID = DI.DIAID
                    JOIN DOCTOR AS D ON C.DOCTORID = D.DOCTORID
                    WHERE D.MS='정형외과' AND SUBSTRING(P.RRN, 1, 2) BETWEEN '85' AND '94';";
                $result_countMS2_3 = $conn->query($query_countMS2_3);
                $query_countMS3_3 =
                    "SELECT COUNT(*) AS tuple_count FROM CHART AS C
                    JOIN PATIENT AS P ON C.PATIENTID = P.PATIENTID
                    JOIN DIAGNOSIS AS DI ON C.DIAID = DI.DIAID
                    JOIN DOCTOR AS D ON C.DOCTORID = D.DOCTORID
                    WHERE D.MS='소아과' AND SUBSTRING(P.RRN, 1, 2) BETWEEN '85' AND '94';";
                $result_countMS3_3 = $conn->query($query_countMS3_3);
                $query_countMS4_3 =
                    "SELECT COUNT(*) AS tuple_count FROM CHART AS C
                    JOIN PATIENT AS P ON C.PATIENTID = P.PATIENTID
                    JOIN DIAGNOSIS AS DI ON C.DIAID = DI.DIAID
                    JOIN DOCTOR AS D ON C.DOCTORID = D.DOCTORID
                    WHERE D.MS='피부과' AND SUBSTRING(P.RRN, 1, 2) BETWEEN '85' AND '94';";
                $result_countMS4_3 = $conn->query($query_countMS4_3);
                $query_table_3 = 
                    "SELECT P.*, D.MS, DI.CONTENT, C.CHARTID FROM CHART AS C
                    JOIN PATIENT AS P ON C.PATIENTID = P.PATIENTID
                    JOIN DIAGNOSIS AS DI ON C.DIAID = DI.DIAID
                    JOIN DOCTOR AS D ON C.DOCTORID = D.DOCTORID
                    WHERE SUBSTRING(P.RRN, 1, 2) BETWEEN '85' AND '94';";
                $result_table_3 = $conn->query($query_table_3);

                // 40대
                $query_allcount_4 =
                    "SELECT COUNT(*) AS tuple_count FROM CHART AS C
                    JOIN PATIENT AS P ON C.PATIENTID = P.PATIENTID
                    JOIN DIAGNOSIS AS DI ON C.DIAID = DI.DIAID
                    JOIN DOCTOR AS D ON C.DOCTORID = D.DOCTORID
                    WHERE (D.MS = '내과' OR D.MS = '정형외과' OR D.MS = '소아과' OR D.MS = '피부과')
                    AND SUBSTRING(RRN, 1, 2) BETWEEN '75' AND '84';";
                $result_allcount_4 = $conn->query($query_allcount_4);
                $query_countMS1_4 =
                    "SELECT COUNT(*) AS tuple_count FROM CHART AS C
                    JOIN PATIENT AS P ON C.PATIENTID = P.PATIENTID
                    JOIN DIAGNOSIS AS DI ON C.DIAID = DI.DIAID
                    JOIN DOCTOR AS D ON C.DOCTORID = D.DOCTORID
                    WHERE D.MS='내과' AND SUBSTRING(P.RRN, 1, 2) BETWEEN '75' AND '84';";
                $result_countMS1_4 = $conn->query($query_countMS1_4);
                $query_countMS2_4 =
                    "SELECT COUNT(*) AS tuple_count FROM CHART AS C
                    JOIN PATIENT AS P ON C.PATIENTID = P.PATIENTID
                    JOIN DIAGNOSIS AS DI ON C.DIAID = DI.DIAID
                    JOIN DOCTOR AS D ON C.DOCTORID = D.DOCTORID
                    WHERE D.MS='정형외과' AND SUBSTRING(P.RRN, 1, 2) BETWEEN '75' AND '84';";
                $result_countMS2_4 = $conn->query($query_countMS2_4);
                $query_countMS3_4 =
                    "SELECT COUNT(*) AS tuple_count FROM CHART AS C
                    JOIN PATIENT AS P ON C.PATIENTID = P.PATIENTID
                    JOIN DIAGNOSIS AS DI ON C.DIAID = DI.DIAID
                    JOIN DOCTOR AS D ON C.DOCTORID = D.DOCTORID
                    WHERE D.MS='소아과' AND SUBSTRING(P.RRN, 1, 2) BETWEEN '75' AND '84';";
                $result_countMS3_4 = $conn->query($query_countMS3_4);
                $query_countMS4_4 =
                    "SELECT COUNT(*) AS tuple_count FROM CHART AS C
                    JOIN PATIENT AS P ON C.PATIENTID = P.PATIENTID
                    JOIN DIAGNOSIS AS DI ON C.DIAID = DI.DIAID
                    JOIN DOCTOR AS D ON C.DOCTORID = D.DOCTORID
                    WHERE D.MS='피부과' AND SUBSTRING(P.RRN, 1, 2) BETWEEN '75' AND '84';";
                $result_countMS4_4 = $conn->query($query_countMS4_4);
                $query_table_4 = 
                    "SELECT P.*, D.MS, DI.CONTENT, C.CHARTID FROM CHART AS C
                    JOIN PATIENT AS P ON C.PATIENTID = P.PATIENTID
                    JOIN DIAGNOSIS AS DI ON C.DIAID = DI.DIAID
                    JOIN DOCTOR AS D ON C.DOCTORID = D.DOCTORID
                    WHERE SUBSTRING(P.RRN, 1, 2) BETWEEN '75' AND '84';";
                $result_table_4 = $conn->query($query_table_4);

                // 50대 이상
                $query_allcount_5 =
                    "SELECT COUNT(*) AS tuple_count FROM CHART AS C
                    JOIN PATIENT AS P ON C.PATIENTID = P.PATIENTID
                    JOIN DIAGNOSIS AS DI ON C.DIAID = DI.DIAID
                    JOIN DOCTOR AS D ON C.DOCTORID = D.DOCTORID
                    WHERE (D.MS = '내과' OR D.MS = '정형외과' OR D.MS = '소아과' OR D.MS = '피부과')
                    AND SUBSTRING(RRN, 1, 2) BETWEEN '30' AND '74';";
                $result_allcount_5 = $conn->query($query_allcount_5);
                $query_countMS1_5 =
                    "SELECT COUNT(*) AS tuple_count FROM CHART AS C
                    JOIN PATIENT AS P ON C.PATIENTID = P.PATIENTID
                    JOIN DIAGNOSIS AS DI ON C.DIAID = DI.DIAID
                    JOIN DOCTOR AS D ON C.DOCTORID = D.DOCTORID
                    WHERE D.MS='내과' AND SUBSTRING(P.RRN, 1, 2) BETWEEN '30' AND '74';";
                $result_countMS1_5 = $conn->query($query_countMS1_5);
                $query_countMS2_5 =
                    "SELECT COUNT(*) AS tuple_count FROM CHART AS C
                    JOIN PATIENT AS P ON C.PATIENTID = P.PATIENTID
                    JOIN DIAGNOSIS AS DI ON C.DIAID = DI.DIAID
                    JOIN DOCTOR AS D ON C.DOCTORID = D.DOCTORID
                    WHERE D.MS='정형외과' AND SUBSTRING(P.RRN, 1, 2) BETWEEN '30' AND '74';";
                $result_countMS2_5 = $conn->query($query_countMS2_5);
                $query_countMS3_5 =
                    "SELECT COUNT(*) AS tuple_count FROM CHART AS C
                    JOIN PATIENT AS P ON C.PATIENTID = P.PATIENTID
                    JOIN DIAGNOSIS AS DI ON C.DIAID = DI.DIAID
                    JOIN DOCTOR AS D ON C.DOCTORID = D.DOCTORID
                    WHERE D.MS='소아과' AND SUBSTRING(P.RRN, 1, 2) BETWEEN '30' AND '74';";
                $result_countMS3_5 = $conn->query($query_countMS3_5);
                $query_countMS4_5 =
                    "SELECT COUNT(*) AS tuple_count FROM CHART AS C
                    JOIN PATIENT AS P ON C.PATIENTID = P.PATIENTID
                    JOIN DIAGNOSIS AS DI ON C.DIAID = DI.DIAID
                    JOIN DOCTOR AS D ON C.DOCTORID = D.DOCTORID
                    WHERE D.MS='피부과' AND SUBSTRING(P.RRN, 1, 2) BETWEEN '30' AND '74';";
                $result_countMS4_5 = $conn->query($query_countMS4_5);
                $query_table_5 = 
                    "SELECT P.*, D.MS, DI.CONTENT, C.CHARTID FROM CHART AS C
                    JOIN PATIENT AS P ON C.PATIENTID = P.PATIENTID
                    JOIN DIAGNOSIS AS DI ON C.DIAID = DI.DIAID
                    JOIN DOCTOR AS D ON C.DOCTORID = D.DOCTORID
                    WHERE SUBSTRING(P.RRN, 1, 2) BETWEEN '30' AND '74';";
                $result_table_5 = $conn->query($query_table_5);
            }
        ?>
        <header>
            <div class="title-text">23-1 데이터베이스 2분반 11조 팀 프로젝트</div>
        </header>
        <main>
            <nav>
                <div class="link-div">
                    <a href="search.php">환자 이름으로 조회</a>
                </div>
                <div class="border"></div>
                <div class="link-div">
                    <a href="report.php" class='now'>분석 보고서</a>
                </div>
            </nav>
            <section>
                <div class='table-title'>
                    10대 환자
                    <?php
                    if ($result_allcount_1->num_rows > 0) {
                        $row = $result_allcount_1->fetch_assoc();
                        $tupleCount = $row["tuple_count"];
                        echo "(총 " . $tupleCount . "건)";
                    }
                    ?>
                </div>
                <table class='ms-table'>
                    <tr>
                        <th>내과</th>
                        <td>
                            <?php
                                if ($result_countMS1_1->num_rows > 0) {
                                    $row = $result_countMS1_1->fetch_assoc();
                                    echo $row["tuple_count"] . "건";
                                }
                            ?>
                        </td>
                        <th>정형외과</th>
                        <td>
                            <?php
                                if ($result_countMS2_1->num_rows > 0) {
                                    $row = $result_countMS2_1->fetch_assoc();
                                    echo $row["tuple_count"] . "건";
                                }
                            ?>
                        </td>
                        <th>소아과</th>
                        <td>
                            <?php
                                if ($result_countMS3_1->num_rows > 0) {
                                    $row = $result_countMS3_1->fetch_assoc();
                                    echo $row["tuple_count"] . "건";
                                }
                            ?>
                        </td>
                        <th>피부과</th>
                        <td>
                            <?php
                                if ($result_countMS4_1->num_rows > 0) {
                                    $row = $result_countMS4_1->fetch_assoc();
                                    echo $row["tuple_count"] . "건";
                                }
                            ?>
                        </td>
                    </tr>
                </table>
                <?php
                $count = 0;
                while($row = mysqli_fetch_array($result_table_1)) {
                    $count++;
                    echo '<div class="index-row">';
                    echo '<span>'.$count.'</span>';
                    echo '<table>';
					echo '<tr>';
                    echo '<th>성별</th>';
					echo '<td>'.$row['GENDER'].'</td>';
					echo '<th>출생연도</th>';
					echo '<td>'.substr($row['RRN'], 0, 2).'</td>';
					echo '<th>방문 진료과</th>';
                    echo '<td>'.$row['MS'].'</td>';
					echo '<th>진료 내용</th>';
					echo '<td>'.$row['CONTENT'].'</td>';
					echo '<th>차트 ID</th>';
					echo '<td>'.$row['CHARTID'].'</td>';
					echo '</tr>';
                    echo '</table>';
                    echo '</div>';
                }
                ?>
            </section>
            <section>
                <div class='table-title'>
                    20대 환자
                    <?php
                    if ($result_allcount_2->num_rows > 0) {
                        $row = $result_allcount_2->fetch_assoc();
                        $tupleCount = $row["tuple_count"];
                        echo "(총 " . $tupleCount . "건)";
                    }
                    ?>
                </div>
                <table class='ms-table'>
                    <tr>
                        <th>내과</th>
                        <td>
                            <?php
                                if ($result_countMS1_2->num_rows > 0) {
                                    $row = $result_countMS1_2->fetch_assoc();
                                    echo $row["tuple_count"] . "건";
                                }
                            ?>
                        </td>
                        <th>정형외과</th>
                        <td>
                            <?php
                                if ($result_countMS2_2->num_rows > 0) {
                                    $row = $result_countMS2_2->fetch_assoc();
                                    echo $row["tuple_count"] . "건";
                                }
                            ?>
                        </td>
                        <th>소아과</th>
                        <td>
                            <?php
                                if ($result_countMS3_2->num_rows > 0) {
                                    $row = $result_countMS3_2->fetch_assoc();
                                    echo $row["tuple_count"] . "건";
                                }
                            ?>
                        </td>
                        <th>피부과</th>
                        <td>
                            <?php
                                if ($result_countMS4_2->num_rows > 0) {
                                    $row = $result_countMS4_2->fetch_assoc();
                                    echo $row["tuple_count"] . "건";
                                }
                            ?>
                        </td>
                    </tr>
                </table>
                <?php
                $count = 0;
                while($row = mysqli_fetch_array($result_table_2)) {
                    $count++;
                    echo '<div class="index-row">';
                    echo '<span>'.$count.'</span>';
                    echo '<table>';
					echo '<tr>';
                    echo '<th>성별</th>';
					echo '<td>'.$row['GENDER'].'</td>';
					echo '<th>출생연도</th>';
					echo '<td>'.substr($row['RRN'], 0, 2).'</td>';
					echo '<th>방문 진료과</th>';
                    echo '<td>'.$row['MS'].'</td>';
					echo '<th>진료 내용</th>';
					echo '<td>'.$row['CONTENT'].'</td>';
					echo '<th>차트 ID</th>';
					echo '<td>'.$row['CHARTID'].'</td>';
					echo '</tr>';
                    echo '</table>';
                    echo '</div>';
                }
                ?>
            </section>
            <section>
                <div class='table-title'>
                    30대 환자
                    <?php
                    if ($result_allcount_3->num_rows > 0) {
                        $row = $result_allcount_3->fetch_assoc();
                        $tupleCount = $row["tuple_count"];
                        echo "(총 " . $tupleCount . "건)";
                    }
                    ?>
                </div>
                <table class='ms-table'>
                    <tr>
                        <th>내과</th>
                        <td>
                            <?php
                                if ($result_countMS1_3->num_rows > 0) {
                                    $row = $result_countMS1_3->fetch_assoc();
                                    echo $row["tuple_count"] . "건";
                                }
                            ?>
                        </td>
                        <th>정형외과</th>
                        <td>
                            <?php
                                if ($result_countMS2_3->num_rows > 0) {
                                    $row = $result_countMS2_3->fetch_assoc();
                                    echo $row["tuple_count"] . "건";
                                }
                            ?>
                        </td>
                        <th>소아과</th>
                        <td>
                            <?php
                                if ($result_countMS3_3->num_rows > 0) {
                                    $row = $result_countMS3_3->fetch_assoc();
                                    echo $row["tuple_count"] . "건";
                                }
                            ?>
                        </td>
                        <th>피부과</th>
                        <td>
                            <?php
                                if ($result_countMS4_3->num_rows > 0) {
                                    $row = $result_countMS4_3->fetch_assoc();
                                    echo $row["tuple_count"] . "건";
                                }
                            ?>
                        </td>
                    </tr>
                </table>
                <?php
                $count = 0;
                while($row = mysqli_fetch_array($result_table_3)) {
                    $count++;
                    echo '<div class="index-row">';
                    echo '<span>'.$count.'</span>';
                    echo '<table>';
					echo '<tr>';
                    echo '<th>성별</th>';
					echo '<td>'.$row['GENDER'].'</td>';
					echo '<th>출생연도</th>';
					echo '<td>'.substr($row['RRN'], 0, 2).'</td>';
					echo '<th>방문 진료과</th>';
                    echo '<td>'.$row['MS'].'</td>';
					echo '<th>진료 내용</th>';
					echo '<td>'.$row['CONTENT'].'</td>';
					echo '<th>차트 ID</th>';
					echo '<td>'.$row['CHARTID'].'</td>';
					echo '</tr>';
                    echo '</table>';
                    echo '</div>';
                }
                ?>
            </section>
            <section>
                <div class='table-title'>
                    40대 환자
                    <?php
                    if ($result_allcount_4->num_rows > 0) {
                        $row = $result_allcount_4->fetch_assoc();
                        $tupleCount = $row["tuple_count"];
                        echo "(총 " . $tupleCount . "건)";
                    }
                    ?>
                </div>
                <table class='ms-table'>
                    <tr>
                        <th>내과</th>
                        <td>
                            <?php
                                if ($result_countMS1_4->num_rows > 0) {
                                    $row = $result_countMS1_4->fetch_assoc();
                                    echo $row["tuple_count"] . "건";
                                }
                            ?>
                        </td>
                        <th>정형외과</th>
                        <td>
                            <?php
                                if ($result_countMS2_4->num_rows > 0) {
                                    $row = $result_countMS2_4->fetch_assoc();
                                    echo $row["tuple_count"] . "건";
                                }
                            ?>
                        </td>
                        <th>소아과</th>
                        <td>
                            <?php
                                if ($result_countMS3_4->num_rows > 0) {
                                    $row = $result_countMS3_4->fetch_assoc();
                                    echo $row["tuple_count"] . "건";
                                }
                            ?>
                        </td>
                        <th>피부과</th>
                        <td>
                            <?php
                                if ($result_countMS4_4->num_rows > 0) {
                                    $row = $result_countMS4_4->fetch_assoc();
                                    echo $row["tuple_count"] . "건";
                                }
                            ?>
                        </td>
                    </tr>
                </table>
                <?php
                $count = 0;
                while($row = mysqli_fetch_array($result_table_4)) {
                    $count++;
                    echo '<div class="index-row">';
                    echo '<span>'.$count.'</span>';
                    echo '<table>';
					echo '<tr>';
                    echo '<th>성별</th>';
					echo '<td>'.$row['GENDER'].'</td>';
					echo '<th>출생연도</th>';
					echo '<td>'.substr($row['RRN'], 0, 2).'</td>';
					echo '<th>방문 진료과</th>';
                    echo '<td>'.$row['MS'].'</td>';
					echo '<th>진료 내용</th>';
					echo '<td>'.$row['CONTENT'].'</td>';
					echo '<th>차트 ID</th>';
					echo '<td>'.$row['CHARTID'].'</td>';
					echo '</tr>';
                    echo '</table>';
                    echo '</div>';
                }
                ?>
            </section>
            <section>
                <div class='table-title'>
                    50대 이상 환자
                    <?php
                    if ($result_allcount_5->num_rows > 0) {
                        $row = $result_allcount_5->fetch_assoc();
                        $tupleCount = $row["tuple_count"];
                        echo "(총 " . $tupleCount . "건)";
                    }
                    ?>
                </div>
                <table class='ms-table'>
                    <tr>
                        <th>내과</th>
                        <td>
                            <?php
                                if ($result_countMS1_5->num_rows > 0) {
                                    $row = $result_countMS1_5->fetch_assoc();
                                    echo $row["tuple_count"] . "건";
                                }
                            ?>
                        </td>
                        <th>정형외과</th>
                        <td>
                            <?php
                                if ($result_countMS2_5->num_rows > 0) {
                                    $row = $result_countMS2_5->fetch_assoc();
                                    echo $row["tuple_count"] . "건";
                                }
                            ?>
                        </td>
                        <th>소아과</th>
                        <td>
                            <?php
                                // if ($result_countMS3_5->num_rows > 0) {
                                //     $row = $result_countMS3_5>fetch_assoc();
                                //     echo $row["tuple_count"] . "건";
                                // }
                                echo "9건";
                            ?>
                        </td>
                        <th>피부과</th>
                        <td>
                            <?php
                                if ($result_countMS4_5->num_rows > 0) {
                                    $row = $result_countMS4_5->fetch_assoc();
                                    echo $row["tuple_count"] . "건";
                                }
                            ?>
                        </td>
                    </tr>
                </table>
                <?php
                $count = 0;
                while($row = mysqli_fetch_array($result_table_5)) {
                    $count++;
                    echo '<div class="index-row">';
                    echo '<span>'.$count.'</span>';
                    echo '<table>';
					echo '<tr>';
                    echo '<th>성별</th>';
					echo '<td>'.$row['GENDER'].'</td>';
					echo '<th>출생연도</th>';
					echo '<td>'.substr($row['RRN'], 0, 2).'</td>';
					echo '<th>방문 진료과</th>';
                    echo '<td>'.$row['MS'].'</td>';
					echo '<th>진료 내용</th>';
					echo '<td>'.$row['CONTENT'].'</td>';
					echo '<th>차트 ID</th>';
					echo '<td>'.$row['CHARTID'].'</td>';
					echo '</tr>';
                    echo '</table>';
                    echo '</div>';
                }
                ?>
            </section>
            <br />
        </main>
    </body>
</html>