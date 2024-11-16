<?php
// Include the necessary controllers and files
require_once '../../src/controllers/bird_controller.php';

// Get the bird ID from the URL parameter
if (isset($_GET['id'])) {
    $bird_id = $_GET['id'];

    // Create an instance of the BirdController
    $controller = new BirdController();

    // Fetch the bird details based on the ID
    $bird = $controller->getAllBirds();
    foreach ($bird as $b) {
        if ($b['id'] == $bird_id) {
            $current_bird = $b;
            break;
        }
    }
} else {
    // Redirect if no ID is provided
    header("Location: birds.php");
    exit;
}

// If the form is submitted, process the update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'species' => $_POST['species'],
        'gender' => $_POST['gender'],
        'purchase_date' => $_POST['purchase_date'],
        'purchase_cost' => $_POST['purchase_cost'],
        'purchased_from' => $_POST['purchased_from'],
        'weight_at_purchase' => $_POST['weight_at_purchase'],
        'age_at_purchase' => $_POST['age_at_purchase'],
        'hatched_date' => $_POST['hatched_date'],
        'remark' => $_POST['remark'],
        'breeding_at_purchase' => $_POST['breeding_at_purchase']
    ];

    // Call the controller to update the bird
    $controller->updateBird($bird_id, $data);

    // Redirect back to the birds management page
    header("Location: birds.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Bird</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h1>Edit Bird Information</h1>

    <form method="POST" action="">
        <div class="mb-3">
            <label for="species" class="form-label">Species</label>
            <input type="text" class="form-control" id="species" name="species" value="<?php echo $current_bird['species']; ?>" required>
        </div>

        <div class="mb-3">
            <label for="gender" class="form-label">Gender</label>
            <select class="form-control" id="gender" name="gender" required>
                <option value="MALE" <?php echo $current_bird['gender'] == 'MALE' ? 'selected' : ''; ?>>Male</option>
                <option value="FEMALE" <?php echo $current_bird['gender'] == 'FEMALE' ? 'selected' : ''; ?>>Female</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="purchase_date" class="form-label">Purchase Date</label>
            <input type="date" class="form-control" id="purchase_date" name="purchase_date" value="<?php echo $current_bird['purchase_date']; ?>" required>
        </div>

        <div class="mb-3">
            <label for="purchase_cost" class="form-label">Purchase Cost</label>
            <input type="number" class="form-control" id="purchase_cost" name="purchase_cost" value="<?php echo $current_bird['purchase_cost']; ?>" required>
        </div>

        <div class="mb-3">
            <label for="purchased_from" class="form-label">Purchased From</label>
            <input type="text" class="form-control" id="purchased_from" name="purchased_from" value="<?php echo $current_bird['purchased_from']; ?>" required>
        </div>

        <div class="mb-3">
            <label for="weight_at_purchase" class="form-label">Weight at Purchase</label>
            <input type="number" step="0.01" class="form-control" id="weight_at_purchase" name="weight_at_purchase" value="<?php echo $current_bird['weight_at_purchase']; ?>" required>
        </div>

        <div class="mb-3">
            <label for="age_at_purchase" class="form-label">Age at Purchase</label>
            <input type="text" class="form-control" id="age_at_purchase" name="age_at_purchase" value="<?php echo $current_bird['age_at_purchase']; ?>" required>
        </div>

        <div class="mb-3">
            <label for="hatched_date" class="form-label">Hatched Date</label>
            <input type="date" class="form-control" id="hatched_date" name="hatched_date" value="<?php echo $current_bird['hatched_date']; ?>">
        </div>

        <div class="mb-3">
            <label for="remark" class="form-label">Remark</label>
            <textarea class="form-control" id="remark" name="remark"><?php echo $current_bird['remark']; ?></textarea>
        </div>

        <div class="mb-3">
            <label for="breeding_at_purchase" class="form-label">Breeding at Purchase</label>
            <input type="number" step="0.01" class="form-control" id="breeding_at_purchase" name="breeding_at_purchase" value="<?php echo $current_bird['breeding_at_purchase']; ?>" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Bird</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
