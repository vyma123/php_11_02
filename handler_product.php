<?php 
require_once 'includes/db.inc.php';
require_once './includes/functions.php';





if (isset($_POST['save_product'])) {

    $product_name = test_input($_POST['product_name']);
    $sku = test_input($_POST['sku']);
    $price = test_input($_POST['price']);
    $featured_image = $_FILES['featured_image'];
    $overallUploadOk = 1;

    if(empty($product_name) || empty($sku) || empty($price)){
        $res = [
            'status' => 422,
            'message' => ' At least one field is required.'
        ];
        echo json_encode($res);
        return;
     }

     $errors = [];

if(!isValidInput($product_name) && !empty($product_name)){
    $errors[] = [
        'field' => 'product_name',
        'message' => "don't allow special character"
    ];
}

if(!isValidInput($sku) && !empty($sku)){
    $errors[] = [
        'field' => 'sku',
        'message' => "don't allow special character"
    ];
}
if(!isValidNumberWithDotInput($price) && !empty($price)){
    $errors[] = [
        'field' => 'price',
        'message' => 'just allow number'
    ];
}
if(!empty($errors)){
    $res = [
        'status' => '400',
        'errors' => $errors
    ];
    echo json_encode($res);
    return;
}











if(!empty($product_name)){
    $inserted = insert_product($pdo, $product_name, $sku, $price);
}


$res = [
    'status' => 200,
];

echo json_encode($res);
return;

}

