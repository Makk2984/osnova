<?php
namespace App\Controllers;

use App\Models\Order;
use App\Models\User;

class OrderController {
    private $orderModel;
    private $userModel;
    
    public function __construct() {
        $this->orderModel = new Order();
        $this->userModel = new User();
        
        // Check if user is authenticated
        if (!auth()) {
            redirect(baseUrl('/login'));
            exit;
        }
    }
    
    public function show($id) {
        // Get order by ID
        $order = $this->orderModel->getById($id);
        
        if (!$order) {
            header("HTTP/1.0 404 Not Found");
            include __DIR__ . '/../../views/errors/404.php';
            return;
        }
        
        // Check if user owns this order (or is admin)
        $user = auth();
        if ($order['user_id'] != $user['id'] && $user['role'] !== 'admin') {
            header("HTTP/1.0 403 Forbidden");
            $title = 'Access Denied';
            $message = 'You do not have permission to view this order.';
            include __DIR__ . '/../../views/errors/404.php';
            return;
        }
        
        // Get order items
        $orderItems = $this->orderModel->getItems($id);
        
        $title = 'Order #' . $order['id'];
        include __DIR__ . '/../../views/orders/show.php';
    }
}
