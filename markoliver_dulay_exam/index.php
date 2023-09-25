<?php 
   require_once 'connection.php';
   ?>
<!DOCTYPE html>
<html>
   <head>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css">
      <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
      <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.bootstrap4.min.css">
      <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
      <link rel="stylesheet" href="style.css">
      <script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.js"></script>
      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
      <title>Save YouTube Data</title>
   </head>
   <body>
      <div class="container">
         <h1>Save YouTube Channel Data</h1>
         <form action="sync_youtube_channel.php" method="post">
            <button type="submit" name="save">Save Data</button>
         </form>
         <?php
            session_start();
            if (isset($_SESSION['statustitle']) && $_SESSION['statustitle'] != '') {
                ?>
         <script type="text/javascript">
            $(document).ready(function() {
                swal({
                    title: "<?php echo $_SESSION['statustitle']; ?>",
                    text: "<?php echo $_SESSION['statustext'];?>",
                    icon: "<?php echo $_SESSION['icon'];?>",
                    button: "Ok",
                });
            });
         </script>
         <?php
            unset($_SESSION['statustitle']);
            }
            ?>
      </div>
      <div class="row">
         <div class="col-md-12">
            <table id="tableresult" class="table table-striped table-bordered">
               <thead>
                  <tr>
                     <th>Video Title</th>
                     <th>Profile</th>
                     <th>Channel Title</th>
                     <th>Video Description</th>
                  </tr>
               </thead>
               <tbody>
                  <?php
                     $channelId = 'UC_x5XG1OV2P6uZZ5FSM9Ttw'; 
                     //SQL $query
                     $query = mysqli_query($conn, "SELECT DISTINCT c.title AS channel_title, c.description AS channel_description, c.profile_picture AS channel_profile_picture,
                     v.video_link, v.title AS video_title, v.description AS video_description, v.thumbnail AS video_thumbnail
                     FROM youtube_channels c
                     JOIN youtube_channel_videos v ON c.channel_id = v.channel_id
                     WHERE c.channel_id = '$channelId'
                     ");
                     
                     while ($row = mysqli_fetch_array($query)) {
                        
                         ?>
                  <tr>
                     <td><?php echo ((strlen
                        ($row['video_title']) > 30) ? substr($row['video_title'], 0, 30) . ' ...' : $row['video_title']); ?></td>
                     <td><?php echo '<img class="picture" src="' . $row["video_thumbnail"] . '">'; ?></td>
                     <td><?php echo $row["channel_title"]; ?></td>
                     <td><?php echo ((strlen($row['video_description']) > 50) ? substr($row['video_description'], 0, 50) . ' ...' : $row['video_description']); ?></td>
                  </tr>
                  <?php
                     }
                     ?>
               </tbody>
            </table>
         </div>
      </div>
      <?php
         require_once 'datatable.php';
         ?>
   </body>
</html>