<?php



use App\Controller\UsersController;

header('Content-Type: application/json');


include __DIR__ . '/../controller/UsersController.php';

$user = new UsersController();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        
        $result = $user->authLogout();
        echo json_encode($result);
        exit;
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        exit;
    }
}
