<?php include 'db.php'; ?>
<!DOCTYPE html>
<html><head>
    <title>Car Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head><body>
<div class="container mt-4">
    <h3>Register a Car</h3>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $company = $_POST['make'];
        $color = $_POST['color'];
        $stmt = $conn->prepare("INSERT INTO cars (company_id, color_id) VALUES (?, ?)");
        $stmt->bind_param("ii", $company, $color);
        if ($stmt->execute()) {
            echo "<div class='alert alert-success'>Car Registered Successfully</div>";
        } else {
            echo "<div class='alert alert-danger'>Failed to Register</div>";
        }
    }

    $makes = mysqli_query($conn,"SELECT * from company");
    $colors = mysqli_query($conn,"SELECT * from colors");   
    ?>

    <form method="post" class="mb-4">
        <div class="mb-3">
            <label for="make" class="form-label">Car:</label>
            <select name="make" id="make" class="form-control" required>
                <option value="">-- Select Car --</option>
                <?php while ($row = $makes->fetch_assoc()): ?>
                    <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="color" class="form-label">Color:</label>
            <select name="color" id="color" class="form-control" required>
                <option value="">-- Select Color --</option>
                <?php while ($row = $colors->fetch_assoc()): ?>
                    <option value="<?= $row['id'] ?>"><?= $row['color_name'] ?></option>
                <?php endwhile; ?>
            </select>
        </div>  

        <button type="submit" class="btn btn-primary">Register Car</button>
    </form>

    <h4>Registered Cars</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Car </th>
                <th>Color</th>
                <th>Registered On</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $q = "SELECT cars.id, c.name AS company_name, cl.color_name, cars.registration_date
              FROM cars
              JOIN company c ON c.id = cars.company_id
              JOIN colors cl ON cl.id = cars.color_id
              ORDER BY cars.id DESC";
        $res = $conn->query($q);
        while ($car = $res->fetch_assoc()):
        ?>
            <tr>
                <td><?= $car['company_name'] ?></td>
                <td><?= $car['color_name'] ?></td>
                <td><?= $car['registration_date'] ?></td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>
