<?php 


// print_r($_POST);
// print_r($_FILES);

function oldData($data){

    if(empty($_POST[$data])){
        return '';
    }else{
        return $_POST[$data];
    }
}
function setError($name,$message){
    session_start();
    $_SESSION['err'][$name] = $message;
}   

function getError($name){
    
    if(isset($_SESSION['err'][$name])){
        session_start();
        return $_SESSION['err'][$name];
    }else{
        return " ";
    }

}

function clearError(){
    session_start();
    $_SESSION['err'] = [];
}

function textFilter($text){
    $text = trim($text);
    $text = htmlentities($text , ENT_QUOTES);
    $text = stripslashes($text);
    return $text;
};

$con = mysqli_connect('localhost','root','','contact');

function register(){
    $name = '';
    $phone = '';
    $email = '';
    $address = '';
    $photo = '';
    // $file = $_POST['photo'];
    $errorStatus = 0 ;
    if(empty($_POST['name'])){
        $errorStatus = 1;
        setError('name','Name is Required');
    }else{

        if(strlen($_POST['name']) < 5){
            $errorStatus = 1;
            setError('name',"Name is Too Short");
        }else{  
           
            if(strlen($_POST['name']) > 20){
                $errorStatus = 1;
                setError('name','Name is Too Long');
            }else{
                $name = textFilter($_POST['name']);
                // $errorStatus = 0;
            }
        }
    }   

    if(empty($_POST['phone'])){
        $errorStatus = 1;
        setError('phone','Phone is Required');
    }else{

       
        if(strlen($_POST['phone']) < 5){
            $errorStatus = 1;
            setError('phone',"Phone is Too Short");
        }else{  
           
            if(strlen($_POST['phone']) > 11){
                $errorStatus = 1;
                setError('phone','Phone is Too Long');
            }else{
                $phone = textFilter($_POST['phone']);
                // $errorStatus = 0;
            }
        }
    }   

    if(empty($_POST['email'])){
        $errorStatus = 1;
        setError('email','Email is Required');
    }else{
       if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
           $errorStatus = 1 ;
           setError('email','Email Format Is Wrong Ex@gmail.com');  
       }else{
            $email = $_POST['email'];
       }
    }

    if(empty($_POST['address'])){
        $errorStatus = 1;
        setError('address','address is Required');
    }else{

        if(strlen($_POST['address']) < 5){
            $errorStatus = 1;
            setError('address',"address is Too Short");
        }else{  
           
            if(strlen($_POST['address']) > 30){
                $errorStatus = 1;
                setError('address','address is Too Long');
            }else{
                $address = textFilter($_POST['address']);
                // $errorStatus = 0;
            }
        }
    }  


    //for file upload // 
    $fileType = ['image/png','image/jpg','image/jpeg'];
    if(empty($_FILES['photo']['name'])){
        setError('photo','Photo Required');
        $errorStatus = 1;
    }else{
        if(!in_array($_FILES['photo']['type'] , $fileType)){
            setError('photo','File Type Must Be png/jpeg!');
            $errorStatus = 1;
        }else{
            setError('success','Your Profile Uploaded');//show success

            $file = $_FILES['photo'];
            $store = './photo/';
            $fileStore = $_FILES['photo']['tmp_name'];
            $photo = $file['name'];
            $newName = $store.$file['name'];
            move_uploaded_file($fileStore, $newName);

            //error handle 
            // $errorStatus = 0;
        }
    }

    if(!$errorStatus){
        global $con;
        // return $_FILES['photo'];
        $sql = "INSERT INTO lists(name,email,phone,address,photo) 
                VALUES('$name','$email','$phone','$address','$photo')";

        // die($sql);
        if(mysqli_query($con, $sql)){
            return header("location:index.php");
        }else{
            return 'Db error';
        }

    }
}

function getPhoto(){
    global $con;
    $sql = "SELECT * FROM lists WHERE 1";

    $query = mysqli_query($con,$sql);
    $photoArr = [];
    while($row = mysqli_fetch_assoc($query)){
        array_push($photoArr,$row);
    }

    return $photoArr;
}

function delPhoto($id){ 
    global $con;
    $sql = "DELETE FROM lists WHERE id=$id";

    if(mysqli_query($con, $sql)){
        header("location:index.php");
    }else{
        echo "error Database";
    };

}   
?>