<?php
    class ProductsController{
        public function getProducts(){
            if(isset($_SESSION['token'])){

                $curl = curl_init();
    
                curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://crud.jonathansoto.mx/api/products',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                    'Authorization: Bearer '  . $_SESSION['token']
                ),
                ));
    
                $response = curl_exec($curl);
    
                $response = json_decode($response);
                curl_close($curl);
    
                if($response->code > 0){
                    $productos = $response->data;
                    return $productos;
                }
    
            }
        }

        public function getProductById(){
            if(isset($_SESSION['token'])){

                if (isset($_GET['slug'])) {
                    $slug = $_GET['slug'];
                }

                $curl = curl_init();

                curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://crud.jonathansoto.mx/api/products/slug/' . $slug,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                    'Authorization: Bearer ' . $_SESSION['token']
                ),
                ));

                $response = curl_exec($curl);

                $response = json_decode($response);
                curl_close($curl);
    
                if($response->code > 0){
                    $producto = $response->data;
                    return $producto;
                }
    
            }
        }
    }



?>