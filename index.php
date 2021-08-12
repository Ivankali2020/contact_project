<?php session_start(); ?>
<?php require_once 'function.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Contact Form </title>
    <style>
        .image {
            width: 60px;
            height: 60px;
            border: 1px solid black;
            border-radius: 50%;
            transition: .4s all ease-in-out;
        }
        .profile{
            width: 40px;
            height: 40px;
            border: 1px solid lightgreen;
            border-radius: 50%;
            transition: .4s all ease-in-out;
        }

        .image:hover {  
            border: 2px solid lightblue;
        }
        .image img{
            transition: .3s all ease;
        }
        .image:hover img{
            transform: scale(.8);
        }

        #hidden {
            display: none;
        }

        .offcanvas {
            width: 40% !important;
            height: auto;
            margin: auto;
        }

        /* .form-control {
            border: 0;
            border-bottom: 1px solid black;
        } */
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-12 col-md-9 mt-4 p-0 ">

                <!-- <p> <?php echo "<p class='alert alert-danger'> Something Was Wrong Try Again Bro</p>"; ?></p> -->

                <button class="btn btn-outline-success " type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasTop" aria-controls="offcanvasTop">Upload Contact</button>

                <div class="offcanvas offcanvas-top" tabindex="-1" id="offcanvasTop" aria-labelledby="offcanvasTopLabel">
                    <div class="offcanvas-header">
                        <h4 id="offcanvasTopLabel" class="text-muted fw-bold mb-0"> Create New Contact <i class="bi bi-person-plus-fill"></i> </h4>

                        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">

                    <?php if(isset($_POST['register'])){

                         register();

                    } ?>

                        <form class="card "  method="post" enctype="multipart/form-data">
                            <!-- <div class="card-header bg-transparent">
                                <h4 class="text-muted fw-bold mb-0"> Create New Contact <i class="bi bi-person-plus-fill"></i> </h4>
                            </div> -->
                            <div class="card-body">
                                <div class="d-flex justify-content-lg-center flex-column align-items-center">
                                    <div class="image d-flex justify-content-center align-items-center" id="image">
                                        <img src="./default.png" class="w-75 h-75 " alt="" srcset="">
                                        <input type="file" id="hidden" name="photo">
                                        
                                    </div>

                                    <?php if(getError('photo')){  ?>
                                                <small class="text-danger mt-2"><?php echo getError('photo'); ?></small>
                                    <?php } ?>
                                    <?php if(getError('success')){  ?>
                                                <small class="text-success   mt-2"><?php echo getError('success'); ?></small>
                                    <?php } ?>


                                    <div class="d-flex justify-content-lg-between w-100">
                                        <div class="form-floating mt-4 w-100 mb-0 me-3">
                                            <input type="text" value="<?php echo oldData('name'); ?>" name="name" class="form-control form-control-sm" id="floatingInput" placeholder="name@example.com">
                                            <label for="floatingInput"> First Name </label>
                                            
                                            <?php if(getError('name')){  ?>
                                                <small class="text-danger"><?php echo getError('name'); ?></small>
                                            <?php } ?>
                                            
                                        </div>
                                        <div class="form-floating mt-4 w-100 mb-0 ">
                                            <input type="text" value="<?php echo oldData('phone'); ?>" name="phone" class="form-control form-control-sm" id="floatingInput" placeholder="phone@example.com">
                                            <label for="floatingInput">  Phone </label>
                                            
                                            <?php if(getError('phone')){  ?>
                                                <small class="text-danger"><?php echo getError('phone'); ?></small>
                                            <?php } ?>
                                            
                                        </div>
                                       
                                    </div>

                                    <div class="form-floating mt-4 w-100 mb-0 ">
                                        <input type="text" name="email" value="<?php echo oldData('email') ?>" class="form-control form-control-sm" id="floatingInput" placeholder="name@example.com">
                                        <label for="floatingInput"> Email </label>
                                        <?php if(getError('email')){  ?>
                                                <small class="text-danger"><?php echo getError('email'); ?></small>
                                        <?php } ?>
                                    </div>

                                    <div class="form-floating mt-4 w-100 mb-0 ">
                                        <input type="text" name="address" value="<?php echo oldData('address') ?>" class="form-control form-control-sm" id="floatingInput" placeholder="name@example.com">
                                        <label for="floatingInput"> Address </label>
                                        <?php if(getError('address')){  ?>
                                                <small class="text-danger"><?php echo getError('address'); ?></small>
                                        <?php } ?>
                                    </div>
                                    <!-- <div class="form-floating mt-4 w-100">
                                        <textarea class="form-control" name="address" placeholder="Leave a comment here" id="floatingTextarea"></textarea>
                                        <label for="floatingTextarea">Address</label>
                                    </div> -->

                                    <div class="text-end w-100 mt-4">
                                        <button class="btn btn-outline-dark" name='register'>Upload New Contact</button>
                                    </div>
                                </div>

                            </div>
                        </form>
                    
                    </div>
                </div>

                <div class="card mt-4 ">
                    <div class="card-body  p-0 ">
                        <div class="">
                               <?php if(isset($_POST['register'])){

                                    echo register();

                                } ?>
                            <table id="example" class="display align-middle text-center mb-0 table table-bordered table-hover table-striped table-responsive " style="width:100%">
                                <thead class="table-success">
                                    <tr>
                                        <th>Photo</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Address</th>
                                        <th>Del</th>
                                        <th> Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach (getPhoto() as $photo){ 
                                    $date = date('d M Y',strtotime($photo['created_at']));    
                                ?>   
                                    <tr>
                                        <td>
                                            <div class=" d-flex justify-content-center align-items-center" id="image">
                                                
                                                <img src="./photo/<?php echo $photo['photo'] ?>" class=" profile" alt="" srcset="">
                                                                                     
                                            </div>
                                        </td>
                                        <td><?php echo $photo['name'] ?></td>
                                        <td><?php echo $photo['email'] ?></td>
                                        <td><?php echo $photo['phone'] ?></td>
                                        <td> 
                                            <!-- <div class=" d-flex justify-content-center align-items-center" id="image"> -->
                                            <a onclick="return alert('Are Your Sure To Delete <?php echo $post['name'] ?>')" href="delete.php?id=<?php echo $photo['id'] ?>">
                                                <img src="./del.png" style="width: 20px;height:20px"  class="" alt="" srcset="">
                                            </a>                                        
                                            <!-- </div>                                              -->
                                        </td>
                                        <td><?php echo $photo['address'] ?></td>
                                        <td class="text-nowrap"><?php echo $date ?></td>
                                    </tr>
                                <?php } ?>
                             
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
               
            </div>
        </div>
        
    </div>
    <?php clearError(); ?>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

    <script>
        let image = document.getElementById('image');
        let hidden = document.getElementById('hidden');

        image.addEventListener('click', () => {
            hidden.click();
        })


        const jsfunction = () => {
            alert('Something Was Wrong Try Again');
        }
    </script>
</body>

</html>