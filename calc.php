<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    $expression = $input['expression'];

    // Validate the expression
    if (!preg_match('/^[\d\.\+\-\*\/\(\) ]+$/', $expression)) {
        echo json_encode(array('error' => 'Invalid expression'));
        exit();
    }

    // Evaluate the expression
    try {
        $result = eval("return $expression;");
        echo json_encode(array('result' => $result));
    } catch (Exception $e) {
        echo json_encode(array('error' => 'An error occurred during evaluation'));
    }
} else {
    http_response_code(405);
    echo json_encode(array('error' => 'Method not allowed'));
}
?>
