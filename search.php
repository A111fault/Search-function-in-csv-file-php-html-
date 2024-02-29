<?php
include 'connect.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css">
    <title>Search Employee Data</title>
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container-box {
            border: 2px solid #007bff;
            padding: 20px;
            margin-top: 20px;
            border-radius: 10px;
            background-color: #fff;
        }

        .form-control-sm {
            border-radius: 5px;
        }

        .btn-dark {
            border-radius: 5px;
        }

        .table-container {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #007bff;
            color: #fff;
        }

        tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .btn-primary {
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="container-box">
                    <form class="my-2 mx-2" method="post">
                        <h2 class="mb-4">Search Employee Details</h2>
                        <div class="row">
                            <div class="col-md-3">
                                <input type="text" class="form-control form-control-sm mb-3" name="emp_id" placeholder="Employee ID">
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control form-control-sm mb-3" name="emp_name" placeholder="Employee Name">
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control form-control-sm mb-3" name="designation" placeholder="Designation">
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control form-control-sm mb-3" name="blood_group" placeholder="Blood Group">
                            </div>
                        </div>
                        <button type="submit" name="submit" class="btn btn-dark">Search</button>
                    </form>
                    <div class="container my-2 mx-2 table-container">
                        <table class="table table-bordered border-primary">
                            <thead>
                                <tr>
                                    <th>SN</th>
                                    <th>Employee ID</th>
                                    <th>Name</th>
                                    <th>Designation</th>
                                    <th>Mobile</th>
                                    <th>Religion</th>
                                    <th>Blood Type</th>
                                    <th>Address</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!isset($_POST['submit'])) {
                                    $sql = "SELECT * FROM `tab` WHERE SN <= 50"; // Limit data to SN 50
                                    $result = mysqli_query($con, $sql);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo '<tr>
                                                <td>' . $row['SN'] . '</td>
                                                <td>' . $row['Emp_id'] . '</td>
                                                <td>' . $row['Emp_name'] . '</td>
                                                <td>' . $row['Desig'] . '</td>
                                                <td>' . $row['Mobile'] . '</td>
                                                <td>' . $row['Religion'] . '</td>
                                                <td>' . $row['Blood'] . '</td>
                                                <td>' . $row['Addres'] . '</td>
                                              </tr>';
                                    }
                                } else {
                                    $emp_id = isset($_POST['emp_id']) ? $_POST['emp_id'] : '';
                                    $emp_name = isset($_POST['emp_name']) ? $_POST['emp_name'] : '';
                                    $designation = isset($_POST['designation']) ? $_POST['designation'] : '';
                                    $blood_group = isset($_POST['blood_group']) ? $_POST['blood_group'] : '';

                                    $sql = "SELECT * FROM `tab` WHERE 1=1";

                                    if (!empty($emp_id)) {
                                        $sql .= " AND Emp_id LIKE '%$emp_id%'";
                                    }
                                    if (!empty($emp_name)) {
                                        $sql .= " AND Emp_name LIKE '%$emp_name%'";
                                    }
                                    if (!empty($designation)) {
                                        $sql .= " AND Desig LIKE '%$designation%'";
                                    }
                                    if (!empty($blood_group)) {
                                        $sql .= " AND Blood LIKE '%$blood_group%'";
                                    }

                                    $result = mysqli_query($con, $sql);
                                    if ($result) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            if ($row['SN'] <= 50) { // Only display rows with SN up to 80
                                                echo '<tr>
                                                    <td>' . $row['SN'] . '</td>
                                                    <td>' . $row['Emp_id'] . '</td>
                                                    <td>' . $row['Emp_name'] . '</td>
                                                    <td>' . $row['Desig'] . '</td>
                                                    <td>' . $row['Mobile'] . '</td>
                                                    <td>' . $row['Religion'] . '</td>
                                                    <td>' . $row['Blood'] . '</td>
                                                    <td>' . $row['Addres'] . '</td>
                                                  </tr>';
                                            }
                                        }
                                    } else {
                                        echo '<tr><td colspan="8">Data not found</td></tr>';
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <form method="post" action="">
                        <button type="submit" name="reset" class="btn btn-primary">Reset</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
