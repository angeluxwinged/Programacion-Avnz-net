<?php
    session_start();

    if(isset($_POST['submit'])){
        $email = strip_tags($_POST["email"]);
        $password = strip_tags($_POST["password"]);

            $curl = curl_init();

            curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/login',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('email' => $email,'password' => $password),
            CURLOPT_HTTPHEADER => array(
                'Cookie: XSRF-TOKEN=eyJpdiI6ImFNYnNCdjd1YklzSDJ4dk95YVBVYmc9PSIsInZhbHVlIjoiVXlaaENMNzBOQThWOXl4UDFJT0k4c01zT3ZaMEMrYmVLOVRwOVNWNGdLcTllNTBmUVBLbTNqUmlqTUxyendQQUNXNi9icXQyNGRqWmppcUY2SUxHcU9PdStsRlVtL2RzdlNjRTkyQ09td1R5dUpiTHlSRkpzL0ZUcWdSSGlJK0siLCJtYWMiOiIzNjU0NDc2NTcxMWZiMWMxYzI4ODQxMjk0MjE1OGYxNWNkMzUxZDdmOWZmM2E4ODE2NWZjZjAxMmU1NzQ2NzIwIiwidGFnIjoiIn0%3D; laravel_session=eyJpdiI6InFrTmtNQUdEVng0clJ3NEczNUhxNFE9PSIsInZhbHVlIjoiOG5vVnNrSUVocWhubU9BZ2tuV0pKNWt6QkE4NkpGelU1bmFFWFE5ZFBhUFNwa05BYWlXamlWNVdBcUZpTTdCUCtyNXZkTmU4ZnJBWFpqS2Faa2JQZldrZ01sczBtdVcxcFpwb2ZobUlxNmV4ZVNnOWhkcVhnazZnRW8wcXRwb1IiLCJtYWMiOiIxZTE2NjRlZDJkMWFkM2MxZDIyNjc2MDRmMDNlMWE1MjJiNzM5MGVhMmFjYzlhNzQ5MTZlOGZkYmEwYTA5OWZlIiwidGFnIjoiIn0%3D'
            ),
            ));

            $response = curl_exec($curl);
            
            $response = json_decode($response);
            curl_close($curl);

            if($response->code > 0){
                $_SESSION['id'] = $response->data->id;
                $_SESSION['name'] = $response->data->name;
                $_SESSION['avatar'] = $response->data->avatar;
                $_SESSION['email'] = $response->data->email;
                $_SESSION['phone_number'] = $response->data->phone_number;
                $_SESSION['created_by'] = $response->data->created_by;
                $_SESSION['role'] = $response->data->role;
                $_SESSION['token'] = $response->data->token;

                header("Location: ../views/home.php");
            }else{
                header("Location: ../index.php");
            }

        }
?>