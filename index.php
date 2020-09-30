   <?php include "config/config.php"; ?> 
 <?php
 

         if((isset($_POST['submit']))){
            
            $fullname = $_POST['fullname'];
            $Username = $_POST['username'];
            $Email = $_POST['email'];
            $Password = md5 ($_POST['password']);

            //*----validations---->

            if(preg_match('/[^a-zA-Z\s]/',$fullname))
            {
               echo '<script language="javascript">';
            echo 'alert("Only alphabets are allowed as fullname")';
             echo '</script>';
            }

                 //*----Input value range---->

             if (strlen($fullname) > 2 && strlen($fullname)< 30)
             {
               //* echo "fullname range is ok" ;
             } 
             else
             {
               echo '<script language="javascript">';
               echo 'alert("Fullname must be  b/t 2 to 30 chars long")';
                echo '</script>';
             }


            


         

            if (empty(trim($fullname))){
               echo "Fullname is required.";
            }

            if (empty(trim($Username))){
               echo "Username is required.";
            }

            if (empty(trim($Email))){
               echo  " Email is required.";
            }

            if (empty(trim($Password))){
               echo "Password is required.";
            }

            //*echo $fullnamee." " .$Email." "." ".$Username." ".$Password;

            //* Insert DATA----------->
           $query = "INSERT INTO users(fullname,username	,email, password) VALUES ('$fullname','$Username','$Email','$Password')";
            
           $fire = mysqli_query($con,$query) or die ("can not insert data into database." .mysqli_error($con));
         
           echo '<script language="javascript">';
            echo 'alert("Data submitted to database")';
             echo '</script>';
             
         }

          ?>

         <!--// Delete Data-->
         <?php 

         if (isset($_GET['del'])){
            $id = $_GET['del'];
           $query = "DELETE FROM   users WHERE id = $id";
           $fire = mysqli_query($con,$query) or die (" can not delete data  from database..".mysqli_error($con));


          //* alert Box--------------
           echo '<script language="javascript">';
            echo 'alert("Data deleted successfully  from database")';
             echo '</script>';
           //* ($fire) echo "Data deleted successfully  from datbase";

         }
             // this code will be executed
       
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> 
     <title>CRUD</title>
</head>
<body>


<body style="background: linear-gradient(to right, #5c7909,#fcb045,#22c1c3);">



     <div class="container">
       <div class="row">
       <div class="col-sm-7">
                <!-- Show Data Here-->
             
             <h3>User Data</h3>
             <hr>
             <table class="table">
    <thead>
      <tr>
        <th>Firstname</th>
        <th>Username</th>
        <th>Email</th>
        
      </tr>
    </thead>
    <tbody>    
           <?php
               $query = "SELECT * FROM users";
               $fire = mysqli_query ($con,$query) or die ("can not fetch data from database" .mysqli_error($con));
               //*if ($fire) echo " We got data from database..";

               if(mysqli_num_rows($fire)>0){                 
                  while($users = mysqli_fetch_assoc($fire)){ ?>

                  <tr>
                       

                       <td><?php echo $users['fullname'] ?></td>
                       <td><?php echo $users['username'] ?></td>
                       <td><?php echo $users['email'] ?></td>
                     
                       
                       <td>
                         <a href="<?php $_SERVER['PHP_SELF'] ?> ?del=<?php  echo $users['id']?>"
                                class ="btn btn-sm btn-danger">Delete</a>
                                </td>


                                <td>
                                <a class ="btn btn-sm btn-warning"
                                href="update.php?upd=<?php echo $users['id']?>"
                                >Update</a>
                                </td>
                       </tr>
                        
                       <?php
                  }
               } 
               else
               {
                  ?>
                  <tr>
                  <td colspan="3" class="text-center">
                   <h2 class="text-muted"> There is no data to show !!</h2>
                      </td>
                  </tr>
                   <?php

               }                   
                              
               ?>
               </tbody>
               </table>

               </div>
               <!---SignUp form--->

               
            <div class="col-lg-4">

                <h3>SignUp</h3>  
                   <hr>
                     <form  name="signup" id= "signup"
                     action="config/action.php" method="POST">
                        <div class= "form-group">
                          <label for="fullname">Fullname</label>
                             <input name="fullname" id="fullname" type="text" class="form-control" placeholder="fullname" required>
                             </div>

                             <div class= "form-group">
                          <label for="username">Username</label>
                             <input name="username" id="username" type="username" class="form-control" placeholder="username" required>
                             </div>

                             <div class= "form-group">
                          <label for="email">Email	</label>
                             <input name="email" id="email"  type="text" class="form-control" placeholder="email" required>
                             </div>
                                 

                             <div class= "form-group">
                          <label for="password">Password</label>
                             <input  name="password" id="password" type="password" class="form-control" placeholder="password " required>
                             </div>

                             <div class= "form-group">
                             <button  name="submit"  id="submit" class= "btn btn-primary btn-block">Sign Up</button>
                             </div>
                             </form>
                             
                             
                       </div>
               </div>
    </div>                   
        </div>
       </div>


       
</body>
</html>
    