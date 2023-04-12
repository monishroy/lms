<?php
$title = 'Return Book';
require_once 'header.php';

?>
                <!-- content HEADER -->
                <!-- ========================================================= -->
                <div class="content-header">
                    <!-- leftside content header -->
                    <div class="leftside-content-header">
                        <ul class="breadcrumbs">
                        <li><i class="fa fa-home" aria-hidden="true"></i><a href="#">Dashboard</a></li>
                        <li><a href="javascript:avoid(0)">Return Books</a></li>
                        </ul>
                    </div>
                </div>
                <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
                <div class="row animated fadeInUp">
                 <div class="col-sm-12">
                    <h4 class="section-subtitle"><b>Return Books</b></h4>
                    <div class="panel">
                        <div class="panel-content">
                            <div class="table-responsive">
                                <table id="basic-table" class="table-bordered data-table table table-striped nowrap table-hover" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Roll</th>
                                        <th>Phone</th>
                                        <th>Book Name</th>
                                        <th>Book Issue Date</th>
                                        <th>Return Book</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $result = mysqli_query($con, "SELECT `issue_books`.`id`, `issue_books`.`book_id`, `issue_books`.`book_issue_date`, `students`.`fname`, `students`.`lname`,`students`.`roll`, `students`.`phone`, `books`.`book_name`, `books`.`book_image`
                                            FROM `issue_books`
                                            INNER JOIN `students` ON `students`.`id` = `issue_books`.`student_id`
                                            INNER JOIN `books` ON `books`.`id` = `issue_books`.`book_id`
                                            
                                            WHERE `issue_books`.`boot_return_date` = ''");
                                            while ($row = mysqli_fetch_assoc($result)){
                                        ?>
                                                    <tr>
                                                        <td><?= ucwords($row['fname'] .' '. $row['lname']) ?></td>
                                                        <td><?= $row['roll'] ?></td>
                                                        <td><?= $row['phone'] ?></td>
                                                        <td><?= $row['book_name'] ?></td>
                                                        <td><?= $row['book_issue_date'] ?></td>
                                                        <td>
                                                            <a href="return-book.php?id=<?= $row['id'] ?>&bookid=<?= $row['book_id'] ?>"><button onclick="popUp()" class="btn btn-wide btn-o btn-info">Return Book</button></a>
                                                            
                                                        </td>
                                                    </tr>
                                                <?php
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



  <?php
  if(isset($_GET['id'])){
      $id = $_GET['id'];
      $bookid = $_GET['bookid'];
      $date = date('d-m-y');
      $result = mysqli_query($con, "UPDATE `issue_books` SET `boot_return_date`='$date' WHERE `id` = '$id';");
      if($result){
          mysqli_query($con, "UPDATE `books` SET `available_qty` = `available_qty`+1 WHERE `id` = '$bookid'");

          ?>
          <script>
            //   alert('Return Successfully!');
               javascript:history.go(-1);
          </script>
          <?php
          
      }else{
        ?>
        <script>
            swal('Something is Wrong','Please Try Again','error');
        </script>
        <?php
      }
  }
  ?>              
<?php
require_once 'footer.php';
?>